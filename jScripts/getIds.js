/**
 * Created by SiNUX on 4/4/2017.
 */

//Get's the Category ID when user selects
function catId(cId) {
    var select = document.getElementById("catSelect"),
        optionId = select.options[select.selectedIndex];
    document.getElementById("cateId").value = optionId.id;
}

//Get's the Client ID when user selects
function clientId(clId) {
    var clselect = document.getElementById("clientSelect"),
        cloptionId = clselect.options[clselect.selectedIndex];
    document.getElementById("clintId").value = cloptionId.id;
}

//Get's the Team ID when user selects
function teamId(tId) {
    var uTeam = document.getElementById("uTeam"),
        teamId = uTeam.options[uTeam.selectedIndex];
    document.getElementById("uTeamId").value = teamId.id;
}

//Get's the User ID when user selects
function usrId(uId) {
    var usrId = document.getElementById("userSelect"),
        usrsId = usrId.options[usrId.selectedIndex];
    document.getElementById("uid").value = usrsId.id;
}