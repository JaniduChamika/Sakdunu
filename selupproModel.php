<?php
require "database.php";

$pid = $_POST["pid"];
$from = $_POST["from"];
$q = "SELECT * FROM product WHERE `pid`='" . $pid . "'";


$resultset = DB::search($q);

$d = $resultset->fetch_assoc();
$reOrder = DB::search("SELECT * FROM `user_has_product` WHERE `product_pid`='" . $pid . "'");
$disable = "";
if ($reOrder->num_rows >= 1) {
      $disable = 'disabled="" data-bs-toggle="tooltip" data-bs-placement="top" title="Disabled"';
}

// table veiw 
if ($from == "table") {
?>


      <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="icofont-close"></i></button>
      </div>
      <div class="modal-body">
            <div class="row">
                  <div class="col-12  updatbox">

                        <table class="wid100 tabbotran">
                              <td>Image</td>
                              <td colspan="2 p-0">
                                    <div class="wrap-custom-file p-0">

                                          <input type="file" style="display: none;" onchange="imgveiwupdate();errorclearupdate(8);" accept="image/*" class="upload1" id="pImageupdate" />
                                          <label for="pImageupdate" class="defultimg" id="labelpImageupdate" style="background-image: url('<?php echo $d["img"] ?> ');">
                                                <span></span>
                                          </label>
                                    </div>
                              </td>
                              <td>
                                    <p id="updatefilenameview"></p>
                              </td>
                              <tr>
                                    <td class=" barntd2 updeltd ">Category</td>
                                    <td colspan="3" class=" lgtdup updeltd">
                                          <select class="bran" id="updatemaincoterid" onchange="errorclearupdate(1);setsubcategoryupdate();" <?php echo $disable ?>>
                                                <option value="none">Select Main Category</option>

                                                <?php

                                                $q1 = "SELECT * FROM main_category;";
                                                $resultset1 = DB::search($q1);
                                                $r1 = $resultset1->num_rows;

                                                for ($i = 0; $i < $r1; $i++) {
                                                      $d1 = $resultset1->fetch_assoc();
                                                      if ($d["main_category_id"] == $d1["mid"]) {
                                                ?>
                                                            <option value="<?php echo $d1['mid']; ?>" selected=""><?php echo $d1["name"] ?></option>

                                                      <?php
                                                      } else {

                                                      ?>
                                                            <option value="<?php echo $d1['mid']; ?>"><?php echo $d1["name"] ?></option>
                                                <?php
                                                      }
                                                }
                                                ?>

                                          </select>
                                    </td>
                              </tr>
                              <tr>

                                    <td class=" barntd2 updeltd ">Sub</td>
                                    <td colspan="3" class=" lgtdup updeltd">
                                          <select class="bran" id="updatesubcaterId" onchange="errorclearupdate(2);setbrandupdate();" <?php echo $disable ?>>
                                                <option value="none">Select Sub Category</option>

                                                <?php

                                                $q1 = "SELECT * FROM sub_catergory;";
                                                $resultset1 = DB::search($q1);
                                                $r1 = $resultset1->num_rows;

                                                for ($i = 0; $i < $r1; $i++) {
                                                      $d1 = $resultset1->fetch_assoc();

                                                      if ($d["sub_catergory_id"] == $d1["sid"]) {
                                                ?>
                                                            <option value="<?php echo $d1['sid']; ?>" selected=""><?php echo $d1["name"] ?></option>

                                                      <?php
                                                      } else {
                                                      ?>
                                                            <option value="<?php echo $d1['sid']; ?>"><?php echo $d1["name"] ?></option>
                                                <?php
                                                      }
                                                }
                                                ?>

                                          </select>
                                    </td>
                              </tr>

                              <tr>


                                    <td class=" barntd2 updeltd ">Brand</td>
                                    <td colspan="3" class=" lgtdup updeltd">
                                          <select class="bran" id="updateinbrand" onchange="errorclearupdate(3);" <?php echo $disable ?>>
                                                <option value="none">Select Brand</option>

                                                <?php

                                                $q1 = "SELECT * FROM brand;";
                                                $resultset1 = DB::search($q1);
                                                $r1 = $resultset1->num_rows;

                                                for ($i = 0; $i < $r1; $i++) {
                                                      $d1 = $resultset1->fetch_assoc();
                                                      if ($d["brand_id"] == $d1["bid"]) {
                                                ?>
                                                            <option value="<?php echo $d1['bid']; ?>" selected=""><?php echo $d1["bname"] ?></option>

                                                      <?php
                                                      } else {
                                                      ?>
                                                            <option value="<?php echo $d1['bid']; ?>"><?php echo $d1["bname"] ?></option>
                                                <?php
                                                      }
                                                }
                                                ?>

                                          </select>
                                    </td>


                              </tr>
                              <tr>


                                    <td class="wid20 updeltd">Name</td>
                                    <td class="updeltd" colspan="3">
                                          <input type="text" class="mod" id="modelup" value="<?php echo $d["model"] ?>" onclick="errorclearupdate(4);" <?php echo $disable ?>>
                                    </td>

                              </tr>
                              <tr>


                                    <td class="wid20 updeltd">Title</td>
                                    <td class="updeltd" colspan="3">
                                          <input type="text" class="mod" id="titleup" value="<?php echo $d["title"] ?>" onclick="errorclearupdate(4);" />
                                    </td>

                              </tr>
                              <tr>


                                    <td class="wid20 updeltd">Expire Date</td>
                                    <td class="updeltd" colspan="3">
                                          <?php
                                          if ($d["expire_date"] == "9999-12-20") {
                                          ?>
                                                <input type="date" class="mod" value="" id="exdateupd" />

                                          <?php
                                          } else {
                                          ?>
                                                <input type="date" class="mod" value="<?php echo $d["expire_date"] ?>" id="exdateupd" />

                                          <?php
                                          }
                                          ?>
                                    </td>

                              </tr>
                              <tr>


                                    <td class="wid20 updeltd">Quantity</td>
                                    <td class=" smaltd updeltd">
                                          <input type="number" class="qty" id="qtyup" min="0" value="<?php echo $d["qty"] ?>" onclick="errorclearupdate(5);" />
                                    </td>

                                    <td class=" textalin wid20 updeltd">Price</td>
                                    <td class="updeltd">
                                          <input type="number" class="price" id="priceup" min="0" value="<?php echo $d["price"] ?>" onclick="errorclearupdate(6);" <?php echo $disable ?> />
                                    </td>

                              </tr>
                              <td>Description</td>
                              <td colspan="4"><textarea type="text" class="wid100 inSfile" id="desup" onclick="errorclearupdate(7);"><?php echo $d["description"] ?></textarea></td>
                              </tr>
                        </table>



                  </div>
            </div>
      </div>
      <div class="modal-footer">
            <button type="button" class="modebtn selvbac whico" data-bs-dismiss="modal" id="updatecancel">Cancel</button>
            <button type="button" class="modebtn geenbac whico" onclick="shownewStockModal(<?php echo $pid ?>);">Add New Stock</button>

            <button type="button" class="modebtn blubac whico" id="saveupdatebtn" onclick="updateProduct(<?php echo $pid ?>)">Save changes</button>
      </div>
<?php
} else if ($from == "view") {
?>

      <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="icofont-close"></i></button>
      </div>
      <div class="modal-body">
            <div class="row">
                  <div class="col-12  updatbox">

                        <table class="wid100 tabbotran">
                              <td>Image</td>
                              <td colspan="2">

                                    <div class="wrap-custom-file p-0">

                                          <input type="file" style="display: none;" onchange="errorclearupdate2(8);" accept="image/*" class="upload1" id="pImageupdate2" />
                                          <label for="pImageupdate2" class="defultimg" id="imgviewupdate2" style="background-image: url('<?php echo $d["img"] ?> ');" onclick="imgveiwupdate2();">
                                                <span></span>
                                          </label>
                                    </div>
                              </td>
                              <td>
                                    <p id="updatefilenameview2"></p>
                              </td>
                              <tr>
                                    <td class=" barntd2 updeltd ">Category</td>
                                    <td colspan="3" class=" lgtdup updeltd">
                                          <select class="bran" id="updatemaincoterid2" onchange="errorclearupdate2(1);"<?php echo $disable ?>>
                                                <option value="none">Select Main Category</option>

                                                <?php

                                                $q1 = "SELECT * FROM main_category;";
                                                $resultset1 = DB::search($q1);
                                                $r1 = $resultset1->num_rows;

                                                for ($i = 0; $i < $r1; $i++) {
                                                      $d1 = $resultset1->fetch_assoc();

                                                      if ($d["main_category_id"] == $d1["mid"]) {
                                                ?>
                                                            <option value="<?php echo $d1['mid']; ?>" selected=""><?php echo $d1["name"] ?></option>

                                                      <?php
                                                      } else {

                                                      ?>
                                                            <option value="<?php echo $d1['mid']; ?>"><?php echo $d1["name"] ?></option>
                                                <?php
                                                      }
                                                }
                                                ?>

                                          </select>
                                    </td>
                              </tr>
                              <tr>
                                    <td class=" barntd2 updeltd ">Sub</td>
                                    <td colspan="3" class=" lgtdup updeltd">
                                          <select class="bran" id="updatesubcaterId2" onchange="errorclearupdate2(2);"<?php echo $disable ?>>
                                                <option value="none">Select Sub Category</option>
                                                <?php

                                                $q1 = "SELECT * FROM sub_catergory;";
                                                $resultset1 = DB::search($q1);
                                                $r1 = $resultset1->num_rows;

                                                for ($i = 0; $i < $r1; $i++) {
                                                      $d1 = $resultset1->fetch_assoc();
                                                      if ($d["sub_catergory_id"] == $d1["sid"]) {
                                                ?>
                                                            <option value="<?php echo $d1['sid']; ?>" selected=""><?php echo $d1["name"] ?></option>

                                                      <?php
                                                      } else {
                                                      ?>
                                                            <option value="<?php echo $d1['sid']; ?>"><?php echo $d1["name"] ?></option>
                                                <?php
                                                      }
                                                }
                                                ?>
                                          </select>
                                    </td>
                              </tr>
                              <tr>
                                    <td class=" barntd2 updeltd ">Brand</td>
                                    <td colspan="3" class=" lgtdup updeltd">
                                          <select class="bran" id="updateinbrand2" onchange="errorclearupdate2(3);"<?php echo $disable ?>>
                                                <option value="none">Select Brand</option>

                                                <?php

                                                $q1 = "SELECT * FROM brand;";
                                                $resultset1 = DB::search($q1);
                                                $r1 = $resultset1->num_rows;

                                                for ($i = 0; $i < $r1; $i++) {
                                                      $d1 = $resultset1->fetch_assoc();
                                                      if ($d["brand_id"] == $d1["bid"]) {
                                                ?>
                                                            <option value="<?php echo $d1['bid']; ?>" selected=""><?php echo $d1["bname"] ?></option>

                                                      <?php
                                                      } else {
                                                      ?>
                                                            <option value="<?php echo $d1['bid']; ?>"><?php echo $d1["bname"] ?></option>
                                                <?php
                                                      }
                                                }
                                                ?>

                                          </select>
                                    </td>
                              </tr>
                              <tr>
                                    <td class="wid20 updeltd">Name</td>
                                    <td class="updeltd" colspan="3">
                                          <input type="text" class="mod" value="<?php echo $d["model"] ?>" id="modelup2" onclick="errorclearupdate2(4)"<?php echo $disable ?>>
                                    </td>

                              </tr>
                              <tr>


                                    <td class="wid20 updeltd">Title</td>
                                    <td class="updeltd" colspan="3">
                                          <input type="text" class="mod" id="titleup2" value="<?php echo $d["title"] ?>" onclick="errorclearupdate(4);">
                                    </td>

                              </tr>
                              <tr>


                                    <td class="wid20 updeltd">Expire Date</td>
                                    <td class="updeltd" colspan="3">
                                          <?php
                                          if ($d["expire_date"] == "9999-12-20") {
                                          ?>
                                                <input type="date" class="mod" value="" id="exdateupd2" />

                                          <?php
                                          } else {
                                          ?>
                                                <input type="date" class="mod" value="<?php echo $d["expire_date"] ?>" id="exdateupd2">
                                          <?php
                                          }
                                          ?>
                                    </td>

                              </tr>
                              <tr>
                                    <td class="wid20 updeltd">Quantity</td>
                                    <td class=" smaltd updeltd">
                                          <input type="number" class="qty" min="0" value="<?php echo $d["qty"] ?>" id="qtyup2" onclick="errorclearupdate2(5)">
                                    </td>

                                    <td class=" textalin wid20 updeltd">Price</td>
                                    <td class="updeltd">
                                          <input type="number" class="price" min="0" id="priceup2" value="<?php echo $d["price"] ?>" onclick="errorclearupdate2(6)"<?php echo $disable ?>>
                                    </td>

                              </tr>
                              <td>Description</td>
                              <td colspan="4"><textarea type="text" class="wid100 inSfile " id="desup2" onclick="errorclearupdate2(7)"><?php echo $d["description"] ?></textarea></td>
                              </tr>
                        </table>

                  </div>
            </div>
      </div>
      <div class="modal-footer">
            <button type="button" class="modebtn selvbac whico" data-bs-dismiss="modal" id="updatecancel2">Close</button>
            <button type="button" class="modebtn geenbac whico" id="adnewstockbtn2" onclick="shownewStockModalveiw(<?php echo $pid ?>);">Add New Stock</button>
            <button type="button" class="modebtn blubac whico" id="saveupdatebtn2" onclick="updateProduct2(<?php echo $pid ?>)">Save changes</button>
      </div>

<?php
}
?>