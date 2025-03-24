<?php
session_start();
if (isset($_SESSION["userdata"]["id"])) {
      $user_id = $_SESSION["userdata"]["id"];
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
            <title>Wishlist</title>
            <link rel="icon" href="cssfile//baclogoimg//logo2.png" />

            <link rel="stylesheet" href="cssfile//icofont.min.css" />
            <link rel="stylesheet" href="cssfile//bootstrap.css" />
            <link rel="stylesheet" href="cssfile//wishlist.css" />
            <link rel="stylesheet" href="cssfile//head.css" />
            <link rel="stylesheet" href="cssfile//foot.css" />



      </head>

      <body>
            <div class="container-fluid">
                  <?php

                  HD::headview("whislist");
                  ?>
                  <div class="row mattop " style="min-height: 590px;">
                        <?php
                        if (isset($_SESSION["userdata"]["id"])) {
                              $user_id = $_SESSION["userdata"]["id"];

                              $q = "SELECT * FROM wishlist INNER JOIN product ON wishlist.`product_pid`=product.`pid` INNER JOIN brand ON product.`brand_id`=brand.`bid` WHERE wishlist.`user_id`='" . $user_id . "' ";
                              $resultset = DB::search($q);
                              if ($resultset->num_rows >= 1) {
                        ?>

                                    <div class="col-12 col-md-9 col-lg-12 col-xl-11 heigt480 col-xxl-10 m-auto">
                                          <div class="row" id="boxwishcard">

                                                <!-- cards  -->

                                                <?php
                                                for ($i = 0; $i < $resultset->num_rows; $i++) {
                                                      $d = $resultset->fetch_assoc();
                                                ?>
                                                      <div class="col-12 col-md-12 col-lg-6">

                                                            <div class="row p-2 p-md-3 px-lg-1 px-xl-3">
                                                                  <div class="col-12 wishcard ">
                                                                        <div class="row  p-2 pb-3">

                                                                              <div class="col-5 col-md-4 m-auto p-0 position-relative">
                                                                                    <?php
                                                                                    if ($d["delete"] == "1" || $d["expire_date"] < $date) {
                                                                                    ?>
                                                                                          <div class="w-100 h-100 position-absolute text-center d-flex align-content-center notavailablediv ">
                                                                                                <span class="m-auto fs-4 text-white">Not Available</span>
                                                                                          </div>
                                                                                    <?php
                                                                                    } else if ($d["qty"] == "0") {
                                                                                    ?>
                                                                                          <div class="w-100 h-100 position-absolute text-center d-flex align-content-center notavailablediv ">
                                                                                                <span class="m-auto fs-4 text-white">Out of Stock</span>
                                                                                          </div>
                                                                                    <?php
                                                                                    }

                                                                                    ?>
                                                                                    <a href="productpage.php?pid=<?php echo $d['pid'] ?>" class="text-decoration-none">
                                                                                          <img src="<?php echo $d['img'] ?>" class="w-100" />
                                                                                    </a>

                                                                              </div>
                                                                              <div class="col-7 col-md-8">
                                                                                    <div class="row h-100 p-2 ps-md-4">
                                                                                          <h4 class="d-line"><?php echo $d['title'] ?></h4>

                                                                                          <table class="h-75 w-100 m-auto detailswish">
                                                                                                <tr>
                                                                                                      <td class="w-50">
                                                                                                            price
                                                                                                      </td>
                                                                                                      <td>
                                                                                                            Rs : <?php echo number_format($d['price'], 2)  ?>
                                                                                                      </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                      <td>
                                                                                                            In Stock
                                                                                                      </td>
                                                                                                      <?php
                                                                                                      if ($d["delete"] == "1" || $d["expire_date"] < $date) {
                                                                                                      ?>
                                                                                                            <td>
                                                                                                                  0
                                                                                                            </td>
                                                                                                      <?php
                                                                                                      } else {
                                                                                                      ?>
                                                                                                            <td>
                                                                                                                  <?php echo $d['qty'] ?>
                                                                                                            </td>
                                                                                                      <?php
                                                                                                      }
                                                                                                      ?>
                                                                                                </tr>
                                                                                                <tr>

                                                                                                      <?php
                                                                                                      if ($d["expire_date"] < $date) {
                                                                                                      ?>
                                                                                                            <td class="text-danger" colspan="2">
                                                                                                                  Expired
                                                                                                            </td>
                                                                                                      <?php
                                                                                                      } else if ($d["expire_date"] != "9999-12-20") {
                                                                                                      ?>
                                                                                                            <td>
                                                                                                                  Expirdate
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                  <?php echo $d['expire_date'] ?>
                                                                                                            </td>
                                                                                                      <?php
                                                                                                      } else {
                                                                                                      ?>
                                                                                                            <td>

                                                                                                            </td>
                                                                                                            <td>

                                                                                                            </td>
                                                                                                      <?php
                                                                                                      }
                                                                                                      ?>

                                                                                                </tr>
                                                                                                <tr>

                                                                                                      <td class="p-md-2">
                                                                                                            <?php
                                                                                                            if ($d["delete"] == "1" || $d["qty"] == "0" || $d["expire_date"] < $date) {
                                                                                                            ?>
                                                                                                                  <button class="btn bluco w-100 addcart" disabled><i class="icofont-cart"></i> </button>

                                                                                                            <?php
                                                                                                            } else {
                                                                                                            ?>
                                                                                                                  <button class="btn bluco w-100 addcart" onclick="addCartCom(<?php echo $d['pid'] ?>)"><i class="icofont-cart"></i> </button>

                                                                                                            <?php
                                                                                                            }
                                                                                                            ?>
                                                                                                      </td>
                                                                                                      <td class="p-md-2">
                                                                                                            <button class="btn redco w-100 removebtn" onclick="wishremove(<?php echo $d['pid'] ?>);"><i class="icofont-bin"></i> </button>

                                                                                                      </td>
                                                                                                </tr>
                                                                                          </table>


                                                                                    </div>



                                                                              </div>
                                                                        </div>
                                                                  </div>

                                                            </div>
                                                      </div>

                                                <?php

                                                }
                                                ?>


                                          </div>
                                    </div>
                              <?php
                              } else {
                              ?>
                                    <div class="col-12 m-auto text-center p-5">
                                          <span class="m-auto fs-5">There are no items in Wishlist </span>
                                          <br />
                                          <a href="index.php" class="btn silever mt-3 fs-6 px-4">Continue Shopping</a>
                                    </div>
                              <?php
                              }
                              ?>
                        <?php

                        } else {
                        ?>
                              <div class="text-center ">
                                    <table class="m-auto heigt480">
                                          <tr>
                                                <td class=" h-100">Please Login to See Your Wishlist</td>
                                          </tr>
                                    </table>

                              </div>
                        <?php
                        }


                        ?>
                  </div>
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
            <script src="wishRemove.js"></script>
            <script src="commen.js"></script>

      </body>

      </html>
<?php

} else {
?>
      <script src="commen.js"></script>
      <script>
            login();
      </script>
<?php
}
