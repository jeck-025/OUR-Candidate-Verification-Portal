<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/caveportal/resource/php/class/core/init.php';

isLoginLocker();
$locker = new locker();
$locker->lockForm();
$url = $_GET['landing'].".php";
header('Location:'.$url);
// header("location:javascript://history.go(-1)");

?>