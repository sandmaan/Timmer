// JavaScript Document
//Claculator to claclate the time diffrence

function timeDifference() {
    var startTime = document.getElementById("endTime").value,
		endTime = document.getElementById("startTime").value;

	//Don't change the date it's needed to be there for the calculation to function.
	//This converts the time which makes it easier to do the calculation.
	var startDate = new Date("January 1, 1970 " + startTime),
		endDate = new Date("January 1, 1970 " + endTime),
		timeDiff = Math.abs(startDate - endDate);

	var hh = Math.floor(timeDiff / 1000 / 60 / 60);
	if(hh < 10) {
    	hh = '0' + hh;
	}
	timeDiff -= hh * 1000 * 60 * 60;
		var mm = Math.floor(timeDiff / 1000 / 60);
	if(mm < 10) {
    	mm = '0' + mm;
	}
	timeDiff -= mm * 1000 * 60;
		var ss = Math.floor(timeDiff / 1000);
	if(ss < 10) {
    	ss = '0' + ss;
	}
	
	var tDif = hh + ":" + mm + ":" + ss;
	document.getElementById("spentTime").value = tDif;
}