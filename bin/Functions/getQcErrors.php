<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 8/24/2017
 * Time: 11:18 AM
 */

include_once("../iConnect/handShake.php");
if (!isset($_REQUEST["utid"])){
    //This will pull the QC errors from the qcError table.
    $getQcErrors = "SELECT qcId,qcError FROM qcErrors ORDER BY qcId ASC";
    $queryQcErrors = $dbConnect -> query($getQcErrors);
    $queryQcErrors -> execute();

    echo "<option selected disabled>----- Select Error -----</option>";
    while($rowQcError = $queryQcErrors -> fetch(PDO::FETCH_ASSOC)){
        echo "<option id=".$rowQcError["qcId"].">".$rowQcError["qcError"]."</option>";
    }
}else{
    $getQcErrors = "SELECT qcErrorId FROM usertimetrack WHERE utId  = :utid";
    $queryQcErrors = $dbConnect -> prepare($getQcErrors);
    $queryQcErrors -> bindParam(':utid', $_REQUEST["utid"]);
    $queryQcErrors -> execute();
    $rowQcError = $queryQcErrors -> fetch(PDO::FETCH_ASSOC);

    //Initiation of the error number counter
    $errorNo = 1;

    //Used to determine the last element of the table and this will set the last button as enabled
    $len_Array = explode(',',$rowQcError["qcErrorId"]);
    $lineCount = count($len_Array);

    if (!empty($rowQcError["qcErrorId"])){
        foreach (explode(',',$rowQcError["qcErrorId"])as $id){
            //Pull only the matched data set from the table
            $getQcErrors = "SELECT qcId,qcError FROM qcErrors WHERE qcId = :id ORDER BY qcId ASC";
            $queryQcErrors = $dbConnect -> prepare($getQcErrors);
            $queryQcErrors -> bindParam(':id', $id);
            $queryQcErrors -> execute();

            //Pulls the entire data set from the table
            $getQcError = "SELECT qcId,qcError FROM qcErrors ORDER BY qcId ASC";
            $queryQcError = $dbConnect -> query($getQcError);
            $queryQcError -> execute();

            while ($rowErrors = $queryQcErrors -> fetch(PDO::FETCH_ASSOC)){
                echo "<div class='error-container'>";
                echo "<input class='errorCount' size='1' value='".$errorNo."' style='margin-left: 2%' />";
                echo "<select id='errorName' class='errorName'>";
                echo "<option selected disabled>----- Select Error -----</option>";
                while($rowQcError = $queryQcError -> fetch(PDO::FETCH_ASSOC)){
                //If condition which is in brackets will mach the ID's from both queries and set's the selected option
                    echo "<option id=".$rowQcError["qcId"].' '.(($rowQcError["qcId"] == $rowErrors["qcId"])?'selected':"").'>'.$rowQcError["qcError"]."</option>";
                }
                echo "</select>";
                echo "<input class='errorId' size='1' name='errorId' value='".$rowErrors["qcId"]."' hidden readonly>";
                if ($errorNo == $lineCount){
                    echo "<input type='button' class='addRow' value='Add'/>";
                }else{
                    echo "<input type='button' class='addRow' value='Add' disabled/>";
                }
                echo "<input type='button' class='delRow' value='Delete' />";
                echo "</div>";
                $errorNo++;
            }
        }
    }else{
        echo "No data";
    }
}