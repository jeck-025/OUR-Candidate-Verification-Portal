<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/caveportal/resource/php/class/core/init.php';
// isLogin();
$view = new view;
if (isset($_POST["tn"])) {
    //do what it is supposed to do
} else {
    header("HTTP/1.1 403 Forbidden");
    exit;
}
// isClient($user->data()->groups);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="CEU Candidate Verification Portal" />
  <meta name="author" content="Mariano R.J., Gita J.N., Tuazon M., Valencia E.C." />
  <!-- <meta http-equiv="refresh" content="300; url=login"> -->
  <link href="resource/img/favcave.ico" rel="icon">
  <title>CEU CAVEPortal</title>
  <!-- <link rel="icon" type="image/x-icon" href="assets/logo_icon.ico" /> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="icon" type="image/x-icon" href="resource/img/tab-icon.png">
  <link href="resource/css/regform.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="vendor/css/bootstrap-select.min.css">
  <script src="https://kit.fontawesome.com/b04d2a2a76.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="sweetalert2.min.css">
  <script src="sweetalert2.min.js"></script>
  <script src="sweetalert2.all.min.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Kiwi+Maru:wght@300;500&display=swap" rel="stylesheet">

</head>

<body class="d-flex flex-column h-100 bg-light">

  <main class="flex-shrink-0">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" data-aos="fade-down" data-aos-duration="1500">
      <div class="container px-5 justify-content-center">
        <a class="navbar-brand" href="index">
          <img src="resource/img/CAVElogo-white.png" alt="" width="150" height="65" class="d-inline-block align-top" /></a>
      </div>
    </nav>

    <section class="wrapper">
      <div class="container mt-2 slide-in-left rounded shadow-sm" data-aos="fade-down" data-aos-duration="1500">
        <div class="row justify-content-center mt-lg-5">
            <div class="col-12  mt-lg-3">
              <h3 class="headermain2 mb-4 text-center"><b class="ceupink">Office of the University Registrar</b><br> Candidate Verification Status Checker</h3>
              <div class="text-left p-5 slide-in-left shadow bgc">
                <?php


                 $infos = findTransactionInfo($_POST['tn']);


                 if($infos == NULL){
                   echo "<p class='text-left'>
                   Invalid Transaction Number. Please input the correct number to proceed.
                   <br />For concerns or question you may send an email to <b class='ceupink'>rdmama@ceu.edu.ph</b>.<br /> Thank you and stay safe!</p>";
                 }else{
                   $status = $infos[0]['status'];
                   if($status =="PENDING"){
                     echo "<p class='text-left'>
                     Dear <b>".$infos[0]["employee"]."</b>, <br />Your Verification request is currently being reviewed by our verification officer.<br>
                     Normally this would take 5-10 working days to complete.
                     <br />For follow-up and other inquiries you may send an email to: <br>
                      <ul>
                        <li><b class='ceupink'>rdmama@ceu.edu.ph for CEU MANILA</b></li>
                        <li><b class='ceupink'>raparada@ceu.edu.ph for CEU MAKATI</b></li>
                        <li><b class='ceupink'>kdeleon@ceu.edu.ph for CEU MALOLOS</b></li>
                      </ul>
                      <br /> Thank you and stay safe!</p>";
                   }elseif($status =="ON-HOLD"){
                     echo "<p class='text-left'>
                     Dear <b>".$infos[0]["employee"]."</b>, <br />Your Verification request is currently put on-hold by our verification officer.<br>
                     For the reason:<b> ".$infos[0]['remarks']."</b><br>
                     Normally this would take 5-10 working days to verify.
                     <br />For follow-up and other inquiries you may send an email to: <br>
                      <ul>
                        <li><b class='ceupink'>rdmama@ceu.edu.ph for CEU MANILA</b></li>
                        <li><b class='ceupink'>raparada@ceu.edu.ph for CEU MAKATI</b></li>
                        <li><b class='ceupink'>kdeleon@ceu.edu.ph for CEU MALOLOS</b></li>
                      </ul>
                      <br /> Thank you and stay safe!</p>";
                   }elseif($status =="VERIFIED"){
                     echo "<p class='text-left'>
                     Dear <b>".$infos[0]["employee"]."</b>, <br />Your Verification request is now verified.<br>
                     Please see the <b><a href='https://ceumnlregistrar.com/caveportal/pdfcertificates.php?tn=$_POST[tn]'>LINK</a> </b>for the verification certificate. Thank you!
                     <br />For other inquiries you may send an email to: <br>
                      <ul>
                        <li><b class='ceupink'>rdmama@ceu.edu.ph for CEU MANILA</b></li>
                        <li><b class='ceupink'>raparada@ceu.edu.ph for CEU MAKATI</b></li>
                        <li><b class='ceupink'>kdeleon@ceu.edu.ph for CEU MALOLOS</b></li>
                      </ul>
                      <br /> Thank you and stay safe!</p>";
                   }elseif($status =="DECLINED"){
                     echo "<p class='text-left'>
                     Dear <b>".$infos[0]["employee"]."</b>, <br />Your Verification request was DENIED by our verification officer.<br>
                     For the reason:<b> ".$infos[0]['remarks']."</b><br>
                     <br />For concerns and other inquiries you may send an email to: <br>
                      <ul>
                        <li><b class='ceupink'>rdmama@ceu.edu.ph for CEU MANILA</b></li>
                        <li><b class='ceupink'>raparada@ceu.edu.ph for CEU MAKATI</b></li>
                        <li><b class='ceupink'>kdeleon@ceu.edu.ph for CEU MALOLOS</b></li>
                      </ul>
                      <br /> Thank you and stay safe!</p>";
                   }
                 }
                ?>
              </div>
            </div>
          </div>
    </section>
    <!-- Footer-->
    <footer class="bg-dark mb-0 mt-auto sd">
      <div class="container px-5">
        <div class="row align-items-center justify-content-between flex-column flex-sm-row">
          <div class="col-auto">
            <div class="small m-0 text-white"><strong>Centro Escolar University</strong>&nbsp&nbsp&nbsp&nbspMariano | Gita | Tuazon | Valencia | Bolasoc | Anatalio </div>
          </div>
          <div class="col-auto">
            <!-- <a class="link-light small" href="#!">Privacy</a>
            <span class="text-white mx-1">&middot;</span>
            <a class="link-light small" href="#!">Terms</a>
            <span class="text-white mx-1">&middot;</span>
            <a class="link-light small" href="#!">Contact</a> -->
          </div>
        </div>
      </div>
    </footer>

  </main>
  <!-- Modal -->
  <script src="vendor/js/jquery.js"></script>
  <script src="resource/js/scripts.js"></script>
  <script src="vendor/js/popper.js"></script>
  <script src="vendor/js/bootstrap.min.js"></script>
  <script src="vendor/js/bootstrap-select.min.js"></script>
  <script src="vendor/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

  <!-- <script src="resource/js/ft.js"></script> -->


  <script>
    $(document).ready(function() {
      $("#ceumodal").modal('show');
    });

    function change() {
      document.getElementById("myButton1").value = "Submitting form... Do not click again. Please wait...";
      setTimeout(
        function() {
          document.getElementById("myButton1").value = "Submit the Candidate Verification Application Form"
        }, 3000);
    }
  </script>
  <script>
    AOS.init();
  </script>
</body>

</html>
