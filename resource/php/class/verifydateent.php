<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/caveportal/resource/php/class/core/init.php';
require_once 'config.php';

class verifydateent extends config
{

  public function verifyED($id, $vfdateent)
  {
    $config = new config();
    $con = $config->con();
    $sql = "UPDATE `tbl_client_user` SET `vfDateEnt` = '$vfdateent' WHERE `id` = '$id'";
    $data = $con->prepare($sql);
    $data->execute();
  }
}
