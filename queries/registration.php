<?php

	session_start();

	require 'connection.php';

	$username = $_POST['username'];
	$password = $_POST['password'];
	$firstname = filter_var(ucwords(strtolower($_POST['firstname'])), FILTER_SANITIZE_STRING);
	$lastname = filter_var(ucwords(strtolower($_POST['lastname'])), FILTER_SANITIZE_STRING);
	$emailadd = $_POST['emailadd'];
	$mobile = $_POST['mobile'];
	$type = $_POST['type'];

	$sql = "INSERT INTO account(USERNAME, PASSWORD, TYPE) VALUES('$username', '$password', '$type')";
	$insert = $conn->query($sql);


	if($insert) {

		$sql = "SELECT * FROM account WHERE USERNAME = '$username'";
		$select = $conn->query($sql)->fetchAll();
		foreach($select as $row) {
			$id = $row['ACCT_ID'];
		}

		if($type=="Client") {
			$sql = "INSERT INTO client(ACCT_ID, FIRSTNAME, LASTNAME, EMAIL_ADDRESS, MOBILE) VALUES('$id', '$firstname', '$lastname', '$emailadd', '$mobile')";

			$insert2 = $conn->query($sql);

			if($insert2) {
				$_SESSION['USERID'] = $id;
				$_SESSION['USERNAME'] = $username;
				$_SESSION['NAME'] = $lastname. ", " .$firstname;
				$_SESSION['TYPE'] = $type;
				header('Location: ../register.php');
			}
			else {
				die("Error adding to client!");
			}
		}
		else if($type=="Healer") {
			$lat = $_POST['lat'];
			$lng = $_POST['lng'];
			$add = $_POST['add'];
			$sql = "INSERT INTO healer(ACCT_ID, FIRSTNAME, LASTNAME, EMAIL_ADDRESS, LATITUDE, LONGITUDE, ADDRESS, CONTACT) VALUES('$id', '$firstname', '$lastname', '$emailadd', '$lat', '$lng', '$add', '$mobile')";

			$insert2 = $conn->query($sql);

			if($insert2) {
				header('Location: ../adminPages/viewhealer.php');
			}
			else {
				die("Error adding to healer!");
			}
		}

	}
	else {
		die("Error adding to account!");
	}

?>
