<?php
require "database.php";
$cater = $_POST["c"];
if ($cater == "All") {
      $bran = DB::search("SELECT * FROM  brand ");
?>
      <option value="All">All Brand</option>

      <?php
      for ($i = 0; $i < $bran->num_rows; $i++) {
            $d = $bran->fetch_assoc();
      ?>
            <option value="<?php echo $d["bid"] ?>"><?php echo $d["bname"] ?></option>
      <?php
      }
} else {
      $bran = DB::search("SELECT DISTINCT `bid`,`bname` FROM  brand INNER JOIN  subcategory_has_brand ON brand.`bid`=subcategory_has_brand.`brand_bid` 
      INNER JOIN sub_catergory ON subcategory_has_brand.`sub_catergory_sid`=sub_catergory.`sid` WHERE sub_catergory.`main_category_id`='" . $cater . "'");
      ?>
      <option value="All">All Brand</option>

      <?php
      for ($i = 0; $i < $bran->num_rows; $i++) {
            $d = $bran->fetch_assoc();
      ?>
            <option value="<?php echo $d["bid"] ?>"><?php echo $d["bname"] ?></option>
<?php
      }
}
