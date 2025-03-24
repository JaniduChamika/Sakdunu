<?php
session_start();
require "database.php";
require "head.php";
require "footer.php";
if (isset($_SESSION["userdata"])) {


?>
      <!DOCTYPE html>
      <html>

      <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Purchase History</title>
            <link rel="icon" href="cssfile//baclogoimg//logo2.png" />

            <link rel="stylesheet" href="cssfile//icofont.min.css">
            <link rel="stylesheet" href="cssfile//bootstrap.css">
            <link rel="stylesheet" href="cssfile//head.css" />
            <link rel="stylesheet" href="cssfile//foot.css" />
            <link rel="stylesheet" href="cssfile//userOrders.css">

      </head>

      <body>
            <div class="container-fluid">
                  <?php
                  HD::headview("userOrder");
                  ?>
                  <div class="row mattop heigt480">
                        <div class="col-12 col-md-10 col-lg-12 col-xl-10 col-xxl-9 text-center me-auto ms-auto">
                              <!-- <div class="row"> -->
                              <ul class="nav nav-pills mb-3 w-100 text-center tabpain" id="pills-tab" role="tablist">
                                    <li class="nav-item w-50 p-1 pt-2 p-md-3" role="presentation">
                                          <button class=" btn m-auto silverco w-100 border-secondary active" id="pills-Worder-tab" data-bs-toggle="pill" data-bs-target="#pills-Worder" type="button" role="tab" aria-controls="pills-Worder" aria-selected="false">Waiting Orders</button>
                                    </li>
                                    <li class="nav-item w-50 p-1 pt-2 p-md-3 " role="presentation">
                                          <button class=" btn  m-auto silverco w-100 border-secondary" id="pills-AllOrder-tab" data-bs-toggle="pill" data-bs-target="#pills-AllOrder" type="button" role="tab" aria-controls="pills-AllOrder" aria-selected="true">Delivered Orders</button>
                                    </li>


                              </ul>
                              <!-- </div> -->
                              <div class="tab-content row" id="pills-tabContent">

                                    <div class="tab-pane col-12 fade bg-transparent show active" id="pills-Worder" role="tabpanel" aria-labelledby="pills-Worder-tab"  style="min-height: 450px;">
                                          <div class="row ">
                                                <!-- card  -->

                                                <?php

                                                $uid = $_SESSION["userdata"]["id"];
                                                $invoicers = DB::search("SELECT * FROM `user_has_product` INNER JOIN `invo` ON user_has_product.`invo_id`=invo.`invoid`
                                                INNER JOIN `product` ON user_has_product.`product_pid`=product.`pid` INNER JOIN `dilivery_status` ON invo.`ds_id`=dilivery_status.`d_id` WHERE `user_uid`='" . $uid . "' AND `status` IN('Processing','Packing','Sent')");
                                                $itemrow = $invoicers->num_rows;
                                                if ($itemrow >= 1) {

                                                      for ($i = 0; $i < $itemrow; $i++) {
                                                            $itemd = $invoicers->fetch_assoc();
                                                ?>
                                                            <div class="col-12 col-md-12 col-lg-6 d-grid">
                                                                  <div class="row p-2 p-md-2 ">
                                                                        <div class="col-12 wishcard ">
                                                                              <div class="row  p-2 py-3 pb-4">
                                                                                    <div class="col-5 col-md-4 m-auto p-0">
                                                                                          <img src="   <?php echo $itemd["img"] ?>" class="w-100" />
                                                                                    </div>
                                                                                    <div class="col-7 col-md-8 text-start">
                                                                                          <div class="row h-100 ps-1 ps-md-4">
                                                                                                <table class="h-75 w-100 m-auto ms-1 detailswish">
                                                                                                      <tr>
                                                                                                            <h4 class="d-line ps-0"><?php echo $itemd["title"] ?></h4>

                                                                                                      </tr>
                                                                                                      <tr>
                                                                                                            <td>
                                                                                                                  Invoice Id
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                  <?php echo $itemd["invoid"] ?>
                                                                                                            </td>
                                                                                                      </tr>
                                                                                                      <tr>
                                                                                                            <td class="w-50 ">
                                                                                                                  Price
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                  <?php echo $itemd["price"] ?>.00 <i class="icofont-close-line"></i> <?php echo $itemd["oqty"] ?>
                                                                                                            </td>
                                                                                                      </tr>
                                                                                                      <tr>
                                                                                                            <td>
                                                                                                                  Quantity
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                  <?php echo $itemd["oqty"] ?>
                                                                                                            </td>
                                                                                                      </tr>
                                                                                                      <tr>
                                                                                                            <td>
                                                                                                                  purchased date
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                  <?php echo $itemd["date_purchased"] ?>
                                                                                                            </td>
                                                                                                      </tr>
                                                                                                      <tr>
                                                                                                            <td>
                                                                                                                  status
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                  <?php echo $itemd["status"] ?>

                                                                                                            </td>
                                                                                                      </tr>
                                                                                                </table>
                                                                                          </div>
                                                                                    </div>
                                                                              </div>
                                                                        </div>

                                                                  </div>
                                                            </div>
                                                      <?php
                                                      }
                                                } else {
                                                      ?>
                                                      <div class="col-12 m-auto text-center p-5" style="height: 410px;">
                                                            <span class="m-auto fs-5">You have no items you purchased </span>
                                                            <br />
                                                            <a href="index.php" class="btn silever mt-3 fs-6 px-4">Continue Shopping</a>
                                                      </div>
                                                <?php
                                                }

                                                ?>

                                          </div>
                                    </div>
                                    <div class="tab-pane col-12  fade  bg-transparent " id="pills-AllOrder" role="tabpanel" aria-labelledby="pills-AllOrder-tab" style="min-height: 450px;">
                                          <div class="row" >

                                                <?php

                                                $uid = $_SESSION["userdata"]["id"];
                                                $invoicers = DB::search("SELECT * FROM `user_has_product` INNER JOIN `invo` ON user_has_product.`invo_id`=invo.`invoid`
                                                INNER JOIN `product` ON user_has_product.`product_pid`=product.`pid` INNER JOIN `dilivery_status` ON invo.`ds_id`=dilivery_status.`d_id` WHERE `user_uid`='" . $uid . "' AND `status` IN('Delivered')");
                                                $itemrow = $invoicers->num_rows;
                                                if ($itemrow >= 1) {
                                                      for ($i = 0; $i < $itemrow; $i++) {
                                                            $itemd = $invoicers->fetch_assoc();
                                                ?>
                                                            <div class="col-12 col-md-12 col-lg-6">
                                                                  <div class="row p-2 p-md-2">
                                                                        <div class="col-12 wishcard ">
                                                                              <div class="row  p-2 py-3 pb-4">
                                                                                    <div class="col-5 col-md-4 m-auto p-0">
                                                                                          <img src="   <?php echo $itemd["img"] ?>" class="w-100" />
                                                                                    </div>
                                                                                    <div class="col-7 col-md-8 text-start">
                                                                                          <div class="row h-100 ps-1 ps-md-4">
                                                                                                <table class="h-75 w-100 m-auto ms-1 detailswish">
                                                                                                      <tr>
                                                                                                            <h4 class="d-line ps-0"><?php echo $itemd["title"] ?></h4>

                                                                                                      </tr>
                                                                                                      <tr>
                                                                                                            <td>
                                                                                                                  Invoice Id
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                  <?php echo $itemd["invoid"] ?>
                                                                                                            </td>
                                                                                                      </tr>
                                                                                                      <tr>
                                                                                                            <td class="w-50 ">
                                                                                                                  Price
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                  <?php echo $itemd["price"] ?>.00 <i class="icofont-close-line"></i> <?php echo $itemd["oqty"] ?>
                                                                                                            </td>
                                                                                                      </tr>
                                                                                                      <tr>
                                                                                                            <td>
                                                                                                                  Quantity
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                  <?php echo $itemd["oqty"] ?>
                                                                                                            </td>
                                                                                                      </tr>
                                                                                                      <tr>
                                                                                                            <td>
                                                                                                                  purchased date
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                  <?php echo $itemd["date_purchased"] ?>
                                                                                                            </td>
                                                                                                      </tr>
                                                                                                      <tr>
                                                                                                            <td>
                                                                                                                  status
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                  <?php echo $itemd["status"] ?>

                                                                                                            </td>
                                                                                                      </tr>
                                                                                                      <tr>

                                                                                                            <td colspan="2" class="text-center pt-1"><button class="btn bluco-border w-75" onclick="feedbackModal(<?php echo $itemd['pid'] ?>);"><i class="icofont-ui-text-chat"></i> Review</button></td>
                                                                                                      </tr>
                                                                                                </table>
                                                                                          </div>
                                                                                    </div>
                                                                              </div>
                                                                        </div>

                                                                  </div>
                                                            </div>
                                                      <?php
                                                      }
                                                      ?>
                                                      <div class="modal fade" tabindex="-1" id="feedbacksModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                  <div class="modal-content">
                                                                        <div class="modal-header">
                                                                              <h5 class="modal-title">Review</h5>
                                                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body text-start">
                                                                              <span>Write you Review here</span>
                                                                              <textarea class="form-control mt-2" id="feedContent" style="height: 400px;"></textarea>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                              <button type="button" class="btn silever" data-bs-dismiss="modal" id="closebtnID">Close</button>
                                                                              <button type="button" class="btn silverco" id="feedbtnID">Submit</button>
                                                                        </div>
                                                                  </div>
                                                            </div>
                                                      </div>
                                                <?php

                                                } else {
                                                ?>
                                                      <div class="col-12 m-auto text-center p-5" style="height: 410px;">
                                                            <span class="m-auto fs-5">You have no delivered items </span>
                                                            <br />
                                                            <a href="index.php" class="btn silever mt-3 fs-6 px-4">Continue Shopping</a>
                                                      </div>
                                                <?php
                                                }
                                                ?>

                                          </div>
                                    </div>
                              </div>
                        </div>
                        <div aria-live="polite" aria-atomic="true" class="position-relative bottom-0 end-0" style="z-index: 2000;">

                              <div class="toast-container position-fixed bottom-0 end-0 p-3" id="boxnoteID">



                              </div>
                        </div>
                  </div>
                  <?php

                  FOOT::footview("normal");
                  ?>
            </div>

            <script src="bootstrap.js"></script>
            <script src="commen.js"></script>
            <script src="navhider.js"></script>



      </body>

      </html>

<?php
} else {
?>
      <script src="commen.js"></script>
      <script>
            login();
      </script>
<?php
}
?>