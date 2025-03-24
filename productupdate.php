<?php
session_start();
require "database.php";


$id = $_POST["pid"];
$main = $_POST["main"];
$sub = $_POST["sub"];

$brand = $_POST["b"];
$model = $_POST["m"];
$title = $_POST["t"];

$qty = $_POST["q"];
$price = $_POST["p"];
$des = $_POST["de"];
$exd = $_POST["exdate"];

if (empty($exd)) {
    $exd = "9999-12-20";
}
if ($qty < 0) {
    $qty = 0;
}
if ($price < 0) {
    $price = 0;
}

if ($main == "none") {
    echo "m1";
} elseif ($sub == "none") {
    echo "s2";
} elseif ($brand == "none") {
    echo "b3";
} elseif (empty($model)) {
    echo "mo4";
} elseif (empty($title)) {
    echo "title";
} elseif (empty($qty)) {
    echo "q5";
} elseif (empty($price)) {
    echo "p6";
} else if (preg_match("/'/", $des) != 0) {
    echo " Apostrophe (') Symbol is not valid, Please remove it from the description";
}
// elseif (empty($des)) {
//     echo "de7";
// } 
else {


    $q = "SELECT * FROM product WHERE `pid`='" . $id . "'";


    $resultset = DB::search($q);
    if ($resultset->num_rows == 1) {
        $d = $resultset->fetch_assoc();
        $q2;
        if (isset($_FILES["img"])) {
            $allowed_image_extention = array(
                "image/jpeg", "image/jpg", "image/png", "image/svg+xml"
            );
            $file_pointer = $d["img"];

            // Use unlink() function to delete a file 
            if (!unlink($file_pointer)) {
                echo ("$file_pointer cannot be deleted due to an error");
            }
            $t = microtime(true);
            $img = $_FILES["img"];
            $type = $_FILES["img"]["type"];
            if (!in_array($type, $allowed_image_extention)) {
                echo "Please Select An svg,jpg or png Image";
            } else {
                $protype = explode('/', $type, 2);
                $ultraType = "." . $protype[1];
                if ($ultraType == ".svg+xml") {
                    $ultraType = ".svg";
                }
                $imgpath = "product2//" . $t . $ultraType;

                // echo $imgpath;

                move_uploaded_file($_FILES["img"]["tmp_name"], $imgpath);

                $q2 = "UPDATE product SET `brand_id`='" . $brand . "', `model`='" . $model . "',`title`='" . $title . "',`qty`='" . $qty . "',`price`='" . $price . "',`description`='" . $des . "',`img`='" . $imgpath . "',`main_category_id`='" . $main . "',`sub_catergory_id`='" . $sub . "',`expire_date`='" . $exd . "' WHERE `pid`='" . $id . "'  ";

                DB::iud($q2);
                echo "succes";
            }
        } else {

            $q2 = "UPDATE product SET `brand_id`='" . $brand . "', `model`='" . $model . "',`title`='" . $title . "',`qty`='" . $qty . "',`price`='" . $price . "',`description`='" . $des . "',`main_category_id`='" . $main . "',`sub_catergory_id`='" . $sub . "',`expire_date`='" . $exd . "' WHERE `pid`='" . $id . "' ";

            DB::iud($q2);
            echo "succes";
        }


        // echo $main;
    } else {
        echo "somthing wrong";
    }
}
