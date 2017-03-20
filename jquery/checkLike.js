var accountid = $('#labelid').text();
var label = $('#label').text();
var theData = "label=" +label+ "&labelid=" +accountid;

function execThis() {
	if(countlike()) {
		if(ifDoneLike()) {
			console.log("done Execthis");
		}
	}
}

function execClick() {
	likeunlike();
	ifDoneLike();
	repeat();
}

function ifDoneLike() {
	var ret = false;
	$.ajax({
		url: 'queries/ifLike.php',
		type: 'POST',
		data: theData,
		dataType: 'json',
		async: false,
		success: function(data) {
			var message;
			if(data.liked == "yes") {
				message = "UNLIKE";
				$('p.fa').removeClass('fa-thumbs-o-up').addClass('fa-thumbs-o-down');
			}
			else {
				message = "LIKE";
				$('p.fa').addClass('fa-thumbs-o-up').removeClass('fa-thumbs-o-down');
			}
			$('#liketext').text(message);
			console.log($('#liketext').text());
		}
	});
	ret = true;
	return ret;
}

function likeunlike() {
	var ret = false;
	$.ajax({
		url: 'queries/like.php',
		type: 'POST',
		data: theData,
		dataType: 'json',
		async: false,
		success: function(data) {
			if(data.success == false) {
				alert("Error");
			}
		}
	});
	ret = true;
	return ret;
}

function countlike() {
	var ret = false;
	$.ajax({
		url: 'queries/countlike.php',
		type: 'POST',
		data: theData,
		dataType: 'json',
		async: false,
		success: function(data) {
			var c = data.count;
			if(c>0) {
				if(c!=1) {
					c = c+" people like this";
				}
				else {
					c = c+" person likes this";
				}
			}
			else {
				c = "No likes yet";
			}
			$('#countlike').text(c);
			console.log($('#countlike').text());
		}
	});
	ret = true;
	return ret;
}

function repeat() {
	setTimeout(countlike(), 1000);
}

//$(document).ready(setTimeout(function(){
//	countlike();
//}, 1000));
//
$('#likelink').click(function(e) {
	e.preventDefault();
	execClick();
});

$('#likesection').ready(function() {

//	setTimeout(execThis(), 1000);
	execThis();
});

