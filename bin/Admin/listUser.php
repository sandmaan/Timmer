<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 4/26/2017
 * Time: 10:32 AM
 */

session_start();
include_once("../iConnect/handShake.php");
include_once ("../Functions/userCheck.php");

if (isset($_REQUEST["page"])){//Get the page number from the submission link
    $page_number = filter_var($_REQUEST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
    if(!is_numeric($page_number)){die('Invalid page number!');} //in case of invalid page number
}else{
    $page_number = 1;
}
if (isset($_REQUEST["rc"])){//Get the amount of records to display on the page
    $perpage = $_REQUEST["rc"];
}else{
    $perpage = 10;
}

//get current starting point of records
$position = (($page_number-1) * $perpage);

//Data base join to get team names from teams data base
$dbConnect->setAttribute( PDO::ATTR_EMULATE_PREPARES, false ); //Makes emulation off which allows LIMIT to work
$getUsers = "SELECT userlogin.*, teams.TeamName FROM userlogin INNER JOIN teams ON teams.tId = userlogin.uTeam ORDER BY uId ASC LIMIT :place, :item_per_page";
$getUsersQuery = $dbConnect -> prepare($getUsers);
$getUsersQuery -> bindParam(':place', $position, PDO::PARAM_INT);
$getUsersQuery -> bindParam(':item_per_page', $perpage, PDO::PARAM_INT);
$getUsersQuery -> execute();

//Count the entire row list
$getCount = "SELECT COUNT(*) FROM userlogin";
$getCountQuery = $dbConnect -> prepare($getCount);
$getCountQuery -> execute();

$totRows = $getCountQuery -> fetch();

//Calculates the amount of pages need to be created
$pages = ceil($totRows[0]/$perpage);
?>
<html>
<head>
<!-- Style sheets   -->
    <link rel="stylesheet" type="text/css" href="../../CSS/main.css">
    <link rel="stylesheet" type="text/css" href="../../CSS/simplePagination.css">

<!--  JavaScritps  -->
    <script language="JavaScript" type="text/javascript" src="../../jScripts/Libraries/jquery.min.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/Libraries/jquery.simplePagination.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/userListFunctions.js"></script>
    <!-- SimplePagination functions to create the pagination -->
    <script language="JavaScript" type="text/javascript">
        $(document).ready(function () {
            $('.pagination-container').pagination({
                items: <?php echo $pages;?>, //Amount of pages
                itemsOnPage: <?php echo $perpage;?>, //Records to be shown per page
                cssStyle: 'proa-theme', //Theme currently rocking a custom theme
                currentPage : <?php echo $page_number;?>, //Current page number
                hrefTextPrefix : 'listUser.php?page=' //Link prefix link will be created using this prefix
            })
        });
    </script>
</head>
<body>
<div id="divCenter" class="box">
    <div class="logo">
        <img src="../../images/logo.png" width="142" height="33">
    </div>
    <div id="mainDiv">
        <div id="panel">
            <div id="table-container">
                <div id="navi"></div>
                <div id="infoi"></div>
                <table id="hor-minimalist-b">
                    <div id="bgDimmer"></div>
                    <div id="divContent"></div>
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Team</th>
                        <th scope="col">Created Date</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while ($row = $getUsersQuery -> fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr <?php if ($_SESSION["uRole"] != "1" && $row["uRole"] == "1"){?> hidden <?php } ?>>
                            <td><?php echo $row["uId"]; ?></td>
                            <td><?php echo $row["fName"]; ?></td>
                            <td><?php echo $row["lName"]; ?></td>
                            <td><?php echo $row["TeamName"]; ?></td>
                            <td><?php echo $row["uCreateDate"]; ?></td>
                            <td><input type="button" class="uEdit" value="Edit" data-uid="<?php echo $row["uId"]; ?>" /></td>
                            <td><input type="button" class="chgPass" value="Edit Password" data-uid="<?php echo $row["uId"]; ?>"></td>
                            <td><input type="button" class="uDel" value="Delete" data-uid="<?php echo $row["uId"]; ?>" /></a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <div class="wrapper" style="width: 100%; margin-top: -3%; margin-left: 5%">
                    <div class="content-selector" style="width: 21%; float: left; vertical-align: middle">
                        Showing
                        <select id="record-amount">
                            <option id="10" <?php if($perpage == 10){ ?> selected <?php } ?>>10</option>
                            <option id="20" <?php if($perpage == 20){ ?> selected <?php } ?>>20</option>
                            <option id="30" <?php if($perpage == 30){ ?> selected <?php } ?>>30</option>
                            <option id="40" <?php if($perpage == 40){ ?> selected <?php } ?>>40</option>
                            <option id="50" <?php if($perpage == 50){ ?> selected <?php } ?>>50</option>
                        </select> on page.
                        <script type="text/javascript" language="JavaScript">
                            //JQuery to set the records per page
                            $(document).ready(function () {
                                $('#record-amount').change(function () {
                                    var selId = $(this).find('option:selected').attr('id');
                                    window.location.href = "listUser.php?rc="+selId;
                                })
                            })
                        </script>
                    </div>
                    <div class="pagination-container" style="width: 30%; float: right; margin-right: 5%">
                        <?php
                        //This creates the page links
                        $pagLink = "<nav><ul class='pagination'>";
                        for ($i=1; $i<=$pages; $i++) {
                            $pagLink .= "<li><a href='listUser.php?page=".$i."'>".$i."</a></li>";
                        };
                        echo $pagLink . "</ul></nav>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="msg"></div>
</body>
</html>
