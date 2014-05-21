<?php 

		$host = "localhost";
		$user = "mia";
		$pass = "mia";
		$dbname = "village_center";
//		$dbname = "VILLAGE_CENTER";
		$prefix = "";
		$condb= mysql_connect($host,$user,$pass);  //สร้างการเชื่อมต่อฐานข้อมูลเก็บไว้ในตัวแปร $condb
		mysql_select_db($dbname);

?>