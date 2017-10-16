/**
 * Created by SiNUX on 5/23/2017.
 */
function tEditReload2() {
    getUser2();
    setTimeout("getData();",100);
}

$(function () {
    $('#dPicker').datepicker({
        dateFormat: 'dd-mm-yy',
        showAnim: 'slide'
    });
});

//Send selected date and the selected user name to the database in order to retrieve the corresponding data
function getData(){

    var sbId = document.getElementById("sbId").innerHTML,
        date = document.getElementById("dPicker").value,
        uid = document.getElementById("uid").value;

    if (date === ""){
        document.getElementById("noDataMsg").innerHTML = "Date not selected";
    }else if (uid === ""){
        document.getElementById("noDataMsg").innerHTML = "User not selected";
    }else{
        if(window.XMLHttpRequest){

            xmlhttp=new XMLHttpRequest();

        }else{

            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function(){

            if(xmlhttp.readyState==4 && xmlhttp.status==200){

                document.getElementById("resultTable").innerHTML = this.responseText;
            }
        };

        xmlhttp.open("POST","../functions/timeEditResult.php?date="+date+"&uid="+uid+"&sbId="+sbId,true);
        xmlhttp.send();
    }
}