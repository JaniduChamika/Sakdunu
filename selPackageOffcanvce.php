<?php



require "database.php";
date_default_timezone_set("Asia/Colombo");
$date = date("Y-m-d");
if (isset($_POST["packId"])) {
      $packID = $_POST["packId"];
      $q = "SELECT * FROM package WHERE `pack_id`='" . $packID . "'";
      $resultset = DB::search($q);
      if ($resultset->num_rows == 1) {
            $d = $resultset->fetch_assoc();
?>
            <div class="bodyimg"></div>

            <div class="offcanvas-header">
                  <h5 id="offcanvasTopLabel" class=" text-light"><?php echo $d["pack_name"] ?></h5>
                  <button type="button" class="prodcolsebtn" onclick="closeOffacnvas();"><i class="icofont-close"></i></button>

            </div>


            <div class="offcanvas-body">
                  <div class="row">

                        <div class="col-12">
                              <div class="row">
                                    <div class="col-6 col-md-4 col-lg-3 col-xl-2 " onclick="addPackageModel(<?php echo $packID ?>);">
                                          <div class="row p-1 h-100">
                                                <div class="col-12 addingProduct h-100 d-flex align-items-center justify-content-center">
                                                      <div class="fonlarg"><i class="icofont-plus"></i></div>
                                                </div>
                                          </div>
                                    </div>
                                    <?php

                                    $qshop = "SELECT * FROM package INNER JOIN pack_product ON package.pack_id=pack_product.package_id INNER JOIN product ON pack_product.product_pid=product.pid INNER JOIN brand ON product.brand_id=brand.bid WHERE `pack_id`='" . $packID . "'";


                                    $resultsetshop = DB::search($qshop);

                                    $rowshop = $resultsetshop->num_rows;
                                    for ($sho = 0; $sho < $rowshop; $sho++) {
                                          $dshop = $resultsetshop->fetch_assoc();

                                    ?>

                                          <div class="col-6 col-md-4 col-lg-3  col-xl-2  mt-0 mb-0">

                                                <div class="row p-1 h-100">
                                                      <div class=" cardinshop p-2 ">

                                                            <table class=" w-100 h-100 text-dark">
                                                                  <tr>
                                                                        <td class="h-100 position-relative">


                                                                              <img src="<?php echo $dshop["img"] ?>" class="imgcard h-100" />


                                                                        </td>
                                                                  </tr>

                                                                  <tr>
                                                                        <td>


                                                                              <?php echo $dshop["title"] ?>

                                                                        </td>
                                                                  </tr>
                                                                  <tr>
                                                                        <?php
                                                                        if ($dshop["expire_date"] <= $date) {
                                                                        ?>
                                                                              <td class="texbot text-danger"><?php echo $dshop["expire_date"] ?> &nbsp;<b>Expired</b></td>

                                                                        <?php
                                                                        } else if ($dshop["delete"] == "1") {
                                                                        ?>
                                                                              <td class="texbot text-danger fw-bold">Deleted Product</td>


                                                                        <?php
                                                                        } else if( $dshop["expire_date"] !="9999-12-20") {
                                                                        ?>
                                                                              <td class="texbot"><?php echo $dshop["expire_date"] ?></td>

                                                                        <?php
                                                                        }
                                                                        ?>

                                                                  </tr>
                                                                  <tr>
                                                                        <?php
                                                                        if ($dshop["qty"] == "0") {
                                                                        ?>
                                                                              <td class="texbot text-danger fw-bold">
                                                                                   Out of Stock

                                                                              </td>
                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                              <td class="texbot">
                                                                                  In Stock <?php echo $dshop["qty"] ?>

                                                                              </td>
                                                                        <?php
                                                                        }
                                                                        ?>

                                                                  </tr>
                                                                  <tr>
                                                                        <td class="texbot">Rs.<?php echo number_format($dshop["price"], 2) ?>


                                                                        </td>
                                                                  </tr>
                                                                  <tr>
                                                                        <td>
                                                                              <button class="btn redco w-100 text-light mb-1 py-1" value="<?php echo $packID ?>" id="PackProductID<?php echo $dshop["pid"] ?>" onclick="removeProductPack(<?php echo $dshop['pid'] ?>);">Remove</button>

                                                                              <a class="btn bluco w-100 text-light py-1" href="productpage.php?pid=<?php echo  $dshop['pid'] ?>" target="_blank">View</a>
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
                        </div>
                        <!-- product adding modal  -->
                        <div class="modal fade modalmybac p-0" data-bs-backdrop="static" tabindex="-1" id="addProductPackageModel">
                              <div class="modal-dialog modal-xl modal-fullscreen-lg-down">
                                    <div class="modal-content" id="addProductModelContentID">

                                          <div class="modal-header">
                                                <span class="modal-title fs-4 ">Add Product to Package</span></span>
                                                <button type="button" class="btn text-dark fs-3" data-bs-dismiss="modal" aria-label="Close" onclick="VeiwOffcanvasPackage(<?php echo $packID ?>);"><i class="icofont-close"></i></button>
                                          </div>
                                          <div class="modal-body">
                                                <div class="col-12">
                                                      <div class="input-group mb-3">
                                                            <select class="form-select w-25" id="categoryselectID" aria-label="Example select with button addon" onchange="getPackProduct(1,<?php echo $packID ?>)">
                                                                  <option selected="" value="All">All Category</option>
                                                                  <?php
                                                                  $qhead = "SELECT * FROM main_category ;";
                                                                  $resultsethead = DB::search($qhead);
                                                                  $rhed = $resultsethead->num_rows;
                                                                  for ($i = 0; $i < $rhed; $i++) {
                                                                        $dhed = $resultsethead->fetch_assoc();
                                                                  ?>
                                                                        <option value="<?php echo $dhed['mid'] ?>">
                                                                              <?php echo $dhed['name'] ?>
                                                                        </option>
                                                                  <?php
                                                                  }
                                                                  ?>
                                                            </select>
                                                            <input type="text" class="form-control w-50" placeholder="Name or Brand" aria-label="Recipient's username" id="titletag" aria-describedby="button-addon2">
                                                            <button class="btn peoblu text-light w-25" type="button" id="prosearchFroPackBtn" onclick="getPackProduct(1,<?php echo $packID ?>)">Search</button>
                                                      </div>
                                                </div>
                                                <div class="col-12" id="prodcutViewPackage">
                                                      <div class="row p-2">
                                                            <?php
                                                            $page = 1;
                                                            $need = 12;
                                                            $offset = ($page - 1) * 12;
                                                            $qshop = "SELECT * FROM product INNER JOIN brand ON product.`brand_id`=brand.`bid` WHERE product.`expire_date`>'" . $date . "' AND product.`qty`!='0' AND product.`delete`='0' LIMIT $offset,12";


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
                                                            $q = "SELECT * FROM product WHERE product.`expire_date`>'" . $date . "'AND product.`qty`!='0' AND product.`delete`='0'";
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

                                                </div>
                                          </div>
                                          <div class="modal-footer">
                                                <button type="button" class="btn silever" data-bs-dismiss="modal" onclick="VeiwOffcanvasPackage(<?php echo $packID ?>);">Close</button>

                                          </div>
                                    </div>
                              </div>
                        </div>
                        <!-- product adding modal  -->

                  </div>

            </div>
<?php

      }
} else {
      echo "Somthing Wrong";
}
?>