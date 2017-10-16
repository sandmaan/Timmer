// JavaScript Document

//Get the Start time from the server
function getSvrTime()
{
 if(window.XMLHttpRequest)
  {
   xmlhttp=new XMLHttpRequest();
  }
 else
  {
   xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 
 xmlhttp.onreadystatechange=function()
  {
   if(xmlhttp.readyState==4 && xmlhttp.status==200)
   {
    document.getElementById("startTime").value = xmlhttp.responseText;
   }
  };

 xmlhttp.open("POST","../Functions/timer.php?svrTime=time",true);
 xmlhttp.send();
}

//Get the End time from the server
function getSvrEndTime()
{
 if(window.XMLHttpRequest)
  {
   xmlhttp=new XMLHttpRequest();
  }
 else
  {
   xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 
 xmlhttp.onreadystatechange=function()
  {
   if(xmlhttp.readyState==4 && xmlhttp.status==200)
   {
    document.getElementById("endTime").value = xmlhttp.responseText;
   }
  };

 xmlhttp.open("POST","../Functions/timer.php?svrTime=time",true);
 xmlhttp.send();
}

//Get's the current date from the server
function getSvrDate()
{
 if(window.XMLHttpRequest)
  {
   xmlhttp=new XMLHttpRequest();
  }
 else
  {
   xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 
 xmlhttp.onreadystatechange=function()
  {
   if(xmlhttp.readyState==4 && xmlhttp.status==200)
   {
    document.getElementById("date").innerHTML = xmlhttp.responseText;
   }
  };

 xmlhttp.open("POST","../Functions/getDate.php?svrDate=date",true);
 xmlhttp.send();
}