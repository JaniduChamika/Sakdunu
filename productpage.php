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
      <?php

      $d;
      $r;
      if (isset($_GET["pid"])) {
            $id = $_GET["pid"];

            $q = "SELECT * FROM product JOIN brand ON product.`brand_id`=brand.`bid` WHERE `pid`='" . $id . "'";
            $resultset = DB::search($q);
            $r = $resultset->num_rows;



            if ($r == 1) {
                  $d = $resultset->fetch_assoc();
                  // if ($d["bname"] == "none") {
                  //       $d["bname"] = "";
                  // }
      ?>
                  <title><?php echo $d["title"] ?></title>


            <?php
            } else {
            ?>
                  <title>Product</title>

      <?php
            }
      }
      ?>
      <link rel="icon" href="cssfile//baclogoimg//logo2.png" />

      <link rel="stylesheet" href="cssfile//icofont.min.css">
      <link rel="stylesheet" href="cssfile//bootstrap.css" />
      <link rel="stylesheet" href="cssfile//foot.css" />

      <link rel="stylesheet" href="cssfile//productpage.css" />
      <link rel="stylesheet" href="cssfile//head.css" />

</head>

<body onload="setlink();">
      <div class="container-fluid">
            <?php

            HD::headview("product");
            ?>

            <div class="row mattop">

                  <?php



                  if ($r == 1) {
                        // if ($d["bname"] == "None") {
                        //       $d["bname"] = "";
                        // }
                        // if ($d["expire_date"] > $date) {
                  ?>

                        <div class="col-10 col-md-8 col-lg-5 col-xl-4  col-xxl-3 p-4 m-auto m-md-auto imgbox">
                              <!-- <div class="row"> -->

                              <!-- <img src="<?php echo $d['img'] ?>" class="proimg" /> -->
                              <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                          <div class="carousel-item active position-relative">
                                                <?php
                                                if ($d["delete"] == "1" || $d["expire_date"] < $date) {
                                                ?>
                                                      <div class=" position-absolute d-flex align-content-center notavailablediv text-center w-100 h-100">
                                                            <span class=" m-auto fs-4 text-white">Not Available</span>
                                                      </div>
                                                <?php
                                                }

                                                ?>
                                                <img src="<?php echo $d['img'] ?>" class="d-block w-100 imgradius" alt="...">

                                          </div>
                                          <!-- <div class="carousel-item">
                                                      <img src="" class="d-block w-100 imgradius" alt="...">
                                                </div>
                                                <div class="carousel-item">
                                                      <img src="" class="d-block w-100 imgradius" alt="...">
                                                </div> -->
                                    </div>
                                    <!-- <button class="carousel-control-prev darkback" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                          </button>
                                          <button class="carousel-control-next darkback" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                          </button> -->
                              </div>
                              <!-- </div> -->
                        </div>
                        <div class="col-12 col-md-10 col-lg-7 col-xl-7 col-xxl-7 m-auto m-md-auto  buyin">
                              <div class="row p-2">
                                    <h4><?php echo $d["title"]  ?></h4>
                                    <div class="col-12 col-md-6 col-xxl-5">
                                          <table class="propagetale1">

                                                <tr>
                                                      <td>
                                                            Quintity

                                                      </td>
                                                      <td>
                                                            <?php
                                                            if ($d["delete"] == "1" || $d["qty"] == "0" || $d["expire_date"] < $date) {
                                                            ?>
                                                                  <input type="number" min="1" max="<?php echo $d["qty"] ?>" value="1" class="qtyin" onchange="qtyChange();" disabled id="qtyID" />

                                                            <?php
                                                            } else {
                                                            ?>
                                                                  <input type="number" min="1" max="<?php echo $d["qty"] ?>" value="1" class="qtyin" onchange="qtyChange();" id="qtyID" />
                                                            <?php
                                                            }
                                                            ?>
                                                      </td>
                                                </tr>
                                                <tr>
                                                      <td>
                                                            Price

                                                      </td>
                                                      <td>
                                                            Rs: <?php
                                                                  echo $d["price"]
                                                                  ?>.00

                                                      </td>
                                                </tr>
                                                <?php
                                                if ($d["expire_date"] != "9999-12-20" && $d["expire_date"] > $date) {
                                                ?>
                                                      <tr>
                                                            <td>
                                                                  Exipre Date

                                                            </td>
                                                            <td>
                                                                  <?php
                                                                  echo $d["expire_date"]
                                                                  ?>

                                                            </td>
                                                      </tr>
                                                <?php
                                                }
                                                if ($d["qty"] <= 0 || $d["expire_date"] < $date) {
                                                ?>
                                                      <tr>
                                                            <td colspan="2" class="text-danger fs-4 fw-bold">
                                                                  out of stock
                                                            </td>
                                                      </tr>

                                                <?php
                                                } else {
                                                ?>
                                                      <tr>
                                                            <td>
                                                                  In Stock

                                                            </td>
                                                            <td>
                                                                  <?php
                                                                  echo $d["qty"];
                                                                  ?>
                                                                  items left
                                                            </td>
                                                      <?php
                                                }
                                                      ?>
                                                      </tr>

                                          </table>


                                    </div>
                                    <div class="col-12 col-md-6">


                                    </div>
                                    <div class="col-12 col-md-6 col-lg-7 col-xxl-5 mt-2">
                                          <table class="w-100">
                                                <?php
                                                if ($d["delete"] != "1") {
                                                ?>
                                                      <tr>
                                                            <td class="px-3 px-md-1 px-xl-1">
                                                                  <?php
                                                                  if ($d["qty"] == "0" || $d["expire_date"] < $date) {
                                                                  ?>
                                                                        <button class="probtn orangco px-lg-4 me-3 w-100" disabled>Buy Now</button>

                                                                  <?php
                                                                  } else {
                                                                  ?>
                                                                        <button class="probtn orangco px-lg-4 me-3 w-100" onclick="cheackout(<?php echo $d['pid'] ?>);">Buy Now</button>

                                                                  <?php
                                                                  }
                                                                  ?>
                                                            </td>
                                                            <td class="px-3 px-md-1 px-xl-3">
                                                                  <?php
                                                                  if ($d["qty"] == "0" || $d["expire_date"] < $date) {
                                                                  ?>
                                                                        <button class="probtn bluco me-3 w-100" disabled>Add to Cart</button>

                                                                  <?php
                                                                  } else {
                                                                  ?>
                                                                        <button class="probtn bluco me-3 w-100" onclick="addCart(<?php echo $d['pid'] ?>)">Add to Cart</button>

                                                                  <?php
                                                                  }
                                                                  ?>
                                                            </td>
                                                            <td>
                                                                  <?php
                                                                  if (isset($_SESSION["userdata"]["id"])) {
                                                                        $q = "SELECT * FROM wishlist WHERE `product_pid`='" . $d['pid'] . "' AND `user_id`='" . $_SESSION["userdata"]["id"] . "'";
                                                                        $result = DB::search($q);
                                                                        if ($result->num_rows == 1) {
                                                                  ?>
                                                                              <button class=" wishbtn wishactive" onclick="wishlist(<?php echo $d['pid'] ?>);" id="wishicon"><i class="icofont-heart"></i></button>
                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                              <button class=" wishbtn" onclick="wishlist(<?php echo $d['pid'] ?>);" id="wishicon"><i class="icofont-heart"></i></button>

                                                                        <?php
                                                                        }
                                                                  } else {
                                                                        ?>
                                                                        <button class=" wishbtn" onclick="wishlist(<?php echo $d['pid'] ?>);" id="wishicon"><i class="icofont-heart"></i></button>

                                                                  <?php
                                                                  }

                                                                  ?>


                                                            </td>
                                                      </tr>
                                                <?php
                                                }
                                                ?>
                                          </table>
                                    </div>
                              </div>
                        </div>


                  <?php
                        // }
                  }

                  ?>
            </div>
            <div class="row">
                  <div class="col-12 col-md-12 col-xl-11 samplecardmain mx-auto mt-4 pb-4">
                        <?php
                        // $qex = "SELECT * FROM main_category WHERE `mid` IN (SELECT product.`main_category_id` FROM product GROUP BY product.`main_category_id` HAVING COUNT(PRODUCT.`main_category_id`)>1)";

                        // // $resultsetex = $dbms->query($qex);

                        // $resultsetex = DB::search($qex);

                        // $exrow = $resultsetex->num_rows;
                        // for ($ex = 0; $ex < $exrow; $ex++) {
                        //       $dexmain = $resultsetex->fetch_assoc();
                        ?>
                        <div class="row pt-2 ">
                              <h4>Related Product</h4>
                              <div class="hedrow M-LR-A"></div>
                        </div>
                        <div class="row pd190sanpl">
                              <div class="col-12">
                                    <div class="row ">
                                          <!-- <div class="cardboxsample p-2 scroll4" onmouseover="doo(4);"> -->

                                          <?php
                                          $qexpro = "SELECT * FROM product INNER JOIN brand ON product.`brand_id`=brand.`bid` WHERE `main_category_id`='" . $d['main_category_id'] . "' AND product.`expire_date`>'" . $date . "' AND product.`delete`='0' ORDER BY `pid` DESC  LIMIT 6 ";
                                          // $resultsetexpro = $dbms->query($qexpro);

                                          $resultsetexpro = DB::search($qexpro);

                                          $exprorow = $resultsetexpro->num_rows;
                                          for ($pro = 0; $pro < $exprorow; $pro++) {
                                                $dprodu = $resultsetexpro->fetch_assoc();
                                                // if ($dprodu["bname"] == "none") {
                                                //       $dprodu["bname"] = "";
                                                // }
                                          ?>
                                                <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                                                      <div class="row p-1 h-100">
                                                            <a href="productpage.php?pid=<?php echo  $dprodu['pid'] ?>" class="text-decoration-none p-0 text-dark h-100">

                                                                  <div class=" samplecard col-12 mt-0 ">

                                                                        <table class="w-100 h-100">
                                                                              <tr>
                                                                                    <td>
                                                                                          <img src="<?php echo $dprodu["img"] ?>" class="cardimgsample w-100" />
                                                                                    </td>
                                                                              </tr>
                                                                              <tr>
                                                                                    <td class="desshort">
                                                                                          <?php echo $dprodu["title"] ?>

                                                                                    </td>
                                                                              </tr>
                                                                              <tr>
                                                                                    <td class="desshort">
                                                                                          Rs <?php echo $dprodu["price"] ?>.00
                                                                                          <?php
                                                                                          if ($dprodu["qty"] <= 0) {
                                                                                          ?>
                                                                                                <span class="text-danger">&nbsp;Out of stock</span>
                                                                                          <?php
                                                                                          } else {
                                                                                          ?>
                                                                                                <span class="text-success">&nbsp;In stock</span>

                                                                                          <?php
                                                                                          }
                                                                                          ?>
                                                                                    </td>
                                                                              </tr>
                                                                        </table>
                                                                  </div>
                                                            </a>
                                                      </div>
                                                </div>
                                          <?php

                                          }
                                          ?>

                                          <!-- </div> -->
                                    </div>
                              </div>


                        </div>

                        <?php
                        // }
                        ?>


                  </div>
            </div>
            <div class="row pt-2">
                  <div class="col-12 col-xl-11 bg-white mx-auto">
                        <div class="row d-block me-0 ms-0 mt-4 p-2">
                              <div class="col-md-6">
                                    <span class="fs-3 fw-bold">Product Details</span>
                              </div>
                        </div>
                  </div>
                  <div class="col-12 col-xl-11 bg-white  mx-auto">
                        <div class="row p-4">
                              <div class="col-12">

                                    <div class="row">

                                          <div class="col-3 col-lg-2">
                                                <label class="form-label fw-bold">Brand</label>
                                          </div>
                                          <div class="col-5 col-lg-2">
                                                <label class="form-label"><?php echo $d["bname"] ?></label>
                                          </div>
                                    </div>
                              </div>
                              <div class="col-12">

                                    <div class="row">

                                          <div class="col-3 col-lg-2">
                                                <label class="form-label fw-bold">Name</label>
                                          </div>
                                          <div class="col-5 col-lg-2">
                                                <label class="form-label"><?php echo $d["model"] ?></label>
                                          </div>
                                    </div>

                              </div>
                              <div class="col-12">

                                    <div class="row">
                                          <?php
                                          if (!empty($d["description"])) {
                                          ?>
                                                <div class="col-3 col-lg-2">
                                                      <label class="form-label fw-bold">Description</label>
                                                </div>
                                                <div class="col-12 col-lg-10">
                                                      <label class="form-label"><?php echo $d["description"] ?></label>
                                                </div>

                                          <?php
                                          }
                                          ?>

                                    </div>

                              </div>
                        </div>
                  </div>
            </div>

            <?php
            $feedrs = DB::search("SELECT * FROM `feedback` INNER JOIN `user` ON feedback.`user_id`=user.`id` WHERE `product_pid`='" . $d["pid"] . "'");
            $fn = $feedrs->num_rows;
            if ($fn >= 1) {
            ?>
                  <div class="row pt-2">
                        <div class="col-12 col-xl-11 bg-white  mx-auto">
                              <div class="row d-block me-0 ms-0 mt-4 p-2">
                                    <div class="col-md-6">
                                          <span class="fs-3 fw-bold">Reviews</span>
                                    </div>
                              </div>
                        </div>
                        <div class="col-12 col-xl-11 bg-white  mx-auto">
                              <div class="row p-4 ">
                                    <?php

                                    for ($i = 0; $i < $fn; $i++) {
                                          $feed = $feedrs->fetch_assoc();
                                    ?>
                                          <div class="col-12 col-lg-6 col-xxl-4 ">
                                                <div class="row px-2 ">
                                                      <div class="col-12  p-2 px-3 border">
                                                            <span class=" fw-bold"><?php echo  $feed["first_name"] . " " . $feed["last_name"] ?></span>
                                                            <br />
                                                            <span class=""><?php echo $feed["feed"] ?></span><br />
                                                            <span class="smtext text-black-50"><?php echo $feed["date"] ?></span>

                                                      </div>
                                                </div>

                                          </div>
                                    <?php
                                    }
                                    ?>


                              </div>
                        </div>
                  </div>
            <?php
            }
            ?>
            <?php
            FOOT::footview("normal");
            ?>
            <div aria-live="polite" aria-atomic="true" class="position-relative bottom-0 end-0">

                  <div class="toast-container position-fixed bottom-0 end-0 p-3 pe-1" id="boxnoteID">



                  </div>
            </div>
      </div>





      <script src="bootstrap.min.js"></script>
      <script src="navhider.js"></script>
      <script src="jquery//jquery.min.js"></script>
      <script src="commen.js"></script>

      <script src="productpage.js"></script>
</body>

</html>