<?php
        session_start();

        if(!isset($_SESSION['USERID']) && !isset($_SESSION['USERNAME']) && !isset($_SESSION['NAME']) && !isset($_SESSION['TYPE'])) {
                session_destroy();
                header('Location: ../login.php?q=loginfirst');
        }
        else {
                if($_SESSION['TYPE'] == "Healer") {
                        header('Location: ../healerpages/loginhealer.php');
                }
                else if($_SESSION['TYPE'] == "Client") {
                        header('Location: ../promotion.php');
                }
        }
    include '../queries/connection.php';
    $countnotif = 0;
    $sql = "SELECT * FROM inquiries WHERE STATUS = 'ACTIVE'";
    $retrieve = $conn->query($sql)->fetchAll();
    if($retrieve) {
        foreach($retrieve as $row) {
            $countnotif++;
        }
    }
    if($countnotif==0) {
        $countnotif = "";
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
                <nav class="navbar1 navbar-inverse1 navbar-fixed-top  wow bounceInUp">
               <div class="container topnav bgMenu">
                   <div class="row">


                    <div class="col-md-9 col-sm-9">
                                <a href="adminLogin.php" class="navbar-brand"><img class="img-responsive wow slideInLeft" src="../assets/images/logo.png" /></a>
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
                                                    <a href="#">
                                                    <?php echo $_SESSION['NAME']; ?> <span class="badge badge-notify4"><?php echo $countnotif; ?></span>
                                                </a>
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
                <section class="admin">
                        <div class="container">
                                <!-- picture book review -->
                                <div class="adminWrapper">
                                <div class="row">
                                        <div class="col-md-1 col-sm-1"></div>
                                        <div class="col-md-10 col-sm-10">
                                                <div class="wow bounceInDown">
                                                        <h1>What do you want to do?</h1>
                                                </div>
                                        </div>
                                        <div class="col-md-1 col-sm-1"></div>
                                </div>

                                <div class="row">
                                        <div class="col-md-12 col-sm-12">

                                                        <button class="btn btn-danger center-block wow bounceInRight hvr-wooble-skew" type="button">
                                                                <a href="addHealer.php">
                                                                <p>Add Healer</p>
                                                                </a>
                                                        </button>

                                                        <button class="btn btn-danger center-block wow bounceInRight" type="button">
                                                                <a href="viewhealer.php">
                                                                <p>Manage Healer</p>
                                                                </a>
                                                        </button>

                                                        <button class="btn btn-danger center-block wow bounceInRight" type="button">
                                                                <a href="viewclient.php">
                                                                <p>Manage Client</p>
                                                                </a>
                                                        </button>

                                                        <button class="btn btn-danger center-block wow bounceInRight" type="button">
                                                                <a href="viewinquiries.php">
                                                                <p>Manage Inquiries <span class="badge badge-notify1"><?php echo $countnotif; ?></span></p>
                                                                </a>
                                                        </button>

                                                        <button class="btn btn-danger center-block wow bounceInRight" type="button">
                                                                <a href="viewsubscription.php">
                                                                <p>Manage Subscription</p>
                                                                </a>
                                                        </button>

                                                        <button class="btn btn-danger center-block wow bounceInRight" type="button">
                                                                <a href="viewreport.php">
                                                                <p>View Reports</p>
                                                                </a>
                                                        </button>

                                        </div>
                                </div>
                                </div>
                        </div>
                </section>
                <?php
                        include "../footer.php";
                ?>
        </body>

        </html>
