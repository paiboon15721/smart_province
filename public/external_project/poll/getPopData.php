<?php
include "inc/Oracle/oraFunc.php";
$txtPid = str_replace("-", "", $_POST['userPID']);
echo getPidExist($txtPid);
?>