<?php
	include 'connection.php';
	
	function makeItTwo($number) {
		if(strlen($number) == 1) {
			$number = "0" .$number;
		}
		return $number;
	}

	if(isset($_REQUEST['fulldate']) && isset($_REQUEST['healerid'])) {
		$fulldate = $_REQUEST['fulldate'];
		$healerid = $_REQUEST['healerid'];
		$availablesched = [];
		$sql = "SELECT * FROM healer WHERE ACCT_ID = '$healerid'";
		$retrieve = $conn->query($sql)->fetchAll();
		if($retrieve) {
			foreach($retrieve as $row) {
				$maxtime = $row['DAILYLIMIT'];
				$clinichours = $row['CLINICHOURS'];
			}
			
			$hstart = substr($clinichours, 0, 2);
			$mstart = substr($clinichours, 3, 2);
			$hend = substr($clinichours, 8, 2);
			$mend = substr($clinichours, 11, 2);
			$hctr = $hstart;
			$mctr = $mstart;
			
			while(($hctr*60+$mctr+$maxtime) < ($hend*60+$mend)) {
				$hfirst = makeItTwo($hctr);
				$mfirst = makeItTwo($mctr);
				$hsecond;
				$msecond;
				for($i = 0; $i < $maxtime; $i++) {
					$mctr++;
					if($mctr == 60) {
						$hctr++;
						$mctr = 0;
					}
				}
				$hsecond = makeItTwo($hctr);
				$msecond = makeItTwo($mctr);
				$trange = $hfirst. ":" .$mfirst. " - " .$hsecond. ":" .$msecond;
				$availablesched[] = $trange;
			}
		}
		
		$sql = "SELECT * FROM appointment WHERE HEALER_ID = '$healerid' AND APPOINTEDDATE = '$fulldate'";
		$sql2 = "SELECT * FROM booking WHERE HEALER_ID = '$healerid' AND BOOKINGDATE = '$fulldate'";
		$retrieve = $conn->query($sql)->fetchAll();
		$retrieve2 = $conn->query($sql2)->fetchAll();
		$newsched = [];
		$occupied = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

		if($retrieve) {
			foreach($retrieve as $row) {
				$appointedtime = $row['APPOINTEDTIME'];
				for($i = 0; $i < count($availablesched); $i++) {
					if($availablesched[$i] != $appointedtime) {
						$newsched[] = $availablesched[$i];
					}
					else {
						$newsched[] = $occupied;
					}
				}
			}
			$availablesched = $newsched;
			$newsched = [];
		}
		if($retrieve2) {
			foreach($retrieve2 as $row) {
				$bookingtime = $row['BOOKINGTIME'];
				for($i = 0; $i < count($availablesched); $i++) {
					if($availablesched[$i] != $bookingtime) {
						$newsched[] = $availablesched[$i];
					}
					else {
						$newsched[] = $occupied;
					}
				}
			}
			$availablesched = $newsched;
			$newsched = [];
		}
		else {
			$display['result'] = null;
		}
	}
	else {
		header('Location: ../promotion.php?something_went_wrong');
	}

	echo json_encode($availablesched);


?>
