<?php
session_start();
require "database.php";

use PHPMailer\PHPMailer\PHPMailer;


require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';
$email = $_POST["email"];
$password = $_POST["pw"];

$rem = $_POST["r"];
if (empty($email)) {
    echo "*Enter Your Email Address";
} else if (empty($password)) {
    echo "Enter Your Password";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "*Invalid Email Address";
} else {

    $q;


    $q = "SELECT * FROM user INNER JOIN user_type ON user.`user_tid`=user_type.`t_id` WHERE `email`='" . $email . "';";


    $resultset = DB::search($q);
    $row = $resultset->num_rows;
    if ($row == 1) {
        $d = $resultset->fetch_assoc();
        if ($password == $d["password"]) {
            if ($d["type_name"] != "seller") {
                if ($d["status_id"] != 2) {
                    $_SESSION["type"] = $d["type_name"];
                    $_SESSION["name"] = $d["first_name"];
                    // $_SESSION["email"] = $email;
                    $_SESSION["userdata"]["id"] = $d["id"];
                    $_SESSION["userdata"] = $d;
                    $t = time() + (60 * 60 * 24 * 10);
                    if ($rem == "true") {
                        setcookie("em", $email, $t);
                        setcookie("pw", $password, $t);
                    } else {
                        setcookie("em", "", -1);
                        setcookie("pw", "", -1);
                    }

                    echo "Sucess";
                } else {
                    echo "Your Account was suspened";
                }
            } else {
                if (empty($_POST["selvc"])) {


                    $uni = uniqid();

                    $vc = substr($uni, -6);


                    $q = "UPDATE user SET `verification_code`='" . $vc . "' WHERE `email`='" . $email . "'";
                    DB::iud($q);
                    $mail = new PHPMailer;
                    $mail->IsSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'janprabashwara@gmail.com';
                    $mail->Password = 'oqtp isbh xspl tpf';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;
                    $mail->setFrom('janprabashwara@gmail.com', 'Janidu');
                    $mail->addReplyTo('janprabashwara@gmail.com', 'Janidu');
                    $mail->addAddress($email);
                    $mail->isHTML(true);
                    $mail->Subject = 'Verification Code';
                    $bodyContent = 'Verification Code';
                    $bodyContent = '<h3 style="text-align: center;">Sakdunu Super admin login</h3>
                     <div style="width: 100%;text-align: center;">
                     <span style="font-size: 19px">Varification code</span>
                     <br/>
                     <br/>
                     <span style="font-size: 17px">' . $vc . '</span>
                     </div>';

                    $mail->Body    = $bodyContent;

                    if (!$mail->send()) {
                        echo 'Verification could not be sent';
                    } else {
                        echo "seller vc";
                    }
                } else {
                    $adminVC = $_POST["selvc"];
                    $q = "SELECT * FROM user WHERE `email`='" . $email . "' AND `verification_code`='" . $adminVC . "'";
                    $resultset = DB::search($q);
                    if ($resultset->num_rows != 1) {
                        echo "Wrong varification code";
                    } else {
                        $_SESSION["type"] = $d["type_name"];
                        $_SESSION["name"] = $d["first_name"];
                        // $_SESSION["email"] = $email;
                        $_SESSION["userdata"]["id"] = $d["id"];
                        $_SESSION["userdata"] = $d;
                        $t = time() + (60 * 60 * 24 * 10);
                        if ($rem == "true") {
                            setcookie("em", $email, $t);
                            setcookie("pw", $password, $t);
                        } else {
                            setcookie("em", "", -1);
                            setcookie("pw", "", -1);
                        }
                        echo "Sucess";
                    }
                }
            }
        } else {
            echo "*Password Incorrect";
        }
    } else {
        echo "*Not Registered Email Address";
    }
}
