<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/caveportal/resource/php/class/core/init.php';

if(isset($_POST['apd'])){
    $approved = new approved($_POST['apd']);
    $approved->ApprovedRemarks();

 }

?>