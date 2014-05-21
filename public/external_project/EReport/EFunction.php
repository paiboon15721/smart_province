<?php
	$nowday=date("d");
	$nowmonth=date("m");
	$nowyear=date("Y")+543;
	$nowdate=$nowyear.$nowmonth.$nowday;
	
	$now_h=date("H");
	$now_m=date("i");
	$now_s=date("s");
	$nowtime=$now_h.$now_m.$now_s;
	

function dbmsg () {
        $msg = ERRDBMSG . mysql_errno() . ":" . mysql_error() . "  !!!!!";
        showmsg($msg);
}
function starttran($connid) {
        $func_sql = "begin";
        return mysql_query($func_sql, $connid);
}

function committran($connid) {
        $func_sql = "commit";
        return mysql_query($func_sql, $connid);
}

function rollbacktran($connid) {
        $func_sql = "rollback";
        return mysql_query($func_sql, $connid);
}
function condb($dbname) {
                $host = "localhost";
                $usr = "mia";
                $usrpwd = "mia";
     
   if (!($connid = mysql_connect($host, $usr, $usrpwd))) {
                showmsg("เกิดความผิดพลาด");
      return false;
   }

   if (!mysql_select_db($dbname)){
      dbmsg();
      return false;
   }

   		mysql_query("SET NAMES utf8");
          return $connid;
}
function cutpid($pid) {
		$arr=explode("-", $pid);
		for($i=0;$i<=count($arr); $i++) {
			$pid_new=$pid_new.$arr[$i];
		}
		trim($pid_new);
		return $pid_new;
}
function genday($day_select) {
	if(empty($day_select)) {
		$day_select=date("j");
	}
		for($i=1;$i<=31;$i++) {
		
			if($i<10) 
				$b="0".$i;
			else
				$b=$i;
			
			if($i==$day_select) {
				echo"<option value=\"".$b."\" selected>".$i."</option>";
			}
			else {
			   echo"<option value=\"".$b."\">".$i."</option>";
			}
		}
}
function desc_month($month_select){
	$month_array=array("01"=>"มกราคม","02"=>"กุมภาพันธ์","03"=>"มีนาคม","04"=>"เมษายน",
	"05"=>"พฤษภาคม","06"=>"มิถุนายน","07"=>"กรกฏาคม","08"=>"สิงหาคม","09"=>"กันยายน",
	"10"=>"ตุลาคม","11"=>"พฤศจิกายน","12"=>"ธันวาคม");
	while(list($value, $key)=each($month_array)) {
		if($value==$month_select) {
			return $key;
		}
	}
}
function genmonth($month_select) {
$month_array=array("01"=>"มกราคม","02"=>"กุมภาพันธ์","03"=>"มีนาคม","04"=>"เมษายน",
"05"=>"พฤษภาคม","06"=>"มิถุนายน","07"=>"กรกฏาคม","08"=>"สิงหาคม","09"=>"กันยายน",
"10"=>"ตุลาคม","11"=>"พฤศจิกายน","12"=>"ธันวาคม");
	//global $month_array;
	if(empty($month_select)) {
		$month_select=date("n");
	}
	while(list($value, $key)=each($month_array)) {
		if($value==$month_select) {
			echo"<option value=\"".$value."\" selected>".$key."</option>";
			} else {
			echo"<option value=\"".$value."\">".$key."</option>";
		}	
	}
}
function genyear($yr_start, $yr_end, $year_select) {
		if(empty($year_select)) {
			$year_select=date("Y")+543;
		}
		for($i=$yr_start;$i<=$yr_end; $i++) {
			if($i==$year_select) {
				echo"<option value=\"".$i."\" selected>".$i."</option>";
			}
			else {
			   echo"<option value=\"".$i."\">".$i."</option>";
			}
		}
}
function show_select_location($arr, $flag, $connid) {
		$province=$arr[0];
		$amphoe=$arr[1];
		$tumbon=$arr[2];
		$moo=$arr[3];
	
	switch ($flag) {
		case 1: //จังหวัด
			$code=$province;
			$code2=26000000;
			$func_sql="select * From village_center.tab_e_ccaattmm where flag_area=".$flag." and catm_tdate=0"
			." order by catm_ukey";
		break;
		case 2: //อำเภอ
			$cc=substr($province, 0, 2);
			$code=$amphoe;
			$code2=26010000;
			$func_sql="select * From tab_e_ccaattmm where flag_area=".$flag." and catm_tdate=0"
			//." and substring(catm_ukey, 0, 2)=".$cc." order by catm_ukey";
			." and catm_ukey like '".$cc."%' order by catm_ukey";
		break;
		case 3: //ตำบล
			$ccmm=substr($amphoe, 0, 4);
			$code=$tumbon;
			$code2=26011200;
			$func_sql="select * From tab_e_ccaattmm where flag_area=".$flag." and catm_tdate=0"
			//." and substring(catm_ukey, 0, 4)=".$ccmm." order by catm_ukey";
			." and catm_ukey like '".$ccmm."%' order by catm_ukey";
		break;
		case 4: //หมู่
			$ccmmtt=substr($tumbon, 0, 6);
			$code=$moo;
			$code2=26011201;
			$func_sql="select * From tab_e_ccaattmm where flag_area=".$flag." and catm_tdate=0"
			." and catm_ukey like '".$ccmmtt."%' order by catm_ukey";
		break;
	}
	//echo $func_sql;
	$rid=mysql_query($func_sql, $connid);
		
		while($rows = mysql_fetch_array($rid)){
			$catm_ukey=$rows['catm_ukey'];
			$catm_desc=$rows['catm_desc'];
			if($catm_ukey==$code2) {
				if($catm_ukey==$code) {
					echo"<option value='".$catm_ukey."' selected>- ".$catm_desc."</option>";
				}
				else {
					echo"<option value='".$catm_ukey."'>- ".$catm_desc."</option>";
				}
			}
			//echo $catm_ukey."|".$catm_desc;
		}

}
function show_select_rtype($code) {
	
	$arr=array("1"=>"ไฟไหม้", "2"=>"ชุมนุม", "3"=>"น้ำท่วม", "4"=>"ทะเลาะวิวาท", "5"=>"ขโมย", "99"=>" อื่นๆ"); 
	while(list($value, $key)=each($arr)) {
		if($value==$code) {
			echo"<option value=\"".$value."\" selected>".$key."</option>";
			} else {
			echo"<option value=\"".$value."\">".$key."</option>";
		}	
	}
	
}
function rtype_detail($code) {
	$arr=array("1"=>"ไฟไหม้", "2"=>"ชุมนุม", "3"=>"น้ำท่วม", "4"=>"ทะเลาะวิวาท", "5"=>"ขโมย", "99"=>" อื่นๆ"); 
	while(list($value, $key)=each($arr)) {
		if($value==$code) {
			return $key;
		}	
	}
}
function desc_datetime($date, $time) {
	$date2=substr($date, 6, 2)." ".desc_month(substr($date, 4, 2))." ".substr($date, 0, 4);
	
	if(strlen($time)==5) {
		$time2=substr($time, 0, 1).":".substr($time, 1, 2).":".substr($time, 3, 2);
	}
	else {
		$time2=substr($time, 0, 2).":".substr($time, 2, 2).":".substr($time, 4, 2);
	}

	echo $date2." (".$time2.")";
}
function desc_status($code) {
	switch ($code) {
	case 0:
			echo"เหตุการณ์ยังดำเนินการอยู่";
	break;
	case 99:
			echo"สิ้นสุดเหตุการณ์";
	break;	
	}
}
function desc_status2($code) {
	switch ($code) {
	case 0:
			echo"สถานการณ์ปกติ";
	break;
	case 1:
			echo"สถานการณ์ไม่ปกติ";
	break;	
	}
}
function desc_pid($pid) {
	echo substr($pid, 0, 1)." ".substr($pid, 1, 4)." ".substr($pid, 5, 5)." ".substr($pid, 10, 2)." ".substr($pid, 12, 1);
}
function count_sum($s_date, $e_date, $r_type, $ccaattmm, $connid) {
	$func_sql8="select count(*) from tab_r_info a, tab_r_detail b where a.r_no=b.r_no"
	." and a.ccaattmm like '$ccaattmm%' and r_type=$r_type and date_s>=$s_date and date_s<=$e_date ";
	$rid8=mysql_query($func_sql8, $connid);
	list($count)=mysql_fetch_row($rid8);
	//echo $func_sql8."<br>";

	return $count;

}
function get_name($pid) {
	
	//$host = "172.16.224.201:1521/orcl";
	$host = "nrs:1521/orcl";
	$username = "mia";
	$password = "mia";
	$conn=oci_connect($username,$password,$host,'AL32UTF8');

	$sql = "select fname,lname from ors.pop where pid='$pid' ";
	$objParse = oci_parse($conn, $sql);
	oci_execute ($objParse);
	$objResult = oci_fetch_array($objParse,OCI_BOTH);
	$fname = $objResult[0];
	$lname = $objResult[1];
	oci_close($conn);
	$name=$fname." ".$lname;
	return $name;
}

?>