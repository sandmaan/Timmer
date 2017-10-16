function addCatBtn() {
    addCat();
    setTimeout("setMsg()",100);
    setTimeout("reload()",100);
}

function addCat(){
    var uId = document.getElementById("uId").innerHTML,
        date = document.getElementById("date").innerHTML,
        cName = document.getElementById("cName").value;

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
    xmlhttp.open("POST","../Functions/addCatProcess.php?uId="+uId+"&cDate="+date+"&cName="+cName,true);
    xmlhttp.send();
}