<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 4/6/2017
 * Time: 3:41 PM
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
    <script language="JavaScript" type="text/javascript" src="../../jScripts/userCreatFunctions.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/multiScript.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/getIds.js"></script>

</head>
<body onload="pauseLoad4()">
    <div id="divCenter" class="box">
        <label id="userName" hidden>Hello <?php echo $_SESSION["fName"]." ".$_SESSION["lName"]; ?></label><br><br>
        <label id="uId" hidden><?php echo $_SESSION["uId"] ?></label>
        <div style="width: 166px; position: absolute; left: 642px; top: 20px; height: 44px;">
            <img src="../../images/logo.png" width="142" height="33">
        </div>
        <label for="date">Date:</label>
        <label id="date" style="margin-left: 50px;"></label><br><br>
        <label for="fName">First Name:</label>
        <input type="text" id="fName" name="fName" style="margin-left: 10px;" onkeyup="checkEmpty();">
        <label for="lName" style="margin-left: 8px;">Last Name:</label>
        <input type="text" id="lName" name="lName" style="margin-left: 10px;" onkeyup="checkEmpty();" disabled>
        <label for="uName" style="margin-left: 8px;">User Name:</label>
        <input type="text" id="uName" name="uName" style="margin-left: 7px;" onkeyup="checkEmpty();" disabled><br><br>
        <label for="pWord1" style="margin-left: 8px;" >Password:</label>
        <input type="password" id="pWord1" name="pWord1" style="margin-left: 17px;" onkeyup="checkLength();" disabled>
        <label for="pWord2" style="margin-left: 8px;">Confirm Password:</label>
        <input type="password" id="pWord2" name="pWord2" style="margin-left: 8px;" onkeyup="checkPass();" disabled>
        <label for="uTeam" style="margin-left: 8px;">Team</label>
        <select name="uTeam" id="uTeam" style="width: 170px;" onchange="teamId(this.id);getLeaderInfo();">
            <option></option>
        </select>
        <input type="text" name="uTeamId" id="uTeamId" hidden><br><br>
        <div id="userRoles">
            <label for="userRoles">User Role:</label><label for="uAttrib" style="margin-left: 250px;">User Attributes:</label><br>
            <?php while ($row = $getUserRoleQuery -> fetch(PDO::FETCH_ASSOC)) { ?>
                <input type="radio" class="userRoles" name="userRoles" value="<?php echo $row["urId"]; ?>"><?php echo $row["userRole"]; }?>
                <input type="checkbox" id="tl" name="tl" value="yes" style="margin-left: 120px;" disabled>Team Leader
        </div>
        <label id="msgID" hidden></label>
        <div id="msg"></div>
        <div id="sbmBtns">
            <input type="button" value="Reset" name="reset" id="reset" class="btn" onclick="resetForm()">
            <input type="button" value="Submit" name="submit" id="submit" class="btn" onclick="pauseLoad3();" disabled>
        </div>
    </div>
</body>
</html>