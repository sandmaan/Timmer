<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 9/26/2017
 * Time: 4:53 PM
 */

include_once ("../iConnect/handShake.php");

$createDate = date("d-m-Y");
$createBy = "1";
$uRol = "1";
$uTeam = "1";

if (!empty($_REQUEST["uPass"]) && !empty($_REQUEST["uName"])) {

    $fName = cleanVar($_REQUEST["uFname"]);
    $lName = cleanVar($_REQUEST["uLname"]);
    $uName = cleanVar($_REQUEST["uName"]);
    $uPass = md5(cleanVar($_REQUEST["uPass"]));

    $addInitUser = "INSERT INTO userlogin (uCreateDate, createdBy, fName, lName, uName, pWord, uTeam, uRole) VALUES
                    (:uCreateDate, :uId, :fName, :lName, :uName, :pWord, :uTeam, :uRole)";
    $addInitUserQuery = $dbConnect -> prepare($addInitUser);
    $addInitUserQuery -> bindParam(':uCreateDate', $createDate, PDO::PARAM_STR);
    $addInitUserQuery -> bindParam(':uId', $createBy, PDO::PARAM_INT);
    $addInitUserQuery -> bindParam(':fName', $fName, PDO::PARAM_STR);
    $addInitUserQuery -> bindParam(':lName', $lName, PDO::PARAM_STR);
    $addInitUserQuery -> bindParam(':uName', $uName, PDO::PARAM_STR);
    $addInitUserQuery -> bindParam(':pWord', $uPass, PDO::PARAM_STR);
    $addInitUserQuery -> bindParam(':uTeam', $uTeam, PDO::PARAM_INT);
    $addInitUserQuery -> bindParam(':uRole', $uRol, PDO::PARAM_STR);

    if($addInitUserQuery -> execute()){
        echo "Saved";
    }else{
        echo "Error";
    }
}else{
    echo "Fields can't be empty";
}

function cleanVar($data){
    $notAllowedChar = array("$", "%", "#", "<", ">", "|","@","!","£","^","&");
    return str_replace($notAllowedChar,"",$data);
}