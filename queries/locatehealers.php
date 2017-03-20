<?php
	include 'connection.php';

		$sql = "SELECT * FROM healer WHERE STATUS = 'ACTIVE'";
		$retrieve = $conn->query($sql)->fetchAll();
		if($retrieve) {
			$result = array();
			$latlng = array();
			foreach($retrieve as $row) {
				$title = $row['LASTNAME']. ", " .$row['FIRSTNAME'];
				$lat = $row['LATITUDE'];
				$lng = $row['LONGITUDE'];

//				$latlng = "{lat: $lat, lng: $long}";
				$latlng = array("lat"=>(float)$lat, "lng"=>(float)$lng);
//				$result[] = array("title"=>$title, "lat"=>(float)$lat, "lng"=>(float)$lng);
				$result[] = array("title"=>$title, "location"=>array("lat"=>(float)$lat, "lng"=>(float)$lng));
			}
		}
		else {
			$result = null;
		}
	echo json_encode($result);
?>
