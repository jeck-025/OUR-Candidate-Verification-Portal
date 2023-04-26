<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/caveportal/resource/php/class/core/init.php';
require_once 'config.php';

class verifydateatt extends config
{

  public function verifyDA($id, $vfdateatt)
  {
    $config = new config();
    $con = $config->con();
    $sql = "UPDATE `tbl_client_user` SET `vfDateAtt` = '$vfdateatt' WHERE `id` = '$id'";
    $data = $con->prepare($sql);
    $data->execute();
  }
}
