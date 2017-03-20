$('.datevalid').click(function() {
	
	var year = $('#hiddenYear').text();
	var month = parseInt($('#hiddenMonth').text())+1;
	var day = $(this).text();
	if(month < 10) {
			month = "0" +month;
		}
		var date = year+ "-" +month+ "-" +day;

		$('input[name="date"]').val(date);
});

$('.yesterday, .empty').click(function() {
	alert('Invalid Date');
	$('input[name="date"]').val();
});
