<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 7/27/2017
 * Time: 2:54 PM
 */

session_start();
include_once("../iConnect/handShake.php");
include_once ("../Functions/userCheck.php");

$getUserRole = "SELECT * FROM userroles ORDER BY urId ASC";
$getUserRoleQuery = $dbConnect -> query($getUserRole);
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
    <script language="javascript" type="text/javascript" src="../../jScripts/svrTimeDate.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/reload.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/setMsg.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/addClientFunctions.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/multiScript.js"></script>
    <script language="javascript" type="text/javascript" src="../../jScripts/getCat.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/getIds.js"></script>
</head>
<body onload="pauseLoad()">
<div id="divCenter" class="box">
    <label id="userName" hidden>Hello <?php echo $_SESSION["fName"]." ".$_SESSION["lName"]; ?></label><br><br>
    <label id="uId" hidden><?php echo $_SESSION["uId"] ?></label>
    <label id="utid" hidden></label>
    <div style="width: 166px; position: absolute; left: 642px; top: 20px; height: 44px;">
        <img src="../../images/logo.png" width="142" height="33">
    </div>
    <label for="date">Date:</label>
    <label id="date" style="margin-left: 50px;"></label><br/><br/>
    <label for="catSelect">Category:</label>
    <select name="catSelect" id="catSelect" onFocus="" onChange="catId(this.id);"  style="margin-left:14px; width:180px"></select>
    <input id="cateId" size="1" hidden>
    <label for="clName" style="margin-left: 50px;">Client Name:</label>
    <input id="clName" name="clName" style="margin-left: 10px;"><br/><br/>
    <label id="msgID" hidden></label>
    <div id="msg"></div>
    <div id="sbmBtns">
        <input type="button" value="Reset" name="reset" id="reset" class="btn" onclick="resetForm()">
        <input type="button" value="Submit" name="submit" id="submit" class="btn" onclick="addClnBtn()">
    </div>
</div>
</body>
</html>