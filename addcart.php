<?php
session_start();
require "database.php";
if (isset($_POST["pid"]) && isset($_POST["qty"])) {
      $pid = $_POST["pid"];
      $qty = $_POST["qty"];
      if (isset($_SESSION["userdata"]["id"])) {


            $user = $_SESSION["userdata"]["id"];

            $q = "SELECT * FROM product WHERE `pid`='" . $pid . "'";
            $result = DB::search($q);
            $r = $result->num_rows;
            $d;

            $q = "SELECT * FROM cart WHERE `product_pid`='" . $pid . "' AND `user_id`='" . $user . "'";
            $resultprv = DB::search($q);
            $rrev = $resultprv->num_rows;

            if ($r == 1) {
                  $d = $result->fetch_assoc();
            }
            if (empty($pid)) {
                  echo "not regiterd product";
            } else if ($r != 1) {
                  echo "not regiterd product";
            } else if ($d["qty"] < $qty) {
                  echo "Not avileble this ammount";
            } else {
                  if ($rrev == 1) {
                        $drev = $resultprv->fetch_assoc();
                        if ($d["qty"] <= $drev["cqty"]) {
                              echo "Your cart already has maximum quintity of this product";
                        } else if ($d["qty"] < $qty + $drev["cqty"]) {
                              echo "Not avileble this ammount";
                        } else {
                              $qtyrev = $drev["cqty"];
                              $upqty = $qty + $qtyrev;
                              $q = "UPDATE `cart` SET `cqty`='" . $upqty . "' WHERE `product_pid`='" . $pid . "' AND `user_id`='" . $user . "'";
                              DB::iud($q);
                              echo "success";
                        }
                  } else {
                        $q = "INSERT INTO `cart` VALUES ('" . $pid . "','" . $user . "','" . $qty . "')";
                        DB::iud($q);
                        echo "success";
                  }
            }
      } else {
            echo "Please login";
      }
} else {
      echo "Your in Wrong  Page";
}
