<?php
session_start();
if (isset($_GET["packid"])) {
    require "database.php";
    require "head.php";
    require "footer.php";
    date_default_timezone_set("Asia/Colombo");
    $date = date("Y-m-d");

    $packID = $_GET["packid"];

    $q = "SELECT * FROM package WHERE `pack_id`='" . $packID . "'";
    $resultset = DB::search($q);
    $d = $resultset->fetch_assoc();

?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $d["pack_name"] ?> Package</title>
        <link rel="icon" href="cssfile//baclogoimg//logo2.png" />

        <link rel="stylesheet" href="cssfile//bootstrap.css" />
        <link rel="stylesheet" href="cssfile//icofont.min.css" />
        <link rel="stylesheet" href="cssfile//head.css" />
        <link rel="stylesheet" href="cssfile//foot.css" />

        <link rel="stylesheet" href="cssfile//package.css" />

    </head>

    <body>
        <div class="container-fluid ">
            <?php
            HD::headview("package");
            ?>
            <div class="row mattop2 heigt480">
                <?php
                if ($resultset->num_rows == 1) {
                    // $d = $resultset->fetch_assoc();
                ?>
                    <div class="col-12 col-md-11 pt-2 m-auto cardshopbox ">
                        <h2><?php echo $d["pack_name"] ?></h2>
                        <div class="row p-2  ">
                            <?php
                            $qshop = "SELECT * FROM  product INNER JOIN pack_product ON product.`pid`=pack_product.`product_pid` INNER JOIN brand ON product.`brand_id`=brand.`bid` WHERE product.`expire_date`>'" . $date . "' AND pack_product.`package_id`='" . $packID . "'";
                            $resultsetshop = DB::search($qshop);
                            $rowshop = $resultsetshop->num_rows;
                            for ($sho = 0; $sho < $rowshop; $sho++) {
                                $dshop = $resultsetshop->fetch_assoc();
                            ?>
                                <div class="col-6 col-md-4 col-lg-3  col-xl-2 cardshop mt-0 mb-0">
                                    <a href="productpage.php?pid=<?php echo  $dshop['pid'] ?>" class="p-0 text-decoration-none h-100">
                                        <div class="row p-1 h-100">
                                            <div class=" cardinshop p-2">
                                                <table class="cardtable wid100 hei100">
                                                    <tr>
                                                        <td class="textop ">
                                                            <div class="imgshopcard">
                                                                <img src="<?php echo $dshop["img"] ?>" class="wid100 imgcard" />
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td><?php echo $dshop["title"]  ?></td>
                                                    </tr>

                                                    <tr>
                                                        <td class="texbot">Rs.<?php echo number_format($dshop["price"], 2) ?></td>
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

                <?php
                } else {
                ?>
                    <div class="col-12 m-auto text-center p-5">
                        <span class="m-auto">Please try again leter</span>
                        <br />
                        <a href="index.php" class="btn silever mt-3">continue Shopping</a>
                    </div>
                <?php
                }

                ?>


                <div class="col-12 buybox mt-5 mb-0">
                    <div class="row p-4">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-lg-4 col-xl-3 my-2">
                                    <h3 class="text-white"><?php echo $d["pack_name"] ?></h3>

                                </div>
                                <div class="col-12 col-lg-3 col-xl-4 my-2 text-white">
                                    <span class="fs-5 ">Start date :</span>
                                    <span class="fs-5"><?php echo $d["strat_date"] ?></span>
                                    <br />
                                    <span class="fs-5">End date :</span>
                                    <span class="fs-5"><?php echo $d["end_date"] ?></span>

                                </div>
                                <div class="col-12 col-lg-3  col-xl-3 my-2 text-white">
                                    <span class="fs-5">Price : </span>
                                    <span class="fs-5"><?php
                                                        $q3 = "SELECT SUM(product.`price`) AS `total_price` FROM pack_product INNER JOIN product ON pack_product.`product_pid`=product.`pid` 
                                                      WHERE pack_product.`package_id`='" . $packID . "' ";
                                                        $resultsetIn = DB::search($q3);
                                                        if ($resultsetIn->num_rows == 1) {
                                                            $din = $resultsetIn->fetch_assoc();
                                                            $realPrice = $din["total_price"];
                                                            $newPrice = $realPrice - ceil($realPrice * ($d["discount"] / 100));
                                                        ?>
                                            Rs.<?php echo number_format($newPrice, 2) ?>
                                        <?php
                                                        }
                                        ?></span>
                                    <br />
                                    <span class="smailFont text-decoration-line-through ">
                                        <?php

                                        if ($d["discount"] != 0) {
                                        ?>
                                            Rs.<?php echo number_format($realPrice, 2) ?>
                                        <?php
                                        }
                                        ?>
                                    </span>

                                </div>
                                <div class="col-12 col-lg-2 col-xl-2  text-lg-center my-2">
                                    <?php

                                    if ($d["end_date"] < $date || $d["strat_date"] > $date) {

                                    ?>
                                        <button class="btn orangco px-5 py-3 text-white fs-5" disabled>Buy Now</button>

                                    <?php
                                    } else {
                                    ?>
                                        <a class="btn orangco px-5 py-3 text-white fs-5" href="cheackoutPackage.php?packid=<?php echo $packID ?>">Buy Now</a>

                                    <?php
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            FOOT::footview("prodctpage");
            ?>
        </div>
        <script src="navhider.js"></script>
        <script src="commen.js"></script>
        <script src="bootstrap.min.js"></script>

    </body>

    </html>

<?php
} else {
    echo "Try again leter";
}
