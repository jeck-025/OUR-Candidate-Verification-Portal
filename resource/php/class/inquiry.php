<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/caveportal/resource/php/class/core/init.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/caveportal/vendor/sendmail.php';
require_once 'config.php';

class inquiry extends config{
    public $emails, $fullname, $check, $company_name, $job_position;
    function __construct($emails=null,$fullname=null,$check=null, $company_name=null,$job_position=null) {
        $this->emails = $emails;
        $this->fullname = $fullname;
        $this->company_name = $company_name;
        $this->job_position = $job_position;
        $this->check = $check;

         if ($this->emails == "") {
            echo "<script type='text/javascript'>
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Email is required',
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 2500
            })
            </script>";
        }else if (!$this->check == false) {
            echo "<script type='text/javascript'>
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Incomplete Credentials, must check the box',
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 2500
            })
            </script>";
        }
        else if(!filter_var($this->emails, FILTER_VALIDATE_EMAIL)) {
            echo "<script type='text/javascript'>
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Email Format is Invalid',
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 2500
            })
            </script>";
        }else if(!preg_match(
            "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $this->emails)) {
                echo "<script type='text/javascript'>
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Email must first contain letter',
                showConfirmButton: false,
                timerProgressBar: true,
                timer: 2500
                })
                </script>";
        }else if ($this->fullname == "") {
            echo "<script type='text/javascript'>
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Full Name is required',
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 2500
            })
            </script>";
        }else if (!ctype_alpha(str_replace(' ', '', $this->fullname))) {
            echo "<script type='text/javascript'>
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Full Name is not applicable!',
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 2500
            })
            </script>";
        }else if ($this->company_name == ""){
            echo "<script type='text/javascript'>
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Company Name is required',
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 2500
            })
            </script>";
        }
        else if (!ctype_alpha(str_replace(' ', '', $this->company_name))) {
            echo "<script type='text/javascript'>
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Company Name is not applicable!',
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 2500
            })
            </script>";
        }else if($this->job_position == "") {
            echo "<script type='text/javascript'>
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Job Position is required',
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 2500
            })
            </script>";
        }else if (!ctype_alpha(str_replace(' ', '', $this->job_position))) {
            echo "<script type='text/javascript'>
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Job Position is not applicable!',
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 2500
            })
            </script>";
        }
        else {
            if($this-> check == true) {
                $this->check = 1;
            }
            echo "<script type='text/javascript'>
            Swal.fire({
                icon: 'success',
                title: 'Your credentials have successfully registered',
                text: '(Please wait for further instruction to claim your account)',
                showConfirmButton: false,
                timerProgressBar: true,
                timer: 4000
                })
                </script>";
            $this->inquiry();
        }
        
    }

    private function getUname($username) {
        $length = 10;
          $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
          $charactersLength = strlen($characters);
          for ($ctr = 0; $ctr < $length; $ctr++) {
              $username .= $characters[rand(0, $charactersLength - 1)];
          }
          return $username;
    }
    
    private function getPass($password) {
        $length = 10;
          $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
          $charactersLength = strlen($characters);
          for ($ctr = 0; $ctr < $length; $ctr++) {
              $password .= $characters[rand(0, $charactersLength - 1)];
          }
          return $password;
    }

    public function inquiry() {
        
        $config = new config();
        $con = $config->con();
        $username = getUname('CAVE');
        $password = getPass('');
        $sql = "INSERT INTO `tbl_emails` (`emails`, `fullname`, `company_name`, `job_position`, `aggreement`) VALUES ('$this->emails', '$this->fullname', '$this->company_name', '$this->job_position' `$this->check`)";
        $data = $con->prepare($sql);
        $data->execute();
    }

    
}
?>