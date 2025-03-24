<?php
session_start();
require "database.php";
require "head.php";
require "footer.php";
?>
<!DOCTYPE html>
<html>

<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Notification</title>
      <link rel="icon" href="cssfile//baclogoimg//logo2.png" />

      <link rel="stylesheet" href="cssfile//bootstrap.css" />
      <link rel="stylesheet" href="cssfile//head.css" />
      <link rel="stylesheet" href="cssfile//foot.css" />
      <link rel="stylesheet" href="cssfile//icofont.min.css" />
      <link rel="stylesheet" href="cssfile//notification.css" />

</head>

<body>
      <div class="container-fluid">
            <?php
            HD::headview("notification")
            ?>
            <div class="row mattop " style="min-height: 590px;">
                  <div class="col-12 col-md-10 col-lg-8 m-auto pt-4">
                        <?php
                        $notify = DB::search("SELECT * FROM `notification`");
                        if ($notify->num_rows >= 1) {
                              for ($i = 0; $i < $notify->num_rows; $i++) {
                                    $msg = $notify->fetch_assoc();
                        ?>
                                    <div class="row p-2">
                                          <div class="col-12 boxnotifi">
                                                <div class="row pt-4 pe-3 ps-3">
                                                      <h4><?php echo $msg["subject"] ?></h4>
                                                </div>
                                                <div class="row pb-4 pe-3 ps-3">
                                                      <p><?php echo $msg["content"] ?></p>
                                                </div>

                                          </div>
                                    </div>
                              <?php

                              }
                        } else {
                              ?>
                              <div class="col-12 text-center p-5 ">
                                    <span class="m-auto fs-5">There are no notification</span>
                                    <br />
                                    <a href="index.php" class="btn silever mt-3 px-4 fs-6">Continue Shopping</a>
                              </div>
                        <?php

                        }
                        ?>
                        <!-- <div class="row p-2">
                        <div class="col-12 boxnotifi">
                              <div class="row pt-3 pe-3 ps-3">
                                    <h4>Welcome to sakdunu super</h4>
                              </div>
                              <div class="row pe-3 ps-3">
                                    <p>We are committed to providing quality products and friendly service</p>
                              </div>
                              <div class="row p-3">
                                    <button class="btn clerbtn pe-5 ps-5">Clear</button>
                              </div>
                        </div>
                  </div>
                  <div class="row p-2">
                        <div class="col-12 boxnotifi">
                              <div class="row pt-3 pe-3 ps-3">
                                    <h4>New packages</h4>
                              </div>
                              <div class="row pe-3 ps-3">
                                    <p>There are new packages. See the Packages tab</p>
                              </div>
                              <div class="row p-3">
                                    <button class="btn clerbtn pe-5 ps-5 ">Clear</button>
                              </div>
                        </div>
                  </div> -->
                        <!-- <div class="row p-2">
                        <div class="col-12 boxnotifi">
                              <div class="row pt-3 pe-3 ps-3">
                                    <h4>Head of the notifivation</h4>
                              </div>
                              <div class="row pe-3 ps-3">
                                    <p>Notice content show here</p>
                              </div>
                              <div class="row p-3">
                                    <button class="btn clerbtn pe-5 ps-5">Clear</button>
                              </div>
                        </div>
                  </div> -->
                  </div>
            </div>
            <?php
            FOOT::footview("normal");
            ?>
      </div>

      <script src="bootstrap.min.js"></script>
      <script src="navhider.js"></script>
      <script src="commen.js"></script>

</body>

</html>