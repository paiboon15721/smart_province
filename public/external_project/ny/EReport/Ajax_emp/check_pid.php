<?php
include ("../FUNCTION/con_db.ini");
$pid = $_GET['pid'];
$sql = "select * from tab_e_regis where pid='$pid' ";
$query = mysql_query($sql);
$num_rows = mysql_num_rows($query);
if($num_rows > 0)
{
	echo "มีหมายเลขประจำตัวประชาชนนี้ในระบบแล้ว";
}else{
	echo "";
}

?>