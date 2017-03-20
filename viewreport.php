<?php
		session_start();

		if(!isset($_SESSION['USERID']) && !isset($_SESSION['USERNAME']) && !isset($_SESSION['NAME']) && !isset($_SESSION['TYPE'])) {
				session_destroy();
				header('Location: login.php?q=loginfirst');
		}
		else {
				if($_SESSION['TYPE'] == "Healer") {
						header('Location: healerpages/loginhealer.php');
				}
				else if($_SESSION['TYPE'] == "Client") {
						header('Location: ../promotion.php');
				}
		}
?>
		<!DOCTYPE html>
		<html lang="en">

		<head>
				<title> View Report </title>
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
										<a href="../index.php" class="navbar-brand"><img class="img-responsive wow slideInLeft" src="../assets/images/logo.png" /></a>
								</div>
								<!-- navbar -->
								<div class="col-md-9 col-sm-9">
										<nav class="navbar1 navbar-inverse1 wow bounceInUp">
												<!-- Menu Items -->
												<div class="topUser">
														<ul class="nav navbar-nav">
																<li>
																		<a href="#">
																				<?php echo $_SESSION['NAME']; ?>
																		</a>
																</li>
																<li> <a href="../queries/signout.php">SIGN-OUT</a> </li>
														</ul>
												</div>
										</nav>
								</div>
						</div>
				</div>
				<!--end nav bar-->
				<section class="deleteHealer">
						<div class="container">
								<!-- picture book review -->
								<div class="row">
										<div class="col-md-1 col-sm-1"></div>
										<div class="col-md-10 col-sm-10">
												<div id="viewHealerList">
														<h1>Report List</h1>
														<div class="back2 hvr-hang">
																<a href="adminLogin.php"> <img src="../assets/images/back.png"></a>
														</div>
														<!--            list of healers    -->
														<div class="listHealer wow rollIn">
																		<?php
																												include '../queries/managesubscription.php';
																										?>
														</div>
												</div>
										</div>
										<div class="col-md-1 col-sm-1"> </div>
								</div>
						</div>
				</section>
				<?php include "../footer.php"; ?>
			<script type="text/javascript" src="../jquery/extendsubscription.js"></script>
		</body>

		</html>
