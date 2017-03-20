<?php

	session_start();
	include 'connection.php';

	if(isset($_GET['id']) && isset($_GET['ref'])) {
		
		$healerid = $_GET['id'];
		$ref = $_GET['ref'];
		$clientid = $_SESSION['USERID'];
		
		$sql = "SELECT * FROM healer WHERE ACCT_ID = '$healerid' AND STATUS = 'ACTIVE'";
		
		$retrieve = $conn->query($sql)->fetchAll();
		
		if($retrieve) {
			$sql = "SELECT * FROM appointment WHERE CLIENT_ID = '$clientid' AND HEALER_ID = '$healerid' AND STATUS = 'ACTIVE'";
			
			$check = $conn->query($sql)->fetchAll();
			
			if($check) {
				foreach($check as $row) {
					$appointmentid = $row['APPOINTMENT_ID'];
				}
				$sql = "DELETE FROM appointment WHERE CLIENT_ID = '$clientid' AND HEALER_ID = '$healerid' AND STATUS = 'ACTIVE'";

				$delete = $conn->query($sql);

				if($delete) {
					$sql = "DELETE FROM notification WHERE NOTIF_OWNER = '$healerid' AND TYPE = 'appointment' AND TYPE_ID = '$appointmentid' AND STATUS = 'ACTIVE'";
					
					$deletenotif = $conn->query($sql);
					if($deletenotif) {
						header('Location: ../healer.php?accountid=' .$healerid. '&ref=' .$ref);
					}
					
				}
				else {
					die('Error adding appointment!');
				}
			}
			else {
				header('Location: ../healer.php?accountid=' .$methodid. '&ref=' .$ref. '&appointmentnotfound');
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
