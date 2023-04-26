<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/caveportal/resource/php/class/core/init.php';
require_once 'config.php';

class verifyname extends config
{

  public function verifyN($id, $vfname)
  {
    $config = new config();
    $con = $config->con();
    $sql = "UPDATE `tbl_client_user` SET `vfname` = '$vfname' WHERE `id` = '$id'";
    $data = $con->prepare($sql);
    $data->execute();
  }
}
