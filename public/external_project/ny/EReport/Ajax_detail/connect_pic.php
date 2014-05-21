<?php
include ("../FUNCTION/function.php");
$choice= $_GET["choice"];
	$r_no = $_GET["r_no"];
	$pid = $_GET["pid"];
	$date_s = $_GET["date_s"];
	$time_s = $_GET["time_s"];
if($choice=="show_pic"){ ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//echo "<table  width='900' align='center' border='1' style='font-size:85%'><thead><tr height='15'><th  align='center' ><p>::<p></th><th  align='center'><p>วันที่เริ่มพบเหตุการณ์(เวลา)<p></th><th  align='center'><p>ประเภทของเหตุการณ์<p></th><th  align='center'><p>รายละเอียดของเหตุการณ์<p></th><th  align='center'><p>สถานะของเหตุการณ์<p></th><th  align='center'><p> :: <p></th></tr></thead><tbody>";
	?><table id="mytbl" width="500px" cellspacing="1" cellpadding="1"  border="0"><tbody><?php
	$pic_no = "$r_no$date_s$time_s";
	$sql = "select * from tab_e_pic where pic_no='$pic_no'";
	$query = mysql_query($sql);
	if ($query) {
		if (mysql_num_rows($query) == 0){$rows = false;}else{$rows =  true;}
		if ($rows === true){ //พบรายการ
			$i = 1;
			while($row = mysql_fetch_array($query)){
			   $pic_seq = $row['pic_seq'];
			   $pic_seq = str_pad($pic_seq, 3, '0', STR_PAD_LEFT);
				$pic_type = $row['pic_type'];
				$pic_detail = $row['pic_detail'];
				// $exts = array('png', 'gif', 'jpg', 'jpeg');
				// $file = '../IMAGE_DETAIL/$pic_no$pic_seq';
				// $pic_filetype = '';
				// foreach ($exts as $ext) {if (file_exists("$file.$ext")) {$pic_filetype = "$file.$ext";break;}}
				foreach (glob("../IMAGE_DETAIL/$pic_no$pic_seq.*") as $type_file){$pic_filetype = $type_file;}
				$extension = end(explode(".", $pic_filetype));
				$size = getimagesize($pic_filetype);
				$pic_filetype = str_replace("..",".",$pic_filetype);
				?>
				<?php if($extension=='jpg' or $extension=='png' or $extension=='jpeg' or $extension=='gif') {?>
				<tr><td align="middle" width="100px"><a  target='_blank' href='<?php echo  "$pic_filetype"?>' ><img src='<?php echo  "$pic_filetype"?>' <?php echo imageSize($size); ?>  border='0' /></a></td>
				<?php }else{?>
				<tr><td align="middle"><a  target='_blank' href='<?php echo  "$pic_filetype"?>' ><img  id='im' src='./images/doc.jpg' alt='' width='70px' height='70px' border='0' ></img></a></td>
				<?php }?>
				<td align="left"><select id="pic_type" name="pic_type" ><option value="1" <?php if($pic_type==1){echo "selected";}?>>รูปเหตุการณ์</option><option value="2" <?php if($pic_type==2){echo "selected";}?>>เอกสาร</option></select><br><textarea id="pic_detail" maxlength="100" cols="35" rows="4" ><?php echo "$pic_detail";?></textarea></td>
				<td align="middle"><img class="imgclick" src="./images/delete.gif" alt ="ลบข้อมูล" style="cursor:pointer;cursor:hand;" onClick="javascript:doRemoveItem(this);"/></td></tr><?php
				$i++;
			}
		}else{ $r_no_new = true;} //ไม่พบรายการ
	}
	?></tbody></table ><?php
}elseif($choice=="save_pic"){ ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$time_s = $time_s."00";
	$upd_date =  get_upd_date();
	$pic_info = $_GET["pic_info"];
	$querymsg = "$pic_info|";
	$pic_info_arr = explode("|", $pic_info);
	$pic_count = $pic_info_arr[0];
	$pic_no = "$r_no$date_s$time_s";
	$sql = "delete from tab_e_pic where pic_no='$pic_no' ";
	$query = mysql_query($sql);
	for($i=0;$i<$pic_count;$i++){
		$tot = 4;
		$pic_pic = $pic_info_arr[($i*$tot)+1];
		$pic_surname = end(explode(".", $pic_pic));
		$pic_seq = str_pad($pic_info_arr[($i*$tot)+2], 3, '0', STR_PAD_LEFT);
		$pic_type = $pic_info_arr[($i*$tot)+3];
		$pic_detail = $pic_info_arr[($i*$tot)+4];
		$sql = "insert into tab_e_pic values ('$pic_no','$pic_seq' , '$pic_type' , '$pic_detail' ,'$upd_date' , '$pid') ";
		$remsg1="จัดเก็บข้อมูลเหตุการณ์เรียบร้อย";
		$remsg2="ไม่สามารถจัดเก็บข้อมูลได้";
		$query = mysql_query($sql);
		$source = "../IMAGE_DETAIL/temp/$pic_pic";
		$dest = "../IMAGE_DETAIL/$pic_no$pic_seq.$pic_surname";
		$querymsg = $querymsg."$source  to $dest|";
		if (copy($source,$dest)) { 
		   $remsg_pic = "";
		   foreach (glob("../IMAGE_DETAIL/$pic_no$pic_seq.*") as $type_file)
		   {if($type_file!=$dest){ unlink($type_file);}}
		   unlink($source);
		} else {
			$remsg_pic = " (เกิดข้อผิดพลาดในการจัดเก็บไฟล์ที่แนบมา กรุณาลองใหม่อีกครั้ง)";
		}
	}
		if ($query) {
			echo "1|$remsg_pic";
		}else{
			echo "0|$remsg2$remsg_pic";
		}
		echo $querymsg;
}
function imageSize($size) {
	$width = $size[0];
	$height = $size[1];
	if($width > 100 or $height > 100){$width = '100';$height = '100';}
	return 'style="width:' . $width . 'px;height:' . $height . 'px;"';
}