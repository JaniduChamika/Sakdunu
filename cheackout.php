<?php
session_start();
require "database.php";
date_default_timezone_set("Asia/Colombo");
$date = date("Y-m-d");

if (isset($_GET["pid"])) {


      $id = $_GET["pid"];
      if (isset($_SESSION["userdata"]["id"])) {
            $q = "SELECT * FROM product JOIN brand ON product.`brand_id`=brand.`bid` WHERE `pid`='" . $id . "'";
            $resultset = DB::search($q);
            $r = $resultset->num_rows;
            $d1;
            $qty = "1";
            if (isset($_GET["q"])) {
                  $qty = $_GET["q"];
            }
            if ($r == 1) {
                  $d1 = $resultset->fetch_assoc();

?>
                  <!DOCTYPE html>
                  <html>

                  <head>
                        <meta charset="utf-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <title> Checkout </title>
                        <link rel="icon" href="cssfile//baclogoimg//logo2.png" />

                        <link rel="stylesheet" href="cssfile//icofont.min.css">
                        <link rel="stylesheet" href="cssfile//bootstrap.css" />

                        <link rel="stylesheet" href="cssfile//cheakout.css" />
                        <link rel="stylesheet" href="cssfile//commen.css" />



                  </head>

                  <body>
                        <div class="container-fluid">


                              <div class="row">
                                    <div class="col-12 col-md-10 m-auto m-lg-0 col-lg-6 col-xxl-5 ms-xxl-0 me-xxl-auto order-lg-last">
                                          <div class="row p-3">
                                                <div class="col-12">
                                                      <div class="row pe-2 ps-2 pe-md-3 ps-md-3 pt-2 ">
                                                            <div class="col-12  maindiv ">
                                                                  <div class="row pe-2 ps-2 p-md-3 p-md-3  procheoutbox ">

                                                                        <div class="col-4 p-0 h-100 cheackoutimgdiv position-relative" style="background-image: url('<?php echo $d1['img'] ?>');">

                                                                              <?php
                                                                              if ($d1["delete"] == "1" || $d1["expire_date"] < $date) {
                                                                              ?>
                                                                                    <div class=" position-absolute d-flex align-content-center notavailablediv text-center w-100 h-100">
                                                                                          <span class=" m-auto fs-4 text-white">Not Available</span>
                                                                                    </div>
                                                                              <?php
                                                                              } else if ($d1["qty"] == "0") {
                                                                              ?>
                                                                                    <div class=" position-absolute d-flex align-content-center notavailablediv text-center w-100 h-100">
                                                                                          <span class=" m-auto fs-4 text-white">Out of Stock</span>
                                                                                    </div>
                                                                              <?php
                                                                              }

                                                                              ?>
                                                                        </div>
                                                                        <div class="col-8 h-100  p-2 ">

                                                                              <table class="w-100 h-100">
                                                                                    <tr>
                                                                                          <th colspan="2"><?php echo $d1["title"]  ?></th>


                                                                                    </tr>
                                                                                    <tr>
                                                                                          <td>Quintity</td>

                                                                                          <td>
                                                                                                <?php
                                                                                                if ($d1["delete"] == "1" || $d1["expire_date"] < $date) {
                                                                                                ?>
                                                                                                      <input type="number" value="<?php echo $qty ?>" min="1" max="<?php echo $d1["qty"] ?>" onchange="qtyChange(<?php echo $id ?>);" id="qty" class="qtyinput ps-2" disabled />
                                                                                                <?php
                                                                                                } else {
                                                                                                ?>
                                                                                                      <input type="number" value="<?php echo $qty ?>" min="1" max="<?php echo $d1["qty"] ?>" onchange="qtyChange(<?php echo $id ?>);" id="qty" class="qtyinput ps-2" />

                                                                                                <?php
                                                                                                }
                                                                                                ?>
                                                                                          </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                          <td>Price</td>

                                                                                          <td>Rs: <?php echo number_format($d1["price"], 2) ?> x <span id="qtyview"> <?php echo $qty ?></span></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                          <td>Delivery</td>

                                                                                          <td>Est.2-4 days</td>
                                                                                    </tr>
                                                                              </table>

                                                                        </div>

                                                                  </div>


                                                            </div>

                                                      </div>
                                                </div>

                                          </div>
                                    </div>
                                    <div class="col-12 col-md-10  m-auto m-lg-0 col-lg-6 col-xxl-5 me-xxl-0 ms-xxl-auto">

                                          <div class="row p-3">
                                                <div class="col-12">
                                                      <div class="row pe-2 ps-2 pe-md-3 ps-md-3 pt-2 ">
                                                            <div class="col-12  pt-2 pb-3 mb-3 maindiv ">
                                                                  <h4>
                                                                        Delivery infomation
                                                                  </h4>
                                                                  <?php

                                                                  $q = "SELECT * FROM user   LEFT JOIN user_address ON user.`id`=user_address.`user_id`
                                                                        LEFT JOIN district ON user_address.`district_id`=district.`district_id` LEFT JOIN `dilevery_fee` ON district.`district_id`= dilevery_fee.`district_id`
                                                                        WHERE `id`='" . $_SESSION["userdata"]["id"] . "'";

                                                                  $resultset = DB::search($q);
                                                                  $d2 = $resultset->fetch_assoc();
                                                                  $quriarCharge = $d2["fee"];

                                                                  ?>
                                                                  <table class="delinfo w-100">
                                                                        <tr>
                                                                              <td>

                                                                                    Name
                                                                              </td>


                                                                        </tr>
                                                                        <tr>
                                                                              <td>
                                                                                    <input type="text" id="fnameID" class="w-100" value="<?php echo $d2["first_name"] ?>" placeholder="First Name" readonly />
                                                                              </td>
                                                                              <td>
                                                                                    <input type="text" id="lnameID" class="w-100" value="<?php echo  $d2["last_name"] ?>" placeholder="Last Name" readonly />

                                                                              </td>

                                                                        </tr>
                                                                        <tr>
                                                                              <td>
                                                                                    Mobile Number
                                                                              </td>
                                                                              <td>
                                                                                    Address No
                                                                              </td>


                                                                        </tr>
                                                                        <tr>
                                                                              <td>
                                                                                    <input type="text" id="mobile" class="w-100" placeholder="Contact No" value="<?php echo $d2['mobile'] ?>" />
                                                                              </td>
                                                                              <td>
                                                                                    <input type="text" id="add_no" class="w-100" placeholder="213/w" value="<?php echo $d2['address_no'] ?>" />
                                                                              </td>

                                                                        </tr>
                                                                        <tr>
                                                                              <td>
                                                                                    Address line 1
                                                                              </td>
                                                                              <td>
                                                                                    Address line 2
                                                                              </td>


                                                                        </tr>
                                                                        <tr>
                                                                              <td>
                                                                                    <input type="text" id="addline1" class="w-100" placeholder="Address line 1" value="<?php echo $d2['address_line1'] ?>" />
                                                                              </td>
                                                                              <td>
                                                                                    <input type="text" id="addline2" class="w-100" placeholder="Address line 2" value="<?php echo $d2['address_line2'] ?>" />
                                                                              </td>

                                                                        </tr>
                                                                        <tr>
                                                                              <td>
                                                                                    District
                                                                              </td>
                                                                              <td>
                                                                                    Postal Code
                                                                              </td>

                                                                        </tr>
                                                                        <tr>
                                                                              <td>

                                                                                    <select class="w-100" id="cityID" onchange="dFeechange(<?php echo $id ?>);">
                                                                                          <option value="none">Select District</option>

                                                                                          <?php

                                                                                          $q = "SELECT * FROM district ;";
                                                                                          // $resultset = $dbms->query($q);

                                                                                          $resultset = DB::search($q);
                                                                                          $r = $resultset->num_rows;
                                                                                          ?>

                                                                                          <?php
                                                                                          for ($i = 0; $i < $r; $i++) {
                                                                                                $d = $resultset->fetch_assoc();
                                                                                                if ($d["district_id"] == $d2["district_id"]) {
                                                                                          ?>

                                                                                                      <option value="<?php echo $d["district_id"] ?>" selected><?php echo $d["cname"] ?></option>
                                                                                                <?php
                                                                                                } else {
                                                                                                ?>

                                                                                                      <option value="<?php echo $d["district_id"] ?>"><?php echo $d["cname"] ?></option>
                                                                                          <?php
                                                                                                }
                                                                                          } ?>



                                                                                    </select>
                                                                              </td>
                                                                              <td>
                                                                                    <input type="text" id="postcodeID" class="w-100" value="<?php echo $d2["postalcode"] ?>" placeholder="City Postal Code" />
                                                                              </td>
                                                                        </tr>
                                                                  </table>
                                                            </div>
                                                            <div class="col-12 px-2 checkoutbox " id="totalPriceBoxID">
                                                                  <?php
                                                                  $q = "SELECT * FROM product INNER JOIN brand ON product.`brand_id`=brand.`bid` WHERE `pid`='" . $id . "'";
                                                                  $resultset = DB::search($q);
                                                                  $r = $resultset->num_rows;
                                                                  if ($r == 1) {

                                                                        $d1 = $resultset->fetch_assoc();

                                                                  ?>
                                                                        <table class="priceicng w-100 mb-3">
                                                                              <tr class="proprice">
                                                                                    <td>Sub Total</td>
                                                                                    <td>Rs: <?php echo number_format($d1["price"] * $qty, 2) ?></td>

                                                                              </tr>
                                                                              <tr class="delivery">
                                                                                    <td>Delivery Charge</td>
                                                                                    <td id="dileveryfeeID">Rs: <?php echo number_format($quriarCharge, 2) ?></td>

                                                                              </tr>
                                                                              <tr class="total">
                                                                                    <td>Total</td>
                                                                                    <td>Rs: <?php echo number_format($d1["price"] * $qty + $quriarCharge, 2)  ?></td>

                                                                              </tr>
                                                                              <tr>
                                                                                    <td colspan="2" class="w-100">
                                                                                          <button class="w-100 fw-bold cheoutbtn" onclick="pay(<?php echo $d1['pid'] ?>);">Proceed to Pay</button>
                                                                                    </td>

                                                                              </tr>
                                                                        </table>
                                                                  <?php
                                                                  }
                                                                  ?>
                                                            </div>
                                                      </div>
                                                </div>
                                          </div>
                                    </div>

                              </div>

                              <div aria-live="polite" aria-atomic="true" class="position-relative bottom-0 end-0">

                                    <div class="toast-container position-fixed bottom-0 end-0  p-3" id="boxnoteID">



                                    </div>
                              </div>
                        </div>





                        <script src="bootstrap.min.js"></script>
                        <script src="checkout.js"></script>
                        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
                  </body>

                  </html>
            <?php
            } else {
            ?>
                  <script src="commen.js"></script>

                  <script>
                        goBack();
                  </script>
            <?php
            }
      } else {
            ?>

            <script src="commen.js"></script>

            <script>
                  login();
            </script>
      <?php
      }
} else {
      ?>
      <script src="commen.js"></script>

      <script>
            goIndex();
      </script>
<?php
}
?>