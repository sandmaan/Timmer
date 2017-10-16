<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 4/19/2017
 * Time: 11:01 AM
 */

session_start();
include_once("../iConnect/handShake.php");
include_once ("../Functions/userCheckTl.php");
?>

<!DOCTYPE html>

<html>
<head>
    <title>Timmer</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Favicon-->
    <link rel="shortcut icon" type="image/x-icon" href="../../images/ico/favicon.ico">

    <!-- Style Sheets -->
    <link rel="stylesheet" type="text/css" href="../../CSS/main.css">
    <link rel="stylesheet" type="text/css" href="../../CSS/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Java Scripts -->
    <script language="JavaScript" type="text/javascript" src="../../jScripts/Libraries/jquery.min.js"></script>

</head>
<body id="mainBody" >
<div class="w3-top">
    <div class="w3-bar w3-light-gray w3-card-4">
        <a href="../Functions/quickList.php" target="container" class="w3-bar-item w3-button w3-hover-light-blue">Home</a>
        <div class="w3-dropdown-hover" style="display: none;">
            <button class="w3-button">Reports <i class="fa fa-caret-down"></i></button>
            <div class="w3-dropdown-content w3-bar-block w3-card-4">
                <a href="#" target="container" class="w3-bar-item w3-button w3-hover-light-blue">Link 1</a>
                <a href="#" target="container" class="w3-bar-item w3-button w3-hover-light-blue">Link 2</a>
                <a href="#" target="container" class="w3-bar-item w3-button w3-hover-light-blue">Link 3</a>
            </div>
        </div>
        <div class="w3-dropdown-hover w3-right">
            <button class="w3-button">Hello, <?php echo $_SESSION["fName"] ?> <i class="fa fa-caret-down"></i></button>
            <div class="w3-dropdown-content w3-bar-block w3-card-4">
                <a href="../Functions/bye.php" target="_self" class="w3-bar-item w3-button w3-hover-light-blue">Log out</a>
            </div>
        </div>
    </div>
</div>
<iframe name="container" id="container" src="../Functions/quickList.php"></iframe>
<div id="dev-details">
    <img id="small-logo" src="../../images/Timmerlogo.png">
    <div id="branding-text">
        Created by CodeMonsters
    </div>
</div>
</body>
</html>