<?php
session_start();
include_once ("../Functions/userCheckAll.php");
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Time Sheet</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Style Sheets -->
        <link rel="stylesheet" type="text/css" href="../../CSS/main.css">

        <!-- Java Scripts -->
        <script language="JavaScript" type="text/javascript" src="../../jScripts/Libraries/jquery.min.js"></script>
        <script language="javascript" type="text/javascript" src="../../jScripts/svrTimeDate.js"></script>
		<script language="javascript" type="text/javascript" src="../../jScripts/timeCal.js"></script>
		<script language="javascript" type="text/javascript" src="../../jScripts/getCat.js"></script>
		<script language="javascript" type="text/javascript" src="../../jScripts/getClient.js"></script>
        <script language="JavaScript" type="text/javascript" src="../../jScripts/multiScript.js"></script>
        <script language="JavaScript" type="text/javascript" src="../../jScripts/getIds.js"></script>
        <script language="JavaScript" type="text/javascript" src="../../jScripts/sendData.js"></script>
        <script language="JavaScript" type="text/javascript" src="../../jScripts/reload.js"></script>
        <script language="JavaScript" type="text/javascript" src="../../jScripts/setMsg.js"></script>
        <script language="JavaScript" type="text/javascript" src="../../jScripts/operateruiFunctions.js"></script>
    </head>
    <body onLoad="pauseLoad()">
       <div id="divCenter" class="box">
   		 <form name="clientTimeSheet" id="clientTimeSheet" method="post" enctype="multipart/form-data">
        <!-- <label id="userName">Hello --><?php //echo $_SESSION["fName"]." ".$_SESSION["lName"]; ?><!--</label>-->
             <label id="uId" hidden><?php echo $_SESSION["uId"] ?></label>
             <label id="tId" hidden><?php echo $_SESSION["uTeam"] ?></label>
	          <div class="logo">
 	         	<img src="../../images/logo.png" width="142" height="33"></div>
		      <br><br>
		     <label for="date">Date:</label>
             <label id="date" style="margin-left:43px;"></label>
         <br><br>
      <label for="catSelect">Category:</label>
          <select name="catSelect" id="catSelect" onChange="getClient(this.id); catId(this.id);"  style="margin-left:14px; width:180px"></select>
             <input id="cateId" size="1" hidden>
      <label for="clientSelect" style="margin-left:14px;">Client:</label>
    	  <select name="clientSelect" id="clientSelect" onChange="clientId(this.id); setTimeout('enableJtype()',100);" style="width:180px;" disabled></select>
             <input id="clintId" size="1" hidden>
      <label for="jType" style="margin-left:14px;">Job Type:</label>
          <input type="radio" name="jType" class="jType" id="Processing" value="Processing" disabled>Processing
          <input type="radio" name="jType" class="jType" id="qc" value="QC" disabled>QC
      	<br><br>
      <label for="startTime">Start Time:</label>
      	  <input name="startTime" id="startTime" style="margin-left:7px;" size="8" readonly>
          <button type="button" name="getStartTime" id="getStartTime" onMouseDown="getSvrTime()"  onMouseUp="startBtnDisable(); tmpDataAdd();" disabled>Get Time</button>
      <label for="endTime" style="margin-left:42px;">End Time:</label>
      	  <input name="endTime" id="endTime" size="8" readonly>
          <button type="button" name="getEndTime" id="getEndTime" onMouseDown="getSvrEndTime()" onMouseUp="timeDifference(endTime, startTime); setTimeout('endBtnDisable()',100); setTimeout('statUpd()',100);" disabled>Get Time</button>
      <label for="spentTime"  style="margin-left:30px;">Spent Time:</label>
      	  <input name="spentTime" id="spentTime" size="4" onFocus="" readonly>
        <br><br>        
      <label for="volume">Volume:</label>
      	  <input name="volume" id="volume" size="4" onkeyup="checkNum(this)" style="margin-left:23px;">
      <label for="noPl" style="margin-left: 35px;">No. of Product Lines:</label>
          <input name="noPl" id="noPl" size="4" onkeyup="checkNum(this)">
      <label for="remarks" style="margin-left:34px;">Remarks</label>
      	  <input name="remarks" id="remarks" size="31">
         <br><br>
             <div id="jType-container">
                 <div id="error-Add-Container">
                     <div id="error-Column-Headings">
                         Error Number<span>Error Name</span>
                     </div>
                     <div class="error-Column">
                         <div class="error-container">
                             <input class="errorCount" size="1" value="1" style="margin-left: 2%" />
                             <select id="errorName" class="errorName">
                                 <option></option>
                             </select>
                             <input class="errorId" size="1" name="errorId" readonly hidden>
                             <input type="button" class="addRow" value="Add" disabled />
                             <input type="button" class="delRow" value="Delete" />
                         </div>
                     </div>
                 </div>
             </div>
             <label id="msgID" hidden></label>
             <div id="msg"></div>
      <div id="sbmBtns">
	      <input type="button" value="Reset" name="reset" id="reset" class="btn" onclick="resetForm()">
<!--      <input type="button" value="Submit" name="submit" id="submit" class="btn" onmousedown="pauseLoad2()">-->
    	  <input type="button" value="Submit" name="submit" id="submit" class="btn">
      </div>
    </form>
   </div>
  </body>
</html>                