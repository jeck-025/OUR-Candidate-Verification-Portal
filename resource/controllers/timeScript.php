<?php
  date_default_timezone_set('Asia/Manila');
  //   date_default_timezone_get();
  echo "<h5 class='timeDisp'><i class='bi bi-clock'></i> ".$runningTime = date('h:i:sa')."</h5>";
  echo "<h6><i class='bi bi-globe'></i> ".$runningTime = date('e')."</h6>";
  echo "<h6> <i class='bi bi-calendar3'></i> ".$runningTime = date('M d, Y')."</h6>";
?>