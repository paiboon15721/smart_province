<?php
include "./include/sql_func.php";
include "./include/func.php";
    
    try{
        if ($_REQUEST['action']=="getListAA"){
            $result = getListAA($_REQUEST['sel_cc']);
            
        }else if ($_REQUEST['action']=="getListTT"){
            $result = getListTT($_REQUEST['sel_aa']);

        }else if ($_REQUEST['action']=="getListMM"){
            $result = getListMM($_REQUEST['sel_tt']);

        }else if ($_REQUEST['action']=="getDataByPid"){    
            $pid = $_REQUEST['pid'];
            $result = getDataByPid($pid);
            
        }else if ($_REQUEST['action']=="getListHType"){    
            $result = getListHType();
        
        }else if ($_REQUEST['action']=="getPopByHid"){    
            $hid = $_REQUEST['hid'];
            $result = getListByHid($hid);
        }else if ($_REQUEST['action']=="getCCDesc"){
            $result = getCCDesc($_REQUEST['cc']);
        }else{
            $pid = $_REQUEST['txt_pid'];
            $fname = $_REQUEST['txt_fname'];
            $lname = $_REQUEST['txt_lname'];
            $age_start = $_REQUEST['txt_age_start'];
            $age_end = $_REQUEST['txt_age_end'];
            
           // $age_start = 10;
            //$age_end = 10;
            //$cc = '26';
            $aa = $_REQUEST['sel_aa'];
            $tt = $_REQUEST['sel_tt'];
            $mm = $_REQUEST['sel_mm'];
            $datemi_start = $_REQUEST['txt_datemi_start'];
            $datemi_end = $_REQUEST['txt_datemi_end'];
            /*
            echo "aa = {$aa}<br>";
            echo "tt = {$tt}<br>";
            echo "mm = {$mm}<br>";
            */
            //$fname = "กชกร";
        
            $fname = iconv('UTF-8','TIS-620',$fname);
            $lname = iconv('UTF-8','TIS-620',$lname);
            
            $result = getPopByCond($pid, $fname, $lname, $age_start, $age_end, $cc, $aa, $tt, $mm, $datemi_start, $datemi_end);
           
        }
    }catch (Exception $e){
        $result = "9|{$e->getMessage()}";
    }
    
    echo $result;
    
   
?>
