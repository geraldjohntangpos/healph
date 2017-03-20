<?php
	include 'styles.php';
?>
<table cellspacing="6px" >
<?php
	session_start();
	$healerid = $_SESSION['USERID'];

	include 'connection.php';

	//let's see first if this will work.
	if(isset($_GET['productid']) && isset($_GET['q'])) {
		$labelid = $_GET['productid'];
		$q = $_GET['q'];

		if($q == "comments") {
		//check if the comment was inputted.
		if(isset($_REQUEST['comment'])) {
			$comment = htmlentities(filter_var($_REQUEST['comment'], FILTER_SANITIZE_STRING));

			//declare the account id which is used in the session as USERID.
			$accountid = $_SESSION['USERID'];

			//since we need the id of the certain label,
			//we will retrieve the client id of this loged in account.
			$sql = "SELECT * FROM client WHERE ACCT_ID = '$accountid'";
			$retrieve = $conn->query($sql)->fetchAll();

			//let's check whether data exist or not.
/*
			if($retrieve) {
				foreach($retrieve as $row) {

					//get the value of CLIENT_ID
					$clientid = $row['CLIENT_ID'];
				}
			}
*/
			$clientid = $_SESSION['USERID'];
			$sql = "INSERT INTO client_feedback(COMMENT, CLIENT_ID, LABEL, LABEL_ID, DATEADDED) VALUES('$comment', '$clientid', 'product', '$labelid', NOW())";
			$insert = $conn->query($sql);
			if($insert) {
				header('Location: getproductcomments.php?productid='.$labelid.'&q=comments');
			}
			else  {
				die("Error commenting.");
			}
		}
	?>
		<?php
			if($_SESSION['TYPE'] == 'Client') {
		?>
		<tr style="width: 100%;">
			<form action="" method="post"  autocomplete="off">
			<td style="width: 80%; height: 100%;">
				<input type="text" name="comment" style="width: 100%; height: 30px;" placeholder="Enter comment here" required>
			</td>
			<td style="width: 20%; padding: 1px;">
				<input type="submit" value="Send" style="width: 100%; height: 100%; background-color: darkgreen; border: 0px;">
			</td>
			</form>
		</tr>

		<?php
			}
			//retrieve the comments
			$sql = "SELECT * FROM client_feedback WHERE LABEL = 'product' AND LABEL_ID = '$labelid' ORDER BY DATEADDED DESC";
			$retrieve = $conn->query($sql)->fetchAll();
			if($retrieve) {
				foreach($retrieve as $row) {
					$clientid = $row['CLIENT_ID'];
					$feedid = $row['FEEDBACK_ID'];
					$comment = $row['COMMENT'];
					$date = $row['DATEADDED'];

					//get the name of the client.
					$sql2 = "SELECT * FROM client WHERE ACCT_ID = '$clientid'";
					$retrieve2 = $conn->query($sql2)->fetchAll();

					if($retrieve2) {
						foreach($retrieve2 as $row2) {
							$name = $row2['LASTNAME']. ", " .$row2['FIRSTNAME'];
						}
					}
	?>
		<tr style="width: 100%; min-height: 90px; background-color: #fff;">
			<td style="padding: 15px;" colspan="2"><span style="font-weight: bold; font-style: underline; font-size: 18px;"><?php echo $name; ?>:</span> <span style="font-style: italic; font-size: 18px;"><?php echo $comment; ?></span><br /><p style="font-size: 12px; line-height: 21px;"><i><b>Sent:</b> <?php echo $date; ?></i>
				<?php
					if($clientid == $_SESSION['USERID']) {
						echo "<a href='deletecomment.php?feedid=" .$feedid. "&ref=product&labelid=" .$labelid. "' style='color: #f00'>Delete Comment</a>";
					}
				?>
			</p></td>
		</tr>

	<?php
				}
			}
			else {
	?>
				<tr style="width: 100%; min-height: 90px; background-color: #fff;">
					<td style="padding: 15px;" colspan="2"><span style="font-style: italic; font-size: 18px;">No comment yet.</span></td>
				</tr>
	<?php
			}
		}
		else if($q == "notification") {
			$sql = "SELECT * FROM reservation WHERE PRODUCT_ID = '$labelid' AND HEALER_ID = '$healerid' AND STATUS = 'ACTIVE' ORDER BY DATEADDED";
			$retrieve = $conn->query($sql)->fetchAll();
			if($retrieve) {
				foreach($retrieve as $row) {
					$date = $row['DATEADDED'];
					$clientid = $row['CLIENT_ID'];
					$appointmentid = $row['RESERVE_ID'];
					$quantity = $row['PROD_QTY'];
					$amount = $row['PRICE'];
					$sql2 = "SELECT A.ACCT_ID, A.STATUS, A.TYPE, C.ACCT_ID, C.FIRSTNAME, C.LASTNAME FROM account AS A INNER JOIN client AS C ON A.ACCT_ID = C.ACCT_ID WHERE A.ACCT_ID = '$clientid' AND A.STATUS = 'ACTIVE' AND A.TYPE = 'Client'";
					$retrieve2 = $conn->query($sql2)->fetchAll();
					if($retrieve2) {
						foreach($retrieve2 as $row2) {
							$name = $row2['LASTNAME']. ", " .$row2['FIRSTNAME'];
							?>
<!--
														<tr style="width: 100%; min-height: 90px; background-color: #fff;">
																<td style="padding: 15px; width: 90%">
																		<span style="font-weight: bold; font-size: 18px;"><?php echo $name; ?></span> <br /><p style="font-size: 12px; line-height: 15px;"><i><b>Date Created:</b> <?php echo $date; ?></i>
																		<br />
																		<i><b>Date Appointed:</b> <?php echo $appointeddate; ?></i>
																		</p>
																</td>
																<td style="padding: 15px; width: 10%; background-color: white; text-align: center; font-size: 30px;">
																		<a href="gethealercomments.php?accountid=<?php echo $labelid; ?>&q=declinenotif&clientid=<?php echo $clientid; ?>" style="color: red;">
																						<i class="fa fa-times" aria-hidden="true"></i>
																		</a>
																		<a href="gethealercomments.php?accountid=<?php echo $labelid; ?>&q=confirmnotif&clientid=<?php echo $clientid; ?>" style="color: green;">
																						<i class="fa fa-check" aria-hidden="true"></i>
																		</a>
																</td>
														</tr>
-->
							<tr style="width: 100%; min-height: 90px; background-color: #fff;">
								<td style="padding: 15px; width: 90%">
									<span style="font-weight: bold; font-size: 18px;"><?php echo $name; ?></span> <br /><p style="font-size: 12px; line-height: 15px;"><i><b>Date Reserved:</b> <?php echo $date; ?></i>
									<br />
									<i><b>Quantity:</b> <?php echo $quantity; ?>&nbsp;&nbsp;&nbsp;<b>Amount to be paid: P </b> <?php echo $amount; ?></i>
									</p>
								</td>
																<td style="padding: 15px; width: 10%; background-color: white; text-align: center; font-size: 30px;">
																		<a href="getproductcomments.php?productid=<?php echo $labelid; ?>&q=declinenotif&clientid=<?php echo $clientid; ?>" style="color: red;">
																						<i class="fa fa-times" aria-hidden="true"></i>
																		</a>
																		<a href="getproductcomments.php?productid=<?php echo $labelid; ?>&q=confirmnotif&clientid=<?php echo $clientid; ?>" style="color: green;">
																						<i class="fa fa-check" aria-hidden="true"></i>
																		</a>
																</td>
							</tr>
						<?php
						}
					}
				}
			} else {
			?>
						<tr style="width: 100%; min-height: 90px; background-color: #fff;">
							<td style="padding: 15px;" colspan="2"><span style="font-style: italic; font-size: 18px;">No notification yet.</span></td>
						</tr>
			<?php
			}
		}
		else if($q == "confirmed") {
			$sql = "SELECT * FROM reservation WHERE HEALER_ID = '$healerid' AND PRODUCT_ID = '$labelid' AND STATUS = 'CONFIRMED' ORDER BY DATECONFIRMED";
			$retrieve = $conn->query($sql)->fetchAll();
			if($retrieve) {
				foreach($retrieve as $row) {
					$date = $row['DATEADDED'];
					$dateconfirmed = $row['DATECONFIRMED'];
					$clientid = $row['CLIENT_ID'];
					$appointmentid = $row['RESERVE_ID'];
					$sql2 = "SELECT A.ACCT_ID, A.STATUS, A.TYPE, C.ACCT_ID, C.FIRSTNAME, C.LASTNAME FROM account AS A INNER JOIN client AS C ON A.ACCT_ID = C.ACCT_ID WHERE A.ACCT_ID = '$clientid' AND A.STATUS = 'ACTIVE' AND A.TYPE = 'Client'";
					$retrieve2 = $conn->query($sql2)->fetchAll();
					if($retrieve2) {
						foreach($retrieve2 as $row2) {
							$name = $row2['LASTNAME']. ", " .$row2['FIRSTNAME'];
							?>
							<tr style="width: 100%; min-height: 90px; background-color: #fff;">
								<td style="padding: 15px;">
									<span style="font-weight: bold; font-size: 18px;"><?php echo $name; ?></span> <br /><p style="font-size: 12px; line-height: 21px;"><i><b>Appointed Date:</b> <?php echo $date; ?>&nbsp;&nbsp;&nbsp; <b>Confirmed Date:</b> <?php echo $dateconfirmed; ?></i></p>
								</td>
							</tr>
						<?php
						}
					}
				}
			} else {
			?>
						<tr style="width: 100%; min-height: 90px; background-color: #fff;">
							<td style="padding: 15px;" colspan="2"><span style="font-style: italic; font-size: 18px;">Nothing confirmed yet.</span></td>
						</tr>
			<?php
			}
		}
		else if($q == "confirmnotif") {
			if(isset($_GET['clientid'])) {
				$clientid = $_GET['clientid'];
				$sql = "SELECT * FROM reservation WHERE PRODUCT_ID = '$labelid' AND HEALER_ID = '$healerid' AND CLIENT_ID = '$clientid' AND STATUS = 'ACTIVE'";
				$retrieve = $conn->query($sql)->fetchAll();
				if($retrieve) {
					foreach($retrieve as $row) {
						$reserveid = $row['RESERVE_ID'];
					}
				}
				confirmFunc($reserveid, $healerid, $labelid, $clientid, $conn);
			}
			else {
				die("Error!");
			}
		}
		else if($q == "declinenotif") {
			if(isset($_GET['clientid'])) {
				$clientid = $_GET['clientid'];
				$sql = "SELECT * FROM reservation WHERE PRODUCT_ID = '$labelid' AND HEALER_ID = '$healerid' AND CLIENT_ID = '$clientid' AND STATUS = 'ACTIVE'";
				$retrieve = $conn->query($sql)->fetchAll();
				if($retrieve) {
					foreach($retrieve as $row) {
						$reserveid = $row['RESERVE_ID'];
					}
				}
				declineFunc($reserveid, $healerid, $labelid, $clientid, $conn);
			}
			else {
				die("Error!");
			}
		}
	}
		function confirmFunc($reserveid, $healerid, $labelid, $clientid, $conn) {
			$sql = "UPDATE reservation SET STATUS = 'CONFIRMED', DATECONFIRMED = NOW() WHERE RESERVE_ID = '$reserveid' AND CLIENT_ID = '$clientid' AND STATUS = 'ACTIVE'";
			$update = $conn->query($sql);
			if($update) {
				$sql2 = "UPDATE notification SET STATUS = 'CONFIRMED', SEEN = 'UNSEEN' WHERE NOTIF_OWNER = '$healerid' AND TYPE_ID = '$reserveid' AND TYPE = 'reservation' AND STATUS = 'ACTIVE'";
				$update2 = $conn->query($sql2);
				if($update2) {
					header('Location: getproductcomments.php?productid='.$labelid.'&q=notification');
				}
				else {
					die('Error!');
				}
			}
		}
		function declineFunc($reserveid, $healerid, $labelid, $clientid, $conn) {
			$sql = "UPDATE reservation SET STATUS = 'DECLINED', DATECONFIRMED = NOW() WHERE RESERVE_ID = '$reserveid' AND CLIENT_ID = '$clientid' AND STATUS = 'ACTIVE'";
			$update = $conn->query($sql);
			if($update) {
				$sql2 = "UPDATE notification SET STATUS = 'DECLINED', SEEN = 'UNSEEN' WHERE NOTIF_OWNER = '$healerid' AND TYPE_ID = '$reserveid' AND TYPE = 'reservation' AND STATUS = 'ACTIVE'";
				$update2 = $conn->query($sql2);
				if($update2) {
					header('Location: getproductcomments.php?productid='.$labelid.'&q=notification');
				}
				else {
					die('Error!');
				}
			}
		}

	?>
</table>

<script type="text/javascript" src="../jquery/filtercomment.js"></script>
