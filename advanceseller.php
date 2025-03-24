<?php
require "database.php";

if (isset($_POST["inp"]) && isset($_POST["n"])) {

      $inp = $_POST["inp"];
      $nu = $_POST["n"];


      if (empty($inp)) {
            echo "Please Type in text filed";
      } else if ($nu == "c") {
            $have = DB::search("SELECT * FROM `main_category` WHERE `name`='" . ucfirst($inp) . "'");
            if ($have->num_rows == 0) {
                  if (isset($_FILES["img"])) {

                        $type = $_FILES["img"]["type"];
                        $allowed_image_extention = array(
                              "image/jpeg", "image/jpg", "image/png", "image/svg+xml"
                        );
                        if (!in_array($type, $allowed_image_extention)) {
                              echo "Please Select An svg,jpg or png Image";
                        } else {
                              $protype = explode('/', $type, 2);
                              $ultraType = "." . $protype[1];
                              if ($ultraType == ".svg+xml") {
                                    $ultraType = ".svg";
                              }
                              $t = microtime(true);

                              $imgName = $t . $ultraType;
                              $selget = "catergory//" . $imgName;
                              move_uploaded_file($_FILES["img"]["tmp_name"], $selget);

                              $q = "INSERT INTO `main_category`(`name`,`img_path`) VALUES ('" . ucfirst($inp) . "','" . $selget . "') ";
                              DB::iud($q);
                              echo "succes";
                        }
                  } else {
                        echo "Please Select an Image";
                  }
            } else {
                  echo "Already exist this category";
            }
      } else if ($nu == "sc") {
            $have = DB::search("SELECT * FROM `sub_catergory` WHERE `name`='" . ucfirst($inp) . "'");
            if ($have->num_rows == 0) {
                  $selget = $_POST["sel"];
                  if ($selget != "none") {

                        $q = "INSERT INTO `sub_catergory`(`name`,`main_category_id`) VALUES ('" . ucfirst($inp) . "','" . $selget . "') ";
                        DB::iud($q);
                        echo "succes";
                  } else {
                        echo "Select Main Category";
                  }
            } else {
                  echo "Already exist this Sub category";
            }
      } else if ($nu == "b") {
            $have = DB::search("SELECT * FROM `brand` WHERE `bname`='" . ucfirst($inp) . "'");
            if ($have->num_rows == 0) {
                  $selget = $_POST["sel"];
                  $sublenth = $_POST["len"];
                  if ($selget != "none") {
                        if ($sublenth != 0) {
                              $q = "INSERT INTO `brand` (`bname`) VALUES ('" . ucfirst($inp) . "') ";
                              DB::iud($q);
                              $last_id = DB::$dbms->insert_id;

                              for ($i = 0; $i < $sublenth; $i++) {
                                    $sub = $_POST["sub" . $i];
                                    DB::iud("INSERT INTO `subcategory_has_brand` (`sub_catergory_sid`,`brand_bid`) VALUES ('" . $sub . "','" . $last_id . "')");
                                    // echo $sub;
                              }


                              echo "succes";
                        } else {
                              echo "Please Select sub category";
                        }
                  } else {
                        echo "Select main category";
                  }
            } else {
                  echo "Already exist this Sub category";
            }
      }
}
