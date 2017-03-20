<?php
				session_start();

				if(!isset($_SESSION['USERID']) && !isset($_SESSION['USERNAME']) && !isset($_SESSION['NAME']) && !isset($_SESSION['TYPE'])) {
								session_destroy();
								header('Location: login.php?q=loginfirst');
				}
				else {
								if($_SESSION['TYPE'] == "Admin") {
												header('Location: adminPages/adminLogin.php');
								}
								else if($_SESSION['TYPE'] == "Healer") {
												header('Location: healerPages/loginHealer.php');
								}
				}

				require 'queries/connection.php';

				if(isset($_GET['accountid'])) {

								$accountid = $_GET['accountid'];

								$sql = "SELECT A.ACCT_ID, A.TYPE, C.ACCT_ID, C.CLIENT_ID, C.LASTNAME, C.FIRSTNAME, C.EMAIL_ADDRESS, C.MOBILE, C.PICTURE FROM account AS A inner join client AS C ON A.ACCT_ID = C.ACCT_ID WHERE C.ACCT_ID = '$accountid'";

								$retrieve = $conn->query($sql)->fetchAll();

								if($retrieve) {
												foreach($retrieve as $row) {
																$name = $row['LASTNAME']. ", " .$row['FIRSTNAME'];
																$emailadd = $row['EMAIL_ADDRESS'];
																$mobile = $row['MOBILE'];
																$type = $row['TYPE'];
																$picture = $row['PICTURE'];
												}
								}
								else {
												header('Location: promotion.php');
								}
								if($type != "Client") {
												header('Location: promotion.php');
								}
				}
				else {
								header('Location: promotion.php');
				}
	include 'queries/countclientnotif.php';
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>
			<?php echo $_SESSION['NAME']; ?>
		</title>
		<meta charset="utf-8" />
		<meta content="width=device-width, initial-scale=1" name="viewport" />
		<link rel="icon" href="assets/images/icon.png" />
		<link href="assets/css/main.css" rel="stylesheet" />
		<script src="bower_components/jquery/dist/jquery.min.js"></script>
		<script src="bower_components/bootstrap-sass/assets/javascripts/bootstrap.min.js"></script>
		<script src="bower_components/wow/dist/wow.min.js"></script>
		<script src="bower_components/jquery/dist/underscore-min.js"></script>
		<script src="bower_components/jquery/dist/jquery.e-calendar.js"></script>
		<script src="jquery/clientcalendar.js"></script>
		<link rel="stylesheet" href="assets/css/jquery.e-calendar.css">
		<script>
			new WOW().init();
		</script>
	</head>

	<body>
		<!--      logo-->
		<nav class="navbar1 navbar-inverse1 navbar-fixed-top  wow bounceInUp">
			<div class="container topnav bgMenu">
				<div class="row">
					<div class="col-md-9 col-sm-9">
						<a href="promotion.php" class="navbar-brand"><img class="img-responsive wow slideInLeft" src="assets/images/logo.png" /></a>
					</div>
					<div class="navbar-header">
						<button class="navbar-toggle" data-target="#mainNavBar" data-toggle="collapse" type="button"> <span class="icon-bar">
														</span> <span class="icon-bar">
														</span> <span class="icon-bar">
														</span> </button>
					</div>
					<!-- Menu Items -->
					<div class="collapse navbar-collapse" id="mainNavBar">
						<div class="col-md-3 col-sm-3">
							<ul class="nav navbar-nav">
								<div class="topUser">
									<li>
										<a href="profile.php?accountid=<?php echo $_SESSION['USERID']; ?>">
											<?php echo $_SESSION['NAME']; ?> <span class="badge badge-notify"><?php echo $client_notif_count; ?></span> </a>
									</li>
									<li> <a href="queries/signout.php">SIGN-OUT</a> </li>
								</div>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</nav>
		<!--end nav bar-->
		<!--about healer        -->
		<section class="clientPage">
			<div class="container">
				<!-- picture healer -->
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="row" style="text-align: left;">
							<br /><br /><br /> <br /><br /><br /><br /><br /> <br /><br /><br /><br /><br /> <br /><br />
							<form action="queries/submitclientpicture.php" method="post" enctype="multipart/form-data">
								Upload picture
								<input class="form-control wow lightSpeedIn" type="file" name="picture" value="" id="picture" required />
								<div class="message" id="pictureMessage"></div>
								<br />
								<input class="btn btn-danger wow bounceInRight hvr-grow" type="submit" id="submit" value="Submit" />
							</form>
							<br /><br /><br /> <br /><br /><br /><br /><br /> <br /><br /><br /><br /><br /> <br /><br />
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="calendarWrap" style="margin-top: 40%;">
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php include "footer.php"; ?>
		<script type="text/javascript" src="jquery/clientpicture.js"></script>
	</body>

	</html>
