$(document).ready(function () {
	$('#calendar').eCalendar({
		weekDays: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
		months: ['January', 'February', 'March', 'April', 'May', 'June',
						 'July', 'August', 'September', 'October', 'November', 'December'],
		textArrows: {previous: '<', next: '>'},
		eventTitle: "This month's appointments",
		url: '',
		events: [
				{title: "Faith's Birthday", description: 'Description 1', datetime: new Date(2016, 8, 1)},
				{title: "First day of September", description: 'Description 1', datetime: new Date(2016, 8, 1)},
				{title: "Kyle's Birthday", description: 'Description 2', datetime: new Date(2016, 8, 4)},
				{title: "Divine's Birthday", description: 'Description 1', datetime: new Date(2016, 8, 6)},
				{title: "Sister's Birthday", description: 'Description 1', datetime: new Date(2016, 8, 22)},
				{title: "Friend's Birthday", description: 'Description 1', datetime: new Date(2016, 8, 28)}
		],
		firstDayOfWeek: 0
	});
});
