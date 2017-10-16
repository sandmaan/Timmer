<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 9/13/2017
 * Time: 4:44 PM
 */
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
    <link rel="shortcut icon" type="image/x-icon" href="../../images/ico/favicon.ico">

    <!-- Style Sheets -->
    <link rel="stylesheet" type="text/css" href="../../CSS/main.css">

    <!-- Java Scripts -->
    <script language="JavaScript" type="text/javascript" src="../../jScripts/Libraries/jquery.min.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/reload.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/multiScript.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/loginFunctions.js"></script>
    <script language="JavaScript" type="text/javascript">
        $(document).ready(function() {
            window.setInterval(function() {
                var timeLeft    = $("#timeOut").html();
                if(eval(timeLeft) == 0){
                    window.location= ("../index.php");
                }else{
                    $("#timeOut").html(eval(timeLeft)- eval(1));
                }
            }, 1000);
        });
    </script>
</head>
<body id="mainBody">
<div id="divCenter" class="box">
    <div class="logo">
        <img src="../../images/logo.png" width="142" height="33">
    </div>
    <div class="logoutOuterContainer" >
        <div class="logoutInnerContainer">
            <div id="logout-logo">
                <img src="../../images/Timmerlogo-small.png">
            </div>
            <div id="logout-text">
                <span id="logout-msg">
                    You logged out of the system successfully.<br>
                </span>
                <span class="logout-counter-text">
                    You will be redirected to the login page in &nbsp;
                </span>
                <span id="timeOut">10</span>
                <span class="logout-counter-text">
                    , please click <a href="../index.php">here.</a>
                </span>
            </div>
        </div>
    </div>
    <label id="msgID" hidden></label>
    <div id="msg"></div>
    <div id="sbmBtns"><br/></div>
</div>
<div id="dev-details">
    <img id="small-logo" src="../../images/Timmerlogo.png">
    <div id="branding-text">
        Created by CodeMonsters
    </div>
</div>
</body>
</html>