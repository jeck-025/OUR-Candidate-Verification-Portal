<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/caveportal/resource/php/class/core/init.php';

class mailer extends config{

    public $mailer_username, $mailer_password, $mailer_port, $mailer_platform,
            $mailer_usernameMKT, $mailer_passwordMKT, $mailer_portMKT, $mailer_platformMKT,
            $mailer_usernameMLS, $mailer_passwordMLS, $mailer_portMLS, $mailer_platformMLS;
    
    function __construct($mailer_username=null,$mailer_password=null, $mailer_port=null, $mailer_platform=null,
                            $mailer_usernameMKT=null,$mailer_passwordMKT=null, $mailer_portMKT=null, $mailer_platformMKT=null,
                            $mailer_usernameMLS=null,$mailer_passwordMLS=null, $mailer_portMLS=null, $mailer_platformMLS=null){

    $this->m_username =$mailer_username;
    $this->m_password =$mailer_password;
    $this->m_port =$mailer_port;
    $this->m_platform =$mailer_platform;

    $this->m_usernameMKT =$mailer_usernameMKT;
    $this->m_passwordMKT =$mailer_passwordMKT;
    $this->m_portMKT =$mailer_portMKT;
    $this->m_platformMKT =$mailer_platformMKT;

    $this->m_usernameMLS =$mailer_usernameMLS;
    $this->m_passwordMLS =$mailer_passwordMLS;
    $this->m_portMLS =$mailer_portMLS;
    $this->m_platformMLS =$mailer_platformMLS;
    
    // echo "$this->m_username <br>";
    // echo "$this->m_password <br>";
    // echo "$this->m_port <br>";
    // echo "$this->m_platform <br>";
    // die();
    }

    public function updateMailerConfig() {
        $config = new config();
        $con = $config->con();
        $sql = "UPDATE `tbl_mailer_info` SET `username` = '$this->m_username', `password` = '$this->m_password', `platform` = '$this->m_platform', `port` = '$this->m_port' WHERE `campus` = 'MNL'";
        $data = $con->prepare($sql);
        $data ->execute();

        $sql1 = "UPDATE `tbl_mailer_info` SET `username` = '$this->m_usernameMKT', `password` = '$this->m_passwordMKT', `platform` = '$this->m_platformMKT', `port` = '$this->m_portMKT' WHERE `campus` = 'MKT'";
        $data1 = $con->prepare($sql1);
        $data1 ->execute();

        $sql2 = "UPDATE `tbl_mailer_info` SET `username` = '$this->m_usernameMLS', `password` = '$this->m_passwordMLS', `platform` = '$this->m_platformMLS', `port` = '$this->m_portMLS' WHERE `campus` = 'MLS'";
        $data2 = $con->prepare($sql2);
        $data2 ->execute();
    }

    public function viewConfigMailer(){
        $config = new config;
        $con = $config->con();
        
        $sql = "SELECT * FROM `tbl_mailer_info` WHERE `campus` = 'MNL'";
        $data = $con-> prepare($sql);
        $data ->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);

        $mailer_username = $result[0]['username'];
        $mailer_password = $result[0]['password'];
        $mailer_platform = $result[0]['platform'];
        $mailer_port = $result[0]['port'];

        return array($mailer_username, $mailer_password, $mailer_platform, $mailer_port);
    }
    public function viewConfigMailerMKT(){
        $config = new config;
        $con = $config->con();
        
        $sql = "SELECT * FROM `tbl_mailer_info` WHERE `campus` = 'MKT'";
        $data = $con-> prepare($sql);
        $data ->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);

        $mailer_username = $result[0]['username'];
        $mailer_password = $result[0]['password'];
        $mailer_platform = $result[0]['platform'];
        $mailer_port = $result[0]['port'];

        return array($mailer_username, $mailer_password, $mailer_platform, $mailer_port);
    }
    public function viewConfigMailerMLS(){
        $config = new config;
        $con = $config->con();
        
        $sql = "SELECT * FROM `tbl_mailer_info` WHERE `campus` = 'MLS'";
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