<?php
session_start();
require "database.php";
if (isset($_SESSION["userdata"])) {

      // $uid = $_SESSION["userdata"]["id"];



      $invoid = $_POST["orderid"];
      $uid = $_POST["uid"];
      $packid = $_POST["pid"];

      $mobile = $_POST["mobile"];
      $addno = $_POST["an"];
      $addline1 = $_POST["a1"];
      $addline2 = $_POST["a2"];
      $district = $_POST["ac"];
      $postalcode = $_POST["postal"];

      $qf = "SELECT * FROM package  WHERE `pack_id`='" . $packid . "'";

      $resultsetf = DB::search($qf);
      $packd;
      if ($resultsetf->num_rows == 1) {
            $packd = $resultsetf->fetch_assoc();
      }
      $q3 = "SELECT SUM(product.`price`) AS `total_price` FROM pack_product INNER JOIN product ON pack_product.`product_pid`=product.`pid` 
      WHERE pack_product.`package_id`='" . $packid . "' ";
        $resultsetIn = DB::search($q3);
        $dis;
        if ($resultsetIn->num_rows == 1) {
            $din = $resultsetIn->fetch_assoc();
            $realPrice = $din["total_price"];
            $dis= ceil($realPrice * ($packd["discount"] / 100));

        }
      $q = "SELECT * FROM package INNER JOIN pack_product ON package.`pack_id`=pack_product.`package_id` INNER JOIN product ON pack_product.`product_pid`=product.`pid`  WHERE `pack_id`='" . $packid . "'";

      $resultset = DB::search($q);
      $nrow = $resultset->num_rows;

      date_default_timezone_set("Asia/Colombo");
      $time = date("h:i:s");
      $date = date("Y-m-d");
      $q = "INSERT INTO invo (`invoid`,`date_purchased`,`time_purchased`,`user_uid`,`discount`) VALUES ('" . $invoid . "','" . $date . "','" . $time . "','" . $uid . "','" . $dis . "')";
      DB::iud($q);
      for ($i = 0; $i < $nrow; $i++) {
            $d1 = $resultset->fetch_assoc();
            $qtypro = $d1["qty"];
            $qty = 1;
            $pid = $d1["pid"];
            $q = "INSERT INTO user_has_product (`invo_id`,`product_pid`,`oqty`) VALUES ('" . $invoid . "','" . $pid . "','" . $qty . "')";
            DB::iud($q);
            $newqty = $qtypro - $qty;
            $q = "UPDATE product SET `qty`='" . $newqty . "' WHERE  `pid`='" . $pid . "'";
            DB::iud($q);
            // echo $d1["pid"];
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
