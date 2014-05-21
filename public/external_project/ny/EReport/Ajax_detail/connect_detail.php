<?php
include ("../FUNCTION/function.php");
$choice= $_GET["choice"];
	$r_no = $_GET["r_no"];
if($choice=="show_list"){ ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo "<table  width='900px' align='center' border='1' style='font-size:85%'><thead><tr height='15'><th  align='center' ><p>::<p></th><th  align='center'><p>วันที่เริ่มพบเหตุการณ์(เวลา)<p></th><th  align='center'><p>ประเภทของเหตุการณ์<p></th><th  align='center'><p>รายละเอียดของเหตุการณ์<p></th><th  align='center'><p>สถานะของเหตุการณ์<p></th><th  align='center'><p> :: <p></th></tr></thead><tbody>";
	$sql = "select * from tab_r_detail where r_no='$r_no'  order by date_s,time_s ASC ";
	$query = mysql_query($sql);
	if ($query) {
		if (mysql_num_rows($query) == 0){$rows = false;}else{$rows =  true;}
		if ($rows === true){ //พบรายการ
			$i = 1;
			while($row = mysql_fetch_array($query)){
			   $r_no = $row['r_no'];
				$date_s = $row['date_s'];
				$time_s = $row['time_s'];
				$date_e = $row['date_e'];
				$time_e = $row['time_e'];
				$r_type = $row['r_type'];
				$r_another = $row['r_another'];
				$r_detail = $row['r_detail'];
				$r_status = $row['r_status'];
				$upd_emp =  $row['upd_emp'];
				//echo "$r_no $date_s $time_s $date_e $time_e $r_type $r_another $r_detail $r_status";
				$date_s_show = set_format_date($date_s);$time_s_show = set_format_time($time_s);
				$date_e_show = set_format_date($date_e);$time_e_show = set_format_time($time_e);
				if($date_s_show==$date_e_show){$date_time_show = "$date_s_show ( $time_s_show - $time_e_show )";}
				else{$date_time_show = "[$date_s_show $time_s_show] - [$date_e_show  $time_e_show]";}
				//echo "<tr height='20' valign='middle'><td  align='center' ><p>$i<p></td><td  align='center'><p>$date_time_show<p></td><td  align='center'><p>".set_text_type($r_type,$r_another)."<p></td><td  align='center'><p>$r_detail<p></td><td  align='center'><p>".set_text_status($r_status)."<p></td><td  align='center'><p><img class='imgclick' src='./images/edit2.gif' onClick=load_chronicle('$r_no','$date_s','$time_s','$r_type','$r_another','$r_detail','$r_status','$date_e','$time_e'); /><p></td></tr></thead><tbody>";
				?><tr height='20' valign='middle'>
					<td  align='center'  width="50px"><p><?php echo $i; ?><p></td>
					<td  align='center'  width="230px"><p><?php echo $date_time_show; ?><p></td>
					<td  align='center'  width="70px"><p><?php echo set_text_type($r_type,$r_another);?><p></td>
					<td  align='center'  width="300px"><p><?php echo set_text_detail($r_detail); ?><p></td>
					<td  align='center'  width="100px"><p><?php echo set_text_status($r_status); ?><p></td>
					<td  align='center'  width="50px"><p>
						<img class='imgclick' src='./images/edit2.gif' alt ="แก้ไขข้อมูล" style="cursor:pointer;cursor:hand;" onClick="load_chronicle('<?php echo $r_no; ?>','<?php echo $date_s; ?>','<?php echo $time_s; ?>','<?php echo $r_type; ?>','<?php echo $r_another; ?>','<?php echo $r_detail; ?>','<?php echo $r_status; ?>','<?php echo $date_e; ?>','<?php echo $time_e; ?>');" />
						<img class='imgclick' src='./images/delete.gif' alt ="ลบข้อมูล" style="cursor:pointer;cursor:hand;" onClick="del_chronicle('<?php echo $r_no; ?>','<?php echo $date_s; ?>','<?php echo $time_s; ?>');"/>
					<p></td></tr></thead><tbody><?php
				$i++;
			}
		}else{ $r_no_new = true;} //ไม่พบรายการ
	}
	echo "</tbody></table >";
}elseif($choice=="add_detail" or $choice=="upd_detail"){ ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$pid = $_GET["pid"];
	$date_s = $_GET["date_s"];
	$time_s = $_GET["time_s"];
	$time_s = $time_s."00";
	$date_e = $_GET["date_e"];
	$time_e = $_GET["time_e"];
	$time_e = $time_e."00";
	$r_type = $_GET["r_type"];
	$r_another = $_GET["r_another"];
	$r_detail = $_GET["r_detail"];
	$r_status = $_GET["r_status"];
	$upd_date =  get_upd_date();
	//echo "$r_no $date_s $time_s $r_type $r_another $r_detail $r_status $date_e $time_e $upd_date $pid";
	if($choice=="add_detail"){
		$sql = "insert into tab_r_detail values ('$r_no','$date_s' , '$time_s' , '$r_type' , '$r_another' , '$r_detail' , '$r_status' , '$date_e' , '$time_e' ,'$upd_date' , '$pid') ";
		$remsg1="จัดเก็บข้อมูลเหตุการณ์เรียบร้อย";
		$remsg2="ไม่สามารถจัดเก็บข้อมูลได้";
	}elseif($choice=="upd_detail"){
		$sql  = "update tab_r_detail set r_type='$r_type' , r_another='$r_another' , r_detail='$r_detail' , r_status='$r_status' ,date_e='$date_e' ,time_e='$time_e' ,upd_date='$upd_date' , upd_emp='$pid' where r_no='$r_no' and  date_s='$date_s' and  time_s='$time_s'  ";
		$remsg1="ปรับปรุงข้อมูลเหตุการณ์เรียบร้อย";
		$remsg2="ไม่สามารถปรับปรุงข้อมูลได้";
	}
	$query = mysql_query($sql);
		if ($query) {
			echo "1|$remsg1";
		}else{
			echo "0|$remsg2";
		}
}elseif($choice=="del_detail"){ ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$pid = $_GET["pid"];
	$date_s = $_GET["date_s"];
	$time_s = $_GET["time_s"];
	$time_s = $time_s;
	$upd_date =  get_upd_date();
		$remsg1="ลบข้อมูลเหตุการณ์เรียบร้อย";
		$remsg2="ไม่สามารถลบข้อมูลได้";
		$sql = "delete from tab_r_detail where r_no='$r_no' and date_s='$date_s' and time_s='$time_s' ";
		$query = mysql_query($sql);
		$pic_no = "$r_no$date_s$time_s";
		$sql1 = "delete from tab_e_pic where pic_no='$pic_no'";
		$query1 = mysql_query($sql1);
		if ($query and $query1) {
			echo "1|$remsg1";
		}else{
			echo "0|$remsg2";
		}
}
function set_format_date($d){
	$dd = substr($d, 6, 2);
	$mm = substr($d, 4, 2);
	$yyyy = substr($d, 0, 4);
	if($dd<10){$dd="0".$dd;}
	return "$dd-$mm-$yyyy";
}
function set_format_time($t){
   if($t==0){return "00:00";}
	$hh = substr($t, 0,2);
	$mm = substr($t, 2,2);
	if($hh<10){$hh="0".$hh;}
	return "$hh:$mm";
}
function set_text_type($type,$another){
	$type_arr=array("ไม่ระบุ","ไฟไหม้","ชุมนุม","น้ำท่วม","ทะเลาะวิวาท","ขโมย");
	if($type<=5){return $type_arr[$type];}
	else {
		if($another==""){return "ไม่ระบุ";}
		else{return $another;}
	}
}
function set_text_status($status){
	if($status==0){return "ยังดำเนินอยู่";}
	else {return "สิ้นสุดเหตุการณ์";}
}
function set_text_detail($detail){
	if($detail==""){return "-";}
	else {return $detail;}
}
?>