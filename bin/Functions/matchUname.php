<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 4/24/2017
 * Time: 3:32 PM
 */

include_once("../iConnect/handShake.php");

if (isset($_REQUEST["uName"])){

    $getUname = "SELECT uName FROM userlogin WHERE uName = :uName";
    $getUnameQuery = $dbConnect -> prepare($getUname);
    $getUnameQuery -> bindParam(':uName', $_REQUEST["uName"]);
    $getUnameQuery -> execute();

    if ($row = $getUnameQuery -> fetch(PDO::FETCH_ASSOC)){
        echo "1";
    }else{
        echo "2";
    }

}