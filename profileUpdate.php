<?php
session_start();
$user = $_SESSION["userdata"]["id"];
require "database.php";
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$mobile = $_POST["mobile"];
$streetno = $_POST["streetno"];
$streetline1 = $_POST["streetline1"];
$streetline2 = $_POST["streetline2"];
$distict = $_POST["distict"];
$postalcode = $_POST["postalcode"];


if (empty($fname)) {
      echo "Please Enter First Name";
} else if (empty($lname)) {

      echo "Please Enter Surname";
} else if (empty($mobile)) {

      echo "Please Enter Mobile";
} else if (strlen($mobile) != 10) {
      echo "*Invalid mobile number";
} else if (preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/", $mobile) == 0) {
      echo "*Invalid mobile number";
} else if (empty($streetno)) {

      echo "Please Enter Street no";
} else if (empty($streetline1)) {

      echo "Please Enter Street line 01";
} else if (empty($streetline2)) {

      echo "Please Enter street line 02";
} else if ($distict == "none") {

      echo "Please Select Distict";
} else if (empty($postalcode)) {

      echo "Please Enter Postalcode";
} else {
      DB::iud("UPDATE `user` SET `first_name`='" . $fname . "', `last_name`='" . $lname . "',`mobile`='" . $mobile . "' WHERE `id`='" . $user . "'");
      $address = DB::search("SELECT * FROM `user_address` WHERE `user_id`='" . $user . "'");

      if ($address->num_rows == 1) {
            $addrow = $address->fetch_assoc();
            DB::iud("UPDATE `user_address` SET `address_no`='" . $streetno . "', `address_line1`='" . $streetline1 . "',`address_line2`='" . $streetline2 . "',`postalcode`='" . $postalcode . "'
      ,`district_id`='" . $distict . "' WHERE `adid`='" . $addrow["adid"] . "'");
      } else {

            DB::iud("INSERT INTO `user_address`(`user_id`,`address_no`,`address_line1`,`address_line2`,`district_id`,`postalcode`) VALUES 
            ('" . $user . "','" . $streetno . "','" . $streetline1 . "','" . $streetline2 . "','" . $distict . "','" . $postalcode . "')");
      }


      if (isset($_FILES["img"])) {


            $t = microtime(true);

            $type = $_FILES["img"]["type"];

            $protype = explode('/', $type, 2);
            $ultraType = "." . $protype[1];
            if ($ultraType == ".svg+xml" || $ultraType == ".png" || $ultraType == ".jpg" || $ultraType == ".jpeg") {


                  if ($ultraType == ".svg+xml") {
                        $ultraType = ".svg";
                  }
                  $imgpath = "profileImage//" . $t . $ultraType;

                  // echo $imgpath;

                  move_uploaded_file($_FILES["img"]["tmp_name"], $imgpath);

                  $imghave = DB::search("SELECT * FROM `profile_img` WHERE `user_id`='" . $user . "'");
                  if ($imghave->num_rows == 1) {
                        $d = $imghave->fetch_assoc();

                        $file_pointer = $d["path"];
                        // Use unlink() function to delete a file 
                        if (!unlink($file_pointer)) {
                              echo ("$file_pointer cannot be deleted due to an error");
                        }
                        DB::iud("UPDATE `profile_img` SET `path`='" . $imgpath . "' WHERE `pimg_id`='" . $d["pimg_id"] . "'");
                  } else {
                        DB::iud("INSERT INTO `profile_img` (`path`,`user_id`) VALUES ('" . $imgpath . "','" . $user . "')");
                  }
            } else {
                  echo "Image Should be Svg, jpg, jpeg or png format";
            }
      }

      $resultset = DB::search("SELECT * FROM user INNER JOIN user_type ON user.`user_tid`=user_type.`t_id` WHERE `id`='" . $user . "';");

      $d = $resultset->fetch_assoc();
      $_SESSION["userdata"] = $d;
      echo "success";
}
