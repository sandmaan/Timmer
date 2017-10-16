<?php
/**
 * Created by PhpStorm.
 * User: SiNUX
 * Date: 5/12/2017
 * Time: 1:24 PM
 */
?>

<html>
<head>
    <title></title>
    <!--    <meta http-equiv="refresh" content="60">    -->

    <!-- Style sheets   -->
    <link rel="stylesheet" type="text/css" href="../../CSS/main.css">

    <!--  JavaScripts  -->
    <script language="JavaScript" type="text/javascript" src="../../jScripts/quickListCall.js"></script>

    <!--  Function call for quickListCall  -->
    <script language="JavaScript" type="text/javascript">
        quickListCall();
    </script>

</head>
<body>
<script language="JavaScript" type="text/javascript">
    //The quickListCall function will be initiated every 10 seconds
    setInterval(quickListCall, 10000);
</script>
<div id="divCenter" class="box">
    <div class="logo">
        <img src="../../images/logo.png" width="142" height="33">
    </div>
    <div id="mainDiv">
        <div id="panel">
             <div id="table-container">
                 <!--    Data is handed over from the quickListCall javascript    -->
             </div>
        </div>
    </div>
</div>
</body>
</html>
