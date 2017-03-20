<style type="text/css" rel="Stylesheet">
	table {

	}

	tr {

	}

	td {
		font-size: 24px;

	}

	th {
		font-weight: bold;
		font-size: 24px;
		text-align: center;
	}

	select {
		width: 300px;
		text-align: center;
	}

</style>

<table border="1px solid" column="7" style="width: 100%;">
	<tr style="width: 100%; text-align: center;">
		<th style="border: 1px solid;" colspan="7">
			<select name="month">
				<?php
					$arraymonth = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
					$currmonth = date('F');
					for($i = 0; $i < 12; $i++) {
						$month = $arraymonth[$i];
						$selected = "";
						if($month == $currmonth) {
							$selected = "selected";
						}
						echo "<option name='$month'$selected>$month</option>";
					}
				?>
			</select>
		</th>
	</tr>
	<tr style="width: 100%; text-align: center;">
		<th style="border: 1px solid;" colspan="7">
			<select name="year">
				<?php
					$curryear = date('Y');
					for($i = $curryear+5; $i >= $curryear; $i--) {
						$selected = "";
						if($i == $curryear) {
							$selected = "selected";
						}
						echo "<option name='$i'$selected>$i</option>";
					}
				?>
			</select>
		</th>
	</tr>
	<tr style="width: 100%; text-align: center;">
		<th style="border: 1px solid;">
			Sun
		</th>
		<th style="border: 1px solid;">
			Mon
		</th>
		<th style="border: 1px solid;">
			Tue
		</th>
		<th style="border: 1px solid;">
			Wed
		</th>
		<th style="border: 1px solid;">
			Thu
		</th>
		<th style="border: 1px solid;">
			Fri
		</th>
		<th style="border: 1px solid;">
			Sat
		</th>
	</tr>
	<tr style="width: 100%; text-align: center;">
		<td style="border: 1px solid;">
			1
		</td>
		<td style="border: 1px solid;">
			2
		</td>
		<td style="border: 1px solid;">
			3
		</td>
		<td style="border: 1px solid;">
			4
		</td>
		<td style="border: 1px solid;">
			5
		</td>
		<td style="border: 1px solid;">
			6
		</td>
		<td style="border: 1px solid;">
			7
		</td>
	</tr>
	<tr style="width: 100%; text-align: center;">
		<td style="border: 1px solid;">
			8
		</td>
		<td style="border: 1px solid;">
			9
		</td>
		<td style="border: 1px solid;">
			10
		</td>
		<td style="border: 1px solid;">
			11
		</td>
		<td style="border: 1px solid;">
			12
		</td>
		<td style="border: 1px solid;">
			13
		</td>
		<td style="border: 1px solid;">
			14
		</td>
	</tr>
	<tr style="width: 100%; text-align: center;">
		<td style="border: 1px solid;">
			15
		</td>
		<td style="border: 1px solid;">
			16
		</td>
		<td style="border: 1px solid;">
			17
		</td>
		<td style="border: 1px solid;">
			18
		</td>
		<td style="border: 1px solid;">
			19
		</td>
		<td style="border: 1px solid;">
			20
		</td>
		<td style="border: 1px solid;">
			21
		</td>
	</tr>
	<tr style="width: 100%; text-align: center;">
		<td style="border: 1px solid;">
			22
		</td>
		<td style="border: 1px solid;">
			23
		</td>
		<td style="border: 1px solid;">
			24
		</td>
		<td style="border: 1px solid;">
			25
		</td>
		<td style="border: 1px solid;">
			26
		</td>
		<td style="border: 1px solid;">
			27
		</td>
		<td style="border: 1px solid;">
			28
		</td>
	</tr>
	<tr style="width: 100%; text-align: center;">
		<td style="border: 1px solid;">
			29
		</td>
		<td style="border: 1px solid;">
			30
		</td>
		<td style="border: 1px solid;">
			31
		</td>
		<td style="border: 1px solid;">
		</td>
		<td style="border: 1px solid;">
		</td>
		<td style="border: 1px solid;">
		</td>
		<td style="border: 1px solid;">
		</td>
	</tr>
</table>
