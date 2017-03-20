<?php
	require_once 'connection.php';

	header('Content-Type: text/xml');
	echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';
	
	$feed;
	
	if(isset($_GET['username'])) {
		$username = $_GET['username'];
		
		$sql = "SELECT * FROM account WHERE USERNAME = '$username'";
		$retrieve = $conn->query($sql)->fetchAll();
		
		if(count($retrieve) > 0) {
			$feed = "Username already taken!";
		}
		else {
			$feed = "Username available!";
		}
		
		echo '<response>' .$feed. '</response>';
	}
	else {
		die("Error!");
	}

?>
