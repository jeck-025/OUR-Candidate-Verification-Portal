<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/caveportal/vendor/sendmail.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/caveportal/resource/php/class/core/init.php';
isLogin();
$user = new user();
isAdmin($user->data()->groups);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    <title>Registrar Portal</title>
    <link rel="stylesheet" type="text/css" href="vendor/css/bootstrap.min.css">
    <link href="resource/img/favcave.ico" rel="icon">
    <link href="vendor/css/all.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="resource/css/register.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body class="d-flex flex-column h-100">

    <main class="flex-shrink-0">


        <header class="bg-dark py-lg-5 pt-5">
            <div class="container">
                <section class="wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 mt-2 mr-3">
                                <form class="py-5 px-4 mr-3" method="post" id="r_form">
                                    <div class="row text-center">
                                        <div class="col-md-12">
                                            <h1 class="title-wrapper mt-5">Are you a verifier?</h1>
                                            <div class="fw-normal text-muted mb-2">
                                                <a href="login" class="text-header fw-bold text-decoration-none"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    vald();
                                    ?>
                                    <div class="row justify-content-center mt-3 mb-4">
                                        <div class="form-floating col-md-12">
                                            <input class="form-control" type="text" name="fullName" id="floatingInput" placeholder="Full Name" required value="<?php echo htmlentities(Input::get('fullName')); ?>" />
                                            <label for="floatingInput" class="form-title"> Full Name</label>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center mb-4">
                                        <div class="form-floating col-md-12">
                                            <input class="form-control" type="email" name="email" id="floatingInput" value="<?php echo Input::get('email'); ?>" placeholder="Email Address" required>
                                            <label for="floatingInput" class="form-title"> Email Address</label>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center mb-4">
                                        <div class="form-floating col-md-12">
                                            <input class="form-control" type="text" name="company" id="floatingInput" placeholder="Company Name" required value="<?php echo htmlentities(Input::get('company')); ?>" />
                                            <label for="floatingInput" class="form-title"> Company Name</label>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center mb-3">
                                        <div class="form-floating col-md-12">
                                            <input class="form-control" type="text" name="job_position" id="floatingInput" placeholder="Job Position" required value="<?php echo htmlentities(Input::get('job_position')); ?>" />
                                            <label for="floatingInput" class="form-title">Job Position</label>
                                        </div>
                                    </div>
                                    <div class="row mt-4 mb-1 justify-content-start align-items-start">
                                        <div class="col-md-1">
                                            <div class="cntr">
                                                <input type="checkbox" id="cbx" class="hidden-xs-up" name="checkbox" value="1" />
                                                <label for="cbx" class="cbx">By checking this box, I hereby agree to <a href="CAVE-temporaryt&c.pdf" target="_blank" class="agreement"><b>The Terms <br>and Conditions</b></a> and <a href="CEU-CAVE-Portal-Privacy-Notice.pdf" target="_blank" class="agreement"><b>Data Privacy Policy</b></a></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center mt-1">
                                        <div class="form-group col-md-12">
                                            <label>&nbsp;</label>
                                            <input type="hidden" name="Token" value="<?php echo Token::generate(); ?>" />
                                            <input type="submit" value="Submit" class="submit_btn w-100" />

                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-8 mt-5 p-4">
                                <div class="container justify-content-center align-items-center left-side">
                                    <div class="panels-container">
                                        <div class="panel left-panel">
                                            <div class="content">
                                                <h3>Ready to Sign in?</h3>
                                                <p class="title">
                                                    Get to know our Alumni, verify their credentials, track your requests.
                                                </p>
                                                <a class="btn transparent" href="login" id="sign-in-btn">
                                                    Sign in
                                                </a>

                                            </div>
                                            <img src="  resource/img/Contact us-ceu.png" class="image" alt="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </header>
    </main>

</body>

<script src="vendor/js/jquery.js"></script>
<script src="vendor/js/popper.js"></script>
<script src="vendor/js/bootstrap.min.js"></script>
<script type="text/javascript">
function check () {
    var inputs = document.querySelectorAll("input[type='checkbox']");
    for(var i = 0; i < inputs.length; i++) {
        if (inputs[i].checked) {
            return true;
        }  
    }
    Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Checkbox is Required',
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 2000
            });
    return false;
}
</script>

</body>

</html>