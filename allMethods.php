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
								else if($_SESSION['TYPE'] == "Admin") {
												header('Location: adminpages/adminlogin.php');
								}
				}
	include 'queries/countclientnotif.php';
?>
				<!DOCTYPE html>
				<html lang="en">

				<head>
								<title> Trending Methods </title>
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
								<!--      logo-->
								<nav class="navbar1 navbar-inverse1 navbar-fixed-top  wow bounceInUp">
														 <div class="container topnav bgMenu">
																		 <div class="row">


																				<div class="col-md-9 col-sm-9">
																																<a href="promotion.php" class="navbar-brand"><img class="img-responsive wow slideInLeft" src="assets/images/logo.png" /></a>
																				</div>

																				<div class="navbar-header">
																								<button class="navbar-toggle" data-target="#mainNavBar" data-toggle="collapse" type="button">
																												<span class="icon-bar">
																												</span>
																												<span class="icon-bar">
																												</span>
																												<span class="icon-bar">
																												</span>
																								</button>
																				</div>


																				<!-- Menu Items -->
																				<div class="collapse navbar-collapse" id="mainNavBar">
																								<div class="col-md-3 col-sm-3">
																												<ul class="nav navbar-nav">
																																		 <div class="topUser">
																	<li>
																		<a href="profile.php?accountid=<?php echo $_SESSION['USERID']; ?>">
																			<?php echo $_SESSION['NAME']; ?> <span class="badge badge-notify"><?php echo $client_notif_count; ?></span>
																		</a>
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
								<section class="deleteHealer" style="margin-top: 50px;">
												<div class="container">
																<!-- picture book review -->
																<div class="row">
																				<div class="col-md-1 col-sm-1"></div>
																				<div class="col-md-10 col-sm-10">
																								<div id="tableList">
																												<h1>Traditional Method's List</h1>
																												<div class="back2 hvr-hang">
																																<a href="promotion.php"> <img src="assets/images/back.png"></a>
																												</div>
																												<!--            list of healers    -->
																												<div class="listHealer wow rollIn">
																																<table style="width:100%; font-size: 18px;" cellspacing="0px" border="1px solid">
																																				<tr style="width:100%;">
																																								<th style="width:25%; text-align: center;">Name</th>
																																								<th style="width:20%; text-align: center;">Type</th>
																																								<th style="width:10%; text-align: center;">Price</th>
																																								<th style="width:10%; text-align: center;">Rating</th>
																																								<th style="width:20%; text-align: center;">Owner</th>
																																								<th style="width:25%; text-align: center;">Action</th>
																																				</tr>
																																				<?php
																																								include 'queries/getallmethods.php';
																																				?>
																																</table>
																												</div>
																								</div>
																				</div>
																				<div class="col-md-1 col-sm-1"> </div>
																</div>
												</div>
								</section>

								<?php
								include 'footer.php';
?>

								<!--script-->
								<script>
												function myFunction() {
																document.getElementById("myDropdown").classList.toggle("show");
												}
												//    closing the menu
												window.onclick = function (event) {
																if (!event.target.matches('.dropbtn')) {
																				var dropdowns = document.getElementsByClassName("dropdown-content");
																				var i;
																				for (i = 0; i < dropdowns.length; i++) {
																								var openDropdown = dropdowns[i];
																								if (openDropdown.classList.contains('show')) {
																												openDropdown.classList.remove('show');
																								}
																				}
																}
												}
								</script>
								<!--end script-->
				</body>

				</html>
