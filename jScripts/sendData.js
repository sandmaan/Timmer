/**
 * Created by SiNUX on 4/4/2017.
 */
//This will submit all the data from operatorui.php will be sent process PHP to add everything to the data base
function timeSheetAdd() {

    //Check if the uId element is in the form or not
    if(document.getElementById("uId")){
        var uId = document.getElementById("uId").innerHTML;
    }

    //Checks for the utid element if it's there then the value will be assigned if not null will be passed
    if(document.getElementById("utid")){
        var utid = document.getElementById("utid").innerHTML;
    }else{
        utid = null;
    }

    //Declaration of variables start
    var jType = document.querySelector("input[name=jType]:checked").value,
        eId = document.getElementsByName("errorId"),
        date = document.getElementById("date").innerHTML,
        sTime = document.getElementById("startTime").value,
        eTime = document.getElementById("endTime").value,
        spTime = document.getElementById("spentTime").value,
        vl = document.getElementById("volume").value,
        nPl = document.getElementById("noPl").value,
        rem = document.getElementById("remarks").value;
    //Declaration of variables end

    if (document.getElementById("cid") === null) {
        var cat = document.getElementById("cateId").value;
    } else {
        cat = document.getElementById("cid").value;
    }

    if (document.getElementById("clid") === null) {
        var clId = document.getElementById("clintId").value;
    } else {
        clId = document.getElementById("clid").value;
    }

    var errorIds = [];
    for (var i = 0; i < eId.length; i++) {
        errorIds.push(eId[i].value);
    }
    var errorId = errorIds.join(',');

    if (jType === "QC") {

        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("msgID").innerHTML = xmlhttp.responseText;
            }
        };
        if (utid !== null) {
            xmlhttp.open("POST", "../Functions/TimeSheetSubmit.php?utid=" + utid + "&jdate=" + date + "&cat=" + cat + "&clientid=" + clId + "&jType=" + jType + "&stTime=" + sTime + "&enTime=" + eTime
                + "&spnTime=" + spTime + "&vol=" + vl + "&errorId=" + errorId + "&pl=" + nPl + "&rem=" + rem, true);
            xmlhttp.send();
        } else {
            xmlhttp.open("POST", "../Functions/TimeSheetSubmit.php?uId=" + uId + "&jdate=" + date + "&cat=" + cat + "&clientid=" + clId + "&jType=" + jType + "&stTime=" + sTime + "&enTime=" + eTime
                + "&spnTime=" + spTime + "&vol=" + vl + "&errorId=" + errorId + "&pl=" + nPl + "&rem=" + rem, true);
            xmlhttp.send();
        }
    } else {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("msgID").innerHTML = xmlhttp.responseText;
            }
        };
        if (utid !== null) {
            xmlhttp.open("POST", "../Functions/TimeSheetSubmit.php?utid=" + utid + "&jdate=" + date + "&cat=" + cat + "&clientid=" + clId + "&jType=" + jType + "&stTime=" + sTime + "&enTime=" + eTime
                + "&spnTime=" + spTime + "&vol=" + vl + "&errorId=" + errorId + "&pl=" + nPl + "&rem=" + rem, true);
            xmlhttp.send();
        } else {
            xmlhttp.open("POST", "../Functions/TimeSheetSubmit.php?uId=" + uId + "&jdate=" + date + "&cat=" + cat + "&clientid=" + clId + "&jType=" + jType + "&stTime=" + sTime + "&enTime=" + eTime
                + "&spnTime=" + spTime + "&vol=" + vl + "&errorId=" + errorId + "&pl=" + nPl + "&rem=" + rem, true);
            xmlhttp.send();
        }
    }
}

function tmpDataAdd(){

    var uId = document.getElementById("uId").innerHTML,
        tId = document.getElementById("tId").innerHTML,
        cat = document.getElementById("cateId").value,
        clId = document.getElementById("clintId").value,
        sTime = document.getElementById("startTime").value;

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
        xmlhttp.open("POST","../Functions/tmpDataAdd.php?db=temp&stat=Active&uId="+uId+"&tid="+tId+"&cat="+cat+"&clientid="+clId+"&stTime="+sTime,true);
        xmlhttp.send();
}

function statUpd(){

    var uId = document.getElementById("uId").innerHTML;

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
        xmlhttp.open("POST","../Functions/tmpDataAdd.php?db=temp&stat=Finished&uId="+uId,true);
        xmlhttp.send();
}