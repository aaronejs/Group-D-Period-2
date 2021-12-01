<?php
session_start();
$subject = "Email Verification";
$message = "<a href=http://localhost/github/Group-D-Period-2/verify.php?vkey="
          . $_SESSION['vkey'] . ">Verify email</a>";
$header = "From: test.nhlstenden@gmail.com \r\n";
$header .= "MIME-Version: 1.0" . "\r\n";
$header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
if(mail($_SESSION['email'], $subject, $message, $header)){
  echo "Thank you for registering, We have sent you a verification link to your email";
}else{
  echo "Error sending verification email";
}
?>
