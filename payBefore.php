<?php

session_start();
require "database.php";
if (isset($_POST["pid"]) && isset($_POST["qty"])) {

      $pid = $_POST["pid"];
      $qty = $_POST["qty"];

      $uid = $_SESSION["userdata"]["id"];
      $q = "SELECT * FROM product WHERE `pid`='" . $pid . "'";
      $resultset = DB::search($q);
      if ($resultset->num_rows >= 1) {

            $d1 = $resultset->fetch_assoc();

            $qtypro = $d1["qty"];
            if ($qtypro <= $qty) {
                  echo "succes";
            }else{
                  echo "This quintity not available ";
            }
         
      } else {
            echo "Product Not Available";
      }
} else {
      echo "You are in wrong page";
}
