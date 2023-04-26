<?php
    public function viewApproveTable(){
      $con = $this->con();
      $sql = "SELECT * FROM `tbl_std` WHERE `status`='APPROVE'";
      $data= $con->prepare($sql);
      $data->execute();
      $result = $data->fetchAll(PDO::FETCH_ASSOC);
      echo "<h3 class='text-center'> Discounts for Review </h3>";
      echo "<div class='table-responsive'>";
      echo "<table id='scholartable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%'>";
      echo "<thead class='thead-dark'>";
      echo "<th class='d-none d-sm-table-cell'>Student Number</th>";
      echo "<th>Fullname</th>";
      echo "<th class='d-none d-sm-table-cell'>Application Type</th>";
      echo "<th class='d-none d-sm-table-cell'>Email Address</th>";
      echo "<th class='d-none d-sm-table-cell'>Status</th>";
      echo "</thead>";
      foreach ($result as $data) {
      echo "<tr>";
      echo "<td class='d-none d-sm-table-cell' >$data[stdnumber]</td>";
      echo "<td style='font-size: 85%;'>$data[fullname]</td>";
      echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>".$data['application_type']."</td>";
      echo "<td class='d-none d-sm-table-cell'>$data[email]</td>";
      echo "<td class='d-none d-sm-table-cell'>$data[status]</td>";
    
    
      echo "</tr>";
      }
      echo "</table>";
    
    }
?>