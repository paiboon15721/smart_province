<?php
session_cache_expire(30);
$cache_expire = session_cache_expire();
session_start();
include ("con_db.ini");
	echo $_GET['FNAME'];
	if(isset($_GET['flg'])) { $flg = $_GET['flg']; } else{ $flg = "0";}
	if(isset($_GET['EMPID'])) { $emp_id = $_GET['EMPID']; } else{ $emp_id = "";}
	if(isset($_GET['FNAME'])) { $emp_name = $_GET['FNAME']; } else{ $emp_name = "";}
	if(isset($_GET['ADDRESS'])) { $emp_add = $_GET['ADDRESS']; } else{ $emp_add = "0";}
	//$emp_id = $_GET[EMPID];
	//$emp_name = $_GET[FNAME];
	//$emp_add = $_GET[ADDRESS];
	//======Test====
	$emp_name= iconv("TIS-620","UTF-8",$emp_name);
	echo "name = $emp_name<br>";
	$emp_add= iconv("TIS-620","UTF-8",$emp_add);
	echo "emp_add = $emp_add";
	//======== SET SESSION ==========
	$_SESSION['EMPID'] = $emp_id;
	$_SESSION['EMPNAME'] = $emp_name;
	$_SESSION['EMPADD'] = $emp_add;
	$_SESSION['START'] = time();
	$_SESSION['EXPIRE'] = $_SESSION['START'] + (30 * 60) ;
	//======== SQL ===========
	$sql_find = "select ccaattmm from tab_e_regis where pid = '$emp_id' ";
	$query_find = mysql_query($sql_find);
	if(empty($query_find))
	{
		$_SESSION['CATM_MOO'] = "26011201";
	}else{
		$row = mysql_fetch_array($query_find);
		$ccaattmm = $row['ccaattmm'];
		$_SESSION['CATM_MOO'] = $ccaattmm;
	}
	//echo "<META HTTP-EQUIV=Refresh CONTENT=0;URL=\"../\">";
	//header('Location: ../');
?>