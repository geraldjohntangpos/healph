<?php
	session_start();

	include 'connection.php';

	$servicename = $_POST['servicename'];
	$description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
	$price = $_POST['price'];
	$type = $_POST['type'];
	$picture = $_FILES['picture'];
	$accountid = $_SESSION['USERID'];

	$target_dir = "../images/service/" .$accountid. "/";
	if(!is_dir($target_dir)) {
		mkdir($target_dir);
	}
	$target_file = $target_dir . basename($picture["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$imageNewName;

	 if (move_uploaded_file($picture["tmp_name"], $target_file)) {
		 $imageNewName = rename($target_file, $target_dir. "service_" .$accountid.$servicename. "." .$imageFileType);
	 } else {
		 die("Error uploading file.");
	 }

	$filename = "service_" .$accountid.$servicename. "." .$imageFileType;

	$sql = "INSERT INTO service(SRVCTYPE_ID, ACCT_ID, NAME, DESCRIPTION, PRICE, PICTURE) VALUES('$type', '$accountid', '$servicename', '$description', '$price', '$filename')";

	$insert = $conn->query($sql);

	if($insert) {
		header('Location: ../healerPages/viewServices.php');
	}
	else {
		die("Error adding to database.");
	}

?>
