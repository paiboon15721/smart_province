<?php
date_default_timezone_set('Asia/Bangkok' );
include ("con_db.ini");
function get_prov($prov,$flag)
{
	if($flag == "1")
	{
		echo "<option value='26000000' selected> นครนายก </option>";
	}else{
		//global $dbConnect;
		echo "<option value=''>--เลือกจังหวัด--</option>";
		$sql = "select * from tab_e_ccaattmm where flag_area = '1' and catm_tdate = '0' order by catm_desc ";
		$query = mysql_query($sql);
		$num_rows = mysql_num_rows($query);
		if($num_rows == 0)
		{
			echo "<option value=''>ไม่พบข้อมูลจังหวัด</option>";
		}else{
			$i=0;
			while($i < $num_rows)
			{
				$result = mysql_fetch_array($query);
				$catm_ukey = $result['catm_ukey'];
				$catm_desc = $result['catm_desc'];
				$catm_edesc = $result['catm_edesc'];
				if($prov == $catm_ukey)
				{
					echo "<option value='$catm_ukey' selected>$catm_desc : $catm_ukey </option>";
				}else{
					echo "<option value='$catm_ukey'>$catm_desc : $catm_ukey</option>";
				}
				$i++;
			}
		}
	//echo "row = $row";
	}
}
function get_level($level)
{
	switch ($level) {
		case 1:
			$setd1 = "selected";
			break;
		case 2:
			$setd2 = "selected";
			break;
		case 3:
			$setd3 = "selected";
			break;
		case 4:
			$setd4 = "selected";
			break;
		case 5:
			$setd5 = "selected";
			break;
	}
	echo "<option value='1' $setd1>นายอำเภอ</option>";
	echo "<option value='2' $setd2>ปลัดอำเภอ</option>";
	echo "<option value='3' $setd3>กำนัน</option>";
	echo "<option value='4' $setd4>ผู้ใหญ่บ้าน</option>";
	echo "<option value='5' $setd5>เจ้าหน้าที่</option>";
}
function get_upd_date()
{
	$today = getdate();
	$p_date = $today['mday'];
	$p_month = $today['mon'];
	$p_year = $today['year'];       
	if($p_date >=10)
	{
		$p_date = $p_date;
	}else{
		$p_date = '0'.$p_date;
	}
	if($p_month >= 10)
	{
		$p_month = $p_month;
	}else{
		$p_month = '0'.$p_month;
	}
	$p_year = $p_year+543;
	$upd_date = $p_year.$p_month.$p_date;
	return $upd_date;
}
function get_upd_time()
{
	$today = getdate();
	$p_hour = $today['hours'];
	$p_minute = $today['minutes'];       
	if($p_hour >=10)
	{
		$p_hour = $p_hour;
	}else{
		$p_hour = '0'.$p_hour;
	}
	if($p_minute >= 10)
	{
		$p_minute = $p_minute;
	}else{
		$p_minute = '0'.$p_minute;
	}
	$upd_time = $p_hour.$p_minute;
	return $upd_time;
}
function showmsg($msg) 
{
	echo "<script language='JavaScript'>";
	echo "alert(\""  . $msg . "\");";
	echo "</script>";
}
/*function thai_date($type){
	$time=time();
	$thai_day_arr=array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
	$thai_month_arr=array("0"=>"","1"=>"มกราคม","2"=>"กุมภาพันธ์","3"=>"มีนาคม","4"=>"เมษายน","5"=>"พฤษภาคม","6"=>"มิถุนายน","7"=>"กรกฎาคม","8"=>"สิงหาคม","9"=>"กันยายน","10"=>"ตุลาคม","11"=>"พฤศจิกายน","12"=>"ธันวาคม");
	if($type==1){
	$thai_date_return="วัน".$thai_day_arr[date("w",$time)];
	$thai_date_return.= "ที่ ".date("j",$time);
	$thai_date_return.=" ".$thai_month_arr[date("n",$time)];
	$thai_date_return.= " พ.ศ.".(date("Yํ",$time)+543);
	$thai_date_return.= " ".date("H:i",$time)." น.";
	}elseif($type==2){
	$thai_date_return = date("n",$time)."-".date("j",$time)."-".(date("Yํ",$time)+543)." ".date("H:i",$time);
	}else{
	$thai_date_return = $time;
	}
	return $thai_date_return;
}*/
function thai_date($type){
	$today = getdate();
	$p_date = $today['mday'];
	$p_wdate = $today['wday'];
	$p_month = $today['mon'];
	$p_year = $today['year'];    
	$p_hour = $today['hours'];
	$p_minute = $today['minutes'];       
	if($p_hour >=10)
	{
		$p_hour = $p_hour;
	}else{
		$p_hour = '0'.$p_hour;
	}
	if($p_minute >= 10)
	{
		$p_minute = $p_minute;
	}else{
		$p_minute = '0'.$p_minute;
	}
	$thai_day_arr=array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
	$thai_month_arr=array("0"=>"","1"=>"มกราคม","2"=>"กุมภาพันธ์","3"=>"มีนาคม","4"=>"เมษายน","5"=>"พฤษภาคม","6"=>"มิถุนายน","7"=>"กรกฎาคม","8"=>"สิงหาคม","9"=>"กันยายน","10"=>"ตุลาคม","11"=>"พฤศจิกายน","12"=>"ธันวาคม");
	if($type==1){
	$thai_date_return="วัน".$thai_day_arr[$p_wdate];
	$thai_date_return.= "ที่ ".$p_date;
	$thai_date_return.=" ".$thai_month_arr[$p_month];
	$thai_date_return.= " พ.ศ.".($p_year+543);
	$thai_date_return.= " ".$p_hour.":".$p_minute." น.";
	}elseif($type==2){
	if($p_date < 10)
	{
		$p_date = "0".$p_date;
	}
	if($p_month < 10)
	{
		$p_month = "0".$p_month;
	}
	$thai_date_return = $p_month."-".$p_date."-".($p_year+543)." ".$p_hour.":".$p_minute;
	}else{
	$thai_date_return = $today;
	}
	return $thai_date_return;
}
function get_name_ccaattmm($catm)
{
	//global $dbConnect;
	if($catm == "")
	{
		$catm_desc = "-";
	}else{
		$sql = "select catm_desc from tab_e_ccaattmm where catm_ukey='$catm' ";
		$query = mysql_query($sql);
		$result = mysql_fetch_array($query);
		$catm_desc = $result['catm_desc'];
	}
	return $catm_desc;
}
function check_use($id)
{
	$sql = "select count(*) as sum from tab_e_regis where pid='$id' and expire_date='0' ";
	$query = mysql_query($sql);
	$result = mysql_fetch_array($query);
	$sum = $result['sum'];
	if($sum == 0)
	{
		return false;
	}else{
		return true;
	}
}
function formatPID($pid){
$pid = sprintf("%013s", $pid);
return $pid{0}."-".$pid{1}.$pid{2}.$pid{3}.$pid{4}."-".$pid{5}.$pid{6}.$pid{7}.$pid{8}.$pid{9}."-".$pid{10}.$pid{11}."-".$pid{12};
}

?>