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

          <p>Please click this <a href='www.ceumnlregistrar.com/caveportal/pdfcertificates.php?tn=$tn'>LINK</a> for the certificate.</p>

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

          <p><b>This is an auto generated email please do not reply to this email message.</b></p>
          <p>Thank you.</p>";

try {
  //Server settings
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
  <p><b>This is an auto generated email please do not reply to this email message.</b></p>
  <p>Thank you.</p>";
  try {
    //Server settings
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

<p><b>This is an auto generated email please do not reply to this email message.</b></p>
<p>Thank you.</p>";
  try {
    //Server settings
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
?>