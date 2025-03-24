<?php
require "database.php";

$notifi = $_POST["x"];

$notiyrs = DB::search("SELECT * FROM `notification` WHERE `nid`='" . $notifi . "'");
if ($notiyrs->num_rows == 1) {
      DB::iud("DELETE FROM `notification` WHERE `nid`='" . $notifi . "'");
      echo "success";
} else {
      echo "Please try again later";
}
