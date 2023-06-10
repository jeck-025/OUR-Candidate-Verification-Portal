<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'autoload.php';

function sendApprovedEmail($studLast, $studFirst, $studMiddle, $fullname, $email, $tn, $vfdategrad, $vfdateent, $vfdegree, $vfcampus, $yearsGrad, $yearsLastAtt, $studDegree, $campus, $vfname, $vfdateatt, $la_sy, $ent_sy, $status) {

  // Convert Campus Code
  if($campus == "MNL"){
    $campus = "CEU MANILA";
  }
  elseif($campus == "MLS"){
    $campus = "CEU MALOLOS";
  }
  else{
    $campus = "CEU MAKATI";
  }

  if($vfcampus == "MNL"){
    $vfcampus = "CEU MANILA";
    $replyto = "rdmama@ceu.edu.ph";
  }
  elseif($vfcampus == "MLS"){
    $vfcampus = "CEU MALOLOS";
    $replyto = "kdeleon@ceu.edu.ph";
  }
  else{
    $vfcampus = "CEU MAKATI";
    $replyto = "raparada@ceu.edu.ph";
  }

  //Convert Status / Educational Attainment
  if($status == "G"){
    $disp_status = "GRADUATE";
  }elseif($status == "UG"){
    $disp_status = "UNDERGRADUATE";
  }else{
    $disp_status = "Unclassified";
  }

  //Convert Input Date Grad
  if(!empty($yearsGrad)){
    $yearsGrad0 = strtr($yearsGrad, '-', '-');
    $conv_yearsGrad = strtotime($yearsGrad0);
    $GradDate0 = date('F d, Y', $conv_yearsGrad);
  }else{
    $GradDate0 = " - - - ";
  }

  //Convert Verified Date Grad
  if(!empty($vfdategrad)){
    $vfDateGrad0 = strtr($vfdategrad, '-', '-');
    $conv_dateGrad = strtotime($vfDateGrad0);
    $vfGradDate0 = date('F d, Y', $conv_dateGrad);
  }else{
    $vfGradDate0 = " - - - ";
  }

  //Convert Input Date Last Attended
  if(!empty($yearsLastAtt)){
    $yearsLastAtt0 = strtr($yearsLastAtt, '-', '-');
    $conv_yearsLastAtt = strtotime($yearsLastAtt0);
    $LastAttDate0 = date('F d, Y', $conv_yearsLastAtt);
  }else{
    $LastAttDate0 = " - - - ";
  }

  //Convert Verified Date Last Attended
  if(!empty($vfdateatt)){
    $vfDateAtt0 = strtr($vfdateatt, '-', '-');
    $conv_vfDateAtt0 = strtotime($vfDateAtt0);
    $vfLastAttDate = date('F d, Y', $conv_vfDateAtt0);
  }else{
    $vfLastAttDate = " - - - ";
  }

  //Convert Entrance Date
  if(!empty($vfdateent)){
    $vfDateEnt0 = strtr($vfdateent, '-', '-');
    $conv_vfDateEnt0 = strtotime($vfDateEnt0);
    $vfEntrDate = date('F d, Y', $conv_vfDateEnt0);
  }else{
    $vfEntrDate = " - - - ";
  }
  
  if(!empty($ent_sy)){
    //Format School Year - Entrance
    $conv_ent_sy = substr($ent_sy, 0, -2);
    //Format Semester - Get semester value at the end of the string
    $conv_ent_sem = substr($ent_sy, -1);
    //Convert substring semester value to whole words
    if($conv_ent_sem == "1"){
    $disp_ent = "<br> <i>(First Semester, SY$conv_ent_sy)</i>";
    }elseif($conv_ent_sem == "2"){
      $disp_ent = "<br> <i>(Second Semester, SY$conv_ent_sy)</i>";
    }else{
      $disp_ent = "<br> <i>(Summer Semester, SY$conv_ent_sy)</i>";
    }
  }else{
    $disp_ent = "";
  }
  
  if(!empty($la_sy)){
    $conv_la_sy = substr($la_sy, 0, -2);
    $conv_la_sem = substr($la_sy, -1);
    if($conv_la_sem == "1"){
      if(!empty($vfdategrad)){
        $disp_la = "<br> <i>(First Semester, SY$conv_la_sy)</i>";
      }else{
        $disp_la = "";
      }      
      if(!empty($vfdateatt)){
        $disp_la_ug = "<br> <i>(First Semester, SY$conv_la_sy)</i>";
      }else{
        $disp_la_ug = "";
      }
    }elseif($conv_la_sem == "2"){
      if(!empty($vfdategrad)){
        $disp_la = "<br> <i>(Second Semester, SY$conv_la_sy)</i>";
      }else{
        $disp_la = "";
      } 
      if(!empty($vfdateatt)){
        $disp_la_ug = "<br> <i>(Second Semester, SY$conv_la_sy)</i>";
      }else{
        $disp_la_ug = "";
      }
    }else{
      if(!empty($vfdategrad)){
        $disp_la = "<br> <i>(Summer Semester, SY$conv_la_sy)</i>";
      }else{
        $disp_la = "";
      } 
      if(!empty($vfdateatt)){
        $disp_la_ug = "<br> <i>(Summer Semester, SY$conv_la_sy)</i>";
      }else{
        $disp_la_ug = "";
      }
    }
  }else{
    $disp_la = "";
    $disp_la_ug = "";
  }
  
  $mail = new PHPMailer(true);

  $body ="<p>Dear $fullname,</p>
          <p>Greetings of peace!</p>
          <p>Your submitted application for Mr/Ms. $studLast has been <b>VERIFIED -</b><i> (Transaction Number: $tn) </i></p>
          <p>Please see the details below: <br></p>

          <table style='font-family: arial, sans-serif; border-collapse: collapse; width: 70%;'>
            <thead>
              <tr>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px; width:20%;'></th>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px; width:40%;'>Data to be Verified from Records</th>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px; width:40%;'>Verified Data from Records</th>
              </tr>
            </thead>
            <tbody>
              <tr style='background-color: #dddddd;'>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Name</th>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$studLast, $studFirst $studMiddle</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'><i>$vfname</i></td>
              </tr>
              <tr>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Degree</th>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$studDegree</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'><i>$vfdegree</i></td>
              </tr>
              <tr style='background-color: #dddddd;'>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Educational Attainment</th>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>---</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'><i>$disp_status</i></td>
              </tr>
              <tr>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Date of Graduation</th>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$GradDate0</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'><i>$vfGradDate0 $disp_la</i></td>
              </tr>
              <tr style='background-color: #dddddd;'>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Date Last Enrolled <i>(For Undergraduates)</i></th>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$LastAttDate0</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'><i>$vfLastAttDate $disp_la_ug</i></td>
              </tr>
              <tr>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Entrance Date</th>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>---</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'><i>$vfEntrDate $disp_ent</i></td>
              </tr>
              <tr style='background-color: #dddddd;'>
                <th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>Campus</th>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>$campus</td>
                <td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'><i>$vfcampus</i></td>
              </tr>
            </tbody>
          </table>

          <p>For other inquiries, you may send an email to $replyto</p>
          <p>Please click this <a href='www.ceumnlregistrar.com/caveportal/pdfcertificates.php?tn=$tn'>LINK</a> for the certificate. Thank you!</p>
          <p><b>This is an auto generated email please do not reply.</b></p>
          <p>Thank you and stay safe.</p>";

try {
  //Server settings
  //Server settings
   $mail->SMTPDebug = SMTP::DEBUG_SERVER;
   $mail->isSMTP();
   $mail->Host       = 'smtp.gmail.com';     //platform
   $mail->SMTPAuth   = true;
   $mail->Username   = 'rdmama@ceu.edu.ph';   //email
   $mail->Password   = 'mjrmzipzrmidccav';                                //password
   $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
   $mail->Port       = 587;

   //Recipients
   $mail->setFrom($mail->Username);       //sender
   $mail->addAddress($email);

   //Content
   $mail->isHTML(true);
   $mail->Subject = '(No reply) Candidate Verification Update';
   $mail->Body    = $body;             //content

   $mail->SMTPDebug  = SMTP::DEBUG_OFF;
   $mail->send();
   echo "message has been sent";
   echo "here";

} catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}

function sendOnHoldEmail($lastname, $fullname, $status, $email, $remarks) {
  $mail = new PHPMailer(true);

  $body ="<p>Dear $fullname,</p>
  <p>Greetings of peace!</p>
  <p>Your submitted application for Mr/Ms. $lastname has been placed ON-HOLD due to the following reason/s: <br><b>$remarks</b></p>
  <p>For clarifications, please email:</p>
  <ul>
    <li><b>rdmama@ceu.edu.ph</b> for CEU Manila</li>
    <li><b>raparada@ceu.edu.ph</b> for CEU Makati</li>
    <li><b>kdeleon@ceu.edu.ph</b> for CEU Malolos</li>
  </ul>
  <p>For more information, you may check your verification application through the Centro Escolar University - Office of the Registrar Candidate Verification Portal.</p>
  <p><b>This is an auto generated email please do not reply.</b></p>
  <p>Thank you and stay safe.</p>";
  try {
    //Server settings
    //Server settings
     $mail->SMTPDebug = SMTP::DEBUG_SERVER;
     $mail->isSMTP();
     $mail->Host       = 'smtp.gmail.com';     //platform
     $mail->SMTPAuth   = true;
     $mail->Username   = 'rdmama@ceu.edu.ph';   //email
     $mail->Password   = 'mjrmzipzrmidccav';                                //password
     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
     $mail->Port       = 587;

     //Recipients
     $mail->setFrom($mail->Username);       //sender
     $mail->addAddress($email);

     //Content
     $mail->isHTML(true);
     $mail->Subject = '(No reply) Candidate Verification Update';
     $mail->Body    = $body;             //content

     $mail->SMTPDebug  = SMTP::DEBUG_OFF;
     $mail->send();
     echo "message has been sent";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}

function sendDeniedEmail($lastname, $fullname, $status, $email, $remarks) {
  $mail = new PHPMailer(true);

  $body ="<p>Dear $fullname,</p>
<p>Greetings of peace!</p>
<p>Your submitted application for Mr/Ms. $lastname has been DENIED due to the following reason/s:<br><b>$remarks</b></p>
<p>For clarifications, please email:</p>
<ul>
  <li><b>rdmama@ceu.edu.ph</b> for CEU Manila</li>
  <li><b>raparada@ceu.edu.ph</b> for CEU Makati</li>
  <li><b>kdeleon@ceu.edu.ph</b> for CEU Malolos</li>
</ul>
<p>For more information, you may check your verification application through the Centro Escolar University - Office of the Registrar Candidate Verification Portal.</p>
<p><b>This is an auto generated email please do not reply.</b></p>
<p>Thank you and stay safe.</p>";
  try {
    //Server settings
    //Server settings
     $mail->SMTPDebug = SMTP::DEBUG_SERVER;
     $mail->isSMTP();
     $mail->Host       = 'smtp.gmail.com';     //platform
     $mail->SMTPAuth   = true;
     $mail->Username   = 'rdmama@ceu.edu.ph';   //email
     $mail->Password   = 'mjrmzipzrmidccav';                                //password
     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
     $mail->Port       = 587;

     //Recipients
     $mail->setFrom($mail->Username);       //sender
     $mail->addAddress($email);

     //Content
     $mail->isHTML(true);
     $mail->Subject = '(No reply) Candidate Verification Update';
     $mail->Body    = $body;             //content

     $mail->SMTPDebug  = SMTP::DEBUG_OFF;
     $mail->send();
     echo "message has been sent";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}

function sendInquiry($email) {
  $mail = new PHPMailer(true);

  $body ="<p>Greetings of peace!</p>
<p>You have successfully inquired for candidate verification</p>
<p>Please register a account on the link below to start the process. <a href='port-seventeen.com/caveportal/register.php'>Inquire An Account</a></p>
<p><b>This is an auto generated email please do not reply.</b></p>
<p>Thank you and stay safe.</p>";
  try {
    //Server settings
    //Server settings
     $mail->SMTPDebug = SMTP::DEBUG_SERVER;
     $mail->isSMTP();
     $mail->Host       = 'smtp.gmail.com';     //platform
     $mail->SMTPAuth   = true;
     $mail->Username   = 'ceumlscave@gmail.com';   //email
     $mail->Password   = 'gmvfujumrdqpsjgx';                                //password
     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
     $mail->Port       = 587;

     //Recipients
     $mail->setFrom($mail->Username);       //sender
     $mail->addAddress($email);

     //Content
     $mail->isHTML(true);
     $mail->Subject = '(No reply) Candidate Verification Inquiry Account';
     $mail->Body    = $body;             //content


     $mail->SMTPDebug  = SMTP::DEBUG_OFF;
     $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}

function sendClientAcc($username, $password, $email) {
  $mail = new PHPMailer(true);

  $body ="<p>Greetings of peace!</p>
<p>We have successfully registered your CAVE Portal Register Account</p>
<p>Please Login using this credentials through our CAVE Portal</p>
<p><b>Username: $username</b></p>
<p><b>Password: $password</b></p>
<p>It is highly suggested that you changed your password upon recieving this email!</p>
<a href='port-seventeen.com/caveportal/login.php'>Proceed to Sign-in</a>
<p><b>This is an auto generated email please do not reply.</b></p>
<p>Thank you and stay safe.</p>";
  try {
    //Server settings
    //Server settings
     $mail->SMTPDebug = SMTP::DEBUG_SERVER;
     $mail->isSMTP();
     $mail->Host       = 'smtp.gmail.com';     //platform
     $mail->SMTPAuth   = true;
     $mail->Username   = 'rdmama@ceu.edu.ph';   //email
     $mail->Password   = 'mjrmzipzrmidccav';                                //password
     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
     $mail->Port       = 587;

     //Recipients
     $mail->setFrom($mail->Username);       //sender
     $mail->addAddress($email);

     //Content
     $mail->isHTML(true);
     $mail->Subject = '(No reply) Candidate Verification Setup Account';
     $mail->Body    = $body;             //content


     $mail->SMTPDebug  = SMTP::DEBUG_OFF;
     $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
    //header

  // Convert Graduation Date
  // if(!empty($yearsGrad)){                             
  //   $dig0 = strtr($yearsGrad, '-', '-');              // Translate certain characters to string?? 
  //   $conv_dig = strtotime($dig0);                     // string to time
  //   $dig = date('M d, Y', $conv_dig);                 // convert date format ( DIG - Date initial - Graduation ... hahaha )

  //   if(!empty($vfdategrad)){                             // Check if there's no Verified Entrance Date
  //     $dvg0 = strtr($vfdategrad, '-', '-');              // Translate certain characters to string?? 
  //     $conv_dvg = strtotime($dvg0);                      // string to time
  //     $dvg = date('M d, Y', $conv_dvg);}                 // convert date format ( DVA - Date verified graduation )
  //   else{
  //     $dvg = "";}                                        // Set variable empty if there's no Verified Entrance Date ( DVA - Date verified graduation )
  // }
  // else{
  //   $dig = "";                                           // Set variable empty if there's no Verified Entrance Date ( DIG - Date initial - Graduation ... hahaha )
  // }

  // // Convert Entrance Date
  // if(!empty($yearsLastAtt)){                          // Check if Year or Date Last Attended is NOT empty
  //   $dia0 = strtr($yearsLastAtt, '-', '-');           // Translate certain characters to string?? 
  //   $conv_dia = strtotime($dia0);                     // string to time
  //   $dia = date('M d, Y', $conv_dia);                 // convert date format ( DIA - Date inital attendance )                                  
  // }
  // else{
  //   $dia = "";                                         // Set variable empty if there's no Verified Entrance Date ( DIA - Date initial attendance 
  // }

  // if(!empty($vfdateent)){                              // Check if there's no Verified Entrance Date
  //   $dve0 = strtr($vfdateent, '-', '-');               // Translate certain characters to string?? 
  //   $conv_dve = strtotime($dve0);                      // string to time
  //   $dve = date('M d, Y', $conv_dve);}                 // convert date format ( DVE - Date verified entrance )
  // else{
  //   $dve = "";
  // }      
                                        
  // if(!empty($vfdateatt)){                              
  //   $dva0 = strtr($vfdateatt, '-', '-');              
  //   $conv_dva = strtotime($dva0);                      
  //   $dva = date('M d, Y', $conv_dva);}                 
  // else{
  //   $dva = "";
  // }