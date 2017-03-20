<?php
	include 'connection.php';

	if(isset($_REQUEST['accountid'])) {
		$accountid = $_REQUEST['accountid'];
		$result = array();
		//search for the healer
		$sql = "SELECT * FROM healer WHERE ACCT_ID = '$accountid'";
		$retrieve = $conn->query($sql)->fetchAll();
		if($retrieve) {
			foreach($retrieve as $row) {
				$subexpiry = $row['SUBEXPIRY'];
				$expmonth = substr($subexpiry, 5, 2);
				$expday = substr($subexpiry, 8, 2);
				$expyear = substr($subexpiry, 0, 4);
				$monthdays = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
				$expday = $expday + 30;
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
			$sql = "UPDATE healer SET SUBEXPIRY = '$newexpiry' WHERE ACCT_ID = '$accountid'";
			$update = $conn->query($sql);
			if($update) {
				$result = array("success"=>"true", "message"=>$newexpiry);
			}
			else {
				$result = array("success"=>"false", "message"=>"Error updating extending subscription");
			}
		}
		else {
			$result = array("success"=>"false", "message"=>"Accountid not found");
		}
	}
	else {
		$result = array("success"=>"false", "message"=>"Accountid not set");
	}

	echo json_encode($result);
?>
