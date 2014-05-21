<?php
header("Content-type: text/html; charset=utf-8");
include "EFunction.php";
session_start();
$connid=condb("e_report");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="EStyle.css" rel="stylesheet" type="text/css">
<title>รายงานเหตุการณ์ประจำวัน</title>
</head>
<div align="center" class="normalfont"><strong>
<?php
	switch($_GET['pic_type']) {
		case 1:
			echo"รูปเหตุการณ์";
		break;
		case 2:
			echo"รูปเอกสาร";
		break;
	}
?>
</strong>
</div>
<br />
<div align="center">
<?php
echo"<img src='./IMAGE_DETAIL/".$_GET['pic_no']."'>";
?>
</div>
<body>
</body>
</html>
