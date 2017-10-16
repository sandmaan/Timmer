<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 6/8/2017
 * Time: 11:46 AM
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
    <script type="text/javascript" language="JavaScript" src="../../jScripts/timeEditResultFunctions.js"></script>
    <script type="text/javascript" language="JavaScript" src="../../jScripts/reload.js"></script>
    <script type="text/javascript" language="JavaScript" src="../../jScripts/setMsg.js"></script>
</head>
<body>
<div id="divDelMsg">
    <div>
        <a href="#" class="clsBtn" onmousedown="popup();">X</a>
    </div>
    <div id="divDelTxt">
        <label id="utid" hidden><?php echo $_REQUEST["utid"]; ?></label>
        <span style="font: normal bolder; color: red;">Are you sure you want to delete this time record ?</span>
        <br><br>
        <span style="font: large bolder; color: red;">WARNING:</span>
        <span style="font: normal bolder; color: red;">If you delete this record the information <br>will be removed
            from the system permanently.</span><br><br>
        <label id="msgID" hidden></label>
        <input type="button" id="uDel" value="Delete" style="margin-left: 2%;" onclick="delTimeProcess();">
        <label id="msg" style="margin-left: -20%; pointer-events: none;"></label>
        <input type="button" id="cancel" value="Cancel" style="margin-left: 40%;" onmousedown="popup();">
    </div>
</div>
</body>
</html>