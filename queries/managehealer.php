<?php

	include 'connection.php';

	if(isset($_GET['p'])) {
		$p = $_GET['p'];

		if($p == "deletehealer") {
			if(isset($_GET['accountid'])) {
				$accountid = $_GET['accountid'];

				$sql = "UPDATE healer SET STATUS = 'INACTIVE' WHERE ACCT_ID = '$accountid'";

				$delete = $conn->query($sql);

				if($delete) {
					header('Location: ../adminpages/viewhealer.php?delsuccess');
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
		$sql = "SELECT H.LASTNAME, H.FIRSTNAME, H.HEALER_ID, H.ACCT_ID, H.STATUS, A.ACCT_ID, A.STATUS FROM healer as H INNER JOIN account AS A ON H.ACCT_ID = A.ACCT_ID WHERE H.STATUS = 'ACTIVE'";

		$retrieve = $conn->query($sql)->fetchAll();

		if($retrieve) {
			foreach($retrieve as $row) {
				$lastname = $row['LASTNAME'];
				$firstname = $row['FIRSTNAME'];
				$healerid = $row['HEALER_ID'];
				$accountid = $row['ACCT_ID'];
				?>
					<tr style="width:100%">
						<a name="<?php echo $accountid; ?>"></a>
						<td style="width:70%;text-align:left;"><?php echo $lastname. ", " .$firstname; ?></td>
						<td style="width:10%;text-algin:right;"><?php echo '<a href="healerprofile.php?accountid=' .$accountid. '" style="color:green;">View</a>'; ?></td>
						<td style="width:10%;text-algin:right;"><?php echo '<a href="../queries/managehealer.php?p=deletehealer&accountid=' .$accountid. '" style="color:green;">Delete</a>' ?></td>
						<td style="width:10%;text-algin:right;"><?php echo '<a href="updateAccount.php?accountid=' .$accountid. '" style="color:green;">Edit</a>'; ?></td>
					</tr>
				<?php
			}
		}
	}

?>
