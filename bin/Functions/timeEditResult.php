<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 5/24/2017
 * Time: 10:53 AM
 */
session_start();
include_once("../iConnect/handShake.php");
include_once ("../Functions/userCheck.php");

if ($_REQUEST["date"] != "" && $_REQUEST["uid"] != ""){

//  Add Search terms to search term database to retrieve later
    $addSearch = "INSERT INTO searchterm(sDate,sUid,searchedBy) VALUES (:sDate, :sUid, :sb)";
    $addSearchQuery = $dbConnect -> prepare($addSearch);
    $addSearchQuery -> bindParam(':sDate', $_REQUEST["date"]);
    $addSearchQuery -> bindParam(':sUid', $_REQUEST["uid"]);
    $addSearchQuery -> bindParam(':sb', $_REQUEST["sbId"]);

    if ($addSearchQuery -> execute()){
//      Get's the last entered search ID
        $lastSid = $dbConnect -> lastInsertId();
        $_SESSION["lSid"] = $lastSid;

        $_SESSION["sT"] = "Done";
    }else{
        $_SESSION["sT"] = "Not";
    }

//  Check if the there's any data in the database if there is it will be passed on to the query
    $getCount = "SELECT COUNT(*) FROM usertimetrack WHERE jDate = :jDate AND usrId = :usrId";
    $getCountQuery = $dbConnect -> prepare($getCount);
    $getCountQuery -> bindParam(':jDate', $_REQUEST["date"]);
    $getCountQuery -> bindParam(':usrId', $_REQUEST["uid"]);
    $getCountQuery -> execute();
    $rowCount = $getCountQuery -> fetchColumn();

    if ($rowCount > 0){
//      This will select all the details in the database according to the entered data and the user who entered it
//      Which will be displayed as a table in the main PHP file.
        $getJobs = "SELECT usertimetrack.*, userlogin.uName, catdb.Catagory, clientdb.Client FROM usertimetrack
                    INNER JOIN userlogin ON usertimetrack.usrId = userlogin.uId
                    INNER JOIN catdb ON usertimetrack.Category = catdb.catId 
                    INNER JOIN clientdb ON usertimetrack.utClient = clientdb.clientId
                    WHERE jDate = :jDate AND usrId = :usrId";
        $getJobsQuery = $dbConnect -> prepare($getJobs);
        $getJobsQuery -> bindParam(':jDate', $_REQUEST["date"]);
        $getJobsQuery -> bindParam(':usrId', $_REQUEST["uid"]);
        $getJobsQuery -> execute();
?>
<html>
<head>
    <!--Empty head-->
</head>
<body>
    <div id="mainDiv">
        <div id="navi"></div>
        <div id="infoi"></div>
        <table id="hor-minimalist-b" style="table-layout: fixed; width: 96%; margin-left: 2%;">
            <div id="bgDimmer"></div>
            <div id="divContent" style="width: 65%; margin-left: 20%; margin-top: -8%;"></div>
            <thead>
            <tr>
                <th scope="col" style="width: 6%;">User Name</th>
                <th scope="col" style="width: 10%;">Category</th>
                <th scope="col" style="width: 10%;">Client</th>
                <th scope="col" style="width: 6%;">Start Time</th>
                <th scope="col" style="width: 6%;">End Time</th>
                <th scope="col" style="width: 6%;">Time Spent</th>
                <th scope="col" style="width: 6%;">Volume</th>
                <th scope="col" style="width: 6%;">Prod. Lines</th>
                <th scope="col" style="width: 16%;">Remarks</th>
                <th scope="col" style="width: 10%;"></th>
            </tr>
            </thead>
            <tbody>
            <?php while ($getJobsRow = $getJobsQuery -> fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td><?php echo $getJobsRow["uName"]; ?></td>
                    <td><?php echo $getJobsRow["Catagory"]; ?></td>
                    <td style="word-wrap:break-word;"><?php echo $getJobsRow["Client"]; ?></td>
                    <td><?php echo $getJobsRow["startTime"]; ?></td>
                    <td><?php echo $getJobsRow["endTime"]; ?></td>
                    <td><?php echo $getJobsRow["timeSpent"]; ?></td>
                    <td><?php echo $getJobsRow["Volume"]; ?></td>
                    <td><?php echo $getJobsRow["noOfProductLines"]; ?></td>
                    <td style="word-wrap:break-word; text-align: left"><?php echo $getJobsRow["Remarks"]; ?></td>
                    <td>
                        <input type="button" class="utEdit" value="Edit" data-utid="<?php echo $getJobsRow["utId"]; ?>" onmousedown="popup();" />
                        <input type="button" class="utDel" value="Delete" data-utid="<?php echo $getJobsRow["utId"]; ?>" onmousedown="popup();" /></a>
                    </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
        <?php }else{ ?>
            <span id="noDataMsg">There's no data to display</span>
        <?php }}else{ ?>
            <span id="noDataMsg">User or date not selected</span>
        <?php } ?>
    </div>
</div>
</body>
</html>