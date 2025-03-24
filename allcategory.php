<?php
session_start();
require "database.php";
require "head.php";
require "footer.php";
?>
<!DOCTYPE html>
<html>

<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Notification</title>
      <link rel="icon" href="cssfile//baclogoimg//logo2.png" />

      <link rel="stylesheet" href="cssfile//bootstrap.css" />
      <link rel="stylesheet" href="cssfile//head.css" />
      <link rel="stylesheet" href="cssfile//foot.css" />
    <link rel="stylesheet" href="cssfile//shop.css">
      <link rel="stylesheet" href="cssfile//icofont.min.css" />
      <link rel="stylesheet" href="cssfile//notification.css" />

</head>
<div class="container-fluid">
      <?php
      HD::headview("allcater")
      ?>
      <div class="row pdtop" style="min-height: 590px;">
            <!-- <div class="row "> -->
                  <div class="col-12 col-md-11 m-auto pt-2 catercard ">
                        <span class="fs-2">All Catergories</span>

                        <div class="row p-2 d-flex justify-content-center">
                              <?php
                              $qca = "SELECT * FROM main_category;";
                              // $resultsetca = $dbms->query($qca);

                              $resultsetca = DB::search($qca);

                              $rca = $resultsetca->num_rows;
                              for ($ica = 0; $ica < $rca; $ica++) {
                                    $dca = $resultsetca->fetch_assoc();
                              ?>

                                    <div class="imgcatercard col-6 col-md-3 col-lg-3 col-xl-2 p-2 position-relative">

                                          <a href="shop.php?s=<?php echo $dca['mid'] ?>&t=">
                                                <img src="<?php echo $dca['img_path'] ?>" class=" wid100 imgcard h-100" />

                                                <div value="<?php echo $dca['mid'] ?>" class="darkbox p-2">


                                                      <div class="hei100 wid100 darkbox2">
                                                            <table class="hei100 wid100">
                                                                  <tr>
                                                                        <td>
                                                                              <?php echo $dca['name'] ?>

                                                                        </td>
                                                                  </tr>
                                                            </table>
                                                      </div>
                                                </div>
                                          </a>
                                    </div>


                              <?php

                              }
                              ?>


                        </div>
                  </div>
            <!-- </div> -->
      </div>
      <?php
      FOOT::footview("normal");
      ?>
      <script src="bootstrap.min.js"></script>
      <script src="navhider.js"></script>
      <script src="commen.js"></script>

</div>

</html>