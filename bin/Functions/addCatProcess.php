<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 7/27/2017
 * Time: 1:37 PM
 */

session_start();
include_once ("../Functions/userCheck.php");
include_once("../iConnect/handShake.php");

if ($_REQUEST["cName"] != ""){
    $checkCatName = "SELECT Catagory FROM catdb WHERE Catagory = :cName";
    $chkCatNameQry = $dbConnect -> prepare($checkCatName);
    $chkCatNameQry -> bindParam(':cName', $_REQUEST["cName"]);
    $chkCatNameQry -> execute();
    $rowCount = $chkCatNameQry -> rowCount();
    if ($rowCount <= 0){
        $addCat = "INSERT INTO catdb (uId, Catagory, createDate) VALUES (:uid, :cName, :cDate)";
        $addCatQuery = $dbConnect -> prepare($addCat);
        $addCatQuery -> bindParam(':uid', $_REQUEST["uId"]);
        $addCatQuery -> bindParam(':cName', $_REQUEST["cName"]);
        $addCatQuery -> bindParam(':cDate', $_REQUEST["cDate"]);

        if ($addCatQuery -> execute()){
            echo "1";
        }else{
            echo "10";
        }
    }else{
        echo "19";
    }

}else{
    echo "2";
}