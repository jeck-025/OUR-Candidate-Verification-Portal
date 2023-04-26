<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/caveportal/vendor/sendmail.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/caveportal/resource/php/class/core/init.php';
require_once 'config.php';

class hold extends config{
    public $id, $remarks;
    public function __construct($id=null, $remarks=null){
        $this->id = $id;
        $this->remarks = $remarks;

}
    public function OnholdRemarks(){
        $config = new config();
        $con = $this->con();
        $sql = "UPDATE `tbl_client_user` SET `status` = 'ON-HOLD', `date_completed` = CURRENT_TIMESTAMP, `remarks` = '$this->remarks' WHERE `id` = '$this->id'";
        $data = $con->prepare($sql);
        $data->execute();

        $con = $config->con();
        $sql2 = "SELECT * FROM `tbl_client_user` WHERE `id` = '$this->id'";
        $data2 = $con->prepare($sql2);
        $data2->execute();
        $result = $data2->fetchALL(PDO::FETCH_ASSOC);

        $lastname = $result[0]["lastName"];
        $fullname = $result[0]["employee"];
        $status = $result[0]["status"];
        $email = $result[0]["vemail"];
        $remarks = $result[0]["remarks"];

        sendOnHoldEmail($lastname, $fullname, $status, $email, $remarks);
    }
}
?>
