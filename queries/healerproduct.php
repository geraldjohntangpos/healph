<?php
	include 'connection.php';
	$clientid = $_SESSION['USERID'];

	if(isset($_GET['accountid'])) {
		$id = $_GET['accountid'];
		$sql = "SELECT * FROM product WHERE ACCT_ID = '$id' AND STATUS = 'ACTIVE'";
		$retrieve = $conn->query($sql)->fetchAll();
		if($retrieve) {
			foreach($retrieve as $row) {
				$productname = $row['NAME'];
				$productid = $row['PRODUCT_ID'];
				$productprice = $row['PRICE'];
				$quantity = $row['QUANTITY'];
?>
				<tr style="width: 100%; border:1px solid #0f0;">
					<td style="border:1px solid #0f0; width: 40%; padding-left: 15px;">
						<a href="product.php?productid=<?php echo $productid; ?>&ref=promotion"><?php echo $productname; ?></a>
					</td>
					<td style="border:1px solid #0f0; text-align: center; width: 10%;">
						<?php
							echo $quantity;
							if($quantity != 0) {
								if($quantity == 1) {
									echo "pc";
								}
								else {
									echo "pcs";
								}
							};
						?>
					</td>
					<td style="border:1px solid #0f0; text-align: center; width: 20%;">
						P <?php echo $productprice; ?>
					</td>
					<td style="border:1px solid #0f0; text-align: center; width: 30%;">
<?php
				if($quantity != 0) {
					$sql2 = "SELECT * FROM reservation WHERE HEALER_ID = '$accountid' AND CLIENT_ID = '$clientid' AND PRODUCT_ID = '$productid' AND STATUS = 'ACTIVE'";
					$retrieve2 = $conn->query($sql2)->fetchAll();
					if($retrieve2) {
?>
						<a href="queries/cancelreservation.php?id=<?php echo $productid; ?>&ref=promotion">Cancel Reserve</a>
<?php
					}
					else {
?>
						<a href="reservationform.php?id=<?php echo $productid; ?>">Reserve Now</a>
<?php
				 }
				}
				else {
					echo "Out of Stock";
				}
?>
					</td>
				</tr>
<?php
			}
		}
	}
?>
