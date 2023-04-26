<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/caveportal/resource/php/class/core/init.php';
isLogin();
$user = new user();
isAdmin($user->data()->groups);
$viewtable = new viewtable;

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

   <link rel="stylesheet" type="text/css" href="vendor/css/bootstrap-select.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
   <link href="resource/css/admindash.css" rel="stylesheet" />
   <link href="vendor/css/all.css" rel="stylesheet">
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="resource/img/favcave.ico" rel="icon">
   <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
   <link href="vendor/css/boxicons.min.css" rel="stylesheet">
   <link href="vendor/css/quill.snow.css" rel="stylesheet">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <link href="vendor/css/quill.bubble.css" rel="stylesheet">
   <link href="vendor/css/style.css" rel="stylesheet">
   <link rel="stylesheet" type="text/css" href="vendor/css/dataTables.css">
   <link href="vendor/css/bootstrap.min.css" rel="stylesheet">
   <link href="vendor/css/remixicon.css" rel="stylesheet">
   <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


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
         <li class="nav-item"> <a class="nav-link " href="admindash"> <i class="bi bi-grid"></i> <span>My Dashboard</span> </a></li>
         <li class="nav-heading">Options</li>
         <li class="nav-item"> <a class="nav-link collapsed" href="logs"> <i class="bi bi-bar-chart"></i> <span>Reports</span> </a></li>
         <li class="nav-item"> <a class="nav-link collapsed" href="mapreport"> <i class="bi bi-pin-map"></i><span>CAVE Map</span> </a></li>
         <li class="nav-item"> <a class="nav-link collapsed" href="logout"> <i class="bi bi-box-arrow-in-right"></i> <span>Log out</span> </a></li>
      </ul>
   </aside>
   <main id="main" class="main">
      <div class="container px-5 my-5">
         <div class="row gx-5 justify-content-center">
            <div class="col-lg-8 col-xl-6">
               <div class="text-center">
                  <h2 class="fw-bolder esco">Escolarians Around the World!</h2>
                  <p class="lead fw-normal caption-world text-muted mb-5">It's amazing how these successful
                     people benchmarked their success and shared it with the rest of the world.</p>
               </div>
            </div>
         </div>

         <div class="container">
            <div class="row">
               <div class="col-lg-12 map">
               <p class="pb-5">Use the <code>+</code>/ <code>-</code> keys to zoom and the arrow keys to move. Click the country you want to view to open</p>

                  <?php require_once 'maps.php';

                  ?>
               </div>
               <div class="card-body1 mb-5">
                  <h5 class="card-title">Map Results <span>| Today </span></h5>
                  <table id='viewlogtable' class='table table-borderless table-hover shadow' width='100%'>
                     <?php $viewtable->viewMapResultSummary(); ?>
                  </table>

               </div>
               <div class="card-body mb-5">
                  
               </div>
            </div>
         </div>

         <!-- Log In-->

      </div>


   </main>

   <!-- Footer-->
   <footer id="footer" class="footer">
      <div class="copyright"><strong>Centro Escolar University</span></strong> Office of the University Registrar</div>
      <div class="credits">Manila | Malolos| Makati</div>
      <div class="credits"><small>Mariano R.J. | Gita J.N. | Tuazon M. | Valencia E.C. | Bolasoc R.C. | Anatalio J.</small></div>
   </footer>
   -->
   <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
   <script type="text/javascript" src="https://rawgit.com/DanielHoffmann/jquery-svg-pan-zoom/master/compiled/jquery.svg.pan.zoom.js"></script>
   <script src="resource/js/map-country.js"></script>
   <script src="resource/js/map.js"></script>
   <script src="vendor/js/popper.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   <script src="sweetalert2.all.min.js"></script>
   <script src="vendor/js/bootstrap.min.js"></script>
   <script src="vendor/js/quill.min.js"></script>
   <script src="resource/js/scripts.js"></script>
   <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/jquery.dataTables.js"></script>
   <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
   <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/dataTables.buttons.min.js"></script>
   <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/jszip.min.js"></script>
   <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/pdfmake.min.js"></script>
   <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/vfs_fonts.js"></script>
   <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/buttons.html5.min.js"></script>
   <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/buttons.print.min.js"></script>

   <script>
      AOS.init();
   </script>
   <script>
      setTimeout(function() {
         $('.loader_bg').fadeToggle();
      }, 850);
   </script>

   <script>
      $(document).ready(function(e) {
         
         $(document).on('click', 'path', function(e) {

            var id = ($(this).data('id'));

            $.ajax({
               type: 'POST',
               url: '/caveportal/resource/controllers/studreport.php',
               data: {
                  id: id
               },
               success: function(response) {
                  $('.card-body').html(response);
                  $('.card-body1').hide();
                  $('.map').hide();

               },

               error: function(textStatus, errorThrown) {
                  console.log(textStatus, errorThrown);
               }
            });
         });
      });
   </script>



</body>

</html>