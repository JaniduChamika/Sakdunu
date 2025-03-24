<?php
session_start();
require "database.php";
if (isset($_SESSION["userdata"]["id"])) {
      $from = $_SESSION["userdata"]["id"];
      $to = $_POST["uid"];

      $massages = DB::search("SELECT * FROM `chat` WHERE `from_id`='" . $to . "' OR `to_id`='" . $to . "'");
      $n = $massages->num_rows;
      if ($n >= 1) {
            for ($i = 0; $i < $n; $i++) {
                  $msg = $massages->fetch_assoc();

                  if ($from == $msg["from_id"]) {
?>
                        <!-- sender  -->
                        <div class="col-9 offset-3 my-0 mb-1" style="height: fit-content;">
                              <div class="row text-end justify-content-end ">
                                    <div class="bg-primary rounded  py-2 px-3" style="width: fit-content;">
                                          <p class="text-small mb-0 text-white text-start"><?php echo $msg["msg"] ?></p>
                                    </div>
                              </div>
                              <div class="row text-end">
                                    <span class="small " style="font-size: 10px;"><?php echo $msg["date_time"] ?></span>
                              </div>
                        </div>
                        <!-- sender  -->

                  <?php
                  } else {
                  ?>
                        <!-- reciver  -->
                        <div class="col-9  my-0 mb-1" style="height: fit-content;">

                              <div class="row text-start ">
                                    <div class=" bg-secondary rounded  py-2 px-3" style="width: fit-content;">
                                          <p class="text-small mb-0 text-white"><?php echo $msg["msg"] ?></p>

                                    </div>
                              </div>
                              <div class="row text-start">
                                    <span class="small "style="font-size: 10px;"><?php echo $msg["date_time"] ?></span>
                              </div>
                        </div>
                        <!-- reciver  -->

                  <?php
                  }
                  ?>



            <?php
            }
      } else {
            ?>
            <div class="nomsgbox">

            </div>
      <?php
      }
      ?>




<?php
} else {
      echo "Please Login First";
}
