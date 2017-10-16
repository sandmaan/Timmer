/**
 * Created by SiNUX on 4/27/2017.
 */

//Timed process for updating user information on button click
function usrUpdProcess() {

    updUsrPass();
    setTimeout("setMsg()",1000);
    setTimeout("autoClose()",2000);

}

//Timed process for deleting the user from the system
function usrDelProcess() {

    delUsr();
    setTimeout("setMsg()",1000);
    setTimeout("autoClose()",2000);
    setTimeout("resetForm()",1000);

}

$(document).ready(function () {
    //Click function edit the user
    $('.uEdit').click(function (){
        var uId = $(this).data("uid");

        $('#bgDimmer').show();
        $('#divContent').show().load('editUser.php?uId='+uId);
    });

    //Click event for password change button
    $('.chgPass').click(function (){
        var uId = $(this).data("uid");

        $('#bgDimmer').show();
        $('#divContent').show().load('chgPass.php?uId='+uId);
    });

    //Click event to delete user
    $('.uDel').click(function (){
        var uId = $(this).data("uid");

        $('#bgDimmer').show();
        $('#divContent').show().load('deleteUser.php?uId='+uId);
    });

    //Function for the pop up with the background dimmer
    $(document).mouseup(function(x) {
        var container = $("#divContent"),
            dimmer = $('#bgDimmer');
        if (container.is(":visible")) {
            if (!container.is(x.target) //check if the target of the click isn't the container...
                && container.has(x.target).length === 0) {
                container.hide();
                dimmer.hide();
            }
        }
    });

    //Close button for the pop up user edit dive
    $('#close').click(function () {
        $('#bgDimmer').hide();
        $('#divContent').hide();
    });

    $('#cancel').click(function () {
        $('#bgDimmer').hide();
        $('#divContent').hide();
    });

    //close button for other popups (Pass change and Delete)
    $('.clsBtn').click(function () {
        $('#bgDimmer').hide();
        $('#divContent').hide();
        $('#divDelMsg').hide();
    });

});

//Check password lengths mach for password change pop up
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

// Check if passwords mach for change password pop up
function checkPass(){

    var pass1 = document.getElementById("pass1"),
        pass2 = document.getElementById("pass2"),
        btn = document.getElementById("change"),
        matchColor = "#66cc66",
        noMatchColor = "#ff6666";

    if (pass1.value === pass2.value){
        document.getElementById("msg").innerHTML ="Passwords match!";
        pass1.style.backgroundColor = matchColor;
        pass2.style.backgroundColor = matchColor;
        btn.disabled = false;
    }else{
        document.getElementById("msg").innerHTML ="Passwords do not match!";
        pass1.style.backgroundColor = noMatchColor;
        pass2.style.backgroundColor = noMatchColor;
        btn.disabled = true;
    }
}

function updUsrPass(){

    var uId = document.getElementById("uid").innerHTML,
        pass = document.getElementById("pass2").value;


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
    xmlhttp.open("POST","../Admin/chgPassProcess.php?uid="+uId+"&pass="+pass,true);
    xmlhttp.send();
}

function autoClose() {
    var msgChk = document.getElementById("msgID").innerHTML;

    if (msgChk === "14" || msgChk === "16"){
        $('#bgDimmer').hide();
        $('#divContent').hide();
        $('#divDelMsg').hide();
    }
}

function delUsr(){

    var uId = document.getElementById("uid").innerHTML;


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
    xmlhttp.open("POST","../Admin/deleteUserProcess.php?uid="+uId,true);
    xmlhttp.send();
}

