<?php
session_start();
require "database.php";
if (isset($_SESSION["userdata"])) {

      // $uid = $_SESSION["userdata"]["id"];



      $invoid = $_POST["orderid"];
      $uid = $_POST["uid"];

      $mobile = $_POST["mobile"];
      $addno = $_POST["an"];
      $addline1 = $_POST["a1"];
      $addline2 = $_POST["a2"];
      $district = $_POST["ac"];
      $postalcode = $_POST["postal"];



      $q = "SELECT * FROM `cart` INNER JOIN `product` ON cart.`product_pid`=product.`pid` WHERE `user_id`='" . $uid . "'";
      $resultset = DB::search($q);
      $nrow = $resultset->num_rows;

      date_default_timezone_set("Asia/Colombo");
      $time = date("h:i:s");
      $date = date("Y-m-d");
      $q = "INSERT INTO invo (`invoid`,`date_purchased`,`time_purchased`,`user_uid`) VALUES ('" . $invoid . "','" . $date . "','" . $time . "','" . $uid . "')";
      DB::iud($q);
      for ($i = 0; $i < $nrow; $i++) {
            $d1 = $resultset->fetch_assoc();
            $qtypro = $d1["qty"];
            $qty = $d1["cqty"];
            $pid = $d1["pid"];
            $q = "INSERT INTO user_has_product (`invo_id`,`product_pid`,`oqty`) VALUES ('" . $invoid . "','" . $pid . "','" . $qty . "')";
            DB::iud($q);
            $newqty = $qtypro - $qty;
            $q = "UPDATE product SET `qty`='" . $newqty . "' WHERE  `pid`='" . $pid . "'";
            DB::iud($q);
      }


      $haveAddress = DB::search("SELECT * FROM `user` INNER JOIN   `user_address` ON user.`id`=user_address.`user_id`  WHERE `user_id`='" . $uid . "' AND `address_no`='" . $addno . "' AND `address_line1`='" . $addline1 . "'
            AND `address_line2`='" . $addline2 . "' AND `district_id`='" . $district . "' AND `mobile`='" . $mobile . "'AND `postalcode`='" . $postalcode . "'");

      if ($haveAddress->num_rows == 0) {
            $haveDelAddress = DB::search("SELECT * FROM `delivery_info` WHERE `address_no`='" . $addno . "' AND `address_line1`='" . $addline1 . "'
                  AND `address_line2`='" . $addline2 . "' AND `district_id`='" . $district . "' AND `mobile`='" . $mobile . "'AND `postalcode`='" . $postalcode . "'");

            if ($haveDelAddress->num_rows == 0) {
                  DB::iud("INSERT INTO `delivery_info`(`mobile`,`address_no`,`address_line1`,`address_line2`,`postalcode`,`district_id`) VALUES
                        ('" . $mobile . "','" . $addno . "','" . $addline1 . "','" . $addline2 . "','" . $postalcode . "','" . $district . "') ");
                  $last_id = DB::$dbms->insert_id;
                  // echo $last_id;
                  DB::iud("INSERT INTO `invoce_delivary_address`(`invoid`,`delivery_info_id`) VALUES ('" . $invoid . "','" . $last_id . "')");
            } else {
                  $del_id = $haveDelAddress->fetch_assoc();
                  DB::iud("INSERT INTO `invoce_delivary_address`(`invoid`,`delivery_info_id`) VALUES ('" . $invoid . "','" . $del_id["d_add"] . "')");
            }
      }




      echo "succes";
}
