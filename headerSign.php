<!--      logo-->
                <div class="container bgMenu">
                        <nav class="navbar1 navbar-inverse1 navbar-fixed-top  wow bounceInUp">
                        <div class="row">

                                <div class="col-md-3 col-sm-3">
                                        <a href="loginHealer.php" class="navbar-brand"><img class="img-responsive wow slideInLeft" src="../assets/images/logo.png" /></a>
                                </div>

                                   <div class="navbar-header">
                                    <button class="navbar-toggle" data-target="#mainNavBar" data-toggle="collapse" type="button">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                     </button>
                                </div>

                                <!-- navbar -->
                                <div class="col-md-9 col-sm-9">
                                    <div class="collapse navbar-collapse" id="mainNavbar">
                                                <!-- Menu Items -->
                                                <div class="topUser">
                                                        <ul class="nav navbar-nav">
                                                                <li>
                                                        <a href="profile.php?accountid=<?php echo $_SESSION['USERID']; ?>">
                                                        <?php echo $_SESSION['NAME']; ?> <span class="badge badge-notify"><?php echo $healer_notif_count; ?></span> </a>
                                                                </li>
                                        <li> <a href="../queries/signout.php">SIGN-OUT</a> </li>
                                    </ul>
                                </div>

                                </div>
                            </div>
                        </div>
                        </nav>
                </div>
