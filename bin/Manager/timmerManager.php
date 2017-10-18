<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 4/19/2017
 * Time: 11:00 AM
 */

session_start();
include_once("../iConnect/handShake.php");
include_once ("../Functions/userCheck.php");
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
        <div class="w3-dropdown-hover">
            <button class="w3-button">Data Process <i class="fa fa-caret-down"></i></button>
            <div class="w3-dropdown-content w3-bar-block w3-card-4">
                <a href="../Functions/operatorUi.php" target="container" class="w3-bar-item w3-button w3-hover-light-blue">Time Entry</a>
                <a href="#" target="container" class="w3-bar-item w3-button w3-hover-light-blue" >Edit Time Entry</a>
                <a href="../Functions/addCat.php" target="container" class="w3-bar-item w3-button w3-hover-light-blue">Add Category</a>
                <a href="../Functions/addClient.php" target="container" class="w3-bar-item w3-button w3-hover-light-blue">Add Client</a>
            </div>
        </div>
        <div class="w3-dropdown-hover">
            <button class="w3-button">User <i class="fa fa-caret-down"></i></button>
            <div class="w3-dropdown-content w3-bar-block w3-card-4">
                <a href="createUserManager.php" target="container" class="w3-bar-item w3-button w3-hover-light-blue">New User</a>
                <a href="../Admin/listUser.php" target="container" class="w3-bar-item w3-button w3-hover-light-blue" >Edit users</a>
            </div>
        </div>
        <div class="w3-dropdown-hover">
            <button class="w3-button">Reports <i class="fa fa-caret-down"></i></button>
            <div class="w3-dropdown-content w3-bar-block w3-card-4">
                <a href="../Report/totalTimePerDay.php" target="container" class="w3-bar-item w3-button w3-hover-light-blue">Total Time All Users</a>
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