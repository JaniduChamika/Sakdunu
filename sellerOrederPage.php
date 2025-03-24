<?php
require "database.php";

$what = $_POST["what"];

if ($what == "act") {
      $fromdate = "";
      $todate = "";
      $search = "";
      if (isset($_POST["from"]) && isset($_POST["to"])) {
            $fromdate = $_POST["from"];
            $todate = $_POST["to"];
            $search = $_POST["s"];
      }
?>

      <div class="col-6 d-grid mt-3 px-1  px-md-5  ">
            <button class="bton blubac act " onclick="orderpage(1);">Active Orders &nbsp;<span class="badge bg-primary">
                        <?php
                        $horder = DB::search("SELECT * FROM `invo` WHERE `ds_id`IN('1','2') ");
                        echo $horder->num_rows;
                        ?>
                  </span></button>
      </div>
      <div class="col-6 d-grid mt-3  px-1   m-auto px-md-5  ">

            <button class="bton blubac" onclick="prevOrderpage(1);">Previous Orders
                  &nbsp;<span class="badge bg-primary">
                        <?php
                        $horder = DB::search("SELECT * FROM `invo` WHERE `ds_id`IN('3','4') ");
                        echo $horder->num_rows;
                        ?>
                  </span></button>
      </div>
      <div class="col-12 col-md-10 col-xl-10 col-xxl-10 m-auto">
            <div class="row pt-3">
                  <div class="col-12 col-md-6 col-xxl-4">
                        <div class="input-group mb-3 border-0">
                              <span class="input-group-text">From Date</span>

                              <input type="date" class="form-control" value="<?php echo $fromdate ?>" onchange="searchinvoice(1);" id="fromdateID" aria-label="Username">
                        </div>
                  </div>
                  <div class="col-12 col-md-6 col-xxl-4">
                        <div class="input-group mb-3 border-0">

                              <span class="input-group-text ">To Date</span>
                              <input type="date" class="form-control " value="<?php echo $todate ?>" id="todateID" onchange="searchinvoice(1);" aria-label="Server">
                        </div>
                  </div>

                  <div class="col-12 col-xxl-4">

                        <div class="input-group mb-3 border-0">

                              <span class="input-group-text  ">Invoice ID</span>
                              <input type="text" class="form-control " id="SearchinvoceID" placeholder="Invoice Id" value="<?php echo $search ?>" />
                              <button class="btn border border-light searchbtnsel px-3" type="button" id="button-addon2" onclick="searchinvoice(1);">Search</button>
                        </div>
                  </div>
            </div>
      </div>
      <div class="col-12 col-md-11 textalin tblboxoreder mt-3 p-0 p-md-5 pt-md-2 scroll1" onmouseover="doo(1);">
            <h3 class="whico">Active Orders</h3>

            <?php
            $page = 1;
            $page = $_POST["p"];
            $offset = ($page - 1) * 10;
            ?>

            <table class="wid100 tablor whico" style="min-width: 600px;" id="ordertable">

                  <tr>
                        <th>Invoice ID</th>

                        <th>Customer</th>
                        <th>Date</th>
                        <th>Delivary</th>
                        <th></th>

                  </tr>
                  <?php
                  $q1 = "SELECT invo.`invoid`,invo.`user_uid`,invo.`date_purchased`,user.`first_name`,user.`last_name`,dilivery_status.`status` FROM invo  INNER JOIN user ON user.`id`=invo.`user_uid` 
                  INNER JOIN dilivery_status ON dilivery_status.`d_id`=invo.`ds_id` WHERE (invo.`ds_id`='1' OR invo.`ds_id`='2') ";
                  $q2;
                  if (!empty($fromdate) && empty($todate)) {

                        $q2 = $q1 . "AND `date_purchased`='" . $fromdate . "'";
                  } else if (!empty($todate) && empty($fromdate)) {
                        $q2 = $q1 . "AND `date_purchased`='" . $todate . "'";
                  } else if (!empty($fromdate) && !empty($todate)) {
                        $q2 = $q1 . "AND (`date_purchased` BETWEEN '" . $fromdate . "' AND '" . $todate . "')";
                  } else {
                        $q2 = $q1;
                  }
                  $q3;
                  if (!empty($search)) {
                        $q3 = $q2 . "AND `invoid`LIKE'" . $search . "%'";
                  } else {
                        $q3 = $q2;
                  }
                  $qorder = $q3 . "ORDER BY `date_purchased` ASC LIMIT 10 OFFSET " . $offset . " ";
                  $resultsetorder = DB::search($qorder);
                  $rorder = $resultsetorder->num_rows;

                  for ($or = 0; $or < $rorder; $or++) {
                        $dorder = $resultsetorder->fetch_assoc();
                  ?>
                        <tr>

                              <td class="tdhove ps-1" onclick="invoproduct('<?php echo  $dorder['invoid'] ?>');" data-bs-toggle="offcanvas" data-bs-target="#invoicoffcanves" aria-controls="offcanvasTop">
                                    <?php echo $dorder["invoid"]; ?></td>

                              <td class="tdhove" onclick="getCusinfo('<?php echo $dorder['user_uid'] ?>');">
                                    <?php echo $dorder["first_name"] . " " . $dorder["last_name"] ?>
                              </td>
                              <td onclick="invoproduct('<?php echo  $dorder['invoid'] ?>');"data-bs-toggle="offcanvas" data-bs-target="#invoicoffcanves" aria-controls="offcanvasTop"><?php echo $dorder["date_purchased"] ?></td>


                              <td class="pe-1"  onclick="invoproduct('<?php echo  $dorder['invoid'] ?>');"data-bs-toggle="offcanvas" data-bs-target="#invoicoffcanves" aria-controls="offcanvasTop"><?php echo $dorder["status"]; ?></td>
                              <td class="invo"><a class="gereeninvo px-4 py-1" target="_blank" href="invoice.php?id=<?php echo  $dorder["invoid"]; ?>"><i class="icofont-page"></i></a></td>

                        </tr>
                  <?php
                  }


                  ?>

            </table>

      </div>
      <div class="wid100 textalin">
            <?php
            // $qorder = "SELECT * FROM invo WHERE invo.`ds_id`='1' OR invo.`ds_id`='2' ";
            $resultsetorder = DB::search($q3);
            $rorder = $resultsetorder->num_rows;
            $n = $rorder / 10;
            $t = intval($n);
            if ($rorder != 0) {

                  if ($rorder % 10 != 0) {
                        $t = $t + 1;
                  }


                  if ($page != 1) {
            ?>
                        <button class="btn1 " onclick="searchinvoice(<?php echo $page - 1 ?>)"><i class="icofont-rounded-double-left"></i></button>
                  <?php
                  } else {
                  ?>
                        <button class="btn1 "><i class="icofont-rounded-double-left"></i></button>

                        <?php
                  }
                  for ($i = 1; $i <= $t; $i++) {
                        if ($page == $i) {
                        ?>
                              <button class="btn1 acti" onclick="searchinvoice(<?php echo $i ?>)"><?php echo $i ?></button>
                        <?php
                        } else {
                        ?>
                              <button class="btn1" onclick="searchinvoice(<?php echo $i ?>)"><?php echo $i ?></button>

                        <?php
                        }
                  }
                  if ($page != $t && $rorder != 0) {
                        ?>
                        <button class="btn1 " onclick="searchinvoice(<?php echo $page + 1 ?>)"><i class="icofont-rounded-double-right"></i></button>
                  <?php
                  } else {
                  ?>
                        <button class="btn1 "><i class="icofont-rounded-double-right"></i></button>

            <?php
                  }
            }

            ?>
      </div>
<?php
} else if ($what == "prev") {
      $fromdate = "";
      $todate = "";
      $search = "";
      if (isset($_POST["from"]) && isset($_POST["to"])) {
            $fromdate = $_POST["from"];
            $todate = $_POST["to"];
            $search = $_POST["s"];
      }
?>
      <div class="col-6 d-grid mt-3 px-1  px-md-5 ">
            <button class="bton blubac" onclick="orderpage(1);">Active Orders &nbsp;<span class="badge bg-primary">
                        <?php
                        $horder = DB::search("SELECT * FROM `invo` WHERE `ds_id`IN('1','2') ");
                        echo $horder->num_rows;
                        ?>
                  </span></button>
      </div>
      <div class="col-6 d-grid mt-3 m-auto px-1  px-md-5 ">

            <button class="bton blubac act" onclick="prevOrderpage(1);">Previous Orders &nbsp;<span class="badge bg-primary">
                        <?php
                        $horder = DB::search("SELECT * FROM `invo` WHERE `ds_id`IN('3','4') ");
                        echo $horder->num_rows;
                        ?>
                  </span></button>
      </div>
      <div class="col-12 col-md-10 col-xl-10 col-xxl-10 m-auto">
            <div class="row pt-3">
                  <div class="col-12 col-md-6 col-xxl-4">

                        <div class="input-group mb-3 border-0">
                              <span class="input-group-text">From Date</span>

                              <input type="date" class="form-control " onchange="searchinvoicePrev(1);" value="<?php echo $fromdate ?>" id="fromdateID" aria-label="Username">
                        </div>
                  </div>
                  <div class="col-12 col-md-6 col-xxl-4">

                        <div class="input-group mb-3 border-0">
                              <span class="input-group-text ">To Date</span>
                              <input type="date" class="form-control " id="todateID" onchange="searchinvoicePrev(1);" value="<?php echo $todate ?>" aria-label="Server">
                        </div>
                  </div>
                  <div class="col-12 col-xxl-4">

                        <div class="input-group mb-3 border-0">
                              <span class="input-group-text  ">Invoice ID</span>
                              <input type="text" class="form-control " id="SearchinvoceID" value="<?php echo $search ?>" placeholder="Invoice Id" />
                              <button class="btn border border-light searchbtnsel px-3" type="button" id="button-addon2" onclick="searchinvoicePrev(1);">Search</button>
                        </div>

                  </div>
            </div>
      </div>
      <div class="col-12 col-md-11 textalin tblboxoreder mt-3 p-0 p-md-5 pt-md-2 scroll1" onmouseover="doo(1);">
            <h3 class="whico">Previous Orders</h3>
            <?php
            $page = 1;
            $page = $_POST["p"];
            $offset = ($page - 1) * 10;
            ?>

            <table class="wid100 tablor whico" id="ordertable"  style="min-width: 600px;">

                  <tr>
                        <th>Invoice ID</th>

                        <th>Customer</th>
                        <th>Date</th>
                        <th>Delivary</th>
                        <th></th>
                  </tr>
                  <?php


                  $q1 = "SELECT invo.`invoid`,invo.`date_purchased`,invo.`user_uid`,user.`first_name`,user.`last_name`,dilivery_status.`status` FROM invo  INNER JOIN user ON user.`id`=invo.`user_uid` 
INNER JOIN dilivery_status ON dilivery_status.`d_id`=invo.`ds_id`  WHERE (invo.`ds_id`='3' OR invo.`ds_id`='4')";

                  $q1;
                  if (!empty($fromdate) && empty($todate)) {

                        $q2 = $q1 . "AND `date_purchased`='" . $fromdate . "'";
                  } else if (!empty($todate) && empty($fromdate)) {
                        $q2 = $q1 . "AND `date_purchased`='" . $todate . "'";
                  } else if (!empty($fromdate) && !empty($todate)) {
                        $q2 = $q1 . "AND (`date_purchased` BETWEEN '" . $fromdate . "' AND '" . $todate . "')";
                  } else {
                        $q2 = $q1;
                  }
                  $q3;
                  if (!empty($search)) {
                        $q3 = $q2 . "AND `invoid`LIKE'" . $search . "%'";
                  } else {
                        $q3 = $q2;
                  }

                  $qorder = $q3 . "ORDER BY `date_purchased` DESC  LIMIT 10 OFFSET " . $offset . " ";

                  $resultsetorder = DB::search($qorder);
                  $rorder = $resultsetorder->num_rows;

                  for ($or = 0; $or < $rorder; $or++) {
                        $dorder = $resultsetorder->fetch_assoc();
                  ?>
                        <tr>

                              <td class="tdhove ps-1" onclick="invoproduct('<?php echo  $dorder['invoid'] ?>');" data-bs-toggle="offcanvas" data-bs-target="#invoicoffcanves" aria-controls="offcanvasTop">
                                    <?php echo $dorder["invoid"]; ?></td>

                              <td class="tdhove" onclick="getCusinfo('<?php echo $dorder['user_uid'] ?>');">
                                    <?php echo $dorder["first_name"] . " " . $dorder["last_name"] ?>
                              </td>
                              <td onclick="invoproduct('<?php echo  $dorder['invoid'] ?>');" data-bs-toggle="offcanvas" data-bs-target="#invoicoffcanves" aria-controls="offcanvasTop"><?php echo $dorder["date_purchased"] ?></td>
                              <td class="pe-1" onclick="invoproduct('<?php echo  $dorder['invoid'] ?>');" data-bs-toggle="offcanvas" data-bs-target="#invoicoffcanves" aria-controls="offcanvasTop"><?php echo $dorder["status"]; ?></td>
                              <td class="invo"><a class="gereeninvo px-4 py-1" target="_blank" href="invoice.php?id=<?php echo  $dorder["invoid"]; ?>"><i class="icofont-page"></i></a></td>

                        </tr>
                  <?php
                  }


                  ?>

            </table>

      </div>
      <div class="wid100 textalin">
            <?php
            // $qorder = "SELECT * FROM invo INNER JOIN user_has_product ON invo.`invoid`=user_has_product.`invo_id`  WHERE invo.`ds_id`='3' OR invo.`ds_id`='4' ";
            $resultsetorder = DB::search($q3);
            $rorder = $resultsetorder->num_rows;
            $n = $rorder / 10;
            $t = intval($n);


            if ($rorder % 10 != 0) {
                  $t = $t + 1;
            }

            if ($rorder != 0) {
                  if ($page != 1) {
            ?>
                        <button class="btn1 " onclick="searchinvoicePrev(<?php echo $page - 1 ?>)"><i class="icofont-rounded-double-left"></i></button>
                  <?php
                  } else {
                  ?>
                        <button class="btn1 "><i class="icofont-rounded-double-left"></i></button>

                        <?php
                  }
                  for ($i = 1; $i <= $t; $i++) {
                        if ($page == $i) {
                        ?>
                              <button class="btn1 acti" onclick="searchinvoicePrev(<?php echo $i ?>)"><?php echo $i ?></button>
                        <?php
                        } else {
                        ?>
                              <button class="btn1" onclick="searchinvoicePrev(<?php echo $i ?>)"><?php echo $i ?></button>

                        <?php
                        }
                  }
                  if ($page != $t && $rorder != 0) {
                        ?>
                        <button class="btn1 " onclick="searchinvoicePrev(<?php echo $page + 1 ?>)"><i class="icofont-rounded-double-right"></i></button>
                  <?php
                  } else {
                  ?>
                        <button class="btn1 "><i class="icofont-rounded-double-right"></i></button>

            <?php
                  }
            }
            ?>
      </div>
<?php
}
?>