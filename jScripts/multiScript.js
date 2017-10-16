/**
 * Created by SiNUX on 4/4/2017.
 */
/*Loads the first script then stops it after 1sec then loads the other one*/
function pauseLoad() {

    getSvrDate();
    setTimeout("getCat()",100);

}

function pauseLoad2() {

    timeSheetAdd();
    setTimeout("setMsg()",100);
    setTimeout("reload()",100);

}

function pauseLoad3() {

    createUser();
    setTimeout("setMsg()",1000);
    setTimeout("reload()",1000);

}

function pauseLoad4() {

    getSvrDate();
    setTimeout("getTeam()",100);

}