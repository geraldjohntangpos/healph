<?php
	include 'connection.php';

	if(isset($_REQUEST['label']) && isset($_REQUEST['labelid'])) {
		$label = $_REQUEST['label'];
		$labelid = $_REQUEST['labelid'];
		$success = array();

		switch($label) {
			case "healer":
				$sql = "SELECT * FROM $label WHERE ACCT_ID = '$labelid'";
				break;
			case "service":
				$sql = "SELECT * FROM $label WHERE SERVICE_ID = '$labelid'";
				break;
			case "product":
				$sql = "SELECT * FROM $label WHERE PRODUCT_ID = '$labelid'";
				break;
		}

		$retrieve = $conn->query($sql)->fetchAll();
		if($retrieve) {
			foreach($retrieve as $row) {
				$count = $row['RATE'];
				$success = array("count"=>(int)$count);
			}
		}

		echo json_encode($success);
	}
	$conn = null;
?>
