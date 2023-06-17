<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/caveportal/resource/php/class/core/init.php';
isLogin();
$user = new user();
isAdmin($user->data()->groups);
$viewtable = new viewtable();
$agentID = $user->data()->id;


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
   <link href="vendor/img/favicon.png" rel="icon">
   <link href="resource/img/favcave.ico" rel="icon">
   <link href="vendor/img/apple-touch-icon.png" rel="apple-touch-icon">
   <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
   <link href="vendor/css/bootstrap.min.css" rel="stylesheet">
   <link href="vendor/css/bootstrap-icons.css" rel="stylesheet">
   <link href="vendor/css/boxicons.min.css" rel="stylesheet">
   <link href="vendor/css/quill.snow.css" rel="stylesheet">
   <link href="vendor/css/quill.bubble.css" rel="stylesheet">
   <link href="vendor/css/remixicon.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="vendor/css/dataTables.css">
   <link href="vendor/css/style.css" rel="stylesheet">
   <script src="vendor/js/jquery.js"></script>
   <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/jquery.dataTables.js"></script>
   <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/dataTables.buttons.min.js"></script>
   <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/jszip.min.js"></script>
   <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/pdfmake.min.js"></script>
   <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/vfs_fonts.js"></script>
   <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/buttons.html5.min.js"></script>
   <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/buttons.print.min.js"></script>
   <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
   <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script> -->


</head>

<body class="d-flex flex-column h-100">
   <div class="loader_bg">
      <div class="loader"></div>
   </div>
   <header id="header" class="header fixed-top d-flex align-items-center">
      <div class="d-flex align-items-center justify-content-between">
         <i class="bi bi-list toggle-sidebar-btn mx-3"></i>
         <a href="admindash" class="logo d-flex align-items-center"> <img src="resource/img/CAVElogo.png" alt="">
            <span class="d-none d-lg-block">Admin</span> </a>
      </div>
   </header>

   <aside id="sidebar" class="sidebar">
      <ul class="sidebar-nav" id="sidebar-nav">
         <li class="nav-item"> <a class="nav-link collapsed" href="admindash"> <i class="bi bi-grid"></i> <span>My Dashboard</span> </a></li>
         <li class="nav-heading">Options</li>
         <li class="nav-item"> <a class="nav-link " href="logs"> <i class="bi bi-bar-chart"></i> <span>Reports</span> </a></li>
         <li class="nav-item"> <a class="nav-link collapsed" href="mapreport"> <i class="bi bi-pin-map"></i><span>CAVE Map</span> </a></li>
         <li class="nav-item"> <a class="nav-link collapsed" href="logout"> <i class="bi bi-box-arrow-in-right"></i> <span>Log out</span> </a></li>
      </ul>
   </aside>
   <main id="main" class="main">
      <div class="pagtitle" data-aos="fade-right" data-aos-duration="1000">
         <div class="row">
            <div class="col-md-12 my-4">
               <h1>Reports Dashboard</h1>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12 pb-3 justify-content-center">
               <div class="card">
                  <div class="card-body report">
                     <form action="" method="GET">
                        <h3 class="my-4">View Other Monthly Report</h3>
                        <input type="month" class="search datepicker" name="date" id="date_search" value="<?php  if(!empty($_GET['date'])){echo $_GET['date']; } ?>">
                        <input type="submit" class="date_btn" name="month_btn" id="month_btn">
                        <a class="btn btn-info date_btn" href="logs">Clear</a>
                     </form>
                  </div>
               </div>
            </div>
         </div>


         <section class="section dashboard" data-aos="fade-right" data-aos-duration="1000">
            <div class="row">
               <div class="col-lg-12">
                  <div class="row">
                     <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                           <div class="card-body">
                              <?php
                              if(isset($_GET['date'])  && ($_GET['date'] != "")){
                                 $strArray = explode("-", $_GET['date']);
                                 $year = $strArray[0];
                                 $month = $strArray[1];
                                 $viewtable->sortViewLogData($month, $year);
                              }else{
                                 $viewtable->viewLogData();
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



   <!-- Insert content here -->




   <!-- content end -->


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
   <script>
      AOS.init();
   </script>
   <script>
      setTimeout(function() {
         $('.loader_bg').fadeToggle();
      }, 850);
   </script>
</body>

</html>