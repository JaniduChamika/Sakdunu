<?php

require "database.php";

$main = $_POST["m"];


$resultsub;
if ($main == "All") {

      $resultsub =   DB::search("SELECT DISTINCT `bname`,`bid` FROM brand");
} else {
      $resultsub =   DB::search("SELECT DISTINCT `bname`,`bid` FROM product INNER JOIN brand ON product.`brand_id`=brand.`bid` WHERE `sub_catergory_id`='" . $main . "'");
}

// $resultsub = $dbms->query($q);
$n = $resultsub->num_rows;
?>
<option value="All" selected> Any </option>

<?php
for ($x = 0; $x < $n; $x++) {
      $d = $resultsub->fetch_assoc();
?>
      <option value="<?php echo $d["bid"] ?>"> <?php echo $d["bname"] ?></option>

<?php
}

?>