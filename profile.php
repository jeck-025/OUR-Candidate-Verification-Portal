<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/caveportal/resource/php/class/core/init.php';
isLogin();
$user = new user();
isAdmin($user->data()->groups);
$view = new view();
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@500&display=swap" rel="stylesheet">
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
            <li class="nav-heading">Current Date and Time</li>
            <h5 class='text-center'><?php include 'clock.php'; ?></h5>
            <hr>
            <li class="nav-heading">Verifications</li>
            <li class="nav-item"> <a class="nav-link " href="admindash"> <i class="bi bi-grid"></i><span>Dashboard</span></a></li>
            <li class="nav-item"> <a class="nav-link collapsed " href="admindash-prev-app.php"> <i class="bi bi-grid"></i> <span>All Previous Verifications</span> </a></li>
            <li class="nav-heading">Options</li>
            <li class='nav-item'> <a class='nav-link collapsed' href='changepassm.php'><i class='bi bi-key-fill'></i><span> Change Password </span> </a></li>
            <li class="nav-item"> <a class="nav-link collapsed" href="logout"> <i class="bi bi-box-arrow-in-right"></i> <span>Log out</span> </a></li>
        </ul>
    </aside>
    <main id="main" class="main">
        <div class="pagtitle" data-aos="fade-right" data-aos-duration="1000">
            <h1 class="p-3 mt-3">User Profile</h1>
            <section class="section dashboard" data-aos="fade-right" data-aos-duration="1000">
                <div class="row px-5 d-flex justify-content-center">
                    <div class="col-md-12 pb-3 ">
                        <div class="card pt-5 ">
                            <div class="card-body report">
                                <form method="POST">
                                <?php if ($_POST && isset($_POST['form1'])) {updateProfile();}?>
                                <h2 class="text-center"><i class="bi bi-person-circle"></i> Profile Details</h2><hr>
                                    <div class="row d-flex justify-content-center py-3">
                                        <div class="col-lg-3 col-md-4 label">Username</div>
                                        <div class="col-lg-3 col-md-4"><?php echo $user->data()->username ?></div>
                                    </div>
                                    <div class="row d-flex justify-content-center py-3"">
                                        <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                        <div class="col-lg-3 col-md-4"><?php echo $user->data()->fullName ?></div>
                                    </div>
                                    <div class="row d-flex justify-content-center py-3"">
                                        <div class="col-lg-3 col-md-4 label">Date Joined</div>
                                        <div class="col-lg-3 col-md-4"><?php echo $user->data()->joined ?></div>
                                    </div>
                                    <div class="row d-flex justify-content-center py-3"">
                                        <div class="col-lg-3 col-md-4 label">Email Address</div>
                                        <div class="col-lg-3 col-md-4"> <input name="email" type="text" class="form-control" id="Email" value="<?php echo escape($user->data()->email); ?>" placeholder="Email Address" autocomplete="off"></div>
                                    </div>
                                    <div class="row d-flex justify-content-center py-3"">
                                        <div class="col-lg-3 col-md-4 label">Campus</div>
                                        <div class="col-lg-3 col-md-4"> 
                                            <select class="form-control form-select" name="campus" value = "">
                                                <?php 
                                                    $campus = $user->data()->mm;
                                                    $view->curCampus($campus);
                                                    $view->campuses(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center py-3"">
                                        <div class="col-md-4 d-flex justify-content-center"> 
                                            <button type="submit" name="form1" class="btn btn-open mx-1"><i class="bi bi-pencil-square"></i> Save Changes</button>
                                            <!-- <button class="btn btn-open mx-1" href="changepassm"><i class="bi bi-key-fill"></i> Change Password </button> -->
                                            <button class="btn btn-open mx-1" href="admindash"><i class="bi bi-box-arrow-left"></i> Cancel </button> </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
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
    <script src="resource/js/scripts.js"></script>
</body>
</html>
