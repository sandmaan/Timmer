<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 7/27/2017
 * Time: 11:28 AM
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
    <script language="JavaScript" type="text/javascript" src="../../jScripts/addCatFunctions.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/multiScript.js"></script>

</head>
<body onload="getSvrDate()">
<div id="divCenter" class="box">
    <label id="userName" hidden>Hello <?php echo $_SESSION["fName"]." ".$_SESSION["lName"]; ?></label><br><br>
    <label id="uId" hidden><?php echo $_SESSION["uId"] ?></label>
    <div style="width: 166px; position: absolute; left: 642px; top: 20px; height: 44px;">
        <img src="../../images/logo.png" width="142" height="33">
    </div>
    <label for="date">Date:</label>
    <label id="date" style="margin-left: 50px;"></label>
    <label for="cName" style="margin-left: 50px;">Category Name:</label>
    <input id="cName" name="cName" style="margin-left: 10px;">
    <label id="msgID" hidden></label>
    <div id="msg"></div>
    <div id="sbmBtns">
        <input type="button" value="Reset" name="reset" id="reset" class="btn" onclick="resetForm()">
        <input type="button" value="Submit" name="submit" id="submit" class="btn" onclick="addCatBtn()">
    </div>
</div>
</body>
</html>