<?php

class locker extends config{

    public function lockForm() {
        $config = new config();
        $con = $config->con();
        if ($this->checkLock() == "CLOSED"){
            $sql = "UPDATE `tbl_config` SET `value` = 'OPEN'"; // close
        }
        else{
             $sql = "UPDATE `tbl_config` SET `value` = 'CLOSED'"; // open
        }
        $data = $con->prepare($sql);
        $data ->execute();
    }

    public function checkLock(){
        $config = new config();
        $con = $config->con();
        $sql = "SELECT `value` FROM `tbl_config`";
        $data = $con->prepare($sql);
        $data ->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        return $result[0]['value'];
    }

    public function lockerButton(){
        if ($this->checkLock() == "CLOSED"){
            echo "<b>OPEN FORM</b>";
        }
        else{
            echo "<b>CLOSE FORM</b>";
        }
    }

    public function lockerButtonClr(){
        if ($this->checkLock() == "CLOSED"){
            echo "btn-success";
        }
        else{
            echo "btn-danger";
        }
    }

    public function lockerStatusDisp(){
        $config = new config();
        $con = $config->con();
        $sql = "SELECT `value` FROM `tbl_config`";
        $data = $con->prepare($sql);
        $data ->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        if($result[0]['value'] == "OPEN"){
            echo "Application Form is currently <h4><b class='text-success'> OPEN </b></h4>";
        }else{
            echo "Application Form is currently <h4><b class='text-danger'> CLOSED  </b></h4>";
        }
    }

    public function formLockerCheck(){
        $config = new config();
        $con = $config->con();
        $sql = "SELECT `value` FROM `tbl_config`";
        $data = $con->prepare($sql);
        $data ->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        if($result[0]['value'] == "OPEN"){
            // do nothing
        }else{
            header('Location:locked.php');
            exit();
        }
    }

    //-------------------------------------------------------------------------------------------->>>
    
    public function lockMForm() {
        $config = new config();
        $con = $config->con();
        if ($this->checkMLock() == "NO"){
            $sql = "UPDATE `tbl_config` SET `maintenance` = 'YES'"; 
        }
        else{
             $sql = "UPDATE `tbl_config` SET `maintenance` = 'NO'"; 
        }
        $data = $con->prepare($sql);
        $data ->execute();
    }

    public function checkMLock(){
        $config = new config();
        $con = $config->con();
        $sql = "SELECT `maintenance` FROM `tbl_config`";
        $data = $con->prepare($sql);
        $data ->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        return $result[0]['maintenance'];
    }
    
    public function setMaintenance(){
        $config = new config();
        $con = $config->con();
        $sql = "SELECT `maintenance` FROM `tbl_config`";
        $data = $con->prepare($sql);
        $data ->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        if($result[0]['maintenance'] == "NO"){
            // do nothing
        }else{
            header('Location:maintenance.php');
            exit();
        }
    }

    public function lockerMButton(){
        if ($this->checkMLock() == "YES"){
            echo "<b><i class='bi bi-gear-fill'></i><i class='bi bi-tools'></i> OFF</b>";
        }
        else{
            echo "<b><i class='bi bi-gear-fill'></i><i class='bi bi-tools'></i> ON</b>";
        }
    }

    public function lockerMButtonClr(){
        if ($this->checkMLock() == "YES"){
            echo "btn-primary";
        }
        else{
            echo "btn-danger";
        }
    }

    public function maintenanceStatusDisp(){
        $config = new config();
        $con = $config->con();
        $sql = "SELECT `maintenance` FROM `tbl_config`";
        $data = $con->prepare($sql);
        $data ->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        if($result[0]['maintenance'] == "YES"){
            echo "Maintenance Mode: <b class='text-danger'> ON </b>";
        }else{
            echo "Maintenance Mode: <b class='text-primary'> OFF  </b>";
        }
    }


}
?>