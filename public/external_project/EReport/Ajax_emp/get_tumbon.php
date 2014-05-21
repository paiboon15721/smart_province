<?php
include ("../FUNCTION/con_db.ini");
$amper_uncut = $_GET['amper'];
$amper = substr($amper_uncut,0,4);
echo "<select name='tumbon' id='tumbon' size='1' onchange='get_mooban(this.value)'>";
echo "<option value='' >-- เลือกตำบล --</option>";
if($amper == 2601)
{
	echo "<option value='26011200' >เขาพระ</option>";
}else if($amper == 2602)
{
	echo "<option value='26020500' >ท่าเรือ</option>";
}else if($amper == 2603)
{
	echo "<option value='26030400' >อาษา</option>";
}else if($amper == 2604)
{
	echo "<option value='26040900' >องครักษ์</option>";
}else{
	echo "<option value='' ></option>";
}
//echo "<option value='26011200' >เขาพระ</option>";
/*
$sql = "select * from e_report.tab_e_ccaattmm where flag_area = '3' and catm_ukey like '$amper%'  and catm_tdate = '0'  order by catm_desc ";
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