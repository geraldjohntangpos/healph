var upperCase= new RegExp('[A-Z]');
var lowerCase= new RegExp('[a-z]');
var numbers = new RegExp('[0-9]');
var space = new RegExp('[ ]');
var correctEmail = new RegExp('[@]');
var nonword = new RegExp('\W');
var sl = new RegExp('[\\\\]');

$('input[name="comment"]').keyup(function() {
	var ss = $(this).val();
	var ss2;
	console.log("ouch");
	if(ss.match(sl)) {
		console.log("sl was executed");
		ss2 = ss.replace(/\\/gi, "");
//		ss2 = ss.substr(0, ss.length -1);
//		setTimeout(function() { $(this).css('border', "1px solid red"); }, 3000);
		$(this).css('border', "3px solid red");
		$(this).val(ss2);
		setTimeout(function() { $(this).css('border', "1px solid"); }, 1000);
	}
	else {
		$(this).css('border', "1px solid");
	}

});

