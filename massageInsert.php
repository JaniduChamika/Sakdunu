<?php
session_start();
require "database.php";
$msg=$_GET["msg"];
$to=$_GET["u"];
$from=$_SESSION["userdata"]["id"];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");



if(!empty($msg)){
DB::iud("INSERT INTO `chat`(`from_id`,`to_id`,`msg`,`date_time`,`seen_status`) VALUES ('".$from."','".$to."','".$msg."','".$date."','1') ");
 echo "Success";     
}
?>