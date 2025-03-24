<?php
session_start();
require "database.php";
date_default_timezone_set("Asia/Colombo");
$date = date("Y-m-d");
if (isset($_SESSION["userdata"]["id"])) {
      $pid = $_POST["pid"];

      $u = $_SESSION["userdata"]["id"];


      $q = "DELETE FROM wishlist WHERE `product_pid`='" . $pid . "' AND `user_id`='" . $_SESSION["userdata"]["id"] . "'";
      DB::iud($q);
?>


      <?php
      $q = "SELECT * FROM wishlist INNER JOIN product ON wishlist.`product_pid`=product.`pid` INNER JOIN brand ON product.`brand_id`=brand.`bid` WHERE `user_id`='" . $u . "' ";
      $resultset = DB::search($q);
      if ($resultset->num_rows >= 1) {

            for ($i = 0; $i < $resultset->num_rows; $i++) {
                  $d = $resultset->fetch_assoc();
      ?>
                  <div class="col-12 col-md-12 col-lg-6">

                        <div class="row p-2 p-md-3  px-lg-1 px-xl-3">
                              <div class="col-12 wishcard ">
                                    <div class="row  p-2">

                                          <div class="col-5 col-md-4 m-auto p-0 position-relative">
                                                <?php
                                                if ($d["delete"] == "1" || $d["expire_date"] < $date) {
                                                ?>
                                                      <div class="w-100 h-100 position-absolute text-center d-flex align-content-center notavailablediv ">
                                                            <span class="m-auto fs-4 text-white">Not Available</span>
                                                      </div>
                                                <?php
                                                } else if ($d["qty"] == "0") {
                                                ?>
                                                      <div class="w-100 h-100 position-absolute text-center d-flex align-content-center notavailablediv ">
                                                            <span class="m-auto fs-4 text-white">Out of Stock</span>
                                                      </div>
                                                <?php
                                                }

                                                ?>
                                                <a href="productpage.php?pid=<?php echo $d['pid'] ?>" class="text-decoration-none">

                                                      <img src="<?php echo $d['img'] ?>" class="w-100" />
                                                </a>
                                          </div>
                                          <div class="col-7 col-md-8">
                                                <div class="row h-100 ps-1 ps-md-4">
                                                      <h4 class="d-line"><?php echo $d['title'] ?></h4>

                                                      <table class="h-75 w-100 m-auto detailswish">
                                                            <tr>
                                                                  <td class="w-50">
                                                                        price
                                                                  </td>
                                                                  <td>
                                                                        Rs : <?php echo number_format($d['price'], 2)  ?>
                                                                  </td>
                                                            </tr>
                                                            <tr>
                                                                  <td>
                                                                        In Stock
                                                                  </td>
                                                                  <td>
                                                                        <?php echo $d['qty'] ?>
                                                                  </td>
                                                            </tr>
                                                            <tr>

                                                                  <?php
                                                                  if ($d["expire_date"] < $date) {
                                                                  ?>
                                                                        <td class="text-danger" colspan="2">
                                                                              Expired
                                                                        </td>
                                                                  <?php
                                                                  } else if ($d["expire_date"] != "9999-12-20") {
                                                                  ?>
                                                                        <td>
                                                                              Expirdate
                                                                        </td>
                                                                        <td>
                                                                              <?php echo $d['expire_date'] ?>
                                                                        </td>
                                                                  <?php
                                                                  } else {
                                                                  ?>
                                                                        <td>

                                                                        </td>
                                                                        <td>

                                                                        </td>
                                                                  <?php
                                                                  }
                                                                  ?>
                                                            </tr>
                                                            <tr>
                                                                  <td class="p-md-2">
                                                                        <?php
                                                                        if ($d["delete"] == "1" || $d["qty"] == "0") {
                                                                        ?>
                                                                              <button class="btn bluco w-100 addcart" disabled><i class="icofont-cart"></i> </button>

                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                              <button class="btn bluco w-100 addcart" onclick="addCartCom(<?php echo $d['pid'] ?>)"><i class="icofont-cart"></i> </button>

                                                                        <?php
                                                                        }
                                                                        ?>
                                                                  </td>
                                                                  <td class="p-md-2">
                                                                        <button class="btn redco w-100 removebtn" onclick="wishremove(<?php echo $d['pid'] ?>);"><i class="icofont-bin"></i> </button>

                                                                  </td>
                                                            </tr>
                                                      </table>


                                                </div>



                                          </div>
                                    </div>
                              </div>

                        </div>
                  </div>
            <?php
            }
      } else {
            ?>
            <div class="col-12">
                  <div class="row heigt480">
                        <div class="col-12 m-auto text-center  p-5 ">
                              <span class="m-auto fs-5">There are no items in Wishlist </span>
                              <br />
                              <a href="index.php" class="btn silever mt-3 fs-6 px-4">Continue Shopping</a>
                        </div>
                  </div>
            </div>

<?php
      }
} else {
      echo "Please Login";
}
