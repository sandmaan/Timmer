<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 5/10/2017
 * Time: 10:44 AM
 */
include_once("../iConnect/handShake.php");

//User check
if (isset($_SESSION["uRole"])){

    $getUroleName = "SELECT userRole FROM userroles WHERE urId = :urId";
    $getUroleNameQuery = $dbConnect -> prepare($getUroleName);
    $getUroleNameQuery -> bindParam(':urId', $_SESSION["uRole"]);
    $getUroleNameQuery -> execute();
    $row = $getUroleNameQuery -> fetch(PDO::FETCH_ASSOC);

    if (($row["userRole"] != "Admin" && $_SESSION["uRole"] != "1")){

        session_start();
        session_unset();
        session_destroy();

        header("location:../index.php");
        exit();
    }

}else{
    session_start();
    session_unset();
    session_destroy();

    header("location:../index.php");
    exit();
}