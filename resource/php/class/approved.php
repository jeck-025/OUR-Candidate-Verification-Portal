<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/caveportal/vendor/sendmail.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/caveportal/resource/php/class/core/init.php';
require_once 'config.php';
require_once 'config2.php';
class approved extends config{
    public $id;
    function __construct($id=null){
        $this->id = $id;

    }
    public function ApprovedRemarks(){
        $config = new config();
        $con = $config->con();
        $sql = "UPDATE `tbl_client_user` SET `status` = 'VERIFIED', `date_completed` = CURRENT_TIMESTAMP  WHERE `id` = '$this->id'";
        $data = $con->prepare($sql);
        $data->execute();

        $con = $config->con();
        $sql7 = "SELECT * FROM `tbl_client_user` WHERE `status` = 'VERIFIED' AND `id` = '$this->id'";
        $data = $con->prepare($sql7);
        $data->execute();
        $result = $data->fetchALL(PDO::FETCH_ASSOC);

        $studFirst= $result[0]["firstName"];
        $studMiddle= $result[0]["middleName"];
        $studLast= $result[0]["lastName"];
        $studDegree=$result[0]["degree"];
        $yearsGrad= $result[0]["yearsGrad"];
        $campus= $result[0]["campus"];
        $studCountry= $result[0]["country"];
        $company =$result[0]["company_name"];
        $fullname =$result[0]["employee"];
        $email =$result[0]["vemail"];
        $tn =$result[0]["tn"];
        $vfdategrad= $result[0]["vfDateGrad"];
        $vfdateent= $result[0]["vfDateEnt"];
        $vfdateatt= $result[0]["vfDateAtt"];
        $vfdegree= $result[0]["vfdegree"];
        $vfcampus= $result[0]["vfcampus"];
        $yearsLastAtt= $result[0]["yearsLastAtt"];
        $vfname = $result[0]["vfname"];
        $la_sy = $result[0]["la_sy"];
        $ent_sy = $result[0]["ent_sy"];
        $status = $result[0]["educ_status"];


        // $config2 = new config2();
        // $conn = $config2->conn();
        // $sql13 = "INSERT INTO `tbl_students`(`firstName`,`middleName`, `lastName`,`degree`,`yearsGrad`,`campus`,`country`, `company_name`, `employee_name`, `vfname`, `vfDateAtt`) VALUES ('$studFirst','$studMiddle',' $studLast','$studDegree','$yearsGrad','$campus','$studCountry', '$company', '$fullname', '$vfname', '$vfdateatt')";
        // $stmt = $conn->prepare($sql13);
        // $stmt->execute();

        sendApprovedEmail($studLast, $studFirst, $studMiddle, $fullname, $email, $tn, $vfdategrad, $vfdateent, $vfdegree, $vfcampus, $yearsGrad, $yearsLastAtt, $studDegree, $campus, $vfname, $vfdateatt, $la_sy, $ent_sy, $status);



    }
}

?>
