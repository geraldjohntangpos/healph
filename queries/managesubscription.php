<?php

	include 'connection.php';
		?>
		<table style="width: 100%; border: 1px solid green; font-size: 15px; padding: 3px;" column="4">
			<tr style="width: 100%; border: 1px solid green;">
				<th style="width: 40%; border: 1px solid green; text-align: center;" colspan="4">
					<span style="font-size: 24px;">Active Healer Accounts</span>
				</th>
			</tr>
			<tr style="width: 100%; border: 1px solid green;">
				<th style="width: 40%; border: 1px solid green; text-align: center;">
					Healer Name
				</th>
				<th style="width: 20%; border: 1px solid green; text-align: center;">
					Subscription Expiry Date
				</th>
				<th style="width: 20%; border: 1px solid green; text-align: center;">
					Days Remaining
				</th>
				<th style="width: 20%; border: 1px solid green; text-align: center;">
					Extention (30 days)
				</th>
			</tr>
		<?php

		$sql = "SELECT H.LASTNAME, H.FIRSTNAME, H.SUBEXPIRY, H.HEALER_ID, H.ACCT_ID, A.ACCT_ID, A.STATUS FROM healer as H INNER JOIN account AS A ON H.ACCT_ID = A.ACCT_ID WHERE H.STATUS = 'ACTIVE'";
		$currmonth = date("m");
		$currday = date("d");
		$curryear = date("Y");
		$expmonth;
		$expday;
		$expyear;
		$retrieve = $conn->query($sql)->fetchAll();

		if($retrieve) {
			foreach($retrieve as $row) {
				$lastname = $row['LASTNAME'];
				$firstname = $row['FIRSTNAME'];
				$healerid = $row['HEALER_ID'];
				$accountid = $row['ACCT_ID'];
				$subexpiry = $row['SUBEXPIRY'];
				$expmonth = substr($subexpiry, 5, 2);
				$expday = substr($subexpiry, 8, 2);
				$expyear = substr($subexpiry, 0, 4);
				$monthdays = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
				$cmonth = $currmonth;
				$cday = $currday;
				$cyear = $curryear;
				$daysremaining = 0;
				if($expyear.$expmonth.$expday>$curryear.$currmonth.$currday) {
					while($cmonth != $expmonth || $cday != $expday || $cyear != $expyear) {
						if($cyear%4==0) {
							$monthdays[1] = 29;
						}
						$cday++;
						if($cday>$monthdays[$cmonth-1]) {
							$cday = 1;
							$cmonth++;
							if($cmonth>12) {
								$cmonth = 1;
								$cyear++;
							}
						}
						$daysremaining++;
					}
				}
				else {
					$daysremaining = 0;
				}

//				if($expyear>=$curryear) {
//					if($expmonth>=$currmonth && $expyear > $curryear) {
//						if($expmonth==$currmonth && $expday<=$currday) {
//							$daysremaining = 0;
//						}
//						else {
//							while($cmonth != $expmonth || $cday != $expday || $cyear != $expyear) {
//								if($cyear%4==0) {
//									$monthdays[1] = 29;
//								}
//								$cday++;
//								if($cday>$monthdays[$cmonth-1]) {
//									$cday = 1;
//									$cmonth++;
//									if($cmonth>12) {
//										$cmonth = 1;
//										$cyear++;
//									}
//								}
//								$daysremaining++;
//							}
//						}
//					}
//					else {
//						$daysremaining = 0;
//					}
//				}
//				else {
//					$daysremaining = 0;
//				}

				if($daysremaining == 0) {
					$sql2 = "UPDATE healer SET STATUS = 'EXPIRED' WHERE ACCT_ID = '$accountid'";
					$sql3 = "SELECT * FROM service WHERE ACCT_ID = '$accountid'";
					$sql4 = "SELECT * FROM product WHERE ACCT_ID = '$accountid'";
					$updatehealer = $conn->query($sql2);
					$searchservice = $conn->query($sql3)->fetchAll();
					$serchproduct = $conn->query($sql4)->fetchAll();
					if($updatehealer) {
						if($searchservice) {
							$updateservice = $conn->query("UPDATE service SET STATUS = 'INACTIVE' WHERE ACCT_ID = '$accountid'");
							if(!$updateservice) {
								die("Error updating service");
							}
						}
						if($serchproduct) {
							$updateproduct = $conn->query("UPDATE product SET STATUS = 'INACTIVE' WHERE ACCT_ID = '$accountid'");
							if(!$updateproduct) {
								die("Error updating product");
							}
						}
					}
					else {
						die("Error updating healer");
					}
				}
				else {

				?>
					<tr style="width:100%">
						<td style="width:40%; border: 1px solid green; text-align:left; padding-left: 15px;"><?php echo $lastname. ", " .$firstname; ?></td>
						<td style="width:20%; border: 1px solid green; text-algin:right;"><span id="<?php echo "expiry" .$accountid; ?>"><?php echo $subexpiry; ?></span></td>
						<td style="width:20%; border: 1px solid green; text-algin:right;"><span id="<?php echo "dr" .$accountid; ?>"><?php echo $daysremaining; ?></span></td>
						<td style="width:20%; border: 1px solid green; text-algin:right;"><a href="#" style="color:green;" class="thelink"><span id="accountid" style="display:none;"><?php echo $accountid; ?></span>Extend Subscription</a></td>
					</tr>
				<?php
				}
			}
		}
		else {
				?>
					<tr style="width:100%">
						<td style="width:40%; border: 1px solid green; text-align:left; padding-left: 15px;">No Entry</td>
						<td style="width:20%; border: 1px solid green; text-algin:right;">No Entry</td>
						<td style="width:20%; border: 1px solid green; text-algin:right;">No Entry</td>
						<td style="width:20%; border: 1px solid green; text-algin:right;">No Entry</td>
					</tr>
				<?php
		}
		?>
		</table>
		<br />
		<table style="width: 100%; border: 1px solid green; font-size: 15px; padding: 3px;" column="3">
			<tr style="width: 100%; border: 1px solid green;">
				<th style="width: 40%; border: 1px solid green; text-align: center;" colspan="3">
					<span style="font-size: 24px;">Expired Healer Accounts</span>
				</th>
			</tr>
			<tr style="width: 100%; border: 1px solid green;">
				<th style="width: 50%; border: 1px solid green; text-align: center;">
					Healer Name
				</th>
				<th style="width: 25%; border: 1px solid green; text-align: center;">
					Date Expired
				</th>
				<th style="width: 25%; border: 1px solid green; text-align: center;">
					Activate (30 days)
				</th>
			</tr>
			<?php

		$sql = "SELECT H.LASTNAME, H.FIRSTNAME, H.SUBEXPIRY, H.HEALER_ID, H.ACCT_ID, A.ACCT_ID, A.STATUS FROM healer as H INNER JOIN account AS A ON H.ACCT_ID = A.ACCT_ID WHERE H.STATUS = 'EXPIRED'";
		$retrieve = $conn->query($sql)->fetchAll();

		if($retrieve) {
			foreach($retrieve as $row) {
				$accountid = $row['ACCT_ID'];
				$lastname = $row['LASTNAME'];
				$firstname = $row['FIRSTNAME'];
				$healerid = $row['HEALER_ID'];
				$accountid = $row['ACCT_ID'];
				$subexpiry = $row['SUBEXPIRY'];
				?>
					<tr style="width:100%">
						<td style="width:50%; border: 1px solid green; text-align:left; padding-left: 15px;"><?php echo $lastname. ", " .$firstname; ?></td>
						<td style="width:25%; border: 1px solid green; text-algin:right;"><?php echo $subexpiry; ?></td>
						<td style="width:25%; border: 1px solid green; text-algin:right;"><a href="../queries/activator.php?accountid=<?php echo $accountid; ?>"; style="color:green;">Activate Subscription</a></td>
					</tr>
				<?php
			}
		}
		else {
				?>
					<tr style="width:100%">
						<td style="width:50%; border: 1px solid green; text-align:left; padding-left: 15px;">No Entry</td>
						<td style="width:25%; border: 1px solid green; text-algin:right;">No Entry</td>
						<td style="width:25%; border: 1px solid green; text-algin:right;">No Entry</td>
					</tr>
				<?php
		}
		?>
		</table>
		<?php



?>
