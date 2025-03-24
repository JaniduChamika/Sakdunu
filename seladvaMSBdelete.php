<?php
require "database.php";

if (isset($_GET["id"]) && isset($_GET["what"])) {

      $id = $_GET["id"];
      $what = $_GET["what"];
      if ($what == "main") {
            $q = "SELECT * FROM main_category WHERE `mid`='" . $id . "'";
            $resultset = DB::search($q);
            if ($resultset->num_rows == 1) {
                  $q = "SELECT *  FROM 
                   sub_catergory LEFT JOIN product ON sub_catergory.main_category_id=product.main_category_id
                  WHERE sub_catergory.main_category_id='" . $id . "' UNION  SELECT * FROM sub_catergory RIGHT JOIN 
                  product ON sub_catergory.main_category_id=product.main_category_id  WHERE product.`main_category_id`='" . $id . "'";
                  $resultset3 = DB::search($q);
                  if ($resultset3->num_rows == 0) {
                        $q = "DELETE FROM main_category WHERE `mid`='" . $id . "'";
                        DB::iud($q);
                        echo "success";
                  } else {
                        echo "Sorry you can't Delete this Category";
                  }
            } else {
                  echo "Something Wrong";
            }
      } else if ($what == "sub") {
            $q = "SELECT * FROM sub_catergory WHERE `sid`='" . $id . "'";
            $resultset = DB::search($q);
            if ($resultset->num_rows == "1") {
                  $q = "SELECT * FROM 
                   subcategory_has_brand LEFT JOIN product ON subcategory_has_brand.sub_catergory_sid=product.sub_catergory_id
                  WHERE subcategory_has_brand.sub_catergory_sid='" . $id . "' UNION  SELECT * FROM subcategory_has_brand 
                  RIGHT JOIN product ON subcategory_has_brand.sub_catergory_sid=product.sub_catergory_id  WHERE product.`sub_catergory_id`='" . $id . "' ";
                  $resultset3 = DB::search($q);
                  if ($resultset3->num_rows == 0) {
                        $q = "DELETE FROM sub_catergory WHERE `sid`='" . $id . "'";
                        DB::iud($q);
                        echo "success";
                  } else {
                        echo "Sorry you can't Delete this Category";
                  }
            } else {
                  echo "Something Wrong";
            }
      } else if ($what == "brand") {
            $q = "SELECT * FROM brand WHERE `bid`='" . $id . "'";
            $resultset = DB::search($q);
            if ($resultset->num_rows == "1") {
                  $q = "SELECT * FROM product  WHERE product.`brand_id`='" . $id . "'";
                  $resultset3 = DB::search($q);
                  if ($resultset3->num_rows == 0) {
                        $q = "DELETE FROM brand WHERE `bid`='" . $id . "'";
                        DB::iud($q);
                        echo "success";
                  } else {
                        echo "Sorry you can't Delete this brand";
                  }
            } else {
                  echo "Something Wrong";
            }
      }
}
