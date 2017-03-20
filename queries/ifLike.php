<?php
	session_start();
	include 'connection.php';

	if(isset($_REQUEST['label']) && $_REQUEST['labelid']) {
		$label = $_REQUEST['label'];
		$labelid = $_REQUEST['labelid'];
		$likerid = $_SESSION['USERID'];

		$sql = "SELECT * FROM reaction WHERE LABEL = '$label' AND LABEL_ID = '$labelid' AND LIKER_ID = '$likerid'";
		$retrieve = $conn->query($sql)->fetchAll();
		$result;
		if($retrieve) {
			$result = array("liked"=>"yes");
		}
		else {
			$result = array("liked"=>"no");
		}
		echo json_encode($result);
	}
	$conn = null;
?>
