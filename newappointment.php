<?php
		session_start();
		include 'queries/connection.php';

		if(isset($_SESSION['USERID']) && isset($_SESSION['USERNAME']) && isset($_SESSION['NAME']) && isset($_SESSION['TYPE'])) {
				if($_SESSION['TYPE'] == "Admin") {
						header('Location: adminPages/adminLogin.php');
				}
				else if($_SESSION['TYPE'] == "Healer") {
						header('Location: healerpages/loginhealer.php');
				}
		}

?>
		<!DOCTYPE html>
		<html lang="en">

		<head>
				<title> Registration </title>
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
																<h1 class="wow fadeInDown">New Appointment Form</h1>
																<!--            registration form    -->
																<div class="back hvr-grow">
																		<a href="healer.php"> <img src="assets/images/back.png"></a>
																</div>
																<form class="center-block" action="queries/registration.php" method="post">
																		<div class="row">
																			<div class="col-md-6 col-sm-6">

																				<!--    Healer's name-->
																				<input class="form-control wow lightSpeedIn" name="healername" id="username" placeholder="Healer's name" type="text" required readonly>
																				<div class="message" id="usernameMessage"></div>
																			</div>
																				<!--Vacant Field                                -->
																			<div class="col-md-6 col-sm-6">
																			</div>
																		</div>

<!--																		check lng-->
																	<div class="row">
																		<div class="col-md-6 col-sm-6">
																				<!--date                                -->
																				<input class="form-control wow lightSpeedIn" name="date" id="date" placeholder="First Name" type="date" required>
																				<div class="message" id="dateMessage"></div>
																		</div>
																		<div class="col-md-6 col-sm-6">
																					<!--lastname    -->
																				<div class="form-group">
																					<select name="time" required>
																						<option value="">Select Appointment Time</option>
																						<?php
																							$sql = "SELECT * FROM clinic_schedule";
																							$retrieve = $conn->query($sql)->fetchAll();
																							if($retrieve) {
																								foreach($retrieve as $row) {
																									$schedid = $row['SCHED_ID'];
																									$time = $row['TIME'];
																									?>
																										<option value="<?php echo $schedid; ?>"><?php echo $time; ?></option>
																									<?php
																								}
																							}
																						?>
																					</select>
																						<div class="message" id="lastnameMessage"></div>
																				</div>
																		</div>

<!--																		laen-->
																		<div class="row">
																			<div class="col-md-6 col-sm-6">
																				<!--email add-->
																				<input class="form-control wow lightSpeedIn" name="emailadd" id="emailadd" placeholder="Email address" type="email" required>
																				<div class="message" id="emailaddMessage"></div>
																			</div>

																			<!--mobile number-->
																			<div class="col-md-6 col-sm-6">
																					<input class="form-control wow lightSpeedIn" name="mobile" id="mobile" placeholder="Mobile number" type="number" min="9111111111" required>
																						<div class="message" id="mobileMessage"></div>
																						<select class="form-control wow lightSpeedIn" name="type" id="type" required>
																								<option value="Client">Client</option>
																						</select>
																			</div>
																		<div class="message" id="typeMessage"></div>
																		<input class="btn btn-danger wow fadeInLeft" id="register" type="submit" value="Submit">
																		</div>
																			</div>
																		</div>


																</form>
														</div>
												</div>
										</div>
										<div class="col-md-2 col-sm-2"></div>
								</div>
						</div>
				</section>
		</body>

		</html>
