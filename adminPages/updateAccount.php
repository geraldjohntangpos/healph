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

        if(isset($_GET['accountid'])) {

            $accountid = $_GET['accountid'];

            $sql = "SELECT A.ACCT_ID, A.USERNAME, H.HEALER_ID, H.ACCT_ID, H.FIRSTNAME, H.LASTNAME, H.ADDRESS, H.CONTACT, H.EMAIL_ADDRESS FROM account AS A inner join healer AS H ON A.ACCT_ID = H.ACCT_ID WHERE A.ACCT_ID = '$accountid' AND H.ACCT_ID = '$accountid'";

            $retrieve = $conn->query($sql)->fetchAll();

            if($retrieve) {
                foreach($retrieve as $row) {
                    $lastname = $row['LASTNAME'];
                    $firstname = $row['FIRSTNAME'];
                    $healerid = $row['HEALER_ID'];
                    $accountid = $row['ACCT_ID'];
                    $username = $row['USERNAME'];
                    $address = $row['ADDRESS'];
                    $email = $row['EMAIL_ADDRESS'];
                    $contact = $row['CONTACT'];
                }
            }

        }
        else {
            header('Location: viewhealer.php');
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
                <title>
                        Update Account
                </title>
                <meta charset="utf-8"/>
                <meta content="width=device-width, initial-scale=1" name="viewport"/>
                <link rel="icon" href="../assets/images/icon.png"/>
                <link href="../assets/css/main.css" rel="stylesheet"/>
                <script src="../bower_components/jquery/dist/jquery.min.js"></script>
                <script src="../bower_components/bootstrap-sass/assets/javascripts/bootstrap.min.js"></script>
                <script src="../bower_components/wow/dist/wow.min.js"></script>
                <script>new WOW().init();</script>

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

<section class="login">
                <div class="container">
                        <!-- picture book review -->
                        <div class="row">
                                <div class="col-md-2 col-sm-2"></div>
                                <div class="col-md-8 col-sm-8">
                                        <div id="updateHealer2">
                                                <h1 class="wow slideInDown">Update Form</h1>

                                                <!--            registration form    -->
                                                <form class="center-block" action="../queries/update.php" method="post">
                                                        <!--    username-->
                                                        <div class="form-group">
                                                                <input class="form-control wow lightSpeedIn" name="username" id="username" placeholder="Username" type="text" value="<?php echo $username; ?>" required autofocus readonly > </div>
                                                        <div class="message" id="usernameMessage"></div>
                                                        <!--firstname                                -->
                                                        <div class="form-group">
                                                                <input class="form-control wow lightSpeedIn" name="firstname" id="firstname" placeholder="First Name" type="text" value="<?php echo $firstname; ?>" required > </div>
                                                        <div class="message" id="firstnameMessage"></div>
                                                        <!--lastname    -->
                                                        <div class="form-group">
                                                                <input class="form-control wow lightSpeedIn" name="lastname" id="lastname" placeholder="Last Name" type="text" value="<?php echo $lastname; ?>" required > </div>
                                                        <div class="message" id="lastnameMessage"></div>
                                                        <!--email add-->
                                                        <div class="form-group">
                                                                <input class="form-control wow lightSpeedIn" name="emailadd" id="emailadd" placeholder="Email address" type="email" value="<?php echo $email; ?>" required > </div>
                                                        <div class="message" id="emailaddMessage"></div>
                                                        <!--mobile number-->
                                                        <div class="form-group">
                                                                <input class="form-control wow lightSpeedIn" name="contact" id="mobile" placeholder="Mobile number" type="number" min="9111111111" value="<?php echo $contact; ?>" required > </div>
                                                         <div class="message" id="mobileMessage"></div>
                                                        <div class="form-group">
                                                            <select class="form-control wow lightSpeedIn" name="type" id="type" required >
                                                                <option value="Healer">Healer</option>
                                                            </select>
                                                        </div>
                                                         <div class="message" id="typeMessage"></div>
                                                            <input class="btn btn-danger wow fadeInLeft" id="register" type="submit" value="Update" >
                                                        </form>

                                                        <div class="back2 hvr-float">
                                                                <a href="viewhealer.php">
                                                                <img src="../assets/images/back.png"></a>
                                                        </div>



                                        </div>
                                    </div>
                                <div class="col-md-2 col-sm-2"> </div>


                        </div>
                </div>
        </section>

            <?php include "../footer.php";?>



        </body>
</html>
