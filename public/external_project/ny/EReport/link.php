<?php	// charset = tis-620	// ����Ѻ�� Link ��ѧ��� .application ���� Parameter ����ҡ������� Session
	session_start();
	$app = $_GET["app"] . ".application";
	$app_file = $app;
	if ($app_file[0] == "/") {
		$tmp = explode("/", $app_file, 2);
		$app_file = $tmp[1];
	}

	if (file_exists($app_file)) {
		$passParam = explode("&", $_SERVER["QUERY_STRING"], 2);
		if ($passParam[1]) $param .= "&" . $passParam[1];
		//echo "Location: " . $app . "?" . $param;
		header("Location: " . $app . "?" . $param);
		exit;
	}
?>