/**
 * Created by SiNUX on 5/30/2017.
 */

//Timed process for updating user time entries
function tEditReload() {
    timeSheetAdd();
    setTimeout("setMsg();",100);
    setTimeout("closeForm();",5000);
    setTimeout("resetForm2();",1000);
}

function delTimeProcess() {
    delTimeEntry();
    setTimeout("setMsg();",1000);
    setTimeout("closeForm();",2000);
    setTimeout("resetForm2();",1000);
}

function popup() {
    //Click function edit the user
    $('.utEdit').click(function (){
        var utId = $(this).data("utid");

        $('#bgDimmer').show();
        $('#divContent').show().load('timeEditForm.php?utid='+utId);
    });

    //Click event to delete user
    $('.utDel').click(function (){
        var utid = $(this).data("utid");

        $('#bgDimmer').show();
        $('#divContent').show().load('deleteTimeEntry.php?utid='+utid);
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

}

function closBtn() {
    //Close button for the pop up user edit dive
    $('#close-timeEdit').click(function () {
        $('#bgDimmer').hide();
        $('#divContent').hide();
    });
}

function closeForm() {
    var inText = document.getElementById("msgID").innerHTML;

    if (inText === "1" || inText === "16"){
        document.getElementById("msg").innerHTML = "Saved";
        $('#bgDimmer').hide();
        $('#divContent').hide();
    }
}

function delTimeEntry(){
    var utid = document.getElementById("utid").innerHTML;

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
    xmlhttp.open("POST","delTimeEntryProcess.php?utid="+utid,true);
    xmlhttp.send();
}