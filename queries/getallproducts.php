<?php

	include 'connection.php';
		$sql = "SELECT * FROM product WHERE STATUS = 'ACTIVE'";

		$retrieve = $conn->query($sql)->fetchAll();

		if($retrieve) {
			foreach($retrieve as $row) {
				$name = $row['NAME'];
				$productid = $row['PRODUCT_ID'];
				$accountid = $row['ACCT_ID'];
				?>
					<tr style="width:100%">
						<a name="<?php echo $accountid; ?>"></a>
						<td style="width:70%;text-align:left;"><?php echo $name; ?></td>
						<td style="width:10%;text-algin:right;"><?php echo '<a href="product.php?productid=' .$productid. '&ref=allProducts" style="color:green;">View</a>'; ?></td>
					</tr>
				<?php
			}
		}

?>
