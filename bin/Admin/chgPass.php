<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 5/4/2017
 * Time: 1:39 PM
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
            <label for="pass1">New Password:</label>
            <input type="password" id="pass1" style="margin-left: 5%" onkeyup="checkLength()"><br><br>
            <label for="pass2">Confirm Password:</label>
            <input type="password" id="pass2" style="margin-left: 1%" onkeyup="checkPass()"><br><br>
            <label id="msgID" hidden></label>
            <label id="msg" style="margin-left: -12%"></label>
            <input type="button" id="change" value="Change" style="margin-left: 65%" onclick="usrUpdProcess();" disabled>

        </div>
</div>
</body>
</html>
