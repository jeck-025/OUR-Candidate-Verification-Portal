<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/caveportal/resource/php/class/core/init.php';
// require_once 'config.php';



class updatedoc extends config
{

  public $id, $diploma, $consent, $validID, $certificate, $letterForm, $identification;

  function __construct($id = null, $diploma = null, $consent = null, $validID =null)
  {
    $this->id = $id;
    $this->diploma = $diploma;
    $ext = pathinfo($this->diploma['name'], PATHINFO_EXTENSION);
    $this->consent = $consent;
    $form = pathinfo($this->consent['name'], PATHINFO_EXTENSION);
    $this->validID = $validID;
    $vID = pathinfo($this->validID['name'], PATHINFO_EXTENSION);

    if ($ext !== "pdf" || $ext == "") {
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
    } else if ($form !== "pdf" || $form == "") {
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
    }else if($vID !== '' && $vID !== 'gif' && $vID !== 'png' && $vID !== 'jpg' && $vID !== 'jpeg' && $vID !== 'jfif'){
      echo "<script type='text/javascript'>
      Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Must Upload a image file, only pdf file is accepted!',
      showConfirmButton: false,
      timerProgressBar: true,
      timer: 3000
      })
      </script>";
  } else {
      $ext = strtolower(pathinfo($this->diploma['name'], PATHINFO_EXTENSION));
      $this->diploma['name'] = $this->id . "." . $ext;
      $storage = "resource/files/diploma_files/";
      $this->certificate = $storage . $this->diploma['name'];
      move_uploaded_file($this->diploma['tmp_name'], $this->certificate);

      $form = strtolower(pathinfo($this->consent['name'], PATHINFO_EXTENSION));
      $this->consent['name'] = $this->id . "." . $form;
      $storage = "resource/files/consent_forms/";
      $this->letterForm = $storage . $this->consent['name'];
      move_uploaded_file($this->consent['tmp_name'], $this->letterForm);


      $vID = strtolower(pathinfo($this->validID['name'], PATHINFO_EXTENSION));
      $this->validID['name'] = $this->id . "." . $vID;
      $storage = "resource/files/validation/";
      $this->identification = $storage . $this->validID['name'];
      move_uploaded_file($this->validID['tmp_name'], $this->identification);

      if ($ext == '') {
        $this->certificate = '';
      }

      if ($form == '') {
        $this->letterForm = '';
      }
      if ($vID == '') {
        $this->identification = '';
      }
      $this->updateD();
    }
  }
  public function updateD()
  {
    $config = new config();
    $con = $config->con();
    $sql = "UPDATE `tbl_client_user` SET `diploma` = '$this->certificate', `consentForm` = '$this->letterForm', `validID` = '$this->identification', `status` = 'PENDING' WHERE `id` = '$this->id'";
    $data = $con->prepare($sql);
    if($data->execute()) {
      echo "<script type='text/javascript'>
      swal.fire({
          icon: 'success',
          title: 'Updated Application Registered Successfully',
          showConfirmButton: false,
          timerProgressBar: true,
          timer: 2000 
        }).then(function (result) {
            if (true) {
              window.location = 'clientdash';
            }
        })
      </script>";
    } else {
      echo "<script type='text/javascript'>
      swal.fire({
          icon: 'error',
          text: 'Application Registered Unsuccessfully',
          showConfirmButton: false,
          timerProgressBar: true,
          timer: 2000
        }).then(function (result) {
          if (true) {
            window.location = 'clientdash';
          }
        })
      </script>";
    }
  }
}
