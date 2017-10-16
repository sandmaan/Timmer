//Disable the Start button after single click
function startBtnDisable(){
    document.getElementById("getStartTime").disabled = 'true';
}

//Disable the End button after single click
function endBtnDisable(){
    document.getElementById("getEndTime").disabled = 'true';
}

//Checks only numbers are entered in volume and number of product lines
function checkNum(i) {

    //language=JSRegexp
    var txt = i.value;

    if (isNaN(txt)){
        document.getElementById("msg").innerHTML = "Numbers only";
        i.value = "";
        return false
    }else{
        document.getElementById("msg").innerHTML = "";
        return true
    }

}

//Enable job type radio buttons
function enableJtype(){
    var client = document.getElementById("clientSelect").value,
        strTimeBtn = document.getElementById("getStartTime"),
        jType = document.getElementsByClassName("jType");

    if (client !== "") {
        if (client === "Break"){
            for (var j = 0; j < jType.length; j++) {
                jType[j].disabled = true;
            }
            strTimeBtn.disabled = false;
            strTimeBtn.focus();
        } else {
            //For loop to enable radio buttons
            for (var i = 0; i < jType.length; i++) {
                jType[i].disabled = false;
                jType[0].focus();
            }
        }
    } else {
        for (var j = 0; j < jType.length; j++) {
            jType[j].disabled = true;
            jType[0].focus();
        }
    }
}

// Show or hide the div which contains the error inputs
// If the QC job type is selected.
$(document).ready(function () {
    $('.jType').click(function () {
        if($('#qc').is(':checked')){
            $('#jType-container').show(); //Show the content of the error container div
            getError();//Populates the error name drop down
        }else{
            $('#jType-container').hide();
        }
        $('#getStartTime').prop('disabled',false).focus();//Enables the get start time button
    });

    $('#getStartTime').mousedown(function () {
            $('#getEndTime').prop('disabled',false).focus();//Enables the get end time button
            $('.addRow').prop('disabled',false);
            $('.errorName').prop('disabled',false);
    });

    //Set the selected error ID as the value of the errorId text box
    $(document).on('change','.errorName', function () {
        var sid = $(this).find('option:selected').attr('id');
        $('.errorId').filter(':last').val(sid);
    });

    //Form validation
    $(document).on('click', '#submit', function () {
        var error = false,
            errorIndex = $('.errorName').prop('selectedIndex'),
            regX = new RegExp("^[a-zA-Z0-9'. ,=s]+$");

        if ($('#endTime').val() === ""){
            alert("End time can't be empty");
            $('#endTime').toggleClass('error');
            return error = true;
        } else {
            $('#endTime').toggleClass('noError');
        }

        if ($('#volume').val() === ""){
            alert("Volume can't be empty");
            $('#volume').toggleClass('error');
            return error = true;
        } else {
            $('#volume').toggleClass('noError');
        }

        if ($('#remarks').val() !== ""){
            if (!regX.test($('#remarks').val())){
                alert("Only characters allowed" );
                $('#remarks').toggleClass('error');
                return error = true;
            }else{
                $('#remarks').toggleClass('noError');
            }
        }

        if($('#qc').is(':checked')){
            if (errorIndex === 0){
                alert('Please select an error name');
                return error = true;
            }
        }

        if (error === false){
            pauseLoad2();
        }
    });

    //Enable the client list after selecting the category
    $(document).on('change', '#catSelect', function () {
        $('#clientSelect').prop('disabled', false).focus();
    });

    //Upon clicking the getEndTime button focus will be switched to volume text box
    $(document).on('click', '#getEndTime', function () {
        $('#volume').focus();
    });
});

// Add and remove function for the error text boxes
$(document).ready(function() {
    $(document).on('click', '.addRow', function() {
        var selectedIndex = $('.errorId').filter(':last').val();
        if(selectedIndex !== ""){
            // $('.error-Column .error-container:last').clone().appendTo('.error-Column');//Clones the row

            // --- Disabled due to is clones and resets the value of the drop down box
            var $clone = $('.error-Column .error-container:last').clone().appendTo('.error-Column');

            //If checks for the utid if it's there the new drop downs first value on the edit form
            //will be set as "----- Select Error -----"
            if($('#utid').text() !== ""){
               $clone.find('select.errorName').val("----- Select Error -----");
            }
            $clone.find('.errorId').val('');//Find the errorId text box and makes value = ""
            $clone.find('select.errorName').focus();//When cloned set the focus to the error selector

            $('.addRow').prop('disabled', true).filter(':last').prop('disabled', false);//Add a row and disables add buttons above
            resetErrorNo();//Reset the values
            getError();//Pulls the errors from the DB

        }else{
            alert("Select an error name");
        }
    }).on('click', '.delRow', function() {
        var $btn = $(this);
        if (confirm('Your sure you want to remove this?')) {
            $btn.closest('.error-container').remove();//Removes the row
            $('.addRow').prop('disabled', true).filter(':last').prop('disabled', false);//Enables the last add button
            resetErrorNo();//Reset the values
        }
    }).on('mouseover','.error-container',function () {
        if($('#startTime').val()===""){
            alert("Set job start time");
        }
    });
});

//Reset the entire error count number index
function resetErrorNo(){
    $(".errorCount").each(function(index, _this) {
        $(this).val(index + 1);
    });
}

//The function to drag the error data from the table qcErrors and populate the drop downs
function getError(){
    //Set the drop down as a variable
    var errorSelect = document.getElementById("errorName");

    if(window.XMLHttpRequest){

        xmlhttp=new XMLHttpRequest();

    }else{

        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

    }xmlhttp.onreadystatechange=function(){
        if(xmlhttp.readyState==4 && xmlhttp.status==200){
            if(errorSelect.selectedIndex === 0){
                errorSelect.innerHTML = xmlhttp.responseText;
            }
        }
    };
    xmlhttp.open("POST","../functions/getQcErrors.php",true);
    xmlhttp.send();
}

function getError2(){
    //Get the selected ID using this.is in client side HTML then breaks it up using this to get the ID only
    if (document.getElementById("utid").innerHTML !== "") {
        var utid = document.getElementById("utid").innerHTML;
    }else{
        utid = null;
    }

    if(window.XMLHttpRequest){

        xmlhttp=new XMLHttpRequest();

    }else{

        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

    }xmlhttp.onreadystatechange=function(){
        if(xmlhttp.readyState==4 && xmlhttp.status==200){

            document.getElementById("errorArea").innerHTML = xmlhttp.responseText;

        }
    };
    if(utid === null){
        alert("User time ID is not set, Are you sure you're in the right place." );
    }else{
        xmlhttp.open("POST","../functions/getQcErrors.php?utid="+utid,true);
        xmlhttp.send();
    }
}