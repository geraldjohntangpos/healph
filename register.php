<?php
        session_start();

        if(isset($_SESSION['USERID']) && isset($_SESSION['USERNAME']) && isset($_SESSION['NAME']) && isset($_SESSION['TYPE'])) {
                if($_SESSION['TYPE'] == "Client") {
                        header('Location: promotion.php');
                }
                else if($_SESSION['TYPE'] == "Healer") {
                        header('Location: healerpages/loginhealer.php');
                }
                else {
                        header('Location: adminPages/adminLogin.php');
                }
        }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title> Registration </title>
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
        <section class="register">
            <div class="container">
                <!-- picture book review -->
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="wrapImg">
                            <h3>You are one step to a better way of finding traditional healer</h3>
                            <img src="assets/images/heroshot1.png" class="img-responsive img1 pull-left"/>
                            <img src="assets/images/heroshot2.png" class="img-responsive img2 pull-right"/>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div id="registerForm">
                            <div class="wrapForm">
                                <h1 class="wow fadeInDown">Register Here</h1>
                                <!--            registration form    -->
                                <form class="center-block" action="queries/registration.php" method="post">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <!--    username-->
                                            <input class="form-control wow lightSpeedIn " name="username" id="username" placeholder="Username" type="text" required autocomplete="off" autofocus>
                                            <div class="message" id="usernameMessage"></div>
                                        </div>
                                        <!--password                                -->
                                        <div class="col-md-12 col-sm-12">
                                            <input class="form-control wow lightSpeedIn" name="password" id="password" placeholder="Password" type="Password" required>
                                            <div class="message" id="passwordMessage"></div>
                                        </div>
                                    </div>
                                    <!--check lng-->
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <!--firstname                                -->
                                            <input class="form-control wow lightSpeedIn" name="firstname" id="firstname" placeholder="First Name" type="text" required>
                                            <div class="message" id="firstnameMessage"></div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <!--lastname    -->
                                            <div class="form-group">
                                                <input class="form-control wow lightSpeedIn" name="lastname" id="lastname" placeholder="Last Name" type="text" required>
                                                <div class="message" id="lastnameMessage"></div>
                                            </div>
                                        </div>
                                    </div>
                            <!--laen-->
                                    <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <!--email add-->
                                                <input class="form-control wow lightSpeedIn" name="emailadd" id="emailadd" placeholder="Email address" type="email" required>
                                                <div class="message" id="emailaddMessage"></div>
                                            </div>
                                            <!--mobile number-->
                                            <div class="col-md-6 col-sm-6">
                                                <input class="form-control wow lightSpeedIn" name="mobile" id="mobile" placeholder="Mobile number" type="number" min="9111111111" required>
                                                <div class="message" id="mobileMessage"></div>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <select class="form-control wow lightSpeedIn" name="type" id="type" required>
                                                    <option value="Client">Client</option>
                                                </select>
                                            </div>
                                            <div class="message" id="typeMessage"></div>
                                            <div class="col-md-12 col-sm-12">
                                                <input type="checkbox" name="accepteula" id="accepteula">
                                                <!-- Trigger the modal with a button -->
                                                <label for="accepteula" class="eula">I agree with the <a style="color: blue;" data-toggle="modal" data-target="#myModal">End User Licence Agreement</a></label>
                                                <input class="btn btn-danger wow fadeInLeft" id="register" type="submit" value="Submit">
                                            </div>

                                    </div>
                                    <div class="row">
                                            <!-- Modal -->
                                            <div id="myModal" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">healPH's End User Licence Agreement</h4> </div>
                                                        <div class="modal-body">
                                                            <h6>Terms and Conditions ("Terms")</h6>
                                                            <p>Last updated: (8/30/2016)</p>
                                                            <p>Please read these Terms and Conditions ("Terms", "Terms and Conditions") carefully before using the website. Your access to and use of the Service is conditioned on your acceptance of and compliance with these Terms. These Terms apply to all visitors, users and others who access or use the Service.</p>
                                                            <p>By accessing or using the Service you agree to be bound by these Terms. If you disagree with any part of the terms then you may not access the Service.</p>
                                                            <h6>Purchases</h6>
                                                            <p>If you wish to purchase any product or service made available through the Service ("Purchase"), you may be asked to supply certain information relevant to your purchase. The company will not be liable for any loss of money when you are transacting with a traditional healer and it will not be held liable for any damage of your body if you’ve taken some traditional services/products available from this website. The company ensures that all the traditional services/products posted on this website are all high quality but none the less the company would like to say. TAKE IT AT YOUR OWN RISK.</p>
                                                            <h6>Subscriptions</h6>
                                                            <p>Some parts of the Service are billed on a subscription basis ("Subscription(s)"). You will be billed in advance on a monthly basis that would cost P 150 per month. This would serve as the subscription fee for your unlimited use of the services offered use by this website.</p>
                                                            <h6>Changes</h6>
                                                            <p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material we will try to provide at least 30 (change this) days' notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.</p>
                                                            <h6>Contact Us</h6>
                                                            <p>If you have any questions about these Terms, please contact us though our <a href="mailto:healph.cc@gmail.com" style="color: blue;">email</a> address </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-info" data-dismiss="modal" id="accept">Accept</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </form>
                            <p style="font-size: 15px;"> Already have an account? <span style="font-weight:bold;"><a href="login.php">Log-in Here</a></span></p>
                        </div>
                    </div>
                </div>

            </div>
            </div>
        </section>
    </body>
    <script type="text/javascript" src="jquery/trapinput.js"></script>

    </html>
