<?php
session_start();
require "database.php";
date_default_timezone_set("Asia/Colombo");
$date = date("Y-m-d");
if (isset($_SESSION["userdata"]["id"])) {
      $uid = $_SESSION["userdata"]["id"];

      // $pid = $_POST["pid"];

      $adno = $_POST["an"];
      $adline1 = $_POST["a1"];
      $adline2 = $_POST["a2"];
      $district = $_POST["ac"];
      $postalcode = $_POST["postal"];

      $mobile = $_POST["mobile"];
      $q = "SELECT * FROM `cart` INNER JOIN `product` ON cart.`product_pid`=product.`pid` WHERE `user_id`='" . $uid . "'";
      $resultset = DB::search($q);
      $crow = $resultset->num_rows;
      $dilevery = DB::search("SELECT * FROM `dilevery_fee` INNER JOIN `district` ON dilevery_fee.`district_id`=district.`district_id` WHERE district.`district_id`='" . $district . "'");

      if ($crow == 0) {
            echo "Product doesn't exist in Cart";
      } else if (empty($mobile)) {
            echo "Please enter mobile number";
      } else if (strlen($mobile) != 10) {
            echo "Invalid mobile number";
      } else if (preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/", $mobile) == 0) {
            echo "Invalid mobile number";
      } else if (empty($adno)) {
            echo "Please enter address no";
      } else if (empty($adline1)) {
            echo "Please enter address line 1";
      } else if (empty($adline2)) {
            echo "Please enter address line 2";
      } else if ($district == "none") {
            echo "Please select district";
      } else if (empty($postalcode)) {
            echo "Please enter  postal code";
      } else if ($dilevery->num_rows == 0) {
            echo "delivery not available for this district";
      } else {

            $email;
            $q2 = "SELECT * FROM user  WHERE `id`='" . $uid . "'";
            $resultset2 = DB::search($q2);
            $qtyvalidate = "0";

            if ($resultset2->num_rows == 1) {
                  $total = 0;
                  for ($i = 0; $i < $crow; $i++) {
                        $d1 = $resultset->fetch_assoc();
                        $total = $total + ($d1["price"] * $d1["cqty"]);
                        if ($d1["qty"] < $d1["cqty"]) {
                              $qtyvalidate = "This quintity not available in stock";
                        } else if ($d1["delete"] == 1||$d1["expire_date"] < $date) {
                              $qtyvalidate = "Some of the products in the cart are not available at this time";
                        }
                  }


                  $d2 = $resultset2->fetch_assoc();
                  $email = $d2["email"];

                  $deliverD = $dilevery->fetch_assoc();
                  $dileveryFee = $deliverD["fee"];




                  // $item = $d1["title"];
                  $item = $d1["title"]." & ect";
                  $cretedid = explode(".", microtime(true));
                  $advainId = $cretedid[0] . "" . $cretedid[1];
                  $invoid = "@" . (substr($advainId, 0, 11) - 6000000000);



                  $array["uemail"] = $email;

                  $array["orderid"] = $invoid;
                  $array["proname"] = $item;
                  $array["total"] = $total + $dileveryFee;
                  $array["uid"] = $uid;
                  // $array["qty"] = $qty;

                  $array["fname"] = $d2["first_name"];
                  $array["lname"] = $d2["last_name"];
                  $array["mobile"] = $mobile;
                  $array["adno"] = $adno;
                  $array["adline2"] = $adline2;
                  $array["adline1"] = $adline1;
                  $array["district"] = $deliverD["cname"];
                  $array["dis_id"] = $district;

                  $array["postalcode"] = $postalcode;


                  if ($qtyvalidate == "This quintity not available in stock") {
                        echo $qtyvalidate;
                  } else if ($qtyvalidate == "Some of the products in the cart are not available at this time") {
                        echo $qtyvalidate;

                  } else {
                        echo json_encode($array);
                  }
            } else {
                  echo "User not found";
            }
      }
} else {
      echo "Please Login First";
}
