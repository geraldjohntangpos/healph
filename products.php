<!DOCTYPE html>
<html lang="en">

<head>
    <title> Products </title>
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
                <a href="promotion.php" class="navbar-brand"><img class="img-responsive wow slideInleft" src="assets/images/logo.png" /></a>
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
    <!--about healer        -->
    <section class="healerPage">
        <div class="container">
            <!-- picture healer -->
            <div class="row">
                <div class="col-md-8 col-sm-8 col-md-push-4 col-sm-push-4">
                    <p class="wow slideInRight">Singot Sa kadlawn is very effective...</p>
                </div>
                <div class="col-md-4 col-sm-4 col-md-pull-8 col-sm-pull-8"> <img class="img-responsive wow slideInDown" src="assets/images/product.JPG" />
                    <p class="wow rotateInDownRight">Product Name: Singot Sa Kadlawn</p>
                    <p class="wow rotateInDownRight">Price: P300</p>
                    <p class="wow rotateInDownRight">Products Available: 100 pcs.</p>
                    <p class="wow rotateInDownRight">Available at Mang Kanor</p>
                    <button class="btn btn-danger center-block wow bounceInRight " type="button"> <a href="login.php">
                            Book Now
                        </a> </button>
                    <div class="back hvr-grow">
                        <a href="trendingHealers.php"> <img src="assets/images/back.png"></a>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--comments-->
    <section class="comments">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h1>Comments</h1>
                    <ul>
                        <li>Maka ayu jd grabe - KAGA</li>
                    </ul>
                </div>
            </div>
            <!--    //place holder-->
            <div class="row">
                <div class="col-md-3 col-sm-3"> </div>
                <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                        <textarea class="form-control wow lightSpeedIn" id="comment" placeholder="*Message" rows="5"></textarea>
                    </div>
                    <button class="btn btn-danger center-block wow bounceInRight " type="button"> <a href="login.php">
                            Submit
                        </a> </button>
                </div>
                <div class="col-md-3 col-sm-3"> </div>
            </div>
        </div>
    </section>
</body>

</html>
