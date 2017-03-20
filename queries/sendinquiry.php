<?php
	include 'connection.php';

	$name = filter_var($_GET['name'], FILTER_SANITIZE_STRING);
	$email = $_GET['email'];
	$request = filter_var($_GET['request'], FILTER_SANITIZE_STRING);

	$sql = "INSERT INTO inquiries(NAME, EMAIL, REQUEST, ADDED_AT) VALUES('$name', '$email', '$request', NOW())";
	$insert = $conn->query($sql);
	if($insert) {
		header('Location: ../index.php?succesfullyinquired');
	}
	else {
		header('Location: ../index.php?inquiryfailed');
	}
?>
