//Date picker
$(function () {
    $('#dPicker').datepicker({
        dateFormat: 'dd-mm-yy',
        showAnim: 'slide'
    });
});

function popup() {
    //Click function edit the user
    $('.jDetail').click(function (){
        var usrid = $(this).data("usrid"),
            date = $(this).data("date");

        $('#bgDimmer').show();
        $('#divContent').show().load('jobList.php?usrid='+usrid+'&date='+date);
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
    $('.clsBtn2').click(function () {
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

//Send time to the table creation page
function getProdTotal(){

    var date = document.getElementById("dPicker").value;

    if (date === ""){
        document.getElementById("noDataMsg").innerHTML = "Date not selected";
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

        xmlhttp.open("POST","../Report/totalProductionTimeTable.php?date="+date,true);
        xmlhttp.send();
    }
}