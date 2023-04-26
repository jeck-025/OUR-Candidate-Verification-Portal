<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/caveportal/resource/php/class/core/init.php';

if(isset($_POST['did'], $_POST['vfeducstatus'])){
    $update = new seteducstatus();
    $update->verifyES($_POST['did'], $_POST['vfeducstatus']);
 }

if(isset($_POST['did'], $_POST['ent_sy'])){
    $update = new seteducstatus();
    $update->verifyESYS($_POST['did'], $_POST['ent_sy']);
 }

if(isset($_POST['did'], $_POST['la_sy'])){
    $update = new seteducstatus();
    $update->verifyLSYS($_POST['did'], $_POST['la_sy']);
 }

if(isset($_POST['did'], $_POST['checker'])){
    $update = new seteducstatus();
    $update->verifyChecker($_POST['did'], $_POST['checker']);
 }
?>