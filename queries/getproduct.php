<?php
	require_once 'connection.php';

	$accountid = $_SESSION['USERID'];

	$sql = "SELECT T.PRODTYPE_ID, T.PRODTYPE, P.PRODUCT_ID, P.PRODTYPE_ID, P.NAME, P.ACCT_ID, P.DESCRIPTION, P.RATE, P.STATUS, P.PICTURE FROM product_type AS T INNER JOIN product AS P ON T.PRODTYPE_ID = P.PRODTYPE_ID WHERE P.ACCT_ID = '$accountid' AND P.STATUS = 'ACTIVE' ORDER BY P.PRODUCT_ID DESC";

	$retrieve = $conn->query($sql)->fetchAll();

	if(count($retrieve)>0) {
		foreach($retrieve as $row) {
			$prodtype = $row['PRODTYPE'];
			$description = $row['DESCRIPTION'];
			$picture = $row['PICTURE'];
			$productid = $row['PRODUCT_ID'];
			$name = $row['NAME'];

			$notif_count = "";
			$productsql = "SELECT * FROM reservation WHERE HEALER_ID = '$accountid' AND PRODUCT_ID = '$productid' AND STATUS = 'ACTIVE'";

			$productnotif = $conn->query($productsql)->fetchAll();
			if($productnotif) {
				$count = 0;
				foreach($productnotif as $row) {
					$count++;
				}
				$notif_count = $count;
			}
?>
<!--        subcontent healer-->
			<div class="service-product">
					<div class="container">
							<div class="row">
									<div class="col-md-4 col-sm-4"> <img style="width: 150px; height: 150px;" class="img-responsive wow wobble" src="../images/product/<?php echo $accountid. "/" .$picture; ?>" /><span class="badge badge-notify"><?php echo $notif_count; ?></div>
									<div class="col-md-4 col-sm-4">
											<h2 class="wow fadeIn">Product Name:<br /><span style="text-decoration: underline;"><?php echo $name; ?> </h2>
											<h4 class="wow fadeIn" style="color: #fff;">Product Type: <?php echo $prodtype; ?></h4>
											<p class="wow fadeIn"><?php echo $description; ?></p>
									</div>
									<div class="col-md-4 col-sm-4">
											<a href="../healerPages/editproduct.php?productid=<?php echo $productid; ?>"><button class="btn btn-danger wow bounceInRight hvr-float" type="button">  Edit
																	 </button></a>
											<a href="viewer.php?viewtype=product&viewid=<?php echo $productid; ?>"><button class="btn btn-danger wow bounceInRight hvr-float" type="button">  View
																	</button></a>
											<a style="color: blue;" data-toggle="modal" data-target="#myModal<?php echo $productid; ?>"><button class="btn btn-danger wow bounceInRight hvr-float" type="button">  Delete
																	</button></a>
										                                            <!-- Modal -->
                                            <div id="myModal<?php echo $productid; ?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">Delete Product</h4> </div>
                                                        <div class="modal-body">
																			  <h3>Are you sure you want to delete <?php echo $name; ?>? All of it's transactions will be deleted too.</h3>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																				<a href="../queries/deleter.php?q=product&id=<?php echo $productid; ?>"><button  type="button" class="btn btn-default" id="accept">Yes</button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
									</div>
							</div>
					</div>
			</div>
			<br />
<?php
		}
	}
	else {
?>
			<div class="service-product">
					<div class="container">
							<div class="row">
									<div class="col-md-4 col-sm-4"> <img style="width: 150px; height: 150px;" class="img-responsive wow wobble" src="../images/product/nothing.png" /> </div>
									<div class="col-md-4 col-sm-4">
											<h2 class="wow fadeIn">No product found!</h2>
									</div>
							</div>
					</div>
			</div>
			<br />
<?php
	}

?>

