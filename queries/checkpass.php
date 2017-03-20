<?php
	include 'connection.php';
	$success = [];
	$success = array("res"=>"ha");
	if(isset($_REQUEST['accountid']) && isset($_REQUEST['pass'])) {
		$accountid = $_REQUEST['accountid'];
		$pass = $_REQUEST['pass'];
		$sql = "SELECT * FROM account WHERE ACCT_ID = '$accountid'";
		$retrieve = $conn->query($sql)->fetchAll();
		if($retrieve) {
			foreach($retrieve as $row) {
				$password = $row['PASSWORD'];
				if($pass === $password) {
					$success = array("res"=>true);
				}
				else {
					$success = array("res"=>false);
				}
			}
		}
	}
	echo json_encode($success["res"]);
?>
