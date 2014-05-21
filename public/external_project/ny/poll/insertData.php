<?php
include "inc/MySQL/mySQLFunc.php";
$txtReferendum = mysql_real_escape_string($_POST['txtReferendum']);
echo insertPoll($txtReferendum);
?>