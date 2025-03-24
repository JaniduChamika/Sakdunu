<?php
require "database.php";
date_default_timezone_set("Asia/Colombo");
$date = date("Y-m-d");
if (isset($_POST["page"]) && isset($_POST["packId"])) {
      $page = $_POST["page"];
      $packID = $_POST["packId"];
      $cate = $_POST["c"];
      $t = $_POST["t"];
      $need = 12;
      $offset = ($page - 1) * 12;
?>
      <div class="row p-2">
            <?php

            // $qshop = "SELECT * FROM product INNER JOIN brand ON product.`brand_id`=brand.`bid` WHERE product.`expire_date`>'" . $date . "' AND product.`qty`!='0' AND product.`delete`='0' LIMIT $offset,$need";
            $qshop;
            if ($cate == "All") {
                  $qshop = "SELECT * FROM product INNER JOIN brand ON product.`brand_id`=brand.`bid` WHERE product.`expire_date`>'" . $date . "' AND product.`qty`!='0' AND product.`delete`='0' AND product.`title` LIKE '%" . $t . "%' LIMIT $offset,$need";
            } else {
                  $qshop = "SELECT * FROM product INNER JOIN brand ON product.`brand_id`=brand.`bid` WHERE product.`expire_date`>'" . $date . "' AND product.`qty`!='0' AND product.`delete`='0' AND product.`main_category_id`='" . $cate . "' AND product.`title` LIKE '%" . $t . "%' LIMIT $offset,$need";
            }
            $resultsetshop = DB::search($qshop);

            $rowshop = $resultsetshop->num_rows;
            for ($sho = 0; $sho < $rowshop; $sho++) {
                  $dshop = $resultsetshop->fetch_assoc();
            ?>

                  <div class="col-6 col-md-4 col-lg-3  col-xl-2 cardshop mt-0 mb-0">

                        <div class="row p-1 h-100">
                              <div class=" cardinshop p-2 ">

                                    <table class="cardtable w-100 h-100 text-dark">
                                          <tr>
                                                <td class="h-100 position-relative">


                                                      <img src="<?php echo $dshop["img"] ?>" class="imgcard h-100" />


                                                </td>
                                          </tr>

                                          <tr>
                                                <td>
                                                      <a href="productpage.php?pid=<?php echo  $dshop['pid'] ?>" target="_blank" class="p-0 text-decoration-none h-100 ancorcolor">

                                                            <?php echo $dshop["title"]  ?>
                                                      </a>
                                                </td>
                                          </tr>

                                          <tr>
                                                <td class="texbot">Rs.<?php echo number_format($dshop["price"], 2) ?></td>
                                          </tr>
                                          <tr>
                                                <td>
                                                      <?php
                                                      $q = "SELECT * FROM pack_product WHERE `package_id`='" . $packID . "' AND `product_pid`='" . $dshop['pid'] . "'";
                                                      $resultset = DB::search($q);
                                                      if ($resultset->num_rows == 1) {
                                                      ?>
                                                            <button class="btn fw-bold fs-5  w-100 text-light addedpack" value="<?php echo $packID ?>" onclick="addPackage(<?php echo $dshop['pid'] ?>);" id="packaddbtn<?php echo $dshop['pid'] ?>"><i class="icofont-check-circled"></i></button>

                                                      <?php
                                                      } else {
                                                      ?>
                                                            <button class="btn fw-bold fs-5 bluco w-100 text-light" value="<?php echo $packID ?>" onclick="addPackage(<?php echo $dshop['pid'] ?>);" id="packaddbtn<?php echo $dshop['pid'] ?>"><i class="icofont-ui-add"></i></button>
                                                      <?php
                                                      }
                                                      ?>
                                                </td>
                                          </tr>
                                    </table>


                              </div>
                        </div>

                  </div>

            <?php

            }
            ?>
      </div>

      <div class="col-12 text-center">

            <?php
            $q;
            if ($cate == "All") {

                  $q = "SELECT * FROM product WHERE product.`expire_date`>'" . $date . "' AND product.`qty`!='0' AND product.`delete`='0' AND product.`title` LIKE '%" . $t . "%'";
            } else {
                  $q = "SELECT * FROM product WHERE product.`expire_date`>'" . $date . "' AND product.`qty`!='0' AND product.`delete`='0' AND product.`main_category_id`='" . $cate . "' AND product.`title` LIKE '%" . $t . "%'";
            }
            $resultset = DB::search($q);
            $much = $resultset->num_rows;
            $much2 = $much / $need;
            $much3 = intval($much2);
            if ($much % $need != 0) {
                  $much3 = $much3 + 1;
            }
            if ($page != 1) {
            ?>
                  <button class="btn1 silever" onclick="getPackProduct(<?php echo $page - 1 ?>,<?php echo $packID ?>)"><i class="icofont-rounded-double-left"></i></button>
            <?php
            } else {
            ?>

                  <button class="btn1 silever"><i class="icofont-rounded-double-left"></i></button>


                  <?php
            }
            for ($i = 1; $i <= $much3; $i++) {
                  if ($i == $page) {
                  ?>
                        <button class="btn1 silever seleactive" onclick="getPackProduct(<?php echo $i ?>,<?php echo $packID ?>)"><?php echo $i ?></button>
                  <?php
                  } else {
                  ?>
                        <button class="btn1 silever" onclick="getPackProduct(<?php echo $i ?>,<?php echo $packID ?>)"><?php echo $i ?></button>
                  <?php
                  }
            }
            if ($page != $much3) {
                  ?>
                  <button class="btn1 silever" onclick="getPackProduct(<?php echo $page + 1 ?>,<?php echo $packID ?>)"><i class="icofont-rounded-double-right"></i></button>
            <?php
            } else {
            ?>
                  <button class="btn1 silever"><i class="icofont-rounded-double-right"></i></button>

            <?php
            }

            ?>


      </div>

<?php
} else {
      echo "Something Wrong";
}
