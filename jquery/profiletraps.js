var upperCase= new RegExp('[A-Z]');
var lowerCase= new RegExp('[a-z]');
var numbers = new RegExp('[0-9]');
var space = new RegExp('[ ]');
var correctEmail = new RegExp('[@]');
var angleBrace = new RegExp('[<>]');
var point = new RegExp('[.]');
var nonword = new RegExp('\W');

function checkSubmitValidity() {

	if($('#nosMessage').text() != "" || $('#descriptionMessage').text() != "" || $('#priceMessage').text() != "" || $('#typeMessage').text() != "" || $('#pictureMessage').text() != "" || $('#quantityMessage').text() != "" || $('input[name="servicename"]').val() == "" || $('textarea[name="description"]').val() == "" || $('input[name="price"]').val() == "" || $('select[name="type"]').val() == "" || $('input[name="quantity"]').val() == "") {
		$('#submit').attr('disabled', 'disabled');
	}
	else {
		$('#submit').removeAttr('disabled');
	}

}

function checkLength(ss, message, len) {
	if(ss.length<len) {
		if(message!="") {
			message+=" and atleast " +len+ " characters";
		}
		else {
			message="Atleast " +len+ " characters";
		}

	}
	return message;
}

function checkFirstSpace(ss, message, len) {
	if(ss.substring(0, len).match(space)) {
		var s = "";
		if(len>1) {
			message = "No space on first " +len+ " characters";
		}
		else {
			message = "No space on first character";
		}
	}
	return message;
}

function checkMatchAngleBrace(ss, message) {
	if(ss.match(angleBrace)) {
		if(message!="") {
			message+=" and no angle brace";
		}
		else {
			message="No angle brace";
		}
	}
	return message;
}

function checkFirstPoint(ss, message, len) {
	if(ss.substring(0, len).match(point)) {
		if(len>1) {
			message = "No decimal point on the first " +len+ " place of the digits";
		}
		else {
			message = "No centavos";
		}
	}
	return message;
}

function checkIfImage(ss, message) {
	var ext = ss.split(".");
	ext = ext[ext.length-1].toLowerCase();
	var arrayExtensions = ["jpg" , "jpeg", "png", "bmp", "gif"];
	if (arrayExtensions.lastIndexOf(ext) == -1) {
		message = "Upload image only";
	}
	return message;
}

function checkSelected(selected) {
	if(selected=="No") {
		$('#picture').attr('disabled', 'disabled');
	}
	else if(selected=="Yes") {
		$('#picture').removeAttr('disabled');
	}
	else if(selected=="pNo") {
		$('#oldpass').attr('disabled', 'disabled');
		$('#newpass').attr('disabled', 'disabled');
	}
	else {
		$('#oldpass').removeAttr('disabled');
		$('#newpass').removeAttr('disabled');
	}
	checkSubmitValidity();
}

$('input[type="submit"]').ready(function() {
	checkSubmitValidity();
});

$('input[name="frequency[]"]').click(function() {
	forFrequency(this);
});

$('input[name="days[]"]').click(function() {
	forDays();
});

$('input[name="frequency[]"]').ready(function() {
if($('input[name="frequency[]"]').prop("checked")==true) {
		$('input[name="days[]"]').prop('checked', true);
	}

	if($('input[value="Monday"]').prop("checked")==true || $('input[value="Tuesday"]').prop("checked")==true || $('input[value="Wednesday"]').prop("checked")==true || $('input[value="Thursday"]').prop("checked")==true || $('input[value="Friday"]').prop("checked")==true || $('input[value="Saturday"]').prop("checked")==true || $('input[value="Sunday"]').prop("checked")==true) {
		$('input[name="from"]').attr("required", true);
		$('input[name="to"]').attr("required", true);
		$('.req').text("*");
	}
	else {
		$('input[name="from"]').attr("required", false);
		$('input[name="to"]').attr("required", false);
		$('.req').text("");
	}});

$('input[name="days[]"]').ready(function() {
	forDays();
});

function forFrequency() {
	if($('input[name="frequency[]"]').prop("checked")==true) {
		$('input[name="days[]"]').prop('checked', true);
	}
	else {
		$('input[name="days[]"]').prop('checked', false);
	}

	if($('input[value="Monday"]').prop("checked")==true || $('input[value="Tuesday"]').prop("checked")==true || $('input[value="Wednesday"]').prop("checked")==true || $('input[value="Thursday"]').prop("checked")==true || $('input[value="Friday"]').prop("checked")==true || $('input[value="Saturday"]').prop("checked")==true || $('input[value="Sunday"]').prop("checked")==true) {
		$('input[name="from"]').attr("required", true);
		$('input[name="to"]').attr("required", true);
		$('.req').text("*");
	}
	else {
		$('input[name="from"]').attr("required", false);
		$('input[name="to"]').attr("required", false);
		$('.req').text("");
	}
}

function forDays() {

	if($('input[value="Monday"]').prop("checked")==true && $('input[value="Tuesday"]').prop("checked")==true && $('input[value="Wednesday"]').prop("checked")==true && $('input[value="Thursday"]').prop("checked")==true && $('input[value="Friday"]').prop("checked")==true && $('input[value="Saturday"]').prop("checked")==true && $('input[value="Sunday"]').prop("checked")==true) {
		$('input[name="frequency[]"]').prop("checked", true);
	}
	else {
		$('input[name="frequency[]"]').prop("checked", false);
	}

	if($('input[value="Monday"]').prop("checked")==true || $('input[value="Tuesday"]').prop("checked")==true || $('input[value="Wednesday"]').prop("checked")==true || $('input[value="Thursday"]').prop("checked")==true || $('input[value="Friday"]').prop("checked")==true || $('input[value="Saturday"]').prop("checked")==true || $('input[value="Sunday"]').prop("checked")==true) {
		$('input[name="from"]').attr("required", true);
		$('input[name="to"]').attr("required", true);
		$('.req').text("*");
	}
	else {
		$('input[name="from"]').attr("required", false);
		$('input[name="to"]').attr("required", false);
		$('.req').text("");
	}

}


$('input[name="picture"]').change(function() {

	var inputVal = $(this).val();

	function checkValidity(ss) {

		var message = "";

		if(ss!=null) {
			message=checkIfImage(ss, message);
		}
		else {
			message = "Upload image";
		}

		if(message!="") {
			message+=" please!";
		}

		return message;

	}

	$('#pictureMessage').text(checkValidity(inputVal));
	checkSubmitValidity();

});

