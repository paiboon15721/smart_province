<?php
header ('Content-type: text/html; charset=utf-8');
session_start();
error_reporting( ~(E_NOTICE));
require_once("inc/function.php");

//echo "catmmenu = ".$_SESSION['catm_menu'];
//echo "<br>catm_description = ".$_SESSION['catm_description'];
if((!isset($_SESSION['votePID'])) && (!isset($_SESSION['voteFLNAME'])) && (!isset($_SESSION['voteADDR']))){
	header('Location:login.php');
}else{
	header('Location:displayuser.php');
}
?>