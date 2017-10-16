//Function to detected and clean special characters
$(document).ready(function () {
    $(document).on('keyup', '.dbDetails', function () {
        var regX = new RegExp("^[a-zA-Z0-9_]+$"), // RegEx for user name, dbName and dbPass
            regXurl = new RegExp("^[a-zA-Z0-9:/_]+$");// RegEx for the dbHost URL

        if ($(this).prop('id') !== "dbHost" && $(this).val() !== "") {
            if (!regX.test($(this).val())) {
                //Checks all the inputs expect the db host name
                var strClean = $(this).val().replace(/[^a-zA-Z0-9_]/g, "");
                //Replace the CSS class to mark it if the input unacceptable
                $(this).val(strClean).removeClass("dbDetails-good").addClass("dbDetails dbDetails-error");
                //Fade animation for the error message at the bottom
                $("#dbConfig-msg span").removeClass("fadeOut").addClass("fade");
            }
            if (regX.test($(this).val())) {
                //Test and reset the class and the error message if the input is ok
                $(this).removeClass("dbDetails-error").addClass("dbDetails dbDetails-good");
                $("#dbConfig-msg span").removeClass("fade").addClass("fadeOut");
            }
        } else {
            if ($(this).val() !== "") {
                //This checks the URL input and only allows :, _ and / as special characters
                if (!regXurl.test($(this).val())) {
                    var strCleanUrl = $(this).val().replace(/[^a-zA-Z0-9:/_]/g, "");
                    $(this).val(strCleanUrl).removeClass("dbDetails-good").addClass("dbDetails dbDetails-error");
                    $("#dbConfig-msg span").removeClass("fadeOut").addClass("fade");
                }
                if (regXurl.test($(this).val())) {
                    $(this).removeClass("dbDetails-error").addClass("dbDetails dbDetails-good");
                    $("#dbConfig-msg span").removeClass("fade").addClass("fadeOut");
                }
            }
        }
    });

    //Check all the inputs if they're empty or not
    $(document).on('click', '#dbSubmit', function () {
        var noEmpty = true;

        $('.dbDetails').each(function () {
            if($(this).val() === ""){
                $(this).addClass("dbDetails-error");
                $('#response').html("<span style='color: red;'>Fields can't be empty</span>");
                noEmpty = false;
            }
            return noEmpty;
        });

        //If all the data fields are not empty and user confirms the input
        //This will call the JSON function to send and receive the data.
        if(noEmpty && confirm('Are you sure all details to be true?')){
            createConfig();
            setTimeout('checkResponse();', 1000);
        }
    }).on('click', '#next-step', function () {
        $('#nextstep').hide();
        $('#success-text').hide();
        $('#next-step').hide();
        $('#table-gen').show();
        $('#table-gen-next').show();

        if($('#success-text-table-gen').show()){
            createTables();
        }
    }).on('click', '#table-gen-next', function () {
        $('#table-gen').hide();
        $('#table-gen-next').hide();
        $('#success-text-table-gen').hide();
        checkInitUser();
    }).on('keyup', '.initial-user', function () {
        var regX = new RegExp("^[a-zA-Z0-9_]+$"); // RegEx for user name and uPass

            if(!regX.test($(this).val())){
                //Checks all the inputs and replace all the not allowed characters.
                var strClean = $(this).val().replace(/[^a-zA-Z0-9_]/g, "");
                //Add the cleaned string to the text box value
                $(this).val(strClean)
            }

    }).on('click', '#create-admin', function () {
        createInitialUser();
    });

    $(document).on('keyup','#uPass2',function () {
        var pass1 = $('#uPass').val(),
            pass2 = $('#uPass2').val();

        if (pass1 !== pass2){
            $('#response').prop('hidden', false).html("<span style='color:red;'>Passwords doesn't match</span>");
        }else{
            $('#response').prop('hidden', true);
        }
    }).on('keyup','#uPass',function () {
        var passLen = $('#uPass').val().replace(/ /g,'').length;
        if(passLen < 4){
            $('#response').prop('hidden', false).html("<span style='color:red;'>Password must have more than 4 characters</span>");
        }else{
            $('#response').prop('hidden', true);
        }
    }).on('click', '#finish',function () {
        $('#bgDimmer').hide();
        $('#divContent').hide();
        location.reload();
    })
});

//Send all the data to the processing PHP to create the node.php file
function createConfig(){
    var dbUser = document.getElementById("dbUser").value,
        dbPass = document.getElementById("dbPass").value,
        dbName = document.getElementById("dbName").value,
        dbHost = document.getElementById("dbHost").value;

    if(window.XMLHttpRequest){
        xmlhttp=new XMLHttpRequest();
    }else{
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function(){
        if(xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("response").innerHTML=xmlhttp.responseText;
        }
    };
    xmlhttp.open("POST","./bin/config/createConfig.php?dbUser="+dbUser+"&dbPass="+dbPass+"&dbName="+dbName+"&dbHost="+dbHost,true);
    xmlhttp.send();
}

//This will check the response text in response div and then check the database connection
function checkResponse(){
    var res = $('#response').text();
    if(res === "Saved"){
        $.ajax({
           url: './bin/config/createConfig.php',
           type:'get',
           data:{check:'check'},
           dataType:'text',
           complete: function (data) {
               if(data.responseText === "Connected"){
                   $('#nextstep').show();
                   $('#success-text').show();
                   $('#next-step').show();
                   $('#dbConfig-details').hide();
                   $('#response').prop('hidden',true);
               }else{
                   $('#response').html("<span style='color:red;'>Database connection not successful</span>");
               }
           }
        });
    }
}

//This creates the tables needed by the system and shows the response text from the processing php
function createTables() {
    $.ajax({
        url: './bin/config/dbCreate.php',
        type: 'get',
        data: {create: 'create'}
    }).then(function (response) {
        $('#success-text-table-gen').html(response);
    });
}

function createInitialUser(){
    var noEmpty = true;

    $('.initial-user').each(function () {
        if($(this).val() === ""){
            $(this).addClass("dbDetails-error");
            $('#response').html("<span style='color: red;'>Fields can't be empty</span>");
            return noEmpty = false;
        }
        return noEmpty;
    });

    if(noEmpty && confirm('Are you sure ?')) {
        $.ajax({
            url: './bin/config/initUser.php',
            type: 'get',
            data: {
                'uFname': $('#uFname').val(),
                'uLname': $('#uLname').val(),
                'uName': $('#uName').val(),
                'uPass': $('#uPass').val()
            }
        }).then(function (response) {
            if (response === "Saved") {
                $('#popup-div').removeClass("popup-container2").addClass("popup-container");
                $('#admin-create').hide();
                $('#admin-create-form').hide();
                $('#create-admin').hide();
                $('#setup-end').show();
                $('#finish').show();
            }
        });
    }
}

function checkInitUser() {
    $.ajax({
        url:'./bin/config/initUser.php',
        type: 'get',
        data:{
            'check': 'check'
        }
    }).then(function (data) {
        if (data === 1){
            $('#popup-div').removeClass("popup-container2").addClass("popup-container");
            $('#admin-create').hide();
            $('#admin-create-form').hide();
            $('#create-admin').hide();
            $('#setup-end').show();
            $('#finish').show();
        }else{
            $('#admin-create').show();
            $('#admin-create-form').show();
            $('#create-admin').show();
            $('#popup-div').removeClass("popup-container").addClass("popup-container2");
        }
    })
}