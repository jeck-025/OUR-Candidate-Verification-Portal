<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/caveportal/resource/php/class/core/init.php';
// require_once 'config.php';

class insert extends config{


    public  $firstName, $middleName, $lastName, $campus, $degree, $yg, $country, $diploma, $consent, $validID, $certificate, $letterForm, $identification,$vemail,$vcompany,$vname, $ya, $bd;

    function __construct($firstName=null, $middleName=null, $lastName=null, $campus=null, $degree=null, $yg=null, $country=null, $diploma=null, $consent=null, $validID=null,$vemail=null,$vcompany=null,$vname=null,$ya=null,$bd=null){
        $this->vname = $vname;
        $this->vcompany = $vcompany;
        $this->vemail = $vemail;
        $this->firstName = $firstName;
        $this->middleName = $middleName;
        $this->lastName = $lastName;
        $this->campus = $campus;
        $this->degree = $degree;
        $this->yearsGrad = $yg;
        $this->yearsLastAtt = $ya;
        $this->bdate = $bd;
        $this->country = $country;
        $this->diploma = $diploma;
        $ext = strtolower(pathinfo($this->diploma['name'], PATHINFO_EXTENSION));
        $this->consent = $consent;
        $form = strtolower(pathinfo($this->consent['name'], PATHINFO_EXTENSION));
        $this->validID = $validID;
        $vID = strtolower(pathinfo($this->validID['name'], PATHINFO_EXTENSION));



        if($this->firstName == ""){
            echo "<script type='text/javascript'>
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'First Name must not be blank!',
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 2000
            })
            </script>";
        }else if(!ctype_alpha(str_replace(' ', '', $this->firstName))){
            echo "<script type='text/javascript'>
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'First Name is not applicable!',
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 2000
            })
            </script>";
        } else if (!preg_match("^[a-zA-Z\s]*$^", $this->middleName)) {
            echo "<script type='text/javascript'>
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Middle Name is not applicable!',
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 2000
            })
            </script>";
        }else if($this->lastName == ""){
            echo "<script type='text/javascript'>
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Last Name must not be blank!',
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 2000
            })
            </script>";
        }else if(!ctype_alpha(str_replace(' ', '', $this->lastName))){
            echo "<script type='text/javascript'>
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Last Name is not applicable!',
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 2000
            })
            </script>";
        }else if(empty($this->campus)){
            echo "<script type='text/javascript'>
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please select the campus the alumna/alumnus graduated.',
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 2000
            })
            </script>";
        }else if(empty($this->degree)){
            echo "<script type='text/javascript'>
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please select the course the alumna/alumnus graduated.',
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 2000
            })
            </script>";
        }
        //else if(empty($this->yearsGrad)){
        //    echo "<script type='text/javascript'>
        //    Swal.fire({
        //    icon: 'error',
        //    title: 'Oops...',
        //    text: 'Please select the year the alumna/alumnus graduated.',
        //    showConfirmButton: false,
        //    timerProgressBar: true,
        //    timer: 2000
        //    })
        //    </script>";
        //}
        else if(empty($this->bdate)){
        echo "<script type='text/javascript'>
        Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Please select the birthdate of the alumna/alumnus graduated.',
        showConfirmButton: false,
        timerProgressBar: true,
        timer: 2000
        })
        </script>";
        }else if(empty($this->country)){
            echo "<script type='text/javascript'>
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please select the country the alumna/alumnus graduated.',
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 2000
            })
            </script>";
         // }else if($ext !== "pdf" || $ext == ""){
        //     echo "<script type='text/javascript'>
        //     Swal.fire({
        //     icon: 'error',
        //     title: 'Oops...',
        //     text: 'Must Upload a pdf file, only pdf file is accepted!',
        //     showConfirmButton: false,
        //     timerProgressBar: true,
        //     timer: 2000
        //     })
        //     </script>";
        }else if($form !== "pdf" || $form == ""){
            echo "<script type='text/javascript'>
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Must Upload a pdf file, only pdf file is accepted!',
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 2000
            })
            </script>";
        }else if($vID !== "pdf" || $vID == ""){
            echo "<script type='text/javascript'>
            Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Must Upload a pdf file, only pdf file is accepted!',
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 3000
            })
            </script>";
        }else{
            $fullname = $this->firstName."-".$this->lastName."-".$this->middleName;
            $ext = strtolower(pathinfo($this->diploma['name'], PATHINFO_EXTENSION));
            $this->diploma['name'] = $fullname.".".$ext;
            $storage = "resource/files/diploma_files/";
            $this->certificate = $storage . $this->diploma['name'];
            move_uploaded_file($this->diploma['tmp_name'], $this->certificate);

            $form = strtolower(pathinfo($this->consent['name'], PATHINFO_EXTENSION));
            $this->consent['name'] = $fullname.".".$form;
            $storage = "resource/files/consent_forms/";
            $this->letterForm = $storage . $this->consent['name'];
            move_uploaded_file($this->consent['tmp_name'], $this->letterForm);


            $vID = strtolower(pathinfo($this->validID['name'], PATHINFO_EXTENSION));
            $this->validID['name'] = $fullname.".".$vID;
            $storage = "resource/files/validation/";
            $this->identification = $storage . $this->validID['name'];
            move_uploaded_file($this->validID['tmp_name'], $this->identification);

            if ($ext == ''){
                $this->certificate = '';
            }

            if ($form == '') {
                $this->letterForm = '';
            }
            if ($vID == '') {
                $this->identification = '';
            }
            $this->insertVerification();

        }
    }

    public function insertVerification(){
        $config = new config;
        $con= $config->con();
        $tn = uniqid('CAVE');
        $vemail= $this->vemail;
        $sql = "INSERT INTO `tbl_client_user`(`vemail`,`company_name`,`employee`,`firstName`,`middleName`, `lastName`,`campus`,`degree`,`yearsGrad`,`yearsLastAtt`, `bdate`, `country`,`diploma`,`consentForm`,`validID`,`tn`) VALUES ('$this->vemail','$this->vcompany','$this->vname','$this->firstName','$this->middleName','$this->lastName','$this->campus','$this->degree','$this->yearsGrad','$this->yearsLastAtt','$this->bdate','$this->country','$this->certificate', '$this->letterForm', '$this->identification','$tn')";
        $data = $con->prepare($sql);
        if($data->execute()) {
              $open = 1;
              include_once("vendor/sendmail2.php");

           } else {
               echo "<script type='text/javascript'>
               swal.fire({
                   icon: 'error',
                   text: 'Application did not push through',
                   showConfirmButton: false,
                   timerProgressBar: true,
                   timer: 4000
                 })
            </script>";

        }
    }
}
?>
