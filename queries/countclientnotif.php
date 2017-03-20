<?php
				include 'connection.php';
				$clientid = $_SESSION['USERID'];
				$client_notif_count = "";

				$healersql = "SELECT * FROM notification WHERE NOTIFIER = '$clientid' AND SEEN = 'UNSEEN'";
				$retrievenotif = $conn->query($healersql)->fetchAll();
				if($retrievenotif) {
								$count = 0;
								foreach($retrievenotif as $row) {
												$count++;
								}
								$client_notif_count = $count;
				}

?>
