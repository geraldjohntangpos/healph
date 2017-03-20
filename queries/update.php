<?php
	
	include 'connection.php';
	
			$username = $_POST['username'];
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$email = $_POST['emailadd'];
			$contact = $_POST['contact'];
			
			$sql = "SELECT * FROM account WHERE USERNAME = '$username'";
			
			$retrieve = $conn->query($sql)->fetchAll();
			if($retrieve) {
				foreach($retrieve as $row) {
					$accountid = $row['ACCT_ID'];
				}
			}
			
			$sql = "UPDATE healer SET FIRSTNAME='$firstname', LASTNAME='$lastname', EMAIL_ADDRESS='$email', CONTACT='$contact' WHERE ACCT_ID='$accountid'";
			
			$update = $conn->query($sql);
			
			if($update) {
				header('Location: ../adminPages/healerprofile.php?accountid=' .$accountid);
			}
			else {
				die("Error updating healer!");
			}


?>
