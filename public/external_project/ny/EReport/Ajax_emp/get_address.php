<?php
include ("conDB.php");
$conn=connphp();
if (!$conn) 
{
	echo "9|ไม่สามารถเชื่อมต่อกับฐานข้อมูลได้|";
}else{
	$pid = $_GET['pid'];
	$sql = "SELECT h.hno,h.rcode,tr.trok_desc,s.soi_desc1,s.soi_desc2,th.tnn_desc,c1.catm_desc as TT ,c2.catm_desc as AA ,c3.catm_desc as CC ";
	$sql = $sql." FROM ors.pop p , ors.house h , tabdb.rcode r , tabdb.thanon th , tabdb.trok tr, tabdb.soi s , tabdb.title ti , tabdb.ccaattmm c1 , tabdb.ccaattmm c2 , tabdb.ccaattmm c3 ";
	$sql = $sql." WHERE p.pid = $pid and p.hid = h.hid and h.rcode = r.rcode_code and tr.trok_ukey(+) = h.rcode||h.trok and s.soi_ukey(+) = h.rcode||h.soi and th.tnn_ukey(+) = h.rcode||h.thanon and c1.catm_ukey(+) = substr(h.ccaattmm, 1, 6)||'00' and c2.catm_ukey(+) = substr(h.ccaattmm, 1, 4)||'0000' and c3.catm_ukey(+) = substr(h.ccaattmm, 1, 2)||'000000' and ti.title_code = p.title ";
	$objParse = oci_parse($conn, $sql);
	oci_execute ($objParse);
	$objResult = oci_fetch_array($objParse,OCI_BOTH);
	$hno = $objResult[0];
	$rcode = $objResult[1];
	$trok_desc = $objResult[2];
	$soi_desc1 = $objResult[3];
	$soi_desc2 = $objResult[4];
	$tnn_desc = $objResult[5];
	$tt = $objResult[6];
	$aa = $objResult[7];
	$cc = $objResult[8];
	if(substr($rcode,0,1) == 1)
	{
		$tombon = "แขวง";
		$amper = "เขต";
	}else{
		$tombon = "ตำบล";
		$amper = "อำเภอ";
	}
	$add_desc = "$hno";
	if($trok_desc != "") { $add_desc = $add_desc." ตรอก$trok_desc"; }
	if($soi_desc1 != "") { $add_desc = $add_desc." ซอย$soi_desc1"; }
	if($tnn_desc != "") { $add_desc = $add_desc." ถนน$tnn_desc"; }
	if($tt != "") { $add_desc = $add_desc." $tombon$tt"; }
	if($aa != "") { $add_desc = $add_desc." $amper$aa"; }
	$add_desc = $add_desc." จังหวัด$cc";
	if($cc == "")
	{
		echo "ไม่พบที่อยู่";
	}else{
		echo $add_desc;
	}
	oci_close($conn);
}
?>