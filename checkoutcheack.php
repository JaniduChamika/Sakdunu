<?php
session_start();
require "database.php";
if (isset($_SESSION["userdata"]["id"])) {
      $uid = $_SESSION["userdata"]["id"];

      $pid = $_POST["pid"];
      $qty = $_POST["qty"];
      $adno = $_POST["an"];
      $adline1 = $_POST["a1"];
      $adline2 = $_POST["a2"];
      $district = $_POST["ac"];
      $postalcode = $_POST["postal"];
      // $fname = $_POST["fname"];
      // $lname = $_POST["lname"];
      $mobile = $_POST["mobile"];
      $q = "SELECT * FROM product WHERE `pid`='" . $pid . "'";
      $resultset = DB::search($q);
      $dilevery = DB::search("SELECT * FROM `dilevery_fee` INNER JOIN `district` ON dilevery_fee.`district_id`=district.`district_id` WHERE district.`district_id`='" . $district . "'");

      if ($resultset->num_rows == 0) {
            echo "Product doesn't exist";
      } else if (empty($qty)) {
            echo "Plase set Quintity";
      }
      // else if (empty($fname)) {
      //       echo "Please enter first name";
      // } else if (empty($lname)) {
      //       echo "Please enter last name";
      // } 
      else if (empty($mobile)) {
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

            if ($resultset2->num_rows == 1) {
                  $d1 = $resultset->fetch_assoc();
                  if ($d1["delete"] == 1) {
                        echo "This Product is not available at this moment";
                  } else if ($d1["qty"] >= $qty) {

                        $d2 = $resultset2->fetch_assoc();
                        $email = $d2["email"];

                        $deliverD = $dilevery->fetch_assoc();
                        $dileveryFee = $deliverD["fee"];



                        $total = ($d1["price"] * $qty) + $dileveryFee;
                        $item = $d1["title"];

                        $cretedid = explode(".", microtime(true));
                        $advainId = $cretedid[0] . "" . $cretedid[1];
                        $invoid = "@" . (substr($advainId, 0, 11) - 6000000000);






                        // $j='{"uemail":"'.$email.'","uaddno":"'.$adno.'","uaddline1";"'.$adline1.'","uaddline2":"'.$adline2.'","ucity":"'.$cityuser.'","orderid";"'.$invoid.'","proname":"'.$item.'","price":"'.$price.'"}';
                        // echo $j;
                        $array["uemail"] = $email;

                        $array["orderid"] = $invoid;
                        $array["proname"] = $item;
                        $array["total"] = $total;
                        $array["uid"] = $uid;
                        $array["qty"] = $qty;

                        $array["fname"] = $d2["first_name"];
                        $array["lname"] = $d2["last_name"];
                        $array["mobile"] = $mobile;
                        $array["adno"] = $adno;
                        $array["adline2"] = $adline2;
                        $array["adline1"] = $adline1;
                        $array["district"] = $deliverD["cname"];
                        $array["dis_id"] = $district;

                        $array["postalcode"] = $postalcode;



                        echo json_encode($array);
                  } else {
                        echo "This quantity not available at this moment";
                  }
            } else {
                  echo "User not found";
            }
      }
} else {
      echo "Please Login First";
}
