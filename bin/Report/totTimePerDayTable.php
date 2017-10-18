<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 8/1/2017
 * Time: 10:09 AM
 */
session_start();
include_once("../iConnect/handShake.php");
include_once ("../Functions/userCheck.php");

if (!empty($_REQUEST["date"])){

    $getTot = "SELECT userlogin.uName,usrId, SEC_TO_TIME(SUM(TIME_TO_SEC(timeSpent))) AS totTime FROM usertimetrack
               LEFT JOIN userlogin ON usertimetrack.usrId = userlogin.uId WHERE jDate = :jdate GROUP BY usrId";
    $getTotQuery = $dbConnect -> prepare($getTot);
    $getTotQuery -> bindParam(':jdate', $_REQUEST["date"]);
    $getTotQuery -> execute();

    $getTotCount = $getTotQuery -> rowCount();
    if ($getTotCount > 0){
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
            <th scope="col" style="width: 10%;">Total Spent Time</th>
            <th scope="col" style="width: 10%;"></th>
        </tr>
        </thead>
        <tbody>
        <?php while ($getTotRow = $getTotQuery -> fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td><?php echo $getTotRow["uName"] ?></td>
                <td><?php echo $getTotRow["totTime"] ?></td>
                <td>
                    <input type="button" class="jDetail" value="See Job List" data-date="<?php echo $_REQUEST["date"]?>" data-usrid="<?php echo $getTotRow["usrId"] ?>" onmousedown="popup();" />
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php }else{ ?>
        <span id="noDataMsg">On <?php echo $_REQUEST["date"]; ?> there's no records to retrieve</span>
    <?php }}else{ ?>
        <span id="noDataMsg">Date not selected</span>
    <?php } ?>
</div>
</div>
</body>
</html>