<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/caveportal/resource/php/class/core/init.php';
isLogin();
$user = new user();
isAdmin($user->data()->groups);
$viewdata = new viewdata();
$view = new view();
$did = $_GET['id'];
$date = date('m/d/Y h:i:s a', time());

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
</head>

<body class="d-flex flex-column h-100">
    <header id="header" class="header fixed-top d-flex align-items-center" data-aos="fade-right" data-aos-duration="1000">
        <div class="d-flex align-items-center justify-content-between">
            <i class="bi bi-list toggle-sidebar-btn mx-3"></i>
            <a href="admindash" class="logo d-flex align-items-center"> <img src="resource/img/CAVElogo.png" alt="">
                <span class="d-none d-lg-block">Admin</span> </a>
        </div>
    </header>
    <aside id="sidebar" class="sidebar" data-aos="fade-right" data-aos-duration="1000">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item"> <a class="nav-link " href="admindash"> <i class="bi bi-grid"></i><span>Dashboard</span></a></li>
            <li class="nav-heading">Options</li>
            <li class="nav-item"> <a class="nav-link collapsed" href="logs"> <i class="bi bi-bar-chart"></i>
                    <span>Reports</span> </a></li>
            <li class="nav-item"> <a class="nav-link collapsed" href="mapreport"> <i class="bi bi-pin-map"></i><span>CAVE Map</span> </a></li>
            <li class="nav-item"> <a class="nav-link collapsed" href="logout"> <i class="bi bi-box-arrow-in-right"></i> <span>Log out</span> </a></li>
        </ul>
    </aside>
    <main id="main" class="main">
        <div class="pagtitle" data-aos="fade-right" data-aos-duration="1000">
            <h1 class="p-3 mt-3">Detailed Information</h1>
            <section class="section dashboard" data-aos="fade-right" data-aos-duration="1000">
                <div class="row px-5">
                    <div class="col-md-12">
                        <div class="row d-flex justify-content-center">
                            <div class="col-12">
                                <div class="card recent-sales overflow-auto">                                    
                                    <div class="card-body">
                                            <h2 class="text-start mb-1">Verification Data</h2>
                                            <?php
                                                $viewdata->viewInfo();
                                            ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
     <div class="modal fade" id="edit-campus" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Campus</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="updatecampus" action="" method="POST">

                        <div class="input-group py-4">
                            <select id="campus" name="campus" class="selectpicker form-control" data-live-search="true" title="Select Campus">
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


    <div class="modal fade" id="verify-degree" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Verified Degree</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="verifydegree" action="" method="POST">

                        <div class="input-group py-4">
                            <!--<select id="vfdegree" name="vfdegree" class="selectpicker form-control" data-live-search="true" title="Select Course">-->
                            <!--    <?php $view->courses(); ?>-->
                            <!--</select>-->
                            <p class="mt-2">Please Enter Verified Course:</p>
                            <input type="text" class="form-control ml-2 vfdegree col-12" id="vfdegree" name="vfdegree" autocomplete="yes">
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

    <div class="modal fade" id="verify-date-grad" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Date Graduated</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="verifydategrad" action="" method="POST">

                        <div class="input-group py-4">
                            <p class="mt-2">Select Date:</p>
                            <input type="date" class="form-control vfdategrad datepicker ml-2" id="vfdategrad" name="vfdategrad">
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

    <div class="modal fade" id="verify-date-att" aria-labelledby="exampleModalLabel3" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Date Last Attended</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="verifydateatt" action="" method="POST">

                        <div class="input-group py-4">
                            <p class="mt-2">Select Date:</p>
                            <input type="date" class="form-control vfdateatt datepicker ml-2" id="vfdateatt" name="vfdateatt">
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

    <div class="modal fade" id="verify-date-ent" aria-labelledby="exampleModalLabel4" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel4">Entrance Date</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="verifydateent" action="" method="POST">

                        <div class="input-group py-4">
                            <p class="mt-2">Select Date:</p>
                            <input type="date" class="form-control vfdateent datepicker ml-2" id="vfdateent" name="vfdateent">
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

    <div class="modal fade" id="verify-name" aria-labelledby="exampleModalLabel5" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel5">Name Verification</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="verifyname" action="" method="POST">

                        <div class="input-group py-4">
                            <p class="mt-2">Please Enter Verified Name:</p>
                            <input type="text" class="form-control ml-2 vfname" id="vfname" name="vfname" autocomplete="no">
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
    <div class="modal fade" id="verify-status" aria-labelledby="exampleModalLabel6" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel6">Verify Status</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="verifystatus" action="" method="POST">

                        <div class="input-group py-4">
                            <select id="vfeducstatus" name="vfeducstatus" class="selectpicker form-control" data-live-search="true" title="Set Status">
                                <option value="UG">Undergraduate</option>
                                <option value="G">Graduate</option>
                                <!-- <option value="">-Reset Field-</option> -->
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

    <div class="modal fade" id="verify-entsem" aria-labelledby="exampleModalLabel7" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel7">Entrance School Year and Sem</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="verifyentsem" action="" method="POST">

                        <div class="input-group col-md-12" style="line-height: 32px;">
                            <select id="vfEsem" name="vfEsem" class="selectpicker form-control" title="Select Semester">
                                <option value="1">First</option>
                                <option value="2">Second</option>
                                <option value="3">Summer</option>
                            </select>
                        <input type="text" class="form-control ml-2 vfEsy mb-3" id="vfEsy" name="vfEsy" autocomplete="no" placeholder="School Year (xxxx-xxxx)">
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

    <div class="modal fade" id="verify-endsem" aria-labelledby="exampleModalLabel8" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel8">Last Attended School Year and Sem</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="verifyendsem" action="" method="POST">

                        <div class="input-group py-4" style="line-height: 32px;">
                            <select id="vfLsem" name="vfLsem" class="selectpicker form-control" title="Select Semester">
                                <option value="1">First</option>
                                <option value="2">Second</option>
                                <option value="3">Summer</option>
                            </select>
                        <input type="text" class="form-control ml-2 vfLsy" id="vfLsy" name="vfLsy" autocomplete="no" placeholder="School Year (xxxx-xxxx)">
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

    <div class="modal fade" id="verify-checker" aria-labelledby="exampleModalLabel9" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel9">Checker</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="verifychecker" action="" method="POST">

                        <div class="input-group py-4" style="line-height: 32px;">
                            <select id="cname" name="cname" class="selectpicker form-control" title="Select Checker">
                                <?php $view->checker(); ?>
                            </select>
                        </div>
                        <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <input type=hidden id="date_checked" value="<?php echo $date; ?>">
                            <input type=hidden id="id" value="">
                            <input type="hidden" name="Token" value="<?php echo Token::generate(); ?>" />
                            <button type="submit" id="update-btn" class="btn btn-info">Save</button>

                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>



    <footer id="footer" class="footer">
        <div class="copyright"><strong>Centro Escolar University</span></strong> Office of the University Registrar</div>
        <div class="credits">Manila | Malolos| Makati</div>
        <div class="credits"><a href="https://port-seventeen.com/rjmariano/portfolio/"><small>Mariano R.J.</small></a> | <a href="https://port-seventeen.com/jngita/portfolio/"><small>Gita J.N.</small></a> | <a href="https://port-seventeen.com/mtuazon/portfolio_tuazon/
"><small>Tuazon M.</small></a> | <a href="https://port-seventeen.com/evalencia/portfolio/"><small>Valencia E.C.</small></a> | <small>Bolasoc R.C.</small> | <small>Anatalio J.</small></div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/js/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
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
    <!-- update campus JS File -->
    <script src="resource/js/update.js"></script>
    <script src="resource/js/verifydegree.js"></script>
    <script src="resource/js/verifydategrad.js"></script>
    <script src="resource/js/verifydateatt.js"></script>
    <script src="resource/js/verifydateent.js"></script>
    <script src="resource/js/verifyname.js"></script>
    <script src="resource/js/setstatus.js"></script>

</body>

</html>
