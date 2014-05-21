﻿<?php
/*จัด format เลขประจำตัวประชาชน*/
function formatPid($pid){
    $pid = sprintf("%013s",$pid);
	return substr($pid,0,1) . "-" . substr($pid,1,4) . "-" . substr($pid,5,5) . "-" . substr($pid,10,2) . "-" . substr($pid,12,1);
}

/*จัด format เลขรหัสประจำบ้าน*/
function formatHid($hid){
	return substr($hid,0,4) . "-" . substr($hid,4,6) . "-" . substr($hid,10,1);
}

/**/
function strSex($sex){
    switch ($sex){
        case 1 : return "ชาย";
        case 2 : return "หญิง";
        default : return "-";
    }
}

/*แปลง space เป็น  &nbsp;*/
function sp2nb($str){
	return str_replace("  ", "&nbsp; ", $str);
}

/*แสดงวันที่แบบสั้น*/
function displayDate($ymd){
    if ($ymd == ""){
        return $ymd;
    }
  	$d = substr($ymd,6,2);
	$m = substr($ymd,4,2);
	$y = substr($ymd,0,4);
    if (strlen($ymd) == 4){
        return $ymd;
    }
	switch($m){
		case "01" : $mthDesc = "ม.ค."; break;
		case "02" : $mthDesc = "ก.พ."; break;
		case "03" : $mthDesc = "มี.ค."; break;
		case "04" : $mthDesc = "เม.ย."; break;
		case "05" : $mthDesc = "พ.ค."; break;
		case "06" : $mthDesc = "มิ.ย."; break;
		case "07" : $mthDesc = "ก.ค."; break;
		case "08" : $mthDesc = "ส.ค."; break;
		case "09" : $mthDesc = "ก.ย."; break;
		case "10" : $mthDesc = "ต.ค."; break;
		case "11" : $mthDesc = "พ.ย."; break;
		case "12" : $mthDesc = "ธ.ค."; break;
	}
	$dmy = sprintf("%d %s %s",$d,$mthDesc,$y);
	return trim($dmy);
}

/*แสดงวันที่แบบยาว*/
function displayLongDate($ymd){
  	$d = substr($ymd,6,2);
	$m = substr($ymd,4,2);
	$y = substr($ymd,0,4);
	switch($m){
		case "01" : $mthDesc = "มกราคม"; break;
		case "02" : $mthDesc = "กุมภาพันธ์"; break;
		case "03" : $mthDesc = "มีนาคม"; break;
		case "04" : $mthDesc = "เมษายน"; break;
		case "05" : $mthDesc = "พฤษภาคม"; break;
		case "06" : $mthDesc = "มิถุนายน"; break;
		case "07" : $mthDesc = "กรกฎาคม"; break;
		case "08" : $mthDesc = "สิงหาคม"; break;
		case "09" : $mthDesc = "กันยายน"; break;
		case "10" : $mthDesc = "ตุลาคม"; break;
		case "11" : $mthDesc = "พฤศจิกายน"; break;
		case "12" : $mthDesc = "ธันวาคม"; break;
	}
	$dmy = sprintf("%d %s %s",$d,$mthDesc,$y);
	return $dmy;
}

function strPopSt($pop_st){
    switch ($pop_st){
        case 0: return "บุคคลนี้มีภูมิลำเนาอยู่ในบ้านนี้";
        case 1: return "บุคคลนี้ถูกจำหน่ายชื่อจากทะเบียนบ้านเนื่องจากตาย "; 
        case 2: return "บุคคลนี้ถูกจำหน่ายชื่อจากทะเบียนบ้านด้วย ท.ร.97";
        case 3: return "รายการนี้ถูกจำหน่ายเนื่องจากเปลียนสถานภาพด้วย ท.ร.98";
        case 4: return "บุคคลนี้ย้ายไปต่างประเทศ";
        case 5: return "รายการนี้ถูกจำหน่ายเนื่องจากมีชื่อซ้ำซ้อน";
        case 6: return "บุคคลนี้ถูกจำหน่ายตามระเบียบข้อ 110";
        case 7: return "รายการนี้ถูกจำหน่ายชื่อจากทะเบียนบ้านแล้ว ";
        case 8: return "บุคคลนี้อยู่ในทะเบียนบ้านกลางห้ามนำเอกสารไปอ้างอิงหรือใช้สิทธิ์ในกรณีต่างๆ";
        case 9: return "บุคคลนี้แจ้งย้ายออกจากทะเบียนบ้านหลังนี้แล้ว";
        case 10: return "รายการนี้ถูกจำหน่ายแล้วและได้เพิ่มชื่อโดยเลขประจำตัวประชาชนใหม่";
        case 11: return "บุคคลนี้แจ้งตายแล้ว แต่ยังไม่ได้จำหน่ายออกจากทะเบียนบ้าน";
        case 12: return "รายการนี้ถูกจำหน่ายกรณีสละสัญชาติไทย"; 
        case 13: return "บุคคลนี้สละสัญชาติไทยแล้วและแจ้งตาย";
        case 14: return "จำหน่ายบุคคลห้ามเคลื่อนไหวทางการทะเบียน";
        case 15: return "Caution Sign";
        default : return "-" . "(".$pop_st.")";
    }
}

function strOwnSt($own_st){
    switch ($own_st){
        case 0 : return "ผู้อาศัย";
        case 1 : return "เจ้าบ้าน";
        default : return "หัวหน้าครอบครัวที่ " .$own_st;
    }
}

function strAddr($hno, $ccaattmm,$thanon,$trok,$soi1,$soi2,$cc,$aa,$tt,$mm){
    $str .= $hno;
    if (trim($thanon) != ""){
        $str .= " ถนน".$thanon;
    }
    if (trim($trok) != ""){
        $str .= " ตรอก".$trok;
    }
    if (trim($soi1) != ""){
        $str .= " ซอย".$soi1;
    }else if (trim($soi2) != ""){
        $str .= " ซอย".$soi2;
    }
    $moo = substr($ccaattmm,6,2);
    if ($moo != "00"){
        $str .= " หมู่ที่ ".(int)($moo);
    }
    if (trim($tt) != ""){
        $str .= " ตำบล".$tt;
    }
    if (trim($aa) != ""){
        $str .= " อำเภอ".$aa;
    }
    if (trim($cc) != ""){
        $str .= " จังหวัด".$cc;
    }
    return trim($str);
}

function strcatDesc($field,$value,$type){
/* type = 0 : string,   type = 1 : num */    
    if ($type == 0){
        if (trim($value) != ""){
            return "{$field} = \"{$value}\" และ ";
        }
    }else{
        if ($value > 0){
            return "{$field} = {$value} และ ";
        }
    }
}

function strcatBetweenDesc($field,$start,$end,$isDate = 0){
// isDate = 0 ไม่ใช่วันที่, isDate = 1 เป็นวันที่
    
    if ($start == $end || $end == 0 || trim($end) == '' || trim($end) == '-'){
        if ($start > 0 && trim($start) != ''){
            if ($isDate == 1) {
                $start = displayDate($start);
            }
            return "{$field} = \"{$start}\" และ ";
        }
    }else{
        if ($isDate == 1) {
            $end = displayDate($end);
        }
        if ($start == 0 || trim($start) == '' || trim($start) == '-'){
            return "{$field} ตั้งแต่ 0 - {$end} และ ";
        }else{
            if ($isDate == 1) {
                $start = displayDate($start);
            }
            return "{$field} ตั้งแต่  {$start} - {$end} และ ";
        }
    }
}

function strcatCATM($cc,$aa,$tt,$mm){
    $str='';
    if (trim($mm) != '' && $mm != 0){
        $str .= "{$mm} {$tt} {$aa} {$cc} และ " ;
    }else if (trim($tt) != '' && $tt != 0){ 
        $str .= "{$tt} {$aa} {$cc} และ " ;
    }else if (trim($aa) != '' && $aa != 0){
        $str .= "{$aa} {$cc} และ " ;
    }else if (trim($cc) != '' && $cc != 0){
        $str .= "{$cc} และ " ;
    }
    return $str;
}

function YMDtoDMY($ymd){
    if (strlen($ymd)==8){
        return substr($ymd,6,2) . substr($ymd,4,2) . substr($ymd,0,4);
    }else{
        return $ymd;
    }
}

function DMYtoYMD($dmy){
    if (strlen($dmy)==8){
        return substr($dmy,4,4) . substr($dmy,2,2) . substr($dmy,0,2);
    }else{
        return $dmy;
    }
}

function strSortDesc($value){
    if ($value == "pid"){
        return "เลขประจำตัวประชาชน";
    }else if ($value == "fname"){
        return "ชื่อตัว";
    }else if ($value == "lname"){
        return "ชื่อสกุล";
    }else if ($value == "dob"){
        return "วันเดือนปีเกิด";
    }
}

	///// fill comma and auto convert null to 0
	function fillComma($number)  {
		$number = intVal($number);
		$number = number_format($number,0," ",",");
		return str_replace(" ", "&nbsp;", $number);
	  }

	///// sum all value in array
	function sum_array($array){
		$total;
			for($i=0;$i<count($array);$i++){
				$total+=$array[$i];
			}	
		return $total;
	}
	
	//// convert null to 0
	function nvl($number){
		if($number == null){
			$number = 0;
		}
	return($number);
  }
  
  //// fill left with input string
	function lpad($text,$add_text,$number){
		$ans = $text;
		if(strlen($text)<$number){
			for($i=strlen($text);$i<$number;$i++){
				$ans = $add_text.$ans;
			}
		}
	return($ans);
  }
  
  
    //// fill right with input string
	function rpad($text,$add_text,$number){
		$ans = $text;
		if(strlen($text)<$number){
			for($i=strlen($text);$i<$number;$i++){
				$ans = $ans.$add_text;
			}
		}
	return($ans);
  }

  
   function TxtDate($char,$format){
	if($char!=null){
		if($format=="dmy"){
				return substr($char,0,2)."/".substr($char,2,2)."/".substr($char,4,4);
			}else{
				return substr($char,0,4)."/".substr($char,4,2)."/".substr($char,6,2);
			}
		}
	}
	
	function TxtTime($char){
		if($char!=null){
			return substr($char,0,2).":".substr($char,2,2).":".substr($char,4,2);
		}
	}

  



?>