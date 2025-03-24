<?php
require "database.php";
date_default_timezone_set("Asia/Colombo");
$date = date("Y-m-d");

if (isset($_GET["pid"]) && isset($_GET["for"]) && isset($_GET["pack"])) {
      $pid = $_GET["pid"];
      $for = $_GET["for"];
      $pack = $_GET["pack"];


      $q = "SELECT * FROM package WHERE `pack_id`='" . $pack . "'";
      $resultset = DB::search($q);

      if ($resultset->num_rows == 1) {
            $packD = $resultset->fetch_assoc();
            $q = "SELECT * FROM product WHERE `pid`='" . $pid . "'";
            $resultset2 = DB::search($q);
            if ($resultset2->num_rows == 1) {
                  $product = $resultset2->fetch_assoc();

                  if ($for == "save") {
                        if ($product["expire_date"] <= $packD["end_date"]) {
                              echo "This Product Can't Add this Package.The Product will be expired before the package ending date ";
                        }else{
                              $q = "SELECT * FROM pack_product WHERE `package_id`='" . $pack . "' AND `product_pid`='" . $pid . "'";
                              $resultset3 = DB::search($q);
                              if ($resultset3->num_rows == 0) {
                                    $q = "INSERT INTO pack_product (`package_id`,`product_pid`) VALUES ('" . $pack . "','" . $pid . "')";
                                    DB::iud($q);
                                    echo "success";
                              } else {
                                    echo "Already Added";
                              }
                        }
                        
                  } else if ($for == "remove") {
                        $q = "DELETE FROM pack_product WHERE `package_id`='" . $pack . "' AND `product_pid`='" . $pid . "'";
                        DB::iud($q);
                        echo "success";
                  } else {
                        echo "Try again later";
                  }
            } else {
                  echo "Something Wrong";
            }
      } else {
            echo "Something Wrong";
      }
} else {
      echo "Something Wrong";
}
