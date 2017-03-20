<?php
    session_start();

    if(isset($_SESSION['USERID'])) {
        header('Location: promotion.php');
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title> Index </title>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <link href="assets/css/main.css" rel="stylesheet">
        <script src="bower_components/jquery/dist/jquery.min.js"></script>
        <script src="bower_components/bootstrap-sass/assets/javascripts/bootstrap.min.js"></script>
        <script src="bower_components/wow/dist/wow.min.js"></script>
        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script>
            new WOW().init();
        </script>
    </head>

    <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
        <!--      navbar-->
        <nav class="navbar navbar-inverse navbar-fixed-top topnav wow bounceInUp">
        <div class="container">

                <!-- navbar -->
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
                                <li> <a href="#home" accesskey="1" title="AccessKey[1]: Jump to home">
                                                                        HOME
                                                                </a> </li>
                                <li> <a href="#aboutUs" accesskey="2" title="AccessKey[2]: Jump to aboutUs">
                                                                        ABOUT
                                                                </a> </li>
                                <li> <a href="#contact" accesskey="3" title="AccessKey[3]: Jump to contact">
                                                                        CONTACT US
                                                                </a> </li>
                            </ul>
                        </div>
            </div>
        </nav>
        <!--end nav bar-->
        <section class="findHealer pt-section" id="home">
            <div class="container">
                <!-- picture book review -->
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="wow bounceInLeft">
                            <h1>Find Healer Now</h1>
                            <p>Your online buddy in finding traditional healers</p>
                        </div>
                        <a href="login.php">
                            <button class="btn btn-danger center-block wow bounceInRight" type="button"> LOG-IN / REGISTER </button>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!--		about book-->
        <section class="about pt-section" id="aboutUs">
            <div class="container">
                <!-- picture book review -->
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <h1>healPH</h1>
                        <p>Way back then the Philippines is well known for it's unorthodox way of healing. We have this unique way of dealing with sickness famously called traditional healing. But in today's time this kind of way was forgotten due to lack of information about the location of traditional healers. That is why we formulated an idea called healPH which helps people locate where are the traditional healers, at the same time it would help traditional healers advertise their products and services online.</p>
                    </div>
                </div>
            </div>
        </section>
        <!--		contact us-->
        <section class="contactUs pt-section" id="contact">
            <div class="container">
                <!-- picture book review -->
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <!-- about author title -->
                        <h1 class="wow fadeInLeft">
                                                        GET IN TOUCH
                                                </h1>
                        <!-- content about author -->
                        <p class="wow fadeInRight"> Hi! I hope all is good. If you have any questions, feel free to contact us. </p>
                        <ul class="social-media">
                            <li>
                                <a href="#" class="fa-stack fa-lg"> <i class="fa fa-circle fa-stack-2x" style="color: transparent; border: 2px solid white; border-radius: 20px; width: 38px; height: 39px;"></i> <i class="fa fa-facebook fa-stack-1x fa-inverse"></i> </a>
                            </li>
                            <li>
                                <a href="#" class="fa-stack fa-lg"> <i class="fa fa-circle fa-stack-2x" style="color: transparent; border: 2px solid white; border-radius: 20px; width: 38px; height: 39px;"></i> <i class="fa fa-twitter fa-stack-1x fa-inverse"></i> </a>
                            </li>
                            <li>
                                <a href="#" class="fa-stack fa-lg"> <i class="fa fa-circle fa-stack-2x" style="color: transparent; border: 2px solid white; border-radius: 20px; width: 38px; height: 39px;"></i> <i class="fa fa-google-plus fa-stack-1x fa-inverse"></i> </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- end of first row -->
                <!-- start of 2nd row row -->
                <div class="row">
                    <div class="col-md-2 col-xs-2"> </div>
                    <!-- start of form -->
                    <div class="col-md-8 col-xs-8">
                        <form class="center-block">
                            <div class="form-group">
                                <input class="form-control wow lightSpeedIn" id="usr" name="requestname" placeholder="*Name" type="text"> </div>
                            <div class="message" id="requestnameMessage"></div>
                            <div class="form-group">
                                <input class="form-control wow lightSpeedIn" id="email" name="requestemail" placeholder="*Email" type="text"> </div>
                            <div class="message" id="requestemailMessage"></div>
                            <div class="form-group">
                                <textarea class="form-control wow lightSpeedIn" id="comment" name="request" placeholder="*Message" rows="5"></textarea>
                            </div>
                            <div class="message" id="requestMessage"></div>
                            <input class="btn btn-danger rotateIn" type="submit" value="Submit" id="submitRequest"> </form>
                    </div>
                    <div>
                        <div class="col-md-2 col-xs-2"> </div>
                    </div>
                </div>
                <!-- end 2nd row -->
            </div>
            <!-- end container -->
        </section>
        <?php
        include 'footer.php';
?>
            <!--		scripts-->
            <script>
                $(document).ready(function () {
                    // Add smooth scrolling to all links in navbar + footer link
                    $(".navbar a, footer a, .tracker a").on('click', function (event) {
                        // Make sure this.hash has a value before overriding default behavior
                        if (this.hash !== "") {
                            // Prevent default anchor click behavior
                            event.preventDefault();
                            // Store hash
                            var hash = this.hash;
                            // Using jQuery's animate() method to add smooth page scroll
                            // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
                            $('html, body').animate({
                                scrollTop: $(hash).offset().top
                            }, 700, function () {
                                // Add hash (#) to URL when done scrolling (default click behavior)
                                window.location.hash = hash;
                            });
                        } // End if
                    });
                });
            </script>
            <!--    progressbar-->
            <script>
                $(function () {
                    $('body').progressTracker({
                        linking: true
                        , tooltip: "constant"
                        , negativeTolerance: 0
                        , positiveTolerance: 0
                        , displayWhenActive: true
                        , disableBelow: 600
                    });
                });
            </script>
            <!--functions    -->
    </body>

    </html>
