<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 5/10/2017
 * Time: 10:47 AM
 */
include_once("../iConnect/handShake.php");

if (isset($_SESSION["uId"])){

    $getUroleName = "SELECT userRole FROM userroles WHERE urId = :urId";
    $getUroleNameQuery = $dbConnect -> prepare($getUroleName);
    $getUroleNameQuery -> bindParam(':urId', $_SESSION["uRole"]);
    $getUroleNameQuery -> execute();
    $row = $getUroleNameQuery -> fetch(PDO::FETCH_ASSOC);

    if (($row["userRole"] != "User" && $_SESSION["uRole"] != "4") &&
        ($row["userRole"] != "Admin" && $_SESSION["uRole"] != "1") &&
        ($row["userRole"] != "Manager" && $_SESSION["uRole"] != "2") &&
        ($row["userRole"] != "Team Leader" && $_SESSION["uRole"] != "3")){
        session_start();
        session_unset();
        session_destroy();

        header("location:../bin/index.php");
        exit();
    }

}else{
    session_start();
    session_unset();
    session_destroy();

    header("location:../index.php");
    exit();
}