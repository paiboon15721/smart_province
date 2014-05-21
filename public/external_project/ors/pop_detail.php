<?php
//include "./include/func.php";
    //echo $data;
  /*  $data = $_REQUEST['data'];
    $arr_data = explode("|",$data);
    $i=2;
    $pid = $arr_data[$i++];
    $title = $arr_data[$i++];
    $fname = $arr_data[$i++];
    $lname = $arr_data[$i++];
    $name = $title.$fname." ".$lname;
    $dob = $arr_data[$i++];
    $age = $arr_data[$i++];
    $nat = $arr_data[$i++];
    $own_st = $arr_data[$i++];
    $pop_st = $arr_data[$i++];
    $sex = $arr_data[$i++];

    $datemi = $arr_data[$i++];
    $faname = $arr_data[$i++];
    $fnat = $arr_data[$i++];
    $maname = $arr_data[$i++];
    $mnat = $arr_data[$i++];
    $hid = $arr_data[$i++];    
    $hno = $arr_data[$i++];
    $ccaattmm = $arr_data[$i++];
    $thanon = $arr_data[$i++];
    $trok = $arr_data[$i++];
    $soi1 = $arr_data[$i++];
    $soi2 = $arr_data[$i++];
    $cc = $arr_data[$i++];
    $aa = $arr_data[$i++];
    $tt = $arr_data[$i++];
    $mm = $arr_data[$i++];
    
    $own_st = strOwnSt($own_st);
    $pop_st = strPopSt($pop_st);
    $sex = strSex($sex);
    $pid = formatPid($pid);
    $hid = formatHid($hid);
    $dob = displayDate($dob);
    $datemi = displayDate($datemi);
    
    $address = strAddr($hno, $ccaattmm,$thanon,$trok,$soi1,$soi2,$cc,$aa,$tt,$mm);
    */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META HTTP-EQUIV="PRAGMA" CONTENT="no-cache">
<title>ตรวจสอบรายการคนและบ้าน</title>

<link rel="stylesheet" href="css/search_pop.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/print.css" type="text/css" media="print"/>

<script src="lib/js/jquery-1.9.1.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/func.js" type="text/javascript" charset="utf-8"></script>

<script src="ui/jquery-ui.min.js" type="text/javascript"></script>

<script src="js/custom_detail.js" type="text/javascript" charset="utf-8"></script>

</head>

<body>

<div id="header" class="main_heading no_print"></div>
<div class="print_title">โปรแกรมตรวจสอบรายการคนและบ้าน</div>
<div id="content" class="content_detail">
    <fieldset>
    <legend>ข้อมูลบุคคล</legend>
    <div><span class="label_title">เลขประจำตัวประชาชน</span><span id="pid" class="display_data"></span></div>
    <div><span class="label_title">ชื่อ-สกุล</span><span id="name" class="display_data"></span></div>
    <div><span class="label_title">เพศ</span><span id="sex" class="display_data"></span></div>
    <div><span class="label_title">วัน เดือน ปีเกิด</span><span id="dob" class="display_data"></span></div>
    <div><span class="label_title">อายุ</span><span id="age" class="display_data"></span></div>
    <div><span class="label_title">สัญชาติ</span><span id="nat" class="display_data"></span></div>
    <div><span class="label_title">สถานภาพบุคคล</span><span id="pop_st" class="display_data"></span></div>
    </fieldset>
    <fieldset>
    <legend>ข้อมูลที่อยู่</legend>
    <div><span class="label_title">เลขรหัสประจำบ้าน</span><span id="hid" class="display_data"></span></div>
    <div><span class="label_title">ที่อยู่</span><span id="address" class="display_data"></span></div>
    <div><span class="label_title">สถานภาพเจ้าบ้าน</span><span id="own_st" class="display_data"></span></div>
    <div><span class="label_title">วันที่ย้ายเข้า</span><span id="datemi" class="display_data"></span></div>
    </fieldset>
    <fieldset>
    <legend>ข้อมูลบิดา-มารดา</legend>
    <div><span class="label_title">ชื่อบิดา</span><span id="faname" class="display_data"></span></div>
    <div><span class="label_title">สัญชาติของบิดา</span><span id="fnat" class="display_data"></span></div>
    <div><span class="label_title">มารดา</span><span id="maname" class="display_data"></span></div>
    <div><span class="label_title">สัญชาติของมารดา</span><span id="mnat" class="display_data"></span></div>
    </fieldset>
    
    <br/>
    <div class="center_box no_print">
        <input type="button" id="btn_print" value="พิมพ์รายงาน" class="button"/>
        <input type="button" id="btn_close" value="ปิดหน้าจอ" class="button"/>
    </div>
</div>

<div id="footer">
    <div id="msg"></div>
</div>

</body>
</html>