<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 7/28/2017
 * Time: 10:27 AM
 */

session_start();
include_once ("../Functions/userCheck.php");
include_once("../iConnect/handShake.php");

if ($_REQUEST["catId"] && $_REQUEST["clName"]){
    $chkClient = "SELECT Client, catId FROM clientdb WHERE Client = :client AND catId = :catId";
    $chkClientQry = $dbConnect -> prepare($chkClient);
    $chkClientQry -> bindParam(':client', $_REQUEST["clName"]);
    $chkClientQry -> bindParam(':catId', $_REQUEST["catId"]);
    $chkClientQry -> execute();
    $clRowCount = $chkClientQry -> rowCount();

    if ($clRowCount <= 0){
        $addClient = "INSERT INTO clientdb (catId, uId, Client, cDate) VALUES (:catId, :uid, :client, :cDate)";
        $addCltQry = $dbConnect -> prepare($addClient);
        $addCltQry -> bindParam(':catId', $_REQUEST["catId"]);
        $addCltQry -> bindParam(':uid', $_REQUEST["uId"]);
        $addCltQry -> bindParam(':client', $_REQUEST["clName"]);
        $addCltQry -> bindParam(':cDate', $_REQUEST["cDate"]);

        if ($addCltQry -> execute()){
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