<?php
//include ("../FUNCTION/con_db.ini");
$tumbon_uncut = $_GET['tumbon'];
$tumbon = substr($tumbon_uncut,0,6);
echo "<select name='mooban' id='mooban' size='1'>";
echo "<option value='' >-- เลือกหมู่บ้าน --</option>";
echo "<option value='26011201' >บ้านวังตูม</option>";
/*$sql = "select * from tab_e_ccaattmm where flag_area = '4' and catm_ukey like '$tumbon%'  and catm_tdate = '0'  order by catm_desc ";
$query = mysql_query($sql);
$num_rows = mysql_num_rows($query);
$i = 0;
while($i < $num_rows)
{
	$row = mysql_fetch_array($query);
	$catm_ukey = $row[catm_ukey];
	$catm_desc = $row[catm_desc];
	$catm_edesc = $row[catm_edesc];
	echo "<option value='$catm_ukey'>$catm_ukey : $catm_desc</option>";
	$i++;
}*/
echo "</select>";
?>