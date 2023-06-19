<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/caveportal/resource/php/class/core/init.php';

class view extends config
{

  public function collegeSP2()
  {
    $config = new config;
    $con = $config->con();
    $sql = "SELECT * FROM `tbl_group`";
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchAll(PDO::FETCH_OBJ);
    foreach ($rows as $row) {
      echo '<option data-tokens=".' . $row->name . '." value="' . $row->name . '">' . $row->name . '</option>';
      echo 'success';
    }
  }


  public function getdpSRA()
  {
    $user = new user();
    return $user->data()->dp;
  }

  public function getMmSRA()
  {
    $user = new user();
    return $user->data()->mm;
  }


  public function courses()
  {
    $config = new config;
    $con = $config->con();
    $sql = "SELECT * FROM `tbl_course`";
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchAll(PDO::FETCH_OBJ);
    foreach ($rows as $row) {
      echo '<option data-tokens=".' . $row->course . '." value="' . $row->course . '">' . $row->course . '</option>';
    }
  }

  public function checker()
  {
    $config = new config;
    $con = $config->con();
    $sql = "SELECT * FROM `tbl_accounts`";
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchAll(PDO::FETCH_OBJ);
    foreach ($rows as $row) {
      echo '<option data-tokens=".' . $row->fullName . '." value="' . $row->fullName . '">' .   $row->fullName . '</option>';
    }
  }
  public function countries()
  {
    $config = new config;
    $con = $config->con();
    $sql = "SELECT * FROM `tbl_countries`";
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchAll(PDO::FETCH_OBJ);
    foreach ($rows as $row) {
      echo '<option data-tokens=".' . $row->countryname . '." value="' . $row->ccode . '">' . $row->countryname . '</option>';
    }
  }
  public function campuses()
  {
    $config = new config;
    $con = $config->con();
    $sql = "SELECT * FROM `tbl_campuses`";
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchAll(PDO::FETCH_OBJ);
    foreach ($rows as $row) {
      echo '<option data-tokens=".' . $row->campus_name . '." value="' . $row->campus_code . '">' . $row->campus_name . '</option>';
    }
  }

  public function years()
  {
    for ($i = 1950; $i <= date('Y'); $i++)
      echo '<option data-tokens=".' . $i . '." value="' . $i . '">' . $i . '</option>';
  }

   public function days()
  {
    for ($i = 1; $i <= 31; $i++)
      echo '<option data-tokens=".' . $i . '." value="' . $i . '">' . $i . '</option>';
  }

  public function month()
  {
    $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    foreach ($months as $month) {
      echo '<option data-tokens=".' . $month . '." value="' . $month . '">' . $month . '</option>';
    }

  }

  public function pendingCount($year, $month)
  {
    $config = new config;
    $con = $this->con();
    $sql = "SELECT COUNT(*) FROM `tbl_client_user` WHERE MONTH(`date_added`) = '$month' AND YEAR(`date_added`) = '$year' AND `status`= 'PENDING'";
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchColumn();
    return $rows;
  }

  public function allPendingCount()
  {
    $curMonth = date('Y-m');
    $config = new config;
    $con = $this->con();
    $sql = "SELECT COUNT(*) FROM `tbl_client_user` WHERE `status`= 'PENDING'";
    // $sql = "SELECT COUNT(*) FROM `tbl_client_user` WHERE `date_added` LIKE '$curMonth%' AND `status` = 'PENDING'";
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchColumn();
    return $rows;
  }

  //-----------------------------------------------------------------------------------------------------------------------------------------------------------------

    public function allPendingCountMNL()
  {
    $curMonth = date('Y-m');
    $config = new config;
    $con = $this->con();
    $sql = "SELECT COUNT(*) FROM `tbl_client_user` WHERE `status`= 'PENDING' AND `campus` = 'MNL'";
    // $sql = "SELECT COUNT(*) FROM `tbl_client_user` WHERE `date_added` LIKE '$curMonth%' AND `status` = 'PENDING'";
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchColumn();
    return $rows;
  }

    public function allPendingCountMKT()
  {
    $curMonth = date('Y-m');
    $config = new config;
    $con = $this->con();
    $sql = "SELECT COUNT(*) FROM `tbl_client_user` WHERE `status`= 'PENDING' AND `campus` = 'MKT'";
    // $sql = "SELECT COUNT(*) FROM `tbl_client_user` WHERE `date_added` LIKE '$curMonth%' AND `status` = 'PENDING'";
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchColumn();
    return $rows;
  }

    public function allPendingCountMLS()
  {
    $curMonth = date('Y-m');
    $config = new config;
    $con = $this->con();
    $sql = "SELECT COUNT(*) FROM `tbl_client_user` WHERE `status`= 'PENDING' AND `campus` = 'MLS'";
    // $sql = "SELECT COUNT(*) FROM `tbl_client_user` WHERE `date_added` LIKE '$curMonth%' AND `status` = 'PENDING'";
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchColumn();
    return $rows;
  }

    public function pendingCountMNL($year, $month)
  {
    $config = new config;
    $con = $this->con();
    $sql = "SELECT COUNT(*) FROM `tbl_client_user` WHERE MONTH(`date_added`) = '$month' AND YEAR(`date_added`) = '$year' AND `status`= 'PENDING' AND `campus` = 'MNL'";
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchColumn();
    return $rows;
  }

    public function pendingCountMKT($year, $month)
  {
    $config = new config;
    $con = $this->con();
    $sql = "SELECT COUNT(*) FROM `tbl_client_user` WHERE MONTH(`date_added`) = '$month' AND YEAR(`date_added`) = '$year' AND `status`= 'PENDING' AND `campus` = 'MKT'";
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchColumn();
    return $rows;
  }

    public function pendingCountMLS($year, $month)
  {
    $config = new config;
    $con = $this->con();
    $sql = "SELECT COUNT(*) FROM `tbl_client_user` WHERE MONTH(`date_added`) = '$month' AND YEAR(`date_added`) = '$year' AND `status`= 'PENDING' AND `campus` = 'MLS'";
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchColumn();
    return $rows;
  }

  //-----------------------------------------------------------------------------------------------------------------------------------------------------------------

  public function approvedCount($year, $month)
  {
    $config = new config;
    $con = $this->con();
    $sql = "SELECT COUNT(*) FROM `tbl_client_user` WHERE MONTH(`date_completed`) = '$month' AND YEAR(`date_completed`) = '$year' AND `status`= 'VERIFIED'";
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchColumn();
    return $rows;
  }

  public function allApprovedCount()
  {
    $config = new config;
    $con = $this->con();
    $sql = "SELECT COUNT(*) FROM `tbl_client_user` WHERE `status`= 'VERIFIED'";
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchColumn();
    return $rows;
  }

  public function deniedCount($year, $month)
  {
    $config = new config;
    $con = $this->con();
    $sql = "SELECT COUNT(*) FROM `tbl_client_user` WHERE MONTH(`date_completed`) = '$month' AND YEAR(`date_completed`) = '$year' AND `status`= 'DECLINED'";
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchColumn();
    return $rows;
  }

  public function allDeniedCount()
  {
    $config = new config;
    $con = $this->con();
    $sql = "SELECT COUNT(*) FROM `tbl_client_user` WHERE `status`= 'DECLINED'";
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchColumn();
    return $rows;
  }

  public function onHoldCount($year, $month)
  {
    $config = new config;
    $con = $this->con();
    $sql = "SELECT count(*) FROM `tbl_client_user` WHERE MONTH(`date_completed`) = '$month' AND YEAR(`date_completed`) = '$year' AND `status` = 'ON-HOLD'";
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchColumn();
    return $rows;
  }
  public function allOnHoldCount()
  {
    $con = $this->con();
    $sql = "SELECT COUNT(*) FROM `tbl_client_user` WHERE `status`= 'ON-HOLD'";
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchColumn();
    return $rows;
  }

  public function totalVerificationCount()
  {
    $config = new config;
    $con = $this->con();
    $sql = "SELECT COUNT(*) FROM `tbl_client_user` WHERE `status`= 'ON-HOLD' OR `status`= 'DECLINED' OR `status`= 'VERIFIED'";
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchColumn();
    return $rows;
  }

  public function totalMonth()
  {
    $curMonth = date('Y-m');
    $config = new config;
    $con = $this->con();
    // $sql = "SELECT IFNULL(SUM(LAST_DAY(date_added) = LAST_DAY(CURDATE())),0) this_month FROM `tbl_client_user`";
    $sql = "SELECT COUNT(*) FROM `tbl_client_user` WHERE `date_added` LIKE '$curMonth%'";
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchColumn();
    return $rows;
  }

  public function totalMonthDone()
  {
    $curMonth = date('Y-m');
    $config = new config;
    $con = $this->con();
    $sql = "SELECT COUNT(*) FROM `tbl_client_user` WHERE `date_added` LIKE '$curMonth%' AND `status` != 'PENDING'";
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchColumn();
    return $rows;
  }

  public function totalMonthByM($year, $month)
  {
    $config = new config;
    $con = $this->con();
    $sql = "SELECT COUNT(*) FROM `tbl_client_user` WHERE YEAR(`date_added`) = '$year' AND MONTH(`date_added`) = '$month'";
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchColumn();
    return $rows;
  }

  public function totalMonthByMDone($year, $month)
  {
    $config = new config;
    $con = $this->con();
    $sql = "SELECT COUNT(*) FROM `tbl_client_user` WHERE YEAR(`date_added`) = '$year' AND MONTH(`date_added`) = '$month' AND `status` != 'PENDING'";
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchColumn();
    return $rows;
  }

  public function getAverageCycle()
  {
    $config = new config;
    $con = $config->con();
    $sql = "SELECT AVG(DATEDIFF(date_completed, date_added))   AS 'avg_days'
          FROM `tbl_client_user`
          GROUP BY MONTH(date_added)";
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchColumn();
    return $rows;
  }

  public function totalMonthCompleted()
  {
    $config = new config;
    $con = $this->con();
    $sql = "SELECT IFNULL(SUM(LAST_DAY(date_completed) = LAST_DAY(CURDATE())), 0) this_month FROM `tbl_client_user`";
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchColumn();
    return $rows;
  }

  public function totalMonthCompletedByM($year, $month)
  {
    $config = new config;
    $con = $this->con();
    $sql = "SELECT COUNT(*) FROM `tbl_client_user` WHERE YEAR(`date_completed`) = '$year' AND MONTH(`date_completed`) = '$month' AND `status` != 'PENDING'";
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchColumn();
    return $rows;
  }

  public function getStudentRecord($id)
  {
    $config2 = new config2();
    $conn = $config2->conn();
    $sql = "SELECT * FROM `tbl_students` WHERE `country` = :id";
    $query = $conn->prepare($sql);
    $query->bindParam("id", $id, PDO::PARAM_STR);
    $query->execute();
    if ($query->rowCount() > 0) {
      return $query->fetch(PDO::FETCH_OBJ);
    }
  }

  public function getccodeName($id)
  {
    $config2 = new config2();
    $conn = $config2->conn();
    $sql = "SELECT `countryname` FROM `tbl_countries` WHERE `ccode` = :id";
    $query = $conn->prepare($sql);
    $query->bindParam("id", $id, PDO::PARAM_STR);
    $query->execute();
    $rows = $query->fetchColumn();
    return $rows;
  }
}
