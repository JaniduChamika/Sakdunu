<?php
session_start();
require "database.php";
$subject = $_POST["s"];
$content = $_POST["con"];

if (empty($subject)) {
      echo "Please enter the subject";
} else if (strlen($subject) > 100) {
      echo "Subject must be less than 100 characters";
} else if (empty($content)) {
      echo "Please enter the content";
} else {
      if ($_SESSION["type"] == "seller") {
            DB::iud("INSERT INTO `notification` (`subject`,`content`) VALUES ('" . $subject . "','" . $content . "')");
            echo "success";
      } else {
            echo "Unexpected user";
      }
}
