var upperCase= new RegExp('[A-Z]');
var lowerCase= new RegExp('[a-z]');
var numbers = new RegExp('[0-9]');
var space = new RegExp('[ ]');
var correctEmail = new RegExp('[@]');
var angleBrace = new RegExp('[<>]');
var point = new RegExp('[.]');
var nonword = new RegExp('\W');

function checkSubmitValidity() {
   
//   if()

}

function getActiveSched(appointeddate, healerid) {
    var returnData = [];
    var theData = "fulldate=" +appointeddate+ "&healerid=" +healerid;
 $.ajax({
	 url: 'queries/getActiveAppointment.php',
	 data: theData,
	 dataType: 'json',
    async: false,
	 success: function(data) {
        var v;     
        var ct;
   	 if(data!=null) {
          $('#listMessage').text("");
           v = "Showing schedule for " +appointeddate+ "<p>";
          $('#listMessage').append(v);
			 for(ct = 0; ct < data.length; ct++) {
             if(data[ct] != "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;") {
              v = "<span id='sp" +(ct+1)+ "' class='schedules'>" +data[ct]+ "</span>";
              $('#listMessage').append(v);
              $('#sp' +(ct+1)).click(function() {
               $('input[name="appointedtime"]').val($(this).text());
              });
             }
             else {
				 v = "<span id='sp" +(ct+1)+ "' class='occupied'>" +data[ct]+ "</span>";
             $('#listMessage').append(v);
             $('#sp' +(ct+1)).click(function() {
              $('input[name="bookingtime"]').val("");
              alert("Occupied");
             });
             }
            if(ct < data.length-1) {
             v=" ";
             $('#listMessage').append(v);
            }
            else {
             v = "</p>";
             $('#listMessage').append(v);
            }
			 }
		 }
		 else {
			 v = "No available schedule to show.";
          $('#listMessage').append(v);
		 }
//       console.log(v);
//		 $('#listMessage').html(v);
	 }
 });
}

function checkDateValidity(ss, message) {
		var year = ss.substring(0, 4);
		var date = ss.substring(8, 10);
		var month = ss.substring(5, 7);
      var fulld = parseInt(year+""+month+""+date);
		var currmonth = (new Date).getMonth() + 1;
		var currdate = (new Date).getDate();
      if(currdate < 10) {
         currdate = "0" +currdate;
      }
      if(currmonth < 10) {
         currmonth = "0" +currmonth;
      }
		var curryear = (new Date).getFullYear();
      var fullcurrdate = parseInt(curryear+""+currmonth+""+currdate);
      console.log("fulld = (" +typeof(fulld)+ ") " +fulld);
      console.log("fullcurrdate = (" +typeof(fullcurrdate)+ ") " +fullcurrdate);
        if(fulld > fullcurrdate) {
           message = "";
        }
         else {
            message = "Enter an appropriate date";
         }

		return message;
}


$('table').click(function() {
		var ss = $('input[name="date"]').val();
		var id = $('input[name="ownerid"]').val();
		var theData = "fulldate=" +ss+ "&healerid=" +id;

		function checkValidity(ss) {
				var message = "";

				if(ss!="") {
                getActiveSched(ss, id);
				}
				else {
						message = "Enter date";
				}

				if(message!="") {
						message += " please!";
				}

				return message;
		}
/*
		 $.ajax({
			 url: 'queries/getActiveAppointment.php',
			 data: theData,
			 dataType: 'json',
			 success: function(data) {
               var ct;
             var v = "Showing schedule for " +ss+ "<br>";
				 if(data!=null) {
					 for(ct = 0; ct < data.length; ct++) {
						 v = v+data[ct].time+ "<br>";
					 }
                v = v+data[ct-1].count;
				 }
				 else {
					 v = "No schedule to show.";
				 }
				 $('#listMessage').html(v);
			 }
		 });
*/

		$('#adMessage').text(checkValidity(ss));
});
