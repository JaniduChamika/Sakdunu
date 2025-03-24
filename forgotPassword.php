<?php

use PHPMailer\PHPMailer\PHPMailer;

require "database.php";
require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

if (isset($_GET["e"])) {
      $email = $_GET["e"];



      if (!empty($email)) {

            $q = "SELECT * FROM user WHERE `email`='" . $email . "'";
            $resultset = DB::search($q);
            if ($resultset->num_rows == 1) {
                  $uni = uniqid();

                  $vc = substr($uni, -6);


                  $q = "UPDATE user SET `verification_code`='" . $vc . "' WHERE `email`='" . $email . "'";
                  DB::iud($q);
                  $mail = new PHPMailer;
                  $mail->IsSMTP();
                  $mail->Host = 'smtp.gmail.com';
                  $mail->SMTPAuth = true;
                  $mail->Username = 'janprabashwara@gmail.com';
                  $mail->Password = '@jcp2001#';
                  $mail->SMTPSecure = 'ssl';
                  $mail->Port = 465;
                  $mail->setFrom('janprabashwara@gmail.com', 'Janidu');
                  $mail->addReplyTo('janprabashwara@gmail.com', 'Janidu');
                  $mail->addAddress($email);
                  $mail->isHTML(true);
                  $mail->Subject = 'Verification Code';
                  $bodyContent = '<h3 style="text-align: center;">Sakdunu Super Forgot Password</h3>
                   <div style="width: 100%;text-align: center;">
                   <span style="font-size: 19px">Varification code</span>
                   <br/>
                   <br/>
                   <span style="font-size: 17px">' . $vc . '</span>
                   </div> ';

                  $mail->Body    = $bodyContent;

                  if (!$mail->send()) {
                        echo 'Message could not be sent.';
                  } else {
                        echo "success";
                  }
            } else {
                  echo "*Not Registered Email Address";
            }
      } else {
            echo "*Enter Your Email Address";
      }
} else {
      echo "Something Wrong";
}
