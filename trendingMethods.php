<!DOCTYPE html>
<html lang="en">

<head>
    <title> Trending Methods </title>
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
    <!--      logo-->
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3">
                <a href="promotion.php" class="navbar-brand"><img class="img-responsive wow slideInLeft" src="assets/images/logo.png" /></a>
            </div>
            <!-- navbar -->
            <div class="col-md-9 col-sm-9">
                <nav class="navbar navbar-inverse  wow bounceInUp">
                    <!-- Menu Items -->
                    <div class="topUser">
                        <ul class="nav navbar-nav">
                            <li class="signout"> <a href="index.php">
                                    SIGN-OUT
                                </a> </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!--end nav bar-->
    <!--search box-->
    <section class="searchBox">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-5"> </div>
                <div class="col-md-5 col-sm-5"> </div>
                <div class="col-md-2 col-sm-2">
                    <div class="form-group">
                        <input class="form-control wow lightSpeedIn" id="email" placeholder="Search" type="text"> </div>
                </div>
            </div>
        </div>
    </section>
    <!--end search box        -->
    <section class="findHealer">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h1 class="wow tada">Trending Methods</h1> </div>
            </div>
        </div>
    </section>
    <section class="trending2">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <!--trending healers-->
                    <div class="trendingMethod">
                        <ul class="wow slideInRight">
                            <li><a href="method.php">Hilot</a></li>
                            <li><a href="#">Hilot</a></li>
                            <li><a href="#">Hilot</a></li>
                        </ul>
                    </div>
                    <div class="back hvr-pulse-grow">
                        <a href="promotion.php"> <img src="assets/images/back.png"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
