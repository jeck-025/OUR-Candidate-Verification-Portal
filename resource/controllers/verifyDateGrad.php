<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/caveportal/resource/php/class/core/init.php';

if(isset($_POST['did'], $_POST['vfdategrad'])){
    $update = new verifydategrad();
    $update->verifyGD($_POST['did'], $_POST['vfdategrad']);
 }

?>