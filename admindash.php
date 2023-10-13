<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/caveportal/resource/php/class/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/caveportal/vendor/sendmail.php';
isLogin();
$user = new user();
isAdmin($user->data()->groups);
$view = new view();
$viewtable = new viewtable();
$mailer = new mailer();
$adduser = new addAccount();
$ovr = new ovReport();

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
            <li class="nav-item"> <a class="nav-link " href="admindash"> <i class="bi bi-grid"></i> <span>My
                        Dashboard</span> </a></li>
            <li class="nav-heading">Options</li>
            <li class="nav-item"> <a class="nav-link collapsed" href="logs"> <i class="bi bi-bar-chart"></i>
                    <span>Reports</span> </a></li>
            <li class="nav-item"> <a class="nav-link collapsed" href="mapreport"> <i class="bi bi-pin-map"></i><span>CAVE Map</span> </a></li>
            
        <!-- ADVANCED OPTIONS ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
            <?php
                if($user->data()->username == 'jeck'){
                    echo "<li class='nav-item'> <a class='nav-link collapsed btn' data-toggle='modal' data-target='#mailerconfig'> <i class='bi bi-envelope'></i><span> Mailer Configuration</span> </a></li>";
                    echo "<li class='nav-item'> <a class='nav-link collapsed btn' data-toggle='modal' data-target='#acctconfig'> <i class='bi bi-person-circle'></i><span> Account Management</span> </a></li>";
                }
            ?>

            <div class="modal fade" id="mailerconfig" tabindex="-1" aria-labelledby="mailerconfigLabel" aria-hidden="true" data-backdrop="false">
                <div class="modal-dialog modal-xl mailerconfig-modal">
                    <div class="modal-content shadow p-3 mb-5 bg-white rounded">
                        <div class="modal-header mailer-config-header">
                            <h5 class="modal-title" id="mailerconfigLabel"><i class='bi bi-envelope'></i> Mailer Configuration</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="close-btn">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method='post'>
                                <div class='form-group'>
                                    <?php
                                        $mailerData = $mailer->viewConfigMailer();
                                        $mailerUsername = $mailerData[0];
                                        $mailerPassword = $mailerData[1];
                                        $mailerPlatform = $mailerData[2];
                                        $mailerPort = $mailerData[3];

                                        $mailerDataMKT = $mailer->viewConfigMailerMKT();
                                        $mailerUsernameMKT = $mailerDataMKT[0];
                                        $mailerPasswordMKT = $mailerDataMKT[1];
                                        $mailerPlatformMKT = $mailerDataMKT[2];
                                        $mailerPortMKT = $mailerDataMKT[3];

                                        $mailerDataMLS = $mailer->viewConfigMailerMLS();
                                        $mailerUsernameMLS = $mailerDataMLS[0];
                                        $mailerPasswordMLS = $mailerDataMLS[1];
                                        $mailerPlatformMLS = $mailerDataMLS[2];
                                        $mailerPortMLS = $mailerDataMLS[3];
                                    ?>
                                    <div class="row d-flex justify-content-center">
                                        <div class="card col-md-3 m-3 pb-4">
                                            <div class="row d-flex justify-content-center">
                                                <div class="mailer-config-header py-2">
                                                    Manila
                                                </div>
                                                <div class="row">
                                                    <label for="mailer-username" class="form-label mt-2 mb-0">Username</label>
                                                    <input type="text" id="mailer-username" name="mailer-username" class="form-control" autocomplete="off" value="<?php echo "$mailerUsername"; ?>" required>
                                                </div>
                                                <div class="row">
                                                    <label for="mailer-password" class="form-label mt-2 mb-0">App Password</label>
                                                    <input type="password" id="mailer-password" name="mailer-password" class="form-control" autocomplete="off" value="<?php echo "$mailerPassword"; ?>" required>
                                                </div>
                                                <div class="row">
                                                    <label for="mailer-platform" class="form-label mt-2 mb-0">Platform</label>
                                                    <input type="text" name="mailer-platform" id="mailer-platform" class="form-control" autocomplete="off" value="<?php echo "$mailerPlatform"; ?>" required>
                                                </div>
                                                <div class="row">
                                                    <label for="mailer-port" class="form-label mt-2 mb-0">Port</label>
                                                    <input type="text" name="mailer-port" id="mailer-port" class="form-control" autocomplete="off" value="<?php echo "$mailerPort"; ?>" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card col-md-3 m-3 pb-4">
                                            <div class="row d-flex justify-content-center">
                                                <div class="mailer-config-header py-2">
                                                    Makati
                                                </div>
                                                <div class="row">
                                                    <label for="mailer-username" class="form-label mt-2 mb-0">Username</label>
                                                    <input type="text" id="mailer-usernameMKT" name="mailer-usernameMKT" class="form-control" autocomplete="off" value="<?php echo "$mailerUsernameMKT"; ?>" required>
                                                </div>
                                                <div class="row">
                                                    <label for="mailer-password" class="form-label mt-2 mb-0">App Password</label>
                                                    <input type="password" id="mailer-passwordMKT" name="mailer-passwordMKT" class="form-control" autocomplete="off" value="<?php echo "$mailerPasswordMKT"; ?>" required>
                                                </div>
                                                <div class="row">
                                                    <label for="mailer-platform" class="form-label mt-2 mb-0">Platform</label>
                                                    <input type="text" name="mailer-platformMKT" id="mailer-platformMKT" class="form-control" autocomplete="off" value="<?php echo "$mailerPlatformMKT"; ?>" required>
                                                </div>
                                                <div class="row">
                                                    <label for="mailer-port" class="form-label mt-2 mb-0">Port</label>
                                                    <input type="text" name="mailer-portMKT" id="mailer-portMKT" class="form-control" autocomplete="off" value="<?php echo "$mailerPortMKT"; ?>" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card col-md-3 m-3 pb-4">
                                            <div class="row d-flex justify-content-center">
                                                <div class="mailer-config-header py-2">
                                                    Malolos
                                                </div>
                                                <div class="row">
                                                    <label for="mailer-username" class="form-label mt-2 mb-0">Username</label>
                                                    <input type="text" id="mailer-usernameMLS" name="mailer-usernameMLS" class="form-control" autocomplete="off" value="<?php echo "$mailerUsernameMLS"; ?>" required>
                                                </div>
                                                <div class="row">
                                                    <label for="mailer-password" class="form-label mt-2 mb-0">App Password</label>
                                                    <input type="password" id="mailer-passwordMLS" name="mailer-passwordMLS" class="form-control" autocomplete="off" value="<?php echo "$mailerPasswordMLS"; ?>" required>
                                                </div>
                                                <div class="row">
                                                    <label for="mailer-platform" class="form-label mt-2 mb-0">Platform</label>
                                                    <input type="text" name="mailer-platformMLS" id="mailer-platformMLS" class="form-control" autocomplete="off" value="<?php echo "$mailerPlatformMLS"; ?>" required>
                                                </div>
                                                <div class="row">
                                                    <label for="mailer-port" class="form-label mt-2 mb-0">Port</label>
                                                    <input type="text" name="mailer-portMLS" id="mailer-portMLS" class="form-control" autocomplete="off" value="<?php echo "$mailerPortMLS"; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <li class='actions-mailer-config'>    
                            <button type="button" id="mailer_info_close" class="btn btn-sm" data-dismiss="modal">Close
                                <div class='icon'>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M20 3H4c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2zM4 19V7h16l.001 12H4z"></path><path d="m15.707 10.707-1.414-1.414L12 11.586 9.707 9.293l-1.414 1.414L10.586 13l-2.293 2.293 1.414 1.414L12 14.414l2.293 2.293 1.414-1.414L13.414 13z"></path></svg>
                                </div>
                            </button>
                            </li>
                            <li class='actions-mailer-config'>     
                                <button type="submit" id="mailer_info_update" class="btn btn-sm">Save
                                    <div class='icon'>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M5 21h14a2 2 0 0 0 2-2V8a1 1 0 0 0-.29-.71l-4-4A1 1 0 0 0 16 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2zm10-2H9v-5h6zM13 7h-2V5h2zM5 5h2v4h8V5h.59L19 8.41V19h-2v-5a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v5H5z"></path></svg>
                                    </div>
                                </button>
                            </li>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="acctconfig" tabindex="-1" aria-labelledby="acctconfigLabel" aria-hidden="true" data-backdrop="false">
                <div class="modal-dialog modal-md mailerconfig-modal">
                    <div class="modal-content shadow p-3 mb-5 bg-white rounded">
                        <div class="modal-header mailer-config-header">
                            <h5 class="modal-title" id="mailerconfigLabel"><i class="bi bi-people-fill"></i> Create a new User Account </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="close-btn">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" id="r_form">
                                <div class='form-group'>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-md-9">
                                            <label for="userName" class="form-label mt-2 mb-0">Account Username</label>
                                            <input type="text" id="userName" name="userName" class="form-control" autocomplete="off" required>
                                            <p><i><small>Auto-generated password will be received via email.</small></i></p>
                                        </div>
                                        <div class="col-md-9">
                                            <label for="fullName" class="form-label mt-2 mb-0">Full Name</label>
                                            <input type="text" id="fullName" name="fullName" class="form-control" autocomplete="off" required>
                                        </div>
                                        <div class="col-md-9">
                                            <label for="email" class="form-label mt-2 mb-0">Email Address</label>
                                            <input type="email" id="email" name="email" class="form-control" autocomplete="off" required>
                                        </div>
                                        <div class="col-md-9">
                                            <label for="company" class="form-label mt-2 mb-0">Company</label>
                                            <input type="text" name="company" id="company" class="form-control" autocomplete="off" required>
                                        </div>
                                        <div class="col-md-9">
                                            <label for="job_position" class="form-label mt-2 mb-0">Department</label>
                                            <input type="text" name="job_position" id="job_position" class="form-control" autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <li class='actions-mailer-config'>    
                            <button type="button" class="btn btn-sm" data-dismiss="modal">Close
                                <div class='icon'>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M20 3H4c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2zM4 19V7h16l.001 12H4z"></path><path d="m15.707 10.707-1.414-1.414L12 11.586 9.707 9.293l-1.414 1.414L10.586 13l-2.293 2.293 1.414 1.414L12 14.414l2.293 2.293 1.414-1.414L13.414 13z"></path></svg>
                                </div>
                            </button>
                            </li>
                            <li class='actions-mailer-config'>     
                                <button type="submit" class="btn btn-sm">Create
                                    <div class='icon'>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M5 21h14a2 2 0 0 0 2-2V8a1 1 0 0 0-.29-.71l-4-4A1 1 0 0 0 16 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2zm10-2H9v-5h6zM13 7h-2V5h2zM5 5h2v4h8V5h.59L19 8.41V19h-2v-5a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v5H5z"></path></svg>
                                    </div>
                                </button>
                            </li>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        <!-- ADVANCED OPTIONS END ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->

            <li class="nav-item"> <a class="nav-link collapsed" href="logout"> <i class="bi bi-box-arrow-in-right"></i>
                    <span>Log out</span> </a></li>
        </ul>
    </aside>
    <main id="main" class="main">
        <?php
            if(!empty($_POST['mailer-username']) && !empty($_POST['mailer-password'])){
                $mailer = new mailer($_POST['mailer-username'], $_POST['mailer-password'], $_POST['mailer-port'], $_POST['mailer-platform'],
                                        $_POST['mailer-usernameMKT'], $_POST['mailer-passwordMKT'], $_POST['mailer-portMKT'], $_POST['mailer-platformMKT'],
                                        $_POST['mailer-usernameMLS'], $_POST['mailer-passwordMLS'], $_POST['mailer-portMLS'], $_POST['mailer-platformMLS']);
                $mailer->updateMailerConfig(); 
                ?>

                <!-- <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><i class="bi bi-check-circle"></i> Mailer Configuration Updated</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div> -->

                <script> 
                    alert('Mailer Configuration Updated');
                    location.replace('admindash.php'); 
                </script>

        <?php }
            if(!empty($_POST['email'])){
                $adduser = new addAccount($_POST['userName'], $_POST['fullName'], $_POST['email'], $_POST['company'], $_POST['job_position']);
                $adduser->createUser(); ?>
                
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><i class="bi bi-person-check-fill"></i> User Account Created. Password will be received via email.</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        <?php } ?>

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
                                                echo "<a class='nav-link active' href='admindash?date=".$_GET['date']."&month_btn=Submit' type='button' role='tab' aria-controls='pills-home' aria-selected='true'>Pending Verifications <span class='badge active'>";
                                            }else{
                                                echo "<a class='nav-link active' href='admindash' type='button' role='tab' aria-controls='pills-home' aria-selected='true'>Pending Verifications <span class='badge active'>";
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
                                                echo "<a class='nav-link' href='onholddash?date=".$_GET['date']."' type='button' role='tab' aria-controls='pills-profile' aria-selected='true'>On-Hold Verifications <span class='badge'>";
                                            }else{
                                                echo "<a class='nav-link' href='onholddash' type='button' role='tab' aria-controls='pills-profile' aria-selected='true'>On-Hold Verifications <span class='badge'>";
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
                                            $viewtable->viewPendingData($year, $month);
                                        } else {
                                            $viewtable->viewAllPendingData();
                                        }
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