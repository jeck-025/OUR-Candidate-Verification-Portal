<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/caveportal/resource/php/class/core/init.php';

if(isset($_GET['id'])){
    $update = new reset();
    $update->resetD($_GET['id']);
        
    header('location: ../../info.php?id='.$_GET[id]);
    
 }

?>