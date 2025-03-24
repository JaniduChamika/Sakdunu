<?php
require "database.php";

date_default_timezone_set("Asia/Colombo");
$date = date("Y-m-d");
$c = $_POST["main"];
$sub = $_POST["s"];
$brand = $_POST["b"];

?>

<!-- <div class="row mt-3 mb-3"> -->

<div class="col-12 col-md-11 pt-2  m-auto cardshopbox ">
    <span class="fs-2">
        <?php
        if ($c == "All" && $sub == "All" && $brand == "All") {
            echo "Shop Here";
        }
        if ($c == "All") {
            echo "";
        } else {
            $cater = DB::search("SELECT * FROM `main_category` WHERE `mid`='" . $c . "'");
            if ($cater->num_rows == 1) {
                $namecate = $cater->fetch_assoc();
                echo $namecate["name"];
            }
        ?>

        <?php
        }
        ?>

    </span>
    <?php
    if ($sub == "All") {
        echo "";
    } else {
    ?>
        <span class="fs-3"><i class="icofont-caret-right"></i></span>
        <span class="fs-4">

            <?php
            $subcater = DB::search("SELECT * FROM `sub_catergory` WHERE `sid`='" . $sub . "'");

            if ($subcater->num_rows == 1) {
                $namecate = $subcater->fetch_assoc();
                echo $namecate["name"];
            }

            ?>
        </span>

    <?php
    }
    ?>
    <?php
    if ($brand == "All") {
        echo "";
    } else {
    ?>
        <span class="fs-3"><i class="icofont-caret-right"></i></span>
        <span class="fs-5">

            <?php
            $barndrs = DB::search("SELECT * FROM `brand` WHERE `bid`='" . $brand . "'");
            if ($barndrs->num_rows == 1) {
                $namecate = $barndrs->fetch_assoc();
                echo $namecate["bname"];
            }

            ?>
        </span>

    <?php
    }
    ?>
    <div class="row p-2">
        <?php
        if (isset($_POST["page"])) {
            $pageno = $_POST["page"];
        } else {
            $pageno = 1;
        }



        $t = $_POST["t"];

        $min = $_POST["min"];
        $max = $_POST["max"];

        $sort = $_POST["n"];

        $sorttype;
        $what;

        // orders and ASC DESC adala colums variable valin set kirima
        if ($sort == "A") {
            $sorttype = "ASC";
            $what = "`bname`";
            $how = "ORDER BY";
        } else if ($sort == "H") {
            $sorttype = "DESC";
            $what = "`price`";
            $how = "ORDER BY";
        } else if ($sort == "L") {
            $sorttype = "ASC";
            $what = "`price`";
            $how = "ORDER BY";
        } else {
            $sorttype = "";
            $what = "";
            $how = "";
        }
        if ($sub == "All") {
            $sub = "%";
        }
        if ($c == "All") {
            $c = "%";
        }
        if ($brand == "All") {
            $brand = "%";
        }

        //         if ($sorttype == "none") {


        //             if ($max == "All") {
        //                 $q = "SELECT * FROM brand INNER JOIN product INNER JOIN main_category ON product.`main_category_id`=main_category.`mid` 
        // AND brand.`bid`=product.`brand_id`  WHERE `mid`LIKE'" . $c . "' AND 
        // ( product.`model`LIKE '" . $t . "%' OR brand.`bname`LIKE'" . $t . "%')
        //  AND product.`sub_catergory_id`LIKE'" . $sub . "'AND product.`brand_id` LIKE '" . $brand . "'
        //  AND `price` >= '" . $min . "'";
        //             } else {
        //                 $q = "SELECT * FROM brand INNER JOIN product INNER JOIN main_category ON product.`main_category_id`=main_category.`mid` 
        // AND brand.`bid`=product.`brand_id`  WHERE `mid`LIKE'" . $c . "' AND 
        // ( product.`model`LIKE '" . $t . "%' OR brand.`bname`LIKE'" . $t . "%')
        //  AND product.`sub_catergory_id`LIKE'" . $sub . "'AND product.`brand_id` LIKE '" . $brand . "'
        //  AND `price` BETWEEN '" . $min . "' AND '" . $max . "'";
        //             }
        //         } else {


        if ($max == "All") {
            $forpage = "SELECT * FROM brand INNER JOIN product INNER JOIN main_category ON product.`main_category_id`=main_category.`mid` 
        AND brand.`bid`=product.`brand_id`  WHERE `mid`LIKE'" . $c . "' AND 
        ( product.`title`LIKE '" . $t . "%' OR brand.`bname`LIKE'" . $t . "%')
         AND product.`sub_catergory_id`LIKE'" . $sub . "'AND product.`brand_id` LIKE '" . $brand . "' AND product.`expire_date`>'" . $date . "' AND product.`delete`='0'
         AND `price` >= '" . $min . "' " . $how . " " . $what . " " . $sorttype . "";
        } else {
            $forpage = "SELECT * FROM brand INNER JOIN product INNER JOIN main_category ON product.`main_category_id`=main_category.`mid` 
        AND brand.`bid`=product.`brand_id`  WHERE `mid`LIKE'" . $c . "' AND 
        ( product.`title`LIKE '" . $t . "%' OR brand.`bname`LIKE'" . $t . "%')
         AND product.`sub_catergory_id`LIKE'" . $sub . "'AND product.`brand_id` LIKE '" . $brand . "' AND product.`expire_date`>'" . $date . "' AND product.`delete`='0'
         AND `price` BETWEEN '" . $min . "' AND '" . $max . "' " . $how . " " . $what . " " . $sorttype . "";
        }
        $pagedisgn = DB::search($forpage);

        $pagesrow = $pagedisgn->num_rows;
        $number_per_page = 12;
        $number_page = ceil($pagesrow / 12);
        $result_page = ($pageno - 1) * $number_per_page;

        $q;
        if ($max == "All") {
            $q = "SELECT * FROM brand INNER JOIN product INNER JOIN main_category ON product.`main_category_id`=main_category.`mid` 
    AND brand.`bid`=product.`brand_id`  WHERE `mid`LIKE'" . $c . "' AND 
    ( product.`title`LIKE '" . $t . "%' OR brand.`bname`LIKE'" . $t . "%')
     AND product.`sub_catergory_id`LIKE'" . $sub . "'AND product.`brand_id` LIKE '" . $brand . "' AND product.`expire_date`>'" . $date . "' AND product.`delete`='0'
     AND `price` >= '" . $min . "' " . $how . " " . $what . " " . $sorttype . " LIMIT $number_per_page OFFSET $result_page";
        } else {
            $q = "SELECT * FROM brand INNER JOIN product INNER JOIN main_category ON product.`main_category_id`=main_category.`mid` 
    AND brand.`bid`=product.`brand_id`  WHERE `mid`LIKE'" . $c . "' AND 
    ( product.`title`LIKE '" . $t . "%' OR brand.`bname`LIKE'" . $t . "%')
     AND product.`sub_catergory_id`LIKE'" . $sub . "'AND product.`brand_id` LIKE '" . $brand . "' AND product.`expire_date`>'" . $date . "' AND product.`delete`='0'
     AND `price` BETWEEN '" . $min . "' AND '" . $max . "' " . $how . " " . $what . " " . $sorttype . " LIMIT $number_per_page OFFSET $result_page";
        }
        // }
        $resultset = DB::search($q);

        $r = $resultset->num_rows;
        if ($r == 0) {
        ?>

            <p class="tx-aling mt-5 ">Not Availeble</p>
        <?php
        }

        ?>

        <?php
        for ($i = 0; $i < $r; $i++) {
            $d = $resultset->fetch_assoc();
        ?>
            <div class="col-6 col-md-4 col-lg-3  col-xl-2 cardshop mt-0 mb-0">
                <a href="productpage.php?pid=<?php echo  $d['pid'] ?>">
                    <div class="row p-1 h-100">
                        <div class=" cardinshop p-2">


                            <table class="cardtable wid100 hei100">
                                <tr>
                                    <td class="h-100">


                                        <!-- <div class="imgshopcard"> -->
                                        <img src="<?php echo $d["img"] ?>" class="imgcard h-100" />

                                        <!-- </div> -->
                                    </td>
                                </tr>

                                <tr>
                                    <td><?php echo $d["title"] ?></td>
                                </tr>

                                <tr>
                                    <td class="texbot">Rs.<?php echo number_format($d["price"], 2) ?>
                                        <?php
                                        if ($d["qty"] <= 0) {
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
        ?>
        <div class="col-12 text-center my-2">
            <?php
            if ($r != 0) {

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
                        <button class="btn1 acti  px-3" onclick="mainfilter(1,<?php echo $c; ?>) ;"><?php echo $c; ?></button>

                    <?php
                    } else {
                    ?>
                        <button class="btn1 px-3" onclick="mainfilter(1,<?php echo $c; ?>) ;"><?php echo $c; ?></button>
                    <?php
                    }
                }
                if ($pageno != $number_page && $number_page != 0) {
                    ?>
                    <button class="btn1  px-3 " id="nx" onclick="mainfilter(1,<?php echo $pageno + 1 ?>);"><i class="icofont-rounded-double-right"></i></button>
                <?php
                } else {
                ?>
                    <button class="btn1  px-3" id="nx"><i class="icofont-rounded-double-right"></i></button>

            <?php
                }
            }
            ?>
        </div>
    </div>
</div>

<!-- </div> -->