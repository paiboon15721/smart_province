<?php
include ("../FUNCTION/function.php");
$choice = $_GET["choice"];
	$pid = $_GET["pid"];
if($choice=="check_info"){ //////////////////////////////////////////////////////////////////////
	$sql = "select r_no,date_in,date_out from tab_r_info where pid='$pid' order by r_no DESC";
	$query = mysql_query($sql);
	if ($query) {
		if (mysql_num_rows($query) == 0){$rows = false;}else{$rows =  true;}
		if ($rows === true){ //พบรายการ
			$row = mysql_fetch_array($query);
		   $r_no = $row['r_no'];
			$date_in = $row['date_in'];
			$date_out = $row['date_out'];
			if($date_in<>0 and $date_out<>0){$r_no_new = true;} //ทำอันใหม่
			elseif($date_in<>0 and $date_out==0){echo "1|$r_no";} //ทำอันเดิมต่อ
			else{echo "99|ข้อมูลมีปัญหาแล้ว";} //มีปัญหาแล้ว
		}else{ $r_no_new = true;} //ไม่พบรายการ
	}else{$r_no_new = false;}
	if($r_no_new==true){
		$sql = "select r_no,date_in,date_out from tab_r_info  order by r_no DESC";
				$query = mysql_query($sql);
				if (mysql_num_rows($query) == 0){$rows = false;}else{$rows =  true;}
				if ($rows === true){ //
					$row = mysql_fetch_array($query);
					$r_no = $row['r_no'];
					$year = substr(get_upd_date(), 2, 2);
					if($year <> substr($r_no, 0, 2)){$r_no = $year."00001";}
					else{$r_no = $r_no +1;}
					echo "0|$r_no"; 
				}else{
					$year = substr(get_upd_date(), 2, 2);
					$r_no = $year."00001";
					echo "0|$r_no"; 
				}
	}
}elseif($choice=="add_start"){ ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$r_no = $_GET["r_no"];
	$catm = $_GET["catm"];
	$datein = $_GET["datein"];
	$timein = $_GET["timein"];
	$timein = $timein."00";
	$upd_date =  get_upd_date();
	$sql = "insert into tab_r_info values ('$r_no','$catm' , '$pid' , '$datein' , '$timein' , '' , '' , '' , '' ,'$upd_date' , '$pid') ";
	$query = mysql_query($sql);
		if ($query) {
			echo "1|บันทึกเวลาเข้างานเรียบร้อย";
		}else{
			echo "0|ไม่สามารถบันทึกได้";
		}
}elseif($choice=="add_end"){  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$r_no = $_GET["r_no"];
	$catm = $_GET["catm"];
	$dateout = $_GET["dateout"];
	$timeout = $_GET["timeout"];
	$timeout = $timeout."00";
	$remark = $_GET["remark"];
	$situation = $_GET["situation"];
	$upd_date =  get_upd_date();
	$sql = "update tab_r_info set date_out='$dateout' , time_out='$timeout' , remark='$remark' , situation='$situation' ,upd_date='$upd_date' , upd_emp='$pid' where r_no='$r_no'  ";
	$query = mysql_query($sql);
		if ($query) {
			echo "1|บันทึกเวลาออกงานเรียบร้อย";
		}else{
			echo "0|ไม่สามารถบันทึกได้";
		}
}else{echo "$choice $pid";}
?>