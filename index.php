<?php
session_start();
require "database.php";
require "head.php";
require "footer.php";
date_default_timezone_set("Asia/Colombo");
$date = date("Y-m-d");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Home</title>
    <link rel="icon" href="cssfile//baclogoimg//logo2.png" />

    <link rel="stylesheet" href="cssfile//icofont.min.css">
    <link rel="stylesheet" href="cssfile//bootstrap.css">
    <link rel="stylesheet" href="cssfile//home.css">
    <link rel="stylesheet" href="cssfile//head.css" />

    <link rel="stylesheet" href="cssfile//foot.css" />


</head>

<body onload="m();setlink();">
    <div class="container-fluid">
        <?php
        HD::headview("home");

        ?>


        <div class="row ">


            <div class="col-12 col-md-11 col-lg-11 col-xl-10 topbox mx-auto ">
                <div class="row pd10 d-none d-md-flex">
                    <!-- left catrer  -->
                    <div class="col-0 col-md-4 col-lg-3 col-xl-3 tosleftbox">
                        <div class="row">
                            <div class="col-12 shortbox p-0">
                                <a href="shop.php?s=16&t=" class="text-decoration-none text-dark">
                                    <table>
                                        <tr>
                                            <td>
                                                <img src="cssfile//appimg//bevengers.jpeg" class="roundimgtop" />


                                            </td>
                                            <td> Beverages</td>

                                        </tr>
                                    </table>
                                </a>
                            </div>
                            <div class="col-12 shortbox p-0">
                                <table>
                                    <tr>
                                        <td>
                                            <img src="cssfile//appimg//Grainsbrade.jpg" class="roundimgtop" />


                                        </td>
                                        <td>Grains and Bread</td>

                                    </tr>
                                </table>
                            </div>
                            <div class="col-12 shortbox p-0">
                                <table>
                                    <tr>
                                        <td>
                                            <img src="cssfile//appimg//fish.png" class="roundimgtop" />


                                        </td>
                                        <td> Meat & Fish</td>

                                    </tr>
                                </table>
                            </div>
                        </div>


                    </div>
                    <!-- banner img  -->
                    <div class="col-12 col-md-8 col-lg-6 col-xl-6 banerimgbox">
                        <div class="row">
                            <div class="slideshow-container">

                                <div class="mySlides fade1 wid100">

                                    <img src="banerimg//dew.jpg" class="w-100 h-100">
                                    <!-- <div class="textmy">Caption Text</div> -->
                                </div>

                                <div class="mySlides fade1 wid100">

                                    <img src="banerimg//frei.jpg" class="w-100 h-100">
                                    <!-- <div class="textmy">Caption Two</div> -->
                                </div>

                                <div class="mySlides fade1 wid100">

                                    <img src="banerimg//safe.png" class="w-100 h-100">
                                    <!-- <div class="textmy">Caption Three</div> -->
                                </div>

                                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                                <a class="next" onclick="plusSlides(1)">&#10095;</a>

                            </div>
                            <br>

                            <div class="text-center">
                                <span class="dot" onclick="currentSlide(1)"></span>
                                <span class="dot" onclick="currentSlide(2)"></span>
                                <span class="dot" onclick="currentSlide(3)"></span>
                            </div>

                        </div>
                    </div>
                    <!-- right coter  -->
                    <div class="col-12 col-md-12 col-lg-3 col-xl-3  rightopbox">

                        <div class="row">
                            <div class=" d-none d-sm-block shortbox p-0">
                                <table>
                                    <tr>
                                        <td>
                                            <img src="cssfile//appimg//Condiments.jpg" class="roundimgtop" />


                                        </td>
                                        <td>Condiments</td>

                                    </tr>
                                </table>
                            </div>
                            <div class="  shortbox p-0">
                                <a href="shop.php?s=15&t=" class="text-decoration-none text-dark">

                                    <table>
                                        <tr>
                                            <td>
                                                <img src="cssfile//appimg//Dairy & Eggs.jpeg" class="roundimgtop" />

                                            </td>
                                            <td class="bannertopc1"></td>

                                        </tr>
                                    </table>
                                </a>
                            </div>
                            <div class="  shortbox p-0">
                                <table>
                                    <tr>
                                        <td>
                                            <img src="cssfile//appimg//Dessertfood.jpg" class="roundimgtop" />


                                        </td>
                                        <td class="bannertopc2"></td>

                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>
        <div class="row">
            <div class="col-12 col-md-11 col-lg-11 col-xl-10 showsortbox">
                <div class="row">
                    <div class=" col-12 col-md-12 col-lg-4 sholeft">
                        <div class="row">
                            <div class="subshobox">
                                <h4>Most Populer</h4>
                                <div class="cardshort scroll1" onmouseover="doo(1);">
                                    <?php
                                    $qpop = "SELECT * FROM user_has_product INNER JOIN product ON user_has_product.`product_pid`=product.`pid` WHERE product.`expire_date`>'" . $date . "'AND product.`delete`='0' GROUP BY (user_has_product.`product_pid`) ORDER BY COUNT(user_has_product.`product_pid`) DESC LIMIT 7";
                                    // $resultsetpop = $dbms->query($qpop);

                                    $resultsetpop = DB::search($qpop);

                                    $poprow = $resultsetpop->num_rows;
                                    for ($pop = 0; $pop < $poprow; $pop++) {
                                        $dpop = $resultsetpop->fetch_assoc();

                                    ?>
                                        <a href="productpage.php?pid=<?php echo  $dpop['pid'] ?>" class="text-decoration-none">
                                            <div class="cardmini" style="background-image: url('<?php echo $dpop["img"] ?>');">
                                            </div>
                                        </a>
                                    <?php

                                    }
                                    ?>



                                </div>
                            </div>

                        </div>
                    </div>
                    <div class=" col-12 col-md-6 col-lg-4 sholeft">
                        <div class="row">
                            <div class="subshobox">
                                <h4>New Arrival</h4>
                                <div class="cardshort scroll2" onmouseover="doo(2);">
                                    <?php
                                    $qnewpro = "SELECT * FROM product WHERE product.`expire_date`>'" . $date . "'AND product.`delete`='0' ORDER BY `pid` DESC LIMIT 7 ";
                                    // $resultsetnewpro = $dbms->query($qnewpro);

                                    $resultsetnewpro = DB::search($qnewpro);

                                    $newprorow = $resultsetnewpro->num_rows;
                                    for ($newpro = 0; $newpro < $newprorow; $newpro++) {
                                        $dnewpro = $resultsetnewpro->fetch_assoc();
                                    ?>

                                        <a href="productpage.php?pid=<?php echo  $dnewpro['pid'] ?>" class="text-decoration-none">
                                            <div class="cardmini" style="background-image: url('<?php echo $dnewpro["img"] ?>');">

                                            </div>
                                        </a>

                                    <?php
                                    }
                                    ?>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class=" col-12 col-md-6 col-lg-4 sholeft">
                        <div class="row">
                            <div class="subshobox">
                                <h4>Ending Soon</h4>
                                <div class="cardshort scroll3" onmouseover="doo(3);">
                                    <?php
                                    $qendsoon = "SELECT * FROM  product WHERE `qty`!='0'  AND product.`expire_date`>'" . $date . "'AND product.`delete`='0' ORDER BY `qty` ASC LIMIT 7 ";
                                    // $resultsetend = $dbms->query($qendsoon);

                                    $resultsetend = DB::search($qendsoon);

                                    $endrow = $resultsetend->num_rows;
                                    for ($end = 0; $end < $endrow; $end++) {
                                        $dendsoon = $resultsetend->fetch_assoc();
                                    ?>
                                        <a href="productpage.php?pid=<?php echo  $dendsoon['pid'] ?>" class="text-decoration-none">
                                            <div class="cardmini" style="background-image: url('<?php echo $dendsoon["img"] ?>');">
                                                <!-- <img src="" class="cardimgsample" /> -->
                                            </div>
                                        </a>
                                    <?php

                                    }
                                    ?>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>



        </div>
        <!-- catergory  -->
        <div class="row">
            <div class="col-12 col-md-11 col-xl-10 cato">
                <div class="row pd5cato">
                    <div class="col-12 col-md-6 col-lg-3 catosubbox">
                        <div class="row pd10cato">
                            <div class="col-12 catocard">

                                <div class="row hei100">
                                    <div class="catocardimg" style="background-image: url('cssfile//appimg//personalcare.jpg'); background-position: top;">

                                    </div>
                                    <div class="cterdes p-0">
                                        <table class="catertable">
                                            <tr>
                                                <td>Personal Care</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 catosubbox">
                        <div class="row pd10cato">
                            <div class="col-12 catocard">
                                <div class="row hei100">
                                    <div class="catocardimg" style="background-image: url('cssfile//appimg//teacoffe.jpg');">

                                    </div>
                                    <div class="cterdes p-0">
                                        <table class="catertable">
                                            <tr>
                                                <td>Tea & Cofee</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 catosubbox">
                    <a href="shop.php?&sub=69" class="text-decoration-none text-dark">

                        <div class="row pd10cato">

                            <div class="col-12 catocard">
                                <div class="row hei100">
                                    <div class="catocardimg" style="background-image: url('cssfile//appimg//chocolate.jpg');">

                                    </div>
                                    <div class="cterdes p-0">
                                        <table class="catertable">
                                            <tr>
                                                <td>Chocolate</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>

                    </div>
                    <div class="col-12 col-md-6 col-lg-3 catosubbox">
                        <div class="row pd10cato">
                            <div class="col-12 catocard">
                                <div class="row hei100">

                                    <div class="catocardimg" style="background-image: url('cssfile//appimg//office.jpg');">

                                    </div>
                                    <div class="cterdes p-0">
                                        <table class="catertable">
                                            <tr>
                                                <td>Office Tools</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="row">
            <div class="col-12 col-md-11 col-xl-10 samplecardmain M-LR-A mt-4 pb-4">
                <?php

                $qex = "SELECT main_category.`mid`,`name`, COUNT(product.`main_category_id`) AS `count`FROM  product INNER JOIN main_category  ON main_category.mid=product.main_category_id  WHERE `expire_date`>'" . $date . "' AND `delete`='0' GROUP BY product.`main_category_id`  ";

                // $resultsetex = $dbms->query($qex);

                $resultsetex = DB::search($qex);

                $exrow = $resultsetex->num_rows;
                $scroll = 4;

                for ($ex = 0; $ex < $exrow; $ex++) {
                    $dexmain = $resultsetex->fetch_assoc();
                    if ($dexmain["count"] >= 1) {

                ?>
                        <div class="row pt-2 ">
                            <span class="fs-4"><?php echo $dexmain["name"] ?>&nbsp; <a class=" text-decoration-none showtx" href="#" onclick="showall(<?php echo $dexmain['mid'] ?>);">Show all <i class="icofont-arrow-right"></i></a></span>
                            <div class="hedrow M-LR-A"></div>
                        </div>
                        <div class="row pd190sanpl">
                            <div class="col-12 col-md-12 ">
                                <div class="row">

                                    <div class=" cardboxsample p-2 scroll<?php echo $scroll ?>" onmouseover="doo(<?php echo $scroll ?>);">
                                        <?php
                                        $scroll++;
                                        ?>
                                        <?php
                                        $qexpro = "SELECT * FROM product INNER JOIN brand ON product.`brand_id`=brand.`brand_id` WHERE `main_category_id`='" . $dexmain['mid'] . "' AND product.`expire_date`>'" . $date . "'  AND product.`delete`='0' ORDER BY `pid` DESC  LIMIT 6 ";
                                        // $resultsetexpro = $dbms->query($qexpro);

                                        $resultsetexpro = DB::search($qexpro);

                                        $exprorow = $resultsetexpro->num_rows;
                                        for ($pro = 0; $pro < $exprorow; $pro++) {
                                            $dprodu = $resultsetexpro->fetch_assoc();
                                        ?>
                                            <a href="productpage.php?pid=<?php echo  $dprodu['pid'] ?>" class="text-decoration-none">
                                                <div class="samplecard mt-0 mb-auto">
                                                    <table class="h-100">
                                                        <tr>
                                                            <td class="h-100">
                                                                <img src="<?php echo $dprodu["img"] ?>" class="cardimgsample h-100 w-100" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="desshort">

                                                                <?php echo $dprodu["title"] ?>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="desshort">
                                                                Rs <?php echo $dprodu["price"] ?>.00
                                                                <?php
                                                                if ($dprodu["qty"] <= 0) {
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
                                            </a>

                                        <?php

                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-2 col-md-1  showall flexdis" onclick="showall(<?php echo $dprodu['main_category_id'] ?>);">

                                <span class="mTBauto b1">Show All<i class="icofont-arrow-right"></i></span>


                            </div> -->

                        </div>

                <?php
                    }
                }
                ?>

            </div>

        </div>


        <?php
        FOOT::footview("normal");
        ?>






    </div>
    <noscript>
        <div class="darkjavablock ">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger fw-bold fs-3" id="staticBackdropLabel">javascript blocked !!!</h5>

                    </div>
                    <div class="modal-body fs-5">
                        Please allow JavaScript in your browser. Then refresh your browser.
                        If you do not allow JavaScript, the web application will not work properly.

                    </div>
                </div>
            </div>
    </noscript>
    <script src="bootstrap.min.js"></script>
    <script src="navhider.js"></script>
    <script src="commen.js"></script>

    <script src="home.js"></script>

</body>

</html>