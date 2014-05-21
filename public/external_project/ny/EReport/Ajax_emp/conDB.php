<?php
function connphp() {
	//$host = "172.16.224.201:1521/orcl";
	$host = "nrs:1521/xe";
	$username = "mia";
	$password = "mia";
	return oci_connect($username,$password,$host,'AL32UTF8');
}
?>