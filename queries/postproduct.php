<?php
	session_start();

	include 'connection.php';

	$productname = $_POST['productname'];
	$description = $_POST['description'];
	$price = $_POST['price'];
	$quantity = $_POST['quantity'];
	$type = $_POST['type'];
	$picture = $_FILES['picture'];
	$accountid = $_SESSION['USERID'];

	$target_dir = "../images/product/" .$accountid. "/";
	if(!is_dir($target_dir)) {
		mkdir("../images/product/" .$accountid. "/");
	}
	$target_file = $target_dir . basename($picture["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$imageNewName;

	 if (move_uploaded_file($picture["tmp_name"], $target_file)) {
		 $imageNewName = rename($target_file, $target_dir. "product_" .$accountid.$productname. "." .$imageFileType);
	 } else {
		 die("Error uploading file.");
	 }

	$filename = "product_" .$accountid.$productname. "." .$imageFileType;

	$sql = "INSERT INTO product(PRODTYPE_ID, ACCT_ID, NAME, DESCRIPTION, PRICE, QUANTITY, PICTURE) VALUES('$type', '$accountid', '$productname', '$description', '$price', '$quantity', '$filename')";

	$insert = $conn->query($sql);

	if($insert) {
		header('Location: ../healerPages/viewProducts.php');
	}
	else {
		die("Error adding to database.");
	}

?>
