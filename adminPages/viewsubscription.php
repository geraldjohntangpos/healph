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
                <title> View Subscriptions </title>
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
                                                    <?php echo $_SESSION['NAME']; ?> <span class="badge badge-notify"><?php echo $countnotif; ?></span>
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
                <!--end nav bar-->
                <section class="deleteHealer">
                        <div class="container">
                                <!-- picture book review -->
                                <div class="row">
                                        <div class="col-md-1 col-sm-1"></div>
                                        <div class="col-md-10 col-sm-10">
                                                <div id="viewHealerList">
                                                        <h1>Subscriptions List</h1>
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
