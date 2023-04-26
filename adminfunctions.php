<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/caveportal/resource/php/class/core/init.php';
approvedClient();
deleteClient();

header('Location:admindash');
?>