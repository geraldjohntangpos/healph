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
      <title> Add Healer </title>
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

   <body onLoad="initialize()">
      <!--      logo-->
      <nav class="navbar1 navbar-inverse1 navbar-fixed-top  wow bounceInUp">
         <div class="container topnav bgMenu">
            <div class="row">
               <div class="col-md-9 col-sm-9">
                  <a href="adminLogin.php" class="navbar-brand"><img class="img-responsive wow slideInLeft" src="../assets/images/logo.png" /></a>
               </div>
               <div class="navbar-header">
                  <button class="navbar-toggle" data-target="#mainNavBar" data-toggle="collapse" type="button"> <span class="icon-bar">
                            </span> <span class="icon-bar">
                            </span> <span class="icon-bar">
                            </span> </button>
               </div>
               <!-- Menu Items -->
               <div class="collapse navbar-collapse" id="mainNavBar">
                  <div class="col-md-3 col-sm-3">
                     <ul class="nav navbar-nav">
                        <div class="topUser">
                           <li>
                              <a href="#">
                                 <?php echo $_SESSION['NAME']; ?> <span class="badge badge-notify"><?php echo $countnotif; ?></span> </a>
                           </li>
                           <li> <a href="../queries/signout.php">SIGN-OUT</a> </li>
                        </div>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </nav>
      <!--end nav bar-->
      <section class="login">
         <div class="container">
            <!-- picture book review -->
            <div class="row">
               <div class="col-md-12 col-sm-12">
                  <div id="addHealer">
                     <h1 class="wow slideInDown">Add a Healer</h1>
                     <!--            registration form    -->
                     <form class="center-block" action="../queries/registration.php" method="post">
                        <!--    username-->
                        <div class="form-group">
                           <input class="form-control wow lightSpeedIn" name="username" id="username" placeholder="Username" type="text" required autofocus> </div>
                        <div class="message" id="usernameMessage"></div>
                        <!--password                                -->
                        <div class="form-group">
                           <input class="form-control wow lightSpeedIn" name="password" id="password" placeholder="Password" type="Password" required> </div>
                        <div class="message" id="passwordMessage"></div>
                        <!--firstname-->
                        <div class="row">
                           <div class="col-md-6 col-sm-6">
                              <div class="form-group">
                                 <input class="form-control wow lightSpeedIn" name="firstname" id="firstname" placeholder="First Name" type="text" required> </div>
                              <div class="message" id="firstnameMessage"></div>
                           </div>
                           <div class="col-md-6 col-sm-6">
                              <!--lastname    -->
                              <div class="form-group">
                                 <input class="form-control wow lightSpeedIn" name="lastname" id="lastname" placeholder="Last Name" type="text" required> </div>
                              <div class="message" id="lastnameMessage"></div>
                           </div>
                        </div>
                        <!--email add-->
                        <div class="form-group">
                           <input class="form-control wow lightSpeedIn" name="emailadd" id="emailadd" placeholder="Email address" type="email" required> </div>
                        <div class="message" id="emailaddMessage"></div>
                        <div class="row">
                           <div class="col-md-6 col-sm-6">
                              <!--mobile number-->
                              <div class="form-group">
                                 <input class="form-control wow lightSpeedIn" name="mobile" id="mobile" placeholder="Mobile number" type="number" min="9111111111" required> </div>
                              <div class="message" id="mobileMessage"></div>
                           </div>
                           <div class="col-md-6 col-sm-6">
                              <!--                                                                type-->
                              <div class="form-group">
                                 <select class="form-control wow lightSpeedIn" name="type" id="type" required>
                                    <option value="Healer">Healer</option>
                                 </select>
                              </div>
                              <div class="message" id="typeMessage"></div>
                           </div>
                        </div>
                        <!--															This is the map	-->
                        <div id="map_canvas" style="width:100%; height:400px"></div>
                        <div id="latlong" style="margin-top: 20px;">
                           <p class="lat">Latitude:
                              <input size="20" type="text" id="latbox" value="10.29622504439878" name="lat" readonly> </p>
                           <p class="long">Longitude:
                              <input size="20" type="text" id="lngbox" value="123.89832615852356" name="lng" readonly> </p>
                           <p class="address">Address:
                              <input size="50" type="text" id="address" value="Metro Colon, Cebu City, Cebu, Philippines" name="add" style="width: 82%;" readonly> </p>
                        </div>
                        <!--															This is the end of the map-->
                        <input class="btn btn-danger wow fadeInLeft" id="register" type="submit" value="Add Healer" style="margin: 40px 0 50px;"> </form>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <?php include "../footer.php"; ?>
   </body>

   </html>
   <cfoutput>
      <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9mZbQVCr0mJKNWiWn_EFqiz-S8YZxv40&v=3&callback=initMap&sensor=false"></script>
   </cfoutput>
   <script type="text/javascript" src="../jquery/addhealertrap.js"></script>
   <script type="text/javascript" src="../jquery/selectLoc.js"></script>