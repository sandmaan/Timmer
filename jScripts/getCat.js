// JavaScript Document

//Get the catagory from the database
function getCat(){

 //This is to pickup on whether the utid is populated or not if it is populated then both variables will be sent to
 //getCat.php which will run the correct process after seeing the condition is set.
 if (document.getElementById("utid")) {
     var utid = document.getElementById("utid").innerHTML;
 }else{
  utid = null;
 }

 if(window.XMLHttpRequest){

   xmlhttp=new XMLHttpRequest();

  } else {

   xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

  }xmlhttp.onreadystatechange=function(){

   if(xmlhttp.readyState==4 && xmlhttp.status==200){

    document.getElementById("catSelect").innerHTML=xmlhttp.responseText;

   }
  };
 if (utid === null){
     xmlhttp.open("POST","../functions/getCat.php?cat=getCat",true);
     xmlhttp.send();
 }else{
     xmlhttp.open("POST","../functions/getCat.php?cat=getCat&utid="+utid,true);
     xmlhttp.send();
 }

}