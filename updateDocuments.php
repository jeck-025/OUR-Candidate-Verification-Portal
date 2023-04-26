<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/caveportal/resource/php/class/core/init.php';
isLogin();
$user = new user();
isClient($user->data()->groups);


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
    <link href="resource/css/updatedocuments.css" rel="stylesheet" />
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Kiwi+Maru:wght@300;500&display=swap" rel="stylesheet">
    <link href="vendor/css/style.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">



</head>

<body class="d-flex flex-column h-100">
    <header id="header" class="header fixed-top d-flex align-items-center" data-aos="fade-right" data-aos-duration="1000">
        <div class="d-flex align-items-center justify-content-between">
            <i class="bi bi-list toggle-sidebar-btn mx-3"></i>
            <a href="clientdash" class="logo d-flex align-items-center"> <img src="resource/img/CAVElogo.png" alt="">
                <span class="d-none d-lg-block">Admin</span> </a>
        </div>
    </header>
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item"> <a class="nav-link " href="clientdash"> <i class="bi bi-grid"></i><span>My Dashboard</span></a></li>
            <li class="nav-heading">Options</li>
            <li class="nav-item"> <a class="nav-link collapsed" href="clientprofile"> <i class="bi bi-person"></i> <span>My Profile</span> </a></li>
            <li class="nav-item"> <a class="nav-link collapsed" href="logout"> <i class="bi bi-box-arrow-in-right"></i> <span>Log out</span> </a></li>
        </ul>
    </aside>
    <main id="main" class="main">
        <div class="pagtitle" data-aos="fade-right" data-aos-duration="1000">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="clientdash">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>

            <section class="section dashboard" data-aos="fade-right" data-aos-duration="1000">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="card recent-sales overflow-auto">

                                    <div class="card-body">
                                        <h5 class="card-title">Update Form<span> | Today</span></h5>

                                        <form action="" method="POST" class="" enctype="multipart/form-data">
                                            <?php
                                            if (!empty($_POST)) {
                                                $update = new updatedoc($_GET['updatedoc'], $_FILES['diploma'], $_FILES['consent'], $_FILES['validID']);
                                            }
                                            ?>

                                            <div class="row py-2">
                                                <div class="form-group col-md-4">
                                                    <h5 class="text-start mt-2 mb-3" for="diploma">Upload Documents <br /><span class="diploma-title">(Please provide either of the following (TOR, Diploma) to as proof of authenticity.)</span></h5>
                                                    <h6 class="text-start mt-2 mb-3"><span class="diploma-title">File not a PDF Type? You may convert your file through here. <a class="converterlink" href="https://www.freepdfconvert.com/"><b>PDF Converter</b></a></span></h6>

                                                    <input id="diploma" class="form-control" accept=".pdf" type="file" name="diploma">
                                                    <small class="text-muted">
                                                        *Please ensure the correctness of the pdf file. Incorrect requirements uploaded may <b>result to forfeiting of your application.</b></em></b></small>

                                                </div>

                                                <div class="form-group col-md-4">
                                                    <h5 class="text-start mt-2 mb-3" for="consent">Consent Form <br /><span class="diploma-title">(Please provide a consent form from the candidate. Must be a PDF File)</span></h5>
                                                    <h6 class="text-start mt-2 mb-3"><span class="diploma-title">File not a PDF Type? You may convert your file through here. <a class="converterlink" href="https://www.freepdfconvert.com/"><b>PDF Converter</b></a></span></h6>
                                                    <input id="consent" class="form-control" accept=".pdf" type="file" name="consent">
                                                    <p>
                                                        <small class="text-muted" style="font-size: 60%;"><b>In accordance to Republic Act 10173 – Data Privacy Act of 2012</b><br />-By submitting this form, I am giving my consent to CEU to process my personal and sensitive information.
                                                            <br /> -By submitting this form, I also signify that I have read, understood and hereby state that everything stated above are true and correct.
                                                        </small>
                                                    </p>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <h5 class="text-start mt-2 mb-3" for="validID">Valid ID of the Candidate<br /><span class="diploma-title">(Please provide the valid ID of the candidate. Must be a image file)</span></h5>
                                                    <h6 class="text-start mt-2 mb-3"><span class="diploma-title">Must be an image file. Can be any of the following <b>JPEG or PNG</b></span></h6>
                                                    <input id="validID" class="form-control mt-3" accept=".pdf" type="file" name="validID">
                                                    <p>
                                                        <small class="text-muted"><b>
                                                                * Make sure to follow the instructions on the previous page.<br /></em></b></small>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="row border-top py-3 justify-content-start">
                                                <div class="form-group col-md-2">
                                                    <input type="hidden" name="Token" value="<?php echo Token::generate(); ?>" />
                                                    <button type="submit" id="myButton1" class="submit_btn btn-md" value="Submit Application">
                                                        Submit Application
                                                    </button>
                                                </div>
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
"><small>Tuazon M.</small></a> | <a href="https://port-seventeen.com/evalencia/portfolio/"><small>Valencia E.C.</small></a> | <small>Bolasoc R.C.</small></div>
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
    <script src="sweetalert2.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script src="resource/js/actions.js"></script>
    <script>
        AOS.init();
    </script>



</body>

</html>