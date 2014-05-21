<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META HTTP-EQUIV="PRAGMA" CONTENT="no-cache">
<title>ตรวจสอบรายการคนและบ้าน</title>
<style type="text/css" title="currentStyle">
    @import "css/tabletools.css";
</style>

<link rel="stylesheet" href="ui/themes/jquery-ui.min.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/table_jui.css" type="text/css" />
<link rel="stylesheet" href="css/search_pop.css" type="text/css" />
<link rel="stylesheet" href="css/print.css" type="text/css" media="print" />

<script src="lib/js/jquery-1.9.0.min.js" type="text/javascript" charset="utf-8"></script>
<script src="js/func.js" type="text/javascript" charset="utf-8"></script>
<script src="js/custom_list.js" type="text/javascript" charset="utf-8"></script>
<script src="plugin/js/jquery.dataTables.js" type="text/javascript" charset="utf-8"></script>
<script src="plugin/js/TableTools.min.js" type="text/javascript" charset="utf-8"></script>

<script src="plugin/js/FixedHeader.min.js" type="text/javascript" charset="utf-8"></script>
<script src="plugin/js/FixedColumns.min.js" type="text/javascript" charset="utf-8"></script>

<link rel="stylesheet" href="plugin/css/jquery.fancybox.css" type="text/css" media="screen" charset="utf-8"/>
<script src="plugin/js/jquery.fancybox.pack.js" type="text/javascript" charset="utf-8"></script>

<script src="ui/jquery-ui.min.js" type="text/javascript"></script>

<script src="plugin/js/jquery.TableCSVExport.js" type="text/javascript"></script>

</head>
<body>
<?php
include "./include/func.php";

//ini_set("register_globals","Off");


//echo "action = {$_REQUEST['action']}<br/>";
    //$action = $_REQUEST['action'];
    //$catm = $_REQUEST['catm'];
    if ($_REQUEST['action'] == "pop"){
        $pid = $_REQUEST['txt_pid'];
        $fname = $_REQUEST['txt_fname'];
        $lname = $_REQUEST['txt_lname'];
        $sex = $_REQUEST['rdo_sex'];
        $dob_start = $_REQUEST['txt_dob_start'];
        $dob_end = $_REQUEST['txt_dob_end'];
        $age_start = $_REQUEST['txt_age_start'];
        $age_end = $_REQUEST['txt_age_end'];
        //$cc = '26';
        $aa = $_REQUEST['sel_aa'];
        $tt = $_REQUEST['sel_tt'];
        $mm = $_REQUEST['sel_mm'];
        
        
       // echo "txt_datemi_start = ".$_REQUEST['txt_datemi_start']."</br>";
       // echo "txt_datemi_end = ".$_REQUEST['txt_datemi_end']."</br>";
        
        $datemi_start = $_REQUEST['txt_datemi_start'];
        $datemi_end = $_REQUEST['txt_datemi_end'];
        
        //echo "datemi_start = $datemi_start</br>";
        //echo "datemi_end = $datemi_end</br>";
        
        //$fname = iconv('TIS-620','UTF-8',$fname);
        //$lname = iconv('TIS-620','UTF-8',$lname);
        
        
        $rdo_sort = $_REQUEST['rdo_sort'];
        $rdo_sort_direct = $_REQUEST['rdo_sort_direct'];
        
        $datemi_start = str_replace("/", "", $datemi_start);
        $datemi_end = str_replace("/", "", $datemi_end);
        $dob_start = str_replace("/", "", $dob_start);
        $dob_end = str_replace("/", "", $dob_end);
        
        //echo "datemi_start = $datemi_start</br>";
        //echo "datemi_end = $datemi_end</br>";
        
        $txt_datemi_start = DMYtoYMD($datemi_start);
        $txt_datemi_end = DMYtoYMD($datemi_end);
        $txt_dob_start = DMYtoYMD($dob_start);
        $txt_dob_end = DMYtoYMD($dob_end);
        
        //echo "txt_datemi_start = $txt_datemi_start</br>";
        //echo "txt_datemi_end = $txt_datemi_end</br>";
            //$fname = "กชกร";
        if (trim($pid) <> "" && $pid > 0){
            $cond_desc .= strcatDesc("เลขประจำตัวประชาชน",formatPid($pid),0);
        }
        
        $cond_desc .= strcatDesc("ชื่อตัว",$fname,0);
        $cond_desc .= strcatDesc("ชื่อสกุล",$lname,0);
        if ($rdo_sex > 0){
            $cond_desc .= strcatDesc("เพศ",strSex($rdo_sex),0);
        }
        $cond_desc .= strcatBetweenDesc("วันเกิด",$txt_dob_start,$txt_dob_end,1);
        $cond_desc .= strcatBetweenDesc("อายุ",$age_start,$age_end,2);
     
        //$cond_desc .= strcatCATM("ที่อยู่",$cc,$aa,$tt,$mm);
        $cc_desc = $_REQUEST['cc_desc'];
        $aa_desc = $_REQUEST['aa_desc'];
        $tt_desc = $_REQUEST['tt_desc'];
        $mm_desc = $_REQUEST['mm_desc'];
        /*echo "cc_desc = {$cc_desc}<br/>";
        echo "aa_desc = {$aa_desc}<br/>";
        echo "tt_desc = {$tt_desc}<br/>";
        echo "mm_desc = {$mm_desc}<br/>";*/
        $cond_desc .= strcatCATM("ที่อยู่",$cc,$aa,$tt,$mm,$cc_desc,$aa_desc,$tt_desc,$mm_desc);
        $cond_desc .= strcatBetweenDesc("วันที่ย้ายเข้า",$txt_datemi_start,$txt_datemi_end,1);
       
        
        
        $sort_desc .= strSortDesc($rdo_sort);
        if ($rdo_sort_direct == ""){
            $sort_desc .= "(จากน้อยไปมาก)";
        }else{
            $sort_desc .= "(จากมากไปน้อย)";
        }
    }else if ($_REQUEST['action'] == "list") {
    
        //echo "in action list<br/>";
        //$cc = '26';
                
        $rdo_list = $_REQUEST['rdo_list'];
        $aa = $_REQUEST['sel_aa3'];
        $tt = $_REQUEST['sel_tt3'];
        $mm = $_REQUEST['sel_mm3'];
        $cc_desc = $_REQUEST['cc_desc3'];
        $aa_desc = $_REQUEST['aa_desc3'];
        $tt_desc = $_REQUEST['tt_desc3'];
        $mm_desc = $_REQUEST['mm_desc3'];
        
        $rdo_sort = $_REQUEST['rdo_sort'];
        $rdo_sort_direct = $_REQUEST['rdo_sort_direct'];
        /*echo "cc_desc = {$cc_desc}<br/>";
        echo "aa_desc = {$aa_desc}<br/>";
        echo "tt_desc = {$tt_desc}<br/>";
        echo "mm_desc = {$mm_desc}<br/>";
        */
        if ($rdo_list == 1){
            $cond_desc .= "บัญชีรายชื่อชายไทยที่ต้องขึ้นทะเบียนทหาร และ";
            
            
        }else if ($rdo_list == 2){
            $cond_desc .= "บัญชีรายชื่อผู้สูงอายุ และ";
        }
        $cond_desc .= strcatCATM("ที่อยู่",$cc,$aa,$tt,$mm,$cc_desc,$aa_desc,$tt_desc,$mm_desc);
         
        $sort_desc .= strSortDesc($rdo_sort);
        if ($rdo_sort_direct == ""){
            $sort_desc .= "(จากน้อยไปมาก)";
        }else{
            $sort_desc .= "(จากมากไปน้อย)";
        } 
         
    }else if ($_REQUEST['action'] == "pop_in_house"){
        
        $hid = $_REQUEST['hid'];
        $hid = str_replace("-", "", $hid);
        $cond_desc = "รายชื่อบุคคลที่อาศัยอยู่ในบ้านของเลขรหัสประจำบ้าน = ".formatHid($hid);
        $sort_desc = "เลขประจำตัวประชาชน (น้อยไปมาก)";
    }
    
    
    if (trim(substr($cond_desc,strlen($cond_desc)-strlen("และ "))) == "และ"){
        $cond_desc = substr($cond_desc,0,strlen($cond_desc)-strlen("และ "));
    }
    
   /* try{
        $pid = $_REQUEST['txt_pid'];
        $fname = $_REQUEST['txt_fname'];
        $lname = $_REQUEST['txt_lname'];
        $age_start = $_REQUEST['txt_age_start'];
        $age_end = $_REQUEST['txt_age_end'];
        //$cc = '26';
        $aa = $_REQUEST['sel_aa'];
        $tt = $_REQUEST['sel_tt'];
        $mm = $_REQUEST['sel_mm'];
        $datemi_start = $_REQUEST['txt_datemi_start'];
        $datemi_end = $_REQUEST['txt_datemi_end'];

        //$fname = "กชกร";
        $fname = iconv('UTF-8','TIS-620',$fname);
        $lname = iconv('UTF-8','TIS-620',$lname);
        
        $result = getPopByCond($pid, $fname, $lname, $age_start, $age_end, $cc, $aa, $tt, $mm, $datemi_start, $datemi_end);
        $arr_data = explode("|", $result);
        $code = $arr_data[0];
        if ($code == "1"){
            $output = array(
                "aaData" => array()
            );
            $aColumns = array( 'order', 'pid', 'name', 'dob', 'age', 'detail' );
            
            $num = $arr_data[1];
                $j=2;

                for ($i=1;$i<=$num;$i++){
                    $pid = $arr_data[$j++];
                    $title = $arr_data[$j++];
                    $fname = $arr_data[$j++];
                    $lname = $arr_data[$j++];
                    $dob = $arr_data[$j++];
                    $age = $arr_data[$j++];
                    $k = -1;
                    
                    if ($age > 14){
                        if ($title == 'ด.ญ.'){
                            $title = 'น.ส.';
                        }else if ($title == 'ด.ช.'){
                            $title = 'นาย';
                        }
                    }
                    $name = $title . $fname . ' ' . $lname;
                    
                    $items = array();
                    $items[$aColumns[++$k]] = $i;
                    $items[$aColumns[++$k]] = formatPid($pid);
                    $items[$aColumns[++$k]] = $name;
                    $items[$aColumns[++$k]] = displayDate($dob);
                    $items[$aColumns[++$k]] = $age;
                    $items[$aColumns[++$k]] = '<a href="">ดูรายละเอียด</a>';
             

                    $output['aaData'][] = $items;
                }
            
                $output = (json_encode($output));
            
        }else if ($code == "0"){
           // echo "<meta http-equiv='refresh' content='0;URL=search_pop.php>";
            echo "<script language='javascript'>alert('ไม่พบข้อมูล')</script>";
            exit();
        }else if ($code == "9"){
            //echo "<meta http-equiv='refresh' content='0;URL=search_pop.php>";
            echo "<script language='javascript'>alert('เกิดความผิดพลาด : {$arr_data[1]}')</script>";
            exit();
        }
    }catch (Exception $e){
        //$result = "9|{$e->getMessage()}";
        //echo "<meta http-equiv='refresh' content='0;URL=search_pop.php>";
        echo "<script language='javascript'>alert('เกิดความผิดพลาด: {$e->getMessage()}')</script>";
        exit();
    }
        */
?>

<div id="header" class="main_heading">โปรแกรมตรวจสอบรายการคนและบ้าน</div>
<div id="content">
    <form id="frm_list_pop">
        <input type="hidden" id="action" value="<?php echo $_REQUEST['action'];?>">
        <input type="hidden" id="catm" value="<?php echo $_REQUEST['catm'];?>">
        <input type="hidden" id="txt_pid" value="<?php echo $pid;?>">
        <input type="hidden" id="txt_fname" value="<?php echo $fname;?>">
        <input type="hidden" id="txt_lname" value="<?php echo $lname;?>">
        <input type="hidden" id="rdo_sex" value="<?php echo $_REQUEST['rdo_sex'];?>">
        <input type="hidden" id="txt_age_start" value="<?php echo $_REQUEST['txt_age_start'];?>">
        <input type="hidden" id="txt_age_end" value="<?php echo $_REQUEST['txt_age_end'];?>">
        <input type="hidden" id="txt_dob_start" value="<?php echo $txt_dob_start;?>">
        <input type="hidden" id="txt_dob_end" value="<?php echo $txt_dob_end;?>">
        <input type="hidden" id="sel_aa" value="<?php echo $_REQUEST['sel_aa'];?>">
        <input type="hidden" id="sel_tt" value="<?php echo $_REQUEST['sel_tt'];?>">
        <input type="hidden" id="sel_mm" value="<?php echo $_REQUEST['sel_mm'];?>">
        <input type="hidden" id="sel_aa3" value="<?php echo $_REQUEST['sel_aa3'];?>">
        <input type="hidden" id="sel_tt3" value="<?php echo $_REQUEST['sel_tt3'];?>">
        <input type="hidden" id="sel_mm3" value="<?php echo $_REQUEST['sel_mm3'];?>">
        <input type="hidden" id="txt_datemi_start" value="<?php echo $txt_datemi_start;?>">
        <input type="hidden" id="txt_datemi_end" value="<?php echo $txt_datemi_end;?>">
        <input type="hidden" id="rdo_sort" value="<?php echo $_REQUEST['rdo_sort'];?>">
        <input type="hidden" id="rdo_sort_direct" value="<?php echo $_REQUEST['rdo_sort_direct'];?>">
        <input type="hidden" id="rdo_list" value="<?php echo $rdo_list;?>">
        <input type="hidden" id="hid" value="<?php echo $hid;?>">
        <input type="hidden" id="aa_desc" value="<?php echo $_REQUEST['aa_desc'];?>">
        <input type="hidden" id="tt_desc" value="<?php echo $_REQUEST['tt_desc'];?>">
        <input type="hidden" id="mm_desc" value="<?php echo $_REQUEST['mm_desc'];?>">
        <input type="hidden" id="aa_desc3" value="<?php echo $_REQUEST['aa_desc3'];?>">
        <input type="hidden" id="tt_desc3" value="<?php echo $_REQUEST['tt_desc3'];?>">
        <input type="hidden" id="mm_desc3" value="<?php echo $_REQUEST['mm_desc3'];?>">
    </form>
    <div id="cond_desc">
        <label class="label_title_bold">ผลการค้นหารายการบุคคล</label>
        <br/>
        <label class="label_title_bold">เงื่อนไข : </label><?php echo $cond_desc; ?>
        <br/>
        <div>
        <div class="left"><label class="label_title_bold">เรียงข้อมูลตาม : </label><?php echo $sort_desc; ?></div>
        <div class="right"><label class="label_title_bold" id="total"></label></div>
        </div>
    <?php //เลขประจำตัวประชาชน(จากน้อยไปมาก) ?>
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
                <th></th>
            
            </thead>
            <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
      
            </tbody>
        </table>
    </div>
    <br/>
    <div id = "button_box"></div>
    <div class="center_box no_print">
        
        <input type="button" id="btn_print" value="พิมพ์รายงาน" class="button"/>
              
<?php if ($_REQUEST['action'] != "pop_in_house"){ ?>
    <input type="button" id="btn_new" value="ตรวจสอบรายการใหม่" class="button"/>
<?php }else{ ?>
    <input type="button" id="btn_close" value="ปิดหน้าจอ" class="button"/>
<?php } ?>
    </div> 
</div>

<div id="footer">
    <div id="msg"></div>
</div>

</body>
</html>