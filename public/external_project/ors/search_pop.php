<?php 
    session_start();
?>    

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META HTTP-EQUIV="PRAGMA" CONTENT="no-cache">
<title>ตรวจสอบรายการคนและบ้าน</title>

<link rel="stylesheet" href="plugin/css/jquery.fancybox.css" type="text/css" media="screen" />
<link rel="stylesheet" href="ui/themes/jquery-ui.min.css" type="text/css" />
<link rel="stylesheet" href="css/search_pop.css" type="text/css" />
<script src="lib/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="plugin/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="plugin/js/jquery.maskedinput.min.js" type="text/javascript"></script>
<script src="js/func.js" type="text/javascript"></script>
<script src="js/custom_search.js" type="text/javascript"></script>
<script src="ui/jquery-ui.min.js" type="text/javascript"></script>

<script src="plugin/js/jquery.fancybox.pack.js" type="text/javascript" charset="utf-8"></script>

</head>

<body class="bg">
<?php 

$emp_pid = $_SESSION['EMPID'];
//$emp_pid = "3100100000001";
if ($_SERVER['SERVER_ADDR'] == "157.179.24.101"){
    //$cc_desc = "จังหวัดนครปฐม";
   // $catm = "73000000";
   
    if (isset($_SESSION['catm_login'])){
        $catm = $_SESSION['catm_login'];
    }else{
        $catm = "73000000";
    }
    //$catm = "73000000";
    //echo "catm == ".$catm."<br/>";
}else{
    //$cc_desc = "จังหวัดนครนายก";
    if (isset($_SESSION['catm_login'])){
        $catm = $_SESSION['catm_login'];
    }else{
        $catm = "26011201";
    }
    //$catm = "26030401";
 //$catm = "26020501";
//$catm = "26040905"; 
}

?>
<div id="header" class="main_heading banner"></div>

<div id="content" class="content">
<div id="tabs" class="tabs" style="visibility:hidden;">
    <ul>
        <li><a href="#tabs-1">ตรวจสอบรายการคน</a></li>
        <li><a href="#tabs-2">ตรวจสอบรายการบ้าน</a></li>
        <li><a href="#tabs-3">บัญชีรายชื่อ</a></li>
    </ul>

    <form id="frm_search_pop" name="frm_search_pop" action="list_pop.php?action=pop" method="post">
    <input type="hidden" id="emp_pid" name="emp_pid" value="<?php echo $emp_pid; ?>"/>
    <input type="hidden" id="catm" name="catm" value="<?php echo $catm; ?>"/>
    <input type="hidden" id="cc_desc" name="cc_desc" value="<?php echo $cc_desc; ?>"/>
    <input type="hidden" id="aa_desc" name="aa_desc" value=""/>
    <input type="hidden" id="tt_desc" name="tt_desc" value=""/>
    <input type="hidden" id="mm_desc" name="mm_desc" value=""/>
    <div id="tabs-1">
        <div class="input_cond">
        <label id="lbl_txt_pid" for="txt_pid" class="label_title">เลขประจำตัวประชาชน</label>
        <input type="text" id="txt_pid" name="txt_pid" size="18" maxlength="17" /> 
        </div>
        <div class="input_cond">
        <label id="lbl_txt_fname" for="txt_fname" class="label_title">ชื่อตัว</label>
        <input type="text" id="txt_fname" name="txt_fname" size="40" maxlength="40" minlength="2" /> 
        </div>
        <div class="input_cond">
        <label id="lbl_txt_lname" for="txt_lname" class="label_title">ชื่อสกุล</label>
        <input type="text" id="txt_lname" name="txt_lname" size="40" maxlength="40" minlength="2"/>
        </div>
        <div class="input_cond">
        <label id="lbl_rdo_sex" for="rdo_sex" class="label_title">เพศ </label>
        <input type="radio" id="rdo_sex_no" name="rdo_sex" value="0" checked="checked"/> ไม่ระบุ 
        <input type="radio" id="rdo_sex_male" name="rdo_sex" value="1"/> ชาย 
        <input type="radio" id="rdo_sex_female" name="rdo_sex" value="2"/> หญิง
        </div>
        <div class="input_cond">
        <label for="txt_age_start" class="label_title">อายุ ตั้งแต่</label>
        <input type="text" id="txt_age_start" name="txt_age_start" size="3" maxlength="3"/>
        <label for="txt_age_end" class="label_title_back"> ปี &nbsp; &nbsp; &nbsp; ถึง</label>
        <input type="text" id="txt_age_end" name="txt_age_end" size="3" maxlength="3"/>
        <label for="txt_age_end" class="label_title_back">ปี</label>
        </div>
        <div class="input_cond">
        <label for="txt_dob_start" class="label_title">วันเดือนปีเกิด ตั้งแต่ </label>
        <input type="text" id="txt_dob_start" name="txt_dob_start" size="10" maxlength="10"/> 
        <label for="txt_dob_end" class="label_title_back"> &nbsp; &nbsp; ถึง</label>
        <input type="text" id="txt_dob_end" name="txt_dob_end" size="10" maxlength="10"/>
        </div>
        <div class="input_cond">
        <label for="sel_aa" class="label_title disabled_field">อำเภอ</label>
        <select id="sel_aa" name="sel_aa" class="sel_size">
        </select>
        </div>

        <div class="input_cond">
        <label for="sel_tt" class="label_title disabled_field">ตำบล</label>
        <select id="sel_tt" name="sel_tt" class="sel_size">
            <option value="">----- ทุกตำบล -----</option>
        </select>
        </div>
        
        <div class="input_cond">
        <label for="sel_mm" class="label_title disabled_field">หมู่บ้าน</label>
        <select id="sel_mm" name="sel_mm" class="sel_size">
            <option value="">---- ทุกหมู่บ้าน ----</option>
        </select>
        </div>
        <div class="input_cond">

        <label for="txt_datemi_start" class="label_title">วันที่ย้ายเข้า ตั้งแต่ </label>
        <input type="text" id="txt_datemi_start" name="txt_datemi_start" size="10" maxlength="10"/> 
        <label for="txt_datemi_end" class="label_title_back"> &nbsp; &nbsp; ถึง</label>
        <input type="text" id="txt_datemi_end" name="txt_datemi_end" size="10" maxlength="10"/>
        </div>
        <br/>
        <div class="input_cond">
        <label for="" class="label_title">จัดเรียงข้อมูลตาม </label>
        <input type="radio" id="" name="rdo_sort" value="pid" checked="checked"/> เลขประจำตัวประชาชน 
        <input type="radio" id="" name="rdo_sort" value="fname"/> ชื่อตัว 
        <input type="radio" id="" name="rdo_sort" value="lname"/> ชื่อสกุล
        <input type="radio" id="" name="rdo_sort" value="dob"/> วันเดือนปีเกิด
        </div>
        
        <div class="input_cond">
        <label for="" class="label_title">รูปแบบการจัดเรียง </label>
        <input type="radio" id="" name="rdo_sort_direct" value="" checked="checked"/> น้อยไปมาก 
        <input type="radio" id="" name="rdo_sort_direct" value="desc"/> มากไปน้อย
        </div>
    </div>
    </form>
    <form id="frm_search_house" name="frm_search_house" action="list_house.php" method="post">
    <input type="hidden" id="catm" name="catm" value="<?php echo $catm; ?>"/>
    <input type="hidden" id="cc_desc2" name="cc_desc2" value="<?php echo $cc_desc; ?>"/>
    <input type="hidden" id="aa_desc2" name="aa_desc2" value=""/>
    <input type="hidden" id="tt_desc2" name="tt_desc2" value=""/>
    <input type="hidden" id="mm_desc2" name="mm_desc2" value=""/>
    <input type="hidden" id="htype_desc" name="htype_desc" value=""/>
    <div id="tabs-2">
        <div class="input_cond">
        <label for="txt_hid" class="label_title">เลขรหัสประจำบ้าน</label>
        <input type="text" id="txt_hid" name="txt_hid" size="14" maxlength="13"/> 
        </div>
        <div class="input_cond">
        <label for="sel_aa2" class="label_title">อำเภอ</label>
        <select id="sel_aa2" name="sel_aa2" class="sel_size">
        <!--    <option value="">----- อำเภอ -----</option>
            <option value="2601">เมืองนครนายก</option>
            <option value="2602">บางพลี</option>
            <option value="2603">บ้านนา</option>
            <option value="2604">องครักษ์</option>
        -->
        </select>
        </div>
        <div class="input_cond">
     
        <label for="sel_tt2" class="label_title">ตำบล</label>
        <select id="sel_tt2" name="sel_tt2" class="sel_size">
            <option value="">----- ทุกตำบล -----</option>
        </select>
        </div>
        <div class="input_cond">
        <label for="sel_mm2" class="label_title">หมู่บ้าน</label>
        <select id="sel_mm2" name="sel_mm2" class="sel_size">
            <option value="">---- ทุกหมู่บ้าน ----</option>
        </select>
        </div>
        
        <div class="input_cond">
        <label for="sel_htype" class="label_title">ประเภทบ้าน</label>
        <select id="sel_htype" name="sel_htype">
            <option value="">---- ประเภทบ้าน ----</option>
        </select>
        </div>
    </div>
    </form>
    
    <form id="frm_search_list" name="frm_search_list" action="list_pop.php?action=list" method="post">
    <input type="hidden" id="catm" name="catm" value="<?php echo $catm; ?>"/>
    <input type="hidden" id="cc_desc3" name="cc_desc3" value="<?php echo $cc_desc;?>"/>
    <input type="hidden" id="aa_desc3" name="aa_desc3" value=""/>
    <input type="hidden" id="tt_desc3" name="tt_desc3" value=""/>
    <input type="hidden" id="mm_desc3" name="mm_desc3" value=""/>
    <div id="tabs-3">
        <div class="input_cond">
            <label for="rdo_list" class="label_title">ประเภทบัญชีรายชื่อ</label>
            <input type="radio" id="" name="rdo_list" value="1" checked="checked"/> ชายไทยที่ต้องขึ้นทะเบียนทหาร (ชายไทยอายุ 17 ปีในปีปัจจุบัน)
            <br/>
            <label for="rdo_list" class="label_title">&nbsp;</label>
            <input type="radio" id="" name="rdo_list" value="2"/> ผู้สูงอายุ (คนไทยที่มีอายุตั้งแต่ 60 ปีบริบูรณ์)
        </div>
        
        <div class="input_cond">
        <label for="sel_aa3" class="label_title">อำเภอ</label>
        <select id="sel_aa3" name="sel_aa3" class="sel_size">
        <!--    <option value="">----- อำเภอ -----</option>
            <option value="2601">เมืองนครนายก</option>
            <option value="2602">บางพลี</option>
            <option value="2603">บ้านนา</option>
            <option value="2604">องครักษ์</option>
        -->
        </select>
        </div>
        <div class="input_cond">
        <label for="sel_tt3" class="label_title">ตำบล</label>
        <select id="sel_tt3" name="sel_tt3" class="sel_size">
            <option value="">----- ทุกตำบล -----</option>
        </select>
        </div>
        <div class="input_cond">
        <label for="sel_mm3" class="label_title">หมู่บ้าน</label>
        <select id="sel_mm3" name="sel_mm3" class="sel_size">
            <option value="">---- ทุกหมู่บ้าน ----</option>
        </select>
        </div>
        <br/>
        <div class="input_cond">
        <label for="" class="label_title">จัดเรียงข้อมูลตาม </label>
        <input type="radio" id="" name="rdo_sort" value="pid" checked="checked"/> เลขประจำตัวประชาชน 
        <input type="radio" id="" name="rdo_sort" value="fname"/> ชื่อตัว 
        <input type="radio" id="" name="rdo_sort" value="lname"/> ชื่อสกุล
        <input type="radio" id="" name="rdo_sort" value="dob"/> วันเดือนปีเกิด
        </div>
        
        <div class="input_cond">
        <label for="" class="label_title">รูปแบบการจัดเรียง </label>
        <input type="radio" id="" name="rdo_sort_direct" value="" checked="checked"/> น้อยไปมาก 
        <input type="radio" id="" name="rdo_sort_direct" value="desc"/> มากไปน้อย
        </div>
    </div>
    </form>
    
</div>
<div class="center_box">
<input type="button" id="btn_search" value="ตรวจสอบ" class="button"/>
<input type="button" id="btn_clear" value="ลบหน้าจอ" class="button"/>
</div>

</div>
<div id="footer" class="footer">
    <div id="msg">&nbsp;</div>
</div>
<?php //include "check_emp.php"; ?>
</body>
</html>
