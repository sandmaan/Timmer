<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 5/3/2017
 * Time: 9:55 AM
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
    if(isset($_REQUEST["tid"])){
        $getTeam = "SELECT * FROM teams ORDER BY tId ASC";
        $getTeamQuery = $dbConnect -> query($getTeam);

        echo "<option></option>";

        //Creates the drop down list options and set the selected value if in coming TID equals the one in the database
        //Used a ternary "?" operator which acts like an if ... else function
        while ($row = $getTeamQuery -> fetch(PDO::FETCH_ASSOC)){
            echo '<option id= "'.$row["tId"].'" '.(($row["tId"] == $_REQUEST["tid"])?'selected = "selected"':"").'"'.(($_SESSION["uRole"] != "1" && $row["TeamName"] == "Admin")?'hidden':"").'>'. $row["TeamName"].'</option>';
        }
    }
}