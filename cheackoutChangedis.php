<?php
session_start();
require "database.php";
if (isset($_POST["pid"]) && isset($_POST["qty"])) {
      $pid = $_POST["pid"];
      $qty = $_POST["qty"];
      $newDadd = $_POST["dis"];
      if ($qty < 1) {
            $qty = 1;
      }
      $q = "SELECT * FROM product JOIN brand ON product.`brand_id`=brand.`bid` WHERE `pid`='" . $pid . "'";
      $resultset = DB::search($q);
      $r = $resultset->num_rows;
      if ($r == 1) {

            $q = "SELECT * FROM  `dilevery_fee` WHERE `district_id`='" . $newDadd . "'";

            $del = DB::search($q);
            $quriarCharge;
            if ($del->num_rows == 1) {

                  $d2 = $del->fetch_assoc();
                  $quriarCharge = $d2["fee"];
            } else {
                  $quriarCharge = 0;
            }

            $d1 = $resultset->fetch_assoc();

?>
            <table class="priceicng w-100 mb-3">
                  <tr class="proprice">
                        <td>Sub Total</td>
                        <td>Rs: <?php echo number_format($d1["price"] * $qty, 2) ?></td>

                  </tr>
                  <tr class="delivery">
                        <td>Delivery Charge</td>
                        <?php
                        if ($del->num_rows == 1) {

                        ?>
                              <td>Rs: <?php echo number_format($quriarCharge, 2) ?></td>
                        <?php
                        } else {
                        ?>
                              <td>Not Estimate</td>

                        <?php
                        }
                        ?>
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
} else {
      echo "none";
}


?>