<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/caveportal/resource/php/class/core/init.php';
require_once 'config2.php';

class viewtable extends config{


public function viewFirstTable(){
  $con = $this->con();
  $sql = "SELECT * FROM `tbl_std` WHERE `status`='PENDING'";
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
  echo "<th style='font-size: 85%;'>Actions</th>";
  echo "</thead>";
  foreach ($result as $data) {
  echo "<tr>";
  echo "<td class='d-none d-sm-table-cell' >$data[stdnumber]</td>";
  echo "<td style='font-size: 85%;'>$data[fullname]</td>";
  echo "<td class='d-none d-sm-table-cell' style='font-size: 85%;'>".$data['application_type']."</td>";
  echo "<td class='d-none d-sm-table-cell'>$data[email]</td>";
  echo "<td class='d-none d-sm-table-cell'>$data[status]</td>";

  echo "<td>
            <a href='editES.php?tn=' class='btn btn-success btn-sm col-12 mt-1'><i class='fa fa-edit'></i>Approve Discounts</a>
            <a href='admesreject.php?tn=' class='btn btn-danger btn-sm col-lg-12 mt-1'><i class='fa fa-trash'></i>Reject Discount</a>
        </td>";
  echo "</tr>";
  }
  echo "</table>";

}

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

//for clientdash
public function viewData_clients(){
  $user = new user();
  $agentID = $user->data()->id;
  $con = $this->con();
  $sql = "SELECT * FROM `tbl_client_user` WHERE `agentID` = $agentID";
  $data = $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);


  echo "<h3 class='mb-4 mt-5'></h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='candtable' class='table table-borderless  table-hover shadow' width='100%'>";
  echo "<thead>";
  echo "<tr>";
  echo "<th scope='col'>Verifier</th>";
  echo "<th scope='col'>Student FullName</th>";
  echo "<th scope='col'>Degree</th>";
  echo "<th scope='col'>Campus</th>";
  echo "<th scope='col'>Date Added</th>";
  echo "<th scope='col'>Date Completed</th>";
  echo "<th scope='col'>Status</th>";
  echo "<th scope='col'>Remarks</th>";
  echo "<th scope='col'>Actions</th>";
  echo "</tr>";
  echo "</thead>";
  foreach ($result as $data) {
    echo "<tr>";
    echo "<td>$data[company_name]"."-"."$data[employee]"."-"."$data[vemail]</td>";
    echo "<td>$data[firstName]"." "."$data[middleName]"." "."$data[lastName]</td>";
    echo "<td>$data[degree]</td>";
    echo "<td>$data[campus]</td>";
    echo "<td>$data[date_added]</td>";
    echo "<td>";
    if($data['date_completed'] == "") {
      echo "<p class='action-title1'>No date available</p>";
    } else {
      echo "$data[date_completed]";
    }
     echo "</td>";
    echo "<td>";
    if($data['status'] == 'PENDING') {
      echo  "<span class='badge badge-primary'>$data[status]</span>";
    }else if($data['status'] == 'VERIFIED') {
      echo  "<span class='badge badge-success'>$data[status]</span>";
    }else if($data['status'] == 'ON-HOLD') {
      echo  "<span class='badge badge-warning'>$data[status]</span> ";
    }else if($data['status'] == 'DECLINED') {
      echo  "<span class='badge badge-danger'>$data[status]</span> ";
    }
    echo "<td>";
    if($data['status'] === 'PENDING') {
      echo "<p class='action-title1'>No remarks available</p>";
    } else if($data['status'] === 'VERIFIED') {
      echo "<p class='action-title1'>Verified</p>";
    } else {
      echo "$data[remarks]";
    }
    echo "</td>";

    echo "<td>";
    if($data['status'] === 'VERIFIED'){
      echo "<a class='btn btn-sm' href='www.ceumnlregistrar.com/caveportal/pdfcertificates.php?id=$data[id]' download>Download Certificate
      <div class='icon'>
      <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-download' viewBox='0 0 16 16'>
      <path d='M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z'/>
      <path d='M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z'/>
    </svg>
          </div>
      </a></td>";
    }else if($data['status'] == "ON-HOLD"){
      echo "<li class='actions'>
      <a class='btn btn-sm' href='updateDocuments.php?updatedoc=$data[id]'>Resubmit Documents
        <div class='icon'>
        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
<path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
</svg>
        </div>
      </a>
    </li>";
    }
    else {
      echo "<p class='action-title justify-content-center align-items-center text-align-center'>No action available</p>";
    }
    echo "</tr>";
  }
  echo "</table>";
}


public function viewApprovedData($year, $month){
  $con = $this->con();
  $sql = "SELECT * FROM `tbl_client_user` WHERE MONTH(`date_added`) = '$month' AND YEAR(`date_added`) = '$year' AND `status` = 'VERIFIED'";
  $data = $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='mb-4 mt-5'>APPROVED APPLICATIONS</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='candtable' class='table table-borderless shadow' width='100%'>";
  echo "<thead>
          <tr>
          <th scope='col'>Verifier</th>
          <th scope='col'>Transaction Number</th>
          <th scope='col'>Student Fullname</th>
          <th scope='col'>Submitted Degree</th>
          <th scope='col'>Submitted Campus</th>
          <th scope='col'>Date Added</th>
          <th scope='col'>Consent Forms</th>
          <th scope='col'>Document Forms</th>
          <th scope='col'>Valid ID</th>
          <th scope='col'>Status</th>
          <th scope='col'>Admin Actions</th>

          </tr>
  </thead><tbody>";
  foreach ($result as $data) {
      echo "<tr>";
      echo "<td>$data[company_name]".":<br>"."$data[employee]"."-"."$data[vemail]</td>";
      echo "<td>$data[tn]</td>";
      echo "<td>$data[firstName]"." "."$data[middleName]"." "."$data[lastName]</td>";
      echo "<td>$data[degree]</td>";
      echo "<td>$data[campus]</td>";
      echo "<td>$data[date_added]</td>";
      echo "<td><a href='$data[consentForm]' target='_blank'><i class='bi bi-eye-fill icons'title='View PDF'></i></a><br><a href='$data[consentForm]' download><i class='bi bi-arrow-down-circle-fill icons'title='Download PDF'></i></a></td>";
      echo "<td><a href='$data[diploma]' target='_blank'><i class='bi bi-eye-fill icons'title='View PDF'></i></a><br><a href='$data[diploma]' download><i class='bi bi-arrow-down-circle-fill icons'title='Download PDF'></i></a></td>";
      echo "<td><a href='$data[validID]' target='_blank'><i class='bi bi-eye-fill icons'title='View PDF'></i></a><br><a href='$data[validID]' download><i class='bi bi-arrow-down-circle-fill icons'title='Download PDF'></i></a></td>";
      echo "<td><span class='badge badge-primary'>$data[status]</span><br>"; 
      
            if(!empty($data['checker'])){
                echo "<span class='badge badge-success'> CHECKED </span>";
              }
            elseif(!empty($data['educ_status'])){
                echo "<span class='badge badge-warning'> FOR COUNTER-CHECK </span>";
             }
            else{
                echo "<span class='badge badge-info'> FOR RECORDS CHECK </span>";
              }

      echo "</td>";
      echo "<td>

      <li class='actions'><a class='btn btn-sm'href='info.php?id=$data[id]'>Information
      <div class='icon'>
      <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye' viewBox='0 0 16 16'>
        <path d='M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z'/>
        <path d='M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z'/>
      </svg>
          </div>
      </a></li>

      <li class='actions'>     
      <a class='btn btn-sm' href='adminfunctions.php?approved=$data[id]'>Resend Email
        <div class='icon'>
        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2' viewBox='0 0 16 16'>
        <path d='M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z'/>
      </svg>
        </div>
      </a>
    </li>

      </td>";
      echo "</tr>";
  }
  echo "</table>";
}
public function viewAllApprovedData(){
  $con = $this->con();
  $sql = "SELECT * FROM `tbl_client_user` WHERE `status` = 'VERIFIED'";
  $data = $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='mb-4 mt-5'>APPROVED APPLICATIONS</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='candtable' class='table table-borderless shadow' width='100%'>";
  echo "<thead>
          <tr>
          <th scope='col'>Verifier</th>
          <th scope='col'>Transaction Number</th>
          <th scope='col'>Student Fullname</th>
          <th scope='col'>Submitted Degree</th>
          <th scope='col'>Submitted Campus</th>
          <th scope='col'>Date Added</th>
          <th scope='col'>Consent Forms</th>
          <th scope='col'>Document Forms</th>
          <th scope='col'>Valid ID</th>
          <th scope='col'>Status</th>
          <th scope='col'>Admin Actions</th>

          </tr>
  </thead><tbody>";
  foreach ($result as $data) {
      echo "<tr>";
      echo "<td>$data[company_name]".":<br>"."$data[employee]"."-"."$data[vemail]</td>";
      echo "<td>$data[tn]</td>";
      echo "<td>$data[firstName]"." "."$data[middleName]"." "."$data[lastName]</td>";
      echo "<td>$data[degree]</td>";
      echo "<td>$data[campus]</td>";
      echo "<td>$data[date_added]</td>";
      echo "<td><a href='$data[consentForm]' target='_blank'><i class='bi bi-eye-fill icons'title='View PDF'></i></a><br><a href='$data[consentForm]' download><i class='bi bi-arrow-down-circle-fill icons'title='Download PDF'></i></a></td>";
      echo "<td><a href='$data[diploma]' target='_blank'><i class='bi bi-eye-fill icons'title='View PDF'></i></a><br><a href='$data[diploma]' download><i class='bi bi-arrow-down-circle-fill icons'title='Download PDF'></i></a></td>";
      echo "<td><a href='$data[validID]' target='_blank'><i class='bi bi-eye-fill icons'title='View PDF'></i></a><br><a href='$data[validID]' download><i class='bi bi-arrow-down-circle-fill icons'title='Download PDF'></i></a></td>";
      echo "<td><span class='badge badge-primary'>$data[status]</span><br>"; 
      
            if(!empty($data['checker'])){
                echo "<span class='badge badge-success'> CHECKED </span>";
              }
            elseif(!empty($data['educ_status'])){
                echo "<span class='badge badge-warning'> FOR COUNTER-CHECK </span>";
             }
            else{
                echo "<span class='badge badge-info'> FOR RECORDS CHECK </span>";
              }

      echo "</td>";
      echo "<td>

      <li class='actions'><a class='btn btn-sm'href='info.php?id=$data[id]'>Information
      <div class='icon'>
      <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye' viewBox='0 0 16 16'>
        <path d='M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z'/>
        <path d='M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z'/>
      </svg>
          </div>
      </a></li>

      <li class='actions'>     
      <a class='btn btn-sm' href='adminfunctions.php?approved=$data[id]'>Resend Email
        <div class='icon'>
        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2' viewBox='0 0 16 16'>
        <path d='M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z'/>
      </svg>
        </div>
      </a>
    </li>
      </td>";
      echo "</tr>";
  }
  echo "</table>";
}

public function viewOnHoldData($year, $month){
  $con = $this->con();
  $sql = "SELECT * FROM `tbl_client_user` WHERE MONTH(`date_added`) = '$month' AND YEAR(`date_added`) = '$year' AND `status` = 'ON-HOLD'";
  $data = $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='mb-4 mt-5'>ON-HOLD APPLICATIONS</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='onHoldtable' class='table table-borderless  table-hover shadow' width='100%'>";
  echo "<thead>
          <tr>
          <th scope='col'>Verifier</th>
          <th scope='col'>Transaction Number</th>
          <th scope='col'>Student Fullname</th>
          <th scope='col'>Submitted Degree</th>
          <th scope='col'>Submitted Campus</th>
          <th scope='col'>Date Added</th>
          <th scope='col'>Consent Forms</th>
          <th scope='col'>Document Forms</th>
          <th scope='col'>Valid ID</th>
          <th scope='col'>Status</th>
          <th scope='col'>Admin Actions</th>

          </tr>
  </thead><tbody>";
  foreach ($result as $data) {
      echo "<tr>";
      echo "<td>$data[company_name]".":<br>"."$data[employee]"."-"."$data[vemail]</td>";
      echo "<td>$data[tn]</td>";
      echo "<td>$data[firstName]"." "."$data[middleName]"." "."$data[lastName]</td>";
      echo "<td>$data[degree]</td>";
      echo "<td><li class='actions'>
        <button class='btn btn-sm changeC2' id='btn' type='button' data-toggle='modal' data-id='$data[id]' data-target='#edit-campus2'>$data[campus]
          <div class='icon'>
          <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
  <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
</svg>
          </div>
        </button>
      </li></td>";
      echo "<td>$data[date_added]</td>";
      echo "<td><a href='$data[consentForm]' target='_blank'><i class='bi bi-eye-fill icons'title='View PDF'></i></a><br><a href='$data[consentForm]' download><i class='bi bi-arrow-down-circle-fill icons'title='Download PDF'></i></a></td>";
      echo "<td><a href='$data[diploma]' target='_blank'><i class='bi bi-eye-fill icons'title='View PDF'></i></a><br><a href='$data[diploma]' download><i class='bi bi-arrow-down-circle-fill icons'title='Download PDF'></i></a></td>";
      echo "<td><a href='$data[validID]' target='_blank'><i class='bi bi-eye-fill icons'title='View PDF'></i></a><br><a href='$data[validID]' download><i class='bi bi-arrow-down-circle-fill icons'title='Download PDF'></i></a></td>";
      echo "<td><span class='badge badge-primary'>$data[status]</span><br>"; 
      
            if(!empty($data['checker'])){
                echo "<span class='badge badge-success'> CHECKED </span>";
              }
            elseif(!empty($data['educ_status'])){
                echo "<span class='badge badge-warning'> FOR COUNTER-CHECK </span>";
             }
            else{
                echo "<span class='badge badge-info'> FOR RECORDS CHECK </span>";
              }

      echo "</td>";
      echo "<td>

      <li class='actions'><a class='btn btn-sm'href='info.php?id=$data[id]'>Information
      <div class='icon'>
      <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye' viewBox='0 0 16 16'>
        <path d='M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z'/>
        <path d='M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z'/>
      </svg>
          </div>
      </a></li>

      <li class='actions'>     
      <a class='btn btn-sm' href='adminfunctions.php?approved=$data[id]'>Verify
        <div class='icon'>
        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2' viewBox='0 0 16 16'>
        <path d='M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z'/>
      </svg>
        </div>
      </a>
    </li>
      <li class='actions'><a class='btn btn-sm btn-sm-1 disabled'href='remarks1.php?hold=$data[id]'></a>On Hold
        <div class='icon'>
        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-clock' viewBox='0 0 16 16'>
        <path d='M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z'/>
        <path d='M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z'/>
      </svg>
        </div>
      </a></li>

      <li class='actions'><a class='btn btn-sm'href='remarks.php?denied=$data[id]'>Denied
      <div class='icon'>
      <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-x-lg' viewBox='0 0 16 16'>
      <path d='M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z'/>
    </svg>
          </div>
      </a></li>

      </td>";
      echo "</tr>";
  }
  echo "</tbody></table>";
}

public function viewAllOnHoldData(){
  $con = $this->con();
  $sql = "SELECT * FROM `tbl_client_user` WHERE `status` = 'ON-HOLD'";
  $data = $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='mb-4 mt-5'>ON-HOLD APPLICATIONS</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='onHoldtable' class='table table-borderless  table-hover shadow' width='100%'>";
 echo "<thead>
          <tr>
          <th scope='col'>Verifier</th>
          <th scope='col'>Transaction Number</th>
          <th scope='col'>Student Fullname</th>
          <th scope='col'>Submitted Degree</th>
          <th scope='col'>Submitted Campus</th>
          <th scope='col'>Date Added</th>
          <th scope='col'>Consent Forms</th>
          <th scope='col'>Document Forms</th>
          <th scope='col'>Valid ID</th>
          <th scope='col'>Status</th>
          <th scope='col'>Admin Actions</th>

          </tr>
  </thead><tbody>";
  foreach ($result as $data) {
      echo "<tr>";
      echo "<td>$data[company_name]".":<br>"."$data[employee]"."-"."$data[vemail]</td>";
      echo "<td>$data[tn]</td>";
      echo "<td>$data[firstName]"." "."$data[middleName]"." "."$data[lastName]</td>";
      echo "<td>$data[degree]</td>";
      echo "<td><li class='actions'>
        <button class='btn btn-sm changeC2' id='btn' type='button' data-toggle='modal' data-id='$data[id]' data-target='#edit-campus2'>$data[campus]
          <div class='icon'>
          <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
  <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
</svg>
          </div>
        </button>
      </li></td>";
      echo "<td>$data[date_added]</td>";
      echo "<td><a href='$data[consentForm]' target='_blank'><i class='bi bi-eye-fill icons'title='View PDF'></i></a><br><a href='$data[consentForm]' download><i class='bi bi-arrow-down-circle-fill icons'title='Download PDF'></i></a></td>";
      echo "<td><a href='$data[diploma]' target='_blank'><i class='bi bi-eye-fill icons'title='View PDF'></i></a><br><a href='$data[diploma]' download><i class='bi bi-arrow-down-circle-fill icons'title='Download PDF'></i></a></td>";
      echo "<td><a href='$data[validID]' target='_blank'><i class='bi bi-eye-fill icons'title='View PDF'></i></a><br><a href='$data[validID]' download><i class='bi bi-arrow-down-circle-fill icons'title='Download PDF'></i></a></td>";
      echo "<td><span class='badge badge-primary'>$data[status]</span><br>"; 
      
            if(!empty($data['checker'])){
                echo "<span class='badge badge-success'> CHECKED </span>";
              }
            elseif(!empty($data['educ_status'])){
                echo "<span class='badge badge-warning'> FOR COUNTER-CHECK </span>";
             }
            else{
                echo "<span class='badge badge-info'> FOR RECORDS CHECK </span>";
              }

      echo "</td>";
      echo "<td>

      <li class='actions'><a class='btn btn-sm'href='info.php?id=$data[id]'>Information
      <div class='icon'>
      <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye' viewBox='0 0 16 16'>
          <path d='M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z'/>
          <path d='M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z'/>
        </svg>
          </div>
      </a></li>

      <li class='actions'>     
      <a class='btn btn-sm' href='adminfunctions.php?approved=$data[id]'>Verify
        <div class='icon'>
        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2' viewBox='0 0 16 16'>
        <path d='M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z'/>
      </svg>
        </div>
      </a>
    </li>
      <li class='actions'><a class='btn btn-sm btn-sm-1 disabled'href='remarks1.php?hold=$data[id]'>On Hold
        <div class='icon'>
        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-clock' viewBox='0 0 16 16'>
        <path d='M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z'/>
        <path d='M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z'/>
      </svg>
        </div>
      </a></li>

      <li class='actions'><a class='btn btn-sm'href='remarks.php?denied=$data[id]'>Denied
      <div class='icon'>
      <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-x-lg' viewBox='0 0 16 16'>
      <path d='M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z'/>
    </svg>
          </div>
      </a></li>

      </td>";
      echo "</tr>";
  }
  echo "</tbody></table>";
}

public function viewPendingData($year, $month){
  $con = $this->con();
  $sql = "SELECT * FROM `tbl_client_user` WHERE MONTH(`date_added`) = '$month' AND YEAR(`date_added`) = '$year' AND `status` = 'PENDING'";
  $data = $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);



  echo "<h3 class='mb-4 mt-5'>PENDING APPLICATIONS</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='pendingtable' class='table table-borderless  table-hover shadow' width='100%'>";
  echo "<thead>
          <tr>
          <th scope='col'>Verifier</th>
          <th scope='col'>Transaction Number</th>
          <th scope='col'>Student Fullname</th>
          <th scope='col'>Submitted Degree</th>
          <th scope='col'>Submitted Campus</th>
          <th scope='col'>Date Added</th>
          <th scope='col'>Consent Forms</th>
          <th scope='col'>Document Forms</th>
          <th scope='col'>Valid ID</th>
          <th scope='col'>Status</th>
          <th scope='col'>Admin Actions</th>

          </tr>
  </thead><tbody>";
  foreach ($result as $data) {
      echo "<tr>";
      echo "<td>$data[company_name]".":<br>"."$data[employee]"."-"."$data[vemail]</td>";
      echo "<td>$data[tn]</td>";
      echo "<td>$data[firstName]"." "."$data[middleName]"." "."$data[lastName]</td>";
      echo "<td>$data[degree]</td>";
      echo "<td><li class='actions'>
        <button class='btn btn-sm changeC2' id='btn' type='button' data-toggle='modal' data-id='$data[id]' data-target='#edit-campus2'>$data[campus]
          <div class='icon'>
          <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
  <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
</svg>
          </div>
        </button>
      </li></td>";
      echo "<td>$data[date_added]</td>";
      echo "<td><a href='$data[consentForm]' target='_blank'><i class='bi bi-eye-fill icons'title='View PDF'></i></a><br><a href='$data[consentForm]' download><i class='bi bi-arrow-down-circle-fill icons'title='Download PDF'></i></a></td>";
      echo "<td><a href='$data[diploma]' target='_blank'><i class='bi bi-eye-fill icons'title='View PDF'></i></a><br><a href='$data[diploma]' download><i class='bi bi-arrow-down-circle-fill icons'title='Download PDF'></i></a></td>";
      echo "<td><a href='$data[validID]' target='_blank'><i class='bi bi-eye-fill icons'title='View PDF'></i></a><br><a href='$data[validID]' download><i class='bi bi-arrow-down-circle-fill icons'title='Download PDF'></i></a></td>";
      echo "<td><span class='badge badge-primary'>$data[status]</span><br>"; 
      
            if(!empty($data['checker'])){
                echo "<span class='badge badge-success'> CHECKED </span>";
              }
            elseif(!empty($data['educ_status'])){
                echo "<span class='badge badge-warning'> FOR COUNTER-CHECK </span>";
             }
            else{
                echo "<span class='badge badge-info'> FOR RECORDS CHECK </span>";
              }

      echo "</td>";
      echo "<td>

      <li class='actions'><a class='btn btn-sm'href='info.php?id=$data[id]'>Information
      <div class='icon'>
      <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye' viewBox='0 0 16 16'>
        <path d='M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z'/>
        <path d='M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z'/>
      </svg>
          </div>
      </a></li>

      <li class='actions'>     
      <a class='btn btn-sm' href='adminfunctions.php?approved=$data[id]'>Verify
        <div class='icon'>
        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2' viewBox='0 0 16 16'>
        <path d='M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z'/>
      </svg>
        </div>
      </a>
    </li>
      <li class='actions'><a class='btn btn-sm btn-sm-1'href='remarks1.php?hold=$data[id]'>On Hold
        <div class='icon'>
        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-clock' viewBox='0 0 16 16'>
        <path d='M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z'/>
        <path d='M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z'/>
      </svg>
        </div>
      </a></li>

      <li class='actions'><a class='btn btn-sm'href='remarks.php?denied=$data[id]'>Denied
      <div class='icon'>
      <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-x-lg' viewBox='0 0 16 16'>
      <path d='M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z'/>
    </svg>
          </div>
      </a></li>

      </td>";
      echo "</tr>";
  }
  echo "</tbody></table>";
}

public function viewAllPendingData(){
  $con = $this->con();
  $sql = "SELECT * FROM `tbl_client_user` WHERE `status` = 'PENDING'";
  $data = $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);



  echo "<h3 class='mb-4 mt-5'>PENDING APPLICATIONS</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='pendingtable' class='table table-borderless  table-hover shadow' width='100%'>";
  echo "<thead>
          <tr>
          <th scope='col'>Verifier</th>
          <th scope='col'>Transaction Number</th>
          <th scope='col'>Student Fullname</th>
          <th scope='col'>Submitted Degree</th>
          <th scope='col'>Submitted Campus</th>
          <th scope='col'>Date Added</th>
          <th scope='col'>Consent Forms</th>
          <th scope='col'>Document Forms</th>
          <th scope='col'>Valid ID</th>
          <th scope='col'>Status</th>
          <th scope='col'>Admin Actions</th>

          </tr>
  </thead><tbody>";
  foreach ($result as $data) {
      echo "<tr>";
      echo "<td>$data[company_name]".":<br>"."$data[employee]"."-"."$data[vemail]</td>";
      echo "<td>$data[tn]</td>";
      echo "<td>$data[firstName]"." "."$data[middleName]"." "."$data[lastName]</td>";
      echo "<td>$data[degree]</td>";
      echo "<td><li class='actions'>
        <button class='btn btn-sm changeC2' id='btn' type='button' data-toggle='modal' data-id='$data[id]' data-target='#edit-campus2'>$data[campus]
          <div class='icon'>
          <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
  <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
</svg>
          </div>
        </button>
      </li></td>";
      echo "<td>$data[date_added]</td>";
      echo "<td><a href='$data[consentForm]' target='_blank'><i class='bi bi-eye-fill icons'title='View PDF'></i></a><br><a href='$data[consentForm]' download><i class='bi bi-arrow-down-circle-fill icons'title='Download PDF'></i></a></td>";
      echo "<td><a href='$data[diploma]' target='_blank'><i class='bi bi-eye-fill icons'title='View PDF'></i></a><br><a href='$data[diploma]' download><i class='bi bi-arrow-down-circle-fill icons'title='Download PDF'></i></a></td>";
      echo "<td><a href='$data[validID]' target='_blank'><i class='bi bi-eye-fill icons'title='View PDF'></i></a><br><a href='$data[validID]' download><i class='bi bi-arrow-down-circle-fill icons'title='Download PDF'></i></a></td>";
      echo "<td><span class='badge badge-primary'>$data[status]</span><br>"; 
      
            if(!empty($data['checker'])){
                echo "<span class='badge badge-success'> CHECKED </span>";
              }
            elseif(!empty($data['educ_status'])){
                echo "<span class='badge badge-warning'> FOR COUNTER-CHECK </span>";
             }
            else{
                echo "<span class='badge badge-info'> FOR RECORDS CHECK </span>";
              }

      echo "</td>";
      echo "<td>

      <li class='actions'><a class='btn btn-sm'href='info.php?id=$data[id]'>Information
      <div class='icon'>
      <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye' viewBox='0 0 16 16'>
        <path d='M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z'/>
        <path d='M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z'/>
      </svg>
          </div>
      </a></li>

      <li class='actions'>     
      <a class='btn btn-sm' href='adminfunctions.php?approved=$data[id]'>Verify
        <div class='icon'>
        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2' viewBox='0 0 16 16'>
        <path d='M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z'/>
      </svg>
        </div>
      </a>
    </li>
      <li class='actions'><a class='btn btn-sm btn-sm-1'href='remarks1.php?hold=$data[id]'>On Hold
        <div class='icon'>
        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-clock' viewBox='0 0 16 16'>
        <path d='M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z'/>
        <path d='M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z'/>
      </svg>
        </div>
      </a></li>

      <li class='actions'><a class='btn btn-sm' href='remarks.php?denied=$data[id]'> Denied
      <div class='icon'>
      <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-x-lg' viewBox='0 0 16 16'>
      <path d='M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z'/>
    </svg>
          </div>
      </a></li>

      </td>";
      echo "</tr>";
  }
  echo "</tbody></table>";
}
public function viewAllDeniedData(){
  $con = $this->con();
  $sql = "SELECT * FROM `tbl_client_user` WHERE `status` = 'DECLINED'";
  $data = $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='mb-4 mt-5'>DECLINED APPLICATIONS</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='deniedtable' class='table table-borderless table-hover shadow' width='100%'>";

  echo "<thead>
          <tr>
          <th scope='col'>Verifier</th>
          <th scope='col'>Transaction Number</th>
          <th scope='col'>Student Fullname</th>
          <th scope='col'>Submitted Degree</th>
          <th scope='col'>Submitted Campus</th>
          <th scope='col'>Date Added</th>
          <th scope='col'>Consent Forms</th>
          <th scope='col'>Document Forms</th>
          <th scope='col'>Valid ID</th>
          <th scope='col'>Status</th>
          <th scope='col'>Admin Actions</th>

          </tr>
  </thead><tbody>";
  foreach ($result as $data) {
      echo "<tr>";
      echo "<td>$data[company_name]".":<br>"."$data[employee]"."-"."$data[vemail]</td>";
      echo "<td>$data[tn]</td>";
      echo "<td>$data[firstName]"." "."$data[middleName]"." "."$data[lastName]</td>";
      echo "<td>$data[degree]</td>";
      echo "<td>$data[campus]</td>";
      echo "<td>$data[date_added]</td>";
      echo "<td><a href='$data[consentForm]' target='_blank'><i class='bi bi-eye-fill icons'title='View PDF'></i></a><br><a href='$data[consentForm]' download><i class='bi bi-arrow-down-circle-fill icons'title='Download PDF'></i></a></td>";
      echo "<td><a href='$data[diploma]' target='_blank'><i class='bi bi-eye-fill icons'title='View PDF'></i></a><br><a href='$data[diploma]' download><i class='bi bi-arrow-down-circle-fill icons'title='Download PDF'></i></a></td>";
      echo "<td><a href='$data[validID]' target='_blank'><i class='bi bi-eye-fill icons'title='View PDF'></i></a><br><a href='$data[validID]' download><i class='bi bi-arrow-down-circle-fill icons'title='Download PDF'></i></a></td>";
      echo "<td><span class='badge badge-primary'>$data[status]</span><br>"; 
      
            if(!empty($data['checker'])){
                echo "<span class='badge badge-success'> CHECKED </span>";
              }
            elseif(!empty($data['educ_status'])){
                echo "<span class='badge badge-warning'> FOR COUNTER-CHECK </span>";
             }
            else{
                echo "<span class='badge badge-info'> FOR RECORDS CHECK </span>";
              }

      echo "</td>";
      echo "<td>

      <li class='actions'><a class='btn btn-sm'href='info.php?id=$data[id]'>Information
      <div class='icon'>
      <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye' viewBox='0 0 16 16'>
        <path d='M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z'/>
        <path d='M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z'/>
      </svg>
          </div>
      </a></li>
      </td>";
      echo "</tr>";
  }
  echo "</tbody></table>";
}

public function viewDeniedData($year, $month){
  $con = $this->con();
  $sql = "SELECT * FROM `tbl_client_user` WHERE MONTH(`date_added`) = '$month' AND YEAR(`date_added`) = '$year' AND `status` = 'DECLINED'";
  $data = $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='mb-4 mt-5'>DECLINED APPLICATIONS</h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='deniedtable' class='table table-borderless table-hover shadow' width='100%'>";

  echo "<thead>
          <tr>
          <th scope='col'>Verifier</th>
          <th scope='col'>Transaction Number</th>
          <th scope='col'>Student Fullname</th>
          <th scope='col'>Submitted Degree</th>
          <th scope='col'>Submitted Campus</th>
          <th scope='col'>Date Added</th>
          <th scope='col'>Consent Forms</th>
          <th scope='col'>Document Forms</th>
          <th scope='col'>Valid ID</th>
          <th scope='col'>Status</th>
          <th scope='col'>Admin Actions</th>

          </tr>
  </thead><tbody>";
  foreach ($result as $data) {
      echo "<tr>";
      echo "<td>$data[company_name]".":<br>"."$data[employee]"."-"."$data[vemail]</td>";
      echo "<td>$data[tn]</td>";
      echo "<td>$data[firstName]"." "."$data[middleName]"." "."$data[lastName]</td>";
      echo "<td>$data[degree]</td>";
      echo "<td>$data[campus]</td>";
      echo "<td>$data[date_added]</td>";
      echo "<td><a href='$data[consentForm]' target='_blank'><i class='bi bi-eye-fill icons'title='View PDF'></i></a><br><a href='$data[consentForm]' download><i class='bi bi-arrow-down-circle-fill icons'title='Download PDF'></i></a></td>";
      echo "<td><a href='$data[diploma]' target='_blank'><i class='bi bi-eye-fill icons'title='View PDF'></i></a><br><a href='$data[diploma]' download><i class='bi bi-arrow-down-circle-fill icons'title='Download PDF'></i></a></td>";
      echo "<td><a href='$data[validID]' target='_blank'><i class='bi bi-eye-fill icons'title='View PDF'></i></a><br><a href='$data[validID]' download><i class='bi bi-arrow-down-circle-fill icons'title='Download PDF'></i></a></td>";
      echo "<td><span class='badge badge-primary'>$data[status]</span><br>"; 
      
            if(!empty($data['checker'])){
                echo "<span class='badge badge-success'> CHECKED </span>";
              }
            elseif(!empty($data['educ_status'])){
                echo "<span class='badge badge-warning'> FOR COUNTER-CHECK </span>";
             }
            else{
                echo "<span class='badge badge-info'> FOR RECORDS CHECK </span>";
              }

      echo "</td>";
      echo "<td>

      <li class='actions'><a class='btn btn-sm'href='info.php?id=$data[id]'>Information
      <div class='icon'>
      <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye' viewBox='0 0 16 16'>
        <path d='M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z'/>
        <path d='M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z'/>
      </svg>
          </div>
      </a></li>
      </td>";
      echo "</tr>";
  }
  echo "</tbody></table>";
}
public function viewMapResultTable($id){
  $config2 = new config2();
  $view = new view();
  $conn = $config2->conn();
  $sql = "SELECT * FROM `tbl_students` WHERE `country` = :id";
  $data = $conn->prepare($sql);
  $data->bindParam("id", $id, PDO::PARAM_STR);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "";
  echo "<div class='table-responsive'>";

  echo "<thead>";
  echo "<tr>
          <th scope='col'>Student FullName</th>
          <th scope='col'>Degree</th>
          <th scope='col'>yearsGrad</th>
          <th scope='col'>Campus</th>
          <th scope='col'>Country</th>
          <th scope='col'>Employee Name</th>
          <th scope='col'>Verifier</th>


  </tr>";

  echo "</thead>";
  foreach ($result as $data) {
  echo "<tr>";
  echo "<td>$data[firstName]"." "."$data[middleName]"." "."$data[lastName]</td>";
  echo "<td>$data[degree]</td>";
  echo "<td>$data[yearsGrad]</td>";
  echo "<td>$data[campus]</td>";
  echo "<td>$data[country]</td>";
  echo "<td>$data[employee_name]</td>";
  echo "<td>$data[company_name]"."-"."$data[employee]"."-"."$data[vemail]</td>";
  echo "</tr>";
  }


}

public function viewLogData(){
  $con = $this->con();
  $sql = "SELECT * FROM `tbl_client_user`";
  $data = $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);

  echo "<h3 class='mb-4 mt-5'>Application Reports</h3>";
  echo "<table id='viewlogtable' class='table table-borderless  table-hover shadow' width='100%'>";
  echo "<thead>";
  echo "<tr>";

  echo "<th scope='col'>Transaction Number</th>";
  echo "<th scope='col'>Status</th>";
  echo "<th scope='col'>Checked</th>";

  echo "<th scope='col'>Last Name</th>";
  echo "<th scope='col'>First Name</th>";
  echo "<th scope='col'>Middle Name</th>";
  echo "<th scope='col'>Birthdate</th>";

  echo "<th scope='col'>Submitted Degree</th>";
  echo "<th scope='col'>Submitted Campus</th>";
  echo "<th scope='col'>Submitted Graduation Date</th>";
  echo "<th scope='col'>Submitted Last Attendance Date</th>";

  echo "<th scope='col'>Verified Degree</th>";
  echo "<th scope='col'>Education Status</th>";
  echo "<th scope='col'>Verified Campus</th>";


  echo "<th scope='col'>Year and Sem Entered</th>";
  echo "<th scope='col'>Entrance Date</th>";
  echo "<th scope='col'>Year and Sem Last Attended</th>";
  echo "<th scope='col'>Verified Date Graduated</th>";
  echo "<th scope='col'>Verified Date Last Attended</th>";

  echo "<th scope='col'>Verifier Name</th>";
  echo "<th scope='col'>Verifying Company</th>";
  echo "<th scope='col'>Country</th>";
  echo "<th scope='col'>Verifier Email Address</th>";

  echo "<th scope='col'>Date Added</th>";
  echo "<th scope='col'>Date Completed</th>";

  echo "<th scope='col'>Checker</th>";
  echo "<th scope='col'>Checked Date</th>";

  echo "<th scope='col'>Remarks</th>";

  echo "</tr>";
  echo "</thead>";
  foreach ($result as $data) {
    echo "<tr>";
    //echo "<td>$data[firstName]"." "."$data[middleName]"." "."$data[lastName]</td>";
    
    echo "<td>$data[tn]</td>";
    echo "<td>";
      if($data['status'] == 'PENDING') {
        echo  "<span class='badge badge-primary'>$data[status]</span>";
      }elseif($data['status'] == 'VERIFIED') {
        echo  "<span class='badge badge-success'>$data[status]</span>";
      }elseif($data['status'] == 'ON-HOLD') {
        echo  "<span class='badge badge-warning'>$data[status]</span> ";
      }elseif($data['status'] == 'DECLINED') {
        echo  "<span class='badge badge-danger'>$data[status]</span> ";
      }else{}
      
    echo "</td><td>";
      if(!empty($data['checker'])){
                echo "<span class='badge badge-success'> CHECKED </span>";
              }
            elseif(!empty($data['educ_status'])){
                echo "<span class='badge badge-warning'> FOR COUNTER-CHECK </span>";
             }
            else{
                echo "<span class='badge badge-info'> FOR RECORDS CHECK </span>";
              }
    echo "</td>";

    echo "<td>$data[lastName]</td>";
    echo "<td>$data[firstName]</td>";
    echo "<td>$data[middleName]</td>";
    echo "<td>$data[bdate]</td>";

    echo "<td>$data[degree]</td>";
    echo "<td>$data[campus]</td>";
    echo "<td>$data[yearsGrad]</td>";
    echo "<td>$data[yearsLastAtt]</td>";

    echo "<td>$data[vfdegree]</td>";
    echo "<td>";      
      if($data['educ_status'] == "G") {
        echo "Graduate";
      }elseif($data['educ_status'] == "UG") {
        echo "Undergraduate";
      }else {
        echo "";
      }
    echo "</td>";
    echo "<td>$data[vfcampus]</td>";

    echo "<td>$data[ent_sy]</td>";  
    echo "<td>$data[vfDateEnt]</td>";   
    echo "<td>$data[la_sy]</td>";
    echo "<td>$data[vfDateGrad]</td>";
    echo "<td>$data[vfDateAtt]</td>";

    echo "<td>$data[employee]</td>";
    echo "<td>$data[company_name]</td>";
    echo "<td>$data[country]</td>";
    echo "<td>$data[vemail]</td>";

    echo "<td>$data[date_added]</td>";
    echo "<td>";
      if($data['date_completed'] == "") {
        echo "<p class='action-title1'>No date available</p>";
      } else {
        echo "$data[date_completed]";
      }
    echo "</td>";
     
    echo "<td>$data[checker]</td>";

    $cdate = date("m-d-Y", strtotime($data["checked_date"]));
    
    if($cdate == "01-01-1970"){
            $cdate = "";
        }

    echo "<td>$cdate</td>";

    echo "<td>";
    if($data['status'] == "PENDING") {
      echo "<p class='action-title1'>No remarks available</p>";
    }elseif($data['status'] == "VERIFIED") {
      echo "<p class='action-title1'>Verified</p>";
    }else {
      echo "$data[remarks]";
    }
    echo "</td>";

    echo "</tr>";
  }
  echo "</table>";
}

public function sortViewLogData($month, $year){
  $con = $this->con();
  $sql = "SELECT * FROM `tbl_client_user`WHERE MONTH(`date_added`) = '$month' AND YEAR(`date_added`) = '$year'";
  $data = $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);

   echo "<h3 class='mb-4 mt-5'>Application Reports</h3>";
  echo "<table id='viewlogtable' class='table table-borderless  table-hover shadow' width='100%'>";
  echo "<thead>";
  echo "<tr>";

  echo "<th scope='col'>Transaction Number</th>";
  echo "<th scope='col'>Status</th>";
  echo "<th scope='col'>Checked</th>";

  echo "<th scope='col'>Last Name</th>";
  echo "<th scope='col'>First Name</th>";
  echo "<th scope='col'>Middle Name</th>";
  echo "<th scope='col'>Birthdate</th>";

  echo "<th scope='col'>Submitted Degree</th>";
  echo "<th scope='col'>Submitted Campus</th>";
  echo "<th scope='col'>Submitted Graduation Date</th>";
  echo "<th scope='col'>Submitted Last Attendance Date</th>";

  echo "<th scope='col'>Verified Degree</th>";
  echo "<th scope='col'>Education Status</th>";
  echo "<th scope='col'>Verified Campus</th>";


  echo "<th scope='col'>Year and Sem Entered</th>";
  echo "<th scope='col'>Entrance Date</th>";
  echo "<th scope='col'>Year and Sem Last Attended</th>";
  echo "<th scope='col'>Verified Date Graduated</th>";
  echo "<th scope='col'>Verified Date Last Attended</th>";

  echo "<th scope='col'>Verifier Name</th>";
  echo "<th scope='col'>Verifying Company</th>";
  echo "<th scope='col'>Country</th>";
  echo "<th scope='col'>Verifier Email Address</th>";

  echo "<th scope='col'>Date Added</th>";
  echo "<th scope='col'>Date Completed</th>";

  echo "<th scope='col'>Checker</th>";
  echo "<th scope='col'>Checked Date</th>";

  echo "<th scope='col'>Remarks</th>";

  echo "</tr>";
  echo "</thead>";
  foreach ($result as $data) {
    echo "<tr>";
    //echo "<td>$data[firstName]"." "."$data[middleName]"." "."$data[lastName]</td>";
    
    echo "<td>$data[tn]</td>";
    echo "<td>";
      if($data['status'] == 'PENDING') {
        echo  "<span class='badge badge-primary'>$data[status]</span>";
      }elseif($data['status'] == 'VERIFIED') {
        echo  "<span class='badge badge-success'>$data[status]</span>";
      }elseif($data['status'] == 'ON-HOLD') {
        echo  "<span class='badge badge-warning'>$data[status]</span> ";
      }elseif($data['status'] == 'DECLINED') {
        echo  "<span class='badge badge-danger'>$data[status]</span> ";
      }else{}
    echo "</td><td>";
      if(!empty($data['checker'])){
                echo "<span class='badge badge-success'> CHECKED </span>";
              }
            elseif(!empty($data['educ_status'])){
                echo "<span class='badge badge-warning'> FOR COUNTER-CHECK </span>";
             }
            else{
                echo "<span class='badge badge-info'> FOR RECORDS CHECK </span>";
              }
    echo "</td>";

    echo "<td>$data[lastName]</td>";
    echo "<td>$data[firstName]</td>";
    echo "<td>$data[middleName]</td>";
    echo "<td>$data[bdate]</td>";

    echo "<td>$data[degree]</td>";
    echo "<td>$data[campus]</td>";
    echo "<td>$data[yearsGrad]</td>";
    echo "<td>$data[yearsLastAtt]</td>";

    echo "<td>$data[vfdegree]</td>";
    echo "<td>";      
      if($data['educ_status'] == "G") {
        echo "Graduate";
      }elseif($data['educ_status'] == "UG") {
        echo "Undergraduate";
      }else {
        echo "";
      }
    echo "</td>";
    echo "<td>$data[vfcampus]</td>";

    echo "<td>$data[ent_sy]</td>";  
    echo "<td>$data[vfDateEnt]</td>";   
    echo "<td>$data[la_sy]</td>";
    echo "<td>$data[vfDateGrad]</td>";
    echo "<td>$data[vfDateAtt]</td>";

    echo "<td>$data[employee]</td>";
    echo "<td>$data[company_name]</td>";
    echo "<td>$data[country]</td>";
    echo "<td>$data[vemail]</td>";

    echo "<td>$data[date_added]</td>";
    echo "<td>";
      if($data['date_completed'] == "") {
        echo "<p class='action-title1'>No date available</p>";
      } else {
        echo "$data[date_completed]";
      }
    echo "</td>";
     
    echo "<td>$data[checker]</td>";

    $cdate = date("m-d-Y", strtotime($data["checked_date"]));
    
    if($cdate == "01-01-1970"){
            $cdate = "";
        }

    echo "<td>$cdate</td>";

    echo "<td>";
    if($data['status'] == "PENDING") {
      echo "<p class='action-title1'>No remarks available</p>";
    }elseif($data['status'] == "VERIFIED") {
      echo "<p class='action-title1'>Verified</p>";
    }else {
      echo "$data[remarks]";
    }
    echo "</td>";

    echo "</tr>";
  }
  echo "</table>";
}

public function viewMapResultSummary(){
  $config2 = new config2();
  $view = new view();
  $conn = $config2->conn();
  $sql = "SELECT * FROM `tbl_students`";
  $data = $conn->prepare($sql);
  $data->bindParam("id", $id, PDO::PARAM_STR);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "";
  echo "<h3 class='mb-4 mt-5'>MAP REPORTS APPLICATIONS</h3>";
  echo "<div class='table-responsive'>";

  echo "<thead>";
  echo "<tr>
          <th scope='col'>Student FullName</th>
          <th scope='col'>Degree</th>
          <th scope='col'>yearsGrad</th>
          <th scope='col'>Campus</th>
          <th scope='col'>Country</th>
          <th scope='col'>Employee Name</th>
          <th scope='col'>Verifier</th>


  </tr>";

  echo "</thead>";
  foreach ($result as $data) {
  echo "<tr>";
  echo "<td>$data[firstName]"." "."$data[middleName]"." "."$data[lastName]</td>";
  echo "<td>$data[degree]</td>";
  echo "<td>$data[yearsGrad]</td>";
  echo "<td>$data[campus]</td>";
  echo "<td>$data[country]</td>";
  echo "<td>$data[employee_name]</td>";
  echo "<td>$data[company_name]"."-"."$data[employee]"."-"."$data[vemail]</td>";
  echo "</tr>";
  }


}

}
