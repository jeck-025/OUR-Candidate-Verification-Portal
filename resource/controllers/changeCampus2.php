<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/caveportal/resource/php/class/core/init.php';

if(isset($_POST['did'], $_POST['campus'])){
    $update = new updatecampus2();
    $update->updateC2($_POST['did'], $_POST['campus']);
 }

?>