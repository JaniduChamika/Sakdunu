<?php
session_start();

if (isset($_SESSION["userdata"])) {
?>

    <script src="script.js"></script>
    <script>
        gohome();
    </script>
<?php
} else {
    $email = "";
    $password = "";
    if (isset($_COOKIE["em"])) {
        $email = $_COOKIE["em"];
    }
    if (isset($_COOKIE["pw"])) {
        $password = $_COOKIE["pw"];
    }
    $nowin = "";
    if (isset($_GET["nowin"])) {
        $nowin = $_GET["nowin"];
    }
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sign In</title>
        <link rel="icon" href="cssfile//baclogoimg//logo2.png" />

        <link rel="stylesheet" href="cssfile//icofont.min.css" />
        <link rel="stylesheet" href="cssfile//bootstrap.css" />
        <link rel="stylesheet" href="cssfile//login.css" />
    </head>

    <body>

        <div class="container-fluid vh-100">
            <div class="row h-100">
                <div class="bodyimg"></div>
                <div class="box1 m-auto">
                    <div class="row">
                        <div class="logo"></div>
                        <div class="box2">
                            <div class="row">
                                <div class="boxcard">
                                    <div class="row ta">
                                        <div class="load" id="load"></div>
                                        <h1 class="font h fonwhite">Sign In</h1>

                                        <input class="i" type="text" id="email" value="<?php echo $email ?>" placeholder="Email Address" />
                                        <div class="errobox">
                                            <p class="fonwhite erro" id="error1"></p>
                                        </div>
                                        <input type="password" class="i" id="pw" placeholder="Password" value="<?php echo $password ?>" />
                                        <div class="errobox">
                                            <p class="fonwhite erro" id="error2"></p>
                                        </div>
                                        <div class="checkbox">
                                            <?php
                                            if (isset($_COOKIE["em"])) {
                                            ?>
                                                <input type="checkbox" class="form-check-input che" id="che" checked="" />&nbsp;<label for="che" class="font">Remember Me</label>
                                            <?php
                                            } else {
                                            ?>
                                                <input type="checkbox" class="form-check-input che" id="che" />&nbsp;<label for="che" class="font">Remember Me</label>
                                            <?php
                                            }
                                            ?>
                                        </div>

                                        <!-- <button class="b fonwhite font" onclick="signinbt('<?php echo  $nowin ?>');">Sign In</button> -->
                                        <button class="b3 fonwhite font" onclick="signinbt('<?php echo  $nowin ?>');">Sign In</button>
                                        <a href="#" class="foggot font fonwhite mt-2" onclick="forgotPassword();">Forgotten password? </a>
                                        <hr class="hrwid" />
                                        <a href="signup.php" style="text-decoration: none;"><button class="b2 fonwhite font">Create New Account</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" tabindex="-1" id="resetModelID" data-bs-backdrop="static" data-bs-keyboard="false" >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Reset Password</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row pb-1">
                                            <span>New Password</span>

                                            <div class="input-group mt-1">
                                                <input type="password" class="form-control" aria-describedby="basic-addon2" id="resetpwsID">
                                                <button class="btn outbtn" id="newpwsbtnID" onclick="changetype();"><i class="icofont-eye"></i></button>
                                            </div>
                                            <span id="erroresetpw" class="resetErro"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <span>Re-type Password</span>

                                            <div class="input-group mb-3 mt-1">

                                                <input type="password" class="form-control" aria-describedby="basic-addon2" id="resetpwsRetypeID">
                                                <button class="btn outbtn" id="newpwsbtnID2" onclick="changetype2();"><i class="icofont-eye"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row pb-1">
                                            <span>Varification Code</span>

                                            <div class="input-group mt-1">
                                                <input type="text" class="form-control" aria-describedby="basic-addon2" id="vcodeID">

                                            </div>
                                            <span id="erroresetvc" class="resetErro"></span>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn silever" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn bluco" onclick="resetPassword();">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" tabindex="-1" id="sellerLoginCode" data-bs-backdrop="static" data-bs-keyboard="false" >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Admin Login</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">

                                    <div class="col-12">
                                        <div class="row pb-1">
                                            <span>Varification Code</span>

                                            <div class="input-group mt-1">
                                                <input type="text" class="form-control" aria-describedby="basic-addon2" id="sellerVCode">

                                            </div>
                                            <span id="errosellrVC" class="resetErro"></span>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn silever" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn bluco" onclick="signinbt('<?php echo  $nowin ?>');">Sign in</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div aria-live="polite" aria-atomic="true" class="position-relative bottom-0 end-0" style="z-index: 2000;">
            <div class="toast-container position-fixed top-0 end-0 pt-2" id="boxnoteID">



            </div>
        </div>

        <script src="bootstrap.min.js"></script>
        <script src="script.js"></script>

    </body>

    </html>

<?php
}
?>