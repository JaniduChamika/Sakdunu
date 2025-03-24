<?php



require "database.php";

$main = $_POST["m"];


$resultsub;
if ($main == "All") {
      $resultsub =   DB::search("SELECT * FROM sub_catergory;");
} else {
      $resultsub =   DB::search("SELECT * FROM sub_catergory WHERE `main_category_id`='" . $main . "'");
}

// $resultsub = $dbms->query($q);
$n = $resultsub->num_rows;
if (isset($_POST["for"])) {
      if ($_POST["for"] == "addpro") {
?>
            <option value="none">Select Sub Category</option>

      <?php
      }
} else {
      ?>
      <option value="All" selected> Any </option>

<?php
}

for ($x = 0; $x < $n; $x++) {
      $d = $resultsub->fetch_assoc();
?>
      <option value="<?php echo $d["sid"] ?>"> <?php echo $d["name"] ?></option>

<?php
}

?>