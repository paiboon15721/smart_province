<?php 
    session_start();
?>    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META HTTP-EQUIV="PRAGMA" CONTENT="no-cache">
<title>ตรวจสอบรายการคนและบ้าน</title>
<style type="text/css" title="currentStyle">
    @import "css/tabletools.css";
</style>

<link rel="stylesheet" href="ui/themes/jquery-ui.min.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="css/table_jui.css" type="text/css" />
<link rel="stylesheet" href="css/search_pop.css" type="text/css" />
<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/print.css" type="text/css" media="print" />

<script src="lib/js/jquery-1.9.1.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/func.js" type="text/javascript" charset="utf-8"></script>
<script src="js/custom_list_house.js" type="text/javascript" charset="utf-8"></script>
<script src="plugin/js/jquery.dataTables.js" type="text/javascript" charset="utf-8"></script>
<script src="plugin/js/TableTools.min.js" type="text/javascript" charset="utf-8"></script>

<script src="plugin/js/FixedHeader.min.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="plugin/css/jquery.fancybox.css" type="text/css" media="screen" charset="utf-8"/>
<script src="plugin/js/jquery.fancybox.pack.js" type="text/javascript" charset="utf-8"></script>

<script src="ui/jquery-ui.min.js" type="text/javascript"></script>
</head>

<body class="bg">
<?php //include "check_emp.php"; ?>
<?php
include "./include/func.php";

    $hid = $_REQUEST['txt_hid'];
    $hid = str_replace("-","",$hid);
    $aa = $_REQUEST['sel_aa2'];
    $tt = $_REQUEST['sel_tt2'];
    $mm = $_REQUEST['sel_mm2'];
    
    $cc_desc = $_REQUEST['cc_desc2'];
    $aa_desc = $_REQUEST['aa_desc2'];
    $tt_desc = $_REQUEST['tt_desc2'];
    $mm_desc = $_REQUEST['mm_desc2'];
    
    $htype = $_REQUEST['sel_htype'];
    $htype_desc = $_REQUEST['htype_desc'];

    if ($htype <> ""){
        $cond_desc .= "ประเภทบ้าน = \"".$_REQUEST['htype_desc'] ."\" และ ";
    }
    
    if (trim($hid) <> "" && $hid > 0){
        $cond_desc .= strcatDesc("เลขรหัสประจำบ้าน",formatHid($hid),0);
    }
     $cond_desc .= strcatCATM("ที่อยู่",$cc,$aa,$tt,$mm,$cc_desc,$aa_desc,$tt_desc,$mm_desc);
   
    
    if (trim(substr($cond_desc,strlen($cond_desc)-strlen("และ "))) == "และ"){
        $cond_desc = substr($cond_desc,0,strlen($cond_desc)-strlen("และ "));
    }
    $sort_desc = "เลขรหัสประจำบ้าน (จากน้อยไปมาก)";
   /* try{
        $hid = $_REQUEST['txt_hid'];
        //$cc = '26';
        $aa = $_REQUEST['sel_aa2'];
        $tt = $_REQUEST['sel_tt2'];
        $mm = $_REQUEST['sel_mm2'];
        $htype = $_REQUEST['sel_htype'];
        
        $htype = 4;
        $result = getHouseByCond($hid, $cc, $aa, $tt, $mm,$htype);
        $arr_data = explode("|", $result);
        $code = $arr_data[0];
        if ($code == "1"){
        
        }else if ($code == "0"){
           // echo "<meta http-equiv='refresh' content='0;URL=search_pop.php>";
            echo "<script language='javascript'>alert('ไม่พบข้อมูลตามเงื่อนไขที่ระบุ')</script>";
            exit();
        }else if ($code == "9"){
            //echo "<meta http-equiv='refresh' content='0;URL=search_pop.php>";
            echo "<script language='javascript'>alert('เกิดความผิดพลาด : {$arr_data[1]}')</script>";
            exit();
        }
    }catch (Exception $e){
        //$result = "9|{$e->getMessage()}";
        //echo "<meta http-equiv='refresh' content='0;URL=search_pop.php>";
        echo "<script language='javascript'>alert('เกิดความผิดพลาด : {$e->getMessage()}')</script>";
        exit();
    }
    */
?>
<div id="header" class="main_heading no_print"></div>
<div class="main_heading print_title">โปรแกรมตรวจสอบรายการคนและบ้าน</div>
<div id="content" class="content">
    <form id="frm_list_pop">
        <input type="hidden" id="emp_pid" value="<?php echo $_SESSION['EMPID'];?>"/>
        <input type="hidden" id="hid_result" value="<?php echo $result;?>"/>
        <input type="hidden" id="txt_hid" value="<?php echo $hid;?>"/>
        <input type="hidden" id="sel_aa" value="<?php echo $_REQUEST['sel_aa2'];?>"/>
        <input type="hidden" id="sel_tt" value="<?php echo $_REQUEST['sel_tt2'];?>"/>
        <input type="hidden" id="sel_mm" value="<?php echo $_REQUEST['sel_mm2'];?>"/>
        <input type="hidden" id="sel_htype" value="<?php echo $_REQUEST['sel_htype'];?>"/>
         <input type="hidden" id="house_data" value=""/>
    </form>

    <div id="cond_desc">
        <label class="label_title_bold">ผลการค้นหารายการบ้าน</label>
        <br/>
        <label class="label_title_bold">เงื่อนไข : </label><?php echo $cond_desc; ?> 
        <div>
        <div class="left"><label class="label_title_bold">เรียงข้อมูลตาม : </label><?php echo $sort_desc; ?></div>
        <div class="right"><label class="label_title_bold" id="total"></label></div>
        </div>
    </div>
    <br/>
    
    <div id="loading" class="center_box"><img src="images/loading.gif"/></div>
    <p>
    <div id ="details">
        <table class="display" id="tab_pop">
            <thead>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <br/>
    <div class="center_box no_print">
        <input type="button" id="btn_print" value="พิมพ์รายงาน" class="button"/>
        <input type="button" id="btn_new" value="ตรวจสอบรายการใหม่" class="button"/>
    </div> 
</div>

<div id="footer" class="footer">
    <div id="msg"></div>
</div>

</body>
</html>