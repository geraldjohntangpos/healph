<?php

	include 'connection.php';

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
						<td style="width:10%;text-algin:right;"><?php echo '<a href="healer.php?accountid=' .$accountid. '&ref=allHealers" style="color:green;">View</a>'; ?></td>
					</tr>
				<?php
			}
		}

?>
