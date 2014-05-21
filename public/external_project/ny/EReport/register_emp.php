<?php
@session_start();
/*ini_set('display_errors',1); 
error_reporting(E_ALL);*/
//include("./FUNCTION/function.php");
$emp_id = $EMPID;
$name_emp = $EMPNAME;
$add_emp = $EMPADD;
?>
<html>
<?php 
include ("header_top.php"); 
include ("chk_session.php"); 
?>
<head><title>เพิ่มผู้เข้าใช้งานระบบ</title></head>
<LINK rel="stylesheet" href="./css/style.css" type="text/css">
<script type="text/javascript" src="./js/jquery-1.8.3.js"></script>
<script language="JavaScript" type="text/javascript">
function get_name(str)
{
	var d = new Date();
	var n = d.getTime();
	var pid = $("#pid").val();
	if(pid.length == 13)
	{
		if(isNaN(pid))
		{
			return false;
		}else{
		//alert(pid);
			$.get("./Ajax_emp/get_name.php", { pid: pid, time: n },function(data){ $("#fullname_div").html(data); });
			$.get("./Ajax_emp/check_pid.php", { pid: pid, time: n },function(data){ $("#chk_id").html(data); });
			$.get("./Ajax_emp/get_address.php", { pid: pid, time: n },function(data){ $("#address").html(data); });
		}
	}
}
function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
function get_amper(str)
{
	var d = new Date();
	var n = d.getTime();
	//var prov = $("#prov").val();
	var prov = "26000000";
	$("#show_amper").show();
	$("#show_tumbon").hide();
	$("#show_mooban").hide();
	if(prov == "")
	{
		$("#show_amper").hide();
	}
	if (str=="")
	{
		$("#get_result_amper").innerHTML="";
		return;
	}
	$.get("./Ajax_emp/get_amper.php", { prov: prov, time: n },function(data){ $("#get_result_amper").html(data); });
}
function get_tumbon(str)
{
	var d = new Date();
	var n = d.getTime();
	var prov = $("#prov").val();
	var amper = $("#amper").val();
	$("#show_tumbon").show();
	$("#show_mooban").hide();
	if(amper == "")
	{
		$("#show_tumbon").hide();
	}
	if (str=="")
	{
		$("#get_result_tumbon").innerHTML="";
		return;
	}
	$.get("./Ajax_emp/get_tumbon.php", { prov: prov,amper: amper, time: n },function(data){ $("#get_result_tumbon").html(data); });
}
function get_mooban(str)
{
	var d = new Date();
	var n = d.getTime();
	var prov = $("#prov").val();
	var amper = $("#amper").val();
	var tumbon = $("#tumbon").val();
	$("#show_mooban").show();
	if(tumbon == "")
	{
		$("#show_mooban").hide();
	}
	if (str=="")
	{
		$("#get_result_mooban").innerHTML="";
		return;
	}
	$.get("./Ajax_emp/get_mooban.php", { prov: prov,amper: amper,tumbon: tumbon, time: n },function(data){ $("#get_result_mooban").html(data); });
}
function Valid(form)
{
	var pid = $("#pid").val();
	var prov = $("#prov").val();
	var amper = $("#amper").val();
	var tumbon = $("#tumbon").val();
	var mooban = $("#mooban").val();
	var full_name = $("#fullname").val();
	//alert(full_name);
	if(pid == '')
	{
		alert("กรุณาระบุเลขรหัสประจำตัวประชาชน");
	}else if(pid.length != 13)
	{
		alert("กรุณาระบุเลขรหัสประจำตัวประชาชนให้ครบ 13 หลัก");
	}else if(full_name == "ไม่พบชื่อของรหัสประจำตัวประชาชนนี้")
	{
		alert("ไม่พบชื่อของรหัสประจำตัวประชาชนนี้"); 
	/*}else if(prov == ''){
		alert("กรุณาเลือกจังหวัด");
	}else if(amper == ''){
		alert("กรุณาเลือกอำเภอ");
	}else if(tumbon == ''){
		alert("กรุณาเลือกตำบล");
	}else if(mooban == ''){
		alert("กรุณาเลือกหมู่บ้าน");*/
	}else{
		$("#sendpress").val('insert');
		$("form").submit();
	}
}
</script>
<body onload="get_amper(this.value)">
<?php
include("header_body.php");
/*if($emp_id != "3260100123174")
{
	showmsg("ท่านไม่มีสิทธิในการเข้าใช้งานส่วนนี้");
	//echo "<script language='javascript'>history.go(-1);</script>";
	?>
	<script type="text/javascript">
	var Browser = {
	Version: function() {
	var version = 999; // we assume a sane browser
	if (navigator.appVersion.indexOf("MSIE") != -1)
	// bah, IE again, lets downgrade version number
	version = parseFloat(navigator.appVersion.split("MSIE")[1]);
	return version;
	}
	}
	</script>

	<script type="text/javascript">
	if (Browser.Version() < 7) {
	window.opener = null;
	window.close();
	}else if (Browser.Version() >= 7){
	window.open('','_parent','');
	window.close();
	}else{
	window.open('', '_self', '');
	window.close();
	}
	</script>
<?php
}*/
if(isset($_POST['sendpress']))
{
	$sendpress = $_POST['sendpress'];
}else{
	$sendpress = "";
}
if($sendpress == "insert")
{
	$pid = $_POST['pid'];
	//$fullname = $_POST['fullname_get'];
	$prov = $_POST['prov'];
	$amper = $_POST['amper'];
	$tumbon = $_POST['tumbon'];
	$mooban = $_POST['mooban'];
	$p_level = $_POST['p_level'];
	$txt_post = $_POST['txt_post'];
	$txt_add = $_POST['txt_add'];
	$txt_tel = $_POST['txt_tel'];
	$txt_email = $_POST['txt_email'];
	$txt_add = str_replace("'", "\'", $txt_add);
	$txt_post = str_replace("'", "\'", $txt_post);
	$txt_tel = str_replace("'", "\'", $txt_tel);
	$txt_email = str_replace("'", "\'", $txt_email);
	$upd_date = get_upd_date();
	if($amper = "")
	{
		$work_place = $prov;
	}else if($tumbon == "") {
		$work_place = $amper;
	}else if($mooban == "") {
		$work_place = $tumbon;
	}else{
		$work_place = $mooban;
	}
	//================ INSERT ==============
	if($pid == "")
	{
		showmsg("เกิดข้อผิดพลาด!! ไม่พบชื่อผู้ที่จะทำการบันทึก");
		$sendpress = "error";
	}else{
		$sql_insert = "insert into tab_e_regis values ('$pid' , '$work_place' , '$p_level' , '$txt_post' , '$txt_add' , '$txt_tel' , '$txt_email' , '$upd_date' , '0' ,'$upd_date' , '$emp_id') ";
		$query = mysql_query($sql_insert);
		//echo "sql insert = $sql_insert<br>";
		//exit();
		if(!($query))
		{
			showmsg("เกิดข้อผิดพลาด!! ไม่สามารถบันทึกผู้ใช้งานระบบได้");
			$sendpress = "error";
		}else{
			showmsg("บันทึกผู้ใช้งานระบบเรียบร้อยแล้ว");
						
			$fileupload = $_FILES['uploadfile']['tmp_name'];
			$fileupload_name = $_FILES['uploadfile']['name'];
			$fileupload_size = $_FILES['uploadfile']['size'];
			$fileupload_type = $_FILES['uploadfile']['type'];
			
			//----อัพรูปสมาชิก-----
			$array_last = explode(".",$fileupload);
			$c = count ($array_last) - 1;
			$lastname = strtolower($array_last[$c]);
			if ($fileupload)
			{
				$array_last = explode(".",$fileupload_name);
				$c = count ($array_last) - 1;
				$limitfile=100000; //กำหนด ขนาด file ที่อนุญาติให้โหลดเข้ามาเก็บได้ (ต่อ 1 file) หน่วยเป็น byte
				$lastname = strtolower($array_last[$c]);
				if ($lastname == "gif" or $lastname == "jpg" or $lastname == "jpeg")
				{
					$photoname_no = $fileupload_name.".".$lastname;
					$photoname = $pid.".".$lastname;
					//------------------------------------------------รูปหลอก
					copy($fileupload,"./IMAGE_EMP/".$photoname_no);
					if ($lastname == "jpg" or $lastname == "jpeg")
					{
						$por_img = imagecreatefromjpeg($fileupload);
						$ori_img = imagecreatefromjpeg($fileupload);
					}else if ($lastname == "gif")
					{
						$por_img = imagecreatefromgif($fileupload);
						$ori_img = imagecreatefromgif($fileupload);
					}
					//---------------------------------------------------รูปจริง
					$ori_size = getimagesize($fileupload);
					$ori_w = $ori_size[0];
					$ori_h = $ori_size[1];
					if  ($ori_w > 100)
					{
						$new_w = 100;
						$new_h = round(($new_w/$ori_w) * $ori_h);
						$new_img = imagecreatetruecolor($new_w,$new_h);
						imagecopyresized($new_img,$ori_img,0,0,0,0,$new_w,$new_h,$ori_w,$ori_h);
						if ($lastname == "jpg" or $lastname == "jpeg")
						{
							imagejpeg($new_img,"./IMAGE_EMP/".$photoname);
						}else if ($lastname == "gif")
						{
							imagegif($new_img,"./IMAGE_EMP/".$photoname);
						}
						imagedestroy($ori_img);
						imagedestroy($new_img);
					}else{
						copy($fileupload,"./IMAGE_EMP/".$photoname);
						showmsg("upload รูปภาพเรียบร้อยแล้ว");
					}
				}
				unlink ("./IMAGE_EMP/$photoname_no");
				unlink($fileupload);
			}
			//echo "<META HTTP-EQUIV=Refresh CONTENT=0;URL=\"index.php\">";
			echo "<META HTTP-EQUIV=Refresh CONTENT=0;URL=\"menu.php\">";
		}
	}
	//----จบอัพรูปสมาชิก---
	/*if(move_uploaded_file($_FILES["uploadfile"]["tmp_name"],"IMAGE_EMP/".$_FILES["uploadfile"]["name"]))
	{
		echo "Copy/Upload Complete";
	}*/
}
?>
<div id="container">
<form method="post" enctype="multipart/form-data" action="<?php echo $PHP_SELF; ?>">
<input type="hidden" name="sendpress" id="sendpress" value="start">.
<?php if(check_use($EMPID)) {?>
<TABLE width="1000" border="0" cellpadding="0" cellspacing="2" align="center">
<TR height="30">
	<th align="left" valign="middle" id="fontwhite">&nbsp;&nbsp;&nbsp;&nbsp;เพิ่มผู้เข้าใช้งานระบบ</th>
</TR>
<TR>
	<TD>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
		<tr height="50">
			<td width="100%" colspan="2" align="center" valign="middle">รายละเอียดผู้ที่กำลังสมัครเข้าใช้งาน</td>
		</tr>
		<tr height="30">
			<td width="20%" align="right" valign="middle">เลขรหัสประจำตัวประชาชน&nbsp;&nbsp;:&nbsp;&nbsp;</td>
			<td width="80%" colspan="2" align="left" valign="middle"><input type="text" name="pid" id="pid" size="13" maxlength="13" onkeyup="get_name(this.value)" onkeypress="return isNumberKey(event)"></td>
		</tr>
		<tr height="30">
			<td width="20%" align="right" valign="middle">ชื่อ - นามสกุล&nbsp;&nbsp;:&nbsp;&nbsp;</td>
			<td width="30%" align="left" valign="middle">
			<!--<input type="text" name="fullname" id="fullname" style="width: 300px; padding: 2px" disabled="disabled">-->
			<div id="fullname_div" class="title">
			</td>
			<td width="50%" align="left" valign="middle"><div id="chk_id" class="title"></div></td>
		</tr>
		<tr height="30">
			<td width="20%" align="right" valign="middle">ที่อยู่ตามทะเบียนบ้าน&nbsp;&nbsp;:&nbsp;&nbsp;</td>
			<td width="80%" colspan="2" align="left" valign="middle">
			<!--<textarea name="address" id="address" cols="80" rows="2" maxlength="250" disabled='disabled'></textarea>-->
			<div id="address" class="title"></div>
			</td>
		</tr>
		<!--<tr height="15">
			<td width="100%" colspan="2" align="center" valign="middle">&nbsp;</td>
		</tr>-->
		</table>
	</TD>
</TR> 
<TR height="30">
	<th align="left" valign="middle" id="fontwhite">&nbsp;&nbsp;&nbsp;&nbsp;สถานที่ปฏิบัติงาน</th>
</TR>
<TR>
	<TD>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
		<tr height="30">
			<td width="20%" align="right" valign="middle">จังหวัด&nbsp;&nbsp;:&nbsp;&nbsp;</td>
			<td width="80%" align="left" valign="middle">
				<select name="prov" id="prov" size="1" onchange="get_amper(this.value)"><?php get_prov($prov,1); ?></select>
				<?php //get_prov($prov); ?>
			</td>
		</tr>
		<tr height="30" id="show_amper" style="display:block">
			<td width="20%" align="right" valign="middle">อำเภอ&nbsp;&nbsp;:&nbsp;&nbsp;</td>
			<td width="80%" align="left" valign="middle"><div id="get_result_amper"></div></td>
		</tr>
		<tr height="30" id="show_tumbon" style="display:none">
			<td width="20%" align="right" valign="middle">ตำบล&nbsp;&nbsp;:&nbsp;&nbsp;</td>
			<td width="80%" align="left" valign="middle"><div id="get_result_tumbon"></div></td>
		</tr>
		<tr height="30" id="show_mooban" style="display:none">
			<td width="20%" align="right" valign="middle">หมู่บ้าน&nbsp;&nbsp;:&nbsp;&nbsp;</td>
			<td width="80%" align="left" valign="middle"><div id="get_result_mooban"></div></td>
		</tr>
		<tr height="30">
			<td width="20%" align="right" valign="middle">ตำแหน่ง&nbsp;&nbsp;:&nbsp;&nbsp;</td>
			<td width="80%" align="left" valign="middle"><select name="p_level" id="p_level" size="1"><?php get_level($p_level); ?></select></td>
		</tr>
		<tr height="30">
			<td width="20%" align="right" valign="middle">ชื่อตำแหน่งเป็นทางการ&nbsp;&nbsp;:&nbsp;&nbsp;</td>
			<td width="80%" align="left" valign="middle"><input type="text" name="txt_post" id="txt_post" maxlength="80" style="width: 400px; padding: 2px"></td>
		</tr>
		<tr height="30">
			<td width="20%" align="right" valign="middle">ที่อยู่ติดต่อได้&nbsp;&nbsp;:&nbsp;&nbsp;</td>
			<td width="80%" align="left" valign="middle"><textarea name="txt_add" id="txt_add" cols="80" rows="3" maxlength="250"></textarea></td>
		</tr>
		<tr height="30">
			<td width="20%" align="right" valign="middle">เบอร์โทรศัพท์&nbsp;&nbsp;:&nbsp;&nbsp;</td>
			<td width="80%" align="left" valign="middle"><input type="text" name="txt_tel" id="txt_tel" style="width: 200px; padding: 2px"></td>
		</tr>
		<tr height="30">
			<td width="20%" align="right" valign="middle">อีเมล์&nbsp;&nbsp;:&nbsp;&nbsp;</td>
			<td width="80%" align="left" valign="middle"><input type="text" name="txt_email" id="txt_email" style="width: 300px; padding: 2px"></td>
		</tr>
		<tr height="30">
			<td width="20%" align="right" valign="middle">รูปถ่ายแสดงตัวตน&nbsp;&nbsp;:&nbsp;&nbsp;</td>
			<td width="80%" align="left" valign="middle"><input type='file' name='uploadfile' id="uploadfile" style="width: 400px; padding: 2px"></td>
		</tr>
		<tr><td width="100%" colspan="2">&nbsp;</td></tr>
		<tr><td width="100%" colspan="2" align="center" valign="middle"><input type="button" value=" บันทึกข้อมูล " onclick="Valid(this.value)"></td></tr>
		</table>
	</TD>
</TR> 
</TABLE>
<?php }else{?>
<table width="1000" align="center" border=0 >
<tr valign="middle">
<th colspan="2" align="center" >แก้ไขผู้เข้าใช้งานระบบ</th>
</tr>
<tr height="50px">
<td colspan="2" align="center" >ท่านไม่มีสิทธิใช้งานในระบบนี้ </td>
</tr>
</table>
<?php } ?>
</form>
</div>
</body>
</html>