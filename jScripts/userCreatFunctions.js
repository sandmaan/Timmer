/**
 * Created by SiNUX on 4/7/2017.
 */

function checkEmpty() {
    var msg = document.getElementById('msg'),
        fName = document.getElementById('fName'),
        lName = document.getElementById('lName'),
        uName = document.getElementById('uName'),
        pass1 = document.getElementById("pWord1");

    //Using ajax made the function to check if the text box value is empty or not
    //when that text box has focus.
    if ($("#fName").is(':focus')){
        if (fName.value.length <= 3){
            msg.innerHTML = "First name is too short";
        }else{
            msg.innerHTML = "";
            lName.disabled = false;
        }
    }

    if ($("#lName").is(':focus')){
        if (lName.value === fName.value){
            msg.innerHTML = "Last and first name can't be the same";
            pass1.disabled = true;
        }else{
            if (lName.value.length <= 3){
                msg.innerHTML = "Last name is too short";
            }else{
                msg.innerHTML = "";
                uName.disabled = false;
            }
        }
    }

    if ($("#uName").is(':focus')){
            if (uName.value.length <= 3){
                msg.innerHTML = "User name is too short";
                pass1.disabled = true;
            }else{
                if(uName.value.length > 0){
                    checkUname();
                }
            }
    }

    function checkUname() {

        if(window.XMLHttpRequest)
        {
            xmlhttp=new XMLHttpRequest();
        }
        else
        {
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange=function(){

            if(xmlhttp.readyState==4 && xmlhttp.status==200){
                if (xmlhttp.responseText === "1"){
                    msg.innerHTML="Username taken";
                    pass1.disabled = true;
                }else{
                    msg.innerHTML = "";
                    pass1.disabled = false;
                }
            }
        };
        xmlhttp.open("POST","../Functions/matchUname.php?uName="+uName.value,true);
        xmlhttp.send();
    }
}

function checkLength() {
    var pass1 = document.getElementById("pWord1"),
        pass2 = document.getElementById("pWord2"),
        passLength1 = pass1.value.length;

    if(passLength1 <= 4){
        document.getElementById("msg").innerHTML ="Password is less than 4 characters!";
    }else{
        document.getElementById("msg").innerHTML ="";
        pass2.disabled = false;
    }
}

function checkPass() {
    var pass1 = document.getElementById("pWord1"),
        pass2 = document.getElementById("pWord2"),
        uTeam = document.getElementById("uTeam"),
        matchColor = "#66cc66",
        noMatchColor = "#ff6666";

    if (pass1.value === pass2.value){
        document.getElementById("msg").innerHTML ="Passwords match!";
        pass1.style.backgroundColor = matchColor;
        pass2.style.backgroundColor = matchColor;
        uTeam.disabled = false;
    }else{
        document.getElementById("msg").innerHTML ="Passwords do not match!";
        pass1.style.backgroundColor = noMatchColor;
        pass2.style.backgroundColor = noMatchColor;
    }
}

// DON'T DELETE THIS CAN BE USED IN FUTURE
// function enableRoles() {
//     var team = document.getElementById("uTeam").value,
//         teamId = document.getElementById("uTeamId").value,
//         tlCheck = document.getElementById("tl"),
//         role = document.getElementsByClassName("userRoles");
//
//     if (team !== ""){
//         //For loop to enable radio buttons
//         for (var i = 1; i < role.length; i++){
//             role[i].disabled = false;
//
//                 //This part will take the team is from uTeamId text box
//                 //send it to getTeam.php checks if that team has a leader if that team has a leader
//                 //"set" value will be returned making the check box for team attribute team leader disabled.
//                 if(window.XMLHttpRequest){
//
//                     xmlhttp=new XMLHttpRequest();
//
//                 }else{
//
//                     xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
//                 }
//
//                 xmlhttp.onreadystatechange=function(){
//
//                     if(xmlhttp.readyState==4 && xmlhttp.status==200){
//
//                         // document.getElementById("msgID").innerHTML = xmlhttp.responseText;
//                         tlCheck.disabled = xmlhttp.responseText === "set";
//
//                     }
//                 };
//                 xmlhttp.open("POST","../Functions/getTeam.php?teamId="+teamId,true);
//                 xmlhttp.send();
//             }
//
//         }
// }

$(document).ready(function () {
    /*Register the change element to #roles
     || When clicked...*/

    //This code base was originally developed by zer00ne I'm using it under his permission
    //Thanks man

    var form = document.getElementById('userRoles');

    if (form){
        form.addEventListener('change', function(e) {

                /* Determine if the e.target (radio that's clicked)
                 || is NOT e.currentTarget (#roles)
                 */
                if (e.target !== e.currentTarget) {

                    // Assign variable to e.target
                    var target = e.target;

                    // Reference the submit button
                    var btn = document.querySelector('[name=submit]');

                    // Enable submit button
                    btn.disabled = false;

                    // call rolrDist() passing the target,value
                    roleDist(target.value);
                }
        }, false);
    }

    function roleDist(rank) {
        var display = document.getElementById("msg");

        if (rank !== null) {
            display.innerHTML = "All done! You can save";
        } else {
            display.innerHTML = "Please Select User Type";
        }
    }
});

function createUser(){
    var uId = document.getElementById("uId").innerHTML,
        date = document.getElementById("date").innerHTML,
        fName = document.getElementById("fName").value,
        lName = document.getElementById("lName").value,
        uName = document.getElementById("uName").value,
        pword = document.getElementById("pWord2").value,
        team = document.getElementById("uTeamId").value,
        uRole = document.querySelector('input[name="userRoles"]:checked').value;
    if(document.querySelector('input[id="tl"]:checked') !== null){
        var tl = document.querySelector('input[id="tl"]:checked').value;
    }

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
    xmlhttp.open("POST","../Admin/creatUserProcess.php?uId="+uId+"&udate="+date+"&fName="+fName+
        "&lName="+lName+"&uName="+uName+"&pword="+pword+"&team="+team+"&uRole="+uRole+"&tl="+tl,true);
    xmlhttp.send();
}

//Get the team details from teams data base
function getTeam(){
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
            document.getElementById("uTeam").innerHTML=xmlhttp.responseText;
        }
    };
    xmlhttp.open("POST","../Functions/getTeam.php?team=getTeam",true);
    xmlhttp.send();
}

function getLeaderInfo(){
    var teamId = document.getElementById("uTeamId").value,
        msg = document.getElementById("msg"),
        tlCheck = document.getElementById("tl");


    if(window.XMLHttpRequest){

        xmlhttp=new XMLHttpRequest();

    }else{

        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

    }
    xmlhttp.onreadystatechange=function(){
        if(xmlhttp.readyState==4 && xmlhttp.status==200){

            // document.getElementById("msgID").innerHTML = xmlhttp.responseText;
            if (xmlhttp.responseText === "set"){
                tlCheck.disabled = true;
                msg.innerHTML = "Team leader already set";
            }else{
                tlCheck.disabled = false;
                msg.innerHTML = ""
            }

        }

    };
    xmlhttp.open("POST","../Functions/getTeam.php?teamId="+teamId,true);
    xmlhttp.send();

}
