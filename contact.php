<?php
session_start();

require "database.php";
require "head.php";
require "footer.php";
?>
<!DOCTYPE html>
<html>

<head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Contact Us</title>
      <link rel="icon" href="cssfile//baclogoimg//logo2.png" />
      <link rel="stylesheet" href="cssfile//icofont.min.css" />

      <link rel="stylesheet" href="cssfile//bootstrap.css" />
      <link rel="stylesheet" href="cssfile//head.css" />
      <link rel="stylesheet" href="cssfile//contactUs.css" />
      <link rel="stylesheet" href="cssfile//customer.css" />

      <link rel="stylesheet" href="cssfile//foot.css" />




</head>

<body>
      <div class="container-fluid">
            <?php
            HD::headview("contactUs");
            ?>

            <div class="row mattop heigt480">

                  <div class="col-12 col-md-11 me-auto ms-auto col-lg-6 ">
                        <div class="row p-2 p-md-5 pt-md-2 pb-md-2 p-lg-2 p-xl-4 h-100">
                              <div class="col-12 contactBox ">
                                    <div class="row  gy-2 p-3 p-md-4 ">
                                          <div class="col-12">
                                                <h3> Send Massage</h3>

                                          </div>
                                          <div class="col-12">
                                                <!-- <label for="exampleFormControlInput1" class="form-label">Write Us about Your inconvenience.we are sorry about that</label>
                                                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com"> -->

                                          </div>
                                          <div class="col-12">
                                                <label for="subjectID" class="form-label">Subject</label>
                                                <input type="text" class="form-control" id="subjectID" placeholder="Subject" onkeyup="sendMail();">

                                          </div>
                                          <div class="col-12">
                                                <label for="bodyID" class="form-label ">Massage</label>
                                                <textarea class="form-control msginp" id="bodyID" placeholder="Write here your massage" rows="3" onkeyup="sendMail();"></textarea>

                                          </div>
                                          <div class="col-12 text-end">
                                                <a class="btn sendbtn mt-3 pe-4 ps-4" id="sendmail" href="#">Send</a>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>
                  <div class="col-12 col-md-11  me-auto ms-auto col-lg-6  ">
                        <div class="row p-2 p-md-5 pt-md-2 pb-md-2 p-lg-2 p-xl-4 h-100">
                              <div class="col-12 contactBox">
                                    <div class="row p-3 p-md-4 ">
                                          <div class="col-12">
                                                <h3>Contact Info</h3>

                                          </div>
                                          <div class="col-12 col-xl-6 ps-4 pb-2">
                                                <span class="fon1"> <i class="icofont-ui-call"></i> Call Us</span>
                                                <br />

                                                <span class="fon2">0782392745</span>

                                                <br />
                                                <span class="fon1"> <i class="icofont-whatsapp"></i> Massage Us</span>
                                                <br />

                                                <span class="fon2">0782392745</span>

                                                <br />
                                                <span class="fon1"> <i class="icofont-ui-email"></i> Our Email</span>
                                                <br />

                                                <span class="fon2">sakdunusuper@gmail.com</span>
                                                <br />
                                                <span class="fon1"> <i class="icofont-google-map"></i> Our Address</span>
                                                <br />

                                                <span class="fon2"> 217/c, Temple Rd, Kadawatha</span>
                                                <br />
                                                <h3 class="pt-4">Fallow Us</h3>

                                                <span class="social">
                                                      <i class="icofont-facebook"></i>
                                                      &nbsp;
                                                </span>
                                                <span class="social">
                                                      <i class="icofont-instagram"></i>
                                                </span>
                                          </div>



                                    </div>
                              </div>
                        </div>
                  </div>
                  <div class="col-12 col-md-10 col-lg-11 col-xl-10 m-auto mt-3">
                        <div class="mapouter">
                              <div class="gmap_canvas"><iframe width="100%" height="100%" id="gmap_canvas" src="https://maps.google.com/maps?q=217,temple%20road,ganemulla&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.embedgooglemap.net/blog/divi-discount-code-elegant-themes-coupon/">divi discount</a><br>
                                    <!-- <a href="https://www.embedgooglemap.net">embedgooglemap.net</a> -->

                              </div>
                        </div>
                  </div>
                  <button class="toChatPage" onclick="openChatModal()">

                        <i class="icofont-ui-messaging"></i>


                  </button>
                  <div class="modal fade p-0" id="msgmodal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-lg modal-fullscreen-md-down">
                              <div class="modal-content" id="usermsgContentModal">


                                    <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Masseage to Seller</h5>
                                          <button type="button" class="btn fs-2" data-bs-dismiss="modal" aria-label="Close"><i class="icofont-close"></i></button>
                                    </div>
                                    <div class="modal-body">
                                          <!-- mmmmm -->
                                          <?php
                                          if (isset($_SESSION["userdata"]["id"])) {
                                                $customer = $_SESSION["userdata"]["id"];

                                                $user = DB::search("SELECT * FROM `user` WHERE `id`='" . $customer . "'");
                                                $d = $user->fetch_assoc();
                                          ?>
                                                <div class="col-12 h-100">

                                                      <div class="row h-100">

                                                            <!-- receiver's message  -->

                                                            <div class="col-12 msgcontentbox">
                                                                  <div class="row px-3 py-2 bg-white " id="chatrow">
                                                                        <!-- massage load venne methana -->
                                                                        <!-- massageveiw.php  -->
                                                                  </div>
                                                            </div>


                                                            <div class="col-12  mt-auto mb-0">
                                                                  <div class="row">
                                                                        <div class="input-group" style="height: 38px;">
                                                                              <input type="text" placeholder="Type a message..." id="msgtxt" aria-describedat="sendbtn" class="form-control  d-flex" style="height: 38px;" />

                                                                              <div class="input-group-append d-grid sendbtnmasg">
                                                                                    <button id="sendbtn" class="btn bluco text-white fs-4 d-flex " onclick="sendMassagetoSeller();" style="height: 38px;"><i class="icofont-location-arrow m-auto"></i></button>
                                                                              </div>
                                                                        </div>
                                                                  </div>
                                                            </div>

                                                      </div>
                                                </div>
                                          <?php
                                          } else {
                                          ?>
                                                <div class="text-center ">
                                                      <span class="m-auto">Plase Login First, to chat with Seller</span>

                                                </div>
                                          <?php
                                          }

                                          ?>

                                          <!-- mmmmm -->

                                    </div>
                                    <div class="modal-footer">
                                          <button type="button" class="btn silbtn" data-bs-dismiss="modal">Close</button>

                                    </div>

                              </div>
                        </div>
                  </div>
            </div>
            <?php
            FOOT::footview("normal");
            ?>
      </div>
      <script src="bootstrap.min.js"></script>
      <script src="customer.js"></script>
      <script src="navhider.js"></script>
      <script src="commen.js"></script>

</body>

</html>