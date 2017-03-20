<?php

	include 'connection.php';

	if(isset($_GET['p'])) {
		$p = $_GET['p'];

		if($p == "deleteclient") {
			if(isset($_GET['accountid'])) {
				$accountid = $_GET['accountid'];

				$sql = "UPDATE client SET STATUS = 'INACTIVE' WHERE ACCT_ID = '$accountid'";

				$delete = $conn->query($sql);

				if($delete) {
					header('Location: ../adminpages/viewclient.php?delsuccess');
				}
				else {
					header('Location: ../adminpages/adminlogin.php?delfailed');
				}
			}
			else {
				header('Location: ../adminpages/adminlogin.php');
			}
		}
	}
	else {
		$sql = "SELECT C.LASTNAME, C.FIRSTNAME, C.CLIENT_ID, C.ACCT_ID, C.STATUS, A.ACCT_ID, A.STATUS FROM client as C INNER JOIN account AS A ON C.ACCT_ID = A.ACCT_ID WHERE C.STATUS = 'ACTIVE'";

		$retrieve = $conn->query($sql)->fetchAll();

		if($retrieve) {
			foreach($retrieve as $row) {
				$lastname = $row['LASTNAME'];
				$firstname = $row['FIRSTNAME'];
				$healerid = $row['CLIENT_ID'];
				$accountid = $row['ACCT_ID'];
				?>
					<tr style="width:100%">
						<a name="<?php echo $accountid; ?>"></a>
						<td style="width:70%;text-align:left;"><?php echo $lastname. ", " .$firstname; ?></td>
						<td style="width:10%;text-algin:right;"><?php echo '<a href="clientprofile.php?accountid=' .$accountid. '" style="color:green;">View</a>'; ?></td>
						<td style="width:10%;text-algin:right;"><?php echo '<a href="../queries/manageclient.php?p=deleteclient&accountid=' .$accountid. '" style="color:red;">Delete</a>' ?></td>
					</tr>
				<?php
			}
		}
	}

?>
