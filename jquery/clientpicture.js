function checkSubmitValidity() {
	if($('input[name="picture"]').val() == "" || $('#pictureMessage').text() != "") {
		$('#submit').attr("disabled", "disabled");
	}
	else {
		$('#submit').removeAttr("disabled");
	}
}

$('#submit').ready(function() {
	checkSubmitValidity();
});

function checkIfImage(ss, message) {
	var ext = ss.split(".");
	ext = ext[ext.length-1].toLowerCase();
	var arrayExtensions = ["jpg" , "jpeg", "png", "bmp", "gif"];
	if (arrayExtensions.lastIndexOf(ext) == -1) {
		message = "Upload image only";
	}
	return message;
}


$('input[name="picture"]').change(function() {

	var inputVal = $(this).val();

	function checkValidity(ss) {
		console.log(ss);

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
