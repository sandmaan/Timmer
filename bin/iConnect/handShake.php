<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if(file_exists(__DIR__ . './node.php')){
    $readFile = file_get_contents('../iConnect/node.php');
    $dataTxt = unserialize($readFile);
    extract($dataTxt);

    try{
        $dbConnect = new PDO('mysql:host='.$dbHost.';dbname='.$dbName,$dbUser,$dbPass);
        $dbConnect -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $ex){
        echo "ERROR: ".$ex->getMessage();
        exit();
    }
}else{
    echo "System configuration is not done. Can't connect to database.";
}

//include_once ("node.php");
//
//try{
//        $dbConnect = new PDO('mysql:host='.$dbHost.';dbname='.$dbName,$dbUser,$dbPass);
//        $dbConnect -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    }catch(PDOException $ex){
//        echo "ERROR: ".$ex->getMessage();
//        exit();
//    }