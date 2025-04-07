<?php
echo cal_days_in_month(CAL_GREGORIAN, date('m', strtotime(date('Y-m')." -1 month")), date('Y', strtotime(date('Y-m')." -1 month")));
?>