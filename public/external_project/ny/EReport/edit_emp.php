<?php
/*ini_set('display_errors',1); 
error_reporting(E_ALL);*/
include("./chk_session.php");
?>
<html>
<head>
<?php include ("header_top.php"); ?>
<title>เพิ่มผู้เข้าใช้งานระบบ</title></head>
<LINK rel="stylesheet" href="./css/style.css" type="text/css">
<script type="text/javascript" src="./js/jquery-1.8.3.js"></script>
<script language="JavaScript" type="text/javascript">
function chang_catm()
{
	$("#show_ccaattmm").hide();
	$("#show_prov").show();
	$("#edit_catm").val('y');
}
function cancel_chang_catm()
{
	$("#show_ccaattmm").show();
	$("#show_prov").hide();
	$("#show_amper").hide();
	$("#show_tumbon").hide();
	$("#show_mooban").hide();
	$("#edit_catm").val('n');
}
function get_amper(str)
{
	var d = new Date();
	var n = d.getTime();
	var prov = $("#prov").val();
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
	var prov = $("#prov").val();
	var amper = $("#amper").val();
	var tumbon = $("#tumbon").val();
	var mooban = $("#mooban").val();
	var edit_catm = $("#edit_catm").val();
	if(edit_catm == 'y')
	{
		if(prov == '')
		{
			alert("กรุณาเลือกจังหวัด");
		}else if(amper == ''){
			alert("กรุณาเลือกอำเภอ");
		}else if(tumbon == ''){
			alert("กรุณาเลือกตำบล");
		}else if(mooban == ''){
			alert("กรุณาเลือกหมู่บ้าน");
		}else{
			$("#sendpress").val('update');
			$("form").submit();
		}
	}else{
		$("#sendpress").val('update');
		$("form").submit();
	}
}
</script>
<body>
<?php
include("header_body.php");
$upd_date = get_upd_date();
if(isset($_POST['sendpress']))
{
	$sendpress = $_POST['sendpress'];
}else{
	$sendpress = "";
}
if(isset($_POST['edit_catm']))
{
	$edit_catm = $_POST['edit_catm'];
}else{
	$edit_catm = "";
}
$sql_find = "select * from tab_e_regis where pid = '$EMPID' ";
$query = mysql_query($sql_find);
if(!($query))
{
	showmsg("ไม่พบข้อมูลในฐานข้อมูล");
}else{
	$row = mysql_fetch_array($query);
	$pid_base = $row['pid'];
	$ccaattmm_base = $row['ccaattmm'];
	$p_level_base = $row['p_level'];
	$post_base = $row['post'];
	$address_base = $row['address'];
	$tel_base = $row['tel'];
	$email_base = $row['email'];
	$prov_sel = substr($ccaattmm_base,0,3)."00000";
	$amper_sel = substr($ccaattmm_base,0,5)."000";
	$tumbon_sel = substr($ccaattmm_base,0,7)."0";
	$prov_name = get_name_ccaattmm($prov_sel);
	$amper_name = get_name_ccaattmm($amper_sel);
	$tumbon_name = get_name_ccaattmm($tumbon_sel);
	$mooban_name = get_name_ccaattmm($ccaattmm_base);
	foreach (glob("./IMAGE_EMP/$pid_base.*") as $type_file)
	{
		$pic = $type_file;
		//echo "PIC = $pic<br>";
	}
	if(!isset($pic))
	{
		$pic = "./IMAGE_EMP/nopic.jpg";
	}
}
if($sendpress == "update")
{
	$mooban = $_POST['mooban'];
	$p_level = $_POST['p_level'];
	$txt_post = $_POST['txt_post'];
	$txt_add = $_POST['txt_add'];
	$txt_tel = $_POST['txt_tel'];
	$txt_email = $_POST['txt_email'];
	$upd_date = get_upd_date();
	$txt_add = str_replace("'", "\'", $txt_add);
	$txt_post = str_replace("'", "\'", $txt_post);
	$txt_tel = str_replace("'", "\'", $txt_tel);
	$txt_email = str_replace("'", "\'", $txt_email);
	//================ UPDATE ==============
	$sql_update = "update tab_e_regis set p_level='$p_level' , post='$txt_post' , address='$txt_add' , tel='$txt_tel' , email='$txt_email' ,upd_date='$upd_date' , upd_emp='$EMPID'  ";
	if($edit_catm == 'y')
	{
		$sql_update = $sql_update." ,ccaattmm='$mooban' ";
	}
	$sql_update = $sql_update." where pid='$EMPID' ";
	$query = mysql_query($sql_update);
	if(!($query))
	{
		showmsg("เกิดข้อมผิดพลาด!! ไม่สามารถปรับปรุงผู้ใช้งานระบบได้");
		$sendpress = "error";
	}else{
		showmsg("ปรับปรุงผู้ใช้งานระบบเรียบร้อยแล้ว");
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
				$photoname = $EMPID.".".$lastname;
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
				$file_dele = $EMPID."*";
				unlink ("./IMAGE_EMP/$file_dele");
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
		echo "<META HTTP-EQUIV=Refresh CONTENT=0;URL=\"menu.php\">";
	}
	//----จบอัพรูปสมาชิก---
	/*if(move_uploaded_file($_FILES["uploadfile"]["tmp_name"],"IMAGE_EMP/".$_FILES["uploadfile"]["name"]))
	{
		echo "Copy/Upload Complete";
	}*/
}
?>
<form name="form" method="post" enctype="multipart/form-data" action="<?php echo $PHP_SELF; ?>">
<input type="hidden" name="sendpress" id="sendpress" value="start">
<input type="hidden" name="edit_catm" id="edit_catm" value="n">
<div id="container">
 <?php if(check_use($EMPID)) {?>
<TABLE width="1000" border="0" cellpadding="0" cellspacing="2" align="center">
<TR height="30">
	<th align="left" valign="middle" id="fontwhite">&nbsp;&nbsp;&nbsp;&nbsp;แก้ไขผู้เข้าใช้งานระบบ</th>
</TR>
<TR>
	<TD>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
		<tr height="50">
			<td width="100%" colspan="3" align="center" valign="middle">รายละเอียดผู้ที่กำลังสมัครเข้าใช้งาน</td>
		</tr>
		<tr height="30">
			<td width="20%" align="right" valign="middle">เลขรหัสประจำตัวประชาชน&nbsp;&nbsp;:&nbsp;&nbsp;</td>
			<td width="40%" align="left" valign="middle"><?php echo $EMPID; ?></td>
			<td width="40%" align="left" valign="middle" rowspan="3"><img src="<?php echo $pic; ?>" /></td>
		</tr>
		<tr height="30">
			<td width="20%" align="right" valign="middle">ชื่อ - นามสกุล&nbsp;&nbsp;:&nbsp;&nbsp;</td>
			<td width="40%" align="left" valign="middle"><?php echo $EMPNAME; ?></td>
		</tr>
		<tr height="30">
			<td width="20%" align="right" valign="middle">ที่อยู่ตามทะเบียนบ้าน&nbsp;&nbsp;:&nbsp;&nbsp;</td>
			<td width="40%" align="left" valign="middle">
			<?php 
			$address_show = str_replace("|","/",$EMPADD);
			echo $address_show; 
			?></td>
		</tr>
		</table>
	</TD>
</TR> 
<TR height="30">
	<th align="left" valign="middle" id="fontwhite">&nbsp;&nbsp;&nbsp;&nbsp;สถานที่ปฏิบัติงาน</th>
</TR>
<TR>
	<TD>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
		<tr height="30" id="show_ccaattmm">
			<td width="20%" align="right" valign="middle">สถานที่ทำงาน&nbsp;&nbsp;:&nbsp;&nbsp;</td>
			<td width="80%" align="left" valign="middle"><?php echo "จังหวัด&nbsp;".$prov_name."&nbsp;&nbsp;&nbsp;อำเภอ&nbsp;".$amper_name."&nbsp;&nbsp;&nbsp;ตำบล&nbsp;".$tumbon_name."&nbsp;&nbsp;&nbsp;หมู่บ้าน&nbsp;".$mooban_name; ?>
			<input type="button" name="btn_edit" id="btn_edit" value=" แก้ไข " onclick="chang_catm(this.value)"></td>
		</tr>
		<tr height="30" id="show_prov" style="display:none">
			<td width="20%" align="right" valign="middle">จังหวัด&nbsp;&nbsp;:&nbsp;&nbsp;</td>
			<td width="80%" align="left" valign="middle">
				<select name="prov" id="prov" size="1" onchange="get_amper(this.value)"><?php get_prov(); ?></select>
				&nbsp;&nbsp;<input type="button" name="btn_no_edit" id="btn_no_edit" value=" ยกเลิกการแก้ไข " onclick="cancel_chang_catm(this.value)"></td>
			</td>
		</tr>
		<tr height="30" id="show_amper" style="display:none">
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
			<td width="80%" align="left" valign="middle"><select name="p_level" id="p_level" size="1"><?php get_level($p_level_base); ?></select></td>
		</tr>
		<tr height="30">
			<td width="20%" align="right" valign="middle">ชื่อตำแหน่งเป็นทางการ&nbsp;&nbsp;:&nbsp;&nbsp;</td>
			<td width="80%" align="left" valign="middle"><input type="text" name="txt_post" id="txt_post" maxlength="80" style="width: 400px; padding: 2px" value="<?php echo $post_base; ?>"></td>
		</tr>
		<tr height="30">
			<td width="20%" align="right" valign="middle">ที่อยู่ติดต่อได้&nbsp;&nbsp;:&nbsp;&nbsp;</td>
			<td width="80%" align="left" valign="middle"><textarea name="txt_add" id="txt_add" cols="80" rows="3" maxlength="250" >
			<?php 
			echo $address_base; 
			?>
			</textarea></td>
		</tr>
		<tr height="30">
			<td width="20%" align="right" valign="middle">เบอร์โทรศัพท์&nbsp;&nbsp;:&nbsp;&nbsp;</td>
			<td width="80%" align="left" valign="middle"><input type="text" name="txt_tel" id="txt_tel" style="width: 200px; padding: 2px" value="<?php echo $tel_base; ?>"></td>
		</tr>
		<tr height="30">
			<td width="20%" align="right" valign="middle">อีเมล์&nbsp;&nbsp;:&nbsp;&nbsp;</td>
			<td width="80%" align="left" valign="middle"><input type="text" name="txt_email" id="txt_email" style="width: 300px; padding: 2px" value="<?php echo $email_base; ?>"></td>
		</tr>
		<tr height="30">
			<td width="20%" align="right" valign="middle">รูปถ่ายแสดงตัวตน&nbsp;&nbsp;:&nbsp;&nbsp;</td>
			<td width="80%" align="left" valign="middle">
			<div id="file_upload"><input type='file' name='uploadfile' id="uploadfile" style="width: 400px; padding: 2px"></div></td>
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

</div>
</form>
</body>
</html>