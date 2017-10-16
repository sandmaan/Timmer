<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 8/1/2017
 * Time: 2:39 PM
 */

session_start();
include_once("../iConnect/handShake.php");
include_once ("../Functions/userCheck.php");

$getJobs = "SELECT clientdb.Client, timeSpent FROM usertimetrack
            LEFT JOIN clientdb ON usertimetrack.utClient = clientdb.clientId
            WHERE usrId = :usrid AND jDate = :jdate ORDER BY utId ASC";
$getJobsQuery = $dbConnect -> prepare($getJobs);
$getJobsQuery -> bindParam(':usrid', $_REQUEST["usrid"]);
$getJobsQuery -> bindParam(':jdate', $_REQUEST["date"]);
$getJobsQuery -> execute();
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
    <script language="JavaScript" type="text/javascript" src="../../jScripts/reload.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/multiScript.js"></script>

</head>
<body>
<body>
<div class="popUpBox">
    <div class="clsBtn2-container">
        <a href="#" class="clsBtn2" onmousedown="popup();">X</a>
    </div>
    <table id="hor-minimalist-b">
        <thead>
        <tr>
            <th scope="col">Client Name</th>
            <th scope="col">Spent Time</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($getJobsRow = $getJobsQuery -> fetch(PDO::FETCH_ASSOC)){ ?>
        <tr>
            <td><?php echo $getJobsRow["Client"] ?></td>
            <td><?php echo $getJobsRow["timeSpent"] ?></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>

</div>
</body>
</html>