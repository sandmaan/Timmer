<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 5/4/2017
 * Time: 10:45 AM
 */

session_start();
include_once("../iConnect/handShake.php");
include_once ("../Functions/userCheck.php");

if ($_REQUEST["uId"] != "" && $_REQUEST["team"] != ""){
    $updUser = "UPDATE userlogin SET fName = :fName, lName = :lName, uName = :uName, uTeam = :uTeam, uRole = :uRole WHERE uId = :uId";
    $updUserQuery = $dbConnect -> prepare($updUser);
    $updUserQuery -> bindParam(':uId', $_REQUEST["uId"]);
    $updUserQuery -> bindParam(':fName', $_REQUEST["fName"]);
    $updUserQuery -> bindParam(':lName', $_REQUEST["lName"]);
    $updUserQuery -> bindParam(':uName', $_REQUEST["uName"]);
    $updUserQuery -> bindParam(':uTeam', $_REQUEST["team"]);
    $updUserQuery -> bindParam(':uRole', $_REQUEST["uRole"]);

    if ($updUserQuery -> execute()){
        $lastUid = $dbConnect -> lastInsertId();

        if ($_REQUEST["tl"] == "yes"){
            $addTl = "UPDATE teams SET tlName = :tlName, tlSet = :tlSet WHERE tId = :tId";
            $addTlQuery = $dbConnect -> prepare($addTl);
            $addTlQuery -> bindParam(':tId', $_REQUEST["team"]);
            $addTlQuery -> bindParam(':tlName', $lastUid);
            $addTlQuery -> bindParam(':tlSet', $_REQUEST["tl"]);

            if ($addTlQuery -> execute()){
                echo "12";
            }else{
                echo "11";
            }
        }else{
            echo "13";
        }
    }else{
        echo "3";
    }
}else{
    $updUser = "UPDATE userlogin SET fName = :fName, lName = :lName, uName = :uName, uRole = :uRole WHERE uId = :uId";
    $updUserQuery = $dbConnect -> prepare($updUser);
    $updUserQuery -> bindParam(':uId', $_REQUEST["uId"]);
    $updUserQuery -> bindParam(':fName', $_REQUEST["fName"]);
    $updUserQuery -> bindParam(':lName', $_REQUEST["lName"]);
    $updUserQuery -> bindParam(':uName', $_REQUEST["uName"]);
    $updUserQuery -> bindParam(':uRole', $_REQUEST["uRole"]);

    if ($updUserQuery -> execute()){
        $lastUid = $dbConnect -> lastInsertId();

        if ($_REQUEST["tl"] == "yes"){
            $addTl = "UPDATE teams SET tlName = :tlName, tlSet = :tlSet WHERE tId = :tId";
            $addTlQuery = $dbConnect -> prepare($addTl);
            $addTlQuery -> bindParam(':tId', $_REQUEST["team"]);
            $addTlQuery -> bindParam(':tlName', $lastUid);
            $addTlQuery -> bindParam(':tlSet', $_REQUEST["tl"]);

            if ($addTlQuery -> execute()){
                echo "12";
            }else{
                echo "11";
            }
        }else{
            echo "13";
        }
    }else{
        echo "3";
    }
}