<?php
function CheckSuccess($status,$tn=null)
{
    if ($status == 'Success') {
        echo '<div class="alert alert-success alert-dismissible fade show col-12" role="alert">
                <b>Congratulations!</b> You have successfully submitted your  verification request!.
                Please take note of your transaction number: <b><a href="#" class="text-primary">'.$_GET["tn"].'</a></b>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    }else if($status=='captchaError'){
      echo '<div class="alert alert-danger alert-dismissible fade show col-12" role="alert">
              <b>OH NOOO!</b> Incorrect Captcha Entry Detected.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>';
    }
}

function Success()
{
    echo '<div class="alert alert-success alert-dismissible fade show col-12" role="alert">
            <b>Congratulations!</b> You have successfully registered Your Account!, Please check your email, An Email has been sent with your account credentials.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>';
}
function loginError()
{
    echo '<div class="alert alert-danger alert-dismissible fade show col-12" role="alert">
    <b>Error!</b> Invalid Username or Password
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>';
}
function curpassError()
{
    echo '<div class="alert alert-danger alert-dismissible fade show col-12" role="alert">
                <b>Error!</b> Invalid Current Password
            </div>';
}

function pError($error)
{
    echo '<div class="alert alert-danger alert-dismissible fade show col-12" role="alert">
            <b>Error!</b> ' . $error . '
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>';
}

function rError($error)
{
    echo '<div class="alert alert-danger alert-dismissible fade show col-12" role="alert">
        <b>Error!</b> ' . $error . '
            </div>';
}

function getUname($username) {
    $length = 10;
      $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      for ($ctr = 0; $ctr < $length; $ctr++) {
          $username .= $characters[rand(0, $charactersLength - 1)];
      }
      return $username;
}

function getPass($password) {
    $length = 10;
      $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      for ($ctr = 0; $ctr < $length; $ctr++) {
          $password .= $characters[rand(0, $charactersLength - 1)];
      }
      return $password;
}

function vald()
{
    if (Input::exists()) {
        if (Token::check(Input::get('Token'))) {
            // if (!empty($_POST['checkbox'])) {
            //     $_POST['checkbox'] = Input::get('checkbox');
            // } else {
            //     $_POST['checkbox'] = "";
            // }
            $validate = new Validate;
            $validate = $validate->check($_POST, array(
                'fullName' => array(
                    'required' => 'true',
                    'min' => 2,
                    'max' => 50,
                    'type2' => 'text'
                ),
                'email' => array(
                    'required' => 'true',
                    'type' => 'email'
                ),
                'company' => array(
                    'required' => 'true',
                    'min' => 2,
                    'type2' => 'text'
                ),
                'job_position' => array(
                    'required' => 'true',
                    'min' => 2,
                    'type2' => 'text'
                ),
                'campus' => array(
                    'required' => 'true',
                )
                // 'checkbox' => array(
                //     'required' => 'true'
                // )

            ));

            if ($validate->passed()) {
                $user = new user();
                $salt = Hash::salt(32);
                $username = getUname('CAVE');
                $password = getPass('');

                try {
                    $user->create(array(
                        'username' => $username,
                        'password' => Hash::make($password, $salt),
                        'salt' => $salt,
                        'fullName' => Input::get('fullName'),
                        'joined' => date('Y-m-d H:i:s'),
                        'groups' => 1,
                        'email' => Input::get('email'),
                        'company' => Input::get('company'),
                        'job_position' => Input::get('job_position'),
                        'mm' => Input::get('campus')

                    ));

                    // $user->createC(array(
                    //     'checker' => Input::get('fullName'),

                    // ));
                    // $user->createV(array(
                    //     'verifier' => Input::get('fullName'),
                    // ));

                    // $user->createR(array(
                    //     'releasedby' => Input::get('fullName'),

                    // ));
                } catch (Exception $e) {
                    die($e->getMessage());
                }

                Success();
                sendClientAcc($username, $password, Input::get('email'));
                header("refresh:4; login");
            } else {
                foreach ($validate->errors() as $error) {
                    pError($error);
                }
            }
        }
    } else {
        return false;
    }
}
// pag di gumana idelete

// hanggang dito ang tatanggalin

function logd()
{
    if (Input::exists()) {
        if (Token::check(Input::get('token'))) {
            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                'username' => array(
                    'required' => 'true',
                ),
                'password' => array(
                    'required' => 'true'
                )
            ));
            if ($validation->passed()) {
                $user = new user();
                $remember = (Input::get('remember') === 'on') ? true : false;
                $login = $user->login(Input::get('username'), Input::get('password'), $remember);
                if ($login) {
                    if ($user->data()->groups == 1) {
                        Redirect::to('admindash');
                    } else if ($user->data()->groups == 2) {
                        Redirect::to('clientdash');
                    } else {
                        Redirect::to('template');
                        echo $user->data()->groups;
                    }
                } else {
                    loginError();
                }
            } else {
                foreach ($validation->errors() as $error) {
                    echo $error . '<br />';
                }
            }
        }
    }
}

function isLogin()
{
    $user = new user();
    if (!$user->isLoggedIn()) {
        Redirect::to('login');
    }
}

function isLoginLocker()
{
    $user = new user();
    if (!$user->isLoggedIn()) {
        header("location:resource/php/class/includes/errors/denied");
        exit();
    }
}


function updateProfile()
{
    if (Input::exists()) {
        // if (!empty($_POST['College'])) {
        //     $_POST['College'] = implode(',', Input::get('College'));
        // } else {
        //     $_POST['College'] = "";
        // }

        $validate = new Validate;
        $validation = $validate->check($_POST, array(
            'email' => array(
                'min' => 5,
                'max' => 50,
                'type' => 'email'
            ),
            'campus' => array(
                'min' => 2,
                'type2' => 'text'
            )
        ));

        if ($validate->passed()) {
            $user = new user();

            try {
                $user->update(array(
                    // 'username' => Input::get('username'),
                    // 'name' => Input::get('fullName'),
                    'email' => Input::get('email'),
                    // 'company' => Input::get('company')
                    'mm' => Input::get('campus')
                ));
                echo "<script type='text/javascript'>
                    swal.fire({
                        icon: 'success',
                        title: 'Profile has been updated',
                        text: 'Please wait...',
                        showConfirmButton: false,
                        timerProgressBar: true,
                        allowOutsideClick: false,
                        timer: 2000
                    }).then(okay => {
                          if (okay) {
                           window.location.href = 'profile';
                         }
                       });
                    </script>";
            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {
            foreach ($validation->errors() as $error) {
                rError($error);
            }
        }
    }
}

function changeP()
{
    if (Input::exists()) {
        $validate = new Validate;
        $validation = $validate->check($_POST, array(
            'password_current' => array(
                'required' => 'true',
            ),
            'password' => array(
                'required' => 'true',
                'min' => 6,
            ),
            'ConfirmPassword' => array(
                'required' => 'true',
                'matches' => 'password'
            )
        ));

        if ($validate->passed()) {
            $user = new user();
            if (Hash::make(Input::get('password_current'), $user->data()->salt) !== $user->data()->password) {
                curpassError();
            } else {
                $user = new user();
                $salt = Hash::salt(32);
                try {
                    $user->update(array(
                        'password' => Hash::make(Input::get('password'), $salt),
                        'salt' => $salt
                    ));
                    echo "<script type='text/javascript'>
                        swal.fire({
                        icon: 'success',
                        title: 'Password has been Updated',
                        text: 'You will be logged out. Please log-in again using your new password',
                        showConfirmButton: false,
                        timerProgressBar: true,
                        allowOutsideClick: false,
                        timer: 3500

                        }).then(okay => {
                          if (okay) {

                           window.location.href = 'logout';
                         }
                       });
                        </script>";
                } catch (Exception $e) {
                    die($e->getMessage());
                }
            }
        } else {
            foreach ($validation->errors() as $error) {
                rError($error);
            }
        }
    }
}

function forgotP($id)
{
    if (Input::exists()) {
        $validate = new Validate;
        $validation = $validate->check($_POST, array(
            'email' => array(
                'required' => 'true',
            ),
            'password' => array(
                'required' => 'true',
                'min' => 6,
            ),
            'ConfirmPassword' => array(
                'required' => 'true',
                'matches' => 'password'
            )
        ));

        if ($validate->passed()) {
            $config = new config();
            $con = $config->con();
            $sql = "SELECT `email` FROM `tbl_accounts WHERE `id` = '$id'";
            $data = $con->prepare($sql);
            $data->execute();
            $email = $data->fetchColumn();
            if (Input::get('password_current') !== $email) {
                var_dump($email);
                curpassError();
            } else {
                $user = new user();
                $salt = Hash::salt(32);
                try {
                    $user->update(array(
                        'password' => Hash::make(Input::get('password'), $salt),
                        'salt' => $salt
                    ));
                    echo "<script type='text/javascript'>
                        swal.fire({
                        icon: 'success',
                        title: 'Current Password has been Updated, Please Login Again, Thank You!',
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 2000

                        }).then(okay => {
                          if (okay) {

                           window.location.href = 'logout';
                         }
                       });
                        </script>";
                } catch (Exception $e) {
                    die($e->getMessage());
                }
            }
        } else {
            foreach ($validation->errors() as $error) {
                rError($error);
            }
        }
    }
}
function isAdmin($user)
{
    if ($user === "1") {
        //do what it is supposed to do
    } else {
        header("HTTP/1.1 403 Forbidden");
        exit;
    }
}
function isClient($user)
{
    if ($user === "2") {
        // do what it is supposed to do
    } else {
        header("HTTP/1.1 403 Forbidden");
        exit;
    }
}


function approvedClient()
{
    if (!empty($_GET['approved'])) {
        $approved = new approved($_GET['approved']);
        $approved->approvedRemarks();

    }
}

function deniedClient()
{
    echo "test";
    die();
    if (!empty($_GET['denied']) && !empty($_POST['remarks'])) {
        if (trim($_POST['remarks']) == '') {
            $message = "Please put Remarks!";
            echo "<script>alert('$message');</script>";
        } else if (!ctype_alpha(str_replace(' ', '', $_POST['remarks']))) {
            echo "<script type='text/javascript'>
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Entered Remarks is not Applicable',
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 2000
            })
            </script>";
        } else {
            $denied = new denied($_GET['denied'], $_POST['remarks']);
            $denied->DeniedRemarks();
            // echo "<script type='text/javascript'>
            //
            //         </script>";

        }
    }
}

function deleteClient()
{
    if (!empty($_GET['delete'])) {
        $edit = new edit($_GET['delete']);
        if ($edit->deleteClient()) {
            echo "<script type='text/javascript'>
                    swal.fire({
                        icon: 'success',
                        title: 'Data has been Successfully Deleted',
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 2000
                    }).then(okay => {
                          if (okay) {
                           window.location.href = 'admindash';
                         }
                       });
                    </script>";
        }
    }
}

function holdRemarks()
{
    if (!empty($_GET['hold']) && !empty($_POST['remarks'])) {
        if ($_POST['remarks'] == '') {
            $message = "Please put Remarks!";
            echo "<script>alert('$message');</script>";
        } else if (!ctype_alpha(str_replace(' ', '', $_POST['remarks']))) {
            echo "<script type='text/javascript'>
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Entered Remarks is not Applicable',
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 2000
            })
            </script>";
        } else {
            $hold = new hold($_GET['hold'], $_POST['remarks']);
            $hold->OnholdRemarks();
            echo "<script type='text/javascript'>
                    swal.fire({
                        icon: 'success',
                        title: 'Data has been Successfully put On Hold',
                        showConfirmButton: false,
                        timerProgressBar: true,
                        timer: 2000
                    }).then(okay => {
                          if (okay) {
                           window.location.href = 'admindash';
                         }
                       });
                    </script>";
        }
    }
}

function findTransactionInfo($tn){
    $config = new config;
    $con = $config->con();
    $sql = "SELECT * FROM `tbl_client_user` WHERE `tn` ='$tn'";
    $data = $con-> prepare($sql);
    $data ->execute();
    $rows =$data-> fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}
