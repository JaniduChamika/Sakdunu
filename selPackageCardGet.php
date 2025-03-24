<?php
require "database.php";
$what = $_POST["what"];
if ($what == "view") {

      $q = "SELECT * FROM package";
      $resultset = DB::search($q);
      for ($i = 0; $i < $resultset->num_rows; $i++) {
            $d = $resultset->fetch_assoc();
?>
            <div class="col-12 col-md-6 col-xl-4 col-xxl-3 d-grid" onclick="getPackageDetails(<?php echo $d['pack_id'] ?>);">
                  <div class="row p-2 h-100">
                        <div class="col-12 realcardPackage ">
                              <div class="row p-2 h-100">
                                    <div class="col-5 p-0">
                                          <img src="<?php echo $d["img"] ?>" class="w-100" />
                                    </div>
                                    <div class="col-7 ps-2 ">
                                          <table class="h-100">
                                                <tr>
                                                      <td>
                                                            <?php echo $d["pack_name"]; ?>

                                                      </td>

                                                </tr>
                                                <tr>
                                                      <td>
                                                            <?php echo $d["strat_date"]; ?>


                                                      </td>

                                                </tr>
                                                <tr>
                                                      <td>
                                                            <?php echo $d["end_date"]; ?>


                                                      </td>

                                                </tr>
                                                <tr>
                                                      <td>
                                                            -<?php echo $d["discount"]; ?>% OFF


                                                      </td>
                                                </tr>
                                          </table>


                                    </div>
                                    <div class="col-12 d-flex align-items-end ">
                                          <button class="btn bluco w-100 text-light mt-2 " onclick="VeiwOffcanvasPackage(<?php echo $d['pack_id'] ?>);">View</button>
                                    </div>



                              </div>
                        </div>
                  </div>
            </div>
<?php
      }
} else if ($what == "getvalue") {
      $packID = $_POST["packID"];
      $q = "SELECT * FROM package WHERE pack_id='" . $packID . "'";
      $resultset = DB::search($q);
      $d = $resultset->fetch_assoc();
      $array=$d;
      echo  json_encode($array);
      // $name = $d['pack_name'];
      // $start = $d["strat_date"];
      // $end = $d["end_date"];
      // $dis = $d["discount"];
      // $img = $d["img"];


      // $j = '{"n":"' . $name . '","e":"' . $start . '","s":"' . $end . '","d":"' . $dis . '","i":"' . $img . '"}';
      // echo $j;
}
?>