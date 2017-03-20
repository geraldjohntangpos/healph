<?php
	include 'connection.php';

	if(isset($_REQUEST['healerid'])) {
		$healerid = $_REQUEST['healerid'];
		$sql = "SELECT A.HEALER_ID, A.CLIENT_ID, A.APPOINTEDDATE, A.APPOINTEDTIME, A.STATUS, C.ACCT_ID, C.FIRSTNAME, C.LASTNAME FROM appointment AS A INNER JOIN client as C ON A.CLIENT_ID = C.ACCT_ID WHERE A.HEALER_ID = '$healerid' AND A.STATUS != 'DECLINED' ORDER BY APPOINTEDDATE AND APPOINTEDTIME";
		$retrieve = $conn->query($sql)->fetchAll();
			$result['res'] = array();
		if($retrieve) {
			foreach($retrieve as $row) {
				$title = $row['LASTNAME']. ", " .$row['FIRSTNAME'];
				$status = $row['STATUS'];
				if($status == 'CONFIRMED') {
					$status = "(Confirmed)";
				}
				else {
					$status = "(Confirmation needed)";
				}
				$description = "New Appointment " .$status;
				$year = substr($row['APPOINTEDDATE'], 0, 4);
				$month = substr($row['APPOINTEDDATE'], 5, 2) - 1;
				$day = substr($row['APPOINTEDDATE'], 8, 2);
				$hours = substr($row['APPOINTEDTIME'], 0, 2);
//				$datetime = new Date((int)$year, (int)$month, (int)$day, (int)$hours);

				$result['res'][] = array("title"=>$title, "description"=>$description, "month"=>$month, "year"=>$year, "day"=>$day, "hours"=>$hours);
//				$result['res'][] = array("title"=>$title, "description"=>$description, "datetime"=>"new Date($year, $month, $day, $hours)");
			}
		}
		$healerid = $_REQUEST['healerid'];
		$sql = "SELECT B.HEALER_ID, B.CLIENT_ID, B.BOOKINGDATE, B.BOOKINGTIME, B.STATUS, C.ACCT_ID, C.FIRSTNAME, C.LASTNAME FROM booking AS B INNER JOIN client as C ON B.CLIENT_ID = C.ACCT_ID WHERE B.HEALER_ID = '$healerid' AND B.STATUS != 'DECLINED' ORDER BY BOOKINGDATE AND BOOKINGTIME";
		$retrieve = $conn->query($sql)->fetchAll();
		if($retrieve) {
			foreach($retrieve as $row) {
				$title = $row['LASTNAME']. ", " .$row['FIRSTNAME'];
				$status = $row['STATUS'];
				if($status == 'CONFIRMED') {
					$status = "(Confirmed)";
				}
				else {
					$status = "(Confirmation needed)";
				}
				$description = "New Booking " .$status;
				$year = substr($row['BOOKINGDATE'], 0, 4);
				$month = substr($row['BOOKINGDATE'], 5, 2) -1;
				$day = substr($row['BOOKINGDATE'], 8, 2);
				$hours = substr($row['BOOKINGTIME'], 0, 2);
//				$datetime = new Date((int)$year, (int)$month, (int)$day, (int)$hours);

				$result['res'][] = array("title"=>$title, "description"=>$description, "month"=>$month, "year"=>$year, "day"=>$day, "hours"=>$hours);
//				$result['res'][] = array("title"=>$title, "description"=>$description, "datetime"=>"new Date($year, $month, $day, $hours)");
			}
		}
	}
	else {
		header('Location: ../loginHealer.php?something_went_wrong');
	}

	echo json_encode($result['res']);
?>
