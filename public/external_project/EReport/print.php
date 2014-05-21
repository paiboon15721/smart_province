<!DOCTYPE html>
<?php 
include ("./FUNCTION/function.php");
?>
<html>
<head>
<script defer>
function Data() {
	factory.printing.header = "";
	factory.printing.footer = "";
	factory.printing.portrait = true;
	factory.printing.leftMargin = 1.0;
	factory.printing.topMargin = 10.0;
	factory.printing.rightMargin = 1.0;
	factory.printing.bottomMargin = 1.0;
}
function PrintData() {
	window.print();
}
</script>
<style>
	#container {
		width: 900px;
		border:0; padding:0;
		margin: 20px auto;
		color: #000000; 
		}
		.tabline {
		margin: 0 100px;
		}
</style>
</head>
<body >
<div id='container' >
<?php
$month_array = array("","ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.","พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.","ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
$month_full_array=array( "","มกราคม", "กุมภาพันธ์",  "มีนาคม",  "เมษายน",  "พฤษภาคม",  "มิถุนายน",   "กรกฎาคม",  "สิงหาคม",  "กันยายน",  "ตุลาคม",  "พฤศจิกายน",  "ธันวาคม");  
$start_length = $_GET['start_date'];
$end_length = $_GET['end_date'];
$catm_desc = $_GET['catm_desc'];
$guard_array=array();
$i_guard=0;
$sql = "select start_date
	,(select CONCAT(m1.fname, ' ', m1.lname) from tab_guard s1,tab_group_member m1 where  phase='1' and s1.pid=m1.member_pid and a1.start_date=s1.start_date) as phase1
	,(select CONCAT(m2.fname, ' ', m2.lname) from tab_guard s2,tab_group_member m2 where phase='2' and s2.pid=m2.member_pid  and a1.start_date=s2.start_date) as phase2
	,(select CONCAT(m3.fname, ' ', m3.lname) from tab_guard s3,tab_group_member m3 where phase='3' and s3.pid=m3.member_pid  and a1.start_date=s3.start_date) as phase3
	from tab_guard a1 where start_date>='$start_length' and start_date<='$end_length' group by start_date";
	//echo $sql;
mysql_query("set names 'utf8'");  
	$qr=mysql_query($sql);
	while($rs=mysql_fetch_array($qr)){
		$guard_array[$i_guard]['start_date'] = $rs['start_date'];
		$guard_array[$i_guard]['phase1'] = $rs['phase1'];
		$guard_array[$i_guard]['phase2'] = $rs['phase2'];
		$guard_array[$i_guard]['phase3']=$rs['phase3'];
		$i_guard++;
	}
	//print_r($guard_array);
	?>
	<p align='center'>คำสั่งแต่งตั้งเวรยามประจำหมู่บ้าน</p>
	<p align='center'>เรื่อง คำสั่งแต่งตั้งเวรยามประจำหมู่บ้าน<?php echo $catm_desc;?> ประจำเดือน <?php echo  $month_full_array[get_date_split($start_length,'month')]; ?></p>
	<hr>
	<p class='tabline'>ขอแต่งตั้งเจ้าหน้าที่ที่มีรายชื่อต่อไปนี้ รับผิดชอบดูแลเวรยามประจำหมู่บ้าน<?php echo $catm_desc;?>โดยแบ่งรับผิดชอบตามวันที่กำหนดดังนี้</p>
	<br>
	<table border=1 width='800px' align='center'>
	<tr><td align='center'>วันที่</td ><td align='center'>[8.00 - 16.00 น]</td><td align='center'>[16.00 - 24.00 น]</td><td align='center'>[24.00 - 8.00 น]</td></tr>
	<?php 
		$day_last = 0;
		for($i=0;$i<count($guard_array);$i++) { 
			$start_date = $guard_array[$i]['start_date'];
			$phase1 = $guard_array[$i]['phase1'];
			$phase2 = $guard_array[$i]['phase2'];
			$phase3 = $guard_array[$i]['phase3'];
			$day = get_date_split($start_date,'day');
			$month = get_date_split($start_date,'month');
			$year = get_date_split($start_date,'year');
				for($j=$day_last+1;$j<$day;$j++) { 
					echo "<tr><td align='center'>$j $month_array[$month]  $year</td><td>-</td><td>-</td><td>-</td></tr>";
				}
				echo "<tr><td align='center'>$day $month_array[$month] $year</td><td>$phase1</td><td>$phase2</td><td>$phase3</td></tr>";
				$day_last = $day;
			}
			$day_in_month =  cal_days_in_month(CAL_GREGORIAN, $month, $year);
			for($j=$day_last+1;$j<=$day_in_month;$j++) { 
					echo "<tr><td align='center'> $j $month_array[$month]  $year</td><td>-</td><td>-</td><td>-</td></tr>";
				}
	?>
	</table>
	<br>
	<p class='tabline'>มีผลบังคับใช้ตั้งแต่วันที่<?php echo  "1 ".$month_full_array[get_date_split($start_length,'month')]." ".get_date_split($start_length,'year'); ?></p>
	<p align='right'>สั่ง ณ วันที่<?php echo  "1 ".$month_full_array[get_date_split($start_length,'month')]." ".get_date_split($start_length,'year'); ?></p>
	<br>
	<p align='right'>(ผู้ใหญ่บ้านหมูบ้าน<?php echo $catm_desc;?>) </p>
</div>
</body>
<?php
function get_date_split($d,$type){
	if($type=='year'){$result = substr($d, 0, 4);}
	elseif($type=='month'){$result = substr($d, 4, 2);}
	if($type=='day'){$result = substr($d, 6, 2);}
	return intval($result);
}
?>
<script>
	window.print();
	setTimeout("window.close();",500);
</script>
</html>