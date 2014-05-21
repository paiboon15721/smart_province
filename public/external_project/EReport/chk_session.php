<?php
session_start();
include ("./FUNCTION/con_db.ini");
$emp_id = $_SESSION['EMPID'];
$catm_meun_chk = $_SESSION['catm_menu'];
$catm_prov = substr($catm_meun_chk,0,2);
$catm_amp = substr($catm_meun_chk,2,2);
$catm_tum = substr($catm_meun_chk,4,2);
$catm_mb = substr($catm_meun_chk,6,2);
//========== ตัวแปร ccaattmm ไว้เช็คเมนู
$catm_prov_chk = $catm_prov;
$catm_amp_chk = $catm_prov.$catm_amp;
$catm_tum_chk = $catm_prov.$catm_amp.$catm_tum;
if($_SESSION['fact'] <> "4")
{
	$sql_find = "select ccaattmm from tab_e_regis where pid = '$emp_id' ";
	//echo "sql_find = $sql_find";
	$query_find = mysql_query($sql_find);
	if(!empty($query_find))
	{
		$row = mysql_fetch_array($query_find);
		$ccaattmm = $row['ccaattmm'];
		//========= ตัวแปร ccaattmm ของผู้เข้าใช้งาน
		$ccaattmm_prov = substr($ccaattmm,0,2);
		$ccaattmm_amp = substr($ccaattmm,2,2);
		$ccaattmm_tum = substr($ccaattmm,4,2);
		$ccaattmm_mb = substr($ccaattmm,6,2);
		//=============
		if(($ccaattmm_mb=="00") && ($ccaattmm_tum=="00") && ($ccaattmm_amp=="00"))
		{
			$ccaattmm_chk = $ccaattmm_prov;
			$num_chk = 2;
		}else if(($ccaattmm_mb=="00") && ($ccaattmm_tum=="00")) {
			$ccaattmm_chk = $ccaattmm_prov.$ccaattmm_amp;
			$num_chk = 4;
		}else if($ccaattmm_mb == "00") {
			$ccaattmm_chk = $ccaattmm_prov.$ccaattmm_amp.$ccaattmm_tum;
			$num_chk = 6;
		}else{
			$ccaattmm_chk = $ccaattmm;
			$num_chk = 8;
		}
		//echo "ccaattmm_chk = $ccaattmm_chk|$num_chk";
		//echo "sql_find = ".$_SESSION['catm_menu'];
		if(($num_chk==8) && ($ccaattmm_chk != $catm_meun_chk))
		{
			?>
			<script>
			alert('ท่านไม่มีสิทธิใช้งานหมู่บ้านนี้');
			window.open("", "_parent");
			setTimeout(function(){window.close();}, 100);
			</script>
			<?php
			exit();
		}else if(($num_chk==6) && ($ccaattmm_chk != $catm_tum_chk))
		{
			?>
			<script>
			alert('ท่านไม่มีสิทธิใช้งานตำบลนี้');
			window.open("", "_parent");
			setTimeout(function(){window.close();}, 100);
			</script>
			<?php
			exit();
		}else if(($num_chk==4) && ($ccaattmm_chk != $catm_amp_chk))
		{
			?>
			<script>
			alert('ท่านไม่มีสิทธิใช้งานอำเภอนี้');
			window.open("", "_parent");
			setTimeout(function(){window.close();}, 100);
			</script>
			<?php
			exit();
		}else if(($num_chk==2) && ($ccaattmm_chk != $catm_prov_chk))
		{
			?>
			<script>
			alert('ท่านไม่มีสิทธิใช้งานจังหวัดนี้');
			window.open("", "_parent");
			setTimeout(function(){window.close();}, 100);
			</script>
			<?php
			exit();
		}else{
			?>
			<script>
			//alert('<?php echo $emp_id; ?>');
			//alert('<?php echo $catm_meun_chk; ?>');
			</script>
			<?php
		}
	}
}
?>
