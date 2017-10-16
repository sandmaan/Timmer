<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 8/2/2017
 * Time: 4:07 PM
 */

session_start();
include_once("../iConnect/handShake.php");
include_once("../Functions/userCheck.php");
include_once("../Libraries/PHPExcel/PHPExcel.php");

//  Create new PHPExcel file
$objPHPExcel = new PHPExcel();

if (isset($_REQUEST["date"])){
//  Setting variables
    $rowNo = 2; //Initiate row number.
    $cName = $_SESSION["fName"]." ".$_SESSION["lName"]; //Creators name for the file properties.
    $dTitle = "Total User Time_".$_REQUEST["date"];
    $dDescription = "Document contains total user time for the date:".$_REQUEST["date"];
    $fName = "User Total Time_". $_REQUEST["date"].".xlsx";

//  Document properties
    $objPHPExcel->getProperties()->setCreator($cName)
                                 ->setLastModifiedBy($cName)
                                 ->setTitle($dTitle)
                                 ->setSubject($dTitle)
                                 ->setDescription($dDescription);

//  Creating the first sheet
    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->getActiveSheet()->setCellValue('A1', "User Name");
    $objPHPExcel->getActiveSheet()->setCellValue('B1', "Total Time");

//  Set column width
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth("12");
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth("12");

//  Set formatting

    //    Set heading alignment
    $objPHPExcel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    //    Set heading font
    $objPHPExcel->getActiveSheet()->getStyle("A1:B1")->getFont()->setBold(true);

//  Set page header for printing
    $objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader("&C&B $dTitle");

//  Freeze pane
    $objPHPExcel->getActiveSheet()->freezePane('A2');

//  Run SQL to get data
    $getTot = "SELECT userlogin.uName, SEC_TO_TIME(SUM(TIME_TO_SEC(timeSpent))) AS totTime FROM usertimetrack
               LEFT JOIN userlogin ON usertimetrack.usrId = userlogin.uId WHERE jDate = :jdate GROUP BY usrId";
    $getTotQuery = $dbConnect -> prepare($getTot);
    $getTotQuery -> bindParam('jdate', $_REQUEST["date"]);
    $getTotQuery -> execute();
    $getRowCount = $getTotQuery -> rowCount();

    while($getRow = $getTotQuery -> fetch(PDO::FETCH_ASSOC)){
        for ($i = 1; $i <= $getRowCount; $i++){
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $rowNo, $getRow["uName"])
                                          ->setCellValue('B' . $rowNo, $getRow["totTime"]);
        }
        $rowNo++;
    }

// Set worksheet name
    $objPHPExcel->getActiveSheet()->setTitle($dTitle);

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel2007)
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header("Content-Disposition: attachment;filename=\"$fName\"");
    header("Cache-Control: max-age=0");

// If you're serving to IE 9, then the following may be needed
    header("Cache-Control: max-age=1");

// If you're serving to IE over SSL, then the following may be needed
    header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
    header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
    header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header ('Pragma: public'); // HTTP/1.0

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
    exit;
}