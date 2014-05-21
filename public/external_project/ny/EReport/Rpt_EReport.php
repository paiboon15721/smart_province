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
		/*
		if(form.r_type.value=='') {
				alert("กรุณาเลือกประเภทของเหตุการณ์");
				form.r_type.focus();
				return false;
		}
		*/
		form.actcode.value=100;
		form.submit();
		return true;
}
	dlgWidth = 900;
	dlgHeight = 900;

	dlgLeft = (screen.width - dlgWidth) / 2;
	dlgTop = (screen.height - dlgHeight) / 2;
	
	function disp_pic(pic_no, pic_type) {
		sFeatures = "dialogHeight: " + dlgHeight + "px;";
		sFeatures += "dialogWidth: " + dlgWidth + "px;";
		sFeatures += " dialogLeft: " + dlgLeft + "px;";
		sFeatures += " dialogTop: " + dlgTop + "px;";
		sFeatures += " scroll: yes;";
		sFeatures += " status: no;";
		//alert(pic_no);
		tmp = window.showModalDialog("Disp_Pic.php?pic_no="+pic_no+"&pic_type="+pic_type, " ", sFeatures);
	}
</script>

<body>
<form name="rpt_ereport" method="post" action="<?php echo $PHP_SELF; ?>">
<input type="hidden" name="actcode" value="<?php echo $actcode; ?>">
<div id="container_c">
<table width="1000" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2"><table width="1000" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <th height="40" colspan="2" class="normalfont"><strong>รายงานสถิติภาพรวมเหตุการณ์</strong></th>
        </tr>
        <?php
		if($_GET['c_code']==200) {
		  if(strlen($_GET['ccaattmm'])==4) {
		  	$_POST['province']=substr($_GET['ccaattmm'], 0,2)."000000";
			$_POST['amphoe']=substr($_GET['ccaattmm'], 0,4)."0000";
		  }
		  if(strlen($_GET['ccaattmm'])==6) {
		  	$_POST['province']=substr($_GET['ccaattmm'], 0,2)."000000";
			$_POST['amphoe']=substr($_GET['ccaattmm'], 0,4)."0000";
			$_POST['district']=substr($_GET['ccaattmm'], 0,6)."00";
		 }
		  if(strlen($_GET['ccaattmm'])==8) {
		  	$_POST['province']=substr($_GET['ccaattmm'], 0,2)."000000";
			$_POST['amphoe']=substr($_GET['ccaattmm'], 0,4)."0000";
			$_POST['district']=substr($_GET['ccaattmm'], 0,6)."00";
			$_POST['moo']=$_GET['ccaattmm'];
		  }
			
			
			$_POST['s_day']=substr($_GET['s_date'], 6, 2);
			$_POST['s_month']=substr($_GET['s_date'], 4, 2);		
			$_POST['s_year']=substr($_GET['s_date'], 0, 4);
			$_POST['e_day']=substr($_GET['e_date'], 6, 2);
			$_POST['e_month']=substr($_GET['e_date'], 4, 2);		
			$_POST['e_year']=substr($_GET['e_date'], 0, 4);
		}
		
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
      <?php /*
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
	  */ ?>
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
  	if(($_POST['actcode']==100)||($_GET['c_code']==200)) {
		
		
		
		
		$code="";
		if(($_POST['province'] != "")&&($_POST['amphoe'] == "")&&($_POST['district'] == "")&&($_POST['moo'] == "")) {
			 $code=substr($_POST['province'], 0, 2);
			 $flag_area=2;
		}
		if(($_POST['province'] != "")&&($_POST['amphoe'] != "")&&($_POST['district'] == "")&&($_POST['moo'] == "")) {
			 $code=substr($_POST['amphoe'], 0, 4); 
			 $flag_area=3;
		}
		if(($_POST['province'] != "")&&($_POST['amphoe'] != "")&&($_POST['district'] != "")&&($_POST['moo'] == "")) {
			$code=substr($_POST['district'], 0, 6);
			$flag_area=4;
		}
		if(($_POST['province'] != "")&&($_POST['amphoe'] != "")&&($_POST['district'] != "")&&($_POST['moo'] != "")) {
			$code=$_POST['moo']; 
			$flag_area=4;
		}
		
		//echo $_POST['province']."/".$_POST['amphoe']."/".$_POST['district']."/".$_POST['moo'];
		//echo $code;
		$s_date=$_POST['s_year'].$_POST['s_month'].$_POST['s_day'];
		$e_date=$_POST['e_year'].$_POST['e_month'].$_POST['e_day'];
		
		$func_sql="select * from tab_e_ccaattmm  where catm_ukey like '$code%' and catm_tdate=0 and flag_area=$flag_area";
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
     <tr bgcolor="#FF9933">
        <td width="17" ><div align="center" class="normalfont"><strong>::</strong></div></td>
        <td width="200"><div align="center" class="normalfont"><strong>สถานที่</strong></div></td>
        <td width="116"><div align="center" class="normalfont"><strong>ไฟไหม้</strong></div></td>
        <td width="100"><div align="center" class="normalfont"><strong>ชุมนุม</strong></div></td>
        <td width="110"><div align="center" class="normalfont"><strong>น้ำท่วม</strong></div></td>
        <td width="122"><div align="center" class="normalfont"><strong>ทะเลาะวิวาท</strong></div></td>
        <td width="83"><div align="center" class="normalfont"><strong>ขโมย</strong></div></td>
        <td width="56"><div align="center" class="normalfont"><strong>อื่นๆ</strong></div></td>
        <td width="30"><div align="center" class="redfont"><strong>รวม</strong></div></td>
      </tr>
      <?php
	  	$u=1;
      	$m=1;
		$count_all=0;
		while($rows=mysql_fetch_array($rid)){
			
			$ccaattmm=$rows['catm_ukey'];
			$catm_desc=$rows['catm_desc'];
			$bgcolor = ($bgcolor == "#FFFFFF") ? "#E4E4E4" : "#FFFFFF";
			
			$len=strlen($code);
			$len=$len+2;
			$ccaattmm=substr($ccaattmm, 0, $len);
			
			$count1=count_sum($s_date, $e_date, 1, $ccaattmm, $connid);
			$count2=count_sum($s_date, $e_date, 2, $ccaattmm, $connid);
			$count3=count_sum($s_date, $e_date, 3, $ccaattmm, $connid);
			$count4=count_sum($s_date, $e_date, 4, $ccaattmm, $connid);
			$count5=count_sum($s_date, $e_date, 5, $ccaattmm, $connid);
			$count99=count_sum($s_date, $e_date, 99, $ccaattmm, $connid);
			
			$count_all=$count1+$count2+$count3+$count4+$count5+$count99;
			
			$count1_all=$count1_all+$count1;
			$count2_all=$count2_all+$count2;
			$count3_all=$count3_all+$count3;
			$count4_all=$count4_all+$count4;
			$count5_all=$count5_all+$count5;
			$count99_all=$count99_all+$count99;
			
			$count_all2=$count1_all+$count2_all+$count3_all+$count4_all+$count5_all+$count99_all;
			//echo $ccaattmm."<br>";
			
	  ?>
     
      <tr class="inputfont" bgcolor="<?php echo $bgcolor; ?>" align="center">
        <td><?php echo $m; ?></td>
        <td><?php 
			if(($count1>0)||($count2>0)||($count3>0)||($count4>0)||($count5>0)||($count99>0))  {
				if(strlen($ccaattmm)==8) {
					echo"<a href='Rpt_EReport2.php?actcode=100&ccaattmm=$ccaattmm&s_date=$s_date&e_date=$e_date&r_type=1&code=$code'>$catm_desc</a>";
				}
				else {
					echo"<a href='Rpt_EReport.php?c_code=200&ccaattmm=$ccaattmm&s_date=$s_date&e_date=$e_date&r_type=1&code=$code'>$catm_desc</a>";
				}
			 } else
				echo $catm_desc; 
		?></td>
        <td><?php 
			echo $count1;
		?></td>
        <td><?php 
			echo $count2;
		?></td>
        <td><?php 
			echo $count3;
		?></td>
        <td><?php 
			echo $count4;
		?></td>
        <td><?php 
			echo $count5;
		?></td>
         <td><?php 
			echo $count99;
		?></td>
        <td class="redfont"><?php 
			echo $count_all;
		?></td>
      </tr>
      <?php
	  			$m++;
	
		
		
			
				}
		?>
	  <tr class="redfont" bgcolor="<?php echo $bgcolor; ?>" align="center">
        <td colspan="2"> รวม </td>
        <td><?php 
			echo $count1_all;
		?></td>
        <td><?php 
			echo $count2_all;
		?></td>
        <td><?php 
			echo $count3_all;
		?></td>
        <td><?php 
			echo $count4_all;
		?></td>
        <td><?php 
			echo $count5_all;
		?></td>
         <td><?php 
			echo $count99_all;
		?></td>
        <td class="redfont"><?php 
			echo $count_all2;
		?></td>
      </tr>
      <?php
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
