<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 6/8/2017
 * Time: 11:54 AM
 */
session_start();
include_once("../iConnect/handShake.php");
include_once ("../Functions/userCheck.php");

if (isset($_REQUEST["utid"])){
    $delTime = "DELETE FROM usertimetrack WHERE utId = :utid";
    $delTimeQuery = $dbConnect -> prepare($delTime);
    $delTimeQuery -> bindParam(':utid', $_REQUEST["utid"]);

    if ($delTimeQuery -> execute()){
        echo "16";
    }else{
        echo "17";
    }
}else{
    echo "18";
}