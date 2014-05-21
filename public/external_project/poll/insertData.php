<?php
include "inc/MySQL/mySQLFunc.php";
$txtReferendum = mysql_real_escape_string($_POST['txtReferendum']);
$startDate = mysql_real_escape_string($_POST['startDate']);
$endDate = mysql_real_escape_string($_POST['endDate']);
$startTime = mysql_real_escape_string($_POST['startTime']);
$endTime = mysql_real_escape_string($_POST['endTime']);
$curDate = mysql_real_escape_string($_POST['curDate']);
$empId = mysql_real_escape_string(str_replace("-", "", $_POST['empId']));
$cc = mysql_real_escape_string($_POST['ccList']);
$aa = mysql_real_escape_string($_POST['aaList']);
$tt = mysql_real_escape_string($_POST['ttList']);
$mm = mysql_real_escape_string($_POST['mmList']);
$catm = sprintf("%02d%02d%02d%02d", $cc, $aa, $tt, $mm);

$yearStart = (int)substr($startDate, 0, 4) + 543;
$mthStart = substr($startDate, 4, 2);
$dayStart = substr($startDate, 6, 2);

$yearEnd = (int)substr($endDate, 0, 4) + 543;
$mthEnd = substr($endDate, 4, 2);
$dayEnd = substr($endDate, 6, 2);

$startDate = $yearStart.$mthStart.$dayStart;
$endDate = $yearEnd.$mthEnd.$dayEnd;
 
 
if((int)$_POST['aaList'] == 0){
	$catm = sprintf("%02d000000", $cc, $aa);
}

if((int)$_POST['ttList'] == 0){
	$catm = sprintf("%02d%02d0000", $cc, $aa);
}

if((int)$_POST['mmList'] == 0){
	$catm = sprintf("%02d%02d%02d00", $cc, $aa, $tt);
}

//echo $empId;
echo insertPoll($txtReferendum, $catm, $startDate, $endDate, $startTime, $endTime, $curDate, $empId)
?>