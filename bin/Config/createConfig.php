<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 9/22/2017
 * Time: 1:13 PM
 */

if(!empty($_REQUEST["dbUser"]) && !empty($_REQUEST["dbPass"]) && !empty($_REQUEST["dbName"]) && !empty($_REQUEST["dbHost"])){

    $dbDetails = array(
      'dbUser' => cleanVar($_REQUEST["dbUser"]),
      'dbPass' => cleanVar($_REQUEST["dbPass"]),
      'dbName' => cleanVar($_REQUEST["dbName"]),
      'dbHost' => cleanVar($_REQUEST["dbHost"])
    );
    $nf = fopen( '../iConnect/node.php', "w");
    fwrite($nf, serialize($dbDetails));

    $readFile = file_get_contents('../iConnect/node.php');
    $dataTxt = unserialize($readFile);

    if(!empty($dataTxt)){
        echo "Saved";
    }else{
        echo "Not Save";
    }
}elseif (!empty($_REQUEST["check"])){
    if(file_exists('../iConnect/node.php')){
        $readFile = file_get_contents('../iConnect/node.php');
        $dataTxt = unserialize($readFile);
        extract($dataTxt);

        try{
            $dbConnect = new PDO('mysql:host='.$dbHost.';dbname='.$dbName,$dbUser,$dbPass);
            $dbConnect -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected";

        }catch(PDOException $ex){
            echo "ERROR: ".$ex->getMessage();
            exit();
        }
    }else{
        echo "File missing";
    }
}else{
    echo "All fields must be filed.";
}

//Function to clear out unwanted characters from the incoming variables
function cleanVar($data){
    $notAllowedChar = array("$", "%", "#", "<", ">", "|","@","!","£","^","&");
    return str_replace($notAllowedChar,"",$data);
}