<?php
	session_start();
	include 'queries/connection.php';

	if(isset($_SESSION['USERID']) && isset($_SESSION['USERNAME']) && isset($_SESSION['NAME']) && isset($_SESSION['TYPE'])) {
		if($_SESSION['TYPE'] == "Client") {
			header('Location: promotion.php');
		}
		else if($_SESSION['TYPE'] == "Healer") {
			$accountid = $_SESSION['USERID'];
			$sql = "SELECT * FROM healer WHERE ACCT_ID = '$accountid'";
			$retrieve = $conn->query($sql)->fetchAll();
			if($retrieve) {
				foreach($retrieve as $row) {
					$status = $row['STATUS'];
					$_SESSION['STATUS'] = $status;
				}
			}
			if($_SESSION['STATUS'] == 'UNCONFIRMED') {
				header('Location: healerpages/editprofile.php?accountid=' .$accountid);
			}
			else {
				header('Location: healerpages/loginhealer.php');
			}
		}
		else {
			header('Location: adminPages/adminLogin.php');
		}
	}

	$errmessage;

	if(isset($_GET['q'])) {
		$q = $_GET['q'];
		if($q == "invalidlogin")
			$errmessage = "Invalid log in. Please try again!";
		else if($q == "loginfirst")
			$errmessage = "Please log in first";
	}
	else {
		$errmessage = "";
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
		<title> Log-in </title>
		<meta charset="utf-8" />
		<meta content="width=device-width, initial-scale=1" name="viewport" />
		<link rel="icon" href="assets/images/icon.png" />
		<link href="assets/css/main.css" rel="stylesheet" />
		<script src="bower_components/jquery/dist/jquery.min.js"></script>
		<script src="bower_components/bootstrap-sass/assets/javascripts/bootstrap.min.js"></script>
		<script src="bower_components/wow/dist/wow.min.js"></script>
		<script>
				new WOW().init();
		</script>
</head>
<div class="logo wow slideInLeft">
		<a href="index.php" class="navbar-brand"><img class="img-responsive" src="assets/images/logo.png" /></a>
</div>

<body>
		<section class="login">
				<div class="container">
						<!--            log-In Form-->
						<div class="row">

								<div class="col-md-8 col-sm-8">
										<div id="loginForm">
												<h1 class="wow fadeInDown">Log-in</h1>
												<form class="center-block" action="queries/confirmlogin.php" method="POST">
														<div class="form-group">
																<input class="form-control wow lightSpeedIn" name="usernamelogin" id="usr" placeholder="Username" type="text" required> </div>
														<div class="message" id="usernameloginMessage"></div>
														<div class="form-group">
																<input class="form-control wow lightSpeedIn" name="passwordlogin" id="password" placeholder="Password" type="Password" required > </div>
														<div class="message" id="passwordloginMessage"></div>
														<input class="btn btn-danger wow bounceInLeft" id="login" type="submit" value="Log in">
														<div class="message" id="invalidloginMessage"><?php echo $errmessage; ?></div>
												</form>
												<p class="wow fadeInRight">Don't have account yet?</p>
												<p class="wow fadeInLeft"><a href="register.php"> Sign-up Now! </a></p>
										</div>
								</div>

						</div>
				</div>
		</section>
</body>
<script type="text/javascript" src="jquery/trapinput.js"></script>
</html>
