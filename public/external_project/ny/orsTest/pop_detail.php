<?php
include "./include/func.php";
    //echo $data;
    $data = $_REQUEST['data'];

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
    
    
   /* $cc = "จังหวัดนครนายก";
    $aa = "อำเภอบ้านนา";
    $tt = "ตำบลอาษา";
    */
    
    $own_st = strOwnSt($own_st);
    $pop_st = strPopSt($pop_st);
    $sex = strSex($sex);
    $pid = formatPid($pid);
    $hid = formatHid($hid);
    $dob = displayDate($dob);
    $datemi = displayDate($datemi);
    
    $address = strAddr($hno, $ccaattmm,$thanon,$trok,$soi1,$soi2,$cc,$aa,$tt,$mm);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META HTTP-EQUIV="PRAGMA" CONTENT="no-cache">
<title>ตรวจสอบรายการคนและบ้าน</title>

<link rel="stylesheet" href="ui/themes/jquery-ui.min.css" type="text/css" />
<link rel="stylesheet" href="css/search_pop.css" type="text/css" />
<link rel="stylesheet" href="css/print.css" type="text/css" media="print"/>

<script src="lib/js/jquery-1.9.0.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/func.js" type="text/javascript" charset="utf-8"></script>

<script src="ui/jquery-ui.min.js" type="text/javascript"></script>

<script src="js/custom_detail.js" type="text/javascript" charset="utf-8"></script>



</head>

<body >

<div id="header" class="main_heading">โปรแกรมตรวจสอบรายการคนและบ้าน</div>
<div id="content">
    <fieldset>
    <legend>ข้อมูลบุคคล</legend>
    <label for="" class="label_title">เลขประจำตัวประชาชน</label><label id="pid" class="display_data"><?php echo $pid;?></label><br/>
    <label for="" class="label_title">ชื่อ-สกุล</label><label id="name" class="display_data"><?php echo $name;?></label><br/>
    <label for="" class="label_title">เพศ</label><label id="sex" class="display_data"><?php echo $sex;?></label><br/>
    <label for="" class="label_title">วัน เดือน ปีเกิด</label><label id="dob" class="display_data"><?php echo $dob;?></label><br/>
    <label for="" class="label_title">อายุ</label><label id="age" class="display_data"><?php echo $age;?> &nbsp; ปี</label><br/>
    <label for="" class="label_title">สัญชาติ</label><label id="nat" class="display_data"><?php echo $nat;?></label><br/>
    <label for="" class="label_title">สถานภาพบุคคล</label><label id="pop_st" class="display_data"><?php echo $pop_st;?></label><br/>
    </fieldset>
    <fieldset>
    <legend>ข้อมูลที่อยู่</legend>
    <label for="" class="label_title">เลขรหัสประจำบ้าน</label><label id="hid" class="display_data"><?php echo $hid;?></label><br/>
    <label for="" class="label_title">ที่อยู่</label><label id="address" class="display_data"><?php echo $address;?></label><br/>
    <label for="" class="label_title">สถานภาพเจ้าบ้าน</label><label id="own_st" class="display_data"><?php echo $own_st;?></label><br/>
    <label for="" class="label_title">วันที่ย้ายเข้า</label><label id="datemi" class="display_data"><?php echo $datemi;?></label><br/>
    </fieldset>
    <fieldset>
    <legend>ข้อมูลบิดา-มารดา</legend>
    <label for="" class="label_title">ชื่อบิดา</label><label id="faname" class="display_data"><?php echo $faname;?></label><br/>
    <label for="" class="label_title">สัญชาติของบิดา</label><label id="fnat" class="display_data"><?php echo $fnat;?></label><br/>
    <label for="" class="label_title">มารดา</label><label id="maname" class="display_data"><?php echo $maname;?></label><br/>
    <label for="" class="label_title">สัญชาติของมารดา</label><label id="mnat" class="display_data"><?php echo $mnat;?></label><br/>
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