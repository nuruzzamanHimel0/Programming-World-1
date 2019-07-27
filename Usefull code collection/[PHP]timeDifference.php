<?php 
// 2019-07-17 10:26:01
$timeFirst  = strtotime('2019-07-17 10:20:07');
$timeSecond = strtotime('2019-07-17 10:50:01');
$differenceInSeconds = $timeSecond - $timeFirst;
echo $differenceInSeconds."<br>";

date_default_timezone_set('Asia/Dhaka');
echo "The time is " . date('Y-m-d H:i:s');
?>