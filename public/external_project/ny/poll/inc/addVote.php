<?php
include "MySQL/mySQLFunc.php";
$txtPid = str_replace("-", "", $_POST['userPID']);
$answerID = $_POST['answerID'];
$pollID = $_POST['pollID'];
//echo $txtPid."|".$answerID."|".$pollID;
echo addVote($txtPid, $answerID, $pollID);

?>