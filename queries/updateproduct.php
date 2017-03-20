<?php
	session_start();

	include 'connection.php';

	$accountid = $_SESSION['USERID'];

	if(!isset($_FILES['picture'])) {
		$productid = $_POST['productid'];
		$productname = $_POST['productname'];
		$description = $_POST['description'];
		$price = $_POST['price'];
		$quantity = $_POST['quantity'];
		$type = $_POST['type'];

		$sql = "UPDATE product SET PRODTYPE_ID = '$type', NAME = '$productname', DESCRIPTION = '$description', PRICE = '$price', QUANTITY = '$quantity' WHERE PRODUCT_ID = '$productid'";
	}
	else {
		$productid = $_POST['productid'];
		$productname = $_POST['productname'];
		$description = $_POST['description'];
		$price = $_POST['price'];
		$quantity = $_POST['quantity'];
		$type = $_POST['type'];
		$picture = $_FILES['picture'];

		$target_dir = "../images/product/" .$accountid. "/";
		if(!is_dir($target_dir)) {
			mkdir($target_dir);
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

		$sql = "UPDATE product SET PRODTYPE_ID = '$type', NAME = '$productname', DESCRIPTION = '$description', PRICE = '$price', QUANTITY = '$quantity', PICTURE = '$filename' WHERE PRODUCT_ID = '$productid'";
	}

	$update = $conn->query($sql);

	if($update) {
		header('Location: ../healerPages/viewProducts.php');
	}
	else {
		die("Error adding to database.");
	}

?>
