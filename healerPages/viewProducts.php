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
        $healer_notif_count = "";

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
                <title> Your Products </title>
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

                <!--products offered        -->
                <section class="view">
                        <div class="container">
                                <!--        title healer-->
                                <div class="wrapView">
                                <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                                <h1 class="wow slideInDown">Your Products</h1> </div>
                                </div>
                                <div class="row">
                                        <div class="col-md-4">
                                                <div class="backView hvr-float">
                                                        <a href="loginHealer.php"> <img src="../assets/images/back.png"></a>
                                                </div>
                                        </div>
                                        <div class="col-md-8 col-md-8"></div>
                                </div>
                                <?php
                                                include '../queries/getproduct.php';
                                        ?>
                        </div>
                        </div>
                </section>
                <!--        end first product-->
                <?php include "../footer.php"; ?>
        </body>

        </html>
