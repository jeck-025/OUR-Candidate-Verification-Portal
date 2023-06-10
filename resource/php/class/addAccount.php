<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/caveportal/resource/php/class/core/init.php';

class addAccount extends config{

    public $new_username, $new_fullName, $new_email, $new_company, $new_jobposition;
    
    function __construct($new_username = null, $new_fullName = null, $new_email = null, $new_company = null, $new_jobposition = null){
        
        $user = new user();
        $salt = Hash::salt(32);
        $password = getPass('');  
        $this->username = $new_username;
        $this->password = Hash::make($password, $salt);
        $this->temp_pw = $password;
        $this->salt = $salt;
        $this->fullName = $new_fullName;
        $this->joined = date('Y-m-d H:i:s');
        $this->groups = 1;
        $this->agreement = 0;
        $this->email = $new_email;
        $this->company = $new_company;
        $this->job_position = $new_jobposition;
    }

    public function createUser(){
        $config = new config();
        $con = $config->con();
        $sql = "INSERT into `tbl_accounts`(`username`, `password`, `salt`, `fullName`, `company`, `job_position`, `joined`, `groups`, `agreement`, `email`) 
                    VALUES ('$this->username', '$this->password', '$this->salt', '$this->fullName', '$this->company', '$this->job_position', '$this->joined', '$this->groups', '$this->agreement','$this->email')";
        $data = $con->prepare($sql);
        $data ->execute();

        sendClientAcc($this->username, $this->temp_pw, $this->email);
    }
}

?>