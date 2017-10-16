/**
 * Created by SiNUX on 5/24/2017.
 */
//Get the user details from the database
function getUser(){

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
            document.getElementById("userSelect").innerHTML=xmlhttp.responseText;
        }
    };
    xmlhttp.open("POST","../functions/getUsrId.php?uid=getUsr",true);
    xmlhttp.send();
}

//Get user for the time edit form which has to get the user and have to set the selected user.
function getUser2(){

    var selUser = document.getElementById("uid").value;

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
            document.getElementById("userSelect").innerHTML=xmlhttp.responseText;
        }
    };
    xmlhttp.open("POST","../functions/getUsrId.php?uid=getUsr2&selUser="+selUser,true);
    xmlhttp.send();
}