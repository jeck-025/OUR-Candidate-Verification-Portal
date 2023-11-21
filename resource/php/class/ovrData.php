<?php
require_once 'config2.php';

class ovrData extends config{

    public function viewRaw($id){

        if(isset($_POST['save'])){
            $update = new ovrUpdate($_POST['dataID'], $_POST['dataCT'], $_POST['dataLN'], $_POST['dataFN'], $_POST['dataMN'], $_POST['dataBD'], $_POST['dataCP'], $_POST['dataDG'], $_POST['dataYG'], $_POST['dataLA'], $_POST['dataVC'], $_POST['dataVR'], $_POST['dataRE'], $_POST['diplomaURL'], $_POST['formURL'], $_POST['vidURL']) ;
        }

        $view = new view();
        $con = $this->con();
        $sql = "SELECT * FROM `tbl_client_user` WHERE `tn` = '$id'";
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
        
        $sql0 = "SELECT * FROM `tbl_countries` WHERE `ccode` = '$studCountry'";
        $data0 = $con->prepare($sql0);
        $data0->execute();
        $result0 = $data0->fetchAll(PDO::FETCH_ASSOC);
            $cn = $result0[0]["countryname"];
            $cv = $result0[0]["ccode"];

    echo "<div class='row px-5 d-flex justify-content-center'>
            <div class='col-md-12 pb-3 justify-content-center'>
                <div class='card'>
                    <div class='card-body report'>
                        <h3 class='my-4'>Manual Edit</h3><hr>
                        <form action='' method='POST'>
                            <div class='row'>
                                <div class='col-md-1'>
                                    <div class='form-group'>
                                        <label for='dataID'>Entry ID</label>
                                        <input type='text' class='form-control' id='dataID' name='dataID' value='$id' readonly=readonly>
                                    </div>
                                </div>
                                <div class='col-md-3'>
                                    <div class='form-group'>
                                        <label for='dataTN'>Transaction ID</label>
                                        <input type='text' class='form-control' id='dataTN' name='dataTN' value='$tn' disabled>
                                    </div>
                                </div>
                                <div class='col-md-3'>
                                    <div class='form-group'>
                                        <label for='dataDA'>Date Added</label>
                                        <input type='text' class='form-control' id='dataDA' name='dataDA' value='$added' disabled>
                                    </div>
                                </div>
                                <div class='col-md-5'>
                                    <div class='form-group'>
                                        <label for='dataCT'>Country of Employer</label>
                                        <select name='dataCT' id='dataCT' class='selectpicker form-control' data-live-search='true' data-dropup-auto='false'>
                                            <option data-tokens='$cn' value='$cv'> $cn </option>";
                                            $view->countries();
                                        echo "</select>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-md-3'>
                                    <div class='form-group'>
                                        <label for='dataLN'>Student Last Name</label>
                                        <input type='text' class='form-control' id='dataLN' name='dataLN' value='$studLast' required>
                                    </div>
                                </div>
                                <div class='col-md-3'>
                                    <div class='form-group'>
                                        <label for='dataFN'>Student First Name</label>
                                        <input type='text' class='form-control' id='dataFN' name='dataFN' value='$studFirst' required>
                                    </div>
                                </div>
                                <div class='col-md-3'>
                                    <div class='form-group'>
                                        <label for='dataMN'>Student Middle Name</label>
                                        <input type='text' class='form-control' id='dataMN' name='dataMN' value='$studMiddle'>
                                    </div>
                                </div>
                                <div class='col-md-3'>
                                    <div class='form-group'>
                                        <label for='dataBD'>Birthdate</label>
                                        <input type= 'date' id='dataBD' name='dataBD' class='form-control datepickerForm' value='$bdate'>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-md-1'>
                                    <div class='form-group'>
                                        <label for='dataCP'>Campus</label>
                                        <select class='form-control selectpicker' name='dataCP'>
                                            <option data-tokens='$campus' value='$campus'> $campus </option>                                            
                                            <option data-tokens='MNL' value='MNL'> MNL </option>
                                            <option data-tokens='MKT' value='MKT'> MKT </option>
                                            <option data-tokens='MLS' value='MLS'> MLS </option>
                                        </select>
                                    </div>
                                </div>
                                <div class='col-md-7'>
                                    <div class='form-group'>
                                        <label for='dataDG'>Degree</label>
                                        <select class='form-control selectpicker' data-live-search='true' name='dataDG' data-dropup-auto='false'>
                                            <option data-tokens='$studDegree' value='$studDegree'> $studDegree </option>";
                                            
                                            $view->courses();
                                    echo "</select>
                                    </div>
                                </div>
                                <div class='col-md-2'>
                                    <div class='form-group'>
                                        <label for='dataYG'>Year Graduated</label>
                                        <input type='date' class='datepickerForm' id='dataYG' name='dataYG' value='$yearsGrad'>
                                    </div>
                                </div>
                                <div class='col-md-2'>
                                    <div class='form-group'>
                                        <label for='dataLA'>Last Attended</label>
                                        <input type='date' class='datepickerForm' id='dataLA' name='dataLA' value='$yearsLastAtt'>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class='row'>
                                <div class='col-md-4'>
                                    <div class='form-group'>
                                        <label for='dataVC'>Verification Company</label>
                                        <input type='text' class='form-control' id='dataVC' name='dataVC' value='$company' required>
                                    </div>
                                </div>
                                <div class='col-md-4'>
                                    <div class='form-group'>
                                        <label for='dataVR'>Company Representative</label>
                                        <input type='text' class='form-control' id='dataVR' name='dataVR' value='$VFfullname' required>
                                    </div>
                                </div>
                                <div class='col-md-4'>
                                    <div class='form-group'>
                                        <label for='dataRE'>Representative Email Address</label>
                                        <input type='text' class='form-control' id='dataRE' name='dataRE' value='$email' required>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class='row'>
                                <div class='col-md-12 p-2'>
                                    <div class='input-group'>
                                        <div class='input-group-prepend'>
                                            <span class='input-group-text' id='inputGroup-sizing-default'>Diploma URL</span>
                                        </div>
                                        <input type='text' name='diplomaURL' class='form-control' aria-label='Sizing example input' aria-describedby='inputGroup-sizing-default' value='$diploma'>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-md-12 p-2'>
                                    <div class='input-group'>
                                        <div class='input-group-prepend'>
                                            <span class='input-group-text' id='inputGroup-sizing-default'>Consent Form URL</span>
                                        </div>
                                        <input type='text' name='formURL' class='form-control' aria-label='Sizing example input' aria-describedby='inputGroup-sizing-default' value='$cForm'>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-md-12 p-2'>
                                    <div class='input-group'>
                                        <div class='input-group-prepend'>
                                            <span class='input-group-text' id='inputGroup-sizing-default'>Valid ID URL</span>
                                        </div>
                                        <input type='text' name='vidURL' class='form-control' aria-label='Sizing example input' aria-describedby='inputGroup-sizing-default' value='$vid'>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class='row'>
                                <div class='col-md-12 d-flex justify-content-center'>
                                    <li class='actions'>
                                          <input type='submit' class='btn btn-ovr' value='Save' name='save'>
                                          <a class='btn btn-ovr' href='admindash'>Cancel</a>
                                    </li>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>";
    }
}
?>
