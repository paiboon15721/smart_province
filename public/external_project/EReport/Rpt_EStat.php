<?php
header("Content-type: text/html; charset=utf-8");
include "EFunction.php";
session_start();
$connid=condb("village_center");
include ("header_top.php");
include ("header_body.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" >
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>รายงานเหตุการณ์ประจำวัน</title>
<link href="EStyle.css" rel="stylesheet" type="text/css">
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
		
		form.actcode.value=100;
		form.submit();
		return true;
}
</script>

<body>
<?php
/*
		$func_sql="select * from e_regis";
		$rid=sqlsrv_query($connid, $func_sql);
		if($rid === false) {
  			  die( print_r( sqlsrv_errors(), true) );
		}
		
		while($rows = sqlsrv_fetch_array($rid, SQLSRV_FETCH_ASSOC)){
			$pid=$rows['pid'];
			echo $pid;
		}
*/
?>
<form name="rpt_ereport" method="post" action="<?php echo $PHP_SELF; ?>">
<input type="hidden" name="actcode" value="<?php echo $actcode; ?>">
<div id="container">
<table width="1000" border="0" cellspacing="0" cellpadding="0" class="normalfont">
  <tr>
    <td colspan="2"><table width="1000" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <th height="40" colspan="2" class="normalfont"><strong>รายงานสถิติเหตุการณ์ประจำวัน</strong></th>
        </tr>
        <?php
        	$arr[0]=$_POST['province'];
			$arr[1]=$_POST['amphoe'];
			$arr[2]=$_POST['district'];	
			$arr[3]=$_POST['moo'];		
		?>
        <tr>
          <td>&nbsp;</td>
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
      <?php  } ?>
    </table></td>
  </tr>
  
  <tr>
    <td colspan="2"><table width="1000" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td width="260"><div align="right" class="normalfont"><strong>ระหว่างวันที่ :</strong></div></td>
        <td width="728" class="normalfont"><select name="in_day" class="inputfont">
			<?php
				genday($_POST['in_day']);
			?>
		</select>
		<select name="in_month" class="inputfont">
			<?php
				genmonth($_POST['in_month']);
			?>
		</select>
		<select name="in_year" class="inputfont">
			<?php
				genyear(2555, 2570, $_POST['in_year']);
			?>
		</select>&nbsp;&nbsp;
		<strong>ถึง</strong> &nbsp;&nbsp;<select name="in_day" class="inputfont">
			<?php
				genday($_POST['in_day']);
			?>
		</select>
		<select name="in_month" class="inputfont">
			<?php
				genmonth($_POST['in_month']);
			?>
		</select>
		<select name="in_year" class="inputfont">
			<?php
				genyear(2555, 2570, $_POST['in_year']);
			?>
		</select></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><table width="1000" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="260">&nbsp;</td>
        <td width="728"><input type="button" name="but_rpt" value="แสดงรายงาน" onClick="ChkData(this.form);" class="normalfont"></td>
      </tr>
      
    </table></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
   <tr>
    <td colspan="2" align="center"><table width="900" border="1" cellspacing="0" cellpadding="3">
      <tr>
        <td width="15" bgcolor="#66CCFF"><div align="center" class="normalfont"><strong>::</strong></div></td>
        <td width="216" bgcolor="#66CCFF"><div align="center" class="normalfont"><strong>สถานที่เกิดเหตุการณ์</strong></div></td>
        <td width="60" bgcolor="#66CCFF"><div align="center" class="normalfont"><strong>ไฟไหม้</strong></div></td>
        <td width="100" bgcolor="#66CCFF"><div align="center" class="normalfont"><strong>ชุมนุม</strong></div></td>
        <td width="98" bgcolor="#66CCFF"><div align="center" class="normalfont"><strong>น้ำท่วม</strong></div></td>
        <td width="140" bgcolor="#66CCFF"><div align="center" class="normalfont"><strong>ทะเลาะวิวาท</strong></div></td>
        <td width="75" bgcolor="#66CCFF"><div align="center" class="normalfont"><strong>ขโมย</strong></div></td>
        <td width="90" bgcolor="#66CCFF"><div align="center" class="normalfont"><strong>อื่นๆ</strong></div></td>
        <td width="40" bgcolor="#66CCFF"><div align="center" class="normalfont"><strong>รวม</strong></div></td>
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
			$i=1;
			$func_sql2="select catm_ukey, catm_desc from tab_e_ccaattmm where catm_ukey like '$code%' "
			." and flag_area=4 and catm_tdate=0 order by catm_ukey";
			$rid2=mysql_query($func_sql2, $connid);
			//echo $func_sql2;
			while($rows2=mysql_fetch_array($rid2)) {
			
				$catm_ukey=$rows2['catm_ukey'];
				$catm_desc=$rows2['catm_desc'];
				$arr2[$i][0]=$catm_ukey;
				$arr2[$i][101]=$catm_desc;
				$i++;
			}
		
  		$arr=array("1"=>"ไฟไหม้", "2"=>"ชุมนุม", "3"=>"น้ำท่วม", "4"=>"ทะเลาะวิวาท", "5"=>"ขโมย", "99"=>" อื่นๆ"); 
		while(list($value, $key)=each($arr)) {
		
						
		 for($i=1;$i<=count($arr2);$i++) {
		 		$catm_ukey=$arr2[$i][0];
				$catm_desc=$arr2[$i][101];
		
			$func_sql="select count(*) as num from tab_r_detail a,"
			." tab_r_info b where r_type=$value "
			." and a.r_no=b.r_no and b.ccaattmm=$catm_ukey";
			//echo $func_sql;
			$rid=mysql_query($func_sql, $connid);
			$row=mysql_fetch_array($rid);
			$num=$row['num'];
			
			//echo $i."/".$key."/".$catm_ukey."/".$catm_desc."/".$num."<br>";
			//echo $i."/".$key."<br>";
			$arr2[$i][$value]=$num;
				
			}
			
		}
		
  	}
	for($i=1;$i<=count($arr2);$i++) {
		$bgcolor = ($bgcolor == "#FFFFFF") ? "#E4E4E4" : "#FFFFFF";
		$sum1=$sum1+$arr2[$i][1];
		$sum2=$sum2+$arr2[$i][2];
		$sum3=$sum3+$arr2[$i][3];
		$sum4=$sum4+$arr2[$i][4];
		$sum5=$sum5+$arr2[$i][5];
		$sum99=$sum99+$arr2[$i][99];
		
		$sumc="sumc".$i;
		$$sumc=$arr2[$i][1]+$arr2[$i][2]+$arr2[$i][3]+$arr2[$i][4]+$arr2[$i][5]+$arr2[$i][99];
		$sum_all=$sum_all+$$sumc;
  ?>  
 
      <tr bgcolor="<?php echo $bgcolor; ?>">
        <td align="center"><div align="center" class="normalfont"><?php echo $i; ?></div></td>
        <td align="center"><div align="center" class="normalfont"><?php echo $arr2[$i][101]; ?></div></td>
        <td align="center"><div align="center" class="normalfont"><?php echo $arr2[$i][1]; ?></div></td>
        <td align="center"><div align="center" class="normalfont"><?php echo $arr2[$i][2]; ?></div></td>
        <td align="center"><div align="center" class="normalfont"><?php echo $arr2[$i][3]; ?></div></td>
        <td align="center"><div align="center" class="normalfont"><?php echo $arr2[$i][4]; ?></div></td>
        <td align="center"><div align="center" class="normalfont"><?php echo $arr2[$i][5]; ?></div></td>
        <td align="center"><div align="center" class="normalfont"><?php echo $arr2[$i][99]; ?></div></td>
        <td align="center"><div align="center" class="normalfont"><?php echo $$sumc; ?></div></td>
      </tr>
    <?php
    }		
	?>
    <tr bgcolor="<?php echo $bgcolor; ?>">
        <td colspan="2" align="center" bgcolor="#FFCCFF"><div align="center">รวม</div></td>
        <td align="center" bgcolor="#FFCCFF"><div align="center" class="normalfont"><?php echo $sum1; ?></div></td>
        <td align="center" bgcolor="#FFCCFF"><div align="center" class="normalfont"><?php echo $sum2; ?></div></td>
        <td align="center" bgcolor="#FFCCFF"><div align="center" class="normalfont"><?php echo $sum3; ?></div></td>
        <td align="center" bgcolor="#FFCCFF"><div align="center" class="normalfont"><?php echo $sum4; ?></div></td>
        <td align="center" bgcolor="#FFCCFF"><div align="center" class="normalfont"><?php echo $sum5; ?></div></td>
        <td align="center" bgcolor="#FFCCFF"><div align="center" class="normalfont"><?php echo $sum99; ?></div></td>
        <td align="center" bgcolor="#FFCCFF"><div align="center" class="normalfont"><?php echo $sum_all; ?></div></td>
      </tr>
    </table></td>
  </tr>
  <?php
  	
  ?>  
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
