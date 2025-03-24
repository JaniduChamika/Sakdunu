<?php



require "database.php";

$main = $_POST["m"];


$resultsub;
if ($main == "All") {
      $resultsub =   DB::search("SELECT * FROM sub_catergory;");
} else {
      $resultsub =   DB::search("SELECT * FROM sub_catergory WHERE `main_category_id`='" . $main . "'");
}

$n = $resultsub->num_rows;

for ($x = 0; $x < $n; $x++) {
      $d = $resultsub->fetch_assoc();
      if (isset($_POST["brand"])) {
            $bid = $_POST["brand"];
            $have = DB::search("SELECT * FROM `subcategory_has_brand` WHERE `brand_bid`='" . $bid . "' AND `sub_catergory_sid`='" .$d["sid"]. "'");
            if ($have->num_rows == 1) {
?>
                  <input type="checkbox" class="btn-check d-none subcheckedrename" checked="" value="<?php echo $d["sid"] ?>"  id="btn-check-outlined<?php echo $x ?>rename" autocomplete="off" />
                  <label class="btn btn-outline-primary outlinbtn m-1" style="width: fit-content;" for="btn-check-outlined<?php echo $x ?>rename"><?php echo $d["name"] ?></label>
            <?php
            } else {
            ?>
                  <input type="checkbox" class="btn-check d-none subcheckedrename" value="<?php echo $d["sid"] ?>"  id="btn-check-outlined<?php echo $x ?>rename" autocomplete="off" />
                  <label class="btn btn-outline-primary outlinbtn m-1" style="width: fit-content;" for="btn-check-outlined<?php echo $x ?>rename"><?php echo $d["name"] ?></label>
            <?php
            }
      } else {
            ?>
            <input type="checkbox" class="btn-check d-none subchecked" value="<?php echo $d["sid"] ?>"  id="btn-check-outlined<?php echo $x ?>" autocomplete="off" />
            <label class="btn btn-outline-primary outlinbtn m-1" style="width: fit-content;" for="btn-check-outlined<?php echo $x ?>"><?php echo $d["name"] ?></label>
<?php
      }
}

?>