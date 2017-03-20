<?php
	session_start();
	include 'connection.php';
	if(isset($_GET['feedid']) && isset($_GET['ref']) && isset($_GET['labelid'])) {
		$feedid = $_GET['feedid'];
		$ref = $_GET['ref'];
		$labelid = $_GET['labelid'];

		$sql = "DELETE  FROM client_feedback WHERE FEEDBACK_ID = '$feedid'";
		$delete = $conn->query($sql);
		if($delete) {
			switch($ref) {
				case 'healer':
					header('Location: gethealercomments.php?accountid=' .$labelid. '&q=comments');
					break;
				case 'method':
					header('Location: getmethodcomments.php?methodid=' .$labelid. '&q=comments');
					break;
				case 'product':
					header('Location: getproductcomments.php?productid=' .$labelid. '&q=comments');
					break;

			}
		}

	}
?>
