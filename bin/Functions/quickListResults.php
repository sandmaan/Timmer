<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 9/11/2017
 * Time: 2:40 PM
 */
session_start();
include_once("../iConnect/handShake.php");

//Check user if his an admin, manager or a team leader
include_once ("../Functions/userCheckTl.php");

if (isset($_SESSION["tlSet"])){

    $getTeam = "SELECT TeamName,tId FROM teams WHERE tlName = :uid";
    $getTeamQuery = $dbConnect -> prepare($getTeam);
    $getTeamQuery -> bindParam(':uid', $_SESSION["uId"]);
    $getTeamQuery -> execute();

    if ($teamRow = $getTeamQuery -> fetch(PDO::FETCH_ASSOC)){
        $getTmpData = "SELECT tempdb.*, userlogin.uName, userlogin.uRole, teams.TeamName,
                   catdb.Catagory, clientdb.Client
                   FROM tempdb INNER JOIN userlogin ON tempdb.uId = userlogin.uId
                   INNER JOIN teams ON teams.tId = userlogin.uTeam
                   INNER JOIN catdb ON catdb.catId = tempdb.catId
                   INNER JOIN clientdb ON clientdb.clientId = tempdb.clientId
                   WHERE tempdb.tId = :tid ORDER BY tempId ASC";
        $getTmpDataQuery = $dbConnect -> prepare($getTmpData);
        $getTmpDataQuery -> bindParam(':tid', $teamRow["tId"]);
        $getTmpDataQuery -> execute();
    }
}else{
    $getTmpData = "SELECT tempdb.*, userlogin.uName, userlogin.uRole, teams.TeamName,
               catdb.Catagory, clientdb.Client FROM tempdb INNER JOIN userlogin ON tempdb.uId = userlogin.uId
               INNER JOIN teams ON teams.tId = userlogin.uTeam
               INNER JOIN catdb ON catdb.catId = tempdb.catId
               INNER JOIN clientdb ON clientdb.clientId = tempdb.clientId
               ORDER BY tempId ASC";
    $getTmpDataQuery = $dbConnect -> query($getTmpData);
}
?>

<table id="hor-minimalist-b">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">User Name</th>
        <th scope="col">Team</th>
        <th scope="col">Category</th>
        <th scope="col">Client</th>
        <th scope="col">Start Time</th>
        <th scope="col">Status</th>
    </tr>
    </thead>
    <tbody>
    <?php while ($row = $getTmpDataQuery -> fetch(PDO::FETCH_ASSOC)) { ?>
        <tr <?php if ($_SESSION["uRole"] != "1" && $row["uRole"] == "1"){?> hidden <?php } ?>>
            <td><?php echo $row["tempId"]; ?></td>
            <td><?php echo $row["uName"]; ?></td>
            <td><?php echo $row["TeamName"]; ?></td>
            <td><?php echo $row["Catagory"]; ?></td>
            <td><?php echo $row["Client"]; ?></td>
            <td><?php echo $row["startTime"]; ?></td>
            <td <?php if ($row["Status"] == "Active") {?>style="color: green; font-weight: bolder"<?php }else{ ?>
                style="color: Red; font-weight: bolder"<?php } ?>><?php echo $row["Status"]; ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>