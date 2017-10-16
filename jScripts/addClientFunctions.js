function addClnBtn() {
    addClient();
    setTimeout("setMsg()",100);
    setTimeout("reload()",100);
}

function addClient(){
    var uId = document.getElementById("uId").innerHTML,
        date = document.getElementById("date").innerHTML,
        cat = document.getElementById("cateId").value,
        clName = document.getElementById("clName").value;

    if(window.XMLHttpRequest){
        xmlhttp=new XMLHttpRequest();
    }else{
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function(){
        if(xmlhttp.readyState==4 && xmlhttp.status==200){
            document.getElementById("msgID").innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("POST","../Functions/addClientProcess.php?uId="+uId+"&cDate="+date+"&catId="+cat+"&clName="+clName,true);
    xmlhttp.send();
}