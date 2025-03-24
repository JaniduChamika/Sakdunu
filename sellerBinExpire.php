<?php
require "database.php";
$what = $_POST["what"];
$page = $_POST["page"];
$offset = ($page - 1) * 12;
date_default_timezone_set("Asia/Colombo");

$date = date("Y-m-d");
if ($what == "bin") {


?>


      <div class="col-6 d-grid mt-3 px-1  px-md-5 ">
            <button class="bton blubac act" onclick="recyclebin(1);">Recycle Bin</button>
      </div>
      <div class="col-6 d-grid mt-3 m-auto px-1  px-md-5">

            <button class="bton blubac" onclick="expiredpro(1);">
                  Expired Products
                  &nbsp;<span class="badge bg-primary">
                        <?php
                        $exproduct = DB::search("SELECT * FROM `product` WHERE  product.`expire_date` !='0000-00-00' AND product.`expire_date`<='" . $date . "'");
                        echo $exproduct->num_rows;
                        ?>
                  </span>
            </button>
      </div>
      <div class="col-12 mt-3">
            <div class="row">
                  <?php
                  $q = "SELECT product.`pid`, brand.`bname`,product.`title`,product.`img`,product.`qty`,product.`price`,product.`expire_date`,user_has_product.invo_id, COUNT(user_has_product.`invo_id`) AS `count`
                   FROM product INNER JOIN brand ON product.`brand_id`=brand.`bid`LEFT JOIN user_has_product ON user_has_product.`product_pid`=product.`pid` WHERE  product.`delete`='1' GROUP BY product.`pid` ORDER BY product.`pid` ASC LIMIT $offset,12 ";
                  $resultset = DB::search($q);

                  for ($i = 0; $i < $resultset->num_rows; $i++) {
                        $d = $resultset->fetch_assoc();

                  ?>
                        <!-- card  -->
                        <div class="col-12 col-md-6 col-xxl-4">
                              <div class="row p-2">
                                    <div class="col-12 cardbinproduct">
                                          <div class="row h-100 p-2">
                                                <div class="col-5 col-md-4 imageproduct m-auto p-0">
                                                      <img src="<?php echo $d["img"] ?>" class="w-100" />
                                                </div>
                                                <div class="col-7 col-md-8">
                                                      <div class="row h-100">
                                                            <div class="col-12 fw-bold">
                                                                  <?php echo $d["title"]  ?>

                                                            </div>
                                                            <div class="col-6">
                                                                  Orders

                                                            </div>
                                                            <div class="col-6">
                                                                  <?php echo $d["count"]  ?>


                                                            </div>
                                                            <div class="col-6">
                                                                  Price Rs:

                                                            </div>
                                                            <div class="col-6">
                                                                  <?php echo number_format($d["price"], 2) ?>

                                                            </div>
                                                            <div class="col-6">
                                                                  Quantity :

                                                            </div>
                                                            <div class="col-6">
                                                                  <?php echo $d["qty"] ?>

                                                            </div>
                                                            <?php
                                                            if ($d["expire_date"] != "0000-00-00") {
                                                            ?>
                                                                  <div class="col-12 col-md-6">
                                                                        Expire date

                                                                  </div>
                                                                  <div class="col-12 col-md-6">
                                                                        <?php echo $d["expire_date"]  ?>

                                                                  </div>
                                                            <?php
                                                            }
                                                            ?>



                                                      </div>
                                                </div>
                                                <?php
                                                if ($d["count"] == 0) {
                                                ?>
                                                      <div class="col-6  d-grid  pt-2">
                                                            <div class="row  pe-1">
                                                                  <button class="bton blubac text-light" onclick="reStore(<?php echo $d['pid'] ?>);">Restore</button>
                                                            </div>
                                                      </div>
                                                      <div class="col-6  d-grid pt-2">
                                                            <div class="row ps-1 ">
                                                                  <button class="bton redco text-light" onclick="permentdeletModal(<?php echo $d['pid'] ?>);">Delete</button>
                                                            </div>
                                                      </div>
                                                <?php
                                                } else {
                                                ?>
                                                      <div class="col-12  d-grid pt-2">
                                                            <div class="row">
                                                                  <button class="bton blubac text-light" onclick="reStore(<?php echo $d['pid'] ?>);">Restore</button>
                                                            </div>
                                                      </div>
                                                <?php
                                                }
                                                ?>

                                          </div>
                                    </div>
                              </div>
                        </div>
                  <?php
                  }

                  ?>
                  <div class="col-12 text-center mt-3">

                        <?php
                        if ($resultset->num_rows != 0) {
                              if ($page != 1) {
                        ?>
                                    <button class="btn1" onclick="recyclebin(<?php echo $page - 1 ?>);"><i class="icofont-rounded-double-left"></i></button>

                              <?php
                              } else {
                              ?>
                                    <button class="btn1"><i class="icofont-rounded-double-left"></i></button>

                              <?php
                              }
                              $q = "SELECT product.`pid`, brand.`bname`,product.`title`,product.`img`,product.`qty`,product.`price`,product.`expire_date`,user_has_product.invo_id, COUNT(user_has_product.`invo_id`) AS `count`
                         FROM product INNER JOIN brand ON product.`brand_id`=brand.`bid`LEFT JOIN user_has_product ON user_has_product.`product_pid`=product.`pid` WHERE  product.`delete`='1' GROUP BY product.`pid`";
                              $resultset = DB::search($q);
                              $row = $resultset->num_rows;
                              $num = $row / 12;
                              $n = intval($num);
                              if ($row % 12 != 0) {
                                    $n = $n + 1;
                              }
                              for ($i = 1; $i <= $n; $i++) {
                              ?>
                                    <button class="btn1" onclick="recyclebin(<?php echo $i ?>);"><?php echo $i ?></button>

                              <?php
                              }
                              if ($page != $n && $row != 0) {
                              ?>
                                    <button class="btn1" onclick="recyclebin(<?php echo $page + 1 ?>);"><i class="icofont-rounded-double-right"></i></button>

                              <?php
                              } else {
                              ?>
                                    <button class="btn1"><i class="icofont-rounded-double-right"></i></button>

                        <?php
                              }
                        }
                        ?>
                  </div>
            </div>


      </div>

<?php
} else if ($what == "expire") {
?>
      <div class="col-6 d-grid mt-3 px-1  px-md-5">
            <button class="bton blubac" onclick="recyclebin(1);">Recycle Bin</button>
      </div>
      <div class="col-6 d-grid mt-3 m-auto px-1  px-md-5 ">

            <button class="bton blubac act" onclick="expiredpro(1);">Expired Products
                  &nbsp;<span class="badge bg-primary">
                        <?php
                        $exproduct = DB::search("SELECT * FROM `product` WHERE  product.`expire_date` !='0000-00-00' AND product.`expire_date`<='" . $date . "'");
                        echo $exproduct->num_rows;
                        ?>
                  </span>
            </button>
      </div>
      <div class="col-12 mt-3">
            <div class="row">
                  <?php

                  $q = "SELECT product.`pid`, brand.`bname`,product.`title`,product.`img`,product.`qty`,product.`price`,product.`expire_date`,user_has_product.invo_id, COUNT(user_has_product.`invo_id`) AS `count`
                   FROM product INNER JOIN brand ON product.`brand_id`=brand.`bid`LEFT JOIN user_has_product ON user_has_product.`product_pid`=product.`pid`
                    WHERE  product.`expire_date` !='0000-00-00' AND product.`expire_date`<='" . $date . "' GROUP BY product.`pid` 
                    ORDER BY product.`pid` ASC LIMIT 0,12  ";
                  $resultset = DB::search($q);

                  for ($i = 0; $i < $resultset->num_rows; $i++) {
                        $d = $resultset->fetch_assoc();

                  ?>
                        <!-- card  -->
                        <div class="col-12 col-md-6 col-xxl-4">
                              <div class="row p-2">
                                    <div class="col-12 cardbinproduct">
                                          <div class="row h-100 p-2">
                                                <div class="col-5 col-md-4 imageproduct m-auto p-0">
                                                      <img src="<?php echo $d["img"] ?>" class="w-100" />
                                                </div>
                                                <div class="col-7 col-md-8">
                                                      <div class="row h-100">
                                                            <div class="col-12 fw-bold">
                                                                  <?php echo $d["title"] ?>

                                                            </div>
                                                            <div class="col-6">
                                                                  Orders

                                                            </div>
                                                            <div class="col-6">
                                                                  <?php echo $d["count"]  ?>


                                                            </div>
                                                            <div class="col-6">
                                                                  Price Rs:

                                                            </div>
                                                            <div class="col-6">
                                                                  <?php echo number_format($d["price"], 2) ?>

                                                            </div>
                                                            <div class="col-6">
                                                                  Quantity :

                                                            </div>
                                                            <div class="col-6">
                                                                  <?php echo $d["qty"] ?>

                                                            </div>
                                                            <div class="col-12 col-md-6 text-danger">
                                                                  Expire date

                                                            </div>
                                                            <div class="col-12 col-md-6 text-danger">
                                                                  <?php echo $d["expire_date"]  ?>

                                                            </div>

                                                      </div>
                                                </div>


                                                <?php
                                                if ($d["count"] == 0) {
                                                ?>
                                                      <div class="col-6  d-grid pt-2">
                                                            <div class="row pe-1 ">
                                                                  <button class="bton redco text-light" onclick="permentdeletModal(<?php echo $d['pid'] ?>);">Delete</button>
                                                            </div>
                                                      </div>
                                                      <div class="col-6  d-grid  pt-2 me-0 ms-auto">
                                                            <div class="row  ps-1">
                                                                  <button class="bton blubac text-light" onclick="exdateupdateModal(<?php echo $d['pid'] ?>)">Edit</button>
                                                            </div>
                                                      </div>
                                                <?php
                                                } else {

                                                ?>
                                                      <div class="col-12  d-grid  pt-2 me-0 ms-auto">
                                                            <div class="row  ps-1">
                                                                  <button class="bton blubac text-light" onclick="exdateupdateModal(<?php echo $d['pid'] ?>)">Edit</button>
                                                            </div>
                                                      </div>
                                                <?php
                                                }

                                                ?>

                                          </div>
                                    </div>
                              </div>
                        </div>
                  <?php
                  }

                  ?>
                  <div class="col-12 text-center mt-3">
                        <?php
                        if ($resultset->num_rows != 0) {

                        if ($page != 1) {
                        ?>
                              <button class="btn1" onclick="expiredpro(<?php echo $page - 1 ?>);"><i class="icofont-rounded-double-left"></i></button>

                        <?php
                        } else {
                        ?>
                              <button class="btn1"><i class="icofont-rounded-double-left"></i></button>

                        <?php
                        }
                        $q = "SELECT product.`pid`, brand.`bname`,product.`model`,product.`img`,product.`qty`,product.`price`,product.`expire_date`,user_has_product.invo_id, COUNT(user_has_product.`invo_id`) AS `count`
                         FROM product INNER JOIN brand ON product.`brand_id`=brand.`bid`LEFT JOIN user_has_product ON user_has_product.`product_pid`=product.`pid` 
                         WHERE  product.`expire_date` !='0000-00-00' AND product.`expire_date`<'" . $date . "' GROUP BY product.`pid` ";
                        $resultset = DB::search($q);
                        $row = $resultset->num_rows;
                        $num = $row / 12;
                        $n = intval($num);
                        if ($row % 12 != 0) {
                              $n = $n + 1;
                        }
                        for ($i = 1; $i <= $n; $i++) {
                        ?>
                              <button class="btn1" onclick="expiredpro(<?php echo $i ?>);"><?php echo $i ?></button>

                        <?php
                        }
                        if ($page != $n && $row != 0) {
                        ?>
                              <button class="btn1" onclick="expiredpro(<?php echo $page + 1 ?>);"><i class="icofont-rounded-double-right"></i></button>

                        <?php
                        } else {
                        ?>
                              <button class="btn1"><i class="icofont-rounded-double-right"></i></button>

                        <?php
                        }}
                        ?>
                  </div>
            </div>


      </div>

<?php

}
?>