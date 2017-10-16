<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 5/9/2017
 * Time: 12:29 PM
 */
session_start();
include_once("../iConnect/handShake.php");
include_once ("../Functions/userCheck.php");

if(isset($_REQUEST["uid"])){

    $pass = md5($_REQUEST["pass"]);

    $updUsrPass = "UPDATE userlogin SET pWord = :pass WHERE uId = :uid";
    $updUsrPassQuery = $dbConnect -> prepare($updUsrPass);
    $updUsrPassQuery -> bindParam(':uid', $_REQUEST["uid"]);
    $updUsrPassQuery -> bindParam(':pass', $pass);

    if($updUsrPassQuery -> execute()){
        echo "14";
    }else{
        echo "15";
    }

}else{
    echo "15";
}