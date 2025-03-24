<div class="col-10 col-md-12 col-lg-4 ms-auto me-auto mb-3 ">
      <div class="row ps-md-2 pe-md-2 overflowadv">
            <?php
            require "database.php";
            $qadvance1 = "SELECT * FROM main_category ORDER BY `name` ASC";
            $resultsetadvance = DB::search($qadvance1);
            $radva = $resultsetadvance->num_rows;

            ?>

            <table class="tabladva whico wid100 " style="font-family: unset; height: fit-content;">
                  <tr>
                        <th>
                              Your All Product Category
                        </th>
                  </tr>
                  <?php
                  for ($ad = 0; $ad < $radva; $ad++) {
                        $dadva = $resultsetadvance->fetch_assoc();
                  ?>
                        <tr onclick="renamingmain(<?php echo $dadva['mid'] ?>);">
                              <td>
                                    <?php echo $dadva["name"] ?>
                              </td>
                        </tr>
                  <?php

                  }

                  ?>

            </table>
      </div>
      <div class="row addnew pt-1">
            <button class="addnewbtn addbtncol" onclick="addbtndis(1);">Add New Category</button>
            <div class="col-12">
                  <div class="row addvacestylecom" id="addcotergorydivID">

                        <div class="wrap-custom-file packwrap mx-auto mb-3">

                              <input type="file" style="display: none;" onchange="AdvaImgveiw();" accept="image/*" class="upload1" id="addcatermgID" />
                              <label for="addcatermgID" class="defultimg imagbox" id="labelpImageAdva">
                                    <span class="d-none"></span>
                              </label>
                        </div>
                        <input type="text" id="newcatergoryID" placeholder="Add Category" />
                        <button class="addnewbtn addbtn" onclick="addcater('c');">ADD</button>
                  </div>
            </div>
      </div>
</div>

<div class="col-10 col-md-6 col-lg-4 ms-auto me-auto mb-3 ">
      <div class="row ps-md-2 pe-md-2 pe-lg-0 ps-lg-0 pe-xl-2 ps-xl-2 overflowadv">

            <?php
            $qadvance1 = "SELECT * FROM sub_catergory ORDER BY `name` ASC";
            $resultsetadvance = DB::search($qadvance1);
            $radva = $resultsetadvance->num_rows;

            ?>

            <table class="tabladva whico wid100 " style="font-family: unset; height: fit-content;">
                  <tr>
                        <th>
                              Your All Product Sub Category
                        </th>
                  </tr>
                  <?php
                  for ($ad = 0; $ad < $radva; $ad++) {
                        $dadva = $resultsetadvance->fetch_assoc();
                  ?>

                        <tr onclick="renamingsub(<?php echo $dadva['sid'] ?>);">
                              <td>
                                    <?php echo $dadva["name"] ?>
                              </td>
                        </tr>
                  <?php

                  }
                  ?>

            </table>
      </div>
      <div class="row addnew pt-1">
            <button class="addnewbtn addbtncol" onclick="addbtndis(2);">Add New Sub Category</button>
            <div class="col-12">
                  <div class="row addvacestylecom" id="addsubcotergorydivID">
                        <select id="selcatergoryID">
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
                        <input type="text" id="newsubcatergoryID" placeholder="Add Sub Category" />
                        <button class="addnewbtn addbtn " onclick="addsubcater('sc');">ADD</button>
                  </div>
            </div>
      </div>
</div>
<div class="col-10 col-md-6 col-lg-4 ms-auto me-auto  mb-3">
      <div class="row ps-md-2 pe-md-2  overflowadv">

            <?php
            $qadvance1 = "SELECT * FROM brand ORDER BY `bname` ASC";
            $resultsetadvance = DB::search($qadvance1);
            $radva = $resultsetadvance->num_rows;
            ?>

            <table class="tabladva whico wid100 " style="font-family: unset; ">
                  <tr>
                        <th>
                              Your All Product Brand
                        </th>
                  </tr>
                  <?php
                  for ($ad = 0; $ad < $radva; $ad++) {
                        $dadva = $resultsetadvance->fetch_assoc();
                  ?>

                        <tr onclick="renamingbrand(<?php echo $dadva['bid'] ?>);">
                              <td>
                                    <?php echo $dadva["bname"] ?>
                              </td>
                        </tr>
                  <?php

                  }

                  ?>

            </table>
      </div>
      <div class="row addnew pt-1">
            <button class="addnewbtn addbtncol" onclick="addbtndis(3);">Add New Brand</button>
            <div class="col-12">
                  <div class="row addvacestylecom" id="addbranddivID">

                        <select id="selcatergoryrobrand" onchange="getsubforBrand()">
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
                        <input type="text" id="newbrandID" placeholder="Add Brand" />
                        <button class="addnewbtn addbtn" onclick="addbrand('b');">ADD</button>

                        <div class="col-12 mt-2">
                              <div class="row" id="subcaterBox">


                              </div>
                        </div>
                  </div>
            </div>

      </div>
</div>