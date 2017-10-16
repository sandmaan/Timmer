<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 5/15/2017
 * Time: 9:40 AM
 */
session_start();
include_once("../iConnect/handShake.php");

if (isset($_REQUEST["db"]) && $_REQUEST["stat"] == "Active"){

    $chkData = "SELECT * FROM tempdb WHERE uId = :uid";
    $chkDataQuery = $dbConnect -> prepare($chkData);
    $chkDataQuery -> bindParam(':uid', $_REQUEST["uId"]);
    $chkDataQuery -> execute();

    if ($rowChk = $chkDataQuery -> fetch(PDO::FETCH_ASSOC)){

        $updTemp = "UPDATE tempdb SET catId =  :cat, clientId = :clientId, startTime = :stTime, Status = :stat WHERE uId = :uId";
        $updTempQuery = $dbConnect -> prepare($updTemp);
        $updTempQuery -> bindParam(':uId', $_REQUEST["uId"]);
        $updTempQuery -> bindParam(':cat', $_REQUEST["cat"]);
        $updTempQuery -> bindParam(':clientId', $_REQUEST["clientid"]);
        $updTempQuery -> bindParam(':stTime', $_REQUEST["stTime"]);
        $updTempQuery -> bindParam(':stat', $_REQUEST["stat"]);
        $updTempQuery -> execute();

    }else{

        $addToTemp = "INSERT INTO tempdb (uId , tId, catId, clientId, startTime, Status) VALUES (:uId, :tid, :cat, :clientId, :stTime, :stat)";
        $addToTempQuery = $dbConnect -> prepare($addToTemp);
        $addToTempQuery -> bindParam(':uId', $_REQUEST["uId"]);
        $addToTempQuery -> bindParam(':tid', $_REQUEST["tid"]);
        $addToTempQuery -> bindParam(':cat', $_REQUEST["cat"]);
        $addToTempQuery -> bindParam(':clientId', $_REQUEST["clientid"]);
        $addToTempQuery -> bindParam(':stTime', $_REQUEST["stTime"]);
        $addToTempQuery -> bindParam(':stat', $_REQUEST["stat"]);
        $addToTempQuery -> execute();

    }

}

if (isset($_REQUEST["db"]) && $_REQUEST["stat"] == "Finished"){
    $updStat = "UPDATE tempdb SET Status = :stat WHERE uId = :uId";
    $updStatQuery = $dbConnect -> prepare($updStat);
    $updStatQuery -> bindParam(':uId', $_REQUEST["uId"]);
    $updStatQuery -> bindParam(':stat', $_REQUEST["stat"]);
    $updStatQuery -> execute();

}