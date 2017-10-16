<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 4/12/2017
 * Time: 4:06 PM
 */

session_start();
include_once("../iConnect/handShake.php");

if (isset($_SESSION["uId"])){

    if (isset($_SESSION["tlSet"])){
        $chkLeader = "SELECT * FROM teams WHERE tlName = :uid";
        $chkLeaderQuery = $dbConnect -> prepare($chkLeader);
        $chkLeaderQuery -> bindParam(':uid', $_SESSION["uId"]);

        if ($chkLeaderQuery -> execute()){
            header("location:../TL/timmerTeamLeader.php");
        }
    }else{
        $getUtype = "SELECT * FROM userroles WHERE urId = :uRole";
        $getUtypeQuery = $dbConnect -> prepare($getUtype);
        $getUtypeQuery -> bindParam(':uRole',$_SESSION["uRole"]);
        $getUtypeQuery -> execute();
        $row = $getUtypeQuery -> fetch(PDO::FETCH_ASSOC);

        if ($row["userRole"] == "Admin"){
            header("location:../Admin/timmerAdmin.php");
        }elseif ($row["userRole"] == "Manager"){
            header("location:../Manager/timmerManager.php");
        }else{
            header("location:../User/timmerUser.php");
        }
    }

}else{
    session_destroy();
    header("location:index.php");
}