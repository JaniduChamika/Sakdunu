<?php
require "database.php";
$uid = $_POST["uid"];

$q = "SELECT * FROM user INNER JOIN gender ON user.`g_id`=gender.`gid` WHERE user.`id`='" . $uid . "'";
$resultset = DB::search($q);
$d = $resultset->fetch_assoc();
$call;
if ($d["gname"] == "Female") {
      $call = "Mrs.";
} else {
      $call = "Mr.";
}
?>

<div class="mb-2">
      <span> Name :-</span> <span> <?php echo $call . " " . $d["first_name"] . " " . $d["last_name"] ?></span>

</div>
<div class="mb-2">
      <span> Email Address :-</span> <span><?php echo $d["email"] ?></span>
</div>
<div class="mb-2">
      <span> Contact No :-</span> <span><?php echo $d["mobile"] ?></span>
</div>