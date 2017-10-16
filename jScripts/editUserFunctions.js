/**
 * Created by SiNUX on 5/3/2017.
 */

function userEditLoader() {

    getSvrDate();
    setTimeout("getTeamEdit()",100);

}

function updateUsr() {

    updateUser();
    setTimeout("setMsg()",100);
    setTimeout("reload()",100);

}

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
                }
            }
        };
        xmlhttp.open("POST","../Functions/matchUname.php?uName="+uName.value,true);
        xmlhttp.send();
    }
}

function createTeamList() {
    var team = document.getElementById("uTeam").value,
        teamId = document.getElementById("uTeamId").value,
        tlCheck = document.getElementById("tl"),
        role = document.getElementsByClassName("userRoles");

    // if (team !== ""){
    //     //For loop to enable radio buttons
    //     for (var i = 0; i < role.length; i++){
    //         role[i].disabled = false;

            //This part will take the team is from uTeamId text box
            //send it to getTeam.php checks if that team has a leader if that team has a leader
            //"set" value will be returned making the check box for team attribute team leader disabled.
            if(window.XMLHttpRequest){

                xmlhttp=new XMLHttpRequest();

            }else{

                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange=function(){

                if(xmlhttp.readyState==4 && xmlhttp.status==200){

                    // document.getElementById("msgID").innerHTML = xmlhttp.responseText;
                    tlCheck.disabled = xmlhttp.responseText === "set";

                }
            };
            xmlhttp.open("POST","../Functions/getTeam.php?teamId="+teamId,true);
            xmlhttp.send();
    //     }
    //
    // }
}

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

function updateUser(){

    var teamId = document.getElementById("uTeamId").value,
        msg = document.getElementById("msg");

    if(window.XMLHttpRequest){

        xmlhttp=new XMLHttpRequest();

    }else{

        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function(){

        if(xmlhttp.readyState==4 && xmlhttp.status==200){

            //document.getElementById("msgID").innerHTML = xmlhttp.responseText;
            if (xmlhttp.responseText === "yes"){
                msg.innerHTML = "Team leader already set";
            }else{
                var uId = document.getElementById("uId").innerHTML,
                    fName = document.getElementById("fName").value,
                    lName = document.getElementById("lName").value,
                    uName = document.getElementById("uName").value,
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
                xmlhttp.open("POST","../Admin/updateUser.php?uId="+uId+"&fName="+fName+"&lName="+lName+"&uName="+uName+"&team="+team+"&uRole="+uRole+"&tl="+tl,true);
                xmlhttp.send();
            }

        }
    };
    xmlhttp.open("POST","../Functions/getTeamEdit.php?teamId="+teamId,true);
    xmlhttp.send();
}

//Get the team details from teams data base
function getTeamEdit(){

    var tid = document.getElementById("tid").value;

    if(window.XMLHttpRequest){

        xmlhttp=new XMLHttpRequest();

    }else{

        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function(){

        if(xmlhttp.readyState==4 && xmlhttp.status==200){

            document.getElementById("uTeam").innerHTML=xmlhttp.responseText;
        }
    };
    xmlhttp.open("POST","../Functions/getTeamEdit.php?tid="+tid,true);
    xmlhttp.send();
}