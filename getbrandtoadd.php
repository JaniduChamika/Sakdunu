<?php



require "database.php";

$sub = $_POST["s"];


$resultsub;

$resultsub =   DB::search("SELECT * FROM `brand` INNER JOIN `subcategory_has_brand` ON brand.`bid` =subcategory_has_brand.`brand_bid` WHERE `sub_catergory_sid`='" . $sub . "'");

$n = $resultsub->num_rows;
?>
<option value="none">Select Brand</option>
<?php
for ($x = 0; $x < $n; $x++) {
      $d = $resultsub->fetch_assoc();
?>
      <option value="<?php echo $d["bid"] ?>"> <?php echo $d["bname"] ?></option>

<?php
}

?>