
/* This function was borrowed from INFO 2300 lecture notes */
function msg(id,message) {

	//var node = document.getElementById(id);
	
	if (trim(message) == "") {
		/* Set message to non-breakable space */
		message = String.fromCharCode(160);
	}	
	//node.firstChild.nodeValue = message;
	$("#"+id).text(message);
}

/* This function was borrowed from INFO 2300 lecture notes */
function trim(str)
{
  return str.replace(/^\s+|\s+$/g, '')
};


function validYearAdd(year) {
	var check = /^[0-9]{4}$/;
	
	if (trim(year) == "") {
		msg("year_msg","  Required");
		return false;
	} else if (check.test(year)) {
		msg("year_msg","");
		return true;
	} else {
		msg("year_msg","  Invalid year");
		return false;
	}
}

function validYearSearch(year) {
	var check = /^[0-9]{4}$/;
	
	if (trim(year) == "") {
		return true;
	} else if (check.test(year)) {
		msg("year_msg","");
		return true;
	} else {
		msg("year_msg","  Invalid year");
		return false;
	}
}