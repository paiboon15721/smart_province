<?php
header("Content-type: text/html; charset=utf-8");
include "EFunction.php";
session_start();
$connid=condb("e_report");
include ("header_top.php");
include ("header_body.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" >
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>รายงานเหตุการณ์ประจำวัน</title>
<link href="EStyle.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="FUNCTION/jquery.min.js"></script> 
<style type="text/css">
<!--
.style1 {color: #0080C0}
-->
</style>
</head>
<script language="javascript">
function PidDash(a) {
		var b = a.value.length;
		switch(b) {
			case 1 : case 6 : case 12 : case 15 : 
			a.value = a.value + "-";
		}
}
function ChkData5(form, key, pid) {
	if ( ((key < 48) || (key > 57)) && (key != 13)) {
			return false;
   	}else {
	
	/*
	if(key==13) {
		var pid_val = pid.value;
		var b = pid.value.length;
		var j=0;
		for(i=0;i<b;i++) {
			var c=pid.value.substring(i,1);
			if(c=="-") {
				j++;
			}
		}
		
		if((((b>0)&&(b<17))&&(j>0))||(b<3)) {
	           alert("กรุณาระบุหมายบัตรประจำตัวประชาชนให้ถูกต้อง");
               return false;
      	}
		if ( pid_val=='') {
               alert("กรุณาระบุหมายบัตรประจำตัวประชาชนที่ต้องการดึงข้อมูล");
               return false;
      	}
		//alert(form.pay_pid.value);
		form.submit();
		return true;
		}
	*/
		return true;
	}
}
function ChkData(form) {
		
		
		if(form.province.value=='') {
				alert("กรุณาเลือกจังหวัด");
				form.province.focus();
				return false;
		}
		if(form.r_type.value=='') {
				alert("กรุณาเลือกประเภทของเหตุการณ์");
				form.r_type.focus();
				return false;
		}
		
		form.actcode.value=100;
		form.submit();
		return true;
}
</script>

<body>
<form name="rpt_ereport" method="post" action="<?php echo $PHP_SELF; ?>">
<input type="hidden" name="actcode" value="<?php echo $actcode; ?>">
<div id="container">
<table width="1000" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2"><table width="1000" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <th height="40" colspan="2" class="normalfont"><strong>รายงานเวลาทำงานและเหตุการณ์</strong></th>
        </tr>
        <?php
        	$arr[0]=$_POST['province'];
			$arr[1]=$_POST['amphoe'];
			$arr[2]=$_POST['district'];	
			$arr[3]=$_POST['moo'];		
		?>
        <tr>
          <td class="normalfont">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
        <td width="260"><div align="right" class="normalfont"><strong>จังหวัด :</strong></div></td>
        <td width="728">
        <select name="province" onChange="submit();" class="inputfont">
        	<option value="">--- เลือกจังหวัด ---</option>
		<?php
        	show_select_location($arr, 1, $connid);		
		?>
        </select>        </td>
      </tr>
      <?php
      	if($_POST['province'] != '') {
	  ?>
      <tr>
        <td><div align="right" class="normalfont"><strong>อำเภอ :</strong></div></td>
        <td><select name="amphoe" onChange="submit();" class="inputfont">
        	<option value="">--- เลือกอำเภอ ---</option>
		<?php
        	show_select_location($arr, 2, $connid);		
		?>
        </select></td>
      </tr>
      <?php
      	}
	  	if(($_POST['province'] != '')&&($_POST['amphoe'] != '')) {
	  ?>
      <tr>
        <td><div align="right" class="normalfont"><strong>ตำบล :</strong></div></td>
        <td><select name="district" onChange="submit();" class="inputfont">
        	<option value="">--- เลือกตำบล ---</option>
		<?php
        	show_select_location($arr, 3, $connid);		
		?>
        </select></td>
      </tr>
      <?php
      	}
	  if(($_POST['province'] != '')&&($_POST['amphoe'] != '')&&($_POST['district'] != '')) {
	  ?>
      <tr>
        <td><div align="right" class="normalfont"><strong>หมู่บ้าน :</strong></div></td>
        <td><select name="moo" class="inputfont">
        	<option value="">--- เลือกหมู่บ้าน ---</option>
		<?php
        	show_select_location($arr, 4, $connid);		
		?>
        </select></td>
      </tr>
      <?php } ?>
      <tr>
        <td><div align="right" class="normalfont"><strong>ผู้ปฏิบัติงาน :</strong></div></td>
        <td><input type="text" name="pid" value="<?php echo $_POST['pid']; ?>" size="17" class="inputfont" maxlength="17" onKeyPress="PidDash(document.rpt_ereport.pid);return ChkData5(this.form,window.event.keyCode,document.rpt_ereport.pid);" /></td>
      </tr>
      <tr>
        <td><div align="right" class="normalfont"><strong>ประเภทของเหตุการณ์ :</strong></div></td>
        <td><select name="r_type" class="inputfont">
          <option value="">--- เลือกประเภทของเหตุการณ์ ---</option>
          <?php 
		  if($_POST['r_type']==100)
		  		echo"<option value=\"100\" selected>- ทุกเหตุการณ์</option>";
		  else
		  		echo"<option value=\"100\">- ทุกเหตุการณ์</option>";
		  
		      	show_select_rtype($_POST['r_type']);
		?>
        </select></td>
      </tr>
      <tr>
        <td><div align="right" class="normalfont"><strong>ระหว่างวันที่ :</strong></div></td>
        <td><span class="normalfont">
          <select name="s_day" class="inputfont">
            <?php
				genday($_POST['s_day']);
			?>
          </select>
          <select name="s_month" class="inputfont">
            <?php
				genmonth($_POST['s_month']);
			?>
          </select>
          <select name="s_year" class="inputfont">
            <?php
				genyear(2555, 2570, $_POST['s_year']);
			?>
          </select>
          &nbsp;&nbsp; <strong>ถึง</strong> &nbsp;&nbsp;
          <select name="e_day" class="inputfont">
            <?php
				genday($_POST['e_day']);
			?>
          </select>
          <select name="e_month" class="inputfont">
            <?php
				genmonth($_POST['e_month']);
			?>
          </select>
          <select name="e_year" class="inputfont">
            <?php
				genyear(2555, 2570, $_POST['e_year']);
			?>
          </select>
        </span></td>
      </tr>
      
      
    </table></td>
  </tr>
  
  <tr>
    <td colspan="2"><table width="1000" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td width="260">&nbsp;</td>
        <td width="728"><input type="button" name="but_rpt" value="แสดงรายงาน" onClick="ChkData(this.form);" class="normalfont"></td>
      </tr>
      
    </table></td>
  </tr>
  <?php
  	if($_POST['actcode']==100) {
		
		$code="";
		if(($_POST['province'] != "")&&($_POST['amphoe'] == "")&&($_POST['district'] == "")&&($_POST['moo'] == "")) $code=substr($_POST['province'], 0, 2);
		if(($_POST['province'] != "")&&($_POST['amphoe'] != "")&&($_POST['district'] == "")&&($_POST['moo'] == "")) $code=substr($_POST['amphoe'], 0, 4); 
		if(($_POST['province'] != "")&&($_POST['amphoe'] != "")&&($_POST['district'] != "")&&($_POST['moo'] == "")) $code=substr($_POST['district'], 0, 6);
		if(($_POST['province'] != "")&&($_POST['amphoe'] != "")&&($_POST['district'] != "")&&($_POST['moo'] != "")) $code=$_POST['moo']; 
		
		//echo $_POST['province']."/".$_POST['amphoe']."/".$_POST['district']."/".$_POST['moo'];
		//echo $code;
		$s_date=$s_year.$s_month.$s_day;
		$e_date=$e_year.$e_month.$e_day;
		
		$func_sql="select * from tab_r_info a, tab_e_ccaattmm b  where b.catm_ukey=a.ccaattmm "
		." and a.ccaattmm like '$code%' and date_in >= $s_date and date_in <= $e_date";
		if($_POST['pid'] != "") {
				 $pid2=cutpid($_POST['pid']);
				 $func_sql.=" and pid=$pid2 ";
		}
		$func_sql .=" order by a.r_no";
		//echo $func_sql;
		$rid=mysql_query($func_sql, $connid);
		$num=mysql_num_rows($rid);
		
	if($num>0) {
  ?>  
  <tr>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><table width="900" border="1" cellspacing="0" cellpadding="3">
     <tr class="normalfont">
        <td width="18"><div align="center"><strong>::</strong></div></td>
        <td width="109"><div align="center"><strong>สถานที่</strong></div></td>
        <td width="173"><div align="center"><strong>ผู้ปฏิบัติงาน</strong></div></td>
        <td width="140"><div align="center"><strong>เวลาเข้างาน</strong></div></td>
        <td width="143"><div align="center"><strong>เวลาออกงาน</strong></div></td>
        <td width="139"><div align="center"><strong>หมายเหตุ</strong></div></td>
        <td width="130"><div align="center"><strong>สถานการณ์</strong></div></td>
      </tr>
      <?php
	  	$u=1;
      	$m=1;
		while($rows=mysql_fetch_array($rid)){
			$r_no=$rows['r_no'];
			$ccaattmm=$rows['ccaattmm'];
			$pid=$rows['pid'];
			$date_in=$rows['date_in'];
			$time_in=$rows['time_in'];
			$date_out=$rows['date_out'];
			$time_out=$rows['time_out'];
			$remark=$rows['remark'];
			$situation=$rows['situation'];
			
			$catm_desc=$rows['catm_desc'];
			$bgcolor = ($bgcolor == "#FFFFFF") ? "#E4E4E4" : "#FFFFFF";
	  ?>
     
      <th class="normalfont" bgcolor="<?php echo $bgcolor; ?>" style="cursor:pointer;" onClick="$('#tr_toggle<?php echo $u; ?>').toggle();">
        <td align="center"><?php echo $m; ?></td>
        <td><?php echo $catm_desc; ?></td>
        <td><?php echo desc_pid($pid); ?></td>
        <td><?php desc_datetime($date_in, $time_in); ?></td>
        <td><?php if($date_out>0) desc_datetime($date_out, $time_out); else echo"-"; ?></td>
        <td><?php echo $remark; ?>&nbsp;</td>
        <td><?php echo desc_status2($situation); ?></td>
      </tr>
      <?php
	  			$m++;
	
		
		//echo $r_no;
	
	   $func_sql2="select * from tab_r_info a left outer join tab_r_detail b on a.r_no=b.r_no, tab_e_ccaattmm c "
			//." where a.ccaattmm like '$code%' and date_in >= $s_date and date_in <= $e_date and c.catm_ukey=a.ccaattmm ";
			." where a.r_no='$r_no' and date_in >= $s_date and date_in <= $e_date and c.catm_ukey=a.ccaattmm ";
	   if(($_POST['r_type']>0)&&($_POST['r_type']!=100)) {
			 $func_sql2.=" and r_type=".$_POST['r_type'];
	   }
			$func_sql2.=" order by a.r_no, a.ccaattmm, b.date_s, b.time_s ";
			//echo $func_sql;
			$rid2=mysql_query($func_sql2, $connid);
			$num2=mysql_num_rows($rid2);
			
			if($num2>0) {
  	?>
     <tr class="normalfont" style="display:none;" id="tr_toggle<?php echo $u; ?>">
        <td colspan="7" align="center"><table width="900" border="1" cellspacing="0" cellpadding="3">
          <tr>
            <td colspan="5" bgcolor="#00CCCC"><div align="center" class="normalfont"><strong>เหตุการณ์ที่เกิดขึ้น</strong></div></td>
            </tr>
          <tr>
            <td width="20" bgcolor="#00CCCC"><div align="center" class="normalfont"><strong>::</strong></div></td>
            <td width="162" bgcolor="#00CCCC"><div align="center" class="normalfont"><strong>วัน/เดือน/ปี (เวลา)</strong></div></td>
            <td width="168" bgcolor="#00CCCC"><div align="center" class="normalfont"><strong>ประเภทเหตุการณ์</strong></div></td>
            <td width="390" bgcolor="#00CCCC"><div align="center" class="normalfont"><strong>รายละเอียดเหตุการณ์</strong></div></td>
            <td width="110" bgcolor="#00CCCC"><div align="center" class="normalfont"><strong>สถานะเหตุการณ์</strong></div></td>
          </tr>
          <?php
      	
			$i=1;
			while($rows2=mysql_fetch_array($rid2)){
				$r_no=$rows2['r_no'];
				$ccaattmm=$rows2['ccaattmm'];
				$pid=$rows2['pid'];
				$date_in=$rows2['date_in'];
				$time_in=$rows2['time_in'];
				$date_out=$rows2['date_out'];
				$time_out=$rows2['time_out'];
				$remark=$rows2['remark'];
				$situation=$rows2['situation'];
				
				$date_s=$rows2['date_s'];
				$time_s=$rows2['time_s'];
				$r_type=$rows2['r_type'];
				$r_another=$rows2['r_another'];
				$r_detail=$rows2['r_detail'];
				$r_status=$rows2['r_status'];
				$date_e=$rows2['date_e'];
				$time_e=$rows2['time_e'];
				
				$catm_desc=$rows['catm_desc'];
	  ?>
          <tr class="normalfont" bgcolor="<?php echo $bgcolor; ?>">
            <td align="center"><?php echo $i; ?></td>
            <td><?php desc_datetime($date_s, $time_s); ?></td>
            <td><span class="style1"><?php echo rtype_detail($r_type); if(($r_type==99)&&($r_another!='')) echo"(".$r_another.")"; ?></span></td>
            <td><?php echo $r_detail; ?></td>
            <td><?php echo desc_status($r_status); ?></td>
          </tr>
          <?php
	  				$i++;
	  			}
				$u++;
			}
			
		
	?>
        </table></td>
        </tr>
    <?php
    			}
			}
		}
    ?>
    </table></td>
  </tr>
   <tr>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</div>
</form>
</body>
</html>
