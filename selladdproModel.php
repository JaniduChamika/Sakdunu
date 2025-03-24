<?php
require "database.php";
?>


<div class="modal-header">
      <h5 class="modal-title" id="staticBackdropLabel">Add New Product</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="modeladdclose();"><i class="icofont-close"></i></button>


</div>
<div class="modal-body">
      <div class="row">
            <div class="col-12 addbox">


                  <table class="wid100 tabbotran">

                        <tr>
                              <td>Image</td>
                              <td colspan="2">
                                    <div class="wrap-custom-file">

                                          <input type="file" style="display: none;" onchange="imgveiw();errorclear('labelpImage');" accept="image/*" class="upload1" id="pImage" />
                                          <label for="pImage" class="defultimg" id="labelpImage">
                                                <span></span>
                                          </label>
                                    </div>
                              </td>
                              <td>
                                    <p id="filenameview"></p>
                              </td>

                        </tr>
                        <tr>

                              <td class=" barntd2 updeltd ">Category</td>
                              <td colspan="3" class=" lgtdup updeltd">
                                    <select class="bran" id="maincoterid" onchange="errorclear('maincoterid');setsubcategory();">
                                          <option value="none">Select Main Category</option>

                                          <?php

                                          $q1 = "SELECT * FROM main_category;";
                                          $resultset1 = DB::search($q1);
                                          $r1 = $resultset1->num_rows;

                                          for ($i = 0; $i < $r1; $i++) {
                                                $d1 = $resultset1->fetch_assoc();

                                          ?>


                                                <option value="<?php echo $d1['mid']; ?>"><?php echo $d1["name"] ?></option>
                                          <?php

                                          }
                                          ?>

                                    </select>
                              </td>
                        </tr>
                        <tr>

                              <td class=" barntd2 updeltd ">Sub</td>
                              <td colspan="3" class=" lgtdup updeltd">
                                    <select class="bran" id="subcaterId" onchange="errorclear('subcaterId');setbrand();">
                                          <option value="none">Select Sub Catergory</option>

                                          <?php

                                          $q1 = "SELECT * FROM sub_catergory;";
                                          $resultset1 = DB::search($q1);
                                          $r1 = $resultset1->num_rows;

                                          for ($i = 0; $i < $r1; $i++) {
                                                $d1 = $resultset1->fetch_assoc();

                                          ?>


                                                <option value="<?php echo $d1['sid']; ?>"><?php echo $d1["name"] ?></option>
                                          <?php

                                          }
                                          ?>

                                    </select>
                              </td>
                        </tr>

                        <tr>


                              <td class=" barntd2 updeltd ">Brand</td>
                              <td colspan="3" class=" lgtdup updeltd">
                                    <select class="bran" id="inbrand" onchange="errorclear('inbrand');">
                                          <option value="none">Select Brand</option>

                                          <?php

                                          $q1 = "SELECT * FROM brand;";
                                          $resultset1 = DB::search($q1);
                                          $r1 = $resultset1->num_rows;

                                          for ($i = 0; $i < $r1; $i++) {
                                                $d1 = $resultset1->fetch_assoc();

                                          ?>
                                                <option value="<?php echo $d1['bid']; ?>"><?php echo $d1["bname"] ?></option>
                                          <?php

                                          }
                                          ?>

                                    </select>
                              </td>


                        </tr>
                        <tr>


                              <td class="wid20 updeltd">Name</td>
                              <td class="updeltd" colspan="3">
                                    <input type="text" class="mod" id="inmodel" onkeyup="errorclear('inmodel');"  onchange="errorclear('inmodel');">
                              </td>

                        </tr>
                        <tr>


                              <td class="wid20 updeltd">Title</td>
                              <td class="updeltd" colspan="3">
                                    <input type="text" class="mod" id="intitle" onkeyup="errorclear('intitle');" onchange="errorclear('intitle');">
                              </td>

                        </tr>
                        <tr>


                              <td class="wid20 updeltd">Expire Date</td>
                              <td class="updeltd" colspan="3">
                                    <input type="date" class="mod" id="exdate">
                              </td>

                        </tr>
                        <tr>


                              <td class="wid20  updeltd">Quantity</td>
                              <td class=" smaltd updeltd">
                                    <input type="number" class="qty" min="0" value="1" id="inqty" onkeyup="errorclear('inqty');" onchange="errorclear('inqty');">
                              </td>

                              <td class=" textalin wid20 updeltd">Price</td>
                              <td class="updeltd">
                                    <input type="number" class="price" min="0" id="inprice" onkeyup="errorclear('inprice');" onchange="errorclear('inprice');">
                              </td>

                        </tr>
                        <tr>
                              <td>Description</td>
                              <td colspan="4"><textarea type="text" class="wid100 inSfile " onkeyup="errorclear('indes');" id="indes" placeholder="short description"></textarea></td>
                        </tr>

                  </table>

            </div>
      </div>


</div>
<div class="modal-footer">
      <button type="button" class="modebtn selvbac whico" data-bs-dismiss="modal" onclick="modeladdclose();">Cancel</button>
      <!-- onclick="insert;" -->

      <button type="submit" class="modebtn blubac whico" onclick="addProduct();">Save</button>

</div>