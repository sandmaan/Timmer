<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 4/20/2017
 * Time: 1:07 PM
 */

session_start();
include_once("../iConnect/handShake.php");


if (isset($_REQUEST["teamId"])){
    //Checks is the received team id already have team leader or not
    $getLead = "SELECT * FROM teams WHERE tId = :tId";
    $getLeadQuery = $dbConnect -> prepare($getLead);
    $getLeadQuery -> bindParam(':tId', $_REQUEST["teamId"]);
    $getLeadQuery -> execute();
    $leadRow = $getLeadQuery -> fetch(PDO::FETCH_ASSOC);

    if($leadRow["tlSet"] == "yes"){
        echo "set";
    }

}else{
    //Get categories from the data base and populate the category drop down
    if($_REQUEST["team"] = "getTeam"){
        $getTeam = "SELECT * FROM teams ORDER BY tId ASC";
        $getTeamQuery = $dbConnect -> query($getTeam);

        echo "<option></option>";
        while ($row = $getTeamQuery -> fetch(PDO::FETCH_ASSOC)){
            echo "<option id= ".$row["tId"].' '.(($_SESSION["uRole"] != "1" && $row["TeamName"] == "Admin")?'hidden':"").'>'. $row["TeamName"].'</option>';
        }
    }
}