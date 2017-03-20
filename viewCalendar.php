<!DOCTYPE html>
<html>
<head>
	<title>View Calendar</title>
	<link rel="stylesheet" type="text/css" href="otherstyles/calendarstyles.css">
	<script src="bower_components/jquery/dist/jquery.min.js"></script>
	<style type="text/css">

	</style>
</head>
<body onload="initialize();">
	<!-- Start of the Calendar UI here. -->
	<span id="hiddenMonth" class="hidden"></span>
	<span id="hiddenYear" class="hidden"></span>
	<table id="main" columns="7" cellspacing="0">
		<thead>
			<tr>
				<td id="dispMonth" colspan="7">
					<table width="100%" id="sub">
						<tr>
							<td id="prevMonth">Previous</td>
							<td id="currMonth">
							</td>
							<td id="nextMonth">Next</td>
						</tr>
					</table>
				</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="days">Sun</td>
				<td class="days">Mon</td>
				<td class="days">Tue</td>
				<td class="days">Wed</td>
				<td class="days">Thu</td>
				<td class="days">Fri</td>
				<td class="days">Sat</td>
			</tr>
			<?php
				for ($i=0; $i < 42; $i++) { 
			?>
			<tr>
				<td class="dates datevalid" id="<?php echo $i; ?>">
					<p id="p<?php echo $i++; ?>"></p>
				</td>
				<td class="dates datevalid" id="<?php echo $i; ?>">
					<p id="p<?php echo $i++; ?>"></p>
				</td>
				<td class="dates datevalid" id="<?php echo $i; ?>">
					<p id="p<?php echo $i++; ?>"></p>
				</td>
				<td class="dates datevalid" id="<?php echo $i; ?>">
					<p id="p<?php echo $i++; ?>"></p>
				</td>
				<td class="dates datevalid" id="<?php echo $i; ?>">
					<p id="p<?php echo $i++; ?>"></p>
				</td>
				<td class="dates datevalid" id="<?php echo $i; ?>">
					<p id="p<?php echo $i++; ?>"></p>
				</td>
				<td class="dates datevalid" id="<?php echo $i; ?>">
					<p id="p<?php echo $i; ?>"></p>
				</td>
			</tr>
			<?php
				}
			?>
		</tbody>
	</table>
	<!-- End of the Calendar UI here. -->
	<form method="post" autocomplete="false">
		<input type="text" name="date" placeholder="Complete Date" required readonly>
		<br />
		<input type="submit" name="submit" value="Submit">
	</form>
	<script type="text/javascript" src="jquery/eventCalendar.js"></script>
<!-- 	<script type="text/javascript" src="jquery/clickdate.js"></script> -->
</body>
</html>