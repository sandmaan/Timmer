<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 10/16/2017
 * Time: 1:26 PM
 */
session_start();
include_once("../iConnect/handShake.php");
include_once ("../Functions/userCheck.php");
$match = "";
$wordList = array('break', 'interval', 'pause', 'intervall', 'breek', 'interval');

if (!empty($_REQUEST["date"])){
    foreach ($wordList as $wL) {
        $checkId = $dbConnect -> prepare("SELECT * FROM clientdb WHERE `Client` = :client");
        $checkId -> bindParam(':client', $wL, PDO::PARAM_STR);
        $checkId -> execute();
        $rowCoun = $checkId -> rowCount();

        if ($rowCoun > 0) {
            $matchRows = $checkId -> fetch(PDO::FETCH_ASSOC);
            $match = $matchRows["clientId"];
        }
    }

    $getProdTime = $dbConnect -> prepare("SELECT userlogin.uName,usrId, SEC_TO_TIME(SUM(TIME_TO_SEC(timeSpent))) AS totTime FROM usertimetrack
               LEFT JOIN userlogin ON usertimetrack.usrId = userlogin.uId WHERE jDate = :jdate AND utClient != :clId GROUP BY usrId");
    $getProdTime -> bindParam(':jdate', $_REQUEST["date"], PDO::PARAM_STR);
    $getProdTime -> bindParam(':clId', $match, PDO::PARAM_STR);
    $getProdTime -> execute();
    $prodRowCount = $getProdTime -> rowCount();
    if($prodRowCount > 0){
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
        <?php while ($prodRows = $getProdTime -> fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td><?php echo $prodRows["uName"] ?></td>
                <td><?php echo $prodRows["totTime"] ?></td>
                <td>
                    <input type="button" class="jDetail" value="See Job List" data-date="<?php echo $_REQUEST["date"]?>" data-usrid="<?php echo $prodRows["usrId"] ?>" onmousedown="popup();" />
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