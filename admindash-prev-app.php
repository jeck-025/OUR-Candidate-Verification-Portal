<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/caveportal/resource/php/class/core/init.php';
isLogin();
$user = new user();
isAdmin($user->data()->groups);
$view = new view();
$viewtable = new viewtable();
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
    <link rel="stylesheet" type="text/css" href="vendor/css/bootstrap-select.min.css">
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@500&display=swap" rel="stylesheet">
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
            <a href="locker.php?landing=admindash-prev-app" class="btn btn-sm <?php $locker->lockerButtonClr(); ?>">
            <?php $locker->lockerButton(); ?></a>
            <a href="lockerM.php?landing=admindash-prev-app" class="btn btn-sm <?php $locker->lockerMButtonClr(); ?>">
            <?php $locker->lockerMButton(); ?></a>
            </div>
            <hr>
            <?php } ?>
            
            <li class="nav-heading">Verifications</li>
            <li class="nav-item"> <a class="nav-link collapsed" href="admindash"> <i class="bi bi-grid"></i> <span>My Dashboard</span> </a></li>
            <li class="nav-item"> <a class="nav-link" href="admindash-prev-app.php?view=legacy"> <i class="bi bi-grid"></i> <span>All Previous Verifications</span> </a></li>
            <li class="nav-heading">Options</li>
            <li class="nav-item"> <a class="nav-link collapsed" href="logs"> <i class="bi bi-bar-chart"></i><span>Reports</span> </a></li>
            <li class="nav-item"> <a class="nav-link collapsed" href="mapreport"> <i class="bi bi-pin-map"></i><span>CAVE Map</span> </a></li>
            <li class='nav-item'> <a class='nav-link collapsed' href='changepassm.php'><i class='bi bi-key-fill'></i><span> Change Password </span> </a></li>
            <li class="nav-item"> <a class="nav-link collapsed" href="logout"> <i class="bi bi-box-arrow-in-right"></i><span>Log out</span> </a></li>
        </ul>
    </aside>
    <main id="main" class="main">
        <div class="pagtitle pt-3 pb-3" data-aos="fade-in" data-aos-duration="1000">
            <h1>Dashboard</h1>
        </div>
        <section class="section dashboard" data-aos="fade-in" data-aos-duration="1000">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">
                                <ul class="nav nav-pills  nav-justified" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <?php
                                            echo "<a class='nav-link active' href='admindash-prev-app.php' type='button' role='tab' aria-controls='pills-home' aria-selected='true'>Pending Verifications <span class='badge active'>";
                                            echo $view->allPendingCountNAVL();
                                            echo "</span></a>";
                                        ?>
                                    </li>
                                    <li class="nav-item">
                                        <?php
                                            echo "<a class='nav-link' href='approveddash-prev-app.php' type='button' role='tab' aria-controls='pills-home' aria-selected='true'>Approved Verifications <span class='badge'>";
                                            echo $view->allApprovedCountNAVL();
                                            echo "</span></a>";
                                        ?> 
                                    </li>
                                    <li class="nav-item">
                                        <?php
                                            echo "<a class='nav-link' href='onholddash-prev-app.php' type='button' role='tab' aria-controls='pills-profile' aria-selected='true'>On-Hold Verifications <span class='badge'>";
                                            echo $view->allOnHoldCountNAVL();
                                            echo "</span></a>";
                                        ?>
                                    </li>
                                    <li class="nav-item">
                                        <?php
                                            echo "<a class='nav-link' href='denieddash-prev-app.php' type='button' role='tab' aria-controls='pills-profile' aria-selected='true'>Denied Verifications <span class='badge'>";
                                            echo $view->allDeniedCountNAVL();
                                            echo "</span></a>";
                                        ?>
                                    </li>
                                </ul>
                                <div class="card-body">
                                        <?php
                                            $viewtable->viewAllPendingData("legacy");
                                        ?>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <div class="modal fade" id="edit-campus2" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Campus</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updatecampus2" action="" method="POST">
                        <div class="input-group col-md-12">
                            <select id="campus" name="campus" class="selectpicker form-control" title="Select Campus">
                                <?php $view->campuses(); ?>
                            </select>
                        </div>
                        <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <input type=hidden id="id" value="">
                            <input type="hidden" name="Token" value="<?php echo Token::generate(); ?>" />
                            <button type="submit" id="update-btn" class="btn btn-info">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   
    <!-- Footer-->
    <footer id="footer" class="footer">
        <div class="copyright"><strong>Centro Escolar University</span></strong> Office of the University Registrar
        </div>
        <div class="credits">Manila | Malolos| Makati</div>
        <div class="credits"><a href="https://port-seventeen.com/rjmariano/portfolio/"><small>Mariano R.J.</small></a> |
            <a href="https://port-seventeen.com/jngita/portfolio/"><small>Gita J.N.</small></a> | <a href="https://port-seventeen.com/mtuazon/portfolio_tuazon/
"><small>Tuazon M.</small></a> | <a href="https://port-seventeen.com/evalencia/portfolio/"><small>Valencia
                    E.C.</small></a> | <small>Bolasoc R.C.</small> | <small>Anatalio J.</small>
        </div>
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
    <script src="vendor/js/chart.min.js"></script>
    <script src="vendor/js/echarts.min.js"></script>
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
    <script src="resource/js/actions.js"></script>
    <script src="resource/js/update.js"></script>
    <script src="resource/js/verifydegree.js"></script>

</body>
</html>