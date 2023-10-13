<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/caveportal/resource/php/class/core/init.php';


class viewmap extends config2 {

    public function getCountryName($id) {
      $config2 = new config2();
      $conn = $config2->conn();
      $sql = "SELECT COUNT(*) FROM `tbl_client_user` WHERE `status` = 'VERIFIED' AND `country` = :id";
      $query = $conn->prepare($sql);
      $query->bindParam("id", $id, PDO::PARAM_STR);
      $query->execute();
        // $row = $query->fetch(PDO::FETCH_ASSOC);
      $rows = $query->fetchColumn();
      echo json_encode($rows);
    }
  }
  
?>