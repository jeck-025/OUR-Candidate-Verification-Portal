<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/caveportal/resource/php/class/core/init.php';
// isLogin();
$view = new view;
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
          <a class="btn btn-sm btn-outline btn-outline-light appbutton" href="certauthcheck.php">CAVE Certificate Checker</a>
      </div>
    </nav>

    <section class="wrapper">
      <div class="container-fluid mt-2 slide-in-left rounded shadow-sm" data-aos="fade-down" data-aos-duration="1500">

        <form action="" method="POST" class="rounded bg-white shadow py-4 px-4" enctype="multipart/form-data">
          <div class="row">
            <div class=" form-group col-md-12">
              <a class="back-btn" href="clientdash"><i class="bi bi-arrow-left-circle-fill"></i></a>
              <h3 class="text-center mb-4 title-header">New Application for Candidate Verification</h3>
              <?php
              // if (!empty($_GET['status'])) {
              //     CheckSuccess($_GET['status']);
              //   }
              // if (!empty($_POST)) {
              //   if($_POST['captcha'] != $_SESSION['digit']){
              //   session_destroy();
              //   header("location:regform.php?status=captchaError");
              //   die();
              //   }
              //   //$attended = $_POST['monthGrad']." ".$_POST['daysGrad'].'\, '.$_POST['yearsGrad'];
              //   $insert = new insert($_POST['firstName'], $_POST['middleName'], $_POST['lastName'], $_POST['campus'], $_POST['degree'], $_POST['yg'], $_POST['country'], $_FILES['diploma'], $_FILES['consent'], $_FILES['validID'],$_POST['vemail'],$_POST['vcompany'],$_POST['vname'], $_POST['ya'], $_POST['bd']);
              // }
              
              if (!empty($_GET['status'])) {
                  CheckSuccess($_GET['status']);
                }

              if(!empty($_POST)){
                $recaptcha_secret_key = '6LcZHmwoAAAAADZh4bK3HzmFGzLXvTvRs3XiQOsz';
                $recaptcha_response = $_POST['g-recaptcha-response'];

                $url = 'https://www.google.com/recaptcha/api/siteverify';
                $data = array(
                    'secret' => $recaptcha_secret_key,
                    'response' => $recaptcha_response);

                $options = array(
                    'http' => array (
                        'method' => 'POST',
                        'header' => 'Content-type: application/x-www-form-urlencoded',
                        'content' => http_build_query($data)));

                $context = stream_context_create($options);
                $verify = file_get_contents($url, false, $context);
                $captcha_success = json_decode($verify);

                if($captcha_success->success){
                  //do nothing, continue script
                }else{
                  session_destroy();
                  header("location:regform.php?status=captchaError");
                  exit;
                }

                  //$attended = $_POST['monthGrad']." ".$_POST['daysGrad'].'\, '.$_POST['yearsGrad'];
                $insert = new insert($_POST['firstName'], $_POST['middleName'], $_POST['lastName'], $_POST['campus'], $_POST['degree'], $_POST['yg'], $_POST['country'], $_FILES['diploma'], $_FILES['consent'], $_FILES['validID'],$_POST['vemail'],$_POST['vcompany'],$_POST['vname'], $_POST['ya'], $_POST['bd']);

              }

              ?>
            </div>
          </div>
          <div class="row border-top py-2">
            <div class="form-group col-md-12">
              <h5 class="text-start mt-2 mb-3">Basic Information <br /><small class="text-muted">for student with ñ in their name please input Uppercase Ñ or N instead. Please use the name used during his/her tenure at CEU.</small></h5>
            </div>
            <div class="form-floating col-md-4 mb-2">
              <input type="text" class="form-control form-control-sm" id="floatingInput" value="" name="firstName" placeholder="First Name" autocomplete="no" pattern="[a-zA-Z\s]*$">
              <label for="floatingInput">First Name</label>
            </div>

            <div class="form-floating col-md-4 mb-2">
              <input type="text" class="form-control form-control-sm" id="floatingInput" value="" name="middleName" placeholder="Middle Name" autocomplete="no">
              <label for="floatingInput">Middle Name</label>
            </div>

            <div class="form-floating col-md-4">
              <input type="text" class="form-control form-control-sm  " id="floatingInput" value="" name="lastName" placeholder="Last Name" autocomplete="no" pattern="[a-zA-Z\s]*$">
              <label for="floatingInput">Last Name</label>
              <small class="text-muted"></b> </small>
            </div>
          </div>

          <div class="row border-top py-2">
            <div class="form-group col-md-6">
              <label for="campus">Campus</label>
              <select id="campus" name="campus" class="selectpicker form-control" value="<?php echo Input::get('campus'); ?>" title="Select Campus" required>
                <?php $view->campuses(); ?>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="degree">Course/s</label>
              <select id="degree" name="degree" class="selectpicker form-control" data-live-search="true" value="<?php echo Input::get('degree'); ?>" title="Select Course" required>
                <?php $view->courses(); ?>
              </select>
            </div>
          </div>

          <div class="row border-top py-2">
            <div class="form-group col-md-4 text-center">
              <label for="yg">Year Last Attended (Optional)</label><br>
              <input type= "date" name="ya" id="ya" class="datepickerForm" value="" title="Select date"/>
            </div>
            <div class="form-group col-md-4 text-center">
              <label for="yg">Year Graduated (Optional)</label><br>
              <input type= "date" name="yg" id="yg" class="datepickerForm" value="" title="Select date"/>
            </div>
            <div class="form-group col-md-4 text-center">
              <label for="yg">Birthday</label><br>
              <input type= "date" name="bd" id="bd" class="datepickerForm" value="" title="Select date" requried/>
            </div>
          </div>

          <div class="row border-top py-2">
            <div class="form-group col-12-md">
              <small class="text-danger"><b>*File type of all uploads should be PDF.</b></em></b></small>

            </div>
            <div class="form-group col-md-4">
              <h5 class="text-start mt-2 mb-3" for="diploma">Upload Documents <br /><span class="diploma-title">(Please provide either of the following (TOR, Diploma, Cert. of Matriculation) as proof of authenticity). 
                            <small> For undergraduate, kindly attach any document related to CEU. </small></span></h5>

              <input id="diploma" class="form-control" accept=".pdf" type="file" name="diploma">

            </div>

            <div class="form-group col-md-4">
              <h5 class="text-start mt-2 mb-3" for="consent">Consent Form <br /><span class="diploma-title">(Please provide a consent form from the candidate).<br><br></span></h5>
              <input id="consent" class="form-control" accept=".pdf" type="file" name="consent">
              <p>
              </p>
            </div>
            <div class="form-group col-md-4">
              <h5 class="text-start mt-2 mb-3" for="validID">Valid ID of the Candidate<br /><span class="diploma-title">(Please provide the valid ID of the candidate).<br><br></span></h5>
              <input id="validID" class="form-control" accept=".pdf" type="file" name="validID">
              <p>
              </p>
            </div>
          </div>

          <small class="text-muted">*Please ensure the correctness of the pdf file. Incorrect requirements uploaded may <b>result to inaccurate verification.</b></em></b></small>
          <h6 class="text-start mt-2 mb-3"><span class="diploma-title">*File not a PDF Type? You may convert your file through here. <a class="converterlink" href="https://www.freepdfconvert.com/"><b>PDF Converter</b></a></span></h6>
          <div class="row border-top py-2">
            <div class="form-group col-md-12">
              <h5 class="text-start mt-2 mb-4">Verifier Information <br /></h5>
              <small class="text-danger"><b>*Please ensure the correctness of the verifier email address as this will serve as our medium of communication. Verification results will also be emailed to this address.</b></em></b></small>
            </div>
            <div class="form-floating col-md-4 mb-2">
              <input type="text" class="form-control form-control-sm" id="floatingInput" value="" name="vname" placeholder="Verifier Name" autocomplete="no">
              <label for="floatingInput">Verifier Name</label>
            </div>

            <div class="form-floating col-md-4 mb-2">
              <input type="text" class="form-control form-control-sm" id="floatingInput" value="" name="vcompany" placeholder="Verifier Company Name" autocomplete="no">
              <label for="floatingInput">Verifier Company Name</label>
            </div>

            <div class="form-floating col-md-4">
              <input type="email" class="form-control form-control-sm  " id="floatingInput" value="" name="vemail" placeholder="vemail" autocomplete="no" required>
              <label for="floatingInput">Verifier Email address Name</label>
              <small class="text-muted"></b> </small>
            </div>
          </div>

          <div class="row border-top my-2 d-flex justify-content-center">
            <div class="form-floating col-md-5">
              <select name="country" id="country" class="selectpicker form-control countrypicker" data-live-search="true" value="<?php echo Input::get('country'); ?>" title="Select Country" required>
                <?php $view->countries(); ?>
              </select>
              <label for="country"><b>Country (<b>Employer of the Candidate </b></b>)</label>
              <small class="text-muted">*Not the verifying company country</small>
            </div>
          </div>


          <div class="row border-top py-3">
            <div class="form-group col-md-12">
              <div class="col-md-12 text-center recaptcha">
                <h6><b>Please complete the captcha below before submitting.</b></h6>
                  <!-- <p><img src="captcha.php" width="120" height="30" border="1" alt="CAPTCHA"></p>
                  <p><input type="text" size="6" maxlength="5" name="captcha" value="">
                  <small>copy the digits from the image into this box</small></p>
                    <label  >&nbsp;</label> -->              
                  <div class="g-recaptcha" data-sitekey="6LcZHmwoAAAAAMud5aRHZVyMKm80GzSqMM6fFoXz"></div>
              </div>
            </div>
          </div>
          <div class="row border-top py-3">
            <div class="form-group col-md-12 p-5 text-center">
              <button type="submit" id="myButton1" class="btn btn-primary">
                Submit Verification Request
              </button>
            </div>
          </div>
      </div>
    </form>
    </section>
    <!-- Footer-->
    <footer class="bg-dark py-4 mt-auto">
      <div class="container px-5">
        <div class="row align-items-center justify-content-between flex-column flex-sm-row">
          <div class="col-auto">
            <div class="small m-0 text-white"><strong>Centro Escolar University</strong>&nbsp&nbsp&nbsp&nbspMariano | Gita | Tuazon | Valencia | Bolasoc | Anatalio </div>
          </div>
          <div class="col-auto">
            <a class="link-light small" href="#!">Privacy</a>
            <span class="text-white mx-1">&middot;</span>
            <a class="link-light small" href="#!">Terms</a>
            <span class="text-white mx-1">&middot;</span>
            <a class="link-light small" href="#!">Contact</a>
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
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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

     $('.datepicker').datepicker();
  </script>
  <script>
    AOS.init();
  </script>
</body>

</html>
