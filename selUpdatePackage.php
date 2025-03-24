<?php
require "database.php";
if (isset($_POST["packID"]) && isset($_POST["name"]) && isset($_POST["start"]) && isset($_POST["end"]) && isset($_POST["dis"])) {
      date_default_timezone_set("Asia/Colombo");
      $date = date("Y-m-d");

      $packID = $_POST["packID"];
      $name = $_POST["name"];
      $start = $_POST["start"];
      $end = $_POST["end"];

      $dis = $_POST["dis"];


      $q = "SELECT * FROM package WHERE `pack_id`='" . $packID . "'";
      $resultset = DB::search($q);
      if ($resultset->num_rows == 1) {
            $d = $resultset->fetch_assoc();
            $oldImg = $d["img"];
            // $packEndDate = $d["end_date"];

            $q = "SELECT * FROM pack_product WHERE `package_id`='" . $packID . "'";
            $resultsetdeail = DB::search($q);
            $dpack = $resultsetdeail->fetch_assoc();
            $produt_id = $dpack["product_pid"];

            $q = "SELECT * FROM package WHERE `pack_name`='" . $name . "' AND `pack_id`!='" . $packID . "'";
            $resultset2 = DB::search($q);

            $q1 = "SELECT * FROM `product` WHERE `pid`='" . $produt_id . "' AND `expire_date`<='" . $end . "'";
            $resultsetpro = DB::search($q1);


            if (empty($dis)) {
                  $dis = 0;
            }

            if (empty($name)) {
                  echo "Please enter package name";
            } else if ($resultset2->num_rows == 1) {
                  echo "Already exist a package with this name";
            } else if ($resultsetpro->num_rows >= 1) {
                  echo "This Package has Product,that will be expired before this ending data. Set a ending date before that product expireation date or remove that product";
            } else if ($dis >= 50) {
                  echo "Discount must be less than 50";
            } else if (empty($start)) {
                  echo "Please enter package start date";
            } else if ($start < $date) {
                  echo "Please set valid start date";
            } else if (empty($end)) {
                  echo "Please enter package end date";
            } else if ($end <= $start) {
                  echo "End date is doesn't mach with start date";
            } else {
                  if (isset($_FILES["img"])) {
                        $img = $_FILES["img"];

                        $allowed_image_extention = array(
                              "image/jpeg", "image/jpg", "image/png", "image/svg+xml"
                        );
                        if (!in_array($type, $allowed_image_extention)) {
                              echo "Please Select An svg,jpg or png Image";
                        } else {
                              if (!empty($img)) {
                                    if (!empty($oldImg)) {
                                          if ($oldImg != "product//default.jpg") {
                                                $file_pointer = $oldImg;
                                                // Use unlink() function to delete a file 
                                                if (!unlink($file_pointer)) {
                                                      echo ("$file_pointer cannot be deleted due to an error");
                                                }
                                          }
                                    }

                                    // end unlink 
                                    $t = microtime(true);
                                    $type = $_FILES["img"]["type"];
                                    $protype = explode('/', $type, 2);
                                    $ultraType = "." . $protype[1];
                                    if ($ultraType == ".svg+xml") {
                                          $ultraType = ".svg";
                                    }
                                    $imgName = $t . $ultraType;
                                    $imgpath = "packageimg//" . $imgName;
                                    move_uploaded_file($_FILES["img"]["tmp_name"], $imgpath);

                                    $q = "UPDATE package SET `pack_name`='" . ucfirst($name) . "',`strat_date`='" . $start . "',`end_date`='" . $end . "',`discount`='" . $dis . "',`img`='" . $imgpath . "' WHERE `pack_id`='" . $packID . "'";
                                    DB::iud($q);
                                    echo "success";
                              } else {

                                    $q = "UPDATE package SET `pack_name`='" . ucfirst($name) . "',`strat_date`='" . $start . "',`end_date`='" . $end . "',`discount`='" . $dis . "' WHERE `pack_id`='" . $packID . "'";
                                    DB::iud($q);
                                    echo "success";
                              }
                        }
                  } else {
                        $q = "UPDATE package SET `pack_name`='" . ucfirst($name) . "',`strat_date`='" . $start . "',`end_date`='" . $end . "',`discount`='" . $dis . "' WHERE `pack_id`='" . $packID . "'";
                        DB::iud($q);
                        echo "success";
                  }
            }
      } else {
            echo "Package Not Found";
      }
} else {
      echo "Something wrong";
}
