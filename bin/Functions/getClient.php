<?php

include_once("../iConnect/handShake.php");

if (isset($_REQUEST["utid"])){
    $getClient = "SELECT * FROM clientdb WHERE catId = :catId ORDER BY clientId ASC";
    $getClientQuery = $dbConnect -> prepare($getClient);
    $getClientQuery -> bindparam(':catId', $_REQUEST["cid"]);
    $getClientQuery -> execute();

    $getClientEdit = "SELECT usertimetrack.*, clientdb.* FROM usertimetrack
                  INNER JOIN clientdb ON usertimetrack.utClient = clientdb.clientId WHERE utId = :utid";
    $getClientEditQuery = $dbConnect -> prepare($getClientEdit);
    $getClientEditQuery -> bindparam(':utid', $_REQUEST["utid"]);
    $getClientEditQuery -> execute();
    $getClientEditRow = $getClientEditQuery -> fetch(PDO::FETCH_ASSOC);

    while ($row = $getClientQuery -> fetch(PDO::FETCH_ASSOC)){
        echo "<option id= ".$row["clientId"].' '.(($getClientEditRow["utClient"] == $getClientEditRow["clientId"])?'selected':"").'>'.$row["Client"]."</option>";
    }
}else{
    //Get clients from the data base according to the client category
    $getClient = "SELECT * FROM clientdb WHERE catId = :catId ORDER BY clientId ASC";
    $getClientQuery = $dbConnect -> prepare($getClient);
    $getClientQuery -> bindparam(':catId', $_REQUEST["cl"]);
    $getClientQuery -> execute();

    echo "<option selected disabled>----- Select Client -----</option>";
    while ($row = $getClientQuery -> fetch(PDO::FETCH_ASSOC)){
        echo "<option id= ".$row["clientId"].">".$row["Client"]."</option>";
    }
}