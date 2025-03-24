<?php
require "database.php";
if (isset($_POST["invoid"])) {
      $invoid = $_POST["invoid"];

?>


      <div class="offcanvas-header">
            <h5 id="offcanvasTopLabel">Products in invoice</h5>

            <select class="w-50 form-select m-auto" id="DstatusID" onchange="deliveryChange('<?php echo $invoid ?>');">
                  <?php
                  $q = "SELECT * FROM invo  WHERE `invoid`='" . $invoid . "'";
                  $resultset = DB::search($q);
                  $dinvo = $resultset->fetch_assoc();
                  $q = "SELECT * FROM  dilivery_status ";
                  $resultset = DB::search($q);
                  for ($i = 0; $i < $resultset->num_rows; $i++) {
                        $d = $resultset->fetch_assoc();
                        if ($dinvo["ds_id"] == $d["d_id"]) {
                  ?>
                              <option value="<?php echo $d["d_id"] ?>" selected=""><?php echo $d["status"] ?></option>
                        <?php
                        } else {
                        ?>
                              <option value="<?php echo $d["d_id"] ?>"><?php echo $d["status"] ?></option>
                  <?php
                        }
                  }
                  ?>


            </select>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"><i class="icofont-close"></i></button>
      </div>
      <div class="offcanvas-body scroll4 offscrollrow" onmouseover="doo(4);">
            <div class=" cardboxsample   d-inline-flex " id="productViewBoxID">


                  <?php

                  $q = "SELECT * FROM user_has_product INNER JOIN product ON user_has_product.`product_pid`=product.`pid` INNER JOIN brand ON brand.`bid`=product.`brand_id` WHERE user_has_product.`invo_id`='" . $invoid . "' ";
                  $resultset = DB::search($q);
                  for ($i = 0; $i < $resultset->num_rows; $i++) {
                        $d = $resultset->fetch_assoc();
                  ?>
                        <div class="samplecard pb-2" style="width: 200px;">
                              <table>
                                    <tr>
                                          <td class="un">
                                                <a href="productpage.php?pid=<?php echo  $d['pid'] ?>" target="_blank" class="text-decoration-none">
                                                      <img src="<?php echo $d["img"] ?>" class="cardimgsample" />
                                                </a>
                                          </td>
                                    </tr>
                                    <tr>
                                          <td class="desshort">
                                                <?php echo $d["title"] ?>
                                          </td>
                                    </tr>
                                    <tr>
                                          <td class="desshort">
                                                Quintity : <?php echo $d["oqty"] ?>
                                          </td>
                                    </tr>
                                    <tr>
                                          <td class="desshort">
                                                Unit Price Rs : <?php echo $d["price"] ?>.00
                                          </td>
                                    </tr>

                              </table>
                        </div>



                  <?php

                  }
                  ?>

            </div>


      </div>

<?php
}

?>