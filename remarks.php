<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/caveportal/resource/php/class/core/init.php';
isLogin();
$user = new user();
isAdmin($user->data()->groups);
$viewtable = new viewtable();

$did = $_GET['denied'];

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
    <link href="resource/css/remarks.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="vendor/img/favicon.png" rel="icon">
    <link href="resource/img/tab-icon.png" rel="icon">
    <link href="vendor/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="vendor/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/css/bootstrap-icons.css" rel="stylesheet">
    <link href="vendor/css/boxicons.min.css" rel="stylesheet">
    <link href="vendor/css/quill.bubble.css" rel="stylesheet">
    <link href="vendor/css/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="sweetalert2.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Kiwi+Maru:wght@300;500&display=swap" rel="stylesheet">
    <link href="vendor/css/style.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">



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
            <li class="nav-item"> <a class="nav-link collapsed" href="register"> <i class="bi bi-person"></i>
                    <span>Client Registration</span> </a></li>
            <li class="nav-item"> <a class="nav-link collapsed" href="logout"> <i class="bi bi-box-arrow-in-right"></i> <span>Log out</span> </a></li>
        </ul>
    </aside>
    <main id="main" class="main">
        <div class="pagtitle" data-aos="fade-right" data-aos-duration="1000">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="admindash">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>

            <section class="section dashboard" data-aos="fade-right" data-aos-duration="1000">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="card recent-sales overflow-auto">
                                    <div class="filter">
                                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                            <li class="dropdown-header text-start">
                                                <h6>Filter</h6>
                                            </li>
                                            <li><a class="dropdown-item" href="#">Today</a></li>
                                            <li><a class="dropdown-item" href="#">This Month</a></li>
                                            <li><a class="dropdown-item" href="#">This Year</a></li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Remarks Form<span> | Today</span></h5>

                                        <form id="remarks-dialog" action="" method="POST">
                                            <h2 class="text-start mb-1">INSERT REMARKS</h2>
                                            <small class="text-muted">Please state the reason why the Application is has
                                                placed ON-HOLD or DENIED</small>
                                            <?php
                                            // if (!empty($_POST)) {
                                            //     holdRemarks();
                                            // }
                                            ?>
                                            <div class="form-floating col-md-10 mt-3">
                                                <input id="remarks" name="remarks" id="floatingInput" class="form-control" type="text" placeholder="Enter Remarks"></textarea>
                                                <label for="floatingInput">Enter Remarks</label>

                                                <input type="hidden" id="did" name="token" value="<?php echo $did; ?>">
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <button type="submit" name="submit" class="btn my-5" onclick="confirmDenied()">Submit
                                                    Remarks</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
    <script src="resource/js/scripts.js"></script>
    <script src="vendor/js/popper.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="vendor/js/bootstrap.min.js"></script>
    <script src="vendor/js/apexcharts.min.js"></script>
    <script src="vendor/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/js/chart.min.js"></script>
    <script src="vendor/js/echarts.min.js"></script>
    <script src="vendor/js/quill.min.js"></script>
    <script src="vendor/js/tinymce.min.js"></script>
    <script src="vendor/js/validate.js"></script>
    <script src="vendor/js/main.js"></script>
    <script src="vendor/js/jquery.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="resource/js/actions.js"></script>
    <script>
        AOS.init();
    </script>



</body>

</html>
