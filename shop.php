<?php
session_start();
require "database.php";
require "footer.php";

date_default_timezone_set("Asia/Colombo");
$date = date("Y-m-d");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Shop</title>
    <link rel="icon" href="cssfile//baclogoimg//logo2.png" />

    <link rel="stylesheet" href="cssfile//icofont.min.css">
    <link rel="stylesheet" href="cssfile//bootstrap.css">
    <link rel="stylesheet" href="cssfile//shop.css">
    <link rel="stylesheet" href="cssfile//head.css" />
    <link rel="stylesheet" href="cssfile//foot.css" />


</head>

<body onload="setlink();">
    <div class="container-fluid vh-100">
        <?php
        $sel = "All";
        $in = "";

        if (isset($_GET["s"])) {
            $sel = $_GET["s"];
        }
        if (isset($_GET["t"])) {
            $in = $_GET["t"];
        }
        $sub = "All";
        if (isset($_GET["sub"])) {
            $sub = $_GET["sub"];
        }
        ?>
        <div class="row">


            <div class="topnav col-12" id="navbarmy">
                <div class="row ">
                    <div class="col-12 col-md-3 col-lg-3 col-xxl-2 hedimgbox">
                        <a href="index.php" class="text-decoration-none">
                            <img src="cssfile//baclogoimg//logo2.png" class="logo" />
                            <img src="cssfile//baclogoimg//lohosub.png" class="logo2" />
                        </a>
                    </div>
                    <div class="col-12 col-md-9 col-lg-9 col-xxl-10 headObox ">
                        <div class="row hei100 mt-2">
                            <div class="col-3 pad-0 ps-4 ps-md-0">
                                <select class="searchsel mTBauto" id="mainheadID" onchange="mainfilter(1,1);getsub();">
                                    <option value="All" selected> Any </option>

                                    <?php


                                    $qhead = "SELECT * FROM main_category ;";
                                    // $resultsethead = $dbms->query($qhead);
                                    $resultsethead = DB::search($qhead);

                                    $rhed = $resultsethead->num_rows;
                                    for ($i = 0; $i < $rhed; $i++) {
                                        $dhed = $resultsethead->fetch_assoc();
                                        if ($sel == $dhed["mid"]) {
                                    ?>
                                            <option value="<?php echo $dhed['mid'] ?>" selected>

                                                <?php echo $dhed['name'] ?>
                                            </option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="<?php echo $dhed['mid'] ?>">
                                                <?php echo $dhed['name'] ?>
                                            </option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-6 col-md-6 pad-0">

                                <input type="text" placeholder="Search.." class="searchmain mTBauto" name="search" value="<?php echo $in ?>" onkeyup="emptyknow();" id="mainserchtypeID">
                            </div>
                            <div class="col-2 col-md-2 pad-0">

                                <button class="searcbtn mTBauto" onclick="mainfilter(1,1);"><i class="icofont-search-2"></i></button>
                            </div>
                            <div class="col-1 pad-0">

                                <button class="cart mx-auto d-none d-md-block" onclick="goCart()"><i class="icofont-cart"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="hed2">
                        <button class="sidemenubtn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"><i class="icofont-navigation-menu"></i></button>
                        <div class=" hed2option ">
                            <div class="row hei100">
                                <button class="hed2optionbtn cartclz d-md-none" onclick="goCart()"><i class="icofont-cart"></i></button>
                                <button class="hed2optionbtn wishclz" onclick="goWishlist();"><i class="icofont-heart"></i> </button>
                                <button class="hed2optionbtn packageclz" onclick="goPackge();"><i class="icofont-bag"></i> </button>
                                <button class="hed2optionbtn notoficationclz" onclick="goNotification();"><i class="icofont-notification"></i> </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="offcanvas offcanvas-start sidenav" id="offcanvasExample">

            <!-- <a href="javascript:void(0)" class="closebtn" data-bs-dismiss="offcanvas" aria-label="Close"><i class="icofont-arrow-left"></i></a> -->
            <?php
            if (isset($_SESSION["name"])) {
            ?>
                <a style="padding: 0px;" href="#" id="loginlinkID">
                    <button class="firstsign">
                        Welcome &nbsp;<?php echo $_SESSION["name"] ?>
                    </button></a>
            <?php
            } else {
            ?>
                <a style="padding: 0px;" href="login.php" onload="setlink();" id="loginlinkID">
                    <button class="firstsign">
                        <i class="icofont-user-alt-7"></i> Sign In/Up
                    </button></a>
            <?php
            }
            ?>

            <button class=" othermain pt-4" onclick="goIndex();">
                <a style="padding: 0px;" href="index.php">
                    <h4><i class="icofont-home"></i>Home</h4>
                </a></a>
            </button>
            <button class="othermain activemy pt-4" onclick="goShop();">
                <a style="padding: 0px;" href="shop.php">
                    <h4><i class="icofont-prestashop"></i>&nbsp;Shop</h4>
                </a>
            </button>
            <?php
            if (isset($_SESSION["type"])) {
                if ($_SESSION["type"] == "seller") {

            ?>
                    <button class="othermain">
                        <a style="padding: 0px;" href="seller.php">
                            <h4><i class="icofont-ui-clip-board"></i>Seller Board</h4>
                        </a>
                    </button>
            <?php
                }
            }

            ?>
            <div class="accordion accordion-flush trans" id="accordionFlushExample">
                <div class="accordion-item trans">
                    <h2 class="accordion-header " id="flush-headingtop1">
                        <button class="accordion-button collapsed bthead" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsetop1" aria-expanded="false" aria-controls="flush-collapseOne">

                            <h4> <i class="icofont-brand-microsoft"></i> Catergories</h4>
                        </button>
                    </h2>
                    <div id="flush-collapsetop1" class="accordion-collapse collapse subcontent" aria-labelledby="flush-headingOne">
                        <?php

                        $qcater = "SELECT *FROM main_category";
                        // $resultsetmain = $dbms->query($qcater);

                        $resultsetmain = DB::search($qcater);
                        $mainrow = $resultsetmain->num_rows;

                        for ($main = 0; $main < $mainrow; $main++) {
                            $dmain = $resultsetmain->fetch_assoc();
                        ?>
                            <div class="accordion-item trans">
                                <h2 class="accordion-header " id="flush-heading<?php echo $main ?>">
                                    <button class="accordion-button collapsed " type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?php echo $main ?>" aria-expanded="false" aria-controls="flush-collapse<?php echo $main ?>">
                                        &nbsp;<?php echo $dmain["name"] ?>
                                    </button>
                                </h2>
                                <div id="flush-collapse<?php echo $main ?>" class="accordion-collapse collapse subcontent" aria-labelledby="flush-heading<?php echo $main ?>">


                                    <?php
                                    $qsub = "SELECT * FROM sub_catergory WHERE `main_category_id`= '" . $dmain["mid"] . "'";
                                    // $resultsetsub = $dbms->query($qsub);

                                    $resultsetsub = DB::search($qsub);
                                    $subrow = $resultsetsub->num_rows;
                                    for ($sub1 = 0; $sub1 < $subrow; $sub1++) {
                                        $dsub = $resultsetsub->fetch_assoc();

                                    ?>
                                        <a class="accordion-body" href="shop.php?sub=<?php echo $dsub["sid"] ?>"><?php echo $dsub["name"] ?> </a>
                                    <?php

                                    }
                                    ?>

                                </div>
                            </div>

                        <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
            <!-- <button class="othermain pt-4" onclick="">
                <a style="padding: 0px;" href="#">
                    <h4><i class="icofont-info-circle"></i>About</h4>
                </a>
            </button> -->
            <button class="othermain pt-4" onclick="">
                <a style="padding: 0px;" href="contact.php">
                    <h4><i class="icofont-ui-contact-list"></i>Contact Us</h4>
                </a>
            </button>
            <button class="othermain" onclick="">
                <a style="padding: 0px;" href="#">
                    <h4><i class="icofont-question-circle"></i>Help</h4>
                </a>
            </button>
            <nav class="mb-0 mt-auto">
                <div class="btn-group dropup navbar navbar-expand-lg mb-0">
                    <button class="dropdown-toggle othermain" onclick="" style="margin-bottom: 10px;margin-top: auto;" data-bs-toggle="dropdown" aria-expanded="false">

                        <h4><i class="icofont-user-alt-5"></i>&nbsp; Account</h4>

                    </button>
                    <ul class="dropdown-menu ms-5 pointer">
                        <li><a class="dropdown-item" href="userorders.php">Purchase History</a></li>
                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>

                        <li>
                            <hr>
                        </li>
                        <?php
                        if (isset($_SESSION["name"])) {
                        ?>
                            <li onclick="logout();"><a class="dropdown-item" href="#">Log Out</a></li>
                        <?php
                        } else {
                        ?>
                            <li onclick="login();"><a class="dropdown-item" href="#">Log In</a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>

            </nav>
        </div>

        <input type="checkbox" id="openSideMenu" class="openSideMenu" onclick="openNav()">
        <label for="openSideMenu" class="menuIconToggle" id="menuicon">
            <div class="btopen" id="bton"><i class="icofont-filter"></i>Filter</div>

        </label>
        <!-- side bar right  -->
        <div id="mySidenav" class="sidenavright">

            <div class="filterdiv">
                <h4>
                    Main Catergories

                </h4>
                <select class="selectfilter mb-2" onchange="getsub('s');" id="filtermainID">
                    <option value="All" selected> Any </option>

                    <?php

                    $q = "SELECT * FROM main_category ;";
                    // $resultset = $dbms->query($q);

                    $resultset = DB::search($q);

                    $r = $resultset->num_rows;
                    for ($i = 0; $i < $r; $i++) {
                        $d = $resultset->fetch_assoc();
                        if (isset($_GET["s"]) && $sel == $d["mid"]) {
                    ?>
                            <option selected="" value="<?php echo $d['mid'] ?>">

                                <?php echo $d['name'] ?>
                            </option>
                        <?php

                        } else {
                        ?>
                            <option value="<?php echo $d['mid'] ?>">

                                <?php echo $d['name'] ?>
                            </option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="filterdiv">
                <h4>
                    Sub Catergories

                </h4>
                <select class="selectfilter mb-2" id="filtersubID" onchange="getbrand('s');">
                    <option value="All" selected> Any </option>

                    <?php

                    $q1 = "SELECT * FROM sub_catergory;";
                    // $resultset1 = $dbms->query($q1);

                    $resultset1 = DB::search($q1);

                    $r1 = $resultset1->num_rows;
                    for ($i1 = 0; $i1 < $r1; $i1++) {
                        $d1 = $resultset1->fetch_assoc();
                        if ($sub == $d1["sid"]) {
                    ?>
                            <option value="<?php echo $d1['sid'] ?>" selected> <?php echo $d1['name'] ?></option>

                        <?php
                        } else {
                        ?>

                            <option value="<?php echo $d1['sid'] ?>"> <?php echo $d1['name'] ?></option>

                    <?php
                        }
                    }

                    ?>
                </select>
            </div>

            <div class="filterdiv">
                <h4>
                    Brand

                </h4>
                <select class="selectfilter mb-2" id="filterbrandID" onchange="mainfilter(1,1);">
                    <option value="All" selected> Any </option>

                    <?php

                    $q2 = "SELECT * FROM brand;";
                    // $resultset2 = $dbms->query($q2);

                    $resultset2 = DB::search($q2);

                    $r2 = $resultset2->num_rows;
                    for ($i2 = 0; $i2 < $r2; $i2++) {
                        $d2 = $resultset2->fetch_assoc();
                    ?>

                        <option value="<?php echo $d2['bid'] ?>"> <?php echo $d2['bname'] ?> </option>

                    <?php


                    }

                    ?>
                </select>
            </div>


            <div class=" trans filterprice">

                <div class="subcontent" style="width: 290px;">
                    <h4>
                        Price Range

                    </h4>
                    <table class="price ">
                        <tr>
                            <td><input class="accordion-body filradio" type="radio" name="pricerang" onclick="mainfilter('1R',1);" min="0" max="All" checked="" id="1R" /></td>
                            <td><label for="1R">Any Price</label></td>
                        </tr>
                        <tr>
                            <td><input class="accordion-body filradio" type="radio" name="pricerang" min="0" max="100" onclick="mainfilter('2R',1);" id="2R" /></td>
                            <td><label for="2R"> Rs 0 to Rs 100</label></td>
                        </tr>
                        <tr>
                            <td><input class="accordion-body filradio" type="radio" name="pricerang" min="100" max="500" onclick="mainfilter('3R',1);" id="3R" /></td>
                            <td><label for="3R"> Rs 100 to Rs 500</label></td>

                        </tr>
                        <tr>
                            <td><input class="accordion-body filradio" type="radio" name="pricerang" min="500" max="1000" onclick="mainfilter('4R',1);" id="4R" /></td>
                            <td><label for="4R"> Rs 500 to Rs 1000</label> </td>

                        </tr>
                        <tr>
                            <td> <input class="accordion-body filradio" type="radio" name="pricerang" min="1000" max="2000" onclick="mainfilter('5R',1);" id="5R" /></td>
                            <td><label for="5R"> Rs 1000 to Rs 2000</label></td>

                        </tr>

                        <tr>
                            <td> <input class="accordion-body filradio" type="radio" name="pricerang" onclick="mainfilter('7R',1);" id="7R" /></td>

                            <td>
                                <label for="7R"> Custom Price </label>
                            </td>
                        </tr>
                    </table>

                    <table style="width: 95%;">

                        <tr>
                            <td style="width: 45%;"><input type="text" class="wid100 minin" id="minin" placeholder="MIN" min="0" disabled=""></td>
                            <td class="fon2" style=" width: 10%; text-align: center;">to</td>

                            <td style="width: 45%;"> <input type="text" class="wid100 minin" id="maxin" placeholder="MAX" max="All" disabled=""> </td>

                        </tr>
                        <tr>
                            <td colspan="3">
                                <button class="subpricecebtn" id="pricesubbtn" disabled="" onclick="mainfilter('7R',1);">Submit</button>
                            </td>
                        </tr>

                    </table>
                    <table style="width: 95%;">
                        <tr>
                            <td>
                                <button class="subpricecebtn" id="pricesubbtn" onclick="mainfilter('A',1)">A<i class="icofont-sort-alt"></i></button>
                            </td>
                            <td>
                                <button class="subpricecebtn" id="pricesubbtn" onclick="mainfilter('H',1)">High - Low</i></button>
                            </td>
                            <td>
                                <button class="subpricecebtn" id="pricesubbtn" onclick="mainfilter('L',1)">Low - High</button>
                            </td>
                        </tr>
                    </table>




                </div>
            </div>
        </div>
        <div class="row pdtop" style="min-height: 550px;">
            <div class="col-12 ">


                <div class="row ">
                    <div class="col-12 col-md-11 m-auto pt-2 catercard ">
                        <span class="fs-2">Catergories</span>&nbsp; <a class=" text-decoration-none text-dark" href="allcategory.php">Show all <i class="icofont-arrow-right"></i></a>

                        <div class="row p-2 d-flex justify-content-center">
                            <?php
                            $qca = "SELECT * FROM main_category LIMIT 6 ;";
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
                </div>
                <div class="row mt-5" id="shophearID">

                    <div class="col-12 col-md-11 pt-2 m-auto cardshopbox ">

                        <?php
                        if (isset($_GET["s"]) && $sel != "All") {
                        ?>
                            <span class="fs-2">
                                <?php

                                $cater = DB::search("SELECT * FROM `main_category` WHERE `mid`='" . $sel . "'");
                                if ($cater->num_rows == 1) {
                                    $namecate = $cater->fetch_assoc();
                                    echo $namecate["name"];
                                }
                                ?>

                                    </span>
                        <?php
                        } else if (isset($_GET["sub"]) && $sub != "All") {
                        ?>

                            <!-- <span class="fs-3"><i class="icofont-caret-right"></i></span> -->
                            <span class="fs-3">

                                <?php
                                $subcater = DB::search("SELECT * FROM `sub_catergory` WHERE `sid`='" . $sub . "'");

                                if ($subcater->num_rows == 1) {
                                    $namecate = $subcater->fetch_assoc();
                                    echo $namecate["name"];
                                }

                                ?>
                            </span>


                        <?php
                        } else {
                        ?>
                            <span class="fs-2">Shopping Here</span>

                        <?php
                        }
                        ?>
                        <div class="row p-2  ">
                            <?php
                            $pageno = 1;

                            $qromain = "SELECT * FROM product INNER JOIN brand ON product.`brand_id`=brand.`bid` WHERE product.`expire_date`>'" . $date . "' AND product.`delete`='0' ";
                            $forpage;
                            $content;
                            $content2;
                            if (isset($_GET["s"]) && $sel != "All") {

                                $content =  $qromain . " AND product.`main_category_id`='" . $sel . "'";
                            } else {
                                $content = $qromain;
                            }
                            if (isset($_GET["t"])) {
                                $content2 =  $content . " AND product.`title` LIKE '%" . $in . "%' ";
                            } else {
                                $content2 =  $content;
                            }

                            if (isset($_GET["sub"]) && $sub != "All") {

                                $forpage = $content2 . " AND product.`sub_catergory_id`='" . $sub  . "' ";
                            } else {
                                $forpage = $content2;
                            }


                            $pagedisgn = DB::search($forpage);

                            $pagesrow = $pagedisgn->num_rows;
                            $number_per_page = 12;
                            $number_page = ceil($pagesrow / 12);
                            $result_page = ($pageno - 1) * $number_per_page;
                            $qmain = "SELECT * FROM product INNER JOIN brand ON product.`brand_id`=brand.`bid` WHERE product.`expire_date`>'" . $date . "' AND product.`delete`='0' ";
                            $qmpage;
                            $qmain2;
                            $qmain3;
                            if (isset($_GET["sub"]) && $sub != "All") {

                                $qmain2 =  $qmain . " AND product.`sub_catergory_id`='" . $sub . "'";
                            } else {
                                $qmain2 =  $qmain;
                            }
                            if (isset($_GET["s"]) && $sel != "All") {

                                $qmain3 = $qmain2 . " AND product.`main_category_id`='" . $sel . "'";
                            } else {
                                $qmain3 = $qmain2;
                            }
                            if (isset($_GET["t"])) {
                                $qmpage = $qmain3 . " AND product.`title` LIKE '%" . $in . "%' ";
                            } else {
                                $qmpage = $qmain3;
                            }
                            $qshop = $qmpage . " LIMIT $number_per_page OFFSET $result_page";
                            // echo  $qshop;
                            $resultsetshop = DB::search($qshop);
                            $rowshop = $resultsetshop->num_rows;
                            if ($pagesrow == 0) {
                            ?>

                                <p class="tx-aling mt-5 ">Not Availeble</p>
                            <?php
                            }
                            for ($sho = 0; $sho < $rowshop; $sho++) {
                                $dshop = $resultsetshop->fetch_assoc();
                            ?>

                                <div class="col-6 col-md-4 col-lg-3  col-xl-2 cardshop mt-0 mb-0">
                                    <a href="productpage.php?pid=<?php echo  $dshop['pid'] ?>" class="p-0 text-decoration-none h-100">

                                        <div class="row p-1 h-100">
                                            <div class=" cardinshop p-2">


                                                <table class="cardtable wid100 hei100">
                                                    <tr>
                                                        <td class="h-100">


                                                            <!-- <div class="imgshopcard"> -->
                                                            <img src="<?php echo $dshop["img"] ?>" class="imgcard h-100" />

                                                            <!-- </div> -->
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td><?php echo $dshop["title"]  ?></td>
                                                    </tr>

                                                    <tr>
                                                        <td class="texbot">Rs.<?php echo $dshop["price"] ?>.00
                                                            <?php
                                                            if ($dshop["qty"] <= 0) {
                                                            ?>
                                                                <span class="text-danger">&nbsp;Out of stock</span>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <span class="text-success">&nbsp;In stock</span>

                                                            <?php
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                </table>


                                            </div>
                                        </div>
                                    </a>

                                </div>
                            <?php
                            }
                            if ($pagesrow != 0) {

                            ?>

                                <div class="col-12 text-center my-2">
                                    <?php
                                    if ($pageno != 1) {
                                    ?>
                                        <button class="btn1  px-3" id="pre" onclick="mainfilter(1,<?php echo $pageno - 1 ?>);"><i class="icofont-rounded-double-left"></i></button>
                                    <?php
                                    } else {
                                    ?>
                                        <button class="btn1  px-3" id="pre"><i class="icofont-rounded-double-left"></i></button>

                                        <?php
                                    }

                                    for ($c = 1; $c <= $number_page; $c++) {

                                        if ($pageno == $c) {
                                        ?>
                                            <button class="btn1 acti px-3" onclick="mainfilter(1,<?php echo $c; ?>) ;"><?php echo $c; ?></button>

                                        <?php
                                        } else {
                                        ?>
                                            <button class="btn1 px-3" onclick="mainfilter(1,<?php echo $c; ?>) ;"><?php echo $c; ?></button>
                                        <?php
                                        }
                                    }
                                    if ($pageno != $number_page && $number_page != 0) {
                                        ?>
                                        <button class="btn1  px-3" id="nx" onclick="mainfilter(1,<?php echo $pageno + 1 ?>);"><i class="icofont-rounded-double-right"></i></button>
                                    <?php
                                    } else {
                                    ?>
                                        <button class="btn1  px-3" id="nx"><i class="icofont-rounded-double-right"></i></button>

                                    <?php
                                    }
                                    ?>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <?php
        FOOT::footview("normal");
        ?>



    </div>

    <script src="bootstrap.js"></script>
    <!-- <script src="navhider.js"></script> -->
    <script src="commen.js"></script>

    <script src="shop.js"></script>
    <?php
    if (isset($_GET["s"])) {
    ?>
        <script>
            // mainfilter(1, 1);
            getsub('n');
        </script>

    <?php
    } else if (isset($_GET["t"])) {
    ?>
        <script>
            // mainfilter(1, 1);
        </script>

    <?php
    } else if (isset($_GET["sub"])) {
    ?>

        <script>
            // mainfilter(1, 1);

            getbrand('n');
        </script>
    <?php
    }


    ?>


</body>

</html>