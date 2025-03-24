<?php
session_start();
require "database.php";

if (isset($_SESSION["name"]) && isset($_SESSION["email"])) {
?>

    <script src="script.js"></script>
    <script>
        gohome();
    </script>
<?php
} else {
?>


    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sign Up</title>
      <link rel="icon" href="cssfile//baclogoimg//logo2.png"/>

        <link rel="stylesheet" href="cssfile//bootstrap.css" />
        <link rel="stylesheet" href="cssfile//upstyle.css" />
    </head>

    <body>
        <div class="container-fluid vh-100">
            <div class="row h-100">
                <div class="bodybac"></div>

                <div class="col-12 bac2 box m-auto">
                    <div class="row">
                        <div class="col-12 col-lg-6 logo"></div>
                        <div class="col-12 col-lg-6 bac">
                            <div class="row ta">
                                <div class="card">
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                            <h1 class="fon">Sign Up</h1>

                                            <div id="erro1" class="erro"></div>

                                            <table class="maLR wid">
                                                <tr class="tabl">
                                                    <td class="tabl wid50 texL pdR10">First Name</td>
                                                    <td class="wid50 texL pdL10">Last Name</td>
                                                </tr>
                                                <tr>
                                                    <td class="tabl wid50 pdR10"><input type="text" class="wid100 inF" placeholder="First" id="fn" /></td>
                                                    <td class="tabl wid50 pdL10"><input type="text" class="wid100 inF" placeholder="Last" id="ln" /></td>
                                                </tr>
                                                <tr class="wid100">
                                                    <td class="tabl wid50 texL pdR10">Mobile Number</td>
                                                    <td class="tabl wid50 texL pdL10">Gender</td>
                                                </tr>
                                                <tr>
                                                    <td class="tabl wid50 pdR10"><input type="text" class="wid100 inF" placeholder="ex:-(abc@example.com)" id="mobile" /></td>
                                                    <td class="tabl wid50 pdL10 text-start text-light">
                                                        <select class="wid100 inF " id="genID">
                                                            <option class="text-dark" value="1">Male</option>
                                                            <option class="text-dark" value="2">Female</option>

                                                        </select>
                                                    </td>
                                                </tr>

                                                <tr class="wid100">
                                                    <td colspan="2" class="tabl wid100 texL">Email Address</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" class="tabl wid100"><input type="text" class="wid100 inF" placeholder="ex:-(abc@example.com)" id="email" /></td>
                                                </tr>


                                                <tr>
                                                    <td class="tabl wid50 texL pdR10">Password</td>
                                                    <td class="tabl wid50 texL pdL10">Comfirm Password</td>

                                                </tr>
                                                <tr>
                                                    <td class="tabl wid50 pdR10"><input type="password" class="wid100 inF" placeholder="Password" id="pw" /></td>
                                                    <td class="tabl wid50 pdL10"><input type="password" class="wid100 inF" placeholder="Comfirm Password" id="cpw" /></td>

                                                </tr>

                                                <tr>
                                                    <td colspan="2" class="tabl wid100"><button class="sinbtn" onclick="upbtn();">Create Account</button></td>
                                                </tr>


                                            </table>
                                        </div>
                                        <p class="text-light mt-2">Already have account? <a href="login.php" class="hov"> Sign In </a></p>


                                    </div>


                                </div>

                            </div>


                        </div>

                    </div>
                </div>


            </div>

        </div>








        <script src="bootstrap.js"></script>

        <script src="script.js"></script>

    </body>

    </html>
<?php

}
?>