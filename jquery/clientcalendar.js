
$(document).ready(function () {

	var id = $('#cid').text();

//	function getEvents() {
//		var theData = "healerid=" +id;
//		$.ajax({
//			 url: '../queries/getEvents.php',
//			 data: theData,
//			 dataType: 'json',
//			 success: function(data) {
//				 return data;
//			 }
//		 });
//	}
				var theData = "clientid=" +id;
				var ev = [];

				$.ajax({
					 url: 'queries/getClientEvents.php',
					 data: theData,
					 dataType: 'json',
					 async: false,
					 success: function(data) {
//						 ev = data;
						 var i;
						 for(i = 0; i < data.length; i++) {
							ev.push({title: data[i].title, description: data[i].description, datetime: new Date(data[i].year, data[i].month, data[i].day, data[i].hours)});
						 }
							return ev;
					 }
				 });


	$('#calendar').eCalendar({
		weekDays: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
		months: ['January', 'February', 'March', 'April', 'May', 'June',
						 'July', 'August', 'September', 'October', 'November', 'December'],
		textArrows: {previous: '<', next: '>'},
		eventTitle: "Your appointments and bookings",
		url: '',
		events: ev,

//		events: [
//				{title: "Faith's Birthday", description: 'Description 1', datetime: new Date(2016, 8, 1)},
//				{title: "First day of September", description: 'Description 1', datetime: new Date(2016, 8, 1)},
//				{title: "Kyle's Birthday", description: 'Description 2', datetime: new Date(2016, 8, 4)},
//				{title: "Divine's Birthday", description: 'Description 1', datetime: new Date(2016, 8, 6)},
//				{title: "Sister's Birthday", description: 'Description 1', datetime: new Date(2016, 8, 22)},
//				{title: "Friend's Birthday", description: 'Description 1', datetime: new Date(2016, 8, 28)}
//		],
		firstDayOfWeek: 0
	});
	console.log(ev);
});
