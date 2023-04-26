<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/caveportal/resource/php/class/core/init.php';
require_once 'config.php';

class updatecampus2 extends config
{

  public function updateC2($id, $campus)
  {
    $config = new config();
    $con = $config->con();
    $sql = "UPDATE `tbl_client_user` SET `campus` = '$campus' WHERE `id` = '$id'";
    $data = $con->prepare($sql);
    $data->execute();
  }
}
