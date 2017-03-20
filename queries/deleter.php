<?php

	require 'connection.php';

	if(isset($_GET['q']) && isset($_GET['id'])) {
		$q = $_GET['q'];
		$id = $_GET['id'];
		
		if($q == "service") {
			$link = "viewServices.php";
			$sql = "UPDATE $q SET STATUS = 'INACTIVE' WHERE SERVICE_ID = '$id'";
			$sql2 = "DELETE FROM booking WHERE SERVICE_ID = '$id'";
			$sql3 = "DELETE FROM notification WHERE TYPE = 'booking' AND TYPE_ID = '$id'";
		}
		else {
			$link = "viewProducts.php";
			$sql = "UPDATE $q SET STATUS = 'INACTIVE' WHERE PRODUCT_ID = '$id'";
			$sql2 = "DELETE FROM reservation WHERE PRODUCT_ID = '$id'";
			$sql3 = "DELETE FROM notification WHERE TYPE = 'reservation' AND TYPE_ID = '$id'";
		}
		
		$delete = $conn->query($sql);
		$delete2 = $conn->query($sql2);
		$delete3 = $conn->query($sql3);
		if($delete && $delete2 && delete3) {
			header ('Location: ../healerPages/' .$link. '?deletesuccess');
		}
		else {
			header ('Location: ../healerPages/' .$link. '?deletefailed');	
		}
		
	}
	else {
		header('Location: ../healerPages/loginHealer.php');
	}

?>
