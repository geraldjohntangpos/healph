<?php
   session_start();
   include 'connection.php';

   $accountid = $_SESSION['USERID'];
   $picture = $_FILES['picture'];
   
		$target_dir = "../images/client/";
		if(!is_dir($target_dir)) {
			mkdir($target_dir);
		}
		$target_file = $target_dir . basename($picture["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$imageNewName;

		 if (move_uploaded_file($picture["tmp_name"], $target_file)) {
			 $imageNewName = rename($target_file, $target_dir. "client_" .$accountid. "." .$imageFileType);
		 } else {
			 die("Error uploading file.");
		 }

		$filename = "client_" .$accountid. "." .$imageFileType;
		
	$sql = "UPDATE client SET PICTURE = '$filename' WHERE ACCT_ID = '$accountid'";
	$update = $conn->query($sql);
	if($update) {
		header('Location: ../profile.php?accountid=' .$accountid);
	}
	else {
		die('Error uploading picture');
	}
   
?>
