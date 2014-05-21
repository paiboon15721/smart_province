<?php
	function setVars($data){
		global $codeRet;
		global $titlePrt;
		global $titleCode;
		global $pid;
		global $fname;
		global $mname;
		global $lname;
		global $dob;
		global $age;
		global $dateMi;
		global $sex;
		global $hid;
		global $hno;
		global $rcode;
		global $rcodeDesc;
		global $ccaattmm;
		global $trokCode;
		global $trokDesc;
		global $soiCode;
		global $soiDesc1;
		global $soiDesc2;
		global $thanonCode;
		global $thanonDesc;
		global $ttDesc;
		global $aaDesc;
		global $ccDesc;
		global $postcode;
		
		$splitData = explode("|", $data);
		$i = 0;
		$codeRet = $splitData[$i++];
		$titlePrt = $splitData[$i++];
		$titleCode = $splitData[$i++];
		$pid = $splitData[$i++];
		$fname = $splitData[$i++];
		$mname = $splitData[$i++];
		$lname = $splitData[$i++];
		$dob = $splitData[$i++];
		$age = $splitData[$i++];
		$dateMi = $splitData[$i++];
		$sex = $splitData[$i++];
		$hid = $splitData[$i++];
		$hno = $splitData[$i++];
		$rcode = $splitData[$i++];
		$rcodeDesc = $splitData[$i++];
		$ccaattmm = $splitData[$i++];
		$trokCode = $splitData[$i++];
		$trokDesc = $splitData[$i++];
		$soiCode = $splitData[$i++];
		$soiDesc1 = $splitData[$i++];
		$soiDesc2 = $splitData[$i++];
		$thanonCode = $splitData[$i++];
		$thanonDesc = $splitData[$i++];
		$ttDesc = $splitData[$i++];
		$aaDesc = $splitData[$i++];
		$ccDesc = $splitData[$i++];
		$postcode = $splitData[$i++];
	}
	
	function curDate(){
		$strYear = date("Y")+543;
		$strMonth= date("m");
		$strDay= date("d");
		$strDate = $strYear.$strMonth.$strDay;
		return $strDate;
	}
	
	function curTime(){
		$today = getdate();
		$p_hour = date("H");
		$p_minute = date("i");
		$time = $p_hour;//.$p_hour;
		return $time;
	}
	
	function DateThai(){
		$strYear = date("Y")+543;
		$strMonth= date("n");
		$strDay= date("j");
		$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$strMonthThai=$strMonthCut[$strMonth];
		$strDate = "$strDay $strMonthThai $strYear";
		//return $retStr .= iconv('TIS-620','UTF-8',$strDate);
		return $retStr = $strDate;
	}

	function formatDateThai($strDate){
		$strYear = substr($strDate, 0, 4);
		$strMonth= substr($strDate, 4, 2);
		$strDay= (int)substr($strDate, 6, 2);
		$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$strMonthThai=$strMonthCut[(int)$strMonth];
		$strDate = "$strDay $strMonthThai $strYear";
		//return $retStr .= iconv('TIS-620','UTF-8',$strDate);
		return $strDate;
	}
	
	function formatPID($pid){
		$pid = sprintf("%013s", $pid);
		return $pid{0}."-".$pid{1}.$pid{2}.$pid{3}.$pid{4}."-".$pid{5}.$pid{6}.$pid{7}.$pid{8}.$pid{9}."-".$pid{10}.$pid{11}."-".$pid{12};
	}

	function curPageURL() {
		 $pageURL = 'http';
		 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		 $pageURL .= "://";
		 if ($_SERVER["SERVER_PORT"] != "80") {
		  	$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		 } else {
		  	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		 }
		 
		 $pageURL = str_replace("login.php","",$pageURL);
		 return $pageURL;
	}
?>