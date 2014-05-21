<?php
function connphp() {
	//$host = "61.19.44.34:1521/xe";
	$host = "nrs:1521/orcl";
	$username = "mia";
	$password = "mia";
	return oci_connect($username,$password,$host,'AL32UTF8');
}
?>