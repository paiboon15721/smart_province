<?php
include "inc/MySQL/mySQLFunc.php";
$txtPid = str_replace("-", "", $_POST['userPID']);
echo getPidExistVote($txtPid);
?>