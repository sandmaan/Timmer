<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 5/15/2017
 * Time: 1:00 PM
 */

if (isset($_SESSION["uId"])){

    $getUroleName = "SELECT userRole FROM userroles WHERE urId = :urId";
    $getUroleNameQuery = $dbConnect -> prepare($getUroleName);
    $getUroleNameQuery -> bindParam(':urId', $_SESSION["uRole"]);
    $getUroleNameQuery -> execute();
    $row = $getUroleNameQuery -> fetch(PDO::FETCH_ASSOC);

    if (($row["userRole"] != "Admin" && $_SESSION["uRole"] != "1") &&
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