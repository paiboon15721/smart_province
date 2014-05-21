<?php
error_reporting( ~(E_NOTICE));
//DB CONNECTION START
$dbhost							= "localhost";
/*$dbuser							= "root";
$dbpass							= "usbw";*/
$dbuser							= "mia";
$dbpass							= "mia";
$dbname							= "polls";

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ("Error connecting to mysql");
mysql_select_db($dbname);
//DB CONNECTION END
?>