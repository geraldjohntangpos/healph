<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            Contact Us
        </title>
        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <link rel="icon" href="assets/images/icon.png"/>
        <link href="assets/css/main.css" rel="stylesheet"/>
        <script src="bower_components/jquery/dist/jquery.min.js"></script>
        <script src="bower_components/bootstrap-sass/assets/javascripts/bootstrap.min.js"></script>
        <script src="bower_components/wow/dist/wow.min.js"></script>
        <script>new WOW().init();</script>

    </head>
    <body>
      <!--      logo-->
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3">
                     <a href="index.php" class="navbar-brand"><img class="img-responsive" src="assets/images/logo.png"/></a>
                </div>

                 <!-- navbar -->
        <div class="col-md-9 col-sm-9">
        <nav class="navbar navbar-inverse  wow bounceInUp">
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
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="index.php">
                                    HOME
                                </a>
                            </li>
                            <li>
                                <a href="aboutus.php">
                                    ABOUT
                                </a>
                            </li>
                            <li>
                                <a href="contact.php">
                                    CONTACT US
                                </a>
                            </li>
                        </ul>
                </div>
            </nav>
        </div>
            </div>

      </div>
<!--end nav bar-->


<section class="contactUs">
            <div class="container">
                <!-- picture book review -->
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <!-- about author title -->
                        <h1 class="wow fadeInLeft">
                            GET IN TOUCH
                        </h1>
                        <!-- content about author -->
                        <p class="wow fadeInRight">
                            Hi! I hope all is good. If you have any questions, feel free to contact us.
                        </p>
                    </div>
                </div>
                <!-- end of first row -->
                <!-- start of 2nd row row -->
                <div class="row">
                    <div class="col-md-2 col-xs-2">
                    </div>
                    <!-- start of form -->
                    <div class="col-md-8 col-xs-8">
                        <form class="center-block">
                            <div class="form-group">
                                <input class="form-control wow lightSpeedIn" id="usr" name="requestname" placeholder="*Name" type="text">
                            </div>
 														<div class="message" id="requestnameMessage"></div>
                            <div class="form-group">
                                <input class="form-control wow lightSpeedIn" id="email" name="requestemail" placeholder="*Email" type="text">
                            </div>
 														<div class="message" id="requestemailMessage"></div>
                            <div class="form-group">
                                <textarea class="form-control wow lightSpeedIn" id="comment" name="request" placeholder="*Message" rows="5"></textarea>
                            </div>
 														<div class="message" id="requestMessage"></div>
                            <input class="btn btn-danger rotateIn" type="submit" value="Submit" id="submitRequest">
                        </form>
                    </div>
                    <div>
                        <div class="col-md-2 col-xs-2">
                        </div>
                    </div>
                </div>
                <!-- end 2nd row -->
            </div>
            <!-- end container -->
</section>

    </body>
<script type="text/javascript" src="jquery/trapinput.js"></script>
</html>
