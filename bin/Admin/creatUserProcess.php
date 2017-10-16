<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 4/7/2017
 * Time: 12:15 PM
 */
session_start();
include_once ("../Functions/userCheck.php");
include_once("../iConnect/handShake.php");

if (isset($_REQUEST["uId"])){
    //Have to use the intermediate variable as work around to warning massage
    // Strict standards: Only variables should be passed by reference
    $intPword = md5($_REQUEST["pword"]);

    $addUser = "INSERT INTO userlogin (uCreateDate, createdBy, fName, lName, uName, pWord, uTeam, uRole) VALUES (:uCreateDate, :uId, :fName, :lName, :uName, :pWord, :uTeam, :uRole)";
    $addUserQuery = $dbConnect -> prepare($addUser);
    $addUserQuery -> bindParam(':uCreateDate', $_REQUEST["udate"]);
    $addUserQuery -> bindParam(':uId', $_REQUEST["uId"]);
    $addUserQuery -> bindParam(':fName', $_REQUEST["fName"]);
    $addUserQuery -> bindParam(':lName', $_REQUEST["lName"]);
    $addUserQuery -> bindParam(':uName', $_REQUEST["uName"]);
    $addUserQuery -> bindParam(':pWord', $intPword);
    $addUserQuery -> bindParam(':uTeam', $_REQUEST["team"]);
    $addUserQuery -> bindParam(':uRole', $_REQUEST["uRole"]);

    if ($addUserQuery -> execute()){
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
        echo "1";
       }
    }else{
            echo "3";
        }
}