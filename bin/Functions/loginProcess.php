<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 4/12/2017
 * Time: 12:35 PM
 */

session_start();
include_once("../iConnect/handShake.php");

if (!isset($_REQUEST["pWord"])){
    $loginUname = "SELECT uName FROM userlogin WHERE uName = :uName";
    $loginUnameQuery = $dbConnect -> prepare($loginUname);
    $loginUnameQuery -> bindParam(':uName', $_REQUEST["uName"]);
    $loginUnameQuery -> execute();

    if ($row = $loginUnameQuery -> fetch(PDO::FETCH_ASSOC)){
        echo "1";
    }else{
        echo "2";
    }
}else{
    $inmPword = md5($_REQUEST["pWord"]);

    $loginData = "SELECT * FROM userlogin WHERE uName = :uName AND pWord = :pWord";
    $loginDataQuery = $dbConnect -> prepare($loginData);
    $loginDataQuery -> bindParam(':uName', $_REQUEST["uName"]);
    $loginDataQuery -> bindParam(':pWord', $inmPword);
    $loginDataQuery -> execute();

    if ($row = $loginDataQuery -> fetch(PDO::FETCH_ASSOC)){

        $chkLeader = "SELECT * FROM teams WHERE tlName = :uid";
        $chkLeaderQuery = $dbConnect -> prepare($chkLeader);
        $chkLeaderQuery -> bindParam(':uid', $row["uId"]);
        $chkLeaderQuery -> execute();

        if ($leaderRow = $chkLeaderQuery -> fetch(PDO::FETCH_ASSOC)){
            //Time to set the session
            $_SESSION["uId"] = $row["uId"];
            $_SESSION["uRole"] = $row["uRole"];
            $_SESSION["fName"] = $row["fName"];
            $_SESSION["lName"] = $row["lName"];
            $_SESSION["uTeam"] = $row["uTeam"];
            $_SESSION["tlSet"] = $leaderRow["tlSet"];
        }else{
            $_SESSION["uId"] = $row["uId"];
            $_SESSION["uRole"] = $row["uRole"];
            $_SESSION["fName"] = $row["fName"];
            $_SESSION["lName"] = $row["lName"];
            $_SESSION["uTeam"] = $row["uTeam"];
        }
       echo "3";
    }else{
        session_unset();
        session_destroy();
        echo "4";
        exit();
    }
}