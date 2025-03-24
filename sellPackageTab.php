<?php
require "database.php";
date_default_timezone_set("Asia/Colombo");
$date = date("Y-m-d");
?>
<div class="col-12 ">
      <div class="row p-1 p-md-3 pb-md-1">

            <div class="col-12 boxpackage">
                  <div class="row p-2 p-lg-4 pb-lg-0">


                        <h4 class="text-light">Package</h4>
                        <div class="col-12 col-md-4 col-xxl-5 text-center order-md-last">

                              <div class="wrap-custom-file packwrap">

                                    <input type="file" style="display: none;" onchange="imgveiwpackage();" accept="image/*" class="upload1" id="imagepackID" />
                                    <label for="imagepackID" class="imagbox2" style="background-image: ('none');" id="labelpImagepack">
                                          <span class="d-none"></span>
                                    </label>
                              </div>

                        </div>
                        <div class="col-12 col-md-8 col-xxl-7 text-light">
                              <div class="row inputpackage">

                                    <div class="col-12 col-md-6 p-0 p-md-2 ">
                                          <label>Packag Name</label>
                                          <br />
                                          <input class="form-control w-100 mt-1" id="packNameID" type="text" />
                                    </div>
                                    <div class="col-12 col-md-6 p-0 p-md-2">
                                          <label>Discount</label>

                                          <div class="input-group mt-1">
                                                <input type="number" onkeyup="sizechange();" id="packDiscount" min="0" max="60" class="form-control">
                                                <span class="input-group-text inputspan">%</span>
                                          </div>

                                    </div>
                                    <div class="col-12 col-md-6 p-0 p-md-2 ">
                                          <label for="packStartDate">Start Date</label>
                                          <br />

                                          <input class="form-control w-100 mt-1" id="packStartDate" type="date" />
                                    </div>
                                    <div class="col-12 col-md-6 p-0 p-md-2">
                                          <label>End Date</label>
                                          <br />

                                          <input class="form-control w-100 mt-1" id="packEndDate" type="date" />
                                    </div>



                              </div>
                        </div>


                  </div>
                  <div class="row  p-0 p-md-3 pt-md-2">
                        <div class="text-end">
                              <button class="btn silever createbtn text-light mt-2 me-2 px-4 px-md-5" onclick="clearField();">Clear</button>

                              <button class="btn bluco createbtn text-light mt-2 px-4 px-md-5" id="creatPackBtnID" onclick="createPackage();">Create</button>
                              <button class="btn greenco createbtn text-light mt-2 px-4  px-md-5 d-none" id="updatePackBtnID">Update</button>

                        </div>
                  </div>


            </div>

      </div>
      <!-- end infomation inset and update  -->

      <!-- package view -->

      <div class="row p-1 p-md-3" id="packageCardBoxID">
            <?php
            $q = "SELECT * FROM package";
            $resultset = DB::search($q);
            for ($i = 0; $i < $resultset->num_rows; $i++) {
                  $d = $resultset->fetch_assoc();

                  
                  $q2 = "SELECT * FROM pack_product INNER JOIN product ON `pack_product`.product_pid=`product`.pid WHERE (`expire_date`<='" . $date . "' OR `delete`='1' OR product.`qty`='0') AND `package_id`='" . $d["pack_id"] . "'";
                  $resultset2 = DB::search($q2);
                  $cardcolor="";
                  if ($resultset2->num_rows != 0) {
                        $cardcolor="transred";

                  }
            ?>
                  <div class="col-12 col-md-6 col-xl-4 d-grid " onclick="getPackageDetails(<?php echo $d['pack_id'] ?>);">
                        <div class="row p-2 h-100">
                              <div class="col-12 realcardPackage position-relative  ">
                                    <?php
                                    if ($d["discount"] != 0) {
                                    ?>
                                          <div class="position-absolute disView text-center pt-2">
                                                <span class="fw-bold">-<?php echo $d["discount"]; ?>% OFF</span>
                                          </div>
                                    <?php
                                    }
                                    ?>
                                    <div class="row p-2 h-100 <?php echo $cardcolor ?>">
                                          <div class="col-5 p-0 ">

                                                <img src="<?php echo $d["img"] ?>" class="w-100" />
                                          </div>
                                          <div class="col-7 ps-2 ">
                                                <table class="h-100">
                                                      <tr>
                                                            <td class="fw-bold">
                                                                  <?php echo $d["pack_name"]; ?>

                                                            </td>

                                                      </tr>
                                                      <tr>
                                                            <td>
                                                                  <?php echo $d["strat_date"]; ?> (Start)


                                                            </td>

                                                      </tr>
                                                      <tr>
                                                            <?php
                                                            if ($d["end_date"] < $date) {
                                                            ?>
                                                                  <td class="text-danger">
                                                                        <?php echo $d["end_date"]; ?> (end)
                                                                  </td>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                  <td>
                                                                        <?php echo $d["end_date"]; ?> (end)
                                                                  </td>
                                                            <?php
                                                            }
                                                            ?>
                                                      </tr>
                                                      <tr>
                                                            <?php
                                                            $q = "SELECT SUM(product.`price`) AS `total_price` FROM pack_product INNER JOIN product ON pack_product.`product_pid`=product.`pid` 
                             WHERE pack_product.`package_id`='" . $d["pack_id"] . "' AND product.`expire_date`>'" . $date . "' ";
                                                            $resultsetIn = DB::search($q);
                                                            if ($resultsetIn->num_rows == 1) {
                                                                  $din = $resultsetIn->fetch_assoc();
                                                                  $realPrice = $din["total_price"];
                                                                  $newPrice = $realPrice - ceil($realPrice * ($d["discount"] / 100));
                                                            ?>

                                                                  <td>

                                                                        Rs.<?php echo number_format($newPrice, 2) ?>

                                                                  </td>
                                                            <?php
                                                            }
                                                            ?>

                                                      </tr>
                                                      <tr>
                                                            <td class="text-decoration-line-through">

                                                                  <?php

                                                                  if ($d["discount"] != 0) {
                                                                  ?>
                                                                        Rs.<?php echo number_format($realPrice, 2) ?>
                                                                  <?php
                                                                  }
                                                                  ?>
                                                            </td>

                                                      </tr>

                                                </table>


                                          </div>
                                          <div class="col-12 d-flex align-items-end ">
                                                <button class="btn bluco w-100 text-light mt-2 " onclick="VeiwOffcanvasPackage(<?php echo $d['pack_id'] ?>);"><i class="icofont-eye"></i> View</button>
                                          </div>

                                    </div>
                              </div>
                        </div>
                  </div>

            <?php
            }
            ?>

      </div>
      <!-- package view -->
      <div class="offcanvas offcanvas-top h-100 p-0" tabindex="-1" id="offcanvasToppackage" aria-labelledby="offcanvasTopLabel">
            <div class="bodyimg"></div>
            <!-- selPackageOffcanvce.php  -->

      </div>

</div>