<?php
require "database.php";
$invoid=$_GET["id"];
$did=$_GET["did"];
$reult=DB::search("SELECT * FROM `invo` WHERE `invoid`= '".$invoid."'");
if($reult->num_rows==1){
      DB::iud("UPDATE `invo` SET `ds_id`='".$did."' WHERE `invoid`='".$invoid."'");
      echo "success";
}else{
      echo "Please try again later";
}

?>