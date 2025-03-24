<?php
require "database.php";
if (isset($_POST["name"]) && isset($_POST["start"]) && isset($_POST["end"]) && isset($_POST["dis"])) {
      date_default_timezone_set("Asia/Colombo");
      $date = date("Y-m-d");

      $name = $_POST["name"];
      $start = $_POST["start"];
      $end = $_POST["end"];

      $dis = $_POST["dis"];


      $q = "SELECT * FROM package WHERE `pack_name`='" . $name . "'";
      $resultset = DB::search($q);


      if (empty($dis)) {
            $dis = 0;
      }

      if (empty($name)) {
            echo "Please enter package name";
      } else if ($resultset->num_rows == 1) {
            echo "Already exist a package with this name";
      } else if ($dis >= 50) {
            echo "Discount must be less than 50";
      } else if (empty($start)) {
            echo "Please enter package start date";
      } else if ($start < $date) {
            echo "Please set valid start date";
      } else if (empty($end)) {
            echo "Please enter package end date";
      } else if ($end <= $start) {
            echo "End date is doesn't mach with start date";
      } elseif (!isset($_FILES["img"])) {
            echo "Please select image";
      } else {
            $img = $_FILES["img"];

            $allowed_image_extention = array(
                  "image/jpeg", "image/jpg", "image/png", "image/svg+xml"
            );
            $t = microtime(true);


            $type = $_FILES["img"]["type"];
            if (!in_array($type, $allowed_image_extention)) {
                  echo "Please Select An svg,jpg or png Image";
            } else {
                  $protype = explode('/', $type, 2);
                  $ultraType = "." . $protype[1];
                  if ($ultraType == ".svg+xml") {
                        $ultraType = ".svg";
                  }
                  $imgName = $t . $ultraType;
                  $imgpath = "packageimg//" . $imgName;
                  move_uploaded_file($_FILES["img"]["tmp_name"], $imgpath);



                  $q = "INSERT INTO package (`pack_name`,`strat_date`,`end_date`,`discount`,`img`)  VALUES ('" . ucfirst($name) . "','" . $start . "','" . $end . "','" . $dis . "','" . $imgpath . "')";
                  DB::iud($q);
                  echo "success";
            }
      }
} else {
      echo "Something wrong";
}
