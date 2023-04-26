<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/caveportal/resource/php/class/core/init.php';
isLogin();
$view = new view;
$user = new user();


?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta content="width=device-width, initial-scale=1.0" name="viewport">
   <title>Users / Profile - Admin Bootstrap Template</title>
   <meta name="robots" content="noindex, nofollow">
   <meta content="" name="description">
   <meta content="" name="keywords">
   <meta http-equiv="refresh" content="300; url=login">
   <link rel="icon" type="image/x-icon" href="assets/logo_icon.ico" />
   <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
   <link href="resource/css/clientdash.css" rel="stylesheet" />
   <link href="vendor/css/all.css" rel="stylesheet">
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="resource/img/tab-icon.png" rel="icon">
   <link href="vendor/img/apple-touch-icon.png" rel="apple-touch-icon">
   <link href="vendor/img/favicon.png" rel="icon">
   <link href="resource/img/favcave.ico" rel="icon">
   <link href="https://fonts.gstatic.com" rel="preconnect">
   <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   <link href="vendor/css/bootstrap-icons.css" rel="stylesheet">
   <link href="vendor/css/boxicons.min.css" rel="stylesheet">
   <link href="vendor/css/quill.snow.css" rel="stylesheet">
   <link href="vendor/css/quill.bubble.css" rel="stylesheet">
   <link href="vendor/css/remixicon.css" rel="stylesheet">
   <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
   <link href="vendor/css/simple-datatables.css" rel="stylesheet">
   <link href="vendor/css/style.css" rel="stylesheet">
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <link rel="stylesheet" href="sweetalert2.min.css">
   <script src="sweetalert2.min.js"></script>
   <script src="sweetalert2.all.min.js"></script>
</head>

<body class="d-flex flex-column h-100">

   <header id="header" class="header fixed-top d-flex align-items-center">
      <div class="d-flex align-items-center justify-content-between"><i class="bi bi-list toggle-sidebar-btn mx-3"></i> <a href="clientdash" class="logo d-flex align-items-center"> <img src="resource/img/CAVElogo.png" alt=""> <span class="d-none d-lg-block">Client</span> </a> </div>
   </header>
   <aside id="sidebar" class="sidebar">
      <ul class="sidebar-nav" id="sidebar-nav">
         <li class="nav-item"> <a class="nav-link collapsed" href="clientdash"> <i class="bi bi-grid"></i> <span>My Dashboard</span> </a></li>
         <li class="nav-heading">Options</li>
         <li class="nav-item"> <a class="nav-link " href="clientprofile"> <i class="bi bi-person"></i> <span>My Profile</span> </a></li>
         <li class="nav-item"> <a class="nav-link collapsed" href="logout"> <i class="bi bi-box-arrow-in-right"></i> <span>Log out</span> </a></li>
      </ul>
   </aside>
   <main id="main" class="main">
      <div class="pagetitle" data-aos="fade-in" data-aos-duration="1000">
         <h1>Profile</h1>
         <nav>
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="clientdash">Home</a></li>
               <li class="breadcrumb-item active"><a href="clientprofile">Profile</a></li>
            </ol>
         </nav>
      </div>
      <section class="section profile" id="section-profile" data-aos="fade-in" data-aos-duration="1000">
         <div class="row">
            <div class="col-xl-8">
               <div class="card">
                  <div class="card-body pt-3">
                     <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                           <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#profile-overview" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Overview</button>
                        </li>
                        <li class="nav-item" role="presentation">
                           <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#profile-edit" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</button>
                        </li>
                        <li class="nav-item" role="presentation">
                           <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#profile-change-password" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Change Password</button>
                        </li>
                     </ul>
                     <div class="tab-content pt-2">
                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                           <h5 class="card-title">About</h5>
                           <p class="small fst-italic">This displays the profile Information of CAVE Portal Users</p>
                           <h5 class="card-title">Profile Details</h5>
                           <div class="row">
                              <div class="col-lg-3 col-md-4 label">User ID</div>
                              <div class="col-lg-9 col-md-8"><?php echo $user->data()->id ?></div>
                           </div>
                           <div class="row">
                              <div class="col-lg-3 col-md-4 label">Username</div>
                              <div class="col-lg-9 col-md-8"><?php echo $user->data()->username ?></div>
                           </div>
                           <div class="row">
                              <div class="col-lg-3 col-md-4 label ">Full Name</div>
                              <div class="col-lg-9 col-md-8"><?php echo $user->data()->fullName ?></div>
                           </div>
                           <div class="row">
                              <div class="col-lg-3 col-md-4 label ">Company</div>
                              <div class="col-lg-9 col-md-8"><?php echo $user->data()->company ?></div>
                           </div>
                           <div class="row">
                              <div class="col-lg-3 col-md-4 label ">Job Position</div>
                              <div class="col-lg-9 col-md-8"><?php echo $user->data()->job_position ?></div>
                           </div>
                           <div class="row">
                              <div class="col-lg-3 col-md-4 label">Email Address</div>
                              <div class="col-lg-9 col-md-8"><?php echo $user->data()->email ?></div>
                           </div>
                           <div class="row">
                              <div class="col-lg-3 col-md-4 label">Date Joined</div>
                              <div class="col-lg-9 col-md-8"><?php echo $user->data()->joined ?></div>
                           </div>

                        </div>
                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                           <form method="POST">
                              <?php
                              if ($_POST && isset($_POST['form1'])) {
                                 updateProfile();
                              }
                              ?>
                              <div class="row mb-3">
                                 <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                 <div class="col-md-8 col-lg-9"> <input name="username" type="text" class="form-control" id="username" value="<?php echo escape($user->data()->username); ?>" autocomplete="no" placeholder="Username"></div>
                              </div>
                              <div class="row mb-3">
                                 <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                 <div class="col-md-8 col-lg-9"> <input name="fullName" type="text" class="form-control" id="fullName" value="<?php echo escape($user->data()->fullName); ?>" placeholder="Full Name"></div>
                              </div>
                              <div class="row mb-3">
                                 <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                 <div class="col-md-8 col-lg-9"> <input name="email" type="text" class="form-control" id="Email" value="<?php echo escape($user->data()->email); ?>" placeholder="Email Address"></div>
                              </div>
                              <div class="row mb-3">
                                 <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
                                 <div class="col-md-8 col-lg-9"> <input name="company" type="text" class="form-control" id="company" value="<?php echo escape($user->data()->company); ?>" placeholder="Company"></div>
                              </div>
                              <div class="text-center">
                                 <input type="hidden" name="Token" value="<?php echo Token::generate(); ?>" />
                                 <input type="submit" name="form1" class="btn btn-primary" value="Save Changes">
                                 <a class="btn btn-danger" href="clientdash">Cancel</a>
                              </div>

                           </form>
                        </div>

                        <div class="tab-pane fade pt-3" id="profile-change-password">
                           <form method="POST">
                              <?php
                              if ($_POST && isset($_POST['form2'])) {
                                 changeP();
                              }
                              ?>

                              <div class="row mb-3">
                                 <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                 <div class="col-md-8 col-lg-9"> <input name="password_current" type="password" class="form-control" value="<?php echo Input::get('password_current'); ?>" id="currentPassword"></div>
                              </div>
                              <div class="row mb-3">
                                 <label for="password" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                 <div class="col-md-8 col-lg-9">
                                    <input name="password" type="password" class="form-control" value="<?php echo Input::get('password'); ?>" id="password">

                                 </div>
                              </div>
                              <div class="row mb-3">
                                 <label for="ConfirmPassword" class="col-md-4 col-lg-3 col-form-label">Confirm Password</label>
                                 <div class="col-md-8 col-lg-9"> <input name="ConfirmPassword" type="password" class="form-control" id="renewPassword" value="<?php echo Input::get('ConfirmPassword'); ?>">
                                 </div>
                              </div>
                              <div class="text-center">
                                 <input type="hidden" name="Token" value="<?php echo Token::generate(); ?>" />
                                 <input type="submit" class="btn btn-primary" name="form2" value="Change Password">
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </main>
   <footer id="footer" class="footer">
      <div class="copyright"><strong>Centro Escolar University</span></strong> Office of the University Registrar</div>
      <div class="credits">Manila | Malolos| Makati</div>
      <div class="credits"><small>Mariano R.J. | Gita J.N. | Tuazon M. | Valencia E.C. | Bolasoc R.C.</small></div>
   </footer>
   <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
   <script>
      setTimeout(function() {
         $('.loader_bg').fadeToggle();
      }, 850);
   </script>
   <script>
      src = "vendor/js/scripts.js"
   </script>
   <script src="vendor/js/apexcharts.min.js"></script>
   <script src="vendor/js/bootstrap.bundle.min.js"></script>
   <script src="vendor/js/chart.min.js"></script>
   <script src="vendor/js/echarts.min.js"></script>
   <script src="vendor/js/quill.min.js"></script>
   <script src="vendor/js/simple-datatables.js"></script>
   <script src="vendor/js/tinymce.min.js"></script>
   <script src="vendor/js/validate.js"></script>
   <script src="vendor/js/main.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
   <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
   <script>
      AOS.init();
      if (window.history.replaceState) {
         window.history.replaceState(null, null, window.location.href);
      }
   </script>
   
   <script>
      const pillsTab = document.querySelector('#pills-tab');
      const pills = pillsTab.querySelectorAll('button[data-bs-toggle="pill"]');

      pills.forEach(pill => {
         pill.addEventListener('shown.bs.tab', (event) => {
            const {
               target
            } = event;
            const {
               id: targetId
            } = target;

            savePillId(targetId);
         });
      });

      const savePillId = (selector) => {
         localStorage.setItem('activePillId', selector);
      };

      const getPillId = () => {
         const activePillId = localStorage.getItem('activePillId');

         // if local storage item is null, show default tab
         if (!activePillId) return;

         // call 'show' function
         const someTabTriggerEl = document.querySelector(`#${activePillId}`)
         const tab = new bootstrap.Tab(someTabTriggerEl);

         tab.show();
      };

      // get pill id on load
      getPillId();
   </script>
   
</body>

</html>