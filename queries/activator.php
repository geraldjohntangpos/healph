<?php
	include 'connection.php';

	if(isset($_REQUEST['accountid'])) {
		$accountid = $_REQUEST['accountid'];
		//search for the healer
		$sql = "SELECT * FROM healer WHERE ACCT_ID = '$accountid'";
		$retrieve = $conn->query($sql)->fetchAll();
		if($retrieve) {
			foreach($retrieve as $row) {
				//get the expirydate
				$subexpiry = $row['SUBEXPIRY'];
				$expmonth = date("m");
				$expday = date("d");
				$expyear = date("Y");
				$monthdays = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
				$expday = date('d') + 30;
				if($expyear%4==0) {
					$monthdays[1] = 29;
				}
				while($expday>$monthdays[$expmonth-1]) {
					$expday = $expday-$monthdays[$expmonth-1];
					$expmonth++;
					if($expmonth>12) {
						$expyear++;
						$expmonth=1;
					}
				}
				if(strlen($expday) < 2) {
					$expday = "0" .$expday;
				}
				if(strlen($expmonth) < 2) {
					$expmonth = "0" .$expmonth;
				}
			}
			$newexpiry = $expyear."-".$expmonth."-".$expday;
			$sqlhealer = "UPDATE healer SET SUBEXPIRY = '$newexpiry', STATUS = 'ACTIVE' WHERE ACCT_ID = '$accountid' AND STATUS = 'EXPIRED'";
			$updatehealer = $conn->query($sqlhealer);
			if($updatehealer) {
				$sqlservice = "SELECT * FROM service WHERE ACCT_ID = '$accountid' AND STATUS = 'INACTIVE'";
				$searchservice = $conn->query($sqlservice)->fetchAll();
				if($searchservice) {
					$activateservice = $conn->query("UPDATE service SET STATUS = 'ACTIVE' WHERE ACCT_ID = '$accountid' AND STATUS = 'INACTIVE'");
					if(!$activateservice) {
						die("Error activating service");
					}
				}
				$sqlproduct = "SELECT * FROM product WHERE ACCT_ID = '$accountid' AND STATUS = 'INACTIVE'";
				$searchproduct = $conn->query($sqlproduct)->fetchAll();
				if($searchservice) {
					$activateproduct = $conn->query("UPDATE product SET STATUS = 'ACTIVE' WHERE ACCT_ID = '$accountid' AND STATUS = 'INACTIVE'");
					if(!$activateproduct) {
						die("Error activating product");
					}
				}
			}
			else {
				die("Error activating healer.");
			}
			header('Location: ../adminPages/viewsubscription.php');
		}
		else {
			die("Healer not found!");
		}
	}
	else {
		die("Healer not set.");
	}
?>
