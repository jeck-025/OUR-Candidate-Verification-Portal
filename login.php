<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/caveportal/resource/php/class/core/init.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="resource/css/loginmodule.css" />
  <link href="resource/img/favcave.ico" rel="icon">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="sweetalert2.min.css">
  <title>CAVE Portal</title>
</head>

<body>

  <div class="container">
    <div class="forms-container">
      <div class="signin-signup" id="signin-signup">

        <form method="POST" class="sign-in-form" id="">
          <div>
            <img src='resource/img/CAVElogo-sm.png'>
          </div>
          <h2 class="title">Sign in</h2>
          <?php
            logd();
          ?>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" class="form-control" id="floatingInput" name="username" placeholder="Username">
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
          </div>
          <input type=hidden name="token" value="<?php echo Token::generate(); ?>">

          <button type="submit" class="btn solid" name="form1">Log In</button>
          <a class="go_back" href="index">Go Back</a>
        </form>

        
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>Any Questions?</h3>
          <p>
            Feel free to reach out to us, and we'll surely get back to you as soon as possible.
          </p>
          <a class="btn transparent" href="login" id="sign-up-btn">
            Contact Us
          </a>
        </div>
        <img src="resource/img/login-ceu.png" class="image" alt="" />
      </div>
      
    </div>
  </div>

  <script src="resource/js/loginapp.js"></script>


</body>

</html>