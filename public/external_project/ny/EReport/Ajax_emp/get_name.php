<?php
include ("conDB.php");
$conn=connphp();
if (!$conn) 
{
	echo "9|ไม่สามารถเชื่อมต่อกับฐานข้อมูลได้|";
}else{
	$pid = $_GET['pid'];
	$sql = "select fname,lname from ors.pop where pid='$pid' ";
	$objParse = oci_parse($conn, $sql);
	oci_execute ($objParse);
	$objResult = oci_fetch_array($objParse,OCI_BOTH);
	$fname = $objResult[0];
	$lname = $objResult[1];
	oci_close($conn);
	if($fname == "")
	{
		//echo "ไม่พบชื่อของรหัสประจำตัวประชาชนนี้";
		$fullname = "ไม่พบชื่อของรหัสประจำตัวประชาชนนี้";
	}else{
		//echo "$fname $lname";
		$fullname = "$fname $lname";
	}
	echo "<input type='text' name='fullname' id='fullname' value='$fullname' disabled='disabled' style='width: 250px; padding: 2px'>";
	//echo "sql = $sql";
	//echo "ชื่อ $fname $lname";
}
?>