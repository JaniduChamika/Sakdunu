<?php
require "database.php";

$FirstName = $_POST["fn"];
$LastName = $_POST["ln"];
$Email = $_POST["e"];
$Password = $_POST["p"];
$mobile = $_POST["mobile"];
$gen = $_POST["gen"];
$cpw = $_POST["cpw"];


$qs = "SELECT * FROM gender WHERE `gid`='" . $gen . "';";
$resultset = DB::search($qs);
if ($resultset->num_rows != 1) {
    echo "*Something went wrong";
}


if (empty($FirstName)) {
    echo "*Please Enter Your First Name";
}  else if (strlen($FirstName) > 50) {
    echo "*First name must be less than 50 characters";
}else if (empty($LastName)) {
    echo "*Please Enter Your Last Name";
}else if (strlen($LastName) > 50) {
    echo "*Last name must be less than 50 characters";
} else if (empty($mobile)) {
    echo "*Enter your Mobile Number";
} else if (strlen($mobile) != 10) {
    echo "*Invalid mobile number";
} else if (preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/", $mobile) == 0) {
    echo "*Invalid mobile number";
} else if (empty($Email)) {
    echo "*Enter your working email address";
} else if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
    echo "*Invalid Email Format";
} else if (empty($Password)) {
    echo "*Don't forget to enter a password";
} else if ($Password != $cpw) {
    echo "*Password not same";
} else if (strlen($Password) < 5 || strlen($Password) > 20) {
    echo "*Password length must between 5 to 20";
} else if (!preg_match("#[0-9]#", $Password)) {
    echo "*Password must contains numbers";
} else {

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    $qs = "SELECT * FROM user WHERE `email`='" . $Email . "';";
    // $Sresultset = $dbms->query($qs);

    $Sresultset = DB::search($qs);
    $row = $Sresultset->num_rows;
    if ($row == 1) {
        echo "*Already Registerted Email";
    } else {

        $qi = "INSERT INTO user (`first_name`,`last_name`,`email`,`mobile`,`password`,`g_id`,`user_tid`,`register_time`,`status_id`) 
         VALUES('" . ucfirst($FirstName) . "','" . ucfirst($LastName) . "','" . $Email . "','" . $mobile . "','" . $Password . "','" . $gen . "','1','".$date."','1');";
        // $dbms->query($qi);
        DB::iud($qi);
        echo "success";
    }
}
