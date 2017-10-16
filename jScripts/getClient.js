// JavaScript Document
function chkClient() {

    if (document.getElementById("utid")) {
        var utid = document.getElementById("utid").innerHTML;
    }else{
        utid = null;
    }
    var cid = document.getElementById("cid").value;

    if(window.XMLHttpRequest){

        xmlhttp=new XMLHttpRequest();

    }else{

        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

    }xmlhttp.onreadystatechange=function(){

        if(xmlhttp.readyState==4 && xmlhttp.status==200){

            document.getElementById("clientSelect").innerHTML=xmlhttp.responseText;

        }
    };
    xmlhttp.open("POST","../functions/getClient.php?utid="+utid+"&cid="+cid,true);
    xmlhttp.send();
}


function getClient(cId){
	//Get the selected ID using this.is in client side HTML then breaks it up using this to get the ID only
	  var select = document.getElementById("catSelect"),
		  optionId = select.options[select.selectedIndex],
		  catId = optionId.id;
	
	if(window.XMLHttpRequest){

		 xmlhttp=new XMLHttpRequest();

	 }else{

		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

	}xmlhttp.onreadystatechange=function(){

		if(xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("clientSelect").innerHTML=xmlhttp.responseText;
		}
	};
	xmlhttp.open("POST","../functions/getClient.php?cl="+catId,true);
	xmlhttp.send();
}