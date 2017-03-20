/*
*	Created by: Tangpos, Gerald John F.
*	Date created: September 25, 2016
*/

//I set the name of the months in order from January to December
//You can always change this according to the Language you are using
var arrayMonth =   ["January", "February", "March",
					"April", "May", "June",
					"July", "August", "September",
					"October", "November", "December"];

//I also set the name fo the days from Sunday to Saturday.
//You can always change this according to the language you are using
var arrayDays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
//I set the number of days in every month
//NLY = Non Leap Year
//LY = Leap Year
var arrayMonthDayCountNLY = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
var arrayMonthDayCountLY = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
//I created an array called setDays and give a max length of 42.
//It is the number of squares I used in my Calendar UI.
//var setDays = new Array(42);

//I initialize the default month and year when the calendar loads.
function initialize() {
	var fulldate = getCurrFulldate();
	var year = fulldate.getFullYear();
	var month = fulldate.getMonth();
	var date = fulldate.getDate();
	var strMonth = arrayMonth[month];
	var strDay = arrayDays[getFirstday(month, year)];

	console.log(date);
	console.log(strDay);
	//This is to display the Month and year above the Calendar.
	setHidden(year, month);
	console.log($('#hiddenMonth').text());
	console.log($('#hiddenYear').text());
	calSetDays(year, month);
}

//this will trigger when next is clicked.
$('#nextMonth').click(function() {
	var activeMonth = parseInt($('#hiddenMonth').text());
	var activeYear = parseInt($('#hiddenYear').text());
	var setDays = new Array(42);
	var newActiveMonth;
	var newActiveYear;
	if(activeMonth+1 > 11) {
		newActiveMonth = 0;
		newActiveYear = activeYear+1;
	}
	else {
		newActiveMonth = activeMonth+1;
		newActiveYear = activeYear;
	}
	calSetDays(newActiveYear, newActiveMonth);
	setHidden(newActiveYear, newActiveMonth);
});

//this will trigger when previous is clicked.
$('#prevMonth').click(function() {
	var activeMonth = parseInt($('#hiddenMonth').text());
	var activeYear = parseInt($('#hiddenYear').text());
	var setDays = new Array(42);
	var newActiveMonth;
	var newActiveYear;
	if(activeMonth-1 < 0) {
		newActiveMonth = 11;
		newActiveYear = activeYear-1;
	}
	else {
		newActiveMonth = activeMonth-1;
		newActiveYear = activeYear;
	}
	calSetDays(newActiveYear, newActiveMonth);
	setHidden(newActiveYear, newActiveMonth);
});

//This function will set the hidden values in the Calendar
//We will set the month and the year.
//It will be used later to navigate through another month and year.
function setHidden(year, month) {
	var strMonth = arrayMonth[month];
	$('#hiddenMonth').text(month);
	$('#hiddenYear').text(year);
	$('#currMonth').text(strMonth+ " " +year);
}

//I used this function to get the Currend Full Date.
function getCurrFulldate() {
	var currMonth = new Date();
	return currMonth;
}

//This function is used to know the day of the first date of the specified month.
function getFirstday(year, month) {
	var firstDay = new Date(year, month, 1).getDay();
	return firstDay;
}

//This function sets the value of each squares in the Calendar UI.
function calSetDays(year, month) {
	var firstday = getFirstday(year, month);
	var dayCount = arrayMonthDayCountNLY;
	var currdate = new Date().getDate();
	var curryear = new Date().getFullYear();
	var currmonth = new Date().getMonth();
	var setDays = new Array(42);
	var counter = 1;
	if(year%4==0) {
		dayCount = arrayMonthDayCountLY;
	}

	//This loop gives values logically to the squares in the Calendar UI.
	for (var i = 0; i < 42; i++) {
		if(i < firstday || counter > dayCount[month]) {
			setDays[i] = null;
		}
		else {
			setDays[i] = counter;
			counter++;
		}
	}

	//I concatinate zero(0) to the month and date that is less than 10 because I need two digits
	//in and adding zero(0) at the beggining of it makes it a two-digit number.
	if(currdate < 10) {
		currdate = "0" +currdate;
	}
	if(currmonth < 9) {
		thismonth = currmonth+1;
		thismonth = "0" +thismonth;
	}
	else {
		thismonth = currmonth+1;
	}
	if(month < 9) {
		othermonth = month+1;
		othermonth = "0" +othermonth;
	}
	else {
		othermonth = month+1;
	}

/*	for (var i = 0; i < 42; i++) {
		$('')
	}
*/
	//This loop get will get the logical value of every squares in the Calendar UI.
	for (var i = 0; i < 42; i++) {
		//unbind the previous event first
		$('#' +i).unbind();
		//Since some of the value in the array are null, we have to trap it
		//in order not to return an undefined value.
		if(setDays[i] == null) {
			setDays[i] = "";
			$('#' +i).addClass("empty");
			$('#' +i).removeClass("datevalid");
			$('#p' +i).text(setDays[i]);
			$('#' +i).click(function() {
				$('input[name="date"]').val("");
				alert('Invalid Date');
			});
		}
		else {
			$('#' +i).removeClass("empty");
			if(setDays[i] < 10) {
				d = "0" +setDays[i];
			}
			else {
				d = setDays[i];
			}
			//This section below is needed since we just make use of the future dates.
			//That exludes the date today and the date older than yesterday.
			var thisday = parseInt(""+curryear+thismonth+currdate);
			var otherday = parseInt(""+year+othermonth+d);
			var dif = otherday - thisday;
			if(thisday > otherday) {
				$('#' +i).removeClass("datevalid");
				$('#' +i).addClass("yesterday");
				$('#p' +i).text(setDays[i]);
				$('#' +i).click(function() {
					$('input[name="date"]').val("");
					alert('Invalid Date');
				});
			}
			else {
				$('#' +i).removeClass("yesterday");
				$('#' +i).addClass("datevalid");
				$('#p' +i).text(setDays[i]);
				$('#' +i).click(function() {
					var day = $(this).find('p').text();
					if(day < 10) {
						day = "0" +day;
					}
					var date = year+ "-" +othermonth+ "-" +day;
					$('input[name="date"]').val(date);
				});
			}
		}

		//I use this condition to locate the date today.
		if(year == curryear && month == currmonth && currdate == setDays[i]) {
			$('#' +i).addClass("thisday");
			$('#' +i).removeClass("datevalid");
			$('p#' +i).text(setDays[i]);
			$('#' +i).click(function() {
				$('input[name="date"]').val("");
				alert('Invalid Date');
			});
		}
		else {
			$('#' +i).removeClass("thisday");
		}
	}
	console.log(dayCount[month]);
}

