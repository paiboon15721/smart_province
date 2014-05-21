<?php
//include ("../FUNCTION/con_db.ini");
$prov_uncut = $_GET['prov'];
$prov = substr($prov_uncut,0,2);
echo "<select name='amper' id='amper' size='1' onchange='get_tumbon(this.value)'>";
echo "<option value='' >-- เลือกอำเภอ --</option>";
echo "<option value='26010000' >เมืองนครนายก</option>";
/*$sql = "select * from tab_e_ccaattmm where flag_area = '2' and catm_ukey like '$prov%' and catm_tdate = '0'  order by catm_desc ";
$query = mysql_query($sql);
$num_rows = mysql_num_rows($query);
$i = 0;
while($i < $num_rows)
{
	$row = mysql_fetch_array($query);
	$catm_ukey = $row[catm_ukey];
	$catm_desc = $row[catm_desc];
	$catm_edesc = $row[catm_edesc];
	echo "<option value='$catm_ukey'>$catm_ukey: $catm_desc</option>";
	$i++;
}*/
echo "</select>";
?>