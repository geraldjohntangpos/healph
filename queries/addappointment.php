<?php

	session_start();
	include 'connection.php';

		$accountid = $_POST['ownerid'];
		$appointeddate = $_POST['date'];
		$appointedtime = $_POST['appointedtime'];
		$ref = "promotion";
		$clientid = $_SESSION['USERID'];

		//Check if the id sent really existed in the database.
		$sql = "SELECT * FROM healer WHERE ACCT_ID = '$accountid' AND STATUS = 'ACTIVE'";

		$retrieve = $conn->query($sql)->fetchAll();

		if($retrieve) {

			$sql = "SELECT * FROM appointment WHERE CLIENT_ID = '$clientid' AND HEALER_ID = '$accountid' AND STATUS = 'ACTIVE'";

			$check = $conn->query($sql)->fetchAll();

			if($check) {
				header('Location: ../healer.php?accountid=' .$accountid. '&ref=' .$ref. '&appointmentexisted');
			}
			else {
				$sql = "INSERT INTO appointment(HEALER_ID, DATEADDED, CLIENT_ID, APPOINTEDDATE, APPOINTEDTIME) VALUES('$accountid', NOW(), '$clientid', '$appointeddate', '$appointedtime')";

				$insert = $conn->query($sql);

				if($insert) {
					$sql = "SELECT * FROM appointment WHERE CLIENT_ID = '$clientid' AND HEALER_ID = '$accountid' AND STATUS = 'ACTIVE'";
					$retrieve = $conn->query($sql)->fetchAll();
					if($retrieve) {
						foreach($retrieve as $row) {
							$appointmentid = $row['APPOINTMENT_ID'];
							$dateadded = $row['DATEADDED'];
						}
					}
					$sql = "INSERT INTO notification (NOTIF_OWNER, TYPE, TYPE_ID, NOTIFDATE, NOTIFIER) VALUES('$accountid', 'appointment', '$appointmentid', '$dateadded', '$clientid')";
					$insertnotif = $conn->query($sql);
					if($insertnotif) {
						header('Location: ../healer.php?accountid=' .$accountid. '&ref=' .$ref. '&booksuccess');
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
