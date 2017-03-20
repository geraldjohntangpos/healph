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
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
                <title> Post Product </title>
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

                <section>
                        <div class="container">

                                <div class="row">
                                                <div class="col-md-1 col-sm-1"></div>
                                                <div class="col-md-10 col-sm-10">
                                                        <div id="postProductForm">
                                                                <h1 class="wow slideInDown">Post a Product</h1>
                                                                <!--            registration form    -->
                                                                <form class="center-block" action="../queries/postproduct.php" method="post" enctype="multipart/form-data">
                                                                        <!--    name-->
                                                                        <div class="form-group">
                                                                                <input class="form-control wow lightSpeedIn" id="productname" name="productname" placeholder="Name of Product" type="text" required> </div>
                                                                        <div class="message" id="nosMessage"></div>
                                                                        <!--                    caption of product-->
                                                                        <div class="form-group">
                                                                                <textarea class="form-control wow lightSpeedIn" id="description" name="description" placeholder="*Add Description" rows="5" spellcheck="true" required></textarea>
                                                                        </div>
                                                                        <div class="message" id="descriptionMessage"></div>
                                                                        <!--price-->
                                                                        <div class="form-group">
                                                                                <input class="form-control wow lightSpeedIn" id="price" name="price" placeholder="Price" type="number" required> </div>
                                                                        <div class="message" id="priceMessage"></div>
                                                                        <!--price-->
                                                                        <div class="form-group">
                                                                                <input class="form-control wow lightSpeedIn" id="quantity" name="quantity" placeholder="Product Quantity" type="number" required> </div>
                                                                        <div class="message" id="quantityMessage"></div>
                                                                        <!--Service Type-->
                                                                        <div class="form-group">
                                                                            <select class="form-control wow lightSpeedIn" id="type" name="type" required >
                                                                                <option value="">Select Service Type</option>
                                                                                <?php
                                                                                    $sql = "SELECT * FROM product_type";
                                                                                    $retrieve = $conn->query($sql)->fetchAll();
                                                                                    if($retrieve) {
                                                                                        foreach($retrieve as $row) {
                                                                                            $id = $row['PRODTYPE_ID'];
                                                                                            $prodtype = $row['PRODTYPE'];
                                                                                            echo "<option value='" .$id. "'>" .$prodtype. "</option>";
                                                                                        }
                                                                                    }
                                                                                    else {
                                                                                        ?>
                                                                                            <option value="">No entry</option>
                                                                                        <?php
                                                                                    }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="message" id="typeMessage"></div>
                                                                        <!--upload picture-->
                                                                        <div class="form-group">
                                                                                <input class="form-control wow lightSpeedIn" type="file" name="picture" required /> </div>
                                                                        <div class="message" id="pictureMessage"></div>
                                                                        <!--button submit-->
                                                                        <input class="btn btn-danger wow bounceInRight hvr-grow" type="submit" id="submit" value="Submit" /> </form>
                                                                <div class="back2 hvr-float">
                                                                        <a href="loginHealer.php"> <img src="../assets/images/back.png"></a>
                                                                </div>
                                                        </div>
                                                </div>
                                                <div class="col-md-1 col-sm-1"> </div>
                                        </div>
                                </div>
                </section>
                <?php include "../footer.php"; ?>
        </body>
        <script type="text/javascript" src="../jquery/posttraps.js"></script>

        </html>
