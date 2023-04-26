<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/caveportal/resource/php/class/core/init.php';
require_once 'config.php';

class seteducstatus extends config
{

  public function verifyES($id, $vfeducstatus)
  {
    $config = new config();
    $con = $config->con();
    $sql = "UPDATE `tbl_client_user` SET `educ_status` = '$vfeducstatus' WHERE `id` = '$id'";
    $data = $con->prepare($sql);
    $data->execute();
  }

  public function verifyESYS($id, $ent_sy)
  {
    $config = new config();
    $con = $config->con();
    $sql = "UPDATE `tbl_client_user` SET `ent_sy` = '$ent_sy' WHERE `id` = '$id'";
    $data = $con->prepare($sql);
    $data->execute();
  }

  public function verifyLSYS($id, $la_sy)
  {
    $config = new config();
    $con = $config->con();
    $sql = "UPDATE `tbl_client_user` SET `la_sy` = '$la_sy' WHERE `id` = '$id'";
    $data = $con->prepare($sql);
    $data->execute();
  }


  public function verifyChecker($id, $checker)
  {
    $config = new config();
    $con = $config->con();
    $sql = "UPDATE `tbl_client_user` SET `checker` = '$checker', `checked_date` = now() WHERE `id` = '$id'";
    $data = $con->prepare($sql);
    $data->execute();
  }
}
