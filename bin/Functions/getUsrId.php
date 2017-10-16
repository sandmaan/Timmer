<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 5/24/2017
 * Time: 1:48 PM
 */
include_once("../iConnect/handShake.php");

//Get user details from the data base and populate the user select drop down
if($_REQUEST["uid"] == "getUsr"){
    $getUsr = "SELECT * FROM userlogin ORDER BY uId ASC";
    $getUsrQuery = $dbConnect -> query($getUsr);

    echo "<option></option>";
    while ($row = $getUsrQuery -> fetch(PDO::FETCH_ASSOC)){
        echo "<option id= ".$row["uId"].">".$row["fName"]." ".$row["lName"]."</option>";
    }
}else{
    $getUsr = "SELECT * FROM userlogin ORDER BY uId ASC";
    $getUsrQuery = $dbConnect -> query($getUsr);

    $getSelUsr = "SELECT * FROM userlogin WHERE uId = :uid";
    $getSelUsrQuery = $dbConnect -> prepare($getSelUsr);
    $getSelUsrQuery -> bindValue(':uid', $_REQUEST["selUser"]);
    $getSelUsrQuery -> execute();
    $getSelUsrRow = $getSelUsrQuery -> fetch(PDO::FETCH_ASSOC);

    echo "<option id= ".$getSelUsrRow["uId"].">".$getSelUsrRow["fName"]." ".$getSelUsrRow["lName"]."</option>";
    while ($row = $getUsrQuery -> fetch(PDO::FETCH_ASSOC)){
        if ($row["uId"] == $_REQUEST["selUser"]) continue;
        echo "<option id= ".$row["uId"].">".$row["fName"]." ".$row["lName"]."</option>";
    }
}