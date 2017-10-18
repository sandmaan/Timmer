<?php

include_once("../iConnect/handShake.php");

//Get categories from the data base and populate the category drop down
//This process will check if both cat and utid are set first part will only run if both variables are set
if(!empty($_REQUEST["cat"]) && !empty($_REQUEST["utid"])){

//  This will get populate the editing forms drop down and will set the selected value by default using the if command
//  When if set the default selection while will keep on running using the while and the top part of the sql
	$getCat = "SELECT * FROM catdb ORDER BY catId ASC";
	$getCatQuery = $dbConnect -> query($getCat);

//	Inner join has been used to join the two databases catdb and the usertimetrack. catdb is inner joined to
//  usertimetrack by category because it that colum contains the category ID of the category in catdb.
	$getCatEdit = "SELECT usertimetrack.*, catdb.catId FROM usertimetrack
                   INNER JOIN catdb ON usertimetrack.Category = catdb.catId WHERE utId  = :utid";
	$getCatEditQuery = $dbConnect -> prepare($getCatEdit);
	$getCatEditQuery -> bindParam(':utid', $_REQUEST["utid"]);
	$getCatEditQuery -> execute();
	$getCatEditRow = $getCatEditQuery -> fetch(PDO::FETCH_ASSOC);

//  echo "<option selected >----- Select Category -----</option>";
	while ($row = $getCatQuery -> fetch(PDO::FETCH_ASSOC)){
		echo "<option id= ".$row["catId"].' '.(($getCatEditRow["Category"] == $getCatEditRow["catId"])?'selected':"").'>'.$row["Catagory"]."</option>";
//		I'm using the if operator to set the selected HTML attribute
 }
}else{
//  This is to populate the time entry forms category drop down this won't be used in the time entry editing form's
//  to populate editing forms drop down the top part of the if...else will be used
    $getCat = "SELECT * FROM catdb ORDER BY catId ASC";
    $getCatQuery = $dbConnect -> query($getCat);

    echo "<option selected disabled>----- Select Category -----</option>";
    while ($row = $getCatQuery -> fetch(PDO::FETCH_ASSOC)){
        echo "<option id= ".$row["catId"].">".$row["Catagory"]."</option>";
    }
}