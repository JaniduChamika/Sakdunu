    <?php

      class HD
      {

            public static function headview($page)
            {
                  $home = "";
                  $cart = "";
                  $profile = "";
                  $whislist = "";
                  $package = "";
                  $contactus = "";
                  $notification = "";
                  $cart2="";
                  if ($page == "home") {
                        $home = "activemy";
                  } else if ($page == "cart") {
                        $cart = "d-none";
                        $cart2="activehead";
                  } else if ($page == "profile") {
                        $profile = "mt-0";
                  } else if ($page == "whislist") {
                        $whislist = "activehead";
                  } else if ($page == "package") {
                        $package = "activehead";
                  } else if ($page == "contactUs") {
                        $contactus = "activemy";
                  } else if ($page == "notification") {
                        $notification = "activehead";
                  }
      ?>
                <div class="row blucohead">


                      <div class="topnav col-12" id="navbarmy">

                            <div class="row ">
                                  <?php
                                    if ($page != "profile") {

                                    ?>
                                        <div class="col-12 col-md-3 col-lg-3 col-xl-3 col-xxl-2 hedimgbox">
                                              <a href="index.php" class="text-decoration-none">
                                              <img src="cssfile//baclogoimg//logo2.png" class="logo" />
                                              <img src="cssfile//baclogoimg//lohosub.png" class="logo2" />
                                              </a>
                                        </div>


                                        <div class="col-12 col-md-9 col-lg-9 col-xl-9 col-xxl-10 headObox ">


                                              <div class="row hei100 mt-2">

                                                    <div class="col-3 pad-0 ps-1 ps-md-0">

                                                          <select class="searchsel mTBauto" name="s" id="selID">
                                                                <option value="All" selected> Any </option>

                                                                <?php

                                                                  $qhead = "SELECT * FROM main_category ;";
                                                                  // $resultsethead = $dbms->query($qhead);

                                                                  $resultsethead = DB::search($qhead);
                                                                  $rhed = $resultsethead->num_rows;
                                                                  for ($i = 0; $i < $rhed; $i++) {
                                                                        $dhed = $resultsethead->fetch_assoc();
                                                                  ?>
                                                                      <option value="<?php echo $dhed['mid'] ?>">

                                                                            <?php echo $dhed['name'] ?>
                                                                      </option>
                                                                <?php

                                                                  }
                                                                  ?>
                                                          </select>

                                                    </div>
                                                    <div class="col-7 col-md-6 pad-0">
                                                          <input type="text" placeholder="Search.." class="searchmain mTBauto" id="serID" name="t">

                                                    </div>
                                                    <div class="col-2 col-md-2 pe-1 pe-md-0 pad-0">

                                                          <button class="searcbtn mTBauto" onclick="sendpost();"><i class="icofont-search-2"></i></button>

                                                    </div>
                                                    <div class="col-md-1 pad-0">

                                                          <button class="cart mx-auto d-none d-md-block <?php echo $cart ?>" onclick="goCart()"><i class="icofont-cart"></i></button>

                                                    </div>

                                              </div>

                                        </div>
                                  <?php
                                    }

                                    ?>
                                  <div class="hed2 <?php echo $profile ?>">
                                        <button class=" sidemenubtn " data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"><i class="icofont-navigation-menu"></i></button>
                                        <div class=" hed2option ">
                                              <div class="row hei100">
                                                    <button class="hed2optionbtn cartclz d-md-none <?php echo $cart2 ?>" onclick="goCart()"><i class="icofont-cart"></i></button>
                                                    <button onclick="goWishlist();" class="hed2optionbtn wishclz <?php echo  $whislist ?>"><i class="icofont-heart"></i> </button>
                                                    <button class="hed2optionbtn packageclz <?php echo $package ?>" onclick="goPackge();"><i class="icofont-bag"></i> </button>
                                                    <button class="hed2optionbtn notoficationclz <?php echo $notification ?>" onclick="goNotification();"><i class="icofont-notification"></i> </button>
                                              </div>
                                        </div>
                                  </div>
                            </div>
                      </div>
                </div>
                <div class="offcanvas offcanvas-start sidenav" id="offcanvasExample">

                      <!-- <a href="javascript:void(0)" class="closebtn" data-bs-dismiss="offcanvas" aria-label="Close"><i class="icofont-arrow-left"></i></a> -->
                      <?php
                        if (isset($_SESSION["name"])) {
                        ?>
                            <a style="padding: 0px;" href="#" id="loginlinkID">
                                  <button class="firstsign">
                                        Welcome &nbsp;<?php echo $_SESSION["name"] ?>
                                  </button></a>
                      <?php
                        } else {
                        ?>
                            <a style="padding: 0px;" href="login.php" id="loginlinkID">
                                  <button class="firstsign">
                                        <i class="icofont-user-alt-7"></i> &nbsp;Sign In/Up
                                  </button></a>
                      <?php
                        }
                        ?>

                      <button class=" othermain pt-4 <?php echo $home ?>" onclick="goIndex();">
                            <a style="padding: 0px;" href="index.php">
                                  <h4><i class="icofont-home"></i>&nbsp;Home</h4>
                            </a></a>
                      </button>
                      <button class="othermain pt-4" onclick="goShop();">
                            <a style="padding: 0px;" href="shop.php">
                                  <h4><i class="icofont-prestashop"></i>&nbsp;Shop</h4>
                            </a>
                      </button>
                      <?php
                        if (isset($_SESSION["type"])) {
                              if ($_SESSION["type"] == "seller") {

                        ?>
                                  <button class="othermain">
                                        <a style="padding: 0px;" href="seller.php">
                                              <h4><i class="icofont-ui-clip-board"></i>&nbsp;Seller Board</h4>
                                        </a>
                                  </button>
                      <?php
                              }
                        }

                        ?>

                      <div class="accordion accordion-flush trans" id="accordionFlushExample">
                            <div class="accordion-item trans">
                                  <h2 class="accordion-header " id="flush-headingtop1">
                                        <button class="accordion-button collapsed bthead" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsetop1" aria-expanded="false" aria-controls="flush-collapseOne">

                                              <h4> <i class="icofont-brand-microsoft"></i> &nbsp;Catergories</h4>
                                        </button>
                                  </h2>
                                  <div id="flush-collapsetop1" class="accordion-collapse collapse subcontent" aria-labelledby="flush-headingOne">
                                        <?php

                                          $qcater = "SELECT *FROM main_category";
                                          // $resultsetmain = $dbms->query($qcater);

                                          $resultsetmain = DB::search($qcater);

                                          $mainrow = $resultsetmain->num_rows;

                                          for ($main = 0; $main < $mainrow; $main++) {
                                                $dmain = $resultsetmain->fetch_assoc();
                                          ?>
                                              <div class="accordion-item trans">
                                                    <h2 class="accordion-header " id="flush-heading<?php echo $main ?>">
                                                          <button class="accordion-button collapsed " type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $main ?>" aria-expanded="false" aria-controls="flush-collapse<?php echo $main ?>">
                                                                &nbsp;<?php echo $dmain["name"] ?>
                                                          </button>
                                                    </h2>
                                                    <div id="flush-collapse<?php echo $main ?>" class="accordion-collapse collapse subcontent" aria-labelledby="flush-heading<?php echo $main ?>">


                                                          <?php
                                                            $qsub = "SELECT * FROM sub_catergory WHERE `main_category_id`= '" . $dmain["mid"] . "'";
                                                            // $resultsetsub = $dbms->query($qsub);

                                                            $resultsetsub = DB::search($qsub);


                                                            $subrow = $resultsetsub->num_rows;
                                                            for ($sub = 0; $sub < $subrow; $sub++) {
                                                                  $dsub = $resultsetsub->fetch_assoc();

                                                            ?>
                                                                <a class="accordion-body" href="shop.php?sub=<?php echo $dsub["sid"] ?>"><?php echo $dsub["name"] ?> </a>
                                                          <?php

                                                            }
                                                            ?>

                                                    </div>
                                              </div>

                                        <?php
                                          }
                                          ?>



                                  </div>
                            </div>
                      </div>
                      <!-- <button class="othermain pt-4 " onclick="">
                            <a style="padding: 0px;" href="#">
                                  <h4><i class="icofont-info-circle"></i>&nbsp;About</h4>
                            </a>
                      </button> -->
                      <button class="othermain pt-4 <?php echo $contactus ?>" onclick="">
                            <a style="padding: 0px;" href="contact.php">
                                  <h4><i class="icofont-ui-contact-list"></i>&nbsp;Contact Us</h4>
                            </a>
                      </button>
                      <button class="othermain" onclick="">
                            <a style="padding: 0px;" href="#">
                                  <h4><i class="icofont-question-circle"></i>&nbsp;Help</h4>
                            </a>
                      </button>
                      <nav class="mb-0 mt-auto">
                            <div class="btn-group dropup navbar navbar-expand-lg mb-0">
                                  <button class="dropdown-toggle othermain" onclick="" style="margin-bottom: 10px;margin-top: auto;" data-bs-toggle="dropdown" aria-expanded="false">

                                        <h4><i class="icofont-user-alt-5"></i>&nbsp; Account</h4>

                                  </button>
                                  <ul class="dropdown-menu ms-5">
                                        <li><a class="dropdown-item" href="userorders.php">Purchase History</a></li>
                                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>

                                        <li>
                                              <hr>
                                        </li>
                                        <?php
                                          if (isset($_SESSION["name"])) {
                                          ?>
                                              <li onclick="logout();"><a class="dropdown-item" href="#">Log Out</a></li>
                                        <?php
                                          } else {
                                          ?>
                                              <li onclick="login();"><a class="dropdown-item" href="#">Log In</a></li>
                                        <?php
                                          }
                                          ?>
                                  </ul>
                            </div>

                      </nav>
                </div>

    <?php
            }
      }
      ?>