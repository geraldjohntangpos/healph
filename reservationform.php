<?php
    session_start();

    if(!isset($_SESSION['USERID']) && !isset($_SESSION['USERNAME']) && !isset($_SESSION['NAME']) && !isset($_SESSION['TYPE'])) {
        session_destroy();
        header('Location: login.php?q=loginfirst');
    }
    else {
        if($_SESSION['TYPE'] == "Admin") {
            header('Location: adminpages/adminLogin.php');
        }
        else if($_SESSION['TYPE'] == "Healer") {
            header('Location: healerPages/loginHealer.php');
        }
    }
    require 'queries/connection.php';
    $accountid = $_SESSION['USERID'];

    if(isset($_GET['id'])) {
        $productid = $_GET['id'];
        $sql = "SELECT * FROM product WHERE PRODUCT_ID = '$productid'";

        $retrieve = $conn->query($sql)->fetchAll();

        if($retrieve) {
            foreach($retrieve as $row) {
                $productid = $row['PRODUCT_ID'];
                $productname = $row['NAME'];
                $description = $row['DESCRIPTION'];
                $quantity = $row['QUANTITY'];
                $price = $row['PRICE'];
                $type = $row['PRODTYPE_ID'];
                $picture = $row['PICTURE'];
            }
        }
    }
    else {
        header('Location: viewProducts.php');
    }

    include 'queries/countclientnotif.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
        <title> Product Reservation Form </title>
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

<body class="addHealer">
        <!--      logo-->
        <nav class="navbar1 navbar-inverse1 navbar-fixed-top  wow bounceInUp">
                             <div class="container topnav bgMenu">
                                     <div class="row">


                                        <div class="col-md-9 col-sm-9">
                                                                <a href="promotion.php" class="navbar-brand"><img class="img-responsive wow slideInLeft" src="assets/images/logo.png" /></a>
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
																			<?php echo $_SESSION['NAME']; ?> <span class="badge badge-notify"><?php echo $client_notif_count; ?></span>
																		</a>
																	</li>
																	<li> <a href="queries/signout.php">SIGN-OUT</a> </li>
                                                                        </div>
                                                                </ul>
                                                </div>
                                                </div>
                                     </div>
                                </div>
                </nav>
        <!--end nav bar-->
        <section class="login" style="margin-top: 50px;">
                <div class="container">
                        <!-- picture book review -->
                        <div class="row">
                                <div class="col-md-2 col-sm-2"></div>
                                <div class="col-md-8 col-sm-8">
                                        <div id="loginForm">
                                                <h1 class="wow slideInDown">Product Reservation Form</h1>
                                                <!--            registration form    -->
                                                <form class="center-block" action="queries/reserve.php" method="post">
                                                        <!--    Service id-->
                                                        <div class="form-group">
                                                                Product ID
                                                                <input class="form-control wow lightSpeedIn" id="productid" name="productid" value="<?php echo $productid; ?>" placeholder="Service ID" type="text" required readonly > </div>
                                                        <div class="message" id="sidMessage"></div>
                                                        <!--    name-->
                                                        <div class="form-group">
                                                                Product Name
                                                                <input class="form-control wow lightSpeedIn" id="productname" name="productname" value="<?php echo $productname; ?>" placeholder="Name of Service" type="text" required readonly > </div>
                                                        <div class="message" id="nosMessage"></div>
                                                        <!--price-->
                                                        <div class="form-group">
                                                                Price (each)
                                                                <input class="form-control wow lightSpeedIn" value="<?php echo $price; ?>" id="price" name="price" placeholder="Price" type="number" required readonly > </div>
                                                        <div class="message" id="priceMessage"></div>
                                                        <!--quantity-->
                                                        <div class="form-group">
                                                                Remaining Quantity
                                                                <input class="form-control wow lightSpeedIn" value="<?php echo $quantity; ?>" id="quantity" name="quantity" placeholder="Quantity" type="number" required readonly > </div>
                                                        <div class="message" id="quantityMessage"></div>
                                                        <!--reserve quantity-->
                                                        <div class="form-group">
                                                                Reserve Quantity
                                                            <input class="form-control wow lightSpeedIn" id="reservequantity" name="reservequantity" placeholder="Reserve Quantity" type="number" min="1" max="<?php echo $quantity; ?>" required autofocus > </div>
                                                        <div class="message" id="resquantityMessage"></div>
                                                        <!--price-->
                                                        <div class="form-group">
                                                                Amount to be paid
                                                                <input class="form-control wow lightSpeedIn" value="0" id="amount" name="amount" placeholder="Amount" type="number" required readonly > </div>
                                                        <div class="message" id="amountMessage"></div>
                                                <!--button submit-->
                                                <input class="btn btn-danger wow bounceInRight hvr-grow" type="submit" id="submit" value="Submit" />
                                                </form>
                                                <div class="back2 hvr-float">
                                                        <a href="product.php?productid=<?php echo $productid; ?>&ref=promotion"> <img src="assets/images/back.png"></a>
                                                </div>
                                        </div>
                                </div>
                                <div class="col-md-2 col-sm-2"> </div>
                        </div>
                </div>
        </section>

     <?php include 'footer.php';?>

    <script type="text/javascript">
        $('input[name="reservequantity"]').change(function() {

            var inpuVal = $(this).val();
            var price = $('input[name="price"]').val();
            var amount;

            function checkValidty(ss) {

                var message = "";

                if(ss!="") {
                    amount = price * ss;
                    $('input[name="amount"]').val(amount);
                }
                else {
                    message = "Enter the quantity";
                    $('input[name="amount"]').val(0);
                }

                if(message!="") {
                    message+=" please!";
                }

                return message;

            }

            $('#resquantityMessage').text(checkValidty(inpuVal));

        });
    </script>
</body>
</html>
