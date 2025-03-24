<?php
session_start();
require "database.php";
if (isset($_SESSION["userdata"]["id"])) {

      if (isset($_POST["pid"]) && isset($_POST["qty"])) {
            $pid = $_POST["pid"];
            $qty = $_POST["qty"];
            if ($qty < 1) {
                  $qty = 1;
            }
            $q = "SELECT * FROM user   LEFT JOIN user_address ON user.`id`=user_address.`user_id`
            LEFT JOIN district ON user_address.`district_id`=district.`district_id` LEFT JOIN `dilevery_fee` ON district.`district_id`= dilevery_fee.`district_id`
              WHERE `id`='" . $_SESSION["userdata"]["id"] . "'";

            $resultset = DB::search($q);
            $d2 = $resultset->fetch_assoc();
            $quriarCharge = $d2["fee"];
            if (!empty($pid) && !empty($qty)) {
                  $q = "UPDATE cart SET `cqty`='" . $qty . "' WHERE `product_pid`='" . $pid . "' AND `user_id`='" . $_SESSION["userdata"]["id"] . "'";
                  DB::iud($q);
            }
      }


?>
      <div class="row px-2 pt-2">
            <h4>Summary</h4>
      </div>
      <table class="priceicng w-100 mb-3">
            <tr class="proprice">

                  <?php
                  $q = "SELECT cart.`cqty` ,product.`price` FROM cart JOIN product ON cart.`product_pid`=product.`pid`  WHERE cart.`user_id`='" . $_SESSION["userdata"]["id"] . "'";
                  $resultset = DB::search($q);
                  $r = $resultset->num_rows;
                  $d1 = "";
                  $pricecart = 0;
                  for ($x = 0; $x < $r; $x++) {
                        $d1 = $resultset->fetch_assoc();
                        $pricecart = $pricecart + ($d1["price"] * $d1["cqty"]);
                  }
                  ?>
                  <td>Sub Total</td>
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
                  <td colspan="2" class="w-100  pt-4">
                        <button class="w-100 cheoutbtn" onclick="gocheackout();">Checkout</button>
                  </td>

            </tr>
      </table>

<?php
} else {
      echo "Please Login";
}
?>