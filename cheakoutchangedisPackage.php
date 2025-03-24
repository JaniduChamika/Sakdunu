<?php
session_start();
require "database.php";
if (isset($_SESSION["userdata"]["id"])) {
      $newDadd = $_POST["dis"];
      $packid = $_POST["pid"];
      $q = "SELECT * FROM  `dilevery_fee` WHERE `district_id`='" . $newDadd . "'";

      $del = DB::search($q);
      if ($del->num_rows == 1) {

            $d2 = $del->fetch_assoc();
            $quriarCharge = $d2["fee"];
      } else {
            $quriarCharge = 0;
      }
      // if (isset($_POST["pid"]) && isset($_POST["qty"])) {
      //       $pid = $_POST["pid"];
      //       $qty = $_POST["qty"];
      //       if ($qty < 1) {
      //             $qty = 1;
      //       }

      //       if (!empty($pid) && !empty($qty)) {
      //             $q = "UPDATE cart SET `cqty`='" . $qty . "' WHERE `product_pid`='" . $pid . "' AND `user_id`='" . $_SESSION["userdata"]["id"] . "'";
      //             DB::iud($q);
      //       }
      // }


?>
      <div class="row px-3 pt-1">
            <h4>Summary</h4>
      </div>
      <table class="priceicng w-100 mb-3">
            <tr class="proprice">

                  <?php
                  $q = "SELECT * FROM package INNER JOIN pack_product ON package.`pack_id`=pack_product.`package_id` INNER JOIN product ON pack_product.`product_pid`=product.`pid`  WHERE `pack_id`='" . $packid . "'";
                  $resultset = DB::search($q);
                  $r = $resultset->num_rows;
                  $d1 = "";
                  $pricecart = 0;
                  for ($x = 0; $x < $r; $x++) {
                        $d1 = $resultset->fetch_assoc();
                        $pricecart = $pricecart + ($d1["price"]);
                  }
                  ?>
                  <td>Sub Total</td>
                  <td>Rs: <?php echo $pricecart ?>.00</td>

            </tr>
            <tr class="proprice">
                  <td>Discount</td>
                  <td>Rs: <?php
                              $q = "SELECT * FROM package WHERE `pack_id`='" . $packid . "'";
                              $resultset = DB::search($q);

                              $d = $resultset->fetch_assoc();
                              $dis = 0;
                              if ($d["discount"] != 0) {
                                    $dis = ceil($pricecart * ($d["discount"] / 100));
                              ?>
                              <?php echo number_format($dis, 2) ?>
                        <?php
                              } else {
                                    echo "0";
                              }
                        ?></td>

            </tr>
            <tr class="delivery">
                  <td>Delivery Charge</td>
                  <?php
                  if ($del->num_rows == 1) {
                  ?>
                        <td id="dileveryfeeID">Rs: <?php echo $quriarCharge ?>.00 </td>
                  <?php
                  } else {
                  ?>
                        <td id="dileveryfeeID">Not Estimate</td>

                  <?php
                  }
                  ?>
            </tr>
            <tr class="total">
                  <td>Total</td>
                  <td>Rs: <?php echo $pricecart + $quriarCharge - $dis ?>.00</td>

            </tr>
            <tr>
                  <td colspan="2" class="w-100">
                        <button class="w-100 fw-bold cheoutbtn" onclick="payPackage(<?php echo $packid  ?>);">Proceed to Pay</button>
                  </td>

            </tr>
      </table>

<?php
} else {
      echo "Please Login";
}
?>