<?php
	session_start();
	
	include 'connection.php';
	
	$accountid = $_SESSION['USERID'];
	
	if(!isset($_FILES['picture'])) {
		$serviceid = $_POST['serviceid'];
		$servicename = $_POST['servicename'];
		$description = $_POST['description'];
		$price = $_POST['price'];
		$type = $_POST['type'];

		$sql = "UPDATE service SET SRVCTYPE_ID = '$type', NAME = '$servicename', DESCRIPTION = '$description', PRICE = '$price' WHERE SERVICE_ID = '$serviceid'";
	}
	else {
		$serviceid = $_POST['serviceid'];
		$servicename = $_POST['servicename'];
		$description = $_POST['description'];
		$price = $_POST['price'];
		$type = $_POST['type'];
		$picture = $_FILES['picture'];
		
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
		
		$sql = "UPDATE service SET SRVCTYPE_ID = '$type', NAME = '$servicename', DESCRIPTION = '$description', PRICE = '$price', PICTURE = '$filename' WHERE SERVICE_ID = '$serviceid'";
	}
	
	$update = $conn->query($sql);
	
	if($update) {
		header('Location: ../healerPages/viewServices.php');
	}
	else {
		die("Error adding to database.");
	}

?>
