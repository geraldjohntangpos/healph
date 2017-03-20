<?php
	session_start();

	if(!isset($_SESSION['USERID']) && !isset($_SESSION['USERNAME']) && !isset($_SESSION['NAME']) && !isset($_SESSION['TYPE'])) {
		session_destroy();
		header('Location: ../login.php?q=loginfirst');
	}
	else {
		if($_SESSION['TYPE'] == "Admin") {
			header('Location: ../adminpages/adminLogin.php');
		}
		else if($_SESSION['TYPE'] == "Client") {
			header('Location: ../promotion.php');
		}
		else {
            if($_SESSION['TYPE'] == "Admin") {
                  header('Location: ../adminpages/adminLogin.php');
            }
            else if($_SESSION['TYPE'] == "Client") {
                  header('Location: ../promotion.php');
            }
            else {
                  if($_SESSION['STATUS'] == 'UNCONFIRMED') {
                        $accountid = $_SESSION['USERID'];
                        header('Location: editprofile.php?accountid=' .$accountid);
                  }
                  elseif($_SESSION['STATUS'] == 'EXPIRED') {
                        header('Location: expired.php');
                  }
            }
		}
	}

	require '../queries/connection.php';
	$accountid = $_SESSION['USERID'];

	if(isset($_GET['serviceid'])) {
		$serviceid = $_GET['serviceid'];
		$sql = "SELECT * FROM service WHERE SERVICE_ID = '$serviceid'";

		$retrieve = $conn->query($sql)->fetchAll();

		if($retrieve) {
			foreach($retrieve as $row) {
				$serviceid = $row['SERVICE_ID'];
				$servicename = $row['NAME'];
				$description = $row['DESCRIPTION'];
				$price = $row['PRICE'];
				$type = $row['SRVCTYPE_ID'];
				$picture = $row['PICTURE'];
			}
		}
	}
	else {
		header('Location: viewServices.php');
	}

?>

<!DOCTYPE html>
<html lang="en">

<head>
		<title> Edit Service </title>
		<meta charset="utf-8" />
		<meta content="width=device-width, initial-scale=1" name="viewport" />
		<link rel="icon" href="../assets/images/icon.png" />
		<link href="../assets/css/main.css" rel="stylesheet" />
		<script src="../bower_components/jquery/dist/jquery.min.js"></script>
		<script src="../bower_components/bootstrap-sass/assets/javascripts/bootstrap.min.js"></script>
		<script src="../bower_components/wow/dist/wow.min.js"></script>
		<script>
				new WOW().init();
		</script>
</head>

<body class="addHealer">
		<!--      logo-->
		<div class="container">
				<div class="row">
						<div class="col-md-3 col-sm-3">
								<a href="loginHealer.php" class="navbar-brand"><img class="img-responsive wow slideInLeft" src="../assets/images/logo.png" /></a>
						</div>
						<!-- navbar -->
						<div class="col-md-9 col-sm-9">
								<nav class="navbar navbar-inverse  wow bounceInUp">
										<!-- Menu Items -->
										<div class="topUser">
												<ul class="nav navbar-nav">
														<li>
															<a href="profile.php?accountid=<?php echo $_SESSION['USERID']; ?>"><?php echo $_SESSION['NAME']; ?></a>
														</li>
														<li>
															<a href="../queries/signout.php">SIGN-OUT</a>
														</li>
												</ul>
										</div>
								</nav>
						</div>
				</div>
		</div>
		<!--end nav bar-->
		<section class="login">
				<div class="container">
						<!-- picture book review -->
						<div class="row">
								<div class="col-md-2 col-sm-2"></div>
								<div class="col-md-8 col-sm-8">
										<div id="loginForm">
												<h1 class="wow slideInDown">Edit a Service</h1>
												<!--            registration form    -->
												<form class="center-block" action="../queries/updateservice.php" method="post" enctype="multipart/form-data" >
														<!--    Service id-->
														<div class="form-group">
																<input class="form-control wow lightSpeedIn" id="serviceid" name="serviceid" value="<?php echo $serviceid; ?>" placeholder="Service ID" type="text" required readonly > </div>
														<div class="message" id="sidMessage"></div>
														<!--    name-->
														<div class="form-group">
																<input class="form-control wow lightSpeedIn" id="servicename" name="servicename" value="<?php echo $servicename; ?>" placeholder="Name of Service" type="text" required > </div>
														<div class="message" id="nosMessage"></div>
														<!--                    caption of product-->
														<div class="form-group">
																<textarea class="form-control wow lightSpeedIn" id="description" name="description" placeholder="*Add Description" rows="5" spellcheck="true" required ><?php echo $description; ?></textarea>
														</div>
														<div class="message" id="descriptionMessage"></div>
														<!--price-->
														<div class="form-group">
																<input class="form-control wow lightSpeedIn" value="<?php echo $price; ?>" id="price" name="price" placeholder="Price" type="number" required > </div>
														<div class="message" id="priceMessage"></div>
														<!--Service Type-->
														<div class="form-group">
																<select class="form-control wow lightSpeedIn" id="type" name="type" required >
																	<option value="">Select Service Type</option>
																	<?php
																		$sql = "SELECT * FROM service_type";
																		$retrieve = $conn->query($sql)->fetchAll();
																		if($retrieve) {
																			foreach($retrieve as $row) {
																				$id = $row['SRVCTYPE_ID'];
																				$servicetype = $row['SRVCTYPE'];
																				$selected = "";

																				if($type == $id) {
																					$selected = "selected";
																				}
																				echo "<option value='" .$id. "'" .$selected. ">" .$servicetype. "</option>";
																			}
																		}
																	?>
																</select>
														</div>
														<div class="message" id="typeMessage"></div>
														<!--upload picture-->
														<div class="form-group">
															<img src="../images/service/<?php echo $accountid. "/" .$picture; ?>" style="width: 90px; height: 90px;" />
															Edit picture? <input type="radio" name="confirmedit" onclick="checkSelected(this.value)" id="yes" value="Yes"><label for="yes">Yes</label>
															<input type="radio" name="confirmedit" onclick="checkSelected(this.value)" id="no" value="No" checked ><label for="no">No</label>
															<input class="form-control wow lightSpeedIn" type="file" name="picture" value="<?php echo $picture; ?>" id="picture" disabled required />
														</div>
														<div class="message" id="pictureMessage"></div>
												<!--button submit-->
												<input class="btn btn-danger wow bounceInRight hvr-grow" type="submit" id="submit" value="Submit" />
												</form>
												<div class="back2 hvr-float">
														<a href="viewServices.php"> <img src="../assets/images/back.png"></a>
												</div>
										</div>
								</div>
								<div class="col-md-2 col-sm-2"> </div>
						</div>
				</div>
		</section>
</body>
<script type="text/javascript" src="../jquery/posttraps.js"></script>
</html>
