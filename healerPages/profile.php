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

            require '../queries/connection.php';

            if(isset($_GET['accountid'])) {

                        $accountid = $_GET['accountid'];

                        $sql = "SELECT A.ACCT_ID, A.TYPE, H.ACCT_ID, H.HEALER_ID, H.SUBEXPIRY, H.LASTNAME, H.FIRSTNAME, H.ADDRESS, H.CONTACT, H.DETAILS, H.PICTURE, H.CLINICDAYS, H.CLINICHOURS, H.DAILYLIMIT FROM account AS A inner join healer AS H ON A.ACCT_ID = H.ACCT_ID WHERE H.ACCT_ID = '$accountid'";
                        $currmonth = date("m");
                        $currday = date("d");
                        $curryear = date("Y");
                        $expmonth;
                        $expday;
                        $expyear;
                        $retrieve = $conn->query($sql)->fetchAll();

                        if($retrieve) {
                        foreach($retrieve as $row) {
                              $name = $row['LASTNAME']. ", " .$row['FIRSTNAME'];
                              $healerid = $row['HEALER_ID'];
                              $address = $row['ADDRESS'];
                              $contact = $row['CONTACT'];
                              $type = $row['TYPE'];
                              $details = $row['DETAILS'];
                              $picture = $row['PICTURE'];
                              $limit = $row['DAILYLIMIT'];
                              $clinicdays = $row['CLINICDAYS'];
                              $clinichours = $row['CLINICHOURS'];
                              $clinicsched = $clinicdays. " (" .$clinichours. ")";
                              $subexpiry = $row['SUBEXPIRY'];
                              $expmonth = substr($subexpiry, 5, 2);
                              $expday = substr($subexpiry, 8, 2);
                              $expyear = substr($subexpiry, 0, 4);
                              $monthdays = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
                              $cmonth = $currmonth;
                              $cday = $currday;
                              $cyear = $curryear;
                              $daysremaining = 0;
                              if($expyear.$expmonth.$expday>$curryear.$currmonth.$currday) {
                                 while($cmonth != $expmonth || $cday != $expday || $cyear != $expyear) {
                                    if($cyear%4==0) {
                                       $monthdays[1] = 29;
                                    }
                                    $cday++;
                                    if($cday>$monthdays[$cmonth-1]) {
                                       $cday = 1;
                                       $cmonth++;
                                       if($cmonth>12) {
                                          $cmonth = 1;
                                          $cyear++;
                                       }
                                    }
                                    $daysremaining++;
                                 }
                              }
                              else {
                                 $daysremaining = 0;
                              }
                                    }
                        }
                        else {
                                    header('Location: adminLogin.php');
                        }
                        if($type != "Healer") {
                                    header('Location: adminLogin.php');
                        }
            }
            else {
                        header('Location: loginHealer.php');
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
      <title>
         <?php echo $_SESSION['NAME']; ?>
      </title>
      <meta charset="utf-8" />
      <meta content="width=device-width, initial-scale=1" name="viewport" />
      <link rel="icon" href="../assets/images/icon.png" />
      <link href="../assets/css/main.css" rel="stylesheet" />
      <script src="../bower_components/jquery/dist/jquery.min.js"></script>
      <script src="../bower_components/bootstrap-sass/assets/javascripts/bootstrap.min.js"></script>
      <script src="../bower_components/wow/dist/wow.min.js"></script>
      <script src="../bower_components/jquery/dist/underscore-min.js"></script>
      <script src="../bower_components/jquery/dist/jquery.e-calendar.js"></script>
      <script src="../jquery/calendar.js"></script>
      <link rel="stylesheet" href="../assets/css/jquery.e-calendar.css">
      <script>
         new WOW().init();
      </script>
   </head>

   <body>
      <!--      logo-->
      <nav class="navbar1 navbar-inverse1 navbar-fixed-top  wow bounceInUp">
         <div class="container topnav bgMenu">
            <div class="row">
               <div class="col-md-9 col-sm-9">
                  <a href="loginHealer.php" class="navbar-brand"><img class="img-responsive wow slideInLeft" src="../assets/images/logo.png" /></a>
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
                              <a href="profile.php?accountid=<?php echo $_SESSION['USERID']; ?>">
                                 <?php echo $_SESSION['NAME']; ?> <span class="badge badge-notify"><?php echo $healer_notif_count; ?></span> </a>
                           </li>
                           <li> <a href="../queries/signout.php">SIGN-OUT</a> </li>
                        </div>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </nav>
      <!--about healer        -->
      <section class="healerPage" style="margin-top:160px;">
         <div class="container">
            <!-- picture healer -->
            <div class="row">
               <div class="col-md-8 col-sm-8 col-md-push-4 col-sm-4">
                  <p class="wow fadeInRight">
                     <div id="calendar"></div>
                  </p>
               </div>
               <div class="col-md-4 col-sm-4 col-md-pull-8 col-sm-8"> <img class="img-responsive wow fadeInUpBig" id="pp" src="../images/healer/<?php echo $picture; ?>" style="width: 300px; height: 300px; border-radius: 50%;" />
                  <p class="wow fadeInUpBig">Healer Name:
                     <?php echo $name; ?>
                  </p>
                  <p class="wow fadeInUpBig">Healer ID: <span id="hid"><?php echo $healerid; ?></span> </p>
                  <p class="wow fadeInUpBig">Location:
                     <?php echo $address; ?>
                  </p>
                  <p class="wow fadeInUpBig">Contact Number:
                     <?php echo $contact; ?>
                  </p>
                  <p class="wow fadeInUpBig">Clinic Hours:
                     <?php echo $clinicsched; ?>
                  </p>
                  <p class="wow fadeInUpBig">Daily Accommodation limit:
                     <?php echo $limit; ?>
                  </p>
                     <?php
                        $color = "green";
                        if($daysremaining < 6) {
                              $color = "red";
                        }
                        if($daysremaining == 1) {
                              $conc = " day";
                        } 
                        elseif($daysremaining < 1) {
                              $conc = " EXPIRED";
                        }
                        else {
                              $conc = " days";
                        }
                     ?>
                  <p class="wow fadeInUpBig" style="color:<?php echo $color; ?>">Remaining subscription:
                     <?php echo $daysremaining.$conc; ?>
                  </p>
                  <p class="wow rotateInDownRight" style="text-decoration: underline;"><span style="display: none;" id="viewid"><?php echo $healerid; ?></span><span style="display: none;" id="viewtype">healer</span><span id="displike"></span></p>
                  <div> <a href="editprofile.php?accountid=<?php echo $accountid; ?>" style="color: green;">Edit Profile</a> </div>
                  <div> <a href="changepass.php?accountid=<?php echo $accountid; ?>" style="color: green;">Change Password</a> </div>
                  <div class="back hvr-grow">
                     <a href="loginHealer.php"> <img src="../assets/images/back.png"></a>
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
                  <h1 class="wow fadeInDown"><hr /><hr /><hr /></h1>
                  <ul class="wow fadeInDown">
                     <table style="width: 100%;">
                        <tr style="width:100%">
                           <td style="border:1px solid; background:darkgreen; padding: 3px; font-weight: bold; font-size: 24px;">
                              <a href="../queries/gethealercomments.php?accountid=<?php echo $accountid; ?>&q=comments" target="iframedisp" style="with: 100%; height: 100%"> <i class="fa fa-comment" aria-hidden="true"></i>Comments </a>
                           </td>
                           <td style="border:1px solid; background:darkgreen; padding: 3px; font-weight: bold; font-size: 24px;">
                              <a href="../queries/gethealercomments.php?accountid=<?php echo $accountid; ?>&q=notification" target="iframedisp" style="with: 100%; height: 100%"> <i class="fa fa-bell" aria-hidden="true"></i>Notification </a>
                           </td>
                           <td style="border:1px solid; background:darkgreen; padding: 3px; font-weight: bold; font-size: 24px;">
                              <a href="../queries/gethealercomments.php?accountid=<?php echo $accountid; ?>&q=confirmed" target="iframedisp" style="width: 100%; height: 100%"> <i class="fa fa-check" aria-hidden="true"></i>Confirmed </a>
                           </td>
                        </tr>
                        <tr>
                           <td colspan="3">
                              <iframe name="iframedisp" src="../queries/gethealercomments.php?accountid=<?php echo $accountid; ?>&q=comments" style="width: 100%; height: 450px;"> </iframe>
                           </td>
                        </tr>
                     </table>
                  </ul>
               </div>
            </div>
         </div>
      </section>
      <?php include "../footer.php"; ?>
         <script type="text/javascript" src="../jquery/likecounter.js"></script>
   </body>

   </html>
