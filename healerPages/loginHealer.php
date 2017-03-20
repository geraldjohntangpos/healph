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
            if($_SESSION['STATUS'] == 'UNCONFIRMED') {
                $accountid = $_SESSION['USERID'];
                header('Location: editprofile.php?accountid=' .$accountid);
            }
            elseif($_SESSION['STATUS'] == 'EXPIRED') {
                header('Location: expired.php');
            }
        }
    }

        include '../queries/connection.php';
        $healerid = $_SESSION['USERID'];
        $service_notif_count = "";
        $product_notif_count = "";
        $healer_notif_count = "";

        $servicesql = "SELECT * FROM booking WHERE HEALER_ID = '$healerid' AND STATUS = 'ACTIVE'";

        $retrieveservice = $conn->query($servicesql)->fetchAll();

        if($retrieveservice) {
                $count = 0;
                foreach($retrieveservice as $row) {
                        $count++;
                }
                $service_notif_count = $count;
        }

        $productsql = "SELECT * FROM reservation WHERE HEALER_ID = '$healerid' AND STATUS = 'ACTIVE'";

        $retrieveproduct = $conn->query($productsql)->fetchAll();

        if($retrieveproduct) {
                $count = 0;
                foreach($retrieveproduct as $row) {
                        $count++;
                }
                $product_notif_count = $count;
        }

        $healersql = "SELECT * FROM appointment WHERE HEALER_ID = '$healerid' AND STATUS = 'ACTIVE'";
        $retrievenotif = $conn->query($healersql)->fetchAll();
        if($retrievenotif) {
                $count = 0;
                foreach($retrievenotif as $row) {
                        $count++;
                }
                $healer_notif_count = $count;
        }

?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
                <title> Home </title>
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

<!--      logo-->
        <nav class="navbar1 navbar-inverse1 navbar-fixed-top  wow bounceInUp">
               <div class="container topnav bgMenu">
                   <div class="row">


                    <div class="col-md-9 col-sm-9">
                                <a href="loginHealer.php" class="navbar-brand"><img class="img-responsive wow slideInLeft" src="../assets/images/logo.png" /></a>
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
                                                    <?php echo $_SESSION['NAME']; ?> <span class="badge badge-notify"><?php echo $healer_notif_count; ?></span> </a>
                                                </li>
                                                <li>
                                                    <a href="../queries/signout.php">SIGN-OUT</a>
                                                </li>
                                    </div>
                                </ul>
                        </div>
                        </div>
                   </div>
                </div>
        </nav>

                <!--end nav bar-->
                <section class="healer">
                        <div class="container">
                                <!-- picture book review -->
                                <div class="wrapActions">
                                        <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                        <div class="wow bounceInDown">
                                                                <h1>What do you want to do?</h1> </div>
                                                </div>
                                        </div>
                                        <div class="row">
                                                <div class="col-md-6 col-sm-6">
                                                        <button class="btn btn-danger1 center-block wow bounceInRight" type="button">
                                                                <a href="viewProducts.php">
                                                                        <p>View Products <span class="badge badge-notify3"><?php echo $product_notif_count; ?></span></p>
                                                                </a>
                                                        </button>
                                                        <button class="btn btn-danger1 center-block wow bounceInRight" type="button">
                                                                <a href="postProducts.php">
                                                                        <p>Post Products</p>
                                                                </a>
                                                        </button>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                        <button class="btn btn-danger2 center-block wow bounceInRight" type="button">
                                                                <a href="viewServices.php">
                                                                        <p>View Services <span class="badge badge-notify3"><?php echo $service_notif_count; ?></span> </p>
                                                                </a>
                                                        </button>
                                                        <button class="btn btn-danger2 btnPS center-block wow bounceInRight" type="button">
                                                                <a href="postServices.php">
                                                                        <p>Post Services</p>
                                                                </a>
                                                        </button>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </section>

                <?php include "../footer.php"; ?>
        </body>

        </html>
