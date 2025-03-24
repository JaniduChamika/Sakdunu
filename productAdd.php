<?php
session_start();
require "database.php";


$main = $_POST["main"];
$sub = $_POST["sub"];

$brand = $_POST["b"];
$model = $_POST["m"];
$title = $_POST["t"];

$qty = $_POST["q"];
$price = $_POST["p"];

$des = $_POST["de"];
$exdate = $_POST["ex"];
if ($qty < 0) {
    $qty = 0;
}
if ($price < 0) {
    $price = 0;
}

if (empty($exdate)) {
    $exdate = "9999-12-20";
}

$img;
if (isset($_FILES["img"])) {
    $img = $_FILES["img"];
}
$seller = $_SESSION["userdata"]["id"];
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
} elseif (empty($img)) {
    echo "i8";
} else if (preg_match("/'/", $des) != 0) {
    echo " Apostrophe (') Symbol is not valid, Please remove it from the description";
} else {
    $allowed_image_extention = array(
        "image/jpeg", "image/jpg", "image/png", "image/svg+xml"
    );

    $t = microtime(true);
    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $datetime = $d->format("Y-m-d H:i:s");

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
        $imgpath = "product2//" . $imgName;
        move_uploaded_file($_FILES["img"]["tmp_name"], $imgpath);


        $q = "INSERT INTO product (`brand_id`,`model`,`title`,`datetime_added`,`qty`,`price`,`description`,`img`,`seller_id`,`main_category_id`,
        `sub_catergory_id`,`expire_date`) VALUES 
        ('" . $brand . "','" . $model . "','" . $title . "','" . $datetime . "','" . $qty . "','" . $price . "','" . $des . "','" . $imgpath . "','" . $seller . "',
        '" . $main . "','" . $sub . "','" . $exdate . "')";
        DB::iud($q);

        echo "succes";
    }
}
