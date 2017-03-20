<?php
	session_start();
	require_once 'connection.php';

	if(isset($_REQUEST['usernamelogin']) && isset($_REQUEST['passwordlogin'])) {

		$username = $_REQUEST['usernamelogin'];
		$password = $_REQUEST['passwordlogin'];

		$sql = "SELECT * FROM account WHERE USERNAME = '$username' AND PASSWORD = '$password' AND STATUS = 'ACTIVE'";
		$retlogin = $conn->query($sql)->fetchAll();
		if(count($retlogin)>0) {
			foreach($retlogin as $row) {
				$userid = $row['ACCT_ID'];
				$username = $row['USERNAME'];
				$type = $row['TYPE'];
			}

			if($type == "Client") {
				$sql = "SELECT * FROM client WHERE ACCT_ID = '$userid'";
			}
			else  if($type == "Healer") {
				$sql = "SELECT * FROM healer WHERE ACCT_ID = '$userid'";
			}
			else {
				$sql = "SELECT * FROM admin WHERE ACCT_ID = '$userid'";
			}

			$retdata = $conn->query($sql)->fetchAll();
			if(count($retdata)>0) {
				foreach($retdata as $row) {
					$name = $row['LASTNAME']. ", " .$row['FIRSTNAME'];
				}
			}
			else {
				session_destroy();
				header('Location: ../login.php?q=invalidlogin');
			}

			$_SESSION['USERID'] = $userid;
			$_SESSION['USERNAME'] = $username;
			$_SESSION['NAME'] = $name;
			$_SESSION['TYPE'] = $type;
			header('Location: ../login.php');
		}
		else {
			session_destroy();
			header('Location: ../login.php?q=invalidlogin');
		}
	}

?>
