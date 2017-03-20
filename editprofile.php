<?php
		session_start();
		include 'queries/connection.php';

		if(isset($_SESSION['USERID']) && isset($_SESSION['USERNAME']) && isset($_SESSION['NAME']) && isset($_SESSION['TYPE'])) {
				if($_SESSION['TYPE'] == "Healer") {
						header('Location: healerpages/loginhealer.php');
				}
				else if($_SESSION['TYPE'] == "Admin"){
						header('Location: adminPages/adminLogin.php');
				}
		}

		$accountid = $_SESSION['USERID'];
		$username = "";
		$firstname = "";
		$lastname = "";
		$emailadd = "";
		$mobile = "";

		if(isset($_GET['accountid'])) {
			$sql = "SELECT A.ACCT_ID, A.USERNAME, C.ACCT_ID, C.FIRSTNAME, C.LASTNAME, C.EMAIL_ADDRESS, C.MOBILE FROM account AS A INNER JOIN client AS C ON A.ACCT_ID = C.ACCT_ID WHERE A.ACCT_ID = '$accountid'";
			$retrieve = $conn->query($sql)->fetchAll();
			if($retrieve) {
				foreach($retrieve as $row) {
					$username = $row['USERNAME'];
					$firstname = $row['FIRSTNAME'];
					$lastname = $row['LASTNAME'];
					$emailadd = $row['EMAIL_ADDRESS'];
					$mobile = $row['MOBILE'];
				}
			}
			else {
				header('Location: promotion.php');
			}
		}
		else {
			header('Location: promotion.php');
		}

?>
		<!DOCTYPE html>
		<html lang="en">

		<head>
				<title> Edit Profile </title>
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

		<body>
				<section class="register">
						<div class="container">
								<!-- picture book review -->
								<div class="row">
										<div class="col-md-2 col-sm-2"></div>
										<div class="col-md-8 col-sm-8">
												<div id="registerForm">
														<div class="wrapForm">
																<h1 class="wow fadeInDown">Edit Profile Form</h1>
																<!--            registration form    -->
																<form class="center-block" action="queries/updateprofile.php" method="post">
																		<!--    username-->
																		<input class="form-control wow lightSpeedIn" name="username" id="username" placeholder="Username" type="text" value="<?php echo $username; ?>" required readonly>
																		<div class="message" id="usernameMessage"></div>
																		<!--firstname                                -->
																		<input class="form-control wow lightSpeedIn" name="firstname" id="firstname" placeholder="First Name" type="text" value="<?php echo $firstname; ?>" required>
																		<div class="message" id="firstnameMessage"></div>
																		<!--lastname    -->
																		<div class="form-group">
																				<input class="form-control wow lightSpeedIn" name="lastname" id="lastname" placeholder="Last Name" type="text" value="<?php echo $lastname; ?>" required>
																				<div class="message" id="lastnameMessage"></div>
																				<!--email add-->
																				<input class="form-control wow lightSpeedIn" name="emailadd" id="emailadd" placeholder="Email address" type="email" value="<?php echo $emailadd; ?>" required>
																				<div class="message" id="emailaddMessage"></div>
																				<!--mobile number-->
																				<input class="form-control wow lightSpeedIn" name="mobile" id="mobile" placeholder="Mobile number" type="number" min="9111111111" value="<?php echo $mobile; ?>" required>
																				<div class="message" id="mobileMessage"></div>
																		</div>
																		<div class="message" id="typeMessage"></div>
																		<input class="btn btn-danger wow fadeInLeft" id="register" type="submit" value="Update"> </form>
														</div>
												</div>
										</div>
										<div class="col-md-2 col-sm-2"></div>
								</div>
						</div>
				</section>
		</body>
		<script type="text/javascript" src="jquery/editprofile.js"></script>

		</html>
