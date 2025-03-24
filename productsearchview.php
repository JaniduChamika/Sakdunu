<?php
session_start();
require "database.php";


$page = $_POST["p"];
$offeset = 12 * ($page - 1);
$serch = $_POST["s"];
$cater = $_POST["c"];

$serchsel = $_POST["bid"];
$sort = $_POST["sort"];

date_default_timezone_set("Asia/Colombo");
$date = date("Y-m-d");

// if (empty($serch)) {
//     if ($serchsel == "All") {
//         $q = "SELECT product.`pid`, brand.`bname`,product.`model`,product.`qty`,product.`price`,product.`description`,product.`img` FROM product INNER JOIN brand ON product.`brand_id`=brand.`bid` WHERE product.`delete`='0' LIMIT  $bt,12 ;";
//     } else {
//         $q = "SELECT product.`pid`, brand.`name`,product.`model`,product.`qty`,product.`price`, product.`description`, product.`img` FROM product INNER JOIN brand  ON product.`brand_id`=brand.`bid` WHERE product.`brand_id`LIKE '" . $serchsel . "%' AND product.`delete`='0' LIMIT  $bt,12 ;";
//     }
// } else {

$q = "SELECT  product.`pid`, brand.`bname`,product.`model`,product.`img`,product.`title`,product.`qty`,product.`price`,product.`expire_date` FROM product
INNER JOIN brand  ON product.`brand_id`=brand.`bid` WHERE   product.`delete`='0'";
$q1;
if ($serchsel != "All" && $cater != "All") {
    $q1 = $q . " AND (product.`title`  LIKE '%" . $serch . "%' OR brand.`bname`LIKE '" . $serch . "%') AND product.`brand_id`='" . $serchsel . "' AND product.`main_category_id`='" . $cater . "' ";
} else if ($cater != "All") {

    $q1 = $q . "AND (product.`title` LIKE '%" . $serch . "%' AND product.`main_category_id`='" . $cater . "')";
} else if ($serchsel != "All") {

    $q1 = $q . "AND (product.`title` LIKE '%" . $serch . "%' AND product.`brand_id`='" . $serchsel . "')";
} else {
    $q1 = $q . "AND  product.`title` LIKE '%" . $serch . "%'";
}

$qs;
if ($sort == "Qlth") {
    $qs = $q1 . "ORDER BY `qty` ASC";
} else if ($sort == "Qhtl") {
    $qs = $q1 . "ORDER BY `qty` DESC";
} else if ($sort == "Plth") {
    $qs = $q1 . "ORDER BY `price` ASC";
} else if ($sort == "Phtl") {
    $qs = $q1 . "ORDER BY `price` DESC";
} else {
    $qs = $q1;
}
$q2 = $qs . " LIMIT  $offeset,12 ";

$resultset = DB::search($q2);
$row = $resultset->num_rows;
?>
<div class="row" id="cardboxid">
    <?php
    for ($i = 0; $i < $row; $i++) {
        $d3 = $resultset->fetch_assoc();
    ?>

        <div class="col-6 col-md-4 col-lg-3 col-xl-3 col-xxl-2 gridsis ">
            <div class="row">
                <div class="card gridsis">

                    <table class="wid100 tabcard">
                        <tr>
                            <td class="textop"><img src="<?php echo $d3["img"]; ?>" class="imgcard" /></td>
                        </tr>

                        <tr>
                            <td class="name2 fw-bold"><?php echo $d3["title"] ?></td>
                        </tr>
                        <!-- <tr>
                            <td class="dec2"><?php echo $d3["description"]; ?></td>
                        </tr> -->
                        <tr>
                            <td class="qty2">Availeble: <?php echo $d3["qty"]; ?></td>
                        </tr>
                        <tr>
                            <?php
                            if ($d3["expire_date"] <= $date) {
                            ?>
                                <td class="price2 text-danger">Expire Date: <?php echo $d3["expire_date"]; ?></td>


                                <?php
                            } else {
                                if ($d3["expire_date"] != "9999-12-20") {
                                ?>
                                    <td class="price2">Expire Date: <?php echo $d3["expire_date"]; ?></td>

                            <?php
                                }
                            }
                            ?>
                        </tr>
                        <tr>
                            <td class="price2">price:&nbsp;Rs <?php echo number_format($d3["price"], 2); ?></td>
                        </tr>
                        <tr>
                            <td class="texbo"><button class="wid100 delbtn2 redbac" onclick="comfirmmovebinview(<?php echo $d3['pid']; ?>);" >Move To Bin</button></td>
                        </tr>
                        <tr>
                            <td class="texbo"><button class="wid100 delbtn2 blubac" data-bs-toggle="modal" data-bs-target="#editvewproduc" onclick="updateProdcutModelview(<?php echo $d3['pid']; ?>);">Edit</button></td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>


    <?php
    }
    ?>
</div>
<div class="div2 mb-3" id="btndiv1C">


    <?php
    $q2;
    if ($row != 0) {
        if ($page != 1) {
    ?>
            <button class="btn1" id="preC" onclick="searchtableveiw(<?php echo $page - 1 ?>);"><i class="icofont-rounded-double-left"></i></button>
        <?php
        } else {
        ?>
            <button class="btn1" id="preC"><i class="icofont-rounded-double-left"></i></button>

            <?php
        }
        // $dbms2 = new mysqli("localhost", "root", "@JaniduChamika2001", "finyzora2", "3306");
        // $q2 = "SELECT * FROM product";
        // if ($serchsel == "All") {
        //     $q2 = "SELECT product.`pid` FROM product INNER JOIN brand  ON product.`brand_id`=brand.`bid` WHERE   product.`delete`='0' AND product.`seller_id`='" . $_SESSION["userdata"]["id"] . "'
        //      AND (product.`model` LIKE '%" . $serch . "%' OR brand.`bname`LIKE '" . $serch . "%') ";
        // } else {
        //     $q2 = "SELECT product.`pid`FROM product INNER JOIN brand  ON product.`brand_id`=brand.`bid` WHERE product.`brand_id`
        //      LIKE '" . $serchsel . "%' AND product.`model` LIKE '%" . $serch . "%'  AND product.`delete`='0' AND product.`seller_id`='" . $_SESSION["userdata"]["id"] . "'";
        // }
        // $resultset2 = $dbms2->query($q2);

        $resultset2 = DB::search($q1);
        $n2 = $resultset2->num_rows;
        $no = $n2 / 12;
        $t = intval($no);
        if ($n2 % 12 != 0) {
            $t = $t + 1;
        }
        for ($c = 1; $c <= $t; $c++) {
            if ($page == $c) {
            ?>
                <button class="btn1 acti" onclick="searchtableveiw(<?php echo $c; ?>) ;"><?php echo $c; ?></button>

            <?php
            } else {
            ?>
                <button class="btn1" onclick="searchtableveiw(<?php echo $c; ?>) ;"><?php echo $c; ?></button>
            <?php
            }
        }
        if ($page != $t) {
            ?>
            <button class="btn1" id="nxC" onclick="searchtableveiw(<?php echo $page + 1 ?>);"><i class="icofont-rounded-double-right"></i></button>
        <?php
        } else {
        ?>
            <button class="btn1" id="nxC"><i class="icofont-rounded-double-right"></i></button>

    <?php
        }
    }
    ?>
</div>