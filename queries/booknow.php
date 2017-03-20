<?php

	session_start();
	include 'connection.php';

		$serviceid = $_POST['methodid']; //service
		$accountid = $_POST['ownerid']; //healer
		$bookingdate = $_POST['date'];
		$bookingtime = $_POST['bookingtime'];
		$ref = "promotion";
		$clientid = $_SESSION['USERID']; //booker

		//Check if the id sent really existed in the database.
		$sql = "SELECT * FROM service WHERE SERVICE_ID = '$serviceid' AND STATUS = 'ACTIVE'";

		$retrieve = $conn->query($sql)->fetchAll();

		if($retrieve) {

			$sql = "SELECT * FROM booking WHERE CLIENT_ID = '$clientid' AND HEALER_ID = '$accountid' AND SERVICE_ID = '$serviceid' AND STATUS = 'ACTIVE'";

			$check = $conn->query($sql)->fetchAll();

			if($check) {
				header('Location: ../method.php?methodid=' .$serviceid. '&ref=' .$ref. '&bookingexisted');
			}
			else {
				$sql = "INSERT INTO booking(HEALER_ID, DATEADDED, CLIENT_ID, SERVICE_ID, BOOKINGDATE, BOOKINGTIME) VALUES('$accountid', NOW(), '$clientid', '$serviceid', '$bookingdate', '$bookingtime')";

				$insert = $conn->query($sql);

				if($insert) {
					$sql = "SELECT * FROM booking WHERE CLIENT_ID = '$clientid' AND HEALER_ID = '$accountid' AND STATUS = 'ACTIVE'";
					$retrieve = $conn->query($sql)->fetchAll();
					if($retrieve) {
						foreach($retrieve as $row) {
							$appointmentid = $row['BOOKING_ID'];
							$dateadded = $row['DATEADDED'];
						}
					}
					$sql = "INSERT INTO notification (NOTIF_OWNER, NOTIFIER, TYPE, TYPE_ID, NOTIFDATE) VALUES('$accountid', '$clientid', 'booking', '$appointmentid', '$dateadded')";
					$insertnotif = $conn->query($sql);
					if($insertnotif) {
						header('Location: ../method.php?methodid=' .$serviceid. '&ref=' .$ref. '&booksuccess');
					}
				}
				else {
					die('Error booking!');
				}
			}

		}
		else {
			header('Location: ../promotion.php');
		}

?>
