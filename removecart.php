<?php
session_start();

?>

<div class="col-12 col-md-10 m-auto  mt-lg-0 col-lg-6 col-xxl-5 me-xxl-0 ms-xxl-auto">
      <div class="row p-1 p-md-3  px-lg-1 px-xl-3">
            <div class="col-12" id="productbox">

                  <?php
                  require "database.php";
                  date_default_timezone_set("Asia/Colombo");
                  $date = date("Y-m-d");
                  if (isset($_POST["pid"]) || !empty($_POST["pid"])) {
                        $q = "SELECT * FROM user   LEFT JOIN user_address ON user.`id`=user_address.`user_id`
                        LEFT JOIN district ON user_address.`district_id`=district.`district_id` LEFT JOIN `dilevery_fee` ON district.`district_id`= dilevery_fee.`district_id`
                          WHERE `id`='" . $_SESSION["userdata"]["id"] . "'";

                        $resultset = DB::search($q);
                        $d2 = $resultset->fetch_assoc();
                        $quriarCharge = $d2["fee"];

                        $pid = $_POST["pid"];
                        $user = $_SESSION["userdata"]["id"];
                        $q = "SELECT * FROM cart WHERE `product_pid`='" . $pid . "'AND `user_id`='" . $user . "'";
                        $result = DB::search($q);
                        $r = $result->num_rows;
                        if ($r == 1) {
                              $q = "DELETE FROM cart WHERE `product_pid`='" . $pid . "' AND `user_id`='" . $user . "'";
                              DB::iud($q);
                        }
                  }

                  $q = "SELECT cart.`cqty`,brand.`bname`,product.`title`,product.`price`,product.`img`,product.`delete`,product.`expire_date`,product.`qty`, cart.`product_pid` FROM cart JOIN product ON cart.`product_pid`=product.`pid` JOIN brand ON product.`brand_id`=brand.`bid` WHERE `user_id`='" . $_SESSION["userdata"]["id"] . "'";
                  $resultset = DB::search($q);
                  $r = $resultset->num_rows;
                  $d1 = "";
                  for ($x = 0; $x < $r; $x++) {
                        $d1 = $resultset->fetch_assoc();
                  ?>
                        <div class="row pe-2 ps-2 pe-md-3 ps-md-3 pt-2 ">

                              <div class="col-12  maindiv ">
                                    <div class="row p-3 procheoutbox h-100">

                                          <div class="col-4 cheackoutimgdiv position-relative" style="background-image: url('<?php echo $d1['img'] ?>');">
                                                <?php
                                                if ($d1["delete"] == "1" || $d1["expire_date"] < $date) {
                                                ?>
                                                      <div class="row text-center notavailablediv ">
                                                            <span class="m-auto fs-4 text-white">Not Available</span>
                                                      </div>
                                                <?php
                                                } else if ($d1["qty"] == "0") {
                                                ?>
                                                      <div class="row text-center notavailablediv ">
                                                            <span class="m-auto fs-4 text-white">Out of Stock</span>
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
                                                                        <input type="number" value="<?php echo $d1["cqty"] ?>" id="qty<?php echo $d1['product_pid'] ?>" max="<?php echo $d1["qty"] ?>" min="1" onchange="qtyChange(<?php echo $d1['product_pid'] ?>);" class="qtyinput" disabled />
                                                                  <?php
                                                                  } else {
                                                                  ?>
                                                                        <input type="number" value="<?php echo $d1["cqty"] ?>" id="qty<?php echo $d1['product_pid'] ?>" max="<?php echo $d1["qty"] ?>" min="1" onchange="qtyChange(<?php echo $d1['product_pid'] ?>);" class="qtyinput" />

                                                                  <?php
                                                                  }
                                                                  ?>
                                                            </td>
                                                      </tr>
                                                      <tr>
                                                            <td>Price</td>

                                                            <td>Rs: <?php echo number_format($d1["price"], 2) ?> x <span id="qtyview<?php echo $d1['product_pid'] ?>"><?php echo $d1["cqty"] ?></span></td>
                                                      </tr>
                                                      <tr>
                                                            <td>Delivery</td>

                                                            <td>Est.2-4 days</td>
                                                      </tr>
                                                      <tr>
                                                            <td class="p-2">
                                                                  <?php
                                                                  if ($d1["delete"] == "1" || $d1["qty"] == "0" || $d1["expire_date"] < $date) {
                                                                  ?>
                                                                        <button class="btn orangco text-white w-100 buybtn" id="wishbtnID<?php echo $d1['product_pid'] ?>" disabled><i class="icofont-prestashop"></i> </button>

                                                                  <?php
                                                                  } else {
                                                                  ?>
                                                                        <button class="btn orangco text-white w-100 buybtn" onclick="caheckoutcart(<?php echo $d1['product_pid'] ?>);" id="wishbtnID<?php echo $d1['product_pid'] ?>"><i class="icofont-prestashop"></i> </button>
                                                                  <?php
                                                                  }
                                                                  ?>
                                                            </td>


                                                            <td class="p-2"><button class="btn removebtn w-100 removebtn" id="removebtnID<?php echo $d1['product_pid'] ?>" onclick="removeFromCart(<?php echo $d1['product_pid'] ?>);"><i class="icofont-bin"></i> </button></td>
                                                      </tr>
                                                </table>

                                          </div>

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
if ($r >= 1) {

?>
      <div class="col-12 col-md-10  m-auto m-lg-0 col-lg-6 col-xxl-5 me-xxl-auto ms-xxl-0">

            <div class="row p-1 p-md-3 px-lg-1 px-xl-3">
                  <div class="col-12">
                        <div class="row pe-2 ps-2 pe-md-3 ps-md-3 pt-2 ">
                              <div class="col-12  pt-2 pb-3 mb-3 maindiv ">


                                    <div class="col-12 p-0  " id="totalpriceboxID">
                                          <div class="row px-2 pt-2">
                                                <h4>Summary</h4>
                                          </div>
                                          <table class="priceicng w-100 mb-3">
                                                <tr class="proprice">

                                                      <?php
                                                      $q = "SELECT cart.`cqty`,product.`price` FROM cart JOIN product ON cart.`product_pid`=product.`pid`  WHERE cart.`user_id`='" . $_SESSION["userdata"]["id"] . "'";
                                                      $resultset = DB::search($q);
                                                      $r = $resultset->num_rows;
                                                      $d1 = "";
                                                      $pricecart = 0;
                                                      for ($x = 0; $x < $r; $x++) {
                                                            $d1 = $resultset->fetch_assoc();
                                                            $pricecart = $pricecart + ($d1["price"] * $d1["cqty"]);
                                                      }
                                                      ?>
                                                      <td>Product Price</td>
                                                      <td>Rs: <?php echo number_format($pricecart, 2) ?></td>

                                                </tr>
                                                <tr class="delivery">
                                                      <td>Delivery Charge</td>
                                                      <?php
                                                      if (empty($quriarCharge)) {
                                                      ?>
                                                            <td>Not Estimate </td>

                                                      <?php
                                                      } else {
                                                      ?>
                                                            <td>Rs: <?php echo number_format($quriarCharge, 2) ?> </td>
                                                      <?php
                                                      }
                                                      ?>
                                                </tr>
                                                <tr class="total">
                                                      <td>Total</td>
                                                      <td>Rs: <?php echo number_format($pricecart + $quriarCharge, 2) ?></td>

                                                </tr>
                                                <tr>
                                                      <td colspan="2" class="w-100 pt-4">
                                                            <button class="w-100 cheoutbtn" onclick="gocheackout();">Checkout</button>
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
} else {
?>

      <div class="col-12 text-center p-5" style="height: 330px;margin-top: 130px;">
            <span class="m-auto fs-5">There are no items in this cart</span>
            <br />
            <a href="index.php" class="btn silever mt-3 px-4 fs-6">Continue Shopping</a>
      </div>
<?php
}
