<?php
require "database.php";
$pid = $_POST["pid"];

$havepr0 = DB::search("SELECT * FROM `product` WHERE `pid`='" . $pid . "'");
if ($havepr0->num_rows == 1) {
      $haveinvo = DB::search("SELECT * FROM `user_has_product` WHERE `product_pid`='" . $pid . "'");
      $havecart = DB::search("SELECT * FROM `cart` WHERE `product_pid`='" . $pid . "'");
      $havecwish = DB::search("SELECT * FROM `wishlist` WHERE `product_pid`='" . $pid . "'");


      if ($havecart->num_rows >= 1) {
            echo "Someone has this product in their cart. This product can't delete";
      } else  if ($havecwish->num_rows >= 1) {
            echo "Someone has this product in their Wishlist. This product can't delete";
      } else if ($haveinvo->num_rows == 0) {
            DB::iud("DELETE FROM `product` WHERE `pid`='" . $pid . "'");
            echo "success";
      } else {
            echo "Product have orders.This product can't delete";
      }
} else {
      echo "Product dosen't exsits";
}
