<?php
include ("../FUNCTION/con_db.ini");
$tumbon_uncut = $_GET['tumbon'];
$tumbon = substr($tumbon_uncut,0,6);
echo "<select name='mooban' id='mooban' size='1'>";
echo "<option value='' >-- เลือกหมู่บ้าน --</option>";
if($tumbon == 260112)
{
	echo "<option value='26011201' >บ้านวังตูม</option>";
}else if($tumbon == 260205)
{
	echo "<option value='26020501' >บ้านเกาะกา</option>";
}else if($tumbon == 260304)
{
	echo "<option value='26030401' >บ้านเจ๊ก</option>";
}else if($tumbon == 260409)
{
	echo "<option value='26040905' >บ้านเกาะวัด</option>";
}else{
	echo "<option value='' ></option>";
}
//echo "<option value='26011201' >บ้านวังตูม</option>";
/*
$sql = "select * from e_report.tab_e_ccaattmm where flag_area = '4' and catm_ukey like '$tumbon%'  and catm_tdate = '0'  order by catm_desc ";
$query = mysql_query($sql);
$num_rows = mysql_num_rows($query);
$i = 0;
while($i < $num_rows)
{
	$row = mysql_fetch_array($query);
	$catm_ukey = $row['catm_ukey'];
	$catm_desc = $row['catm_desc'];
	$catm_edesc = $row['catm_edesc'];
	echo "<option value='$catm_ukey'>$catm_desc</option>";
	$i++;
}*/
echo "</select>";
?>