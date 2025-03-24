<?php
require "database.php";
$pid=$_POST["pid"];
$exdate =$_POST["exdate"];

$have=DB::search("SELECT * FROM `product` WHERE `pid`='".$pid."'");
if($have->num_rows==1){
DB::iud("UPDATE `product` SET `expire_date`='".$exdate."' WHERE `pid`='".$pid."'");
echo "success";
}else{
      echo "Product doesn't exists";
}


?>