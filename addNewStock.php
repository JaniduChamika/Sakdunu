<?php
require "database.php";
session_start();
$u = $_SESSION["userdata"]["id"];
$pid = $_POST["pid"];
$price = $_POST["price"];
$qty = $_POST["qty"];
$expiredate = $_POST["exdate"];



if (empty($pid)) {
      echo "Please try again later";
} else if (empty($price)) {
      echo "Please enter the price";
} else if (empty($qty)) {
      echo "Please enter the quintity";
} else {
      if (empty($expiredate)) {
            $expiredate = "9999-12-20";
      }
      $pro = DB::search("SELECT * FROM `product` WHERE `pid`='" . $pid . "'");
      if ($pro->num_rows == 1) {
            $d = $pro->fetch_assoc();

            $dayt = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $dayt->setTimezone($tz);
            $datetime = $dayt->format("Y-m-d H:i:s");

            DB::iud("INSERT INTO `product` (`brand_id`,`model`,`title`,`datetime_added`,`qty`,`price`,`description`,`img`,`main_category_id`,`sub_catergory_id`,`expire_date`,`delete`,`seller_id`)
 VALUES ('" . $d["brand_id"] . "','" . $d["model"] . "','" . $d["title"] . "','" . $datetime . "','" . $qty . "','" . $price . "','" . $d["description"] . "','" . $d["img"] . "','" . $d["main_category_id"] . "',
 '" . $d["sub_catergory_id"] . "','" . $expiredate . "','0','" . $u . "')");
            echo "success";
      } else {
            echo "Product doesn't exist";
      }
}
