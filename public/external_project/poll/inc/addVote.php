<?php
include "MySQL/mySQLFunc.php";
$txtPid = str_replace("-", "", $_POST['userPID']);
$answerID = $_POST['answerID'];
$pollID = $_POST['pollID'];
$sex = $_POST['poSex'];
$age = $_POST['poAge'];
$curDate = $_POST['curDate'];
//echo $txtPid."|".$answerID."|".$pollID;
echo addVote($txtPid, $answerID, $pollID, $sex, $age, $curDate);

?>