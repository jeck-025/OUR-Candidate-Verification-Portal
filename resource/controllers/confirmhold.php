<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/caveportal/resource/php/class/core/init.php';

if(isset($_POST['hld'], $_POST['remarks'])){
    $hold = new hold($_POST['hld'], $_POST['remarks']);
    $hold->OnHoldRemarks();

 }

?>