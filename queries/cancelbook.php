<?php

	session_start();
	include 'connection.php';

	if(isset($_GET['id']) && isset($_GET['ref'])) {
		
		$methodid = $_GET['id'];
		$ref = $_GET['ref'];
		$clientid = $_SESSION['USERID'];
		
		$sql = "SELECT * FROM service WHERE SERVICE_ID = '$methodid' AND STATUS = 'ACTIVE'";
		
		$retrieve = $conn->query($sql)->fetchAll();
		
		if($retrieve) {
			foreach($retrieve as $row) {
				$healerid = $row['ACCT_ID'];
			}
			
			$sql = "SELECT * FROM booking WHERE CLIENT_ID = '$clientid' AND HEALER_ID = '$healerid' AND SERVICE_ID = '$methodid' AND STATUS = 'ACTIVE'";
			
			$check = $conn->query($sql)->fetchAll();
			
			if($check) {
				foreach($check as $row) {
					$bookid = $row['BOOKING_ID'];
				}
				$sql = "DELETE FROM booking WHERE CLIENT_ID = '$clientid' AND HEALER_ID = '$healerid' AND SERVICE_ID = '$methodid' AND STATUS = 'ACTIVE'";

				$delete = $conn->query($sql);

				if($delete) {
					$sql = "DELETE FROM notification WHERE NOTIF_OWNER = '$healerid' AND TYPE = 'booking' AND TYPE_ID = '$bookid' AND STATUS = 'ACTIVE'";
					
					$deletenotif = $conn->query($sql);
					if($deletenotif) {
						header('Location: ../method.php?methodid=' .$methodid. '&ref=' .$ref);
					}
					
				}
				else {
					die('Error booking!');
				}
			}
			else {
				header('Location: ../method.php?methodid=' .$methodid. '&ref=' .$ref. '&bookingnotfound');
			}
			
		}
		else {
			header('Location: ../promotion.php');
		}
		
	}
	else {
		header('Location: ../promotion.php');
	}

?>
