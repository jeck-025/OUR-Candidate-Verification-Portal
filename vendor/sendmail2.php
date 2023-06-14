<?php

if(isset($open) && $open){
  //do what it is supposed to do
}
else {
  header("HTTP/1.1 403 Forbidden");
  exit;
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'autoload.php';
$mail = new PHPMailer(true);

$body ="<p>Dear Verification Officer ,</p>
<p>Greetings of peace!</p>
<p>You have successfully submitted a verification request for a Candidate Verification.</p>
<p>Please take note of your verification reference number <b>$tn</b>.</p>
<p>You may check the status of your request using our verification status checker at the CEU CAVE Portal Checker.</p>
<p>Verification will take 5-10 working days after submission</p>
<p>If you have question or inquiry please send an email to: 
<ul>
  <li><b>rdmama@ceu.edu.ph</b> for CEU Manila</li>
  <li><b>raparada@ceu.edu.ph</b> for CEU Makati</li>
  <li><b>kdeleon@ceu.edu.ph</b> for CEU Malolos</li>
</ul>
</p>
<p><b>This is an auto generated email please do not reply.</b></p>
<p>Thank you and stay safe.</p>";


try {
    $view = new mailer();
    $mailerData = $view->viewConfigMailer();
    $mailerUsername = $mailerData[0];
    $mailerPassword = $mailerData[1];
    $mailerPlatform = $mailerData[2];
    $mailerPort = $mailerData[3];

     $mail->SMTPDebug = SMTP::DEBUG_SERVER;
     $mail->isSMTP();
     $mail->Host       = $mailerPlatform;     //platform
     $mail->SMTPAuth   = true;
     $mail->Username   = $mailerUsername;   //email
     $mail->Password   = $mailerPassword;                                //password
     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
     $mail->Port       = $mailerPort;

  //Recipients
  $mail->setFrom('rdmama@ceu.edu.ph');       //sender
  $mail->addAddress($vemail);

  //Content
  $mail->isHTML(true);
  $mail->Subject = '(No reply) Candidate Verification Update';
  $mail->Body    = $body;             //content

  $mail->SMTPDebug  = SMTP::DEBUG_OFF;
  $mail->send();
  echo "message has been sent";
  header("Location:regform.php?status=Success&tn=$tn");
  die();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
    //header
