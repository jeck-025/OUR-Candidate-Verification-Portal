<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/caveportal/resource/php/class/core/init.php';
require_once 'config.php';

class verifydegree extends config
{

  public function verifyD($id, $vfdegree)
  {
    $config = new config();
    $con = $config->con();
    $sql = "UPDATE `tbl_client_user` SET `vfdegree` = '$vfdegree' WHERE `id` = '$id'";
    $data = $con->prepare($sql);
    $data->execute();
  }
}
