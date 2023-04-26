<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/caveportal/resource/php/class/core/init.php';

if(isset($_POST['did'], $_POST['vfdateent'])){
    $update = new verifydateent();
    $update->verifyED($_POST['did'], $_POST['vfdateent']);
 }

?>