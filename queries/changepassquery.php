<?php
	session_start();
	include 'connection.php';
	$accountid = $_SESSION['USERID'];
	$success = array("res"=>false);

	$newpass = $_REQUEST['newpass'];
	$sql = "UPDATE account SET PASSWORD = '$newpass' WHERE ACCT_ID = '$accountid'";
	$update = $conn->query($sql);
	if($update) {
/*
?>
	<script>
		alert("Password was successfully changed.");
		console.log("Password was successfully changed.");
	</script>
<?php
*/
		header('Location: ../profile.php?accountid=' .$accountid. '&PASSWORDCHANGED=true');
	}
	else {
		header('Location: ../profile.php?accountid=' .$accountid. '&PASSWORDCHANGED=false');
	}

?>
