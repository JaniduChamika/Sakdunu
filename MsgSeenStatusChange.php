<?php
session_start();
require "database.php";

$from = $_SESSION["userdata"]["id"];
$uid = $_GET["uid"];
$haveMsg = DB::search("SELECT * FROM `chat` WHERE `seen_status`='1' AND `from_id`='" . $uid . "'AND `to_id`='" . $from . "'");

if ($haveMsg->num_rows >= 1) {
      DB::iud("UPDATE `chat` SET `seen_status`='2' WHERE `from_id`='" . $uid . "' AND `to_id`='" . $from . "'");
      echo "success";
}
