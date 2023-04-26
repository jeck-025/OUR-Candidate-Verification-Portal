<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/caveportal/resource/php/class/core/init.php';

if(isset($_POST['did'], $_POST['vfdegree'])){
    $update = new verifydegree();
    $update->verifyD($_POST['did'], $_POST['vfdegree']);
 }

?>