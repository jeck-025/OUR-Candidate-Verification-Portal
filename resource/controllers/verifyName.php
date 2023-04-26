<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/caveportal/resource/php/class/core/init.php';

if(isset($_POST['did'], $_POST['vfname'])){
    $update = new verifyname();
    $update->verifyN($_POST['did'], $_POST['vfname']);
 }

?>