<?php
session_start();
require "database.php";


$page = $_POST["p"];
$offeset = 12 * ($page - 1);
$serch = $_POST["s"];
$cater = $_POST["cate"];
$serchsel = $_POST["bid"];
$sort = $_POST["sort"];
date_default_timezone_set("Asia/Colombo");

$date = date("Y-m-d");

// if (empty($serch)) {
//     if ($serchsel == "All") {
//         $q = "SELECT product.`pid`, brand.`bname`,product.`model`,product.`qty`,product.`price` FROM product INNER JOIN brand ON product.`brand_id`=brand.`bid` WHERE product.`delete`='0' LIMIT  $bt,12 ;";
//     } else {
//         $q = "SELECT product.`pid`, brand.`name`,product.`model`,product.`qty`,product.`price` FROM product INNER JOIN brand  ON product.`brand_id`=brand.`bid` WHERE product.`brand_id`LIKE '" . $serchsel . "%' AND product.`delete`='0' LIMIT  $bt,12 ;";
//     }
// } else {
$q = "SELECT  product.`pid`, brand.`bname`,product.`model`,product.`title`,product.`qty`,product.`price`,product.`expire_date` FROM product
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
<div class="col-12 col-md-11 textalin tblboxpro mt-3 p-0 p-md-5 pt-md-0  scroll3" style="min-height: 540px;" onmouseover="doo(3);">

    <table class="wid100 tablpro whico" id="veiwtable">

        <tr>
            <th class="th1">#</th>
            <th class="th2">Brand</th>
            <th class="th3">Title</th>
            <th class="th4">Quantity</th>
            <th class="th5">Praice (Rs)</th>
            <th class="th6">Delete</th>


        </tr>
        <?php

        for ($i = 0; $i < $row; $i++) {
            $d = $resultset->fetch_assoc();
            if ($d["expire_date"] <= $date) {
        ?>
                <tr class="redfon" onclick="updateProdcutModel(<?php echo $d['pid']; ?>);" data-bs-toggle="modal" data-bs-target="#exampleModal">

                <?php
            } else {
                ?>
                <tr >

                <?php
            }
                ?>



                <td onclick="updateProdcutModel(<?php echo $d['pid']; ?>);" class="td" data-bs-toggle="modal" data-bs-target="#exampleModal"><?php echo (($page - 1) * 12) + ($i + 1) ?></td>
                <td onclick="updateProdcutModel(<?php echo $d['pid']; ?>);" class="td" data-bs-toggle="modal" data-bs-target="#exampleModal"><?php echo $d["bname"]; ?></td>
                <td onclick="updateProdcutModel(<?php echo $d['pid']; ?>);" class="td" data-bs-toggle="modal" data-bs-target="#exampleModal"><?php echo $d["title"]; ?></td>

                <td onclick="updateProdcutModel(<?php echo $d['pid']; ?>);" class="td" data-bs-toggle="modal" data-bs-target="#exampleModal"><?php echo $d["qty"]; ?></td>
                <td onclick="updateProdcutModel(<?php echo $d['pid']; ?>);" class="td" data-bs-toggle="modal" data-bs-target="#exampleModal"><?php echo number_format($d["price"], 2); ?></td>
                <td class="td detd"><button onclick="comfirmmovebin(<?php echo $d['pid']; ?>);" class="dbtnproduct" ><i class="icofont-bin"></i></button></td>

                </tr>
            <?php
        }
            ?>
    </table>
</div>
<div class="div1" id="btndiv1">
    <?php
    if ($row != 0) {
        if ($page != 1) {
    ?>
            <button class="btn1" id="pre" onclick="searchtable(<?php echo $page - 1 ?>);"><i class="icofont-rounded-double-left"></i></button>
        <?php
        } else {
        ?>
            <button class="btn1" id="pre"><i class="icofont-rounded-double-left"></i></button>

            <?php
        }
        // $dbms2 = new mysqli("localhost", "root", "@JaniduChamika2001", "finyzora2", "3306");
        // $q2 = "SELECT * FROM product";
        // $q2;
        // if ($serchsel == "All") {
        //     $q2 = "SELECT  product.`pid` FROM product 
        //     INNER JOIN brand  ON product.`brand_id`=brand.`bid` WHERE   product.`delete`='0' AND (product.`model`
        //      LIKE '%" . $serch . "%' OR brand.`bname`LIKE '" . $serch . "%') ";
        // } else {
        //     $q2 = "SELECT product.`pid` 
        //     FROM product INNER JOIN brand  ON product.`brand_id`=brand.`bid` WHERE (product.`brand_id`
        //     LIKE '" . $serchsel . "%' AND product.`model` LIKE '%" . $serch . "%') AND product.`delete`='0'";
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
                <button class="btn1 acti" onclick="searchtable(<?php echo $c; ?>) ;"><?php echo $c; ?></button>

            <?php
            } else {
            ?>
                <button class="btn1" onclick="searchtable(<?php echo $c; ?>) ;"><?php echo $c; ?></button>
            <?php
            }
        }
        if ($page != $t && $n2 != 0) {
            ?>
            <button class="btn1" id="nx" onclick="searchtable(<?php echo $page + 1 ?>);"><i class="icofont-rounded-double-right"></i></button>
        <?php
        } else {
        ?>
            <button class="btn1" id="nx"><i class="icofont-rounded-double-right"></i></button>

    <?php

        }
    }
    ?>
</div>