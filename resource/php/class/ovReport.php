<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/caveportal/resource/php/class/core/init.php';

class ovReport extends config
{
    public function totalPendingVF(){
        $view = new view();
        if(isset($_GET['date']) && ($_GET['date'] != "")){
            $strArray = explode("-", $_GET['date']);
            $year = $strArray[0];
            $month = $strArray[1];
            $convDate = strtotime($_GET['date']);
            $display = date('F Y', $convDate);
            echo"<h6><i class='bi bi-menu-button-wide-fill'></i>&nbsp Total Pending Verifications for the month of ".$display.": <br>";
            echo"<span class='count mt-3'>".$view->pendingCount($year, $month)." pending verification/s<br>";
            echo"<small> Manila <b>( ".$view->pendingCountMNL($year, $month)." )</b> &mdash;
                            Makati <b>( ".$view->pendingCountMKT($year, $month)." )</b> &mdash;
                            Malolos <b>( ".$view->pendingCountMLS($year, $month)." )</b></small></span></h6><br>";
        }else{
            echo"<h6><i class='bi bi-menu-button-wide-fill'></i>&nbsp Total Pending Verifications: ";
            echo"<span class='count mt-3'>".$view->allPendingCount()." pending verification/s <br>";
            echo"<small> Manila <b>( ".$view->allPendingCountMNL()." )</b> &mdash;
                            Makati <b>( ".$view->allPendingCountMKT()." )</b> &mdash;
                            Malolos <b>( ".$view->allPendingCountMLS()." )</b></small></span></h6><br>";
        }
    }

    public function totalReceivedVF(){
        $view = new view();
        if(isset($_GET['date']) && ($_GET['date'] != "")){
            $strArray = explode("-", $_GET['date']);
            $year = $strArray[0];
            $month = $strArray[1];
            $convDate = strtotime($_GET['date']);
            $display = date('F Y', $convDate);
            echo"<h6><i class='bi bi-calendar-fill'></i>&nbsp Total Verifications received for the month of ".$display.":<br> ";
            echo"<span class='count mt-3'>".$view->totalMonthByM($year, $month)." verification/s";
            echo"<small> ( ".$view->totalMonthByMDone($year, $month)." processed )</small><br>";
            echo"<small> Manila <b>( ".$view->totalMonthByMMNL($year, $month)."</b> / ".$view->totalMonthByMDoneMNL($year, $month)." ) &mdash;
                            Makati <b>( ".$view->totalMonthByMMKT($year, $month)."</b> / ".$view->totalMonthByMDoneMKT($year, $month)." ) &mdash;
                            Malolos <b>( ".$view->totalMonthByMMLS($year, $month)."</b> / ".$view->totalMonthByMDoneMLS($year, $month)." )</small></span></h6><br>";
        }else{
            echo"<h6><i class='bi bi-calendar-fill'></i>&nbsp Total Verification/s received for this month: ";
            echo"<span class='count mt-3'>".$view->totalMonth()." verification/s<br>";
            echo"<small> ( ".$view->totalMonthDone()." processed )</small><br>";
            echo"<small> Manila <b>( ".$view->totalMonthMNL()."</b> / ".$view->totalMonthDoneMNL()." ) &mdash;
                            Makati <b>( ".$view->totalMonthMKT()."</b> / ".$view->totalMonthDoneMKT()." ) &mdash;
                            Malolos <b>( ".$view->totalMonthMLS()."</b> / ".$view->totalMonthDoneMLS()." )</small></span></h6><br>";
        }
    }

    public function totalProcessedVF(){
        $view = new view();
        if(isset($_GET['date']) && ($_GET['date'] != "")){
            $strArray = explode("-", $_GET['date']);
            $year = $strArray[0];
            $month = $strArray[1];
            $convDate = strtotime($_GET['date']);
            $display = date('F Y', $convDate);
            echo"<h6><i class='bi bi-patch-check-fill'></i>&nbsp Total Verifications Processed for the month of ".$display.":<br> ";
            echo"<span class='count mt-3'>".$view->totalMonthCompletedByM($year, $month)." verification/s<br>";
            echo"<small> Manila <b>( ".$view->totalMonthCompletedbyMNL($year, $month)." )</b> &mdash;
                            Makati <b>( ".$view->totalMonthCompletedbyMKT($year, $month)." )</b> &mdash;
                            Malolos <b>( ".$view->totalMonthCompletedbyMLS($year, $month)." )</b></small></span></h6>";
        }else{
            echo"<h6><i class='bi bi-patch-check-fill'></i>&nbsp Total Verification/s Processed for this month: ";
            echo"<span class='count mt-3'>".$view->totalMonthCompleted()." verification/s<br>";
            echo"<small> Manila <b>( ".$view->totalMonthCompletedMNL()." )</b> &mdash;
                            Makati <b>( ".$view->totalMonthCompletedMKT()." )</b> &mdash;
                            Malolos <b>( ".$view->totalMonthCompletedMLS()." )</b></small></span></h6>";
        }
    }

    public function totalHoldVF(){
        $view = new view();
        if(isset($_GET['date']) && ($_GET['date'] != "")){
            $strArray = explode("-", $_GET['date']);
            $year = $strArray[0];
            $month = $strArray[1];
            $convDate = strtotime($_GET['date']);
            $display = date('F Y', $convDate);
            echo "<h6><i class='bi bi-exclamation-octagon-fill icon'></i> On-Hold Verifications for the month of ".$display.": <br> ";
            echo "<span class='count'> ".$view->onHoldCount($year, $month)." verification/s <br>";
            echo"<small> Manila <b>( ".$view->onHoldCountMNL($year, $month)." )</b> &mdash;
                            Makati <b>( ".$view->onHoldCountMKT($year, $month)." )</b> &mdash;
                            Malolos <b>( ".$view->onHoldCountMLS($year, $month)." )</b></small></span></h6><br>";
        }else{
            echo "<h6><i class='bi bi-exclamation-octagon-fill icon'></i> Total On-Hold Verifications: ";
            echo "<span class='count'> ".$view->allOnHoldCount()." verification/s <br>";
            echo"<small> Manila <b>( ".$view->allOnHoldCountMNL()." )</b> &mdash;
                            Makati <b>( ".$view->allOnHoldCountMKT()." )</b> &mdash;
                            Malolos <b>( ".$view->allOnHoldCountMLS()." )</b></small></span></h6><br>";
        }
    }

    public function totalDeniedVF(){
        $view = new view();
        if(isset($_GET['date']) && ($_GET['date'] != "")) {
            $strArray = explode("-", $_GET['date']);
            $year = $strArray[0];
            $month = $strArray[1];
            $convDate = strtotime($_GET['date']);
            $display = date('F Y', $convDate);
            echo "<h6><i class='bi bi-person-x-fill icon'></i> Denied Verifications for the month of ".$display.": <br> ";
            echo "<span class='count'> ".$view->deniedCount($year, $month)." verification/s<br>";
            echo"<small> Manila <b>( ".$view->deniedCountMNL($year, $month)." )</b> &mdash;
                            Makati <b>( ".$view->deniedCountMKT($year, $month)." )</b> &mdash;
                            Malolos <b>( ".$view->deniedCountMLS($year, $month)." )</b></small></span></h6><br>";
        }else{
            echo "<h6><i class='bi bi-person-x-fill'></i> Total Denied Verifications: ";
            echo "<span class='count'> ".$view->allDeniedCount()." verification/s<br>";
            echo"<small> Manila <b>( ".$view->allDeniedCountMNL()." )</b> &mdash;
                            Makati <b>( ".$view->allDeniedCountMKT()." )</b> &mdash;
                            Malolos <b>( ".$view->allDeniedCountMLS()." )</b></small></span></h6><br>";
        }
    }

    public function totalVerifiedVF(){
        $view = new view();
        if(isset($_GET['date']) && ($_GET['date'] != "")) {
            $strArray = explode("-", $_GET['date']);
            $year = $strArray[0];
            $month = $strArray[1];
            $convDate = strtotime($_GET['date']);
            $display = date('F Y', $convDate);
            echo "<h6><i class='bi bi-check2-all'></i> Verified for the month of ".$display.": <br>";
            echo "<span class='count'> ".$view->approvedCount($year, $month)." verification/s<br>";
            echo"<small> Manila <b>( ".$view->approvedCountMNL($year, $month)." )</b> &mdash;
                            Makati <b>( ".$view->approvedCountMKT($year, $month)." )</b> &mdash;
                            Malolos <b>( ".$view->approvedCountMLS($year, $month)." )</b></small></span></h6>";
        }else{
            echo "<h6><i class='bi bi-check2-all'></i> Total Verified Requests: ";
            echo "<span class='count'> ".$view->allApprovedCount()." verification/s<br>";
            echo"<small> Manila <b>( ".$view->allApprovedCountMNL()." )</b> &mdash;
                            Makati <b>( ".$view->allApprovedCountMKT()." )</b> &mdash;
                            Malolos <b>( ".$view->allApprovedCountMLS()." )</b></small></span></h6>";
            echo "<span class='count'><small><i>*data for the current year (".date('Y').") shown</i></small></span>";
        }
    }
}

?>