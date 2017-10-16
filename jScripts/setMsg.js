/**
 * Created by SiNUX on 4/5/2017.
 */

function setMsg() {
    var msg = parseInt(document.getElementById("msgID").innerHTML);

    if(msg === "1"){
        document.getElementById("msg").innerHTML = "Data saved ...";
    }else if(msg === "2"){
        document.getElementById("msg").innerHTML = "Some fields are empty, please re-check";
    }else if(msg === "3"){
        document.getElementById("msg").innerHTML = "You're not logged in";
    }else if(msg === "4") {
        document.getElementById("msg").innerHTML = "Your spent time can't be zero";
    }else if(msg === "5") {
        document.getElementById("msg").innerHTML = "Only numbers are allowed";
    }else if(msg === "6") {
        document.getElementById("msg").innerHTML = "First name can't be empty";
    }else if(msg === "7") {
        document.getElementById("msg").innerHTML = "Last name cant be empty";
    }else if(msg === "8") {
        document.getElementById("msg").innerHTML = "User name cant be empty";
    }else if(msg === "9") {
        document.getElementById("msg").innerHTML = "User role is not selected";
    }else if(msg === "10") {
        document.getElementById("msg").innerHTML = "Data not saved";
    }else if(msg === "11") {
        document.getElementById("msg").innerHTML = "Error while adding team leader";
    }else if(msg === "12") {
        document.getElementById("msg").innerHTML = "Creating user with attribute";
    }else if(msg === "13") {
        document.getElementById("msg").innerHTML = "User details updating";
    }else if(msg === "14") {
        document.getElementById("msg").innerHTML = "User password updated";
    }else if(msg === "15") {
        document.getElementById("msg").innerHTML = "User password not updated";
    }else if(msg === "16") {
        document.getElementById("msg").innerHTML = "Record removed";
    }else if(msg === "17") {
        document.getElementById("msg").innerHTML = "Record not removed";
    }else if(msg === "18") {
        document.getElementById("msg").innerHTML = "No ID to select";
    }else if(msg === "19") {
        document.getElementById("msg").innerHTML = "Value already exists";
    }else{
        document.getElementById("msg").innerHTML = "Processing ...";
    }
}