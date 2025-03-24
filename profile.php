<?php
session_start();

require "database.php";
require "head.php";

if (isset($_SESSION["userdata"]["id"])) {


?>
      <!DOCTYPE html>
      <html>

      <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Profile</title>
            <link rel="icon" href="cssfile//baclogoimg//logo2.png" />

            <link rel="stylesheet" href="cssfile//bootstrap.css" />
            <link rel="stylesheet" href="cssfile//icofont.min.css" />
            <link rel="stylesheet" href="cssfile//head.css" />
            <link rel="stylesheet" href="cssfile//profile.css" />

      </head>

      <body>
            <div class="container-fluid vh-100">
                  <?php
                  HD::headview("profile");

                  ?>
                  <div class="row">

                        <?php

                        $q = "SELECT *
                        FROM user
                        INNER JOIN gender ON user.`g_id`=gender.`gid`
                        LEFT JOIN user_address ON user.`id`=user_address.`user_id`
                        LEFT JOIN district ON user_address.`district_id`=district.`district_id` LEFT JOIN province ON province.`province_id`=district.`province_id` 
                        LEFT JOIN profile_img ON user.`id`=profile_img.`user_id` WHERE `id`='" . $_SESSION["userdata"]["id"] . "'";


                        $resultset = DB::search($q);
                        $d;

                        if ($resultset->num_rows == 1) {
                              $d = $resultset->fetch_assoc();

                        ?>
                              <div class="col-xl-3 border-end mt-5">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                          <h4>Profile Settings</h4>
                                    </div>
                                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">



                                          <?php

                                          $imghave = DB::search("SELECT * FROM `profile_img` WHERE `user_id`='" . $_SESSION["userdata"]["id"]  . "'");
                                          if ($imghave->num_rows == 1) {
                                                $imgrow = $imghave->fetch_assoc();

                                          ?>
                                                <img class="rounded mt-5" width="150px" src="<?php echo $imgrow["path"]  ?>" id="prev" />

                                          <?php
                                          } else {
                                          ?>
                                                <img class="rounded mt-5" width="150px" src="cssfile//appimg//user.jpg" id="prev" />


                                          <?php
                                          }
                                          ?>
                                          <span class="font-weight-bold"><?php echo $d['first_name'] . " " . $d['last_name'] ?></span>
                                          <span class="text-black-50"><?php echo  $d['email'] ?></span>
                                          <input type="file" id="profileimg" class="d-none" id="profileimg" accept="img/*" />
                                          <label class="btn editbtn mt-3" for="profileimg" onclick="changeProImg();">Update Profile Image</label>
                                    </div>
                              </div>
                              <div class=" col-xl-5 border-end mt-xl-5">
                                    <div class="p-3 py-xl-5">
                                          <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h4>Personal Info</h4>
                                          </div>
                                          <div class="row mt-2">
                                                <div class="col-md-6">
                                                      <label class="form-label">Name</label>
                                                      <input type="text" id="fname" class="form-control" placeholder="first name" value="<?php echo $d['first_name'] ?>" />
                                                </div>
                                                <div class="col-md-6">
                                                      <label class="form-label">Surname</label>
                                                      <input type="text" id="lname" class="form-control" placeholder="last name" value="<?php echo $d['last_name'] ?>" />
                                                </div>
                                          </div>
                                          <div class="row mt-3">
                                                <div class="col-md-12 mb-3">
                                                      <label class="form-label">Mobile Number</label>
                                                      <input type="text" id="mobile" class="form-control" placeholder="Enter Phone number" value="<?php echo $d['mobile'] ?>" />
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                      <label class="form-label">Passwords</label>
                                                      <input type="text" class="form-control" placeholder="Enter password" value="<?php echo $d['password'] ?>" readonly />
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                      <label class="form-label">Email Address</label>
                                                      <input type="email" id="email" class="form-control" placeholder="Enter email id" value="<?php echo $d['email'] ?>" readonly />
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                      <label class="form-label">Gender</label>
                                                      <input type="email" id="email" class="form-control" placeholder="Enter email id" value="<?php echo $d['gname'] ?>" readonly />
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                      <label class="form-label">Register Date & Time</label>
                                                      <input type="rext" class="form-control" placeholder="register date" value="<?php echo $d["register_time"] ?>" readonly />
                                                </div>



                                          </div>




                                    </div>
                              </div>
                              <div class="col-xl-4 border-end mt-xl-5">

                                    <div class="p-3 py-xl-5">
                                          <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h4>Address Info</h4>
                                          </div>

                                          <div class="row mt-3">

                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label">Address No</label>
                                                      <input type="text" id="streetno" class="form-control" placeholder="Enter address no" value="<?php echo $d['address_no'] ?>" />
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label">Address Line 01</label>
                                                      <input type="text" id="streetline1" class="form-control" placeholder="Enter address Line 1" value="<?php echo $d['address_line1'] ?>" />
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label">Address Line 02 (city)</label>
                                                      <input type="text" id="streetline2" class="form-control" placeholder="Enter address Line 2" value="<?php echo $d["address_line2"] ?>" />
                                                </div>
                                                <div class="col-md-6 mb-3">


                                                      <label class="form-label">Distict</label>
                                                      <select class=" form-select" id="distict">
                                                            <option value="none"> Select District</option>

                                                            <?php
                                                            $q = "SELECT * FROM district";
                                                            $Rcity = DB::search($q);
                                                            $r = $Rcity->num_rows;
                                                            for ($i = 0; $i < $r; $i++) {
                                                                  $Dcity = $Rcity->fetch_assoc();
                                                                  if ($Dcity["district_id"] == $d["district_id"]) {
                                                            ?>
                                                                        <option value="<?php echo $Dcity["district_id"] ?>" selected><?php echo $Dcity["cname"] ?></option>

                                                                  <?php
                                                                  } else {
                                                                  ?>
                                                                        <option value="<?php echo $Dcity["district_id"] ?>"><?php echo $Dcity["cname"] ?></option>

                                                            <?php
                                                                  }
                                                            }
                                                            ?>

                                                      </select>

                                                </div>
                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label">Province</label>
                                                      <input type="text" class="form-control" placeholder="Auto Set Province" value="<?php echo $d["provincename"] ?>" readonly />
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                      <label class="form-label">Postal Code</label>
                                                      <input type="text" id="postalcode" class="form-control" placeholder="Enter Postal Code" value="<?php echo $d["postalcode"] ?>" />
                                                </div>
                                          </div>




                                    </div>

                              </div>
                              <div class="col-12 mt-5 text-center mb-5">
                                    <button class="btn editbtn py-2 px-4" onclick="updateProfile();">Update Profile</button>
                              </div>
                        <?php
                        }
                        ?>
                        <div aria-live="polite" aria-atomic="true" class="position-relative bottom-0 end-0" style="z-index: 2000;">

                              <div class="toast-container position-fixed bottom-0 end-0 p-3" id="boxnoteID">



                              </div>
                        </div>
                  </div>
            </div>



            </div>
            <script src="bootstrap.min.js"></script>
            <script src="commen.js"></script>
            <script src="profile.js"></script>


      </body>

      </html>
<?php
} else {
?>
      <script src="commen.js"></script>
      <script>
            login();
      </script>

<?php
}
?>