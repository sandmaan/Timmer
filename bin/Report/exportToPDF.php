<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 8/3/2017
 * Time: 2:44 PM
 */

require('../Libraries/fpdf/fpdf.php');
include_once ('../iConnect/handShake.php');

class h4PDF extends FPDF{
    function Header(){
        $this->Image('../../images/logo.png', 10,6,30);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(80);
        $this->Cell(50, 10, 'Total Spent Time', 0, 0,'C');
        $this->Ln(10);

        $this->SetFont('Arial','', 14);
        $this->SetFillColor(255,0,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128,0,0);
        $this->SetX(74);
        $this->Cell(40,6,'User Name',1,0,'C',1);
        $this->SetX(109);
        $this->SetX(114);
        $this->Cell(42,6,'Total Spent Time',1,0,'C',1);
        $this->Ln();
    }
}

if ($_REQUEST["date"] != ""){
    $getTot = "SELECT userlogin.uName, SEC_TO_TIME(SUM(TIME_TO_SEC(timeSpent))) AS totTime FROM usertimetrack
           LEFT JOIN userlogin ON usertimetrack.usrId = userlogin.uId WHERE jDate = :jdate GROUP BY usrId";
    $getTotQuery = $dbConnect -> prepare($getTot);
    $getTotQuery -> bindParam('jdate', $_REQUEST["date"]);
    $getTotQuery -> execute();

    if ($getTotQuery -> rowCount() > 0){
        $fName = "UsrTotalTime_" . $_REQUEST["date"] . ".pdf";

        $pdf = new h4PDF();
        $pdf->AddPage();

        $pdf->SetFont('Arial','', 14);
        $pdf->SetFillColor(255,0,0);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(128,0,0);
        $pdf->SetLineWidth(.1);
        $pdf->SetFont('','B');

        $pdf->SetFillColor(224,235,255);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');

        $fill = false;
        while ($getTotRow = $getTotQuery -> fetch(PDO::FETCH_ASSOC)){
            $uName = $getTotRow["uName"];
            $totTime = $getTotRow["totTime"];

            $pdf->SetX(74);
            $pdf->Cell(40,6,$uName,'1',0,'C',$fill);
            $pdf->SetX(109);
            $pdf->SetX(114);
            $pdf->Cell(42,6,$totTime ,'1',0,'C',$fill);
            $pdf->Ln();
            $fill = !$fill;
        }

        $pdf->Output("D",$fName);
    }else{
        echo "On " .$_REQUEST["date"]. " there's no records to retrieve";
    }
}else{
    echo "Date not selected";
}