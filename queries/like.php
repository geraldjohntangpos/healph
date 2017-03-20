<?php
	session_start();
	include 'connection.php';

	if(isset($_REQUEST['label']) && isset($_REQUEST['labelid'])) {
		$label = $_REQUEST['label'];
		$labelid = $_REQUEST['labelid'];
		$likerid = $_SESSION['USERID'];
		$success = array("success"=>false);

		$sql = "SELECT * FROM reaction WHERE LABEL = '$label' AND LABEL_ID = '$labelid' AND LIKER_ID = '$likerid'";
		$retrieve = $conn->query($sql)->fetchAll();
		if($retrieve) {
			$sqldislike = "DELETE FROM reaction WHERE LABEL = '$label' AND LABEL_ID = '$labelid' AND LIKER_ID = '$likerid'";
			$dislike = $conn->query($sqldislike);
			if($dislike) {
				switch($label) {
					case "healer":
						$sql2 = "UPDATE healer SET RATE = RATE-1 WHERE ACCT_ID = '$labelid'";
						break;
					case "service":
						$sql2 = "UPDATE service SET RATE = RATE-1 WHERE SERVICE_ID = '$labelid'";
						break;
					case "product":
						$sql2 = "UPDATE product SET RATE = RATE-1 WHERE PRODUCT_ID = '$labelid'";
						break;
				}
				$update = $conn->query($sql2);
				if($update) {
					$success = array("success"=>true);
				}
				else {
					$success = array("success"=>false);
				}
			}
			else {
				$success = array("success"=>false);
			}
		}
		else {
			$sqllike = "INSERT reaction (LABEL, LABEL_ID, LIKER_ID, DATELIKED) VALUES('$label', '$labelid', '$likerid', NOW())";
			$like = $conn->query($sqllike);
			if($like) {
				switch($label) {
					case "healer":
						$sql2 = "UPDATE healer SET RATE = RATE+1 WHERE ACCT_ID = '$labelid'";
						break;
					case "service":
						$sql2 = "UPDATE service SET RATE = RATE+1 WHERE SERVICE_ID = '$labelid'";
						break;
					case "product":
						$sql2 = "UPDATE product SET RATE = RATE+1 WHERE PRODUCT_ID = '$labelid'";
						break;
				}
				$update = $conn->query($sql2);
				if($update) {
					$success = array("success"=>true);
				}
				else {
					$success = array("success"=>false);
				}
			}
			else {
				$success = array("success"=>false);
			}
		}

		echo json_encode($success);
	}
	$conn = null;
?>
