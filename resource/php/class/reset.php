<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/caveportal/resource/php/class/core/init.php';
require_once 'config.php';

class reset extends config
{

  public function resetD($id)
  {
    $config = new config();
    $con = $config->con();
    $sql = "UPDATE `tbl_client_user` SET `educ_status` = NULL, `vfDateGrad` = NULL, `vfDateAtt` = NULL, `vfDateEnt` = NULL, `ent_sy` = NULL, `la_sy` = NULL WHERE `id` = '$id'";
    $data = $con->prepare($sql);
    $data->execute();
    
  }
}

