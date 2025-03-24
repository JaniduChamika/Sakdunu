<?php
require "database.php";
if(isset($_GET["pid"])){
      $pid=$_GET["pid"];
      $q="UPDATE product SET `delete`='0' WHERE `pid`='".$pid."'";
      DB::iud($q);
      echo "success";
}
