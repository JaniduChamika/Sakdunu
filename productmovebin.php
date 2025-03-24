<?php
require "database.php";


$id=$_POST["pid"];



$q="UPDATE product SET `delete`='1' WHERE `pid`='".$id."'";
// $dbms->query($q);

DB::iud($q);
echo "succes";

?>