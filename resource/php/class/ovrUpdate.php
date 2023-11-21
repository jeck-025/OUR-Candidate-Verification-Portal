<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/caveportal/resource/php/class/core/init.php';
require_once 'config.php';

class ovrUpdate extends config{ 

    public $dataID, $dataCT, $dataLN, $dataFN, $dataMN, $dataBD, $dataCP, $dataDG, $dataYG, $dataLA, $dataVC, $dataVR, $dataRE, $diplomaURL, $formURL, $vidURL;

    function __construct($dataID=null, $dataCT=null, $dataLN=null, $dataFN=null, $dataMN=null, $dataBD=null, $dataCP=null, $dataDG=null, $dataYG=null, $dataLA=null, $dataVC=null, $dataVR=null, $dataRE=null, $diplomaURL=null, $formURL=null, $vidURL=null){

        $this->id = $dataID;
        $this->country = $dataCT;
        $this->lname = $dataLN;
        $this->fname = $dataFN;
        $this->mname = $dataMN;
        $this->bdate = $dataBD;
        $this->campus = $dataCP;
        $this->degree = $dataDG;
        $this->yrgrad = $dataYG;
        $this->lastatt = $dataLA;
        $this->company = $dataVC;
        $this->employee = $dataVR;
        $this->email = $dataRE;
        $this->diploma = $diplomaURL;
        $this->form = $formURL;
        $this->vid = $vidURL;
        $this->updateData();
    }

    public function updateData(){
        $config = new config;
        $con = $config->con();
        $sql = "UPDATE `tbl_client_user` SET `vemail` = '$this->email', `company_name` = '$this->company', `company_name` = '$this->company', `employee` = '$this->employee', `firstName` = '$this->fname', `middleName` = '$this->mname', `lastName`= '$this->lname', `campus` = '$this->campus', `degree` = '$this->degree', `yearsGrad` = '$this->yrgrad', `yearsLastAtt` = '$this->lastatt', `bdate` = '$this->bdate', `country` = '$this->country', `diploma` = '$this->diploma', `consentForm` = '$this->form', `validID` = '$this->vid' WHERE `id` = '$this->id'";
        $data = $con->prepare($sql);
        if($data->execute()) {
            echo "<script type='text/javascript'>
               swal.fire({
                   icon: 'success',
                   text: 'Data Saved',
                   showConfirmButton: false,
                   timerProgressBar: true,
                   timer: 4000
                 })
            </script>";
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