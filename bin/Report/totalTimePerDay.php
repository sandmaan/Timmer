<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 8/1/2017
 * Time: 9:55 AM
 */

session_start();
include_once("../iConnect/handShake.php");
include_once ("../Functions/userCheck.php");
?>

<html>
<head>

    <!-- Style Sheets -->
    <link rel="stylesheet" type="text/css" href="../../CSS/main.css">
    <link rel="stylesheet" type="text/css" href="../../CSS/jquery-ui.min.css">

    <!-- Java Scripts -->
    <script language="JavaScript" type="text/javascript" src="../../jScripts/Libraries/jquery.min.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/Libraries/jquery-ui.min.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/totTimePerDayFunctions.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/getUser.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/getIds.js"></script>
    <script language="javascript" type="text/javascript" src="../../jScripts/getCat.js"></script>
    <script language="javascript" type="text/javascript" src="../../jScripts/getClient.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/getIds.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/reload.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/setMsg.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../jScripts/sendData.js"></script>
    <script language="JavaScript" type="text/javascript">
        function excExport() {
            //This will trigger the Excel file and the download.
            var date = document.getElementById("dPicker").value;

            if (date !== ""){
                window.open('exportToExcel.php?date='+date);
            }else{
                alert("Date not selected");
            }
        }
    </script>
    <script language="JavaScript" type="text/javascript">
        function pdfExport() {
            //This will trigger the Excel file and the download.
            var date = document.getElementById("dPicker").value;

            if (date !== ""){
                window.open('exportToPDF.php?date='+date);
            }else{
                alert("Date not selected");
            }
        }
    </script>
</head>

<body>
  <div id="divCenter-timeEdit" class="box">
       <div class="logo-timeEdit">
            <img src="../../images/logo.png" width="142" height="33">
       </div>
        <div id="mainDiv" style="height: 38px;">
            <label for="dPicker">Date:</label>
            <input type="text" id="dPicker" name="dPicker" style="margin-left: .5%;" size="10">
            <input type="button" class="getData" value="Submit" onclick="getTotal()">
            <span style="margin-left: 4%;">Export as :</span>
            <div id="ico-container">
                <div id="ico">
                    <a href="#" onclick="excExport()">
                        <img src="../../images/ico/Excel-2.ico" width="32px" height="32px">
                    </a>
                    <a href="#" onclick="pdfExport()">
                        <img src="../../images/ico/pdf-flat.ico" width="32px" height="32px">
                    </a>
                </div>
            </div>
        </div>
       <div id="resultTable">
           <span id="noDataMsg"></span>
       </div>
  </div>
</body>
</html>