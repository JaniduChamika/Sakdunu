<?php
require "database.php";
$uid = $_GET["uid"];
$bid=$_GET["bid"];
$result = DB::search("SELECT * FROM `user` WHERE `id`='" . $uid . "'");

if ($result->num_rows == 1) {
      DB::iud("UPDATE `user` SET `status_id`='".$bid."' WHERE `id`='" . $uid . "'");
      echo "success";
}else{
      echo "User doesn't exist";
}
