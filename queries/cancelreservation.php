<?php

	session_start();
	include 'connection.php';

	if(isset($_GET['id']) && isset($_GET['ref'])) {

		$productid = $_GET['id'];
		$ref = $_GET['ref'];
		$clientid = $_SESSION['USERID'];

		$sql = "SELECT * FROM product WHERE PRODUCT_ID = '$productid' AND STATUS = 'ACTIVE'";

		$retrieve = $conn->query($sql)->fetchAll();

		if($retrieve) {
			foreach($retrieve as $row) {
				$healerid = $row['ACCT_ID'];
			}

			$sql = "SELECT * FROM reservation WHERE CLIENT_ID = '$clientid' AND HEALER_ID = '$healerid' AND PRODUCT_ID = '$productid' AND STATUS = 'ACTIVE'";

			$check = $conn->query($sql)->fetchAll();

			if($check) {
				foreach($check as $row) {
					$reserveid = $row['RESERVE_ID'];
					$quantity = $row['PROD_QTY'];
				}
				$sql = "DELETE FROM reservation WHERE CLIENT_ID = '$clientid' AND HEALER_ID = '$healerid' AND PRODUCT_ID = '$productid' AND STATUS = 'ACTIVE'";

				$delete = $conn->query($sql);

				if($delete) {
					$sql = "DELETE FROM notification WHERE NOTIF_OWNER = '$healerid' AND TYPE = 'reservation' AND TYPE_ID = '$reserveid' AND STATUS = 'ACTIVE'";

					$deletenotif = $conn->query($sql);
					if($deletenotif) {
						$sqlupdateprod = "UPDATE product SET QUANTITY = QUANTITY+'$quantity' WHERE PRODUCT_ID = '$productid'";
						$updateprod = $conn->query($sqlupdateprod);
						if($updateprod) {
							header('Location: ../product.php?productid=' .$productid. '&ref=' .$ref);
						}
					}

				}
				else {
					die('Error booking!');
				}
			}
			else {
				header('Location: ../product.php?productid=' .$productid. '&ref=' .$ref. '&reservationnotfound');
			}

		}
		else {
			header('Location: ../promotion.php');
		}

	}
	else {
		header('Location: ../promotion.php');
	}

?>
