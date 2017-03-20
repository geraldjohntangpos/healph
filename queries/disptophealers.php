<?php
		include 'connection.php';
		$sql = "SELECT H.LASTNAME, H.FIRSTNAME, H.HEALER_ID, H.ACCT_ID, H.STATUS, A.ACCT_ID, A.STATUS FROM healer as H INNER JOIN account AS A ON H.ACCT_ID = A.ACCT_ID WHERE H.STATUS = 'ACTIVE' ORDER BY RATE DESC LIMIT 5";

		$retrieve = $conn->query($sql)->fetchAll();
		$slots = 5;

		if($retrieve) {
				foreach($retrieve as $row) {
						$name = $row['LASTNAME']. ", " .$row['FIRSTNAME'];
						$accountid = $row['ACCT_ID'];
						echo "<li><a href='healer.php?accountid=" .$accountid. "&ref=promotion'>" .$name. "</a></li>";
						$slots--;
				}
				if($slots!=0) {
						while($slots!=0) {
								echo "<li style='color: red'></li>";
								$slots--;
						}
				}
		}
		else {
?>
				<li>No available healers yet.</li>
<?php
		}
?>
