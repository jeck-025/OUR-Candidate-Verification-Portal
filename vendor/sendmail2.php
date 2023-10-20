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

<p>You may check the status of your request using our verification status checker at the CEU CAVE Portal Checker: 
  https://ceumnlregistrar.com/caveportal/scrstatus</p>

<p>Verification will take 5-10 working days after submission</p>

<p>For additional assistance / inquiries, please email:</p>
          <ul>
            <li>For CEU Manila</li>
              <ul>
                <li><b>rdmama@ceu.edu.ph</b> - Ms. Rashida Mae Mama</li>
                  <ul>
                    <li>All Courses</li>
                  </ul>
              </ul> <br>
          
            <li>For CEU Malolos</li>
              <ul>
                <li><b>kdeleon@ceu.edu.ph</b> - Mr. Kenneth De Leon</li>
                <ul>
                  <li>All Courses</li>
                </ul>
            </ul> <br>

            <li>For CEU Makati</li>
              <ul>
                <li><b>raparada@ceu.edu.ph</b> - Ms. Ruby Parada</li>
                  <ul>
                    <li>Doctor of Dental Medicine, BS Medical Technology, BS Pharmacy, Clinical Pharmacy, Doctor of Pharmacy, BS Psychology, Juris Doctor</li>      
                  </ul> <br>

                <li><b>rdmalate@ceu.edu.ph</b> - Mrs. Rizza Mae Malate-Arce</li>
                  <ul>
                    <li>BS Accountancy, BSBA Management / Marketing Management, BSBA International Marketing, BS Legal Management</li>      
                  </ul> <br>

                <li><b>mnantonio@ceu.edu.ph</b> - Mrs. Ma. Florencia Antonio</li>
                  <ul>
                    <li>BS Computer Science, BS Information Technology, BS Int'l Hosp. Mgt. - HRCO / CIRO</li>      
                  </ul> <br>

                <li><b>nlliwanag@ceu.edu.ph</b> - Mr. Nerwin Liwanag</li>
                  <ul>
                    <li>BS Int'l Tourism & Travel Mgt, Graduate School</li>      
                  </ul> <br>
              </ul>
          </ul>

<p><b>This is an auto-generated email message. Please do not reply here.</b></p>
<p>Thank you.</p>";


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
?>