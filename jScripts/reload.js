/**
 * Created by SiNUX on 4/5/2017.
 */

function check() {
    var inText = document.getElementById("msgID").innerHTML;

    if (inText === "1" || inText === "12" || inText === "13"){
        document.getElementById("msg").innerHTML = "Saved";
            window.location.reload();
    }
}

function reload() {
    setTimeout("check()",5000);
}

function resetForm() {
    window.location.reload();
}

function resetForm2() {
    window.location.reload();
}