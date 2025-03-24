<?php
session_start();
require "database.php";
if(isset($_SESSION["userdata"]["id"])){
$msg = $_GET["msg"];

$from = $_SESSION["userdata"]["id"];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");
$result = DB::search("SELECT * FROM `user`  WHERE `user_tid`='2'");
if ($result->num_rows >= 1) {
      $seller = $result->fetch_assoc();
      if (!empty($msg)) {
            DB::iud("INSERT INTO `chat`(`from_id`,`to_id`,`msg`,`date_time`,`seen_status`) VALUES ('" . $from . "','" . $seller["id"] . "','" . $msg . "','" . $date . "','1') ");
            echo "Success";
      }
}
}else{
      echo "Please Login";
}