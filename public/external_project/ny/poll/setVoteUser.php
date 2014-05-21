<?php
header ('Content-type: text/html; charset=UTF-8');
require("inc/function.php");
session_start();
error_reporting( ~(E_NOTICE));
/*
$_SESSION['votePID'] = iconv("TIS-620", "UTF-8",$_GET['votePID']);
$_SESSION['voteFLNAME'] = iconv("TIS-620", "UTF-8",$_GET['voteFLNAME']);
$_SESSION['voteADDR'] = iconv("TIS-620", "UTF-8",$_GET['voteADDR']);*/

/***** NEW *****/
$_SESSION['votePID'] = formatPID(iconv("TIS-620", "UTF-8",$_GET['EMPID']));
$_SESSION['voteFLNAME'] = iconv("TIS-620", "UTF-8",$_GET['EMPNAME']);
$_SESSION['voteADDR'] = iconv("TIS-620", "UTF-8",$_GET['EMPADD']);
/*echo $_GET['votePID']."<BR>";
echo $_GET['voteFLNAME']."<BR>";
echo $_GET['voteADDR']."<BR>";*/
header("Location: index.php");
?>
