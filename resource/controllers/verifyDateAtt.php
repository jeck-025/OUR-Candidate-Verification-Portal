<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/caveportal/resource/php/class/core/init.php';

if(isset($_POST['did'], $_POST['vfdateatt'])){
    $update = new verifydateatt();
    $update->verifyDA($_POST['did'], $_POST['vfdateatt']);
 }

?>