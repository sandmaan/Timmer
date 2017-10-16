/**
 * Created by SiNUX on 4/12/2017.
 */

$(document).ready(function () {// This will only enable the uName text if the page is fully loaded.
    $('#uName').prop('disabled', false).focus();
});

function chkUname() {
    var uName = document.getElementById("uName");

    // pWord.disabled = uName.value.length <= 3;

    if(window.XMLHttpRequest){

        xmlhttp=new XMLHttpRequest();

    }else{

        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function(){

        if(xmlhttp.readyState==4 && xmlhttp.status==200){

            var pWord = document.getElementById("pWord"),
                matchColor = "#66cc66",
                noMatchColor = "#ff6666";

            //document.getElementById("msg").innerHTML = xmlhttp.responseText;
            if (xmlhttp.responseText === "1"){
                document.getElementById("msg").innerHTML = "User Name Matched!";
                pWord.disabled = false;
                pWord.focus();
                uName.style.backgroundColor = matchColor;
            }else{
                document.getElementById("msg").innerHTML = "User Name incorrect";
                uName.style.backgroundColor = noMatchColor;
            }

        }
    };
    xmlhttp.open("POST","../bin/Functions/loginProcess.php?&uName="+uName.value,true);
    xmlhttp.send();
}

function getLogin(){

    var pword = document.getElementById("pWord").value,
        uName = document.getElementById("uName").value;

    if(window.XMLHttpRequest){

            xmlhttp=new XMLHttpRequest();

        }else{

            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange=function(){

            if(xmlhttp.readyState==4 && xmlhttp.status==200){

                var pword1 = document.getElementById("pWord"),
                    matchColor = "#66cc66",
                    noMatchColor = "#ff6666";

                //document.getElementById("msg").innerHTML = xmlhttp.responseText;
                if (xmlhttp.responseText === "3"){
                    document.getElementById("msg").innerHTML = "Done!";
                    pword1.style.backgroundColor = matchColor;

                    window.location = "../bin/Functions/selecter.php";

                }else{
                    document.getElementById("msg").innerHTML = "Password incorrect";
                    pword1.style.backgroundColor = noMatchColor;
                }

            }
        };
        xmlhttp.open("POST","../bin/Functions/loginProcess.php?&pWord="+pword+"&uName="+uName,true);
        xmlhttp.send();
}