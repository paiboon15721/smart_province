<?php
@session_start(); 
if(!isset($_SESSION['EMPID']))
{
	//echo "<META HTTP-EQUIV=Refresh CONTENT=0;URL=\"write_cookie.php\">";
	?>
	<script>
	alert('กรุณาลงทะเบียนผู้ใช้งานก่อน');
	window.open("", "_parent");
	setTimeout(function(){window.close();}, 100);
	</script>
<?php
}else{
	$now = time(); // checking the time now when home page starts
    if($now > $_SESSION['EXPIRE'])
    {
        //session_destroy();
		unset($_SESSION['EMPID']);
		unset($_SESSION['EMPNAME']);
		unset($_SESSION['EMPADD']);
		unset($_SESSION['CATM_MOO']);
		unset($_SESSION['fact']);
	}else{
		$EMPID = $_SESSION['EMPID'];
		$EMPNAME = $_SESSION['EMPNAME'];
		$EMPADD = $_SESSION['EMPADD'];
		$fact = $_SESSION['fact'];
		if(isset($_SESSION['CATM_MOO'])) { $CATM_MOO = $_SESSION['CATM_MOO']; }else{ $CATM_MOO = "26011201"; }
	}
}
?>