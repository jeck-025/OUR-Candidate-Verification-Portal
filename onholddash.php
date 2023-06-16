<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/caveportal/resource/php/class/core/init.php';
isLogin();
$user = new user();
isAdmin($user->data()->groups);
$viewtable = new viewtable();
$view = new view();
?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
   <meta name="description" content="CEU Candidate Verification Portal" />
   <meta name="author" content="Mariano R.J., Gita J.N., Tuazon M., Valencia E.C." />
   <meta http-equiv="refresh" content="300; url=login">
   <title>CEU CAVEPortal</title>
   <link rel="icon" type="image/x-icon" href="assets/logo_icon.ico" />
   <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
   <link href="resource/css/admindash.css" rel="stylesheet" />

   <link href="vendor/css/all.css" rel="stylesheet">
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="resource/img/favcave.ico" rel="icon">
   <link href="resource/img/tab-icon.png" rel="icon">
   <link href="vendor/img/apple-touch-icon.png" rel="apple-touch-icon">
   <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
   <link href="vendor/css/bootstrap.min.css" rel="stylesheet">
   <link href="vendor/css/bootstrap-icons.css" rel="stylesheet">
   <link href="vendor/css/boxicons.min.css" rel="stylesheet">
   <link href="vendor/css/quill.snow.css" rel="stylesheet">
   <link href="vendor/css/quill.bubble.css" rel="stylesheet">
   <link href="vendor/css/style.css" rel="stylesheet">
   <link href="vendor/css/remixicon.css" rel="stylesheet">
   <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <link rel="stylesheet" href="sweetalert2.min.css">
   <script src="sweetalert2.min.js"></script>
   <script src="sweetalert2.all.min.js"></script> -->
   <link rel="stylesheet" type="text/css" href="vendor/css/dataTables.css">
   <link href="vendor/css/style.css" rel="stylesheet">
   <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
   <script src="vendor/js/jquery.js"></script>


</head>

<body class="d-flex flex-column h-100">
   <header id="header" class="header fixed-top d-flex align-items-center">
      <div class="d-flex align-items-center justify-content-between">
         <i class="bi bi-list toggle-sidebar-btn mx-3"></i>
         <a href="admindash" class="logo d-flex align-items-center"> <img src="resource/img/CAVElogo.png" alt="">
            <span class="d-none d-lg-block">Admin</span> </a>
      </div>
   </header>
   <aside id="sidebar" class="sidebar">
      <ul class="sidebar-nav" id="sidebar-nav">
         <li class="nav-item"> <a class="nav-link " href="admindash"> <i class="bi bi-grid"></i> <span>My Dashboard</span> </a></li>
         <li class="nav-heading">Options</li>
         <li class="nav-item"> <a class="nav-link collapsed" href="logs"> <i class="bi bi-bar-chart"></i> <span>Reports</span> </a></li>
         <li class="nav-item"> <a class="nav-link collapsed" href="mapreport"> <i class="bi bi-pin-map"></i><span>CAVE Map</span> </a></li>
         <li class="nav-item"> <a class="nav-link collapsed" href="logout"> <i class="bi bi-box-arrow-in-right"></i> <span>Log out</span> </a></li>
      </ul>
   </aside>
   <main id="main" class="main">
      <div class="pagtitle pt-3" data-aos="fade-in" data-aos-duration="1000">
         <h1>Dashboard</h1>
         <nav>
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="admindash">Home</a></li>
               <li class="breadcrumb-item active">Dashboard</li>
            </ol>
         </nav>
      </div>
      <section class="reports mb-3">
         <div class="container">
            <div class="row">
               <div class="col-md-4">
                  <div class="card">
                     <div class="card-body report">
                        <h3 class="report-title main-part pt-4 mb-4">Office Verification Report</h3>
                        <?php
                           if(isset($_GET['date']) && ($_GET['date'] != "")){
                                 $strArray = explode("-", $_GET['date']);
                                 $year = $strArray[0];
                                 $month = $strArray[1];
                                 $convDate = strtotime($_GET['date']);
                                 $display = date('F Y', $convDate);
                                 echo"<h5><i class='bi bi-menu-button-wide-fill'></i>&nbsp Total Pending Verifications for the month of ".$display.": ";
                                 echo"<br><span class='count mt-3'>".$view->pendingCount($year, $month)." pending verification/s</span></h5>";
                           }else{
                                 echo"<h5><i class='bi bi-menu-button-wide-fill'></i>&nbsp Total Pending Verifications: ";
                                 echo"<br><span class='count mt-3'>".$view->allPendingCount()." pending verification/s</span></h5>";
                           }

                           if(isset($_GET['date']) && ($_GET['date'] != "")){
                                 $strArray = explode("-", $_GET['date']);
                                 $year = $strArray[0];
                                 $month = $strArray[1];
                                 $convDate = strtotime($_GET['date']);
                                 $display = date('F Y', $convDate);
                                 echo"<h5><i class='bi bi-calendar-fill'></i>&nbsp Total Verifications received for the month of ".$display.": ";
                                 echo"<br><span class='count mt-3'>".$view->totalMonthByM($year, $month)." verification/s";
                                 echo"<small> (".$view->totalMonthByMDone($year, $month)." processed)</small></span></h5>";
                           }else{
                                 echo"<h5><i class='bi bi-calendar-fill'></i>&nbsp Total Verification/s received for this month: ";
                                 echo"<br><span class='count mt-3'>".$view->totalMonth()." application/s";
                                 echo"<small> (".$view->totalMonthDone()." processed)</small></span></h5>";
                           }

                           if(isset($_GET['date']) && ($_GET['date'] != "")){
                                 $strArray = explode("-", $_GET['date']);
                                 $year = $strArray[0];
                                 $month = $strArray[1];
                                 $convDate = strtotime($_GET['date']);
                                 $display = date('F Y', $convDate);
                                 echo"<h5><i class='bi bi-patch-check-fill'></i>&nbsp Total Verifications Processed for the month of ".$display.": ";
                                 echo"<br><span class='count mt-3'>".$view->totalMonthCompletedByM($year, $month)." verification/s</span></h5>";
                           }else{
                                 echo"<h5><i class='bi bi-patch-check-fill'></i>&nbsp Total Verification/s Processed for this month: ";
                                 echo"<br><span class='count mt-3'>".$view->totalMonthCompleted()." verification/s</span></h5>";
                           }
                           ?>
                        </div>
                     </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body report">
                                <h3 class="report-title main-part pt-4 mb-4">Breakdown of Verification Remarks</h3>
                                <?php
                                    if(isset($_GET['date']) && ($_GET['date'] != "")) {
                                        $strArray = explode("-", $_GET['date']);
                                        $year = $strArray[0];
                                        $month = $strArray[1];
                                        $convDate = strtotime($_GET['date']);
                                        $display = date('F Y', $convDate);
                                        echo "<h5><i class='bi bi-exclamation-octagon-fill icon'></i> On-Hold Verifications for the month of ".$display.": ";
                                        echo "<br><span class='count'> ".$view->onHoldCount($year, $month)." verification/s</span></h5>";
                                    }else{
                                        echo "<h5><i class='bi bi-exclamation-octagon-fill icon'></i> Total On-Hold Verifications: ";
                                        echo "<br><span class='count'> ".$view->allOnHoldCount()." verification/s</span></h5>";
                                    }

                                    if(isset($_GET['date']) && ($_GET['date'] != "")) {
                                        $strArray = explode("-", $_GET['date']);
                                        $year = $strArray[0];
                                        $month = $strArray[1];
                                        $convDate = strtotime($_GET['date']);
                                        $display = date('F Y', $convDate);
                                        echo "<h5><i class='bi bi-person-x-fill icon'></i> Denied Verifications for the month of ".$display.": ";
                                        echo "<br><span class='count'> ".$view->DeniedCount($year, $month)." verification/s</span></h5>";
                                    }else{
                                        echo "<h5><i class='bi bi-person-x-fill'></i> Total Denied Verifications: ";
                                        echo "<br><span class='count'> ".$view->allDeniedCount()." verification/s</span></h5>";
                                    }

                                    if(isset($_GET['date']) && ($_GET['date'] != "")) {
                                        $strArray = explode("-", $_GET['date']);
                                        $year = $strArray[0];
                                        $month = $strArray[1];
                                        $convDate = strtotime($_GET['date']);
                                        $display = date('F Y', $convDate);
                                        echo "<h5><i class='bi bi-person-check-fill icon'></i> Verified for the month of ".$display.": ";
                                        echo "<br><span class='count'> ".$view->approvedCount($year, $month)." verification/s</span></h5>";
                                    }else{
                                        echo "<h5><i class='bi bi-person-check-fill icon'></i> Total Verified Requests: ";
                                        echo "<br><span class='count'> ".$view->allApprovedCount()." verification/s</span></h5>";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body report">
                                <form action="" method="GET">
                                    <h3 class="report-title main-part pt-4 mb-4">View Other Monthly Report</h3>
                                    <div class="text-center">
                                    <input type="month" class="search datepicker mb-3" name="date" id="search" value="<?php  if(!empty($_GET['date'])){echo $_GET['date']; } ?>"></br>
                                    <input type="submit" class="date_btn" name="month_btn" id="month_btn" value="Filter">
                                    <br><a class="btn btn-info date_btn mt-2" href="onholddash">Clear</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
                                             echo $view->pendingCount($year, $month);
                                          }else{
                                             echo $view->allPendingCount();
                                          }
                                          echo "</span></a>";
                                        ?>
                                    </li>

                                    <li class="nav-item">
                                        <?php
                                            if(isset($_GET['date'])){
                                                echo "<a class='nav-link' href='approveddash?date=".$_GET['date']."' type='button' role='tab' aria-controls='pills-home' aria-selected='true'>Approved Verifications <span class='badge'>";
                                            }else{
                                                echo "<a class='nav-link' href='approveddash' type='button' role='tab' aria-controls='pills-home' aria-selected='true'>Approved Verifications <span class='badge'>";
                                            }

                                            if(isset($_GET['date'])  && ($_GET['date'] != "")) {
                                                $strArray = explode("-", $_GET['date']);
                                                $year = $strArray[0];
                                                $month = $strArray[1];
                                                echo $view->approvedCount($year, $month);
                                            }else{
                                                echo $view->allApprovedCount();
                                            }
                                            echo "</span></a>";
                                          ?> 
                                    </li>

                                    <li class="nav-item">
                                        <?php
                                            if(isset($_GET['date'])){
                                                echo "<a class='nav-link active' href='onholddash?date=".$_GET['date']."' type='button' role='tab' aria-controls='pills-profile' aria-selected='true'>On-Hold Verifications <span class='badge active'>";
                                            }else{
                                                echo "<a class='nav-link active' href='onholddash' type='button' role='tab' aria-controls='pills-profile' aria-selected='true'>On-Hold Verifications <span class='badge active'>";
                                            }

                                            if (isset($_GET['date']) && ($_GET['date'] != "")) {
                                                $strArray = explode("-", $_GET['date']);
                                                $year = $strArray[0];
                                                $month = $strArray[1];
                                                echo $view->onHoldCount($year, $month);
                                            } else {
                                                echo $view->allOnHoldCount();
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
                                             echo $view->DeniedCount($year, $month);
                                          } else {
                                             echo $view->allDeniedCount();
                                          }
                                          echo "</span></a>";
                                        ?>
                                    </li>

                                </ul>
                                <div class="card-body">
                                    <?php
                                        if (isset($_GET['date']) && ($_GET['date'] != "")) {
                                            $strArray = explode("-", $_GET['date']);
                                            $year = $strArray[0];
                                            $month = $strArray[1];
                                            $viewtable->viewOnHoldData($year, $month);
                                        } else {
                                            $viewtable->viewAllOnHoldData();
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


   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
   <script src="resource/js/scripts.js"></script>
   <script src="vendor/js/bootstrap.min.js"></script>
   <script src="vendor/js/apexcharts.min.js"></script>
   <script src="vendor/js/bootstrap.bundle.min.js"></script>
   <script src="vendor/js/chart.min.js"></script>
   <script src="vendor/js/echarts.min.js"></script>
   <script src="vendor/js/quill.min.js"></script>
   <script src="vendor/js/simple-datatables.js"></script>
   <script src="vendor/js/tinymce.min.js"></script>
   <script src="vendor/js/validate.js"></script>
   <script src="vendor/js/main.js"></script>
   <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
   <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/jquery.dataTables.js"></script>
   <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/dataTables.buttons.min.js"></script>
   <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/jszip.min.js"></script>
   <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/vfs_fonts.js"></script>

   <script>
      AOS.init();
   </script>

</body>

</html>