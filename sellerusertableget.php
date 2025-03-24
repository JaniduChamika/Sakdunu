<?php
session_start();
require "database.php";
$seller = $_SESSION["userdata"]["id"];
$userseacrh = $_POST["user"];
$query1 = "";
if (!empty($userseacrh)) {
      $query1 = "AND (`first_name` LIKE '" . $userseacrh . "%' OR `email` LIKE '" . $userseacrh . "%' OR `mobile` LIKE '" . $userseacrh . "%')";
}
?>


<div class="col-12 col-md-11 textalin tblboxpro mt-3 p-0 p-md-5 pt-md-0 pb-md-0 scroll3" onmouseover="doo(3);" style="min-height: 540px;">

      <table class="wid100 tablpro whico" id="veiwtable">

            <tr>
                  <th class="th1">#</th>
                  <th class="th2">Email</th>
                  <th class="th3">Name</th>
                  <th class="th4">Mobile</th>
                  <th class="th5 d-none d-lg-table-cell">Register Date</th>
                  <th class="th6"></th>


            </tr>
            <?php

            $usersrs = DB::search("SELECT * FROM `user`WHERE `user_tid` ='1' " . $query1 . " ");
            $row = $usersrs->num_rows;
            $result_per_page = 10;
            $number_of_page = ceil($row / $result_per_page);
            $pageno;
            if (!isset($_POST["page"])) {
                  $pageno = 1;
            } else {
                  $pageno = $_POST["page"];
            }
            $page_first_result = ($pageno - 1) * $result_per_page;

            $selectedrs = DB::search("SELECT * FROM `user` WHERE `user_tid` ='1' " . $query1 . " LIMIT " . $result_per_page . " OFFSET " . $page_first_result . "");
            $start = (($pageno - 1) * $result_per_page) + 1;
            for ($i = 0; $i < $selectedrs->num_rows; $i++) {
                  $srow = $selectedrs->fetch_assoc();
            ?>
                  <tr>
                        <td class="td position-relative" onclick="massageUserModal(<?php echo $srow['id']; ?>);" data-bs-toggle="modal" data-bs-target="#msgmoda"><?php echo $start ?>
                              <?php
                              $hmsg = DB::search("SELECT * FROM `chat` WHERE `seen_status`='1' AND `to_id`='" . $seller . "' AND `from_id`='" . $srow["id"] . "'");
                              if ($hmsg->num_rows != 0) {
                              ?>
                                    <span class="position-absolute  translate-middle p-1 bg-danger rounded-circle" style="top: 30%; left: 70%;" id="sellerbadge<?php echo $srow["id"]  ?>">
                                    </span>
                              <?php
                              }
                              ?>
                        </td>

                        <td class="td" onclick="massageUserModal(<?php echo $srow['id']; ?>);" data-bs-toggle="modal" data-bs-target="#msgmoda"><?php echo $srow["email"]; ?></td>
                        <td class="td" onclick="massageUserModal(<?php echo $srow['id']; ?>);" data-bs-toggle="modal" data-bs-target="#msgmoda"><?php echo $srow["first_name"] . " " . $srow["last_name"]; ?></td>
                        <td class="td" onclick="massageUserModal(<?php echo $srow['id']; ?>);" data-bs-toggle="modal" data-bs-target="#msgmoda"><?php echo $srow["mobile"]; ?></td>

                        <td class="td d-none d-lg-table-cell" onclick="massageUserModal(<?php echo $srow['id']; ?>);" data-bs-toggle="modal" data-bs-target="#msgmoda"><?php
                                                                                                                                                                        $rd = $srow["register_time"];
                                                                                                                                                                        $splitrd = explode(" ", $rd);
                                                                                                                                                                        echo $splitrd[0];
                                                                                                                                                                        ?></td>
                        <td class="td detd">
                              <?php
                              if ($srow["status_id"] == "1") {
                              ?>
                                    <button onclick="BlockUserModal(<?php echo $srow['id']; ?>,2,<?php echo $pageno ?>);" class="dbtnproduct px-3 py-1"><i class="icofont-ui-lock"></i> </button>


                              <?php
                              } else {
                              ?>
                                    <button onclick="BlockUserModal(<?php echo $srow['id']; ?>,1,<?php echo $pageno ?>);" class="dbtnproduct greenbtn px-3 py-1"><i class="icofont-ui-unlock"></i></button>

                              <?php
                              }
                              ?>
                        </td>

                  </tr>
            <?php
                  $start++;
            }
            ?>
      </table>
</div>
<div class="div1" id="btndiv1">
      <?php
      if ($pageno != 1) {
      ?>
            <button class="btn1" id="pre" onclick="searchusertable(<?php echo $pageno - 1 ?>);"><i class="icofont-rounded-double-left"></i></button>
      <?php
      } else {
      ?>
            <button class="btn1" id="pre"><i class="icofont-rounded-double-left"></i></button>

            <?php
      }

      for ($c = 1; $c <= $number_of_page; $c++) {

            if ($pageno == $c) {
            ?>
                  <button class="btn1 acti" onclick="searchusertable(<?php echo $c; ?>) ;"><?php echo $c; ?></button>

            <?php
            } else {
            ?>
                  <button class="btn1" onclick="searchusertable(<?php echo $c; ?>) ;"><?php echo $c; ?></button>
            <?php
            }
      }
      if ($pageno != $number_of_page && $number_of_page != 0) {
            ?>
            <button class="btn1" id="nx" onclick="searchusertable(<?php echo $pageno + 1 ?>);"><i class="icofont-rounded-double-right"></i></button>
      <?php
      } else {
      ?>
            <button class="btn1" id="nx"><i class="icofont-rounded-double-right"></i></button>

      <?php
      }
      ?>

</div>