<?php
require "database.php";
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