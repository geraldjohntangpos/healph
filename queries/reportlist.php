<?php

	include 'connection.php';
		?>
		<table style="width: 100%; border: 1px solid green; font-size: 15px; padding: 3px;" column="4">
			<tr style="width: 100%; border: 1px solid green;">
				<th style="width: 40%; border: 1px solid green; text-align: center;" colspan="4">
					<span style="font-size: 24px;">Appointment Report</span>
				</th>
			</tr>
			<tr style="width: 100%; border: 1px solid green;">
				<th style="width: 30%; border: 1px solid green; text-align: center;">
					Healer Name
				</th>
				<th style="width: 30%; border: 1px solid green; text-align: center;">
					Client Name
				</th>
				<th style="width: 20%; border: 1px solid green; text-align: center;">
					Date and Time Appointed
				</th>
				<th style="width: 20%; border: 1px solid green; text-align: center;">
					Status
				</th>
			</tr>
		<?php

		$sql = "SELECT H.LASTNAME as HLASTNAME, H.FIRSTNAME as HFIRSTNAME, H.SUBEXPIRY, H.HEALER_ID, H.ACCT_ID, A.HEALER_ID, A.STATUS, A.CLIENT_ID, A.APPOINTEDDATE, A.APPOINTEDTIME, C.ACCT_ID, C.FIRSTNAME as CFIRSTNAME, C.LASTNAME as CLASTNAME FROM healer as H INNER JOIN appointment AS A ON H.ACCT_ID = A.HEALER_ID INNER JOIN client as C ON A.CLIENT_ID = C.ACCT_ID ORDER BY APPOINTEDDATE AND APPOINTEDTIME";
		$retrieve = $conn->query($sql)->fetchAll();

		if($retrieve) {
			foreach($retrieve as $row) {
				$hlastname = $row['HLASTNAME'];
				$hfirstname = $row['HFIRSTNAME'];
				$healerid = $row['HEALER_ID'];
				$clastname = $row['CLASTNAME'];
				$cfirstname = $row['CFIRSTNAME'];
				$dateappointed = $row['APPOINTEDDATE'];
				$timeappointed = $row['APPOINTEDTIME'];
				$status = $row['STATUS'];
				if($status == 'ACTIVE') {
					$status = "Needs confirmation";
				}
				else {
					$status = "Confirmed";
				}

				?>
					<tr style="width:100%">
						<td style="width:30%; border: 1px solid green; text-align:left; padding-left: 15px;"><?php echo $hlastname. ", " .$hfirstname; ?></td>
						<td style="width:30%; border: 1px solid green; text-align:left; padding-left: 15px;"><?php echo $clastname. ", " .$cfirstname; ?></td>
						<td style="width:20%; border: 1px solid green; text-align:center;"><?php echo $dateappointed. " at (" .$timeappointed. ")" ?></td>
						<td style="width:20%; border: 1px solid green; text-align:center;"><?php echo $status; ?></td>
					</tr>
				<?php
			}
		}
		else {
				?>
					<tr style="width:100%">
						<td style="width:30%; border: 1px solid green; text-align:center; padding-left: 15px;">No Entry</td>
						<td style="width:30%; border: 1px solid green; text-align:center;">No Entry</td>
						<td style="width:20%; border: 1px solid green; text-align:center;">No Entry</td>
						<td style="width:20%; border: 1px solid green; text-align:center;">No Entry</td>
					</tr>
				<?php
		}
		?>
		</table>
		<br />
		<table style="width: 100%; border: 1px solid green; font-size: 15px; padding: 3px;" column="4">
			<tr style="width: 100%; border: 1px solid green;">
				<th style="width: 40%; border: 1px solid green; text-align: center;" colspan="4">
					<span style="font-size: 24px;">Booking Report</span>
				</th>
			</tr>
			<tr style="width: 100%; border: 1px solid green;">
				<th style="width: 30%; border: 1px solid green; text-align: center;">
					Healer Name
				</th>
				<th style="width: 30%; border: 1px solid green; text-align: center;">
					Client Name
				</th>
				<th style="width: 20%; border: 1px solid green; text-align: center;">
					Date and Time Booked
				</th>
				<th style="width: 20%; border: 1px solid green; text-align: center;">
					Status
				</th>
			</tr>
		<?php

		$sql = "SELECT H.LASTNAME as HLASTNAME, H.FIRSTNAME as HFIRSTNAME, H.SUBEXPIRY, H.HEALER_ID, H.ACCT_ID, B.HEALER_ID, B.STATUS, B.CLIENT_ID, B.BOOKINGDATE, B.BOOKINGTIME, C.ACCT_ID, C.FIRSTNAME as CFIRSTNAME, C.LASTNAME as CLASTNAME FROM healer as H INNER JOIN booking AS B ON H.ACCT_ID = B.HEALER_ID INNER JOIN client as C ON B.CLIENT_ID = C.ACCT_ID ORDER BY BOOKINGDATE AND BOOKINGTIME";
		$retrieve = $conn->query($sql)->fetchAll();

		if($retrieve) {
			foreach($retrieve as $row) {
				$hlastname = $row['HLASTNAME'];
				$hfirstname = $row['HFIRSTNAME'];
				$healerid = $row['HEALER_ID'];
				$clastname = $row['CLASTNAME'];
				$cfirstname = $row['CFIRSTNAME'];
				$bookingdate = $row['BOOKINGDATE'];
				$bookingtime = $row['BOOKINGTIME'];
				$status = $row['STATUS'];
				if($status == 'ACTIVE') {
					$status = "Needs confirmation";
				}
				else {
					$status = "Confirmed";
				}

				?>
					<tr style="width:100%">
						<td style="width:30%; border: 1px solid green; text-align:left; padding-left: 15px;"><?php echo $hlastname. ", " .$hfirstname; ?></td>
						<td style="width:30%; border: 1px solid green; text-align:left; padding-left: 15px;"><?php echo $clastname. ", " .$cfirstname; ?></td>
						<td style="width:20%; border: 1px solid green; text-align:center;"><?php echo $bookingdate. " at (" .$bookingtime. ")" ?></td>
						<td style="width:20%; border: 1px solid green; text-align:center;"><?php echo $status; ?></td>
					</tr>
				<?php
			}
		}
		else {
				?>
					<tr style="width:100%">
						<td style="width:30%; border: 1px solid green; text-align:center; padding-left: 15px;">No Entry</td>
						<td style="width:30%; border: 1px solid green; text-align:center;">No Entry</td>
						<td style="width:20%; border: 1px solid green; text-align:center;">No Entry</td>
						<td style="width:20%; border: 1px solid green; text-align:center;">No Entry</td>
					</tr>
				<?php
		}
		?>
		</table>
		<br />
		<table style="width: 100%; border: 1px solid green; font-size: 15px; padding: 3px;" column="4">
			<tr style="width: 100%; border: 1px solid green;">
				<th style="width: 40%; border: 1px solid green; text-align: center;" colspan="4">
					<span style="font-size: 24px;">Reservation Report</span>
				</th>
			</tr>
			<tr style="width: 100%; border: 1px solid green;">
				<th style="width: 30%; border: 1px solid green; text-align: center;">
					Product Name
				</th>
				<th style="width: 30%; border: 1px solid green; text-align: center;">
					Client Name
				</th>
				<th style="width: 20%; border: 1px solid green; text-align: center;">
					Total Qty and Price
				</th>
				<th style="width: 20%; border: 1px solid green; text-align: center;">
					Status
				</th>
			</tr>
		<?php

		$sql = "SELECT P.PRODUCT_ID, P.NAME, R.PRODUCT_ID, R.CLIENT_ID, R.PROD_QTY, R.PRICE, R.DATEADDED, R.STATUS, C.FIRSTNAME, C.LASTNAME, C.ACCT_ID FROM product as P INNER JOIN reservation as R ON P.PRODUCT_ID = R.PRODUCT_ID INNER JOIN client as C ON C.ACCT_ID = R.CLIENT_ID ORDER BY R.DATEADDED";
		$retrieve = $conn->query($sql)->fetchAll();

		if($retrieve) {
			foreach($retrieve as $row) {
				$prodname = $row['NAME'];
				$clastname = $row['LASTNAME'];
				$cfirstname = $row['FIRSTNAME'];
				$qty = $row['PROD_QTY'];
				$price = $row['PRICE'];
				$status = $row['STATUS'];
				if($status == 'ACTIVE') {
					$status = "Needs confirmation";
				}
				else {
					$status = "Confirmed";
				}

				?>
					<tr style="width:100%">
						<td style="width:30%; border: 1px solid green; text-align:left; padding-left: 15px;"><?php echo $prodname; ?></td>
						<td style="width:30%; border: 1px solid green; text-align:left; padding-left: 15px;"><?php echo $clastname. ", " .$cfirstname; ?></td>
						<td style="width:20%; border: 1px solid green; text-align:center;"><?php echo $qty. " at (P" .$price. ")" ?></td>
						<td style="width:20%; border: 1px solid green; text-align:center;"><?php echo $status; ?></td>
					</tr>
				<?php
			}
		}
		else {
				?>
					<tr style="width:100%">
						<td style="width:30%; border: 1px solid green; text-align:center; padding-left: 15px;">No Entry</td>
						<td style="width:30%; border: 1px solid green; text-align:center;">No Entry</td>
						<td style="width:20%; border: 1px solid green; text-align:center;">No Entry</td>
						<td style="width:20%; border: 1px solid green; text-align:center;">No Entry</td>
					</tr>
				<?php
		}
		?>
		</table>
		<?php



?>
