<?php
include ("./FUNCTION/function.php");
$action = $_GET['action'];
//echo $_POST['eventTitle'];
if($action =='add')
{
		if(checkmax($_POST['catm'],$_POST['start_date'])=='3'){echo json_encode(false);}
     $sql = "INSERT INTO tab_guard SET catm = '".$_POST['catm']."', pid = '".$_POST['pid']."' , start_date = '".$_POST['start_date']."', end_date = '".$_POST['end_date']."', phase = '".$_POST['phase']."' , upd_date = '".$_POST['sysdate']."' ,upd_time = '".$_POST['systime']."' , upd_emp = '".$_POST['emp_pid']."' ";
	//echo  $sql;				
	mysql_query("set names 'utf8'");   	
	 $query=mysql_query($sql);
	 if($query){
		echo $_POST['start_date'].$_POST['phase'];
	}else{
		echo json_encode($query);
	}
}
elseif($action =='del')
{
    $sql = "DELETE FROM  tab_guard WHERE pid = '".$_POST['pid']."'  and start_date = '".$_POST['start_date']."' and phase = '".$_POST['phase']."' ";
	//echo  $sql;				
	mysql_query("set names 'utf8'");   	
	 $query=mysql_query($sql);				
    echo json_encode($query);
}
elseif($action =='sel')
{
	$event_array=array();
	$i_event=0;
	$sql="SELECT t1.pid, t2.fname,t2.mname,t2.lname, t1.start_date, t1.end_date, t1.phase FROM tab_guard t1,tab_group_member t2 WHERE t1.pid = t2.member_pid  AND t1.catm='".$_POST['catm']."' AND  t1.start_date>='".$_POST['start']."' AND t1.end_date<='".$_POST['end']."' ORDER by t1.start_date,t1.phase";
	//$sql="SELECT pid,  start_date, end_date, phase FROM tab_guard ";
	mysql_query("set names 'utf8'");  
	$qr=mysql_query($sql);
	while($rs=mysql_fetch_array($qr)){
		$pid = $rs['pid'];
		$start_date = $rs['start_date'];
		$end_date = $rs['end_date'];
		$phase =$rs['phase'];
		$start_date =  set_format_date($start_date);
		$end_date = $start_date;
		$event_array[$i_event]['id']=$start_date.$phase;
		$event_array[$i_event]['title']=$rs['fname']." ".$rs['mname']." ".$rs['lname'];
		$event_array[$i_event]['pid']=$pid;
		$event_array[$i_event]['start']=$start_date;
		$event_array[$i_event]['end']=$end_date;
		$event_array[$i_event]['phase']=$phase;
		$event_array[$i_event]['allDay']=false;
		$i_event++;
	}
	echo json_encode($event_array);	
}

function checkmax($catm,$date){

	$sql="SELECT COUNT(date) as count_guard FROM village_center.tab_guard WHERE catm=$catm";
	$qr=mysql_query($sql);
	if($qr){
		$rs=mysql_fetch_array($qr);
		return $rs['count_guard'];
	}else{
		return 0;
	}
}
function set_format_date($d){
	$dd = substr($d, 6, 2);
	$mm = substr($d, 4, 2);
	$yyyy = substr($d, 0, 4);
	$yyyy = $yyyy-543;
	return "$yyyy-$mm-$dd";
}
?>