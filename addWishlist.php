<?php
session_start();
require "database.php";
if (isset($_GET["pid"]) && isset($_GET["status"])) {

      if (isset($_SESSION["userdata"]["id"])) {
            $pid = $_GET["pid"];
            $status = $_GET["status"];
            $u = $_SESSION["userdata"]["id"];

            if ($status == "true") {
                  $q = "SELECT * FROM wishlist WHERE `product_pid`='" . $pid . "' AND `user_id`='" . $_SESSION["userdata"]["id"] . "'";
                  $result = DB::search($q);
                  if ($result->num_rows != 1) {
                        $q = "INSERT INTO wishlist (`product_pid`,`user_id`) VALUES ('" . $pid . "','" .  $u  . "')";
                        DB::iud($q);
                  }
            } else {
                  $q = "DELETE FROM wishlist WHERE `product_pid`='" . $pid . "' AND `user_id`='" . $_SESSION["userdata"]["id"] . "'";
                  DB::iud($q);
            }
            echo "success";
      } else {
            echo "Please Login";
      }
} else {
      echo "Your in Wrong  Page";
}

?>