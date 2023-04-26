<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/caveportal/resource/php/class/core/init.php';
require_once 'config.php';

class verifydategrad extends config
{

  public function verifyGD($id, $vfdategrad)
  {
    $config = new config();
    $con = $config->con();
    $sql = "UPDATE `tbl_client_user` SET `vfDateGrad` = '$vfdategrad' WHERE `id` = '$id'";
    $data = $con->prepare($sql);
    $data->execute();
  }
}
