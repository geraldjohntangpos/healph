$('#displike').ready(function() {

  var id = $('#viewid').text();
  var type = $('#viewtype').text();
  var theData = "label=" +type+ "&labelid=" +id;

  function getlikes(theData) {
	 var msg;
	 $.ajax({
		type: 'POST',
		url: '../queries/countlike.php',
		data: theData,
		dataType: 'json',
		async: false,
		success: function(data) {
		  var txt = "";
		  if(data.count < 1) {
			 txt = "No likes yet.";
		  }
		  else if(data.count == 1) {
			 txt = "1 person likes this.";
		  }
		  else {
			 txt = data.count+ " person like this.";
		  }
		  return msg = txt;
		}
	 });
	 return msg;
  }

  $('#displike').text(getlikes(theData));

});
