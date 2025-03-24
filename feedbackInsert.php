<?php
session_start();
require "database.php";
if (isset($_SESSION["userdata"]["id"])) {
      $user = $_SESSION["userdata"]["id"];
      $pid = $_POST["pid"];
      $feed = $_POST["feed"];
      $ahave = DB::search("SELECT * FROM `feedback` WHERE `product_pid`='" . $pid . "' AND `user_id`='" . $user . "'");
      if ($ahave->num_rows == 0) {

            if (!empty($feed)) {
                  $d = new DateTime();
                  $tz = new DateTimeZone("Asia/Colombo");
                  $d->setTimezone($tz);
                  $date = $d->format("Y-m-d H:i:s");


                  DB::iud("INSERT INTO `feedback`(`product_pid`,`user_id`,`feed`,`date`) VALUES ('" . $pid . "','" . $user . "','" . $feed . "','" . $date . "') ");
                  echo "success";
            } else {
                  echo "Please Enter Your feed back";
            }
      }else{
            echo "You have already set up feedback. Thank you!";

      }
}
