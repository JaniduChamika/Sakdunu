<?php
session_start();
require "database.php";
if (isset($_SESSION["userdata"])) {
      $uid = $_SESSION["userdata"]["id"];
      $invoid = $_GET["id"];
      // $invoid = "@10312860377";
      require "head.php";

?>
      <!DOCTYPE html>
      <html>

      <head>
            <title>Sakdunu | Invoice</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="icon" href="cssfile//baclogoimg//logo2.png" />
            <link rel="stylesheet" href="cssfile//icofont.min.css" />
            <link rel="stylesheet" href="cssfile//bootstrap.css" />
            <link rel="stylesheet" href="cssfile//head.css" />
            <link rel="stylesheet" href="cssfile//invoice.css" />
            <link rel="stylesheet" href="cssfile//foot.css" />
      </head>

      <body>
            <div class="container-fluid">
                  <?php
                  HD::headview("profile");

                  ?>
                  <div class="row pt-4 ">


                        <div class="col-12">
                              <hr />
                        </div>
                        <div class="col-12 btn-toolbar justify-content-end pb-3">
                              <button class="btn btn-dark me-2" value="click" onclick="printDiv()"><i class="bi bi-printer-fill"></i> Print</button>
                              <!-- <button class="btn btn-danger me-2" onclick="printDiv()"><i class="bi bi-file-earmark-pdf-fill"></i> Save as PDF</button> -->

                        </div>
                        <hr />
                        <div class="col-12 foncurior" id="GFG">
                              <div class="row">

                                    <div class="col-12">
                                          <div class="row backrow py-3 px-2">
                                                <div class="col-6 d-flex align-items-center">
                                                      <div class="divimg" style="background-image: url('cssfile//baclogoimg//logo2.png');"></div>
                                                </div>
                                                <div class="col-6 text-end text-white">
                                                      <div class="row">
                                                            <div class="col-12 text-end text-decoration-underline text-white">

                                                                  <h2>Sakdunu Super</h2>
                                                            </div>
                                                            <di class="col-12 text-end ">
                                                                  <span>23/z, Kadawatha Rd, Ganemulla</span>
                                                                  <br />
                                                                  <span>+9268529792</span>
                                                                  <br />

                                                                  <span>Sakdunu@gmail.com</span>
                                                            </di>
                                                      </div>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="col-12">
                                          <hr />
                                    </div>
                                    <div class="col-12">
                                          <div class="row">


                                                <div class="col-12 col-lg-6">
                                                      <h5>INVOICE TO :</h5>
                                                      <?php
                                                      $ar;
                                                      $addrsess_delivery = DB::search("SELECT * FROM `delivery_info` INNER JOIN `invoce_delivary_address`  ON delivery_info.`d_add`=invoce_delivary_address.`delivery_info_id`
                                                     INNER JOIN `dilevery_fee`ON delivery_info.`district_id`=dilevery_fee.`district_id` WHERE `invoid`='" . $invoid . "'");
                                                      if ($addrsess_delivery->num_rows == 1) {
                                                            $ar = $addrsess_delivery->fetch_assoc();
                                                      } else {
                                                            $addrsess = DB::search("SELECT * FROM `user_address` INNER JOIN dilevery_fee ON user_address.`district_id`=dilevery_fee.`district_id` WHERE `user_id`='" . $uid . "'  ");
                                                            $ar = $addrsess->fetch_assoc();
                                                      }

                                                      $deliveryFee = $ar["fee"];
                                                      $userinvo = DB::search("SELECT * FROM `invo` INNER JOIN `user` ON invo.`user_uid`=user.`id` WHERE invo.`invoid`='" . $invoid . "'");
                                                      $userdetail = $userinvo->fetch_assoc();
                                                      ?>
                                                      <span><?php echo $userdetail["first_name"] . " " . $userdetail["last_name"] ?> </span><br />
                                                      <span class="">Address : <?php echo $ar["address_no"] . "," . $ar["address_line1"] . "," . $ar["address_line2"] ?>.</span>
                                                      <br />
                                                      <span class="">Postal Code : <?php echo $ar["postalcode"] ?> </span>
                                                      <br />

                                                      <span class="">Contact : <?php echo $userdetail["mobile"]  ?> </span>
                                                      <br />
                                                      <span class="">Email Address : <?php echo $userdetail["email"]  ?> </span>

                                                </div>

                                                <?php
                                                $invoicers = DB::search("SELECT * FROM `invo` WHERE `invoid`='" . $invoid . "'");
                                                $in = $invoicers->num_rows;

                                                $ir = $invoicers->fetch_assoc();


                                                ?>
                                                <div class="col-12 col-lg-6 text-lg-end mt-4">
                                                      <h2 class="text-primary">INVOICE <?php echo $invoid ?></h2>
                                                      <span class="">Date and time of invoice :</span>
                                                      <span class=""> <?php echo $ir["date_purchased"] ?></span>


                                                </div>
                                          </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                          <table class="table ">
                                                <thead>
                                                      <tr>
                                                            <th class="text-center">#</th>
                                                            <th class="ps-4">Product</th>
                                                            <th class="text-center">Unit Price</th>
                                                            <th class="text-center">Quantity</th>
                                                            <th class="text-end pe-3">Total</th>
                                                            <!-- <th>#</th> -->

                                                      </tr>
                                                </thead>
                                                <tbody>
                                                      <?php
                                                      $invoicers = DB::search("SELECT * FROM `user_has_product` INNER JOIN `invo` ON user_has_product.`invo_id`
                                                      =invo.`invoid` INNER JOIN `product` ON user_has_product.`product_pid`=product.`pid` WHERE `invoid`='" . $invoid . "'");
                                                      $in = $invoicers->num_rows;

                                                      $subtotal = 0;
                                                      for ($i = 0; $i < $in; $i++) {
                                                            $irs = $invoicers->fetch_assoc();


                                                            $subtotal = $subtotal + ($irs["price"] * $irs["oqty"]);
                                                      ?>
                                                            <tr>
                                                                  <td class=" text-white fs-3 text-center " style="background-color: rgb(0, 0, 230);"><?php echo $i + 1 ?></td>
                                                                  <td class="py-3">
                                                                        <a href="productpage.php?pid=<?php echo  $irs['pid'] ?>" target="_blank" class="fs-6 fw-bold p-2"><?php echo $irs["title"] ?></a>
                                                                  </td>
                                                                  <td class="fs-6 text-center pt-3" style="background-color: rgb(199,199,199);">
                                                                        Rs <?php echo $irs["price"] ?>.00
                                                                  </td>
                                                                  <td class="fs-6 text-center pt-3">
                                                                        <?php echo $irs["oqty"] ?>
                                                                  </td>
                                                                  <td class="fs-6 text-end pe-3 pt-3 text-white" style="background-color: rgb(0, 0, 230);">
                                                                        Rs <?php echo $irs["price"] * $irs["oqty"]  ?>.00

                                                                  </td>
                                                            </tr>

                                                      <?php
                                                      }

                                                      ?>
                                                </tbody>
                                                <tfoot class="trborder">
                                                      <tr>
                                                            <td colspan="2" class="border-0"></td>
                                                            <td colspan="2" class="fs-5 text-end">SUBTOTAL</td>
                                                            <td class="text-end fs-5 pe-3">Rs. <?php echo $subtotal ?>.00</td>

                                                      </tr>
                                                      <tr>
                                                            <td colspan="2" class="border-0"></td>
                                                            <td colspan="2" class="fs-5 text-end ">Delivary Fee</td>
                                                            <td class="text-end fs-5 text-end  pe-3">Rs. <?php echo $deliveryFee ?>.00</td>

                                                      </tr>
                                                      <tr>
                                                            <td colspan="2" class="border-0"></td>
                                                            <td colspan="2" class="fs-5 text-end border-primary">DISCOUNT</td>
                                                            <td class="text-end fs-5 text-end border-primary pe-3">Rs. <?php echo $irs["discount"] ?>.00</td>

                                                      </tr>

                                                      <tr>
                                                            <td colspan="2" class="border-0"></td>
                                                            <td colspan="2" class="fs-4 text-end border-0 text-primary">GRAND TOTAL</td>
                                                            <td class="text-end fs-5 text-end border-0 text-primary pe-3">Rs. <?php echo $subtotal  + $deliveryFee - $irs["discount"] ?>.00</td>

                                                      </tr>
                                                </tfoot>
                                          </table>
                                    </div>
                                    <div class="col-4 text-center" style="margin-top: -100px; margin-bottom: 50px;">
                                          <span class="fs-1">Thank You!</span>
                                    </div>
                                    <div class="col-12">
                                          <div class="row">
                                                <div class="col-12 mt-3 mb-3 py-3 leftborder rounded " style="background-color: #e7f2FF;">
                                                      <label class="form-label fs-5 fw-bold">NOTICE :</label>
                                                      <label class="form-label fs-5 ">Purchased items Cannot return</label>

                                                </div>
                                          </div>
                                    </div>
                                    <div class="col-12">
                                          <hr class="border border-1 " />
                                    </div>
                                    <div class="col-12 mb-3 text-center">
                                          <label class="form-label fs-6 text-black-50">
                                                Invoice was Created on a computer and is valid without the signature and seal
                                          </label>
                                    </div>

                              </div>
                        </div>
                        <?php
                        require "footer.php";
                        ?>




                  </div>
            </div>

            <script src="commen.js"></script>
            <script src="bootstrap.js"></script>
      </body>

      </html>
<?php
} else {
?>

      <script>
            window.location = "login.php";
      </script>
<?php


}

?>