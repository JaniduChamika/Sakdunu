<?php
session_start();

require "database.php";
require "head.php";
require "footer.php";
date_default_timezone_set("Asia/Colombo");
$date = date("Y-m-d");
?>
<!DOCTYPE html>
<html>

<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Package</title>
      <link rel="icon" href="cssfile//baclogoimg//logo2.png" />

      <link rel="stylesheet" href="cssfile//icofont.min.css" />
      <link rel="stylesheet" href="cssfile//bootstrap.css" />
      <link rel="stylesheet" href="cssfile//package.css" />
      <link rel="stylesheet" href="cssfile//head.css" />
      <link rel="stylesheet" href="cssfile//foot.css" />



</head>

<body>
      <div class="container-fluid ">
            <?php

            HD::headview("package");
            ?>
            <div class="row mattop" style="min-height: 590px;">
                  <div class="col-12  col-md-11 col-lg-10 col-xl-10 col-xxl-9 m-auto mt-4 packbox ">
                        <h3 class="mt-1 text-center mt-2">Packages</h3>
                        <div class="row p-1 p-md-2 justify-content-center">
                              <?php
                              $q = "SELECT * FROM package WHERE `end_date`>='" . $date . "' AND `strat_date`<='" . $date . "'";
                              $resultset = DB::search($q);
                              if ($resultset->num_rows != 0) {
                                    $round = 0;

                                    for ($i = 0; $i < $resultset->num_rows; $i++) {
                                          $d = $resultset->fetch_assoc();

                                          $q2 = "SELECT * FROM pack_product INNER JOIN product ON pack_product.`product_pid`=product.`pid` WHERE (product.`expire_date`<='" . $date . "' OR  product.`delete`='1' OR product.`qty`='0') AND pack_product.`package_id`='" . $d["pack_id"] . "'  ";
                                          $resultset2 = DB::search($q2);

                                          if ($resultset2->num_rows == 0) {
                              ?>

                                                <div class="col-12 col-md-6 col-lg-4 col-xl-3 ">
                                                      <div class="row p-2 h-100">

                                                            <div class="col-12">

                                                                  <div class="row p-2 p-lg-3  packagecard  position-relative h-100">

                                                                        <div class="col-5 col-md-4 col-lg-12 fitheight m-auto">
                                                                              <?php
                                                                              if ($d["discount"] != 0) {
                                                                              ?>
                                                                                    <div class="dis position-absolute top-0 start-0 p-2">
                                                                                          <span class="fw-bold">- <?php echo $d["discount"]; ?>% OFF</span>
                                                                                    </div>
                                                                              <?php
                                                                              }
                                                                              ?>


                                                                              <div class="row">
                                                                                    <img src="<?php echo $d["img"] ?>" class="w-100 p-0 packageimg" />
                                                                              </div>
                                                                        </div>
                                                                        <div class="col-7 col-md-8 col-lg-12">
                                                                              <div class="row h-100">

                                                                                    <table class="h-100 w-100 packagetable">
                                                                                          <tr>
                                                                                                <td class="proname align-top">
                                                                                                      <?php echo $d["pack_name"]; ?>
                                                                                                </td>

                                                                                          </tr>
                                                                                          <tr>

                                                                                                <td class="align-top pricehei"> <?php
                                                                                                                                    $q = "SELECT SUM(product.`price`) AS `total_price` FROM pack_product INNER JOIN product ON pack_product.`product_pid`=product.`pid` 
                                                      WHERE pack_product.`package_id`='" . $d["pack_id"] . "' ";
                                                                                                                                    $resultsetIn = DB::search($q);
                                                                                                                                    if ($resultsetIn->num_rows == 1) {
                                                                                                                                          $din = $resultsetIn->fetch_assoc();
                                                                                                                                          $realPrice = $din["total_price"];
                                                                                                                                          $newPrice = $realPrice - ceil($realPrice * ($d["discount"] / 100));
                                                                                                                                    ?>



                                                                                                            Rs.<?php echo number_format($newPrice, 2) ?>


                                                                                                      <?php
                                                                                                                                    }
                                                                                                      ?>
                                                                                                      <br />
                                                                                                      <span class="smailFont text-decoration-line-through">
                                                                                                            <?php

                                                                                                            if ($d["discount"] != 0) {
                                                                                                            ?>
                                                                                                                  Rs.<?php echo number_format($realPrice, 2) ?>
                                                                                                            <?php
                                                                                                            }
                                                                                                            ?>
                                                                                                      </span>
                                                                                                </td>
                                                                                          </tr>
                                                                                          <tr>

                                                                                                <td class="datehei">
                                                                                                      <?php echo $d["end_date"]; ?> (end date)

                                                                                                </td>
                                                                                          </tr>
                                                                                          <tr>
                                                                                                <td class="pt-2 pb-2 pt-lg-2 cenright align-bottom"><a href="packageProducts.php?packid=<?php echo $d["pack_id"] ?>" class="btn bluco viewbtnpack px-4"><i class="icofont-eye"></i> </a></td>
                                                                                          </tr>
                                                                                    </table>
                                                                              </div>
                                                                        </div>
                                                                  </div>
                                                            </div>
                                                      </div>
                                                </div>
                                          <?php
                                                $round = 1;
                                          } else if ($round == 0) {

                                          ?>
                                                <div class="col-12 text-center p-5 mt-5">
                                                      <span class="m-auto fs-5">There are no packges available yet</span>
                                                      <br />
                                                      <a href="index.php" class="btn silever mt-3 px-4 fs-6">Continue Shopping</a>
                                                </div>

                                    <?php
                                                $round = 1;
                                          }
                                    }
                              } else {
                                    ?>
                                    <div class="col-12 text-center p-5 mt-5">
                                          <span class="m-auto fs-5">There are no Packges Available yet</span>
                                          <br />
                                          <a href="index.php" class="btn silever mt-3 px-4 fs-6">Continue Shopping</a>
                                    </div>

                              <?php
                              }
                              ?>

                        </div>
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