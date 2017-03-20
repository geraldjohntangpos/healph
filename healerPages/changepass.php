<?php
		session_start();
		include '../queries/connection.php';

		if(isset($_SESSION['USERID']) && isset($_SESSION['USERNAME']) && isset($_SESSION['NAME']) && isset($_SESSION['TYPE'])) {
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

		$accountid = $_SESSION['USERID'];

?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title> Edit Profile </title>
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

	<body>
		<section class="register">
			<div class="container">
				<!-- picture book review -->
				<div class="row">
					<div class="col-md-2 col-sm-2"></div>
					<div class="col-md-8 col-sm-8">
						<div id="registerForm">
							<div class="wrapForm">
								<h1 class="wow fadeInDown">Change Password</h1>
								<!--            registration form    -->
								<form class="center-block" action="../queries/changepassquery.php" method="post">
									<div style="display: none;" id="cid"><?php echo $accountid; ?></div>
									<!--    old pass-->
									<input class="form-control wow lightSpeedIn" name="oldpass" id="oldpass" placeholder="Old Password" type="password" required>
									<div class="message" id="oldpassMessage"></div>
									<!--new pass                                -->
									<input class="form-control wow lightSpeedIn" name="newpass" id="newpass" placeholder="New Password" type="password" required>
									<div class="message" id="newpassMessage"></div>
									<input class="btn btn-danger wow fadeInLeft" id="submit" type="submit" value="Update Password"> </form>
							</div>
						</div>
					</div>
					<div class="col-md-2 col-sm-2"></div>
				</div>
			</div>
		</section>
	</body>
	<script type="text/javascript" src="../jquery/editprofile.js"></script>
	<script type="text/javascript" src="../jquery/passtrapshealer.js"></script>

	</html>