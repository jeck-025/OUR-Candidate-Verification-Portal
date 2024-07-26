<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/caveportal/resource/php/class/core/init.php';
isLogin();
$user = new user();
isAdmin($user->data()->groups);
$viewtable = new viewtable();
$view = new view();
$ovr = new ovReport();
$locker = new locker();
?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
   <meta name="description" content="CEU Candidate Verification Portal" />
   <meta name="author" content="Mariano R.J., Gita J.N., Tuazon M., Valencia E.C." />
   <meta http-equiv="refresh" content="1200; url=login">
   <title>CEU CAVEPortal</title>
   <link rel="icon" type="image/x-icon" href="assets/logo_icon.ico" />
   <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
   <link href="resource/css/admindash.css" rel="stylesheet" />
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="resource/img/favcave.ico" rel="icon">
   <link href="vendor/img/apple-touch-icon.png" rel="apple-touch-icon">
   <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
   <link href="vendor/css/bootstrap.min.css" rel="stylesheet">
   <link href="vendor/css/boxicons.min.css" rel="stylesheet">
   <link href="vendor/css/quill.snow.css" rel="stylesheet">
   <link href="vendor/css/quill.bubble.css" rel="stylesheet">
   <link href="vendor/css/style.css" rel="stylesheet">
   <link href="vendor/css/remixicon.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="vendor/css/dataTables.css">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@500&display=swap" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">
   <!-- <div class="loader_bg">
      <div class="loader"></div>
    </div> -->
   <header id="header" class="header fixed-top d-flex align-items-center">
      <div class="d-flex align-items-center justify-content-between">
         <i class="bi bi-list toggle-sidebar-btn mx-3"></i>
         <a href="admindash" class="logo d-flex align-items-center"> <img src="resource/img/CAVElogo.png" alt="">
            <span class="d-none d-lg-block">Admin</span> </a>
      </div>
   </header>
   <aside id="sidebar" class="sidebar">
      <ul class="sidebar-nav" id="sidebar-nav">
         <li class="nav-heading">Current Date and Time</li>
         <h5 class='text-center'><?php include 'clock.php'; ?></h5>
         <li class="nav-heading">WELCOME</li>
         <h6 class='text-center'><?php echo $user->data()->fullName." - ".$user->data()->mm ?></h6>
         <hr>

         <?php if($user->data()->username == "RMAMA" || $user->data()->username == "jeck" || $user->data()->username == "EMANALO"){?>
         <?php //if($user->data()->username == "RMAMA" || $user->data()->username == "jeck" || $user->data()->username == "EMANALO"){?>
         <li class="nav-heading">FORM STATUS</li>
         <div class='text-center'>
         <?php $locker->lockerStatusDisp(); ?>
         <?php $locker->maintenanceStatusDisp(); ?>
         <hr>
         <li class="nav-heading text-left">FORM TOOLS</li>
         <a href="locker.php?landing=approveddash" class="btn btn-sm <?php $locker->lockerButtonClr(); ?>">
         <?php $locker->lockerButton(); ?></a>
         <a href="lockerM.php?landing=approveddash" class="btn btn-sm <?php $locker->lockerMButtonClr(); ?>">
         <?php $locker->lockerMButton(); ?></a>
         </div>
         <hr>
         <?php } ?>

         <li class="nav-heading">Verifications</li>
         <li class="nav-item"> <a class="nav-link" href="admindash"> <i class="bi bi-grid"></i> <span>My Dashboard</span> </a></li>
         <li class="nav-item"> <a class="nav-link collapsed " href="admindash-prev-app.php"> <i class="bi bi-grid"></i> <span>All Previous Verifications</span> </a></li>
         <li class="nav-heading">Options</li>
         <li class="nav-item"> <a class="nav-link collapsed" href="logs"> <i class="bi bi-bar-chart"></i> <span>Reports</span> </a></li>
         <li class="nav-item"> <a class="nav-link collapsed" href="mapreport"> <i class="bi bi-pin-map"></i><span>CAVE Map</span> </a></li>
         <li class='nav-item'> <a class='nav-link collapsed' href='changepassm.php'><i class='bi bi-key-fill'></i><span> Change Password </span> </a></li>
         <li class="nav-item"> <a class="nav-link collapsed" href="logout"> <i class="bi bi-box-arrow-in-right"></i> <span>Log out</span> </a></li>
      </ul>
   </aside>
   <main id="main" class="main">
      <div class="pagtitle pt-3 pb-3" data-aos="fade-in" data-aos-duration="1000">
         <h1>Dashboard</h1>
      </div>
      
        <!-- COLLAPSE BUTTON---------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
        <p data-aos="fade-in" data-aos-duration="1000">
            <button class="btn btn-sm btn-dark" type="button" data-toggle="collapse" data-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
                <i class="bi bi-chevron-double-down"></i> Show / Hide Verification Summary
            </button>
        </p>

        <!-- COLLAPSE START---------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
        <div class="collapse <?php if(isset($_GET['date'])){echo "show";} ?>" id="collapseWidthExample">


        <section class="reports mb-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body report">
                                <h3 class="report-title main-part mb-4">Office Verification Report</h3>
                                <?php 
                                    $ovr->totalPendingVF();
                                    $ovr->totalReceivedVF();
                                    $ovr->totalProcessedVF();
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body report">
                                <h3 class="report-title main-part mb-4">Breakdown of Verification Remarks</h3>
                                <?php
                                    $ovr->totalHoldVF();
                                    $ovr->totalDeniedVF();
                                    $ovr->totalVerifiedVF();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body report">
                                    <form action="" method="GET">
                                        <div class="text-center">
                                        <h5 class="report-title main-part">View Other Monthly Report</h5>
                                        <input type="month" class="search datepicker mb-3" name="date" id="search" value="<?php  if(!empty($_GET['date'])){echo $_GET['date']; } ?>">
                                        <input type="submit" class="date_btn btn" name="month_btn" id="month_btn" value="Filter">
                                        <a class="btn btn-info date_btn" href="admindash">Clear</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


            </div>
        </section>
        </div>
        <!-- COLLAPSE END---------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
      
        <section class="section dashboard" data-aos="fade-in" data-aos-duration="1000">
         <div class="row">
            <div class="col-lg-12">
               <div class="row">
                  <div class="col-12">
                     <div class="card recent-sales overflow-auto">

                        <ul class="nav nav-pills  nav-justified" id="pills-tab" role="tablist">
                           <li class="nav-item">
                                 <?php
                                    if(isset($_GET['date'])){
                                       echo "<a class='nav-link' href='admindash?date=".$_GET['date']."&month_btn=Submit' type='button' role='tab' aria-controls='pills-home' aria-selected='true'>Pending Verifications <span class='badge'>";
                                    }else{
                                       echo "<a class='nav-link' href='admindash' type='button' role='tab' aria-controls='pills-home' aria-selected='true'>Pending Verifications <span class='badge'>";
                                    }

                                    if(isset($_GET['date'])  && ($_GET['date'] != "")) {
                                       $strArray = explode("-", $_GET['date']);
                                       $year = $strArray[0];
                                       $month = $strArray[1];
                                       echo $view->pendingCountNAV($year, $month);
                                    }else{
                                       echo $view->allPendingCountNAV();
                                    }
                                    echo "</span></a>";
                                 ?>
                           </li>

                           <li class="nav-item">
                                 <?php
                                    if(isset($_GET['date'])){
                                       echo "<a class='nav-link active' href='approveddash?date=".$_GET['date']."' type='button' role='tab' aria-controls='pills-home' aria-selected='true'>Approved Verifications <span class='badge active'>";
                                    }else{
                                       echo "<a class='nav-link active' href='approveddash' type='button' role='tab' aria-controls='pills-home' aria-selected='true'>Approved Verifications <span class='badge active'>";
                                    }

                                    if(isset($_GET['date'])  && ($_GET['date'] != "")) {
                                       $strArray = explode("-", $_GET['date']);
                                       $year = $strArray[0];
                                       $month = $strArray[1];
                                       echo $view->approvedCountNAV($year, $month);
                                    }else{
                                       echo $view->allApprovedCountNAV();
                                    }
                                    echo "</span></a>";
                                    ?> 
                           </li>

                           <li class="nav-item">
                                 <?php
                                    if(isset($_GET['date'])){
                                       echo "<a class='nav-link' href='onholddash?date=".$_GET['date']."' type='button' role='tab' aria-controls='pills-profile' aria-selected='true'>On-Hold Verifications <span class='badge'>";
                                    }else{
                                       echo "<a class='nav-link' href='onholddash' type='button' role='tab' aria-controls='pills-profile' aria-selected='true'>On-Hold Verifications <span class='badge'>";
                                    }

                                    if (isset($_GET['date']) && ($_GET['date'] != "")) {
                                       $strArray = explode("-", $_GET['date']);
                                       $year = $strArray[0];
                                       $month = $strArray[1];
                                       echo $view->onHoldCountNAV($year, $month);
                                    } else {
                                       echo $view->allOnHoldCountNAV();
                                    }
                                    echo "</span></a>";
                                    ?>
                           </li>

                           <li class="nav-item">
                                 <?php
                                    if(isset($_GET['date'])){
                                       echo "<a class='nav-link' href='denieddash?date=".$_GET['date']."' type='button' role='tab' aria-controls='pills-profile' aria-selected='true'>Denied Verifications <span class='badge'>";
                                    }else{
                                       echo "<a class='nav-link' href='denieddash' type='button' role='tab' aria-controls='pills-profile' aria-selected='true'>Denied Verifications <span class='badge'>";
                                    }

                                    if (isset($_GET['date'])  && ($_GET['date'] != "")) {
                                       $strArray = explode("-", $_GET['date']);
                                       $year = $strArray[0];
                                       $month = $strArray[1];
                                       echo $view->deniedCountNAV($year, $month);
                                    } else {
                                       echo $view->allDeniedCountNAV();
                                    }
                                    echo "</span></a>";
                                 ?>
                           </li>

                        </ul>

                        <div class="card-body">
                           <?php
                           if (isset($_GET['date'])  && ($_GET['date'] != "")) {
                              $strArray = explode("-", $_GET['date']);
                              $year = $strArray[0];
                              $month = $strArray[1];
                              if($year == date("Y")){
                                 $viewtype = "current";
                              }else{
                                 $viewtype = "legacy";
                              }
                              $viewtable->viewApprovedData($year, $month, $viewtype);
                           } else {
                              $viewtype = "current";
                              $viewtable->viewAllApprovedData($viewtype);
                           }
                           ?>

                        </div>
                     </div>
                  </div>


               </div>
            </div>

         </div>
         </div>
         </div>
      </section>
   </main>
   <!-- Footer-->
   <footer id="footer" class="footer">
      <div class="copyright"><strong>Centro Escolar University</span></strong> Office of the University Registrar</div>
      <div class="credits">Manila | Malolos| Makati</div>
      <div class="credits"><small>Mariano R.J. | Gita J.N. | Tuazon M. | Valencia E.C. | Bolasoc R.C. | Anatalio J.</small></div>
   </footer>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
   <script src="vendor/js/jquery.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
   <script src="resource/js/scripts.js"></script>
   <script src="vendor/js/bootstrap.min.js"></script>
   <script src="vendor/js/bootstrap.bundle.min.js"></script>
   <script src="vendor/js/quill.min.js"></script>
   <script src="vendor/js/tinymce.min.js"></script>
   <script src="vendor/js/validate.js"></script>
   <script src="vendor/js/apexcharts.min.js"></script>
   <script src="vendor/js/main.js"></script>
   <script src="vendor/js/echarts.min.js"></script>
   <script src="vendor/js/chart.min.js"></script>
   <script src="vendor/js/bootstrap-select.min.js"></script>
   <script src="resource/js/modal.js"></script>
   <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/jquery.dataTables.js"></script>
   <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/dataTables.buttons.min.js"></script>
   <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/jszip.min.js"></script>
   <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/vfs_fonts.js"></script>

   <script>
      setTimeout(function() {
         $('.loader_bg').fadeToggle();
      }, 850);
   </script>

   <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

</body>
</html>