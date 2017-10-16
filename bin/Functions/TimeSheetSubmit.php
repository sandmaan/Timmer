<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 4/5/2017
 * Time: 11:24 AM
 */

include_once("../iConnect/handShake.php");

if(isset($_REQUEST["uId"])){

    if($_REQUEST["pl"] == "" && $_REQUEST["rem"] == ""){

        //This query will add all the data sent from the user front end form
        $addTimeSheetData = "INSERT INTO usertimetrack (jDate, usrId, Category, utClient, jType, startTime, endTime, timeSpent, Volume, qcErrorId)
VALUES (:jdate,:uId, :cat, :clientid, :jType, :stTime, :enTime, :spnTime, :vol, :errorId)";

        //Binding data to query
        $addTimeSheetQuery = $dbConnect -> prepare($addTimeSheetData);
        $addTimeSheetQuery -> bindParam(':jdate',$_REQUEST["jdate"]);
        $addTimeSheetQuery -> bindParam(':uId',$_REQUEST["uId"]);
        $addTimeSheetQuery -> bindParam(':cat',$_REQUEST["cat"]);
        $addTimeSheetQuery -> bindParam(':clientid',$_REQUEST["clientid"]);
        $addTimeSheetQuery -> bindParam(':jType',$_REQUEST["jType"]);
        $addTimeSheetQuery -> bindParam(':stTime',$_REQUEST["stTime"]);
        $addTimeSheetQuery -> bindParam(':enTime',$_REQUEST["enTime"]);
        $addTimeSheetQuery -> bindParam(':spnTime',$_REQUEST["spnTime"]);
        $addTimeSheetQuery -> bindParam(':vol',$_REQUEST["vol"]);
        $addTimeSheetQuery -> bindParam(':errorId',$_REQUEST["errorId"]);

    }elseif ($_REQUEST["rem"] == ""){

        //This query will add all the data sent from the user front end form
        $addTimeSheetData = "INSERT INTO usertimetrack (jDate, usrId, Category, utClient, jType, startTime, endTime, timeSpent, Volume, qcErrorId, noOfProductLines)
VALUES (:jdate,:uId, :cat, :clientid, :jType, :stTime, :enTime, :spnTime, :vol, :errorId, :pl)";

        //Binding data to query
        $addTimeSheetQuery = $dbConnect -> prepare($addTimeSheetData);
        $addTimeSheetQuery -> bindParam(':jdate',$_REQUEST["jdate"]);
        $addTimeSheetQuery -> bindParam(':uId',$_REQUEST["uId"]);
        $addTimeSheetQuery -> bindParam(':cat',$_REQUEST["cat"]);
        $addTimeSheetQuery -> bindParam(':clientid',$_REQUEST["clientid"]);
        $addTimeSheetQuery -> bindParam(':jType',$_REQUEST["jType"]);
        $addTimeSheetQuery -> bindParam(':stTime',$_REQUEST["stTime"]);
        $addTimeSheetQuery -> bindParam(':enTime',$_REQUEST["enTime"]);
        $addTimeSheetQuery -> bindParam(':spnTime',$_REQUEST["spnTime"]);
        $addTimeSheetQuery -> bindParam(':vol',$_REQUEST["vol"]);
        $addTimeSheetQuery -> bindParam(':errorId',$_REQUEST["errorId"]);
        $addTimeSheetQuery -> bindParam(':pl',$_REQUEST["pl"]);

    }elseif ($_REQUEST["pl"] == ""){

        //This query will add all the data sent from the user front end form
        $addTimeSheetData = "INSERT INTO usertimetrack (jDate, usrId, Category, utClient, jType, startTime, endTime, timeSpent, Volume, qcErrorId, Remarks)
VALUES (:jdate,:uId, :cat, :clientid, :jType, :stTime, :enTime, :spnTime, :vol, :errorId, :rem)";

        //Binding data to query
        $addTimeSheetQuery = $dbConnect -> prepare($addTimeSheetData);
        $addTimeSheetQuery -> bindParam(':jdate',$_REQUEST["jdate"]);
        $addTimeSheetQuery -> bindParam(':uId',$_REQUEST["uId"]);
        $addTimeSheetQuery -> bindParam(':cat',$_REQUEST["cat"]);
        $addTimeSheetQuery -> bindParam(':clientid',$_REQUEST["clientid"]);
        $addTimeSheetQuery -> bindParam(':jType',$_REQUEST["jType"]);
        $addTimeSheetQuery -> bindParam(':stTime',$_REQUEST["stTime"]);
        $addTimeSheetQuery -> bindParam(':enTime',$_REQUEST["enTime"]);
        $addTimeSheetQuery -> bindParam(':spnTime',$_REQUEST["spnTime"]);
        $addTimeSheetQuery -> bindParam(':vol',$_REQUEST["vol"]);
        $addTimeSheetQuery -> bindParam(':errorId',$_REQUEST["errorId"]);
        $addTimeSheetQuery -> bindParam(':rem',$_REQUEST["rem"]);


    }else{

        //This query will add all the data sent from the user front end form
        $addTimeSheetData = "INSERT INTO usertimetrack (jDate, usrId, Category, utClient, jType, startTime, endTime, timeSpent, Volume, qcErrorId, noOfProductLines, Remarks)
VALUES (:jdate,:uId, :cat, :clientid, :jType, :stTime, :enTime, :spnTime, :vol, :errorId, :pl, :rem)";

        //Binding data to query
        $addTimeSheetQuery = $dbConnect -> prepare($addTimeSheetData);
        $addTimeSheetQuery -> bindParam(':jdate',$_REQUEST["jdate"]);
        $addTimeSheetQuery -> bindParam(':uId',$_REQUEST["uId"]);
        $addTimeSheetQuery -> bindParam(':cat',$_REQUEST["cat"]);
        $addTimeSheetQuery -> bindParam(':clientid',$_REQUEST["clientid"]);
        $addTimeSheetQuery -> bindParam(':jType',$_REQUEST["jType"]);
        $addTimeSheetQuery -> bindParam(':stTime',$_REQUEST["stTime"]);
        $addTimeSheetQuery -> bindParam(':enTime',$_REQUEST["enTime"]);
        $addTimeSheetQuery -> bindParam(':spnTime',$_REQUEST["spnTime"]);
        $addTimeSheetQuery -> bindParam(':vol',$_REQUEST["vol"]);
        $addTimeSheetQuery -> bindParam(':errorId',$_REQUEST["errorId"]);
        $addTimeSheetQuery -> bindParam(':pl',$_REQUEST["pl"]);
        $addTimeSheetQuery -> bindParam(':rem',$_REQUEST["rem"]);

    }
    if($addTimeSheetQuery -> execute()){
        echo "1";
    }else{
        echo "10";
    }

}elseif (isset($_REQUEST["utid"])){

    if($_REQUEST["pl"] == "" && $_REQUEST["rem"] == ""){

        //This query will add all the data sent from the user front end form
        $addTimeSheetData = "UPDATE usertimetrack SET jDate = :jdate, Category = :cat,
                             utClient = :clientid, jType = :jType, startTime = :stTime, endTime = :enTime,
                             timeSpent = :spnTime, Volume = :vol, qcErrorId = :errorId WHERE utId = :utid";
        //Binding data to query
        $addTimeSheetQuery = $dbConnect -> prepare($addTimeSheetData);
        $addTimeSheetQuery -> bindParam(':jdate',$_REQUEST["jdate"]);
        $addTimeSheetQuery -> bindParam(':cat',$_REQUEST["cat"]);
        $addTimeSheetQuery -> bindParam(':clientid',$_REQUEST["clientid"]);
        $addTimeSheetQuery -> bindParam(':jType',$_REQUEST["jType"]);
        $addTimeSheetQuery -> bindParam(':stTime',$_REQUEST["stTime"]);
        $addTimeSheetQuery -> bindParam(':enTime',$_REQUEST["enTime"]);
        $addTimeSheetQuery -> bindParam(':spnTime',$_REQUEST["spnTime"]);
        $addTimeSheetQuery -> bindParam(':vol',$_REQUEST["vol"]);
        $addTimeSheetQuery -> bindParam(':errorId',$_REQUEST["errorId"]);
        $addTimeSheetQuery -> bindParam(':utid', $_REQUEST["utid"]);

    }elseif ($_REQUEST["rem"] == ""){

        //This query will add all the data sent from the user front end form
        $addTimeSheetData = "UPDATE usertimetrack SET jDate = :jdate, Category = :cat,
                             utClient = :clientid, jType = :jType, startTime = :stTime, endTime = :enTime,
                             timeSpent = :spnTime, Volume = :vol, qcErrorId = :errorId, noOfProductLines = :pl WHERE utId = :utid";

        //Binding data to query
        $addTimeSheetQuery = $dbConnect -> prepare($addTimeSheetData);
        $addTimeSheetQuery -> bindParam(':jdate',$_REQUEST["jdate"]);
        $addTimeSheetQuery -> bindParam(':cat',$_REQUEST["cat"]);
        $addTimeSheetQuery -> bindParam(':clientid',$_REQUEST["clientid"]);
        $addTimeSheetQuery -> bindParam(':jType',$_REQUEST["jType"]);
        $addTimeSheetQuery -> bindParam(':stTime',$_REQUEST["stTime"]);
        $addTimeSheetQuery -> bindParam(':enTime',$_REQUEST["enTime"]);
        $addTimeSheetQuery -> bindParam(':spnTime',$_REQUEST["spnTime"]);
        $addTimeSheetQuery -> bindParam(':vol',$_REQUEST["vol"]);
        $addTimeSheetQuery -> bindParam(':errorId',$_REQUEST["errorId"]);
        $addTimeSheetQuery -> bindParam(':pl',$_REQUEST["pl"]);
        $addTimeSheetQuery -> bindParam(':utid', $_REQUEST["utid"]);

    }elseif ($_REQUEST["pl"] == ""){

        //This query will add all the data sent from the user front end form
        $addTimeSheetData = "UPDATE usertimetrack SET jDate = :jdate, Category = :cat,
                             utClient = :clientid, jType = :jType, startTime = :stTime, endTime = :enTime,
                             timeSpent = :spnTime, Volume = :vol, qcErrorId = :errorId, Remarks = :rem WHERE utId = :utid";

        //Binding data to query
        $addTimeSheetQuery = $dbConnect -> prepare($addTimeSheetData);
        $addTimeSheetQuery -> bindParam(':jdate',$_REQUEST["jdate"]);
        $addTimeSheetQuery -> bindParam(':cat',$_REQUEST["cat"]);
        $addTimeSheetQuery -> bindParam(':clientid',$_REQUEST["clientid"]);
        $addTimeSheetQuery -> bindParam(':jType',$_REQUEST["jType"]);
        $addTimeSheetQuery -> bindParam(':stTime',$_REQUEST["stTime"]);
        $addTimeSheetQuery -> bindParam(':enTime',$_REQUEST["enTime"]);
        $addTimeSheetQuery -> bindParam(':spnTime',$_REQUEST["spnTime"]);
        $addTimeSheetQuery -> bindParam(':vol',$_REQUEST["vol"]);
        $addTimeSheetQuery -> bindParam(':errorId',$_REQUEST["errorId"]);
        $addTimeSheetQuery -> bindParam(':rem',$_REQUEST["rem"]);
        $addTimeSheetQuery -> bindParam(':utid', $_REQUEST["utid"]);


    }else{

        //This query will add all the data sent from the user front end form
        $addTimeSheetData = "UPDATE usertimetrack SET jDate = :jdate, Category = :cat,
                             utClient = :clientid, jType = :jType, startTime = :stTime, endTime = :enTime,
                             timeSpent = :spnTime, Volume = :vol, qcErrorId = :errorId, noOfProductLines = :pl, Remarks = :rem
                             WHERE utId = :utid";

        //Binding data to query
        $addTimeSheetQuery = $dbConnect -> prepare($addTimeSheetData);
        $addTimeSheetQuery -> bindParam(':jdate',$_REQUEST["jdate"]);
        $addTimeSheetQuery -> bindParam(':cat',$_REQUEST["cat"]);
        $addTimeSheetQuery -> bindParam(':clientid',$_REQUEST["clientid"]);
        $addTimeSheetQuery -> bindParam(':jType',$_REQUEST["jType"]);
        $addTimeSheetQuery -> bindParam(':stTime',$_REQUEST["stTime"]);
        $addTimeSheetQuery -> bindParam(':enTime',$_REQUEST["enTime"]);
        $addTimeSheetQuery -> bindParam(':spnTime',$_REQUEST["spnTime"]);
        $addTimeSheetQuery -> bindParam(':vol',$_REQUEST["vol"]);
        $addTimeSheetQuery -> bindParam(':errorId',$_REQUEST["errorId"]);
        $addTimeSheetQuery -> bindParam(':pl',$_REQUEST["pl"]);
        $addTimeSheetQuery -> bindParam(':rem',$_REQUEST["rem"]);
        $addTimeSheetQuery -> bindParam(':utid', $_REQUEST["utid"]);

    }

    if($addTimeSheetQuery -> execute()){
        echo "1";
    }else{
        echo "10";
    }

}else{
    echo "3";
}