<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 4/26/2017
 * Time: 3:17 PM
 */
session_start();
include_once("../iConnect/handShake.php");
include_once ("../Functions/userCheck.php");

$getUserRole = "SELECT * FROM userroles ORDER BY urId ASC";
$getUserRoleQuery = $dbConnect -> query($getUserRole);

if(isset($_REQUEST["uId"])){
    $getUser = "SELECT * FROM userlogin WHERE uId = :uId";
    $getUserQuery = $dbConnect -> prepare($getUser);
    $getUserQuery -> bindParam(':uId', $_REQUEST["uId"]);
    $getUserQuery -> execute();
    $userRow = $getUserQuery -> fetch(PDO::FETCH_ASSOC);

//  Check users team
    $checkTeam = "SELECT * FROM teams WHERE tlName = :tlName";
    $checkTeamQuery = $dbConnect -> prepare($checkTeam);
    $checkTeamQuery -> bindParam(':tlName', $_REQUEST["uId"]);
    $checkTeamQuery -> execute();
    $checkTeamRow = $checkTeamQuery -> fetch(PDO::FETCH_ASSOC);
}

if (isset($_SESSION["uId"])){
    $getLoggedUsr = "SELECT * FROM userlogin WHERE uId = :uid";
    $getLoggedUsrQry = $dbConnect -> prepare($getLoggedUsr);
    $getLoggedUsrQry -> bindParam(':uid', $_SESSION["uId"]);
    $getLoggedUsrQry -> execute();
    $getLoggedUsrRow = $getLoggedUsrQry -> fetch(PDO::FETCH_ASSOC);
}
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
    <script language="JavaScript" type="text/javascript" src="../../jScripts/getIds.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/editUserFunctions.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/userListFunctions.js"></script>

</head>
<body>
<div class="popUpBox">
    <script language="JavaScript" type="text/javascript">
        userEditLoader();
    </script>
    <input type="text" id="tid" value="<?php echo $userRow["uTeam"]; ?>" size="2" hidden>
<!--    <label id="userName">Hello --><?php //echo $_SESSION["fName"]." ".$_SESSION["lName"]; ?><!-- </label> --><br><br>
    <label id="uId" hidden><?php echo $_REQUEST["uId"]; ?></label>
    <div class="logo">
        <img src="../../images/logo.png" width="142" height="33"><br>
        <a href="#" id="close">Close</a>
    </div>
    <label for="date">Created Date:</label>
    <label id="date" style="margin-left: 50px;"><?php echo $userRow["uCreateDate"]; ?></label><br><br>
    <label for="fName">First Name:</label>
    <input type="text" id="fName" name="fName" style="margin-left: 10px;" onkeyup="checkEmpty();" value="<?php echo $userRow["fName"]; ?>">
    <label for="lName" style="margin-left: 8px;">Last Name:</label>
    <input type="text" id="lName" name="lName" style="margin-left: 10px;" onkeyup="checkEmpty();" value="<?php echo $userRow["lName"]; ?>">
    <label for="uName" style="margin-left: 8px;">User Name:</label>
    <input type="text" id="uName" name="uName" style="margin-left: 7px;" onkeyup="checkEmpty();" value="<?php echo $userRow["uName"]; ?>"><br><br>
    <label for="pWord1" style="margin-left: 8px;" >Password:</label>
    <input type="password" id="pWord1" name="pWord1" style="margin-left: 17px;" disabled>
    <label for="pWord2" style="margin-left: 8px;">Confirm Password:</label>
    <input type="password" id="pWord2" name="pWord2" style="margin-left: 8px;" disabled>
    <label for="uTeam" style="margin-left: 8px;">Team</label>
    <select name="uTeam" id="uTeam" style="width: 170px;" onchange="teamId(this.id);createTeamList();">
        <option></option>
    </select>
    <input type="text" name="uTeamId" id="uTeamId" hidden><br><br>
    <div id="userRoles">
        <label for="userRoles">User Role:</label><label for="uAttrib" style="margin-left: 250px;">User Attributes:</label><br>
        <?php while ($row = $getUserRoleQuery -> fetch(PDO::FETCH_ASSOC)) {
            if ($_SESSION["uRole"] !== "1" && $row["userRole"] == "Admin" ) continue ?>
        <input type="radio" class="userRoles" name="userRoles" value="<?php echo $row["urId"]; ?>"<?php if($userRow["uRole"] == $row["urId"]){ ?>checked<?php } ?>><?php echo $row["userRole"]; }?>
        <input type="checkbox" id="tl" name="tl" value="yes" style="margin-left: 25%;" <?php if ($checkTeamRow["tlSet"] == "yes"){ ?>checked<?php } ?>>Team Leader
    </div>
    <label id="msgID" hidden></label>
    <div id="msg"></div>
    <div id="sbmBtns">
        <input type="button" value="Reset" name="reset" id="reset" class="btn" onclick="resetForm()">
        <input type="button" value="Submit" name="submit" id="submit" class="btn" onclick="updateUsr();">
    </div>
</div>
</body>
</html>