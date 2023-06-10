<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/caveportal/resource/php/class/core/init.php';

class mailer extends config{

    public $mailer_username, $mailer_password, $mailer_port, $mailer_platform;
    
    function __construct($mailer_username=null,$mailer_password=null, $mailer_port=null, $mailer_platform=null){

    $this->m_username =$mailer_username;
    $this->m_password =$mailer_password;
    $this->m_port =$mailer_port;
    $this->m_platform =$mailer_platform;
    
    // echo "$this->m_username <br>";
    // echo "$this->m_password <br>";
    // echo "$this->m_port <br>";
    // echo "$this->m_platform <br>";
    // die();
    }

    public function updateMailerConfig() {
        $config = new config();
        $con = $config->con();
        $sql = "UPDATE `tbl_mailer_info` SET `username` = '$this->m_username', `password` = '$this->m_password', `platform` = '$this->m_platform', `port` = '$this->m_port'";
        $data = $con->prepare($sql);
        $data ->execute();
    }

    public function viewConfigMailer(){
        $config = new config;
        $con = $config->con();
        
        $sql = "SELECT * FROM `tbl_mailer_info`";
        $data = $con-> prepare($sql);
        $data ->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);

        $mailer_username = $result[0]['username'];
        $mailer_password = $result[0]['password'];
        $mailer_platform = $result[0]['platform'];
        $mailer_port = $result[0]['port'];

        return array($mailer_username, $mailer_password, $mailer_platform, $mailer_port);
    }
}
?>