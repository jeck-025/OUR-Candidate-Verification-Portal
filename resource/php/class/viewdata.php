<?php
//   require_once $_SERVER['DOCUMENT_ROOT'].'/caveportal/resource/php/class/core/init.php';
require_once 'config2.php';

class viewdata extends config{

public function viewInfo(){
  $con = $this->con();
  $sql = "SELECT * FROM `tbl_client_user` WHERE `id` = '$_GET[id]'";
  $data = $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);

        $id = $result[0]["id"];
        $email =$result[0]["vemail"];
        $VFfullname =$result[0]["employee"];
        $company= $result[0]["company_name"];
        $studFirst= $result[0]["firstName"];
        $studMiddle= $result[0]["middleName"];
        $studLast= $result[0]["lastName"];
        $campus= $result[0]["campus"];
        $studDegree=$result[0]["degree"];
        $studVFDegree=$result[0]["vfdegree"];
        $yearsGrad= $result[0]["yearsGrad"];
        $yearsLastAtt= $result[0]["yearsLastAtt"];
        $bdate= $result[0]["bdate"];
        $studCountry= $result[0]["country"];
        $status= $result[0]["status"];
        $added= $result[0]["date_added"];
        $completed= $result[0]["date_completed"];
        $diploma= $result[0]["diploma"];
        $cForm= $result[0]["consentForm"];
        $vid= $result[0]["validID"];
        $remarks =$result[0]["remarks"];
        $tn =$result[0]["tn"];
        $vfCampus = $result[0]["vfcampus"];
        $vfDateGrad = $result[0]["vfDateGrad"];
        $vfDateAtt = $result[0]["vfDateAtt"];
        $vfDateEnt = $result[0]["vfDateEnt"];
        $vfname = $result[0]["vfname"];
        $educ_status = $result[0]["educ_status"];
        $ent_sy = $result[0]["ent_sy"];
        $la_sy = $result[0]["la_sy"];
        $checker = $result[0]["checker"];
        $checked_date = date("m-d-Y", strtotime($result[0]["checked_date"]));


        if($status == "DECLINED"){
            $statColor = "badge-danger";
            $buttonlock = "disabled";
            $buttonvalueV = "Verify";
            $buttonlockV = "disabled";
            $buttonlockH = "disabled";
            $buttonlockD = "disabled";
        }
        elseif($status == "ON-HOLD"){
            $statColor = "badge-warning";
            $buttonlock = "";
            $buttonvalueV = "Verify";
            $buttonlockV = "";
            $buttonlockH = "disabled";
            $buttonlockD = "";
        }
        elseif($status == "VERIFIED"){
            $statColor = "badge-success";
            $buttonlock = "disabled";
            $buttonvalueV = "Resend Email";
            $buttonlockV = "";
            $buttonlockH = "disabled";
            $buttonlockD = "disabled";
        }
        else{
            $statColor = "badge-primary";
            $buttonlock = "";
            $buttonvalueV = "Verify";
            $buttonlockV = "";
            $buttonlockH = "";
            $buttonlockD = "";
        }

        if($educ_status == "UG"){
            $educ_status = "Undergraduate";
        }
        elseif($educ_status == "G"){
            $educ_status = "Graduate";
        }
        else{}

        if($checked_date == "01-01-1970"){
            $checked_date = "";
        }

        if(!empty($educ_status)){
            $resetLock = "<a href='resource/controllers/resetES.php?id=$id'>Reset</a>";
        }
        else{
            $resetLock = "";
        }


  // echo "<h3 class='mb-4 mt-5'>PENDING APPLICATIONS</h3>";

  echo "<div class='table-responsive'>";
  echo "<table id='main-info' class='infosub table'>";
      echo "<tr>";
            echo "<td>";
            echo "<table id='infotable' class='table table-borderless shadow infotable' width='100%'>";
                  echo "<thead class='infohead'>";
                        echo "<tr>";
                              echo "<th>Transaction Details</th>";
                              echo "<th>Verifier Information</th>";
                              echo "<th>Verification Actions</th>";
                        echo "</tr>";
                  echo "</thead>";
                  echo "<tbody>";
                        echo "<tr>";
                              echo "<td><b>Number:</b> $tn <br>
                                        <b>Date Added:</b> $added <br>
                                        <b>Date Completed:</b> $completed <br>
                                        <b>Remarks:</b> $remarks <br><br>
                                        <b>Status:</b> <span class='badge $statColor'> $status </span>";
                                        
                                          if(!empty($checker)){
                                                echo "<span class='badge badge-success'> CHECKED </span>";
                                          }
                                          elseif(!empty($educ_status)){
                                                echo "<span class='badge badge-warning'> FOR COUNTER-CHECK </span>";
                                          }
                                          else{
                                                echo "<span class='badge badge-info'> FOR RECORDS CHECK </span>";
                                          }
                              
                              echo  "<br></td>";

                              echo "<td><b>Name:</b> $VFfullname <br>
                                        <b>Company:</b> $company <br>
                                        <b>Country:</b> $studCountry <br>
                                        <b>Email Address:</b> $email 
                                    </td>";
                              echo "<td>";
                                    if($status == "VERIFIED"){
                                    echo "<li class='actions'>
                                          <a class='btn btn-sm'href='pdfcertificates.php?tn=$id' target='_blank'>Certificate
                                                <div class='icon'>
                                                      <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' style='fill: rgba(0, 0, 0, 1);transform: ;msFilter:;'><path d='M2.06 14.68a1 1 0 0 0 .46.6l1.91 1.11v2.2a1 1 0 0 0 1 1h2.2l1.11 1.91a1 1 0 0 0 .86.5 1 1 0 0 0 .51-.14l1.9-1.1 1.91 1.1a1 1 0 0 0 1.37-.36l1.1-1.91h2.2a1 1 0 0 0 1-1v-2.2l1.91-1.11a1 1 0 0 0 .37-1.36L20.76 12l1.11-1.91a1 1 0 0 0-.37-1.36l-1.91-1.1v-2.2a1 1 0 0 0-1-1h-2.2l-1.1-1.91a1 1 0 0 0-.61-.46 1 1 0 0 0-.76.1L12 3.26l-1.9-1.1a1 1 0 0 0-1.36.36L7.63 4.43h-2.2a1 1 0 0 0-1 1v2.2l-1.9 1.1a1 1 0 0 0-.37 1.37l1.1 1.9-1.1 1.91a1 1 0 0 0-.1.77zm3.22-3.17L4.39 10l1.55-.9a1 1 0 0 0 .49-.86V6.43h1.78a1 1 0 0 0 .87-.5L10 4.39l1.54.89a1 1 0 0 0 1 0l1.55-.89.91 1.54a1 1 0 0 0 .87.5h1.77v1.78a1 1 0 0 0 .5.86l1.54.9-.89 1.54a1 1 0 0 0 0 1l.89 1.54-1.54.9a1 1 0 0 0-.5.86v1.78h-1.83a1 1 0 0 0-.86.5l-.89 1.54-1.55-.89a1 1 0 0 0-1 0l-1.51.89-.89-1.54a1 1 0 0 0-.87-.5H6.43v-1.78a1 1 0 0 0-.49-.81l-1.55-.9.89-1.54a1 1 0 0 0 0-1.05z'></path>
                                                      </svg>
                                                </div>
                                          </a>
                                    </li>";
                                    }else{ 
                                          //ignore 
                                    }
                                    echo" <li class='actions'>     
                                          <a class='btn btn-sm $buttonlockV' href='adminfunctions.php?approved=$id'>$buttonvalueV
                                                <div class='icon'>
                                                      <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2' viewBox='0 0 16 16'>
                                                      <path d='M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z'/>
                                                      </svg>
                                                </div>
                                          </a>

                                    </li>
                                    <li class='actions'>
                                          <a class='btn btn-sm btn-sm-1 $buttonlockH'href='remarks1.php?hold=$id'>Hold
                                                <div class='icon'>
                                                      <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-clock' viewBox='0 0 16 16'>
                                                      <path d='M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z'/>
                                                      <path d='M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z'/>
                                                      </svg>
                                                </div>
                                          </a>
                                    </li>
                                    <li class='actions'>
                                          <a class='btn btn-sm $buttonlockD'href='remarks.php?denied=$id'>Deny
                                                <div class='icon'>
                                                      <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-x-lg' viewBox='0 0 16 16'>
                                                      <path d='M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z'/>
                                                      </svg>
                                                </div>
                                          </a>
                                    </li>                             
                                    </td>";
                        echo "</tr>";
                  echo "</tbody>";
            echo "</table>";
            echo "</td>";
      echo "</tr>";
      echo "<tr><td><h2 class='text-start mb-1'>Student / Alumni Info</h2></td></tr>";
      echo "<tr>";
            echo "<td>";
            echo "<table id='infotable' class='table table-borderless shadow infotable' width='100%'>";
                  echo "<thead class='infohead'>";
                        echo "<tr>";
                              echo "<th>Information Supplied by Verifier</th>";
                              echo "<th>Verified Information from Records</th>";
                        echo "</tr>";
                  echo "</thead>";
                  echo "<tbody>";
                        echo "<tr>";

                              echo "<td><b>Last Name:</b> $studLast <br>
                                        <b>First Name:</b> $studFirst <br>
                                        <b>Middle Name:</b> $studMiddle <br>
                                        <b>Birthdate</b> $bdate <br><br>

                                        <b>Course:</b> $studDegree <br>
                                        <b>Year Graduated:</b> $yearsGrad <br>
                                        <b>Year Last Enrolled:</b> $yearsLastAtt <br>
                                        <b>Campus:</b> CEU $campus<br>
                                    </td>";

                              echo "<td>
                              
                                          <b>Verified Name:</b> <li class='actions3'>
                                          <button class='btn btn-sm verifyN $buttonlock' id='btn' type='button' data-toggle='modal'  data-target='#verify-name' data-id='$id' >$vfname
                                          <div class='icon'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                                <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
                                                </svg>
                                          </div>
                                          </button>
                                          </li>
                                          
                                          <b>Verified Campus:</b> <li class='actions4'>
                                          <button class='btn btn-sm changeC $buttonlock' id='btn' type='button' data-toggle='modal' data-id='$id' data-target='#edit-campus'>$vfCampus
                                          <div class='icon'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                                <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
                                                </svg>
                                          </div>
                                          </button>
                                          </li>

                                          <b>Verified Degree:</b> <li class='actions3'>
                                          <button class='btn btn-sm verifyD $buttonlock' id='btn' type='button' data-toggle='modal' data-id='$id' data-target='#verify-degree' >$studVFDegree
                                          <div class='icon'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                                <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
                                                </svg>
                                          </div>
                                          </button>
                                          </li><b>Education Status:</b></button>";

                              if($status == "PENDING" || $status == "ON-HOLD"){
                                          echo $resetLock; }
                              else { }

                              echo       "<li class='actions3'>
                                          <button class='btn btn-sm verifyES $buttonlock' id='btn' type='button' data-toggle='modal' data-id='$id' data-target='#verify-status' >$educ_status
                                          <div class='icon'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                                <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
                                                </svg>
                                                </div>
                                                
                                          </li>";
                               if($educ_status == "Undergraduate" && $status == "VERIFIED"){
                               echo      "<b>Verified Date of Entrance:</b> <li class='actions3'>
                                          <button class='btn btn-sm verifyED $buttonlock' id='btn' type='button' data-toggle='modal' data-id='$id' data-target='#verify-date-ent'>$vfDateEnt
                                          <div class='icon'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                                <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
                                                </svg>
                                          </div>
                                          </button>
                                          </li>

                                          <b>Entrance School Year and Semester:</b><li class='actions3'>
                                          <button class='btn btn-sm verifyESYS $buttonlock' id='btn' type='button' data-toggle='modal' data-id='$id' data-target='#verify-entsem'>$ent_sy
                                          <div class='icon'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                                <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
                                                </svg>
                                          </div>
                                          </button>
                                          </li>                                       
                                          
                                          <b>Verified Date of Last Attendance:</b><li class='actions3'>
                                          <button class='btn btn-sm verifyDA $buttonlock' id='btn' type='button' data-toggle='modal' data-id='$id' data-target='#verify-date-att'>$vfDateAtt
                                          <div class='icon'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                                <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
                                                </svg>
                                          </div>
                                          </button>
                                          </li>
                                          
                                          <b>Last Attended School Year and Semester:</b><li class='actions3'>
                                          <button class='btn btn-sm verifyLSYS $buttonlock' id='btn' type='button' data-toggle='modal' data-id='$id' data-target='#verify-endsem'>$la_sy
                                          <div class='icon'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                                <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
                                                </svg>
                                          </div>
                                          </button>
                                          </li>";      
                               }
                               elseif($educ_status == "Graduate" && $status == "VERIFIED"){
                               echo      "<b>Verified Date of Entrance:</b> <li class='actions3'>
                                          <button class='btn btn-sm verifyED $buttonlock' id='btn' type='button' data-toggle='modal' data-id='$id' data-target='#verify-date-ent'>$vfDateEnt
                                          <div class='icon'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                                <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
                                                </svg>
                                          </div>
                                          </button>
                                          </li>

                                          <b>Entrance School Year and Semester:</b><li class='actions3'>
                                          <button class='btn btn-sm verifyESYS $buttonlock' id='btn' type='button' data-toggle='modal' data-id='$id' data-target='#verify-entsem'>$ent_sy
                                          <div class='icon'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                                <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
                                                </svg>
                                          </div>
                                          </button>
                                          </li>

                                          <b>Verified Date of Graduation:</b><li class='actions3'>
                                          <button class='btn btn-sm verifyGD $buttonlock' id='btn' type='button' data-toggle='modal' data-id='$id' data-target='#verify-date-grad'>$vfDateGrad
                                          <div class='icon'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                                <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
                                                </svg>
                                          </div>
                                          </button>
                                          </li>
                                          
                                          <b>Last Attended School Year and Semester:</b><li class='actions3'>
                                          <button class='btn btn-sm verifyLSYS $buttonlock' id='btn' type='button' data-toggle='modal' data-id='$id' data-target='#verify-endsem'>$la_sy
                                          <div class='icon'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                                <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
                                                </svg>
                                          </div>
                                          </button>
                                          </li>"; 
                               }
                               elseif($educ_status == "Undergraduate"){
                               echo      "<b>Verified Date of Entrance:</b> <li class='actions3'>
                                          <button class='btn btn-sm verifyED $buttonlock' id='btn' type='button' data-toggle='modal' data-id='$id' data-target='#verify-date-ent'>$vfDateEnt
                                          <div class='icon'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                                <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
                                                </svg>
                                          </div>
                                          </button>
                                          </li>

                                          <b>Entrance School Year and Semester:</b><li class='actions3'>
                                          <button class='btn btn-sm verifyESYS $buttonlock' id='btn' type='button' data-toggle='modal' data-id='$id' data-target='#verify-entsem'>$ent_sy
                                          <div class='icon'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                                <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
                                                </svg>
                                          </div>
                                          </button>
                                          </li>                                       
                                          
                                          <b>Verified Date of Last Attendance:</b><li class='actions3'>
                                          <button class='btn btn-sm verifyDA $buttonlock' id='btn' type='button' data-toggle='modal' data-id='$id' data-target='#verify-date-att'>$vfDateAtt
                                          <div class='icon'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                                <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
                                                </svg>
                                          </div>
                                          </button>
                                          </li>
                                          
                                          <b>Last Attended School Year and Semester:</b><li class='actions3'>
                                          <button class='btn btn-sm verifyLSYS $buttonlock' id='btn' type='button' data-toggle='modal' data-id='$id' data-target='#verify-endsem'>$la_sy
                                          <div class='icon'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                                <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
                                                </svg>
                                          </div>
                                          </button>
                                          </li>";      
                               }
                               elseif($educ_status == "Graduate"){
                               echo      "<b>Verified Date of Entrance:</b> <li class='actions3'>
                                          <button class='btn btn-sm verifyED $buttonlock' id='btn' type='button' data-toggle='modal' data-id='$id' data-target='#verify-date-ent'>$vfDateEnt
                                          <div class='icon'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                                <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
                                                </svg>
                                          </div>
                                          </button>
                                          </li>

                                          <b>Entrance School Year and Semester:</b><li class='actions3'>
                                          <button class='btn btn-sm verifyESYS $buttonlock' id='btn' type='button' data-toggle='modal' data-id='$id' data-target='#verify-entsem'>$ent_sy
                                          <div class='icon'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                                <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
                                                </svg>
                                          </div>
                                          </button>
                                          </li>

                                          <b>Verified Date of Graduation:</b><li class='actions3'>
                                          <button class='btn btn-sm verifyGD $buttonlock' id='btn' type='button' data-toggle='modal' data-id='$id' data-target='#verify-date-grad'>$vfDateGrad
                                          <div class='icon'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                                <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
                                                </svg>
                                          </div>
                                          </button>
                                          </li>
                                          
                                          <b>Last Attended School Year and Semester:</b><li class='actions3'>
                                          <button class='btn btn-sm verifyLSYS $buttonlock' id='btn' type='button' data-toggle='modal' data-id='$id' data-target='#verify-endsem'>$la_sy
                                          <div class='icon'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                                <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
                                                </svg>
                                          </div>
                                          </button>
                                          </li>"; 
                               }

                               else {}
                              
                               echo       "<b>Checked By:</b><li class='actions3'>
                                          <button class='btn btn-sm verifyChecker $buttonlock' id='btn' type='button' data-toggle='modal' data-id='$id' data-target='#verify-checker'>$checker - $checked_date
                                          <div class='icon'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
                                                <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
                                                </svg>
                                          </div>
                                          </button>
                                          </li>";

                              echo "</td>";                              
                        echo "</tr>";
                  echo "</tbody>";
            echo "</table>";
            echo "</td>";
      echo "</tr>";
      echo "<tr><td><h2 class='text-start mb-1'>Submitted Documents</h2></td></tr>";
            echo "<tr>";
            echo "<td>";
            echo "<table class='table table-borderless shadow' width='100%'>";
                  echo "<thead>";
                        echo "<tr>";
                              echo "<th>Document Type</th>";
                              echo "<th>Actions</th>";
                        echo "</tr>";
                  echo "</thead>";
                  echo "<tbody>";
                        echo "<tr>";
                              echo "<td><p class='filecaption'><b>Consent Form</b></p></td>
                                    <td>View: <a href='$cForm' target='_blank'><i class='bi bi-eye-fill icons'title='View PDF'></i></a>
                                          Download: <a href='$cForm' download><i class='bi bi-arrow-down-circle-fill icons'title='Download PDF'></i></a></td>";
                        echo "</tr>";
                        echo "<tr>";
                              echo "<td><p class='filecaption'><b>Transcript of Records / Diploma</b></p></td>
                                    <td>View: <a href='$diploma' target='_blank'><i class='bi bi-eye-fill icons'title='View PDF'></i></a>
                                          Download: <a href='$diploma' download><i class='bi bi-arrow-down-circle-fill icons'title='Download PDF'></i></a><br></td>";
                        echo "</tr>";
                        echo "<tr>";            
                              echo "<td><p class='filecaption'><b>Valid ID</b></p></td>
                                    <td>View: <a href='$vid' target='_blank'><i class='bi bi-eye-fill icons'title='View PDF'></i></a>
                                          Download: <a href='$vid' download><i class='bi bi-arrow-down-circle-fill icons'title='Download PDF'></i></a></td>";
                        echo "</tr>";
                  echo "</tbody>";
            echo "</table>";
            echo "</td>";
            echo "</tr>";



  echo "</table>";

  


//   echo "<div class='table-responsive'>";
//   echo "<table id='infotable' class='table table-borderless  table-hover shadow' width='100%'>";
//   echo "<thead>
//           <tr>
//           <th scope='col'></th>
//           <th scope='col'>Submitted Info by Verifier</th>
//           <th scope='col'>Verified Info from Records</th>


//           </tr>
//   </thead><tbody>";
//   // foreach ($result as $data) {
//       echo "<tr>";
//       echo "<td>Verifier: ";
//       echo "$data[company_name]".":<br>"."$data[employee]"."-"."$data[vemail]</td>";
//       echo "<td>$data[tn]</td>";
//       echo "<td>$data[firstName]"." "."$data[middleName]"." "."$data[lastName]</td>";
//       echo "<td>$data[degree] <br><br> Verified Degree: <li class='actions2'>
//               <button class='btn btn-sm verifyD' id='btn' type='button' data-toggle='modal' data-id='$data[id]' data-target='#verify-degree'>$data[vfdegree]
//                 <div class='icon'>
//                 <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
//         <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
//       </svg>
//                 </div>
//               </button>
//             </li> <br> </td>";


//       echo "<td>$data[campus] <br><br> Verified Campus:
//       <li class='actions'>
//         <button class='btn btn-sm changeC' id='btn' type='button' data-toggle='modal' data-id='$data[id]' data-target='#edit-campus'>$data[vfcampus]
//           <div class='icon'>
//           <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill' viewBox='0 0 16 16'>
//   <path d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
// </svg>
//           </div>
//         </button>
//       </li>
//    </td>";
//       echo "<td>$data[date_added]</td>";
//       echo "<td><a href='$data[consentForm]' target='_blank'><i class='bi bi-eye-fill icons'title='View PDF'></i></a><br><a href='$data[consentForm]' download><i class='bi bi-arrow-down-circle-fill icons'title='Download PDF'></i></a></td>";
//       echo "<td><a href='$data[diploma]' target='_blank'><i class='bi bi-eye-fill icons'title='View PDF'></i></a><br><a href='$data[diploma]' download><i class='bi bi-arrow-down-circle-fill icons'title='Download PDF'></i></a></td>";
//       echo "<td><a href='$data[validID]' target='_blank'><i class='bi bi-eye-fill icons'title='View PDF'></i></a><br><a href='$data[validID]' download><i class='bi bi-arrow-down-circle-fill icons'title='Download PDF'></i></a></td>";
//       echo "<td><span class='badge badge-primary'>$data[status]</span></td>";
//       echo "<td>

//       <li class='actions'>     
//       <a class='btn btn-sm' href='adminfunctions.php?approved=$data[id]'>Verify
//         <div class='icon'>
//         <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2' viewBox='0 0 16 16'>
//         <path d='M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z'/>
//       </svg>
//         </div>
//       </a>
//     </li>
//       <li class='actions'><a class='btn btn-sm btn-sm-1'href='remarks1.php?hold=$data[id]'>On Hold
//         <div class='icon'>
//         <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-clock' viewBox='0 0 16 16'>
//         <path d='M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z'/>
//         <path d='M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z'/>
//       </svg>
//         </div>
//       </a></li>

//       <li class='actions'><a class='btn btn-sm'href='remarks.php?denied=$data[id]'>Denied
//       <div class='icon'>
//       <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-x-lg' viewBox='0 0 16 16'>
//       <path d='M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z'/>
//     </svg>
//           </div>
//       </a></li>

//       </td>";
//       echo "</tr>";
//   // }
//   echo "</tbody></table>";

// echo "
// <div class='modal fade' id='approve-$id' aria-labelledby='exampleModalLabel10' aria-hidden='true' data-keyboard='true'>
//   <div class='modal-dialog modal-md'>
//       <div class='modal-content'>
//           <div class='modal-header'>
//               <h5 class='modal-title' id='exampleModalLabel10'>Approve</h5>
//               <button type='button' class='btn-close' data-dismiss='modal' aria-label='Close'></button>
//           </div>

//           <div class='modal-body'>
                  
//                         Confirm?
//            </div>

//            <div class='modal-footer mt-3'>
//             <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>  
//             <a class='btn btn-secondary' id='update-btn' href='adminfunctions.php?approved=$id'>Delete</a>
//             </div>
          
            
//       </div>
//   </div>
// </div>";

  

}





}

?>