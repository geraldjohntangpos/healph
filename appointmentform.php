<?php
    session_start();

    if(!isset($_SESSION['USERID']) && !isset($_SESSION['USERNAME']) && !isset($_SESSION['NAME']) && !isset($_SESSION['TYPE'])) {
        session_destroy();
        header('Location: login.php?q=loginfirst');
    }
    else {
        if($_SESSION['TYPE'] == "Admin") {
            header('Location: adminpages/adminLogin.php');
        }
        else if($_SESSION['TYPE'] == "Healer") {
            header('Location: healerPages/loginHealer.php');
        }
    }
    require 'queries/connection.php';
    $accountid = $_SESSION['USERID'];

    if(isset($_GET['id'])) {
        $accountid = $_GET['id'];
        $sql = "SELECT * FROM healer WHERE ACCT_ID = '$accountid'";

        $retrieve = $conn->query($sql)->fetchAll();

        if($retrieve) {
            foreach($retrieve as $row) {
                $name = $row['LASTNAME']. ", " .$row['FIRSTNAME'];
                $clinicdays = $row['CLINICDAYS'];
                $clinichours = $row['CLINICHOURS'];
                $clinicsched = $clinicdays. " (" .$clinichours. ")";
                $dailylimit = $row['DAILYLIMIT'];
                $picture = $row['PICTURE'];
            }
        }
    }
    else {
        header('Location: viewProducts.php');
    }

include 'queries/countclientnotif.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
        <title> New Appointment Form </title>
        <link rel="stylesheet" type="text/css" href="otherstyles/calendarstyles.css">
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

<body class="addHealer" onload="initialize();">
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
        <section class="login" style="margin-top: 50px;">
                <div class="container">
                        <!-- picture book review -->
                        <div class="row">
                                <div class="col-md-2 col-sm-2"></div>
                                <div class="col-md-8 col-sm-8">
                                        <div id="loginForm">
                                                <h1 class="wow slideInDown">New Appointment Form</h1>
                                                <!--            registration form    -->
                                                <form class="center-block" action="queries/addappointment.php" method="post">
                                                        <!--    Service id-->
                                                        <div class="form-group">
                                                                Healer's ID
                                                                <input class="form-control wow lightSpeedIn" id="ownerid" name="ownerid" value="<?php echo $accountid; ?>" placeholder="Account ID" type="text" required readonly > </div>
                                                        <div class="message" id="hidMessage"></div>
                                                        <!--    name-->
                                                        <div class="form-group">
                                                                Healer's Name
                                                                <input class="form-control wow lightSpeedIn" id="healername" name="healername" value="<?php echo $name; ?>" placeholder="Name of Service" type="text" required readonly > </div>
                                                        <div class="message" id="healernameMessage"></div>
                                                        <!--    Daily limit-->
                                                        <div class="form-group">
                                                                Healer's Daily transaction limit
                                                                <input class="form-control wow lightSpeedIn" id="dlimit" name="dlimit" value="<?php echo $dailylimit; ?>" placeholder="Healers daily transaction limit" type="text" required readonly > </div>
                                                        <div class="message" id="healernameMessage"></div>
                                                        <!--Clini Schedule-->
                                                        <div class="form-group">
                                                                Clinic Schedule
                                                                <input class="form-control wow lightSpeedIn" value="<?php echo $clinicsched; ?>" id="clinichours" name="clinichours" placeholder="Clinic hours" type="text" required readonly > </div>
                                                        <div class="message" id="clinichoursMessage"></div>

                                                    
	<!-- Start of the Calendar UI here. -->
	<span id="hiddenMonth" class="hidden"></span>
	<span id="hiddenYear" class="hidden"></span>
	<table id="main" columns="7" cellspacing="0">
		<thead>
			<tr>
				<td id="dispMonth" colspan="7">
					<table width="100%" id="sub">
						<tr>
							<td id="prevMonth">Previous</td>
							<td id="currMonth">
							</td>
							<td id="nextMonth">Next</td>
						</tr>
					</table>
				</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="days">Sun</td>
				<td class="days">Mon</td>
				<td class="days">Tue</td>
				<td class="days">Wed</td>
				<td class="days">Thu</td>
				<td class="days">Fri</td>
				<td class="days">Sat</td>
			</tr>
			<?php
				for ($i=0; $i < 42; $i++) { 
			?>
			<tr>
				<td class="dates datevalid" id="<?php echo $i; ?>">
					<p class="datenumber" id="p<?php echo $i++; ?>"></p>
				</td>
				<td class="dates datevalid" id="<?php echo $i; ?>">
					<p class="datenumber" id="p<?php echo $i++; ?>"></p>
				</td>
				<td class="dates datevalid" id="<?php echo $i; ?>">
					<p class="datenumber" id="p<?php echo $i++; ?>"></p>
				</td>
				<td class="dates datevalid" id="<?php echo $i; ?>">
					<p class="datenumber" id="p<?php echo $i++; ?>"></p>
				</td>
				<td class="dates datevalid" id="<?php echo $i; ?>">
					<p class="datenumber" id="p<?php echo $i++; ?>"></p>
				</td>
				<td class="dates datevalid" id="<?php echo $i; ?>">
					<p class="datenumber" id="p<?php echo $i++; ?>"></p>
				</td>
				<td class="dates datevalid" id="<?php echo $i; ?>">
					<p class="datenumber" id="p<?php echo $i; ?>"></p>
				</td>
			</tr>
			<?php
				}
			?>
		</tbody>
	</table>
	<!-- End of the Calendar UI here. -->
                                                    
                                                    
                                                    <!--Appointed Date-->
                                                        <div class="form-group">
                                                                Appointed Date
                                                                <input class="form-control wow lightSpeedIn" value="" id="date" name="date" placeholder="Appointed Date" type="text" readonly required > </div>
                                                        <div class="message" id="adMessage"></div>
                                                        <div class="available" id="listMessage"></div>
                                                        <!--Appointed Time-->
                                                        <div class="form-group">
                                                                Appointed Time
                                                                <input class="form-control wow lightSpeedIn" value="" id="appointedtime" name="appointedtime" placeholder="Appointed Time" type="text" readonly required > </div>
                                                        <div class="message" id="adMessage"></div>
                                                <!--button submit-->
                                                <input class="btn btn-danger wow bounceInRight hvr-grow" type="submit" id="submit" value="Submit" />
                                                </form>
                                                <div class="back2 hvr-float">
                                                        <a href="healer.php?accountid=<?php echo $accountid; ?>&ref=promotion"> <img src="assets/images/back.png"></a>
                                                </div>
                                        </div>
                                </div>
                                <div class="col-md-2 col-sm-2"> </div>
                        </div>
                </div>
        </section>
	<script type="text/javascript" src="jquery/eventCalendar.js"></script>

    <?php include 'footer.php';?>
<script src="jquery/appointmentformtraps.js" type="text/javascript"></script>
</body>
</html>
