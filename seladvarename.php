<?php
require "database.php";

if (isset($_POST["rename"]) && isset($_POST["id"]) && isset($_POST["what"])) {
      $rename = $_POST["rename"];
      $id = $_POST["id"];
      $what = $_POST["what"];
      if ($what == "main") {
            $img;
            $q = "SELECT * FROM main_category WHERE `mid`='" . $id . "'";
            $resultset = DB::search($q);
            if ($resultset->num_rows == 1) {
                  $d = $resultset->fetch_assoc();
                  if (isset($_FILES["img"])) {
                        // image deval 
                        if (!empty($rename)) {


                              $file_pointer = $d["img_path"];
                              // unlink image 
                              if (!unlink($file_pointer)) {
                                    echo ("$file_pointer cannot be deleted due to an error");
                              }

                              $t = microtime(true);
                              $type = explode('/', $_FILES["img"]["type"], 2);
                              $protype = $type[1];
                              $ultraType = "." . $protype;
                              if ($protype == "svg+xml") {

                                    $ultraType = ".svg";
                              }
                              $imagepath = "catergory//" . $t . $ultraType;
                              move_uploaded_file($_FILES["img"]["tmp_name"], $imagepath);
                              // end image 

                              $q = "UPDATE main_category SET `name`='" . $rename . "',`img_path`='" . $imagepath . "' WHERE `mid`='" . $id . "'";
                              DB::iud($q);
                              echo "success";
                        } else {
                              echo "Filed is Empty";
                        }
                  } else {
                        if (!empty($rename)) {

                              $q = "UPDATE main_category SET `name`='" . $rename . "' WHERE `mid`='" . $id . "'";
                              DB::iud($q);
                              echo "success";
                        } else {
                              echo "Filed is Empty";
                        }
                  }
            } else {
                  echo "Something Wrong";
            }
      } else if ($what == "sub") {

            $q = "SELECT * FROM sub_catergory WHERE `sid`='" . $id . "'";
            $resultset = DB::search($q);
            if ($resultset->num_rows == 1) {
                  if (!empty($rename)) {

                        $q = "UPDATE sub_catergory SET `name`='" . $rename . "' WHERE `sid`='" . $id . "'";
                        DB::iud($q);
                        echo "success";
                  } else {
                        echo "Filed is Empty";
                  }
            } else {
                  echo "Something Wrong";
            }
      } else if ($what == "brand") {
            $q = "SELECT * FROM brand WHERE `bid`='" . $id . "'";
            $resultset = DB::search($q);
            if ($resultset->num_rows == 1) {
                  if (!empty($rename)) {
                        $q = "SELECT * FROM product INNER JOIN user_has_product ON product.`pid`=user_has_product.`product_pid` WHERE product.`brand_id`='" . $id . "'";
                        $resultset2 = DB::search($q);
                        if ($resultset2->num_rows == 0) {

                              $q = "UPDATE brand SET `bname`='" . $rename . "' WHERE `bid`='" . $id . "'";
                              DB::iud($q);



                              // echo "success";
                        }
                        if (isset($_POST["lencheck"]) && isset($_POST["lenuncheck"])) {
                              $lenche = $_POST["lencheck"];
                              $lenunche = $_POST["lenuncheck"];


                              for ($i = 0; $i < $lenche; $i++) {

                                    $have = DB::search("SELECT * FROM `subcategory_has_brand` WHERE `sub_catergory_sid`='" . $_POST["sub" . $i] . "' AND `brand_bid`='" . $id . "'");
                                    if ($have->num_rows == 0) {
                                          DB::iud("INSERT INTO `subcategory_has_brand`(`sub_catergory_sid`,`brand_bid`) VALUES ('" . $_POST["sub" . $i] . "','" . $id . "')");
                                    }
                              }
                              for ($i = 0; $i < $lenunche; $i++) {

                                    $havere = DB::search("SELECT * FROM `subcategory_has_brand` WHERE `sub_catergory_sid`='" . $_POST["subun" . $i] . "' AND `brand_bid`='" . $id . "'");
                                    if ($havere->num_rows == 1) {
                                          DB::iud(" DELETE FROM `subcategory_has_brand` WHERE `sub_catergory_sid`='" . $_POST["subun" . $i] . "' AND `brand_bid` ='" . $id . "'");
                                    }
                              }
                        }
                        echo "success";
                  } else {

                        echo "Filed is Empty";
                  }
            } else {
                  echo "Something Wrong";
            }
      }
} else {
      echo "Something Wrong";
}
