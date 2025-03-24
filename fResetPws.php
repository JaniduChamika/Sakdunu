<?php
require "database.php";

if (isset($_POST["pw"]) && isset($_POST["repw"]) && isset($_POST["vcode"]) && isset($_POST["email"])) {
      $pws = $_POST["pw"];
      $repws = $_POST["repw"];
      $vc = $_POST["vcode"];
      $email = $_POST["email"];

      if (empty($pws)) {
            echo "Please enter your new password";
      } else if (strlen($pws) <8 || strlen($pws) > 30) {
            echo "Password length must between 8 to 20";
      } else if (!preg_match("#[0-9]#", $pws)) {
            echo "Password must contains numbers";
      } else if (empty($repws)) {
            echo "Please re-enter your new password";
      } else if ($pws != $repws) {
            echo "New password & Re-type password are not same";
      } else if (empty($vc)) {
            echo "Please enter varification code";
      } else if (empty($email)) {
            echo "Please enter your email address";
      } else {
            $q = "SELECT * FROM user WHERE `email`='" . $email . "' AND `verification_code`='" . $vc . "'";
            $resultset = DB::search($q);
            if ($resultset->num_rows != 1) {
                  echo "Wrong varification code";
            } else {
                  $q = "UPDATE user SET `password`='".$pws."' WHERE `email`='" . $email . "'";
                  DB::iud($q);
                  echo "success";
            }
      }
} else {
      echo "Something Wrong";
}
