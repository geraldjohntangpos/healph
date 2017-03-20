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
                                $clientid = $_SESSION['USERID'];
                }

                include 'queries/connection.php';

                //	Check if the get variables are set.

                if(isset($_GET['accountid']) && isset($_GET['ref'])) {
                                $accountid = $_GET['accountid'];
                                $ref = $_GET['ref'];
                                $backlink;

                                //		Check if the variable ref is recognized.

                                if($ref == "promotion") {
                                                $backlink = $ref;
                                }
                                else if($ref == "allhealers") {
                                                $backlink = $ref;
                                }
                                else {

                                                //			if not recognized.

                                                $backlink = "promotion";
                                }

                                //		fetch the healer if it exist.

                                $sql = "SELECT * FROM healer WHERE ACCT_ID = '$accountid'";
                                $retrieve = $conn->query($sql)->fetchAll();
                                if($retrieve) {
                                                foreach($retrieve as $row) {
                                                                //fetch the data of a certain healer.
                                                                $picture = $row['PICTURE'];
                                                                $details = $row['DETAILS'];
                                                                $name = $row['LASTNAME']. ", " .$row['FIRSTNAME'];
                                                                $clinichours = $row['CLINICHOURS'];
                                                                $address = $row['ADDRESS'];
                                                                $dailylimit = $row['DAILYLIMIT'];
                                                                $contact = $row['CONTACT'];
                                                }
                                }
                                else {

                                                //			if healer does not exist.

                                                header('Location: ' .$backlink. '.php');
                                }
                }
                else {

                                //		if get variables are not set.

                                header('Location: promotion.php');
                }
   include 'queries/countclientnotif.php';

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title> Healer </title>
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
        <style type="text/css" rel="Stylesheet">
            table a {
                color: #00f;
            }
        </style>

        <link href="css/font-awesome.min.css" rel="stylesheet"/>

<!-- We need the raterater stylesheet -->
<link href="rater/raterater.css" rel="stylesheet"/>

<style>
/* Override star colors */
.raterater-bg-layer {
    color: rgba( 0, 0, 0, 0.25 );
}
.raterater-hover-layer {
    color: rgba( 255, 255, 0, 0.75 );
}
.raterater-hover-layer.rated {
    color: rgba( 255, 255, 0, 1 );
}
.raterater-rating-layer {
    color: rgba( 255, 155, 0, 0.75 );
}
.raterater-outline-layer {
    color: rgba( 0, 0, 0, 0.25 );
}
</style>

    </head>

    <body onload="repeat()">
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
        <section class="healerPage" style="margin-top: 70px;">
            <div class="container">
                <!-- picture healer -->
                <div class="row">
                    <div class="col-md-6 col-sm-6 healerProf"> <img class="img-responsive wow fadeInUpBig" src="images/healer/<?php echo $picture; ?>" style="width: 300px; height: 300px; border-radius: 50%;" />
                        <p class="wow fadeInUpBig">Healer Name:
                            <?php echo $name; ?>
                        </p>
                        <p class="wow fadeInUpBig">Location:
                            <?php echo $address; ?>
                        </p>
                        <p class="wow fadeInUpBig">Contact Number:
                            <?php echo $contact; ?>
                        </p>
                        <p class="wow fadeInUpBig">Clinic Hours:
                            <?php echo $clinichours; ?>
                        </p>
                        <p class="wow fadeInUpBig">Daily Limit:
                            <?php echo $dailylimit; ?>
                        </p>
                        <p class="wow fadeInUpBig" id="likesection">
                            <p id="label" style="display:none;">healer</p>
                            <p id="labelid" style="display:none;">
                                <?php echo $accountid; ?>
                            </p>

<div class="ratebox" data-id="1" data-rating="0"></div>

<!--
                            <a href="#" id="likelink" style="text-decoration: none;">
                                <p id="liketext" class="like fa"></p>
                            </a>
                            <p id="countlike" style="font-size: 12px; text-decoration: underline;"></p>
                        </p>
-->
                        <?php
$sql = "SELECT * FROM appointment WHERE CLIENT_ID = '$clientid' AND HEALER_ID = '$accountid' AND STATUS = 'ACTIVE'";

        $retrieve = $conn->query($sql)->fetchAll();
         if(count($retrieve)>0) {
        ?><a href="queries/cancelappointment.php?id=<?php echo $accountid; ?>&ref=<?php echo $ref; ?>" style="padding 15px; font-size:24px;"><i class="appointment">Cancel Appointment</i></a>
                            <?php
        }
        else {
        ?> <a href="appointmentform.php?id=<?php echo $accountid; ?>" style="padding 15px; font-size:24px;"><i class="appointment">Add Appointment</i></a>
                                <?php
        }
        ?>
                                    <br>
                                    <div class="back hvr-grow">
                                        <a href="<?php echo $backlink; ?>.php"> <img src="assets/images/back.png"></a>
                                    </div>
                    </div>
                    <div class="col-md-6 col-sm-6 details">
                        <p class="wow fadeInRight">
                            <?php echo $details; ?>
                        </p>
                        <table class="serviceOffered" column=3 style="width: 100%; border:1px solid #0f0;">
                            <tr style="width: 100%; border:1px solid #0f0;">
                                <th colspan=3 style="border:1px solid #0f0; text-align: center;">
                                    <h1>Service Offered</h1> </th>
                            </tr>
                            <tr style="width: 100%; border:1px solid #0f0;">
                                <th style="border:1px solid #0f0; text-align: center; width: 50%;"> Service Name </th>
                                <th style="border:1px solid #0f0; text-align: center; width: 20%;"> Price </th>
                                <th style="border:1px solid #0f0; text-align: center; width: 30%;"> Action </th>
                            </tr>
                            <?php
         include 'queries/healerservice.php';
         ?>
                        </table>
                        <p class="wow fadeInRight"> </p>
                        <table column=4 style="width: 100%; border:1px solid #0f0;">
                            <tr style="width: 100%; border:1px solid #0f0;">
                                <th colspan=4 style="border:1px solid #0f0; text-align: center;">
                                    <h1>Products Offered</h1> </th>
                            </tr>
                            <tr style="width: 100%; border:1px solid #0f0;">
                                <th style="border:1px solid #0f0; text-align: center; width: 40%;"> Product Name </th>
                                <th style="border:1px solid #0f0; text-align: center; width: 10%;"> Quantity </th>
                                <th style="border:1px solid #0f0; text-align: center; width: 20%;"> Price </th>
                                <th style="border:1px solid #0f0; text-align: center; width: 30%;"> Action </th>
                            </tr>
                            <?php
include 'queries/healerproduct.php';
?>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!--comments-->
        <section class="comments">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <h1 class="wow fadeInDown">Comments</h1>
                        <div class="wow fadeInDown">
                            <iframe data-width="100%" src="queries/gethealercomments.php?accountid=<?php echo $accountid; ?>&q=comments"> </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php include "footer.php"; ?>
            <script type="text/javascript" src="jquery/checkLike.js"></script>
            <script type="text/javascript" src="jquery/filtercomment.js"></script><script src="jquery.js"></script>
<script src="rater/jquery.min.js"></script>
<script src="rater/raterater.jquery.js"></script>

<script>

/* This is out callback function for when a rating is submitted
 */
function rateAlert(id, rating)
{
    alert( 'Rating for '+id+' is '+rating+' stars!' );
}

/* Here we initialize raterater on our rating boxes
 */
$(function() {
    $( '.ratebox' ).raterater( {
        submitFunction: 'rateAlert',
        allowChange: true,
        starWidth: 100,
        spaceWidth: 10,
        numStars: 5
    } );
});

</script>
