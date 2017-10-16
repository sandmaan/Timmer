<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 5/30/2017
 * Time: 1:12 PM
 */
session_start();
include_once("../iConnect/handShake.php");
include_once ("../Functions/userCheck.php");

$getTimeData = "SELECT usertimetrack.*, userlogin.uName, catdb.Catagory, clientdb.Client FROM usertimetrack
                INNER JOIN userlogin ON usertimetrack.usrId = userlogin.uId
                INNER JOIN catdb ON usertimetrack.Category = catdb.catId 
                INNER JOIN clientdb ON usertimetrack.utClient = clientdb.clientId WHERE utId = :utid";
$getTimeDataQuery = $dbConnect -> prepare($getTimeData);
$getTimeDataQuery -> bindParam(':utid', $_REQUEST["utid"]);
$getTimeDataQuery -> execute();
$getTimeDataRow = $getTimeDataQuery -> fetch(PDO::FETCH_ASSOC)
?>

<html>
<head>
    <title>Timer User Creation</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Style Sheets -->
    <link rel="stylesheet" type="text/css" href="../../CSS/main.css">

    <!-- Java Scripts -->
    <script language="JavaScript" type="text/javascript" src="../../jScripts/Libraries/jquery.min.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/reload.js"></script>
<!--    <script language="JavaScript" type="text/javascript" src="../../jScripts/timeEditResultFunctions.js"></script>-->
    <script language="JavaScript" type="text/javascript" src="../../jScripts/multiScript.js"></script>

</head>
<body>
<body>
<div class="popUpBox">
    <script language="JavaScript" type="text/javascript">
        getCat();
        setTimeout("chkClient()",100);
        setTimeout("getError2()",200);
    </script>
    <form name="clientTimeSheet" id="clientTimeSheet" method="post" enctype="multipart/form-data">
        <label id="fType" hidden>editForm</label>
        <!-- <label id="userName">Hello --><?php //echo $_SESSION["fName"]." ".$_SESSION["lName"]; ?><!--</label>-->
        <label id="utid" hidden><?php echo $_REQUEST["utid"] ?></label>
        <div class="logo-timeEdit-PopUp">
            <img src="../../images/logo.png" width="142" height="33">
            <a href="#" id="close-timeEdit" onmousedown="closBtn()">Close</a>
        </div>
        <br><br>
        <label for="date">Job Date:</label>
        <label id="date" style="margin-left:18px;"><?php echo $getTimeDataRow["jDate"]; ?></label>
        <br><br>
        <label for="catSelect">Category:</label>
        <select name="catSelect" id="catSelect" onChange="getClient(this.id); catId(this.id);"  style="margin-left:14px; width:180px"></select>
        <input type="text" id="cid" value="<?php echo $getTimeDataRow["Category"]; ?>" size="1" hidden>
        <input type="text" id="cateId" size="1" hidden>
        <label for="clientSelect" style="margin-left:14px;">Client:</label>
        <select name="clientSelect" id="clientSelect" onChange="clientId(this.id)" style="width:180px;"></select>
        <label for="jType" style="margin-left:14px;">Job Type:</label>
        <input type="radio" name="jType" class="jType" id="Processing" value="Processing" <?php if ($getTimeDataRow["jType"] == "Processing"){?>
            checked <?php } ?> >Processing
        <input type="radio" name="jType" class="jType" id="qc" value="QC" <?php if ($getTimeDataRow["jType"] == "QC"){?>
            checked <?php } ?> >QC
        <input type="text" id="clid" value="<?php echo $getTimeDataRow["utClient"]; ?>" size="1" hidden>
        <input type="text" id="clintId" size="1" hidden>
        <br><br>
        <label for="startTime">Start Time:</label>
        <input type="text" name="startTime" id="startTime" style="margin-left:7px;" size="8" value="<?php echo $getTimeDataRow["startTime"]; ?>">
        <button type="button" name="getStartTime" id="getStartTime" onMouseDown="getSvrTime()"  onMouseUp="startBtnDisable(); tmpDataAdd();" disabled>Get Time</button>
        <label for="endTime" style="margin-left:42px;">End Time:</label>
        <input type="text" name="endTime" id="endTime" size="8" value="<?php echo $getTimeDataRow["endTime"]; ?>">
        <button type="button" name="getEndTime" id="getEndTime" onMouseDown="getSvrEndTime()" onMouseUp="endBtnDisable(); timeDifference(endTime, startTime); statUpd();" disabled>Get Time</button>
        <label for="spentTime"  style="margin-left:30px;">Spent Time:</label>
        <input type="text" name="spentTime" id="spentTime" size="4" value="<?php echo $getTimeDataRow["timeSpent"]; ?>">
        <br><br>
        <label for="volume">Volume:</label>
        <input type="text" name="volume" id="volume" size="4" onkeyup="checkNum(this)" style="margin-left:23px;" value="<?php echo $getTimeDataRow["Volume"] ?>">
        <label for="noPl" style="margin-left: 35px;">No. of Product Lines:</label>
        <input type="text" name="noPl" id="noPl" size="4" onkeyup="checkNum(this)" value="<?php echo $getTimeDataRow["noOfProductLines"] ?>">
        <label for="remarks" style="margin-left:34px;">Remarks</label>
        <input type="text" name="remarks" id="remarks" size="31" value="<?php echo $getTimeDataRow["Remarks"] ?>">
        <br><br>
        <div id="jType-container" <?php if ($getTimeDataRow["jType"] == "QC"){?> style="display: block;" <?php } ?>>
            <div id="error-Add-Container">
                <div id="error-Column-Headings">
                    Error Number<span>Error Name</span>
                </div>
                <div class="error-Column" id="errorArea">
                    <!-- Code is inserted by using the JavaScript which retrieves the data -->
                    <!-- from the database-->
                </div>
            </div>
        </div>
        <label id="msgID" hidden></label>
        <div id="msg"></div>
        <div id="sbmBtns">
            <input type="button" value="Submit" name="submit" id="submit" class="btn">
        </div>
    </form>
</div>
</body>
</html>
