<?php

session_start();

if(isset($_SESSION["uId"]) && isset($_SESSION["fName"])){
    header("location:selecter.php");
    exit();
}

?>


<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Timmer</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--Favicon-->
        <link rel="shortcut icon" type="image/x-icon" href="../images/ico/favicon.ico">

        <!-- Style Sheets -->
        <link rel="stylesheet" type="text/css" href="../CSS/main.css">

        <!-- Java Scripts -->
        <script language="JavaScript" type="text/javascript" src="../jScripts/Libraries/jquery.min.js"></script>
        <script language="JavaScript" type="text/javascript" src="../jScripts/reload.js"></script>
        <script language="JavaScript" type="text/javascript" src="../jScripts/multiScript.js"></script>
        <script language="JavaScript" type="text/javascript" src="../jScripts/loginFunctions.js"></script>

    </head>
    <body id="mainBody">
    <div id="divCenter" class="box">
        <div class="logo">
            <img src="../images/logo.png" width="142" height="33">
        </div>
        <div class="loginOuterContainer" >
         <div class="loginInnerContainer">
             <label for="uName">User Name:</label>
             <input type="text" id="uName" name="uName" onkeyup="chkUname();" disabled>
             <label for="pWord">Password:</label>
             <input type="password" id="pWord" name="pWord" onkeyup="getLogin();" disabled>
         </div>
        </div>
        <label id="msgID" hidden></label>
        <div id="msg"></div>
        <div id="sbmBtns"><br/></div>
    </div>
    <div id="dev-details">
        <img id="small-logo" src="../images/Timmerlogo.png">
        <div id="branding-text">
            Created by CodeMonsters
        </div>
    </div>
    </body>
</html>
