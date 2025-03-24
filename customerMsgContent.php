<?php
require "database.php";
$customer = $_POST["uid"];
$user = DB::search("SELECT * FROM `user` WHERE `id`='" . $customer . "'");
$d = $user->fetch_assoc();
?>

<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Masseage to <?php echo $d["first_name"] . " " . $d["last_name"] ?></h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="clearInt();"><i class="icofont-close"></i></button>
</div>
<div class="modal-body">
      <!-- mmmmm -->
      <div class="col-12 h-100">

            <div class="row h-100">
                  <!-- receiver's message  -->

                  <div class="col-12 msgcontentbox">
                        <div class="row px-3 py-2 bg-white " id="chatrow">
                              <!-- massage load venne methana -->
            <!-- MsgsellerContent.php -->
                             
                        </div>
                  </div>
                  <!-- sender message  -->

                  <div class="col-12  mt-auto mb-0">
                        <div class="row">
                              <div class="input-group" style="height: 38px;">
                                    <input type="text" placeholder="Type a message..." id="msgtxt" aria-describedat="sendbtn" class="form-control  d-flex" style="height: 38px;" />

                                    <div class="input-group-append d-grid sendbtnmasg">
                                          <button id="sendbtn" class="btn bluco text-white fs-4 d-flex " onclick="sendmessageModal(<?php echo $customer  ?>);" style="height: 38px;"><i class="icofont-location-arrow m-auto"></i></button>
                                    </div>
                              </div>
                        </div>
                  </div>

            </div>
      </div>


      <!-- mmmmm -->

</div>
<div class="modal-footer">
      <button type="button" class="btn silbtn" data-bs-dismiss="modal" onclick="clearInt();">Close</button>

</div>