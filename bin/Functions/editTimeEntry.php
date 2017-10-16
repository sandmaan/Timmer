<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 5/18/2017
 * Time: 1:37 PM
 */
session_start();
include_once("../iConnect/handShake.php");
include_once ("../Functions/userCheck.php");

// Setting the session so it want appear as empty

if (!isset($_SESSION["sT"])){
    $_SESSION["sT"] = "No";
}

//Retrieves data from the serchterm database to restore the last search queries.
if (isset($_SESSION["lSid"])){
    $getSterm = "SELECT searchterm.*, userlogin.fName, userlogin.lName FROM searchterm
                 INNER JOIN userlogin ON searchterm.sUid = userlogin.uId WHERE sId = :sId";
    $getStermQuery = $dbConnect -> prepare($getSterm);
    $getStermQuery -> bindParam(':sId', $_SESSION["lSid"]);
    $getStermQuery -> execute();
    $getStermRow = $getStermQuery -> fetch(PDO::FETCH_ASSOC);
}

?>

<html>
<head>

    <!-- Style Sheets -->
    <link rel="stylesheet" type="text/css" href="../../CSS/main.css">
    <link rel="stylesheet" type="text/css" href="../../CSS/jquery-ui.min.css">

    <!-- Java Scripts -->
    <script language="JavaScript" type="text/javascript" src="../../jScripts/Libraries/jquery.min.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/Libraries/jquery-ui.min.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/editTimeEntryFunctions.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/timeEditResultFunctions.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/operateruiFunctions.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/getUser.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/getIds.js"></script>
    <script language="javascript" type="text/javascript" src="../../jScripts/getCat.js"></script>
    <script language="javascript" type="text/javascript" src="../../jScripts/getClient.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/getIds.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/reload.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/setMsg.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/sendData.js"></script>
</head>

<?php if ($_SESSION["sT"] == "Done"){ ?>
<body onload="tEditReload2()">
<div id="divCenter-timeEdit" class="box">
    <label id="sbId" hidden><?php echo $_SESSION["uRole"]?></label>
    <div class="logo-timeEdit">
        <img src="../../images/logo.png" width="142" height="33">
    </div>
    <div id="mainDiv" style="height: 38px;">
        <label for="dPicker">Date:</label>
        <input type="text" id="dPicker" style="margin-left: .5%;" size="10" value="<?php echo $getStermRow["sDate"]; ?>">
        <label for="userSelect" style="margin-left: 2%">Select User:</label>
        <select id="userSelect" style="width:160px; margin-left: .5%;" onchange="usrId(this.id);"></select>
        <input type="text" id="uid" size="1" value="<?php echo $getStermRow["sUid"]; ?>" hidden>
        <input type="button" class="getData" value="Submit" onclick="getData();">
    </div>
    <div id="resultTable"><span id="noDataMsg"></span> </div>
</div>
</body>
<?php }else{?>
<body onload="getUser();">
<div id="divCenter-timeEdit" class="box">
    <label id="sbId" hidden><?php echo $_SESSION["uRole"]?></label>
    <div class="logo-timeEdit">
        <img src="../../images/logo.png" width="142" height="33">
    </div>
    <div id="mainDiv" style="height: 38px;">
        <label for="dPicker">Date:</label>
        <input type="text" id="dPicker" style="margin-left: .5%;" size="10">
        <label for="userSelect" style="margin-left: 2%">Select User:</label>
        <select id="userSelect" style="width:160px; margin-left: .5%;" onchange="usrId(this.id);"></select>
        <input type="text" id="uid" size="1" hidden>
        <input type="button" class="getData" value="Submit" onclick="getData();">
    </div>
    <div id="resultTable"><span id="noDataMsg"></span> </div>
</div>
</body>
<?php } ?>
</html>
