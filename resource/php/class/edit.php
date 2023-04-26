<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/caveportal/resource/php/class/core/init.php';


class edit extends config{
    public $id;

    public function __construct($id){
        $this->id= $id;
    }
    public function editApproved(){
        $con = $this->con();
        $sql = "UPDATE `tbl_client_user` SET `status` ='APPROVED', `date_completed` = CURRENT_TIMESTAMP WHERE `id` = '$this->id'";
        $data = $con->prepare($sql);
        if ($data->execute()){
            return true;
        } else{
            return false;
        }
    }

    public function editDenied(){
        $con = $this->con();
        $sql = "UPDATE `tbl_client_user` SET `status` ='DENIED', `date_completed` = CURRENT_TIMESTAMP WHERE `id` = '$this->id'";
        $data = $con->prepare($sql);
        if ($data->execute()){
            return true;
        } else{
            return false;
        }
    }

    public function editOnhold(){
        $con = $this->con();
        $sql = "UPDATE `tbl_client_user` SET `status` ='ON-HOLD', `date_completed` = CURRENT_TIMESTAMP WHERE `id` = '$this->id'";
        $data = $con->prepare($sql);
        if ($data->execute()){
            return true;
        } else{
            return false;
        }
    }

    public function deleteClient(){
        $con = $this->con();
        $sql = "DELETE FROM `tbl_client_user` WHERE `id` = $this->id";
        $data = $con->prepare($sql);
        if($data->execute()){
            return true;
            
        }else{
            return false;
        }
        

    }
}

?>