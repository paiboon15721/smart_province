<?php
error_reporting( ~(E_NOTICE));
//DB CONNECTION START
/*if ($_SERVER['SERVER_ADDR'] == "172.16.1.222"){
	$dbhost ="localhost";
}else{
	$dbhost ="nrs";
}*/

$dbhost							= "localhost";
/*$dbuser							= "root";
$dbpass							= "usbw";*/
$dbuser							= "mia";
$dbpass							= "mia";
$dbname							= "village_center";

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ("Error connecting to mysql");
mysql_select_db($dbname);
//DB CONNECTION END
?>
