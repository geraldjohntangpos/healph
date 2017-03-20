<?php

	session_start();
	include 'connection.php';

		$productid = $_POST['productid'];
		$quantity = $_POST['reservequantity'];
		$amount = $_POST['amount'];
		$ref = "promotion";
		$clientid = $_SESSION['USERID'];

		//Check if the id sent really existed in the database.
		$sql = "SELECT * FROM product WHERE PRODUCT_ID = '$productid' AND STATUS = 'ACTIVE'";

		$retrieve = $conn->query($sql)->fetchAll();

		if($retrieve) {
			foreach($retrieve as $row) {
				$healerid = $row['ACCT_ID'];
			}

			$sql = "SELECT * FROM reservation WHERE CLIENT_ID = '$clientid' AND HEALER_ID = '$healerid' AND PRODUCT_ID = '$productid' AND STATUS = 'ACTIVE'";

			$check = $conn->query($sql)->fetchAll();

			if($check) {
				header('Location: ../product.php?productid=' .$productid. '&ref=' .$ref. '&bookingexisted');
			}
			else {
				$sql = "INSERT INTO reservation(CLIENT_ID, HEALER_ID, PRODUCT_ID, PROD_QTY, PRICE, DATEADDED) VALUES('$clientid', '$healerid', '$productid', '$quantity', '$amount', NOW())";

				$insert = $conn->query($sql);
				//insert the reservation into the reservation table
				if($insert) {
					//get the dateadded from the reservation table and put it in the notification for an identical data.
					$sql = "SELECT * FROM reservation WHERE CLIENT_ID = '$clientid' AND HEALER_ID = '$healerid' AND PRODUCT_ID = '$productid' AND STATUS = 'ACTIVE'";
					$retrieve = $conn->query($sql)->fetchAll();
					if($retrieve) {
						foreach($retrieve as $row) {
							$reserveid = $row['RESERVE_ID'];
							$dateadded = $row['DATEADDED'];
						}
					}
					$sql = "INSERT INTO notification (NOTIF_OWNER, TYPE, TYPE_ID, NOTIFDATE, NOTIFIER) VALUES('$healerid', 'reservation', '$reserveid', '$dateadded', '$clientid')";
					$insertnotif = $conn->query($sql);
					if($insertnotif) {
						//update the quantity in the product table.
						$sql = "UPDATE product SET QUANTITY = QUANTITY-'$quantity' WHERE PRODUCT_ID = '$productid'";
						$update = $conn->query($sql);
						if($update) {
							header('Location: ../product.php?productid=' .$productid. '&ref=' .$ref. '&booksuccess');
						}
					}
				}
				else {
					die('Error reseving!');
				}
			}

		}
		else {
			header('Location: ../promotion.php');
		}

?>
