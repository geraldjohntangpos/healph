<?php
	session_start();
	include 'connection.php';

	if(isset($_POST['username']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['emailadd']) && isset($_POST['mobile'])) {
		$username = $_POST['username'];
		$firstname = filter_var(ucwords(strtolower($_POST['firstname'])), FILTER_SANITIZE_STRING);
		$lastname = filter_var(ucwords(strtolower($_POST['lastname'])), FILTER_SANITIZE_STRING);
		$emailadd = $_POST['emailadd'];
		$mobile = $_POST['mobile'];
		$accountid = $_SESSION['USERID'];

		$sql = "UPDATE client SET FIRSTNAME = '$firstname', LASTNAME = '$lastname', EMAIL_ADDRESS = '$emailadd', MOBILE = '$mobile' WHERE ACCT_ID = '$accountid'";
		$update = $conn->query($sql);
		if($update) {
			$_SESSION['NAME'] = $lastname. ", " .$firstname;
			header('Location: ../profile.php?accountid='. $accountid);
		}
		else {
			header('Location: ../promotion.php');
		}
	}
	else {
		header('Location: ../promotion.php');
	}
?>
