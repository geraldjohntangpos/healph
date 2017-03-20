$('.thelink').click(function(e) {
	e.preventDefault();
	var id = $(this).children('span').text();
	var dr = parseInt($('#dr'+id).text());
	var expiry = $('#expiry'+id).text();
	var thedata = 'accountid=' +id;
	$.ajax({
		type: 'POST',
		url: '../queries/extender.php',
		data: thedata,
		dataType: 'json',
		async: false,
		success: function(data) {
			var succeed = data.success;
			var message = data.message;
			if(succeed == "true") {
				$('#dr'+id).text(dr+30);
				$('#expiry'+id).text(message);
			}
			else {
				alert(message);
			}
		}
	});
});
