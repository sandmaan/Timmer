<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 4/26/2017
 * Time: 3:18 PM
 */
session_start();
include_once ("../Functions/userCheck.php");
?>

<html>
<head>
    <title></title>

    <!--  Style Sheets  -->
    <link rel="stylesheet" type="text/css" href="../../CSS/main.css">
    <!--  JavaScripts  -->
    <script language="JavaScript" type="text/javascript" src="../../jScripts/Libraries/jquery.min.js"></script>
    <script type="text/javascript" language="JavaScript" src="../../jScripts/userListFunctions.js"></script>
    <script type="text/javascript" language="JavaScript" src="../../jScripts/reload.js"></script>
    <script type="text/javascript" language="JavaScript" src="../../jScripts/setMsg.js"></script>
</head>
<body>
<div id="divDelMsg">
    <div>
        <a href="#" class="clsBtn">X</a>
    </div>
    <div id="divDelTxt">
        <label id="uid" hidden><?php echo $_REQUEST["uId"]; ?></label>
        <span style="font: normal bolder; color: red;">Are you sure you want to delete this user ?</span>
        <br><br>
        <span style="font: large bolder; color: red;">WARNING:</span>
        <span style="font: normal bolder; color: red;">If you delete this user the information <br>will be removed
            from the system permanently.</span><br><br>
        <label id="msgID" hidden></label>
        <input type="button" id="uDel" value="Delete" style="margin-left: 2%;" onclick="usrDelProcess();">
        <label id="msg" style="margin-left: -20%; pointer-events: none;"></label>
        <input type="button" id="cancel" value="Cancel" style="margin-left: 40%;">
    </div>
</div>
</body>
</html>