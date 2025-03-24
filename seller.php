<?php
// session_start();
// if (isset($_SESSION["userdata"]["id"]) && $_SESSION["type"] == "seller") {
    require "database.php";
    date_default_timezone_set("Asia/Colombo");
    $date = date("Y-m-d");
    // $seller = $_SESSION["userdata"]["id"];
    $seller = "jni";
?>


    <!DOCTYPE html>
    <html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Seller Board</title>
        <link rel="icon" href="cssfile//baclogoimg//logo2.png" />
        <link rel="stylesheet" href="cssfile//icofont.min.css" />
        <link rel="stylesheet" href="cssfile//bootstrap.css" />
        <link rel="stylesheet" href="cssfile//product.css" />
        <link rel="stylesheet" href="cssfile//invoiceSeller.css" />
        <link rel="stylesheet" href="cssfile//advanceseller.css" />
        <link rel="stylesheet" href="cssfile//sellpackage.css" />
        <link rel="stylesheet" href="cssfile//seller.css" />
        <link rel="stylesheet" href="cssfile//bin.css" />
        <link rel="stylesheet" href="cssfile//img2.css" />
        <link rel="stylesheet" href="cssfile//customer.css" />



    </head>

    <body>
        <div class="container-fluid ">

            <div class="row">
                <!-- side bar  -->
                <div class="d-flex flex-column flex-shrink-0 p-0 p-lg-3  hei100  sidebar ">
                    <a class="d-flex align-items-center mb-3 mb-md-0 mt-3 link-dark text-decoration-none">
                        <img src="cssfile//baclogoimg//logo2.png" class="bi logoimg " width="40" height="40" />
                        <span class="fs-4">
                            <img src="cssfile//baclogoimg//lohosub.png" class="bi me-2 ms-2 nameimg" width="auto" height="40" />
                        </span>
                    </a>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto sidemenu " id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link link-light">

                                <i class="icofont-home"></i><span> Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link link-light active" id="v-pills-dashboard-tab" data-bs-toggle="pill" data-bs-target="#v-pills-dashboard" type="button" role="tab" aria-controls="v-pills-dashboard" aria-selected="false">

                                <i class="icofont-dashboard"></i><span> Dashboard</span>
                            </a>
                        </li>
                        <li class="position-relative">
                            <a href="#" class="nav-link link-light position-relative" onclick="orderpage(1);" id="v-pills-order-tab" data-bs-toggle="pill" data-bs-target="#v-pills-order" type="button" role="tab" aria-controls="v-pills-order" aria-selected="false">

                                <i class="icofont-notepad position-relative">
                                    <?php
                                    $horder = DB::search("SELECT * FROM `invo` WHERE `ds_id`IN('1','2') ");
                                    if ($horder->num_rows != 0) {
                                    ?>
                                        <span class="position-absolute top-0 start-0 translate-middle p-2 bg-danger d-none d-lg-block rounded-circle" id="lgordebdgeID">
                                        </span>
                                    <?php
                                    }
                                    ?>
                                </i>
                                <span> Orders</span>
                            </a>
                            <?php
                            $horder = DB::search("SELECT * FROM `invo` WHERE `ds_id`IN('1','2') ");
                            if ($horder->num_rows != 0) {
                            ?>
                                <span class="position-absolute  translate-middle p-1 bg-danger rounded-circle d-lg-none" style="top: 30%; left: 80%;" id="smordebdgeID">
                                </span>
                            <?php
                            }
                            ?>
                        </li>
                        <li>
                            <a href="#" class="nav-link link-light " onclick="searchtable(1);" id="v-pills-product-tab" data-bs-toggle="pill" data-bs-target="#v-pills-product" type="button" role="tab" aria-controls="v-pills-product" aria-selected="false">

                                <i class="icofont-database"></i><span> Products</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link link-light " onclick="recyclebin(1);" id="v-pills-bin-tab" data-bs-toggle="pill" data-bs-target="#v-pills-bin" type="button" role="tab" aria-controls="v-pills-bin" aria-selected="false">

                                <i class="icofont-bin"></i> <span> Bin</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link link-light " onclick="advanceview();" id="v-pills-advance-tab" data-bs-toggle="pill" data-bs-target="#v-pills-advance" type="button" role="tab" aria-controls="v-pills-advance" aria-selected="false">
                                <i class="icofont-ui-add"></i><span> Advance</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link link-light " onclick="goPackageTab();" id="v-pills-package-tab" data-bs-toggle="pill" data-bs-target="#v-pills-package" type="button" role="tab" aria-controls="v-pills-package" aria-selected="false">
                                <i class="icofont-bag"></i><span> Package</span>
                            </a>
                        </li>
                        <li class=" position-relative">
                            <a href="#" class="nav-link link-light" onclick="searchusertable(1);" aria-current="page" id="v-pills-customers-tab" data-bs-toggle="pill" data-bs-target="#v-pills-customers" type="button" role="tab" aria-controls="v-pills-customers" aria-selected="true">

                                <i class="icofont-users position-relative">
                                    <?php
                                    $hmsg = DB::search("SELECT * FROM `chat` WHERE `seen_status`='1' AND `to_id`='" . $seller . "'");
                                    if ($hmsg->num_rows != 0) {
                                    ?>
                                        <span class="position-absolute top-0 start-0 translate-middle p-2 bg-danger d-none d-lg-block rounded-circle" id="largbadge">
                                        </span>
                                    <?php
                                    }
                                    ?>

                                </i><span> Customers</span>

                            </a>
                            <?php
                            $hmsg = DB::search("SELECT * FROM `chat` WHERE `seen_status`='1' AND `to_id`='" . $seller . "'");
                            if ($hmsg->num_rows != 0) {
                            ?>
                                <span class="position-absolute  translate-middle p-1 bg-danger rounded-circle d-lg-none" style="top: 30%; left: 80%;" id="smalbadge">
                                </span>
                            <?php
                            }
                            ?>
                        </li>
                        <li>
                            <a href="#" class="nav-link link-light" aria-current="page" id="v-pills-notification-tab" data-bs-toggle="pill" data-bs-target="#v-pills-notification" type="button" role="tab" aria-controls="v-pills-notification" aria-selected="true">

                                <i class="icofont-notification"></i> <span>Notification</span>
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <!-- Default dropup button -->
                    <nav class=" ">
                        <div class="btn-group dropup navbar navbar-expand-lg">
                            <button type="button" class="  dropdown-toggle accoubtn" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="icofont-user-alt-5"></i> &nbsp; <span>Account</span>
                            </button>
                            <ul class="dropdown-menu">
                                <!-- <li><a class="dropdown-item" href="#">Setting</a></li> -->
                                <li><a class="dropdown-item" href="profile.php">Profile</a></li>

                                <li>
                                    <hr>
                                </li>
                                <?php
                                if (isset($_SESSION["name"])) {
                                ?>
                                    <li onclick="logout();"><a class="dropdown-item">Log Out</a></li>
                                <?php
                                } else {
                                ?>
                                    <li onclick="login();"><a class="dropdown-item">Log In</a></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>

                    </nav>
                </div>



                <div class="col-12 ">


                    <div class="row tab-content aftersidebar" id="v-pills-tabContent">
                        <div class="bodyimg"></div>
                        <!-- dashboard  -->
                        <div class="tab-pane fade  col-12  show active " id="v-pills-dashboard" role="tabpanel" aria-labelledby="v-pills-dashboard-tab">

                            <div class="row">
                                <div class="col-12 col-lg-4 mt-3 mb-3 text-white">
                                    <h2 class="">Dashboard</h2>
                                </div>
                                <div class="col-12 col-lg-8 d-none d-lg-block  mt-2">

                                    <div class="row">


                                        <?php
                                        $startdate = new DateTime("2021-08-01 00:00:00");
                                        $tdate = new DateTime();
                                        $tz = new DateTimeZone("Asia/Colombo");
                                        $tdate->setTimezone($tz);
                                        $endDate = new DateTime($tdate->format("Y-m-d H:i:s"));
                                        $difference = $endDate->diff($startdate);

                                        ?>
                                        <div class="col-12  text-end mt-3 mb-3">
                                            <label class=" fs-6 fs-bold text-white me-5">Active Time</label>

                                            <label class="fs-6 text-white"><?php echo $difference->format('%Y') . " Y " . $difference->format('%m') . " M " .
                                                                                $difference->format('%d') . " D " . $difference->format('%H') . " H " .
                                                                                $difference->format('%i') . " Min " . $difference->format('%s') . " S"
                                                                            ?></label>
                                        </div>
                                    </div>


                                </div>
                                <div class="col-12 ">
                                    <div class="row p-1 d-flex">
                                        <div class="col-12 col-md-6 col-xl-4 d-grid">
                                            <div class="row p-1 ">
                                                <div class="col-12 bg-white text-dark text-center rounded " style="min-height: 100px;">
                                                    <br />
                                                    <span class="fs-5 fw-bold">Daily Earnings</span>
                                                    <br />
                                                    <?php
                                                    $today = date("Y-m-d");
                                                    $thismonth = date("m");
                                                    $thisyear = date("Y");

                                                    $invoicer = DB::search("SELECT * FROM `user_has_product` INNER JOIN `product` ON product.`pid`=user_has_product.`product_pid` INNER JOIN `invo` ON invo.`invoid`=user_has_product.`invo_id`");
                                                    $in = $invoicer->num_rows;
                                                    $a = 0;
                                                    $b = 0;
                                                    $c = 0;
                                                    $e = 0;
                                                    $f = 0;
                                                    $tota = 0;
                                                    for ($x = 0; $x < $in; $x++) {

                                                        $ir = $invoicer->fetch_assoc();
                                                        $f = $f + $ir["oqty"];

                                                        $pdate = $ir["date_purchased"];


                                                        if ($pdate == $today) {
                                                            $a = $a + $ir["price"] * $ir["oqty"];
                                                            $c = $c + $ir["oqty"];
                                                        }
                                                        $splitmonth = explode("-", $pdate);
                                                        $pmonth = $splitmonth[1];
                                                        $pyear = $splitmonth[0];
                                                        if ($pyear == $thisyear) {
                                                            if ($pmonth == $thismonth) {
                                                                $b = $b + $ir["price"] * $ir["oqty"];
                                                                $e = $e + $ir["oqty"];
                                                            }
                                                        }
                                                        $tota = $tota + $ir["price"] * $ir["oqty"];
                                                    }

                                                    ?>
                                                    <span class="fs-6">Rs. <?php echo $a ?>.00</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6  col-xl-4 d-grid">
                                            <div class="row p-1">
                                                <div class="col-12 bg-light text-dark text-center rounded" style="min-height: 100px;">
                                                    <br />
                                                    <span class="fs-5 fw-bold">Monthly Earnings</span>
                                                    <br />
                                                    <span class="fs-6">Rs. <?php echo $b ?>.00</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6  col-xl-4 d-grid">
                                            <div class="row p-1">
                                                <div class="col-12 bg-light text-dark text-center rounded" style="min-height: 100px;">
                                                    <br />
                                                    <span class="fs-5 fw-bold">Total Earnings</span>
                                                    <br />
                                                    <span class="fs-6">Rs. <?php echo $tota ?>.00</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6  col-xl-4 d-grid">
                                            <div class="row p-1">
                                                <div class="col-12 bg-white text-dark text-center rounded" style="min-height: 100px;">
                                                    <br />
                                                    <span class="fs-5 fw-bold">Today Sellings</span>
                                                    <br />
                                                    <span class="fs-6"> <?php echo $c ?> items</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6  col-xl-4 d-grid">
                                            <div class="row p-1">
                                                <div class="col-12 bg-white text-dark text-center rounded" style="min-height: 100px;">
                                                    <br />
                                                    <span class="fs-5 fw-bold">Monthly Sellings</span>
                                                    <br />
                                                    <span class="fs-6"> <?php echo $e ?> items</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6  col-xl-4 d-grid">
                                            <div class="row p-1">
                                                <div class="col-12 bg-white text-dark text-center rounded" style="min-height: 100px;">
                                                    <br />
                                                    <span class="fs-5 fw-bold">Total Sellings</span>
                                                    <br />
                                                    <span class="fs-6"> <?php echo $f ?> items</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6  col-xl-6 d-grid">
                                            <div class="row p-1">
                                                <div class="col-12 bg-white text-dark text-center rounded" style="min-height: 100px;">
                                                    <br />
                                                    <span class="fs-5 fw-bold">Active Orders</span>
                                                    <br />
                                                    <span class="fs-6"> <?php
                                                                        $horder = DB::search("SELECT * FROM `invo` WHERE `ds_id`IN('1','2') ");
                                                                        echo $horder->num_rows;
                                                                        ?> Oders </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6  col-xl-6 d-grid">
                                            <div class="row p-1">
                                                <div class="col-12 bg-white text-dark text-center rounded " style="min-height: 100px;">
                                                    <br />
                                                    <span class="fs-5 fw-bold">Total Engagements</span>
                                                    <br />
                                                    <?php
                                                    $users = DB::search("SELECT * FROM `user` WHERE `user_tid` !='2' ");
                                                    $un = $users->num_rows;
                                                    ?>

                                                    <span class="fs-6"><?php echo $un ?> Members</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row g-3 pt-3">

                                        <?php
                                        $freq = DB::search("SELECT `product_pid`,COUNT(`product_pid`) AS `value_occurrence`
                                                FROM `user_has_product`  GROUP BY `product_pid` ORDER BY `value_occurrence` DESC LIMIT 1");
                                        // WHERE `date` LIKE '%" . $today . "%'
                                        // todya items valta where eka danna 
                                        $frequm = $freq->num_rows;

                                        $proD;
                                        for ($z = 0; $z < $frequm; $z++) {
                                            $freqrow = $freq->fetch_assoc();

                                            $prod = DB::search("SELECT * FROM `product` WHERE `pid`='" . $freqrow["product_pid"] . "'");
                                            $proD = $prod->fetch_assoc();
                                        ?>
                                            <div class=" col-10 col-md-6 col-lg-4 my-3  mx-auto rounded d-grid ">
                                                <div class="row g-1 bg-light py-3">
                                                    <div class="col-12 text-center">
                                                        <label class="form-label fs-5 fw-bold">Mostly Sold Item</label>
                                                    </div>
                                                    <div class="col-12 text-center dashboardimg" style="background-image: url('<?php echo $proD["img"] ?>'); height: 250px;">

                                                        <!-- <img src="<?php echo $proD["img"] ?>" class="img-fluid rounded-top" style="height: 250px;" /> -->
                                                    </div>
                                                    <hr />

                                                    <div class="col-12 text-center">
                                                        <span class="fs-6 fw-bold"><?php echo $proD["title"] ?> </span>
                                                        <br />
                                                        <span class="fs-6"><?php echo $freqrow["value_occurrence"] ?> Orders</span>
                                                        <br />
                                                        <span class="fs-6">Rs. <?php echo $proD["price"] ?>.00</span>

                                                    </div>
                                                    <!-- <div class="col-12">
                                                            <div class="firstplace">

                                                            </div>
                                                        </div> -->
                                                </div>
                                            </div>
                                        <?php
                                        }

                                        ?>
                                        <?php
                                        $outstcok = DB::search("SELECT `pid`,COUNT(`pid`) AS `outstock` FROM `product` WHERE `qty`<='0'");
                                        // WHERE `date` LIKE '%" . $today . "%'
                                        // todya items valta where eka danna 
                                        $expire = $outstcok->num_rows;
                                        if ($outstcok->num_rows >= 1) {
                                            $ex = $outstcok->fetch_assoc();
                                            $count_ex = $ex["outstock"];
                                        ?>
                                            <div class=" col-10  col-md-6 col-lg-4 my-3  mx-auto rounded d-grid ">
                                                <div class="row g-1 bg-light py-3">
                                                    <div class="col-12 text-center">
                                                        <label class="form-label fs-5 fw-bold">Out of Stock Products</label>
                                                    </div>
                                                    <div class="col-12 text-center dashboardimg" style="background-image: url('cssfile//appimg//outstock.png'); height: 250px;">

                                                        <!-- <img src="cssfile//appimg//expired.png" class="img-fluid rounded-top" style="height: 250px;" /> -->
                                                    </div>
                                                    <hr />
                                                    <div class="col-12 text-center">
                                                        <?php if ($count_ex == 0) {
                                                        ?>

                                                            <span class="fs-6 fw-bold text-success">Looking Good </span>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <span class="fs-6 fw-bold text-danger">Need Attension! </span>

                                                        <?php
                                                        }
                                                        ?>
                                                        <br />

                                                        <span class="fs-6"><?php echo $count_ex ?> Items</span>
                                                        <br />
                                                        <span class="fs-6"></span>

                                                        <br />

                                                    </div>
                                                    <!-- <div class="col-12">
                                                            <div class="firstplace">

                                                            </div>
                                                        </div> -->
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        $expirers = DB::search("SELECT `pid`,COUNT(`pid`) AS `expire_product` FROM `product` WHERE `expire_date`<='" . $date . "'");
                                        // WHERE `date` LIKE '%" . $today . "%'
                                        // todya items valta where eka danna 
                                        $expire = $expirers->num_rows;
                                        if ($expirers->num_rows >= 1) {
                                            $ex = $expirers->fetch_assoc();
                                            $count_ex = $ex["expire_product"];
                                        ?>
                                            <div class=" col-10  col-md-6 col-lg-4 my-3  mx-auto rounded d-grid ">
                                                <div class="row g-1 bg-light py-3">
                                                    <div class="col-12 text-center">
                                                        <label class="form-label fs-5 fw-bold">Expired Products</label>
                                                    </div>
                                                    <div class="col-12 text-center dashboardimg" style="background-image: url('cssfile//appimg//EXPIRE.png'); height: 250px;">

                                                        <!-- <img src="cssfile//appimg//expired.png" class="img-fluid rounded-top" style="height: 250px;" /> -->
                                                    </div>
                                                    <hr />
                                                    <div class="col-12 text-center">
                                                        <?php if ($count_ex == 0) {
                                                        ?>

                                                            <span class="fs-6 fw-bold text-success">Looking Good </span>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <span class="fs-6 fw-bold text-danger">Need Attension! </span>

                                                        <?php
                                                        }
                                                        ?>
                                                        <br />

                                                        <span class="fs-6"><?php echo $count_ex ?> Items</span>
                                                        <br />
                                                        <span class="fs-6"></span>

                                                        <br />

                                                    </div>
                                                    <!-- <div class="col-12">
                                                            <div class="firstplace">

                                                            </div>
                                                        </div> -->
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- orders  -->
                        <div class="tab-pane fade col-12  " id="v-pills-order" role="tabpanel" aria-labelledby="v-pills-order-tab">

                            <div class="row">

                                <div class="col-12">
                                    <div class="row" id="orderboxID">
                                        <!-- sellerOrederPage.php -->

                                    </div>
                                </div>

                            </div>

                            <div class="offcanvas offcanvas-top heioffcan" tabindex="-1" id="invoicoffcanves" aria-labelledby="offcanvasTopLabel">
                                <!-- SeorderProductviwe.php  -->


                            </div>
                            <div class="modal fade" tabindex="-1" id="cusinfomodeID">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Customer Info</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" id="contentcusID">
                                            <!-- secusinfo.php -->

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn bluco text-light" data-bs-dismiss="modal">Close</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- product tab  -->
                        <div class="tab-pane fade col-12" id="v-pills-product" role="tabpanel" aria-labelledby="v-pills-product-tab">
                            <!-- search all brand  -->
                            <div class="row">

                                <div class="col-12 col-xl-10 m-auto mt-4 textalin serbox">

                                    <div class="row">
                                        <div class="col-12 col-xl-6 ">


                                            <div class=" input-group mb-3 border-0">
                                                <span class="input-group-text">Category</span>

                                                <select class="form-select" onchange="getbrandfortavle('table');searchtable(1); " id="cateproid">
                                                    <option value="All">All Category</option>
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
                                                <span class="input-group-text ">Brand</span>
                                                <select class="form-select " id="sel" onchange="searchtable(1)">
                                                    <option value="All">All Brand</option>
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
                                            </div>
                                        </div>
                                        <div class="col-12 col-xl-6">

                                            <div class="input-group mb-3 border-0">

                                                <span class="input-group-text">Title</span>
                                                <input type="text" class="form-control " id="sech" value="" onkeyup="searchtable(1);" placeholder="Product title" />
                                                <span class="input-group-text ">Sort</span>
                                                <select class="form-select " id="sortid" onchange="searchtable(1)">
                                                    <option value="none">Select Sort</option>

                                                    <option value="Qlth">Quintity Low to High</option>
                                                    <option value="Qhtl">Quintity High to Low</option>
                                                    <option value="Plth">Price Low to High</option>
                                                    <option value="Phtl">Price High to Low</option>


                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row" id="tablrow">
                                <div class="col-12">
                                    <!-- table and button  -->
                                    <div class="row" id="tablebox">
                                        <!-- productsearch.php -->

                                        <!-- table product veiw  -->

                                    </div>
                                </div>
                                <!-- add new stock modal  -->
                                <div class="modal fade darktrans" id="addnewStockMadal" data-bs-backdrop="static" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Add New Stock</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <label class="form-label">You can add this product as new stock with new price, quintity and expire date.</label>
                                                <table class="tabbotran">
                                                    <tr>
                                                        <td class="wid20 updeltd">Quantity</td>
                                                        <td class=" smaltd updeltd">
                                                            <input type="number" class="qty" min="0" value="1" id="Nstockqtyup">
                                                        </td>

                                                        <td class=" textalin wid20 updeltd">Price</td>
                                                        <td class="updeltd">
                                                            <input type="number" class="price" min="0" id="Nstockpriceup" value="">
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td class="wid20 updeltd">Expire Date</td>
                                                        <td class="updeltd" colspan="3">
                                                            <input type="date" class="mod" value="" id="Nstockexdate" />
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn selvbac text-white" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn blubac text-white" id="newStockaddbtn">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal update product -->
                                <div class="modal fade modalmybac p-0" id="exampleModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down">
                                        <div class="modal-content" id="proupmodelcontentID">

                                            <!-- update model contenct selupproModel.php -->

                                        </div>
                                    </div>
                                </div>
                                <!-- delete model  -->
                                <!-- <div class="modal fade " id="comfirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Comfirmation</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                This product will be not delete from database.it will be hide from users and it will be move to the bin.
                                                you can restore from the bin. Are you sure yor want to move this product to bin?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="modebtn selvbac whico" data-bs-dismiss="modal" id="cancelcomfimid">No</button>
                                                <button type="button" class="modebtn redbac whico" id="movebincomfirmId">Yes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                            </div>
                            <!-- Add new product  -->
                            <div class="row pt-4">
                                <div class="col-12 col-md-10 col-lg-6 d-grid ms-auto me-auto">
                                    <button class="addPbtn blubac" onclick="addProdcutModel();" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add New Product</button>
                                </div>
                                <div class="col-12 col-md-10 col-lg-6 d-grid mt-2 mt-lg-0 ms-auto me-auto">
                                    <button class="addPbtn yelbac" data-bs-toggle="offcanvas" data-bs-target="#viewproduct" aria-controls="offcanvasTop" onclick=" searchtableveiw(1);">View Your Product</button>
                                </div>



                                <!-- Modal  add new product-->
                                <div class="modal fade p-0" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down">
                                        <div class="modal-content" id="addproductModelID">

                                            <!-- prodcut adding model selladdproModel.php -->
                                        </div>
                                    </div>
                                </div>
                                <!-- offanva  -->
                                <div class="offcanvas offcanvas-top ps-0 hei100 pe-0" tabindex="-1" id="viewproduct" aria-labelledby="offcanvasTopLabel">
                                    <div class="bodyimg"></div>

                                    <button type="button" class="prodcolsebtn " data-bs-dismiss="offcanvas" aria-label="Close" onclick="searchtable(1);"><i class="icofont-close"></i></button>

                                    <div class="offcanvas-body">


                                        <div class="row textcenter  ">

                                            <div class="col-12 col-md-10  m-auto textalin serbox">
                                                <div class="row pt-3 pt-xxl-1">
                                                    <div class="col-12 col-xl-6 ">

                                                        <div class="input-group mb-3 border-0">
                                                            <span class="input-group-text">Category</span>

                                                            <select class="form-select" onchange=" getbrandfortavle('view'); searchtableveiw(1);" id="cateproid2">
                                                                <option value="All">All Category</option>
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

                                                            <span class="input-group-text ">Brand</span>
                                                            <select class="form-select " id="sel2" onchange="searchtableveiw(1)">
                                                                <option value="All">All Brand</option>
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
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-xl-6">
                                                        <div class="input-group mb-3 border-0">
                                                            <span class="input-group-text">Title</span>
                                                            <input type="text" class="form-control " id="sech2" value="" onkeyup="searchtableveiw(1);" placeholder="Product title" />
                                                            <!-- <button class="btn border border-light searchbtnsel px-3" onclick="searchtable(1)" type="button">Search</button> -->

                                                            <span class="input-group-text ">Sort</span>
                                                            <select class="form-select " id="sortid2" onchange="searchtableveiw(1)">
                                                                <option value="none">Select Sort</option>
                                                                <option value="Qlth">Quintity Low to High</option>
                                                                <option value="Qhtl">Quintity High to Low</option>
                                                                <option value="Plth">Price Low to High</option>
                                                                <option value="Phtl">Price High to Low</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>

                                        </div>
                                        <div class="row pt-2 textcenter">
                                            <div class="col-11 col-md-10 col-lg-10 col-xl-10 col-xxl-11 me-auto ms-auto ">
                                                <!-- card veiw -->
                                                <div class="row">
                                                    <div class="col-12" id="cardviewboxID">

                                                        <!--file productsearchview.php -->

                                                    </div>
                                                </div>
                                                <!-- Modal productveiw update -->
                                                <div class="modal fade modalmybac" id="editvewproduc" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-fullscreen-lg-down">
                                                        <div class="modal-content" id="proupviewModelconID">

                                                            <!-- prodcut update model in view  file selupproModel.php -->

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- delete model view produc -->
                                                <!-- <div class="modal fade " id="comfirmModalveiw" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Comfirmation</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                This product will be not delete from database.it will be hide from users and it will be move to the bin.
                                                                you can restore from the bin. Are you sure yor want to move this product to bin?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="modebtn selvbac whico" data-bs-dismiss="modal" id="cancelcomfirmveiw">Cancel</button>
                                                                <button type="button" class="modebtn redbac whico" id="movebincomfirmIdveiw">Comfirm</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <!-- add new stock veiw  -->
                                                <div class="modal fade darktrans" id="addnewStockMadal2" data-bs-backdrop="static" tabindex="-1">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Add New Stock</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <label class="form-label">You can add this product as new stock with new price, quintity and expire date.</label>
                                                                <table class="tabbotran">
                                                                    <tr>
                                                                        <td class="wid20 updeltd">Quantity</td>
                                                                        <td class=" smaltd updeltd">
                                                                            <input type="number" class="qty" min="0" value="1" id="Nstockqtyup2">
                                                                        </td>

                                                                        <td class=" textalin wid20 updeltd">Price</td>
                                                                        <td class="updeltd">
                                                                            <input type="number" class="price" min="0" id="Nstockpriceup2" value="">
                                                                        </td>

                                                                    </tr>
                                                                    <tr>
                                                                        <td class="wid20 updeltd">Expire Date</td>
                                                                        <td class="updeltd" colspan="3">
                                                                            <input type="date" class="mod" value="" id="Nstockexdate2" />
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn selvbac text-white" data-bs-dismiss="modal">Cancel</button>
                                                                <button type="button" class="btn blubac text-white" id="newStockaddbtn2">Add</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <!-- bin  -->
                        <div class="tab-pane fade col-12 " id="v-pills-bin" role="tabpanel" aria-labelledby="v-pills-bin-tab">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row" id="binboxID">
                                        <!-- sellerBinExpire.php -->


                                    </div>
                                </div>
                                <!-- delete model  -->
                                <div class="modal fade " id="delpropermentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="delcomfirm">Comfirmation</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure yor want to delete this product permanently?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="modebtn selvbac whico" data-bs-dismiss="modal">No</button>
                                                <button type="button" class="modebtn redbac whico" id="permanetdeleteBtn">Yes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- expire date change model  -->
                                <div class="modal fade " id="exdatechangeModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exlavel">Expire Date Change</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="tabbotran w-100">
                                                    <tr>
                                                        <td class="wid20 updeltd">Expire Date</td>
                                                        <td class="updeltd" colspan="3">
                                                            <input type="date" class="mod" value="" id="updateexdateID" />
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="modebtn selvbac whico" data-bs-dismiss="modal">Cancel</button>
                                                <button type="button" class="modebtn blubac whico" id="exdateBtn">Change</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- brand adding catergory tab -->
                        <div class="tab-pane fade col-12 " id="v-pills-advance" role="tabpanel" aria-labelledby="v-pills-advance-tab">
                            <div class="row pt-2">

                                <div class="col-12 ">
                                    <h4 class="text-white">Register New Category, Sub category & Brands</h4>

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-12 textalin tblboxadv">
                                    <div class="row" id="addvanceID">
                                        <!-- advanceview.php -->
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" tabindex="-1" id="advanceRenameModelID">
                                <div class="modal-dialog modal-dialog-centered" id="contentrenameId">
                                    <!-- rename model eke content eka -->
                                    <!-- seladvarenamegetmod.php -->

                                </div>
                            </div>

                        </div>
                        <!-- package create tab  -->
                        <div class="tab-pane fade col-12  " id="v-pills-package" role="tabpanel" aria-labelledby="v-pills-package-tab">
                            <div class="row " id="packageTabBoxID">
                                <!-- sellPackageTab.php -->
                            </div>
                        </div>
                        <!-- customer masage  -->
                        <div class="tab-pane fade col-12 " id="v-pills-customers" role="tabpanel" aria-labelledby="v-pills-customers-tab">
                            <div class="row">
                                <div class="col-12  text-center rounded">
                                    <label class=" fs-4 fw-bold text-light">Manage Users</label>
                                </div>
                                <div class="col-12  rounded">
                                    <div class="row">
                                        <div class="col-12 textalin serbox">
                                            <span>Search</span>&nbsp;
                                            <input type="text" id="searchuserID" onkeyup="searchusertable(1);" class="col-8 col-md-6 ser1" />
                                            <br />


                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row" id="usertabel">
                                        <!-- sellerusertableget.php  -->

                                        <div class="col-12 col-md-11 textalin tblboxpro mt-3 p-0 p-md-5 pt-md-0 pb-md-0 scroll3" onmouseover="doo(3);" style="min-height: 540px;">

                                            <table class="wid100 tablpro whico" id="veiwtable">

                                                <tr>
                                                    <th class="th1">#</th>
                                                    <th class="th2">Email</th>
                                                    <th class="th3">Name</th>
                                                    <th class="th4">Mobile</th>
                                                    <th class="th5 d-none d-lg-table-cell">Register Date</th>
                                                    <th class="th6"></th>


                                                </tr>
                                                <?php
                                                $usersrs = DB::search("SELECT * FROM `user`WHERE `user_tid` !='2' ");
                                                $row = $usersrs->num_rows;
                                                $result_per_page = 10;
                                                $number_of_page = ceil($row / $result_per_page);
                                                $pageno;
                                                if (!isset($_GET["page"])) {
                                                    $pageno = 1;
                                                } else {
                                                    $pageno = $_GET["page"];
                                                }
                                                $page_first_result = ($pageno - 1) * $result_per_page;

                                                $selectedrs = DB::search("SELECT * FROM `user` WHERE `user_tid` !='2'  LIMIT " . $result_per_page . " OFFSET " . $page_first_result . "");

                                                for ($i = 0; $i < $selectedrs->num_rows; $i++) {
                                                    $srow = $selectedrs->fetch_assoc();
                                                ?>
                                                    <tr>
                                                        <td class="td position-relative" onclick="massageUserModal(<?php echo $srow['id']; ?>);" data-bs-toggle="modal" data-bs-target="#msgmoda"><?php echo $i + 1; ?>
                                                            <?php
                                                            $hmsg = DB::search("SELECT * FROM `chat` WHERE `seen_status`='1' AND `to_id`='" . $seller . "' AND `from_id`='" . $srow["id"] . "'");
                                                            if ($hmsg->num_rows != 0) {
                                                            ?>
                                                                <span class="position-absolute  translate-middle p-1 bg-danger rounded-circle" style="top: 30%; left: 80%;" id="sellerbadge<?php echo $srow["id"]  ?>">
                                                                </span>
                                                            <?php
                                                            }
                                                            ?>
                                                        </td>

                                                        <td class="td" onclick="massageUserModal(<?php echo $srow['id']; ?>);" data-bs-toggle="modal" data-bs-target="#msgmoda"><?php echo $srow["email"]; ?></td>
                                                        <td class="td" onclick="massageUserModal(<?php echo $srow['id']; ?>);" data-bs-toggle="modal" data-bs-target="#msgmoda"><?php echo $srow["first_name"] . " " . $srow["last_name"]; ?>

                                                        </td>
                                                        <td class="td" onclick="massageUserModal(<?php echo $srow['id']; ?>);" data-bs-toggle="modal" data-bs-target="#msgmoda"><?php echo $srow["mobile"]; ?></td>

                                                        <td class="td d-none d-lg-table-cell" onclick="massageUserModal(<?php echo $srow['id']; ?>);" data-bs-toggle="modal" data-bs-target="#msgmoda"><?php
                                                                                                                                                                                                        $rd = $srow["register_time"];
                                                                                                                                                                                                        $splitrd = explode(" ", $rd);
                                                                                                                                                                                                        echo $splitrd[0];
                                                                                                                                                                                                        ?></td>
                                                        <td class="td detd">
                                                            <?php
                                                            if ($srow["status_id"] == "1") {
                                                            ?>
                                                                <button onclick="BlockUserModal(<?php echo $srow['id']; ?>,2,<?php echo $pageno ?>);" class="dbtnproduct px-3 py-1"><i class="icofont-ui-lock"></i> </button>


                                                            <?php
                                                            } else {
                                                            ?>
                                                                <button onclick="BlockUserModal(<?php echo $srow['id']; ?>,1,<?php echo $pageno ?>);" class="dbtnproduct greenbtn px-3 py-1"><i class="icofont-ui-unlock"></i></button>

                                                            <?php
                                                            }
                                                            ?>
                                                        </td>

                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </table>
                                        </div>
                                        <div class="div1" id="btndiv1">
                                            <?php
                                            if ($pageno != 1) {
                                            ?>
                                                <button class="btn1" id="pre" onclick="searchusertable(<?php echo $pageno - 1 ?>);"><i class="icofont-rounded-double-left"></i></button>
                                            <?php
                                            } else {
                                            ?>
                                                <button class="btn1" id="pre"><i class="icofont-rounded-double-left"></i></button>

                                                <?php
                                            }

                                            for ($c = 1; $c <= $number_of_page; $c++) {

                                                if ($pageno == $c) {
                                                ?>
                                                    <button class="btn1 acti" onclick="searchusertable(<?php echo $c; ?>) ;"><?php echo $c; ?></button>

                                                <?php
                                                } else {
                                                ?>
                                                    <button class="btn1" onclick="searchusertable(<?php echo $c; ?>) ;"><?php echo $c; ?></button>
                                                <?php
                                                }
                                            }
                                            if ($pageno != $number_of_page && $number_of_page != 0) {
                                                ?>
                                                <button class="btn1" id="nx" onclick="searchusertable(<?php echo $pageno + 1 ?>);"><i class="icofont-rounded-double-right"></i></button>
                                            <?php
                                            } else {
                                            ?>
                                                <button class="btn1" id="nx"><i class="icofont-rounded-double-right"></i></button>

                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade p-0" id="msgmodal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg modal-fullscreen-md-down">
                                        <div class="modal-content" id="usermsgContentModal">
                                            <!-- customerMsgContent.php  -->

                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="blockuserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog  modal-dialog-centered">
                                        <div class="modal-content" id="usermsgContentModal">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Block User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to Block this User?

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn silbtn px-4" data-bs-dismiss="modal">No</button>
                                                <button type="button" class="btn redbtn px-4" id="blockbtn">Yse</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- notoficarion  -->
                        <div class="tab-pane fade col-12  " id="v-pills-notification" role="tabpanel" aria-labelledby="v-pills-notification-tab">

                            <div class="row pt-2">
                                <div class="col-12 ">
                                    <div class="row">
                                        <h4 class="text-white">Send Massage to All Customers</h4>
                                    </div>
                                    <div class="row px-3 ">
                                        <div class="col-12 col-lg-6  ">
                                            <label class="text-white">Subject</label>
                                            <br />
                                            <input class="form-control w-100 mt-1" id="subjectID" type="text" />
                                        </div>
                                        <div class="col-12 mt-1">
                                            <label class="text-white">Content</label>
                                            <textarea class="form-control w-100 mt-1 " style="height: 150px;" id="msgContentID" type="text"></textarea>
                                        </div>
                                        <button class="btn greenco text-white ms-auto me-3 mt-2 px-4" style="width: fit-content;" onclick="addnotification();">Submit</button>

                                    </div>
                                </div>

                            </div>
                            <div class="row pt-3 ">
                                <div class="col-10 m-auto notifybox" id="notifybox">
                                    <?php
                                    $notify = DB::search("SELECT * FROM `notification`");
                                    if ($notify->num_rows >= 1) {
                                        for ($i = 0; $i < $notify->num_rows; $i++) {
                                            $msg = $notify->fetch_assoc();
                                    ?>
                                            <div class="row p-2">
                                                <div class="col-12 boxnotifi">
                                                    <div class="row pt-3 pe-3 ps-3">
                                                        <h4><?php echo $msg["subject"] ?></h4>
                                                    </div>
                                                    <div class="row pe-3 ps-3">
                                                        <p><?php echo $msg["content"] ?></p>
                                                    </div>

                                                    <div class="row p-3 ">
                                                        <button class="btn redco pe-5 ps-5 ms-auto me-2" style="width: fit-content;" onclick="deletenotify(<?php echo $msg['nid'] ?>);">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php

                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div aria-live="polite" aria-atomic="true" class="position-relative bottom-0 end-0" style="z-index: 2000;">

                    <div class="toast-container position-fixed bottom-0 end-0 p-3" id="boxnoteID">



                    </div>
                </div>

            </div>
        </div>



        <script src="jquery//jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>

        <script src="seller.js"></script>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="popper.min.js"></script>
        <script src="bootstrap.js"></script>

        <script src="commen.js"></script>
        <script src="sellerProduct.js"></script>
        <script src="selPackage.js"></script>
        <script src="customer.js"></script>
        <script type="text/javascript">
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            })
        </script>
    </body>

    </html>
<?php
// } else {

?>
    <!-- <script>
        window.location = "login.php";
    </script> -->
<?php

// }
?>