<?php
require "database.php";
if (isset($_POST) && isset($_POST["id"])) {
      $what = $_POST["what"];
      $id = $_POST["id"];
      if ($what == "main") {

            $q = "SELECT * FROM main_category WHERE `mid`='" . $id . "'";
            $resultset = DB::search($q);
            if ($resultset->num_rows == 1) {


                  $d = $resultset->fetch_assoc();
?>

                  <div class="modal-content">
                        <div class="modal-header">
                              <h5 class="modal-title">Main Category</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="icofont-close"></i></button>
                        </div>
                        <div class="modal-body">
                              <div class="mb-3">
                                    <label class="form-label">Change Main Category Image</label>
                                    <br />
                                    <div class="wrap-custom-file packwrap mx-auto mb-2">

                                          <input type="file" style="display: none;" onchange="AdvaImgveiw();" accept="image/*" class="upload1" id="changeImgID" />
                                          <label for="changeImgID" class="defultimg imagbox" id="labelpImagepack" style="background-image: url('<?php echo $d["img_path"] ?>');">
                                                <span class="d-none"></span>
                                          </label>
                                    </div>

                                    <br />

                                    <label for="renameInputID" class="form-label">Rename Main Category Name</label>

                                    <input type="email" class="form-control" value="<?php echo $d["name"] ?>" id="renameInputID" placeholder="Type Rename">


                              </div>
                        </div>
                        <div class="modal-footer">
                              <?php
                              $q = "SELECT *  FROM 
                              sub_catergory LEFT JOIN product ON sub_catergory.main_category_id=product.main_category_id
                             WHERE sub_catergory.main_category_id='" . $id . "' UNION  SELECT * FROM sub_catergory RIGHT JOIN 
                             product ON sub_catergory.main_category_id=product.main_category_id  WHERE product.`main_category_id`='" . $id . "'";
                              $resultset3 = DB::search($q);
                              if ($resultset3->num_rows == 0) {
                              ?>
                                    <button type="button" class="btn redco ms-0 me-auto" onclick="Deletemain(<?php echo $id ?>);">Delete</button>
                              <?php
                              }
                              ?>
                              <button type="button" class="btn silever" data-bs-dismiss="modal" id="cancelbtnrenameID">Close</button>
                              <button type="button" class="btn bluco text-light" onclick="renameSavemain(<?php echo $id ?>);">Save changes</button>
                        </div>
                  </div>
            <?php
            } else {
                  echo "error";
            }
      } else if ($what == "sub") {
            $q = "SELECT * FROM sub_catergory WHERE `sid`='" . $id . "'";
            $resultset = DB::search($q);
            if ($resultset->num_rows == 1) {

                  $d = $resultset->fetch_assoc();

            ?>
                  <div class="modal-content">
                        <div class="modal-header">
                              <h5 class="modal-title">Sub Category</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="icofont-close"></i></button>
                        </div>
                        <div class="modal-body">
                              <div class="mb-3">
                                    <label for="renameInputID" class="form-label">Rename Sub Category Name</label>

                                    <input type="email" class="form-control" value="<?php echo $d["name"] ?>" id="renameInputID" placeholder="Type Rename">


                              </div>
                        </div>
                        <div class="modal-footer">
                              <?php
                              $q = "SELECT * FROM 
                              subcategory_has_brand LEFT JOIN product ON subcategory_has_brand.sub_catergory_sid=product.sub_catergory_id
                             WHERE subcategory_has_brand.sub_catergory_sid='" . $id . "' UNION  SELECT * FROM subcategory_has_brand 
                             RIGHT JOIN product ON subcategory_has_brand.sub_catergory_sid=product.sub_catergory_id  WHERE product.`sub_catergory_id`='" . $id . "' ";
                              $resultset3 = DB::search($q);
                              if ($resultset3->num_rows == 0) {
                              ?>
                                    <button type="button" class="btn redco ms-0 me-auto" onclick="Deletesub(<?php echo $id ?>);">Delete</button>
                              <?php
                              }
                              ?>
                              <button type="button" class="btn silever" data-bs-dismiss="modal" id="cancelbtnrenameID">Close</button>
                              <button type="button" class="btn bluco text-light" onclick="renameSavesub(<?php echo $id ?>);">Save changes</button>
                        </div>
                  </div>
            <?php
            } else {
                  echo "error";
            }
      } else if ($what == "brand") {
            $q = "SELECT * FROM brand WHERE `bid`='" . $id . "'";
            $resultset = DB::search($q);
            if ($resultset->num_rows == 1) {

                  $d = $resultset->fetch_assoc();


            ?>
                  <div class="modal-content">
                        <div class="modal-header">
                              <h5 class="modal-title">Brand</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="icofont-close"></i></button>
                        </div>
                        <div class="modal-body">
                              <div class="mb-3">
                                    <label for="renameInputID" class="form-label">Rename Brand Name</label>
                                    <?php
                                    $q = "SELECT * FROM product INNER JOIN user_has_product ON product.`pid`=user_has_product.`product_pid` WHERE product.`brand_id`='" . $id . "'";
                                    $resultset2 = DB::search($q);
                                    if ($resultset2->num_rows == 0) {
                                    ?>
                                          <input type="email" class="form-control" value="<?php echo $d["bname"] ?>" id="renameInputID" placeholder="Type Rename">
                                    <?php
                                    } else {
                                    ?>
                                          <input type="email" class="form-control" disabled="" value="<?php echo $d["bname"] ?>" id="renameInputID" placeholder="Rename">
                                          <p class="smalfon text-danger">You have orders for products of this brand. We cannot allow you to rename this brand for security reasons.</p>
                                    <?php
                                    }
                                    ?>

                                    <label class="mt-2 form-label">Add another sub category</label>
                                    <select class="form-select" id="reselcatergoryrobrand" onchange="getsubforBrandrename(<?php echo $id ?>)">
                                          <option value="none">Select Main Category</option>
                                          <?php
                                          $qgetmain = "SELECT * FROM main_category";
                                          $resultsetgetmain = DB::search($qgetmain);
                                          $rgetmain = $resultsetgetmain->num_rows;
                                          for ($imain = 0; $imain < $rgetmain; $imain++) {
                                                $dmain = $resultsetgetmain->fetch_assoc();
                                          ?>
                                                <option value="<?php echo $dmain["mid"] ?>"><?php echo $dmain["name"] ?></option>
                                          <?php

                                          }
                                          ?>
                                    </select>

                                    <div class="mt-2 w-100 px-2">
                                          <div class="row" id="subcaterBoxrename">


                                          </div>
                                    </div>
                              </div>
                        </div>
                        <div class="modal-footer">
                              <?php
                              $q = "SELECT * FROM product  WHERE product.`brand_id`='" . $id . "'";
                              $resultset3 = DB::search($q);
                              if ($resultset3->num_rows == 0) {
                              ?>
                                    <!-- <button type="button" class="btn redco ms-0 me-auto" onclick="Deletebrand(<?php echo $id ?>);">Delete</button> -->
                              <?php
                              }
                              ?>
                              <button type="button" class="btn silever" data-bs-dismiss="modal" id="cancelbtnrenameID">Close</button>

                              <button type="button" class="btn bluco text-light" onclick="renameSavebrand(<?php echo $id ?>);">Save changes</button>

                        </div>
                  </div>
<?php
            } else {
                  echo "error";
            }
      }
} else {
      echo "error";
}
?>