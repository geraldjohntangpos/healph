<?php
	include 'connection.php';
	$clientid = $_SESSION['USERID'];

	if(isset($_GET['accountid'])) {
		$id = $_GET['accountid'];
		$sql = "SELECT * FROM service WHERE ACCT_ID = '$id' AND STATUS = 'ACTIVE'";
		$retrieve = $conn->query($sql)->fetchAll();
		if($retrieve) {
			foreach($retrieve as $row) {
				$servicename = $row['NAME'];
				$serviceid = $row['SERVICE_ID'];
				$serviceprice = $row['PRICE'];
?>
				<tr style="width: 100%; border:1px solid #0f0;">
					<td style="border:1px solid #0f0; width: 50%; padding-left: 15px;">
						<a href="method.php?methodid=<?php echo $serviceid; ?>&ref=promotion"><?php echo $servicename; ?></a>
					</td>
					<td style="border:1px solid #0f0; text-align: center; width: 20%;">
						P <?php echo $serviceprice; ?>
					</td>
					<td style="border:1px solid #0f0; text-align: center; width: 30%;">
<?php
				$sql2 = "SELECT * FROM booking WHERE HEALER_ID = '$accountid' AND CLIENT_ID = '$clientid' AND SERVICE_ID = '$serviceid' AND STATUS = 'ACTIVE'";
				$retrieve2 = $conn->query($sql2)->fetchAll();
				if($retrieve2) {
?>
					<a href="queries/cancelbook.php?id=<?php echo $serviceid; ?>&ref=promotion">Cancel Book</a>
<?php
				}
				else {
?>
					<a href="bookingform.php?id=<?php echo $serviceid; ?>">Book Now</a>
<?php
				}
?>
					</td>
				</tr>
<?php
			}
		}
	}
?>
