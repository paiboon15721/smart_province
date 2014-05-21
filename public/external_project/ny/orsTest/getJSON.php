<?php
//header('Content-Type: application/json');
header('Cache-Control: no-cache, must-revalidate');
header('Content-Type: application/javascript');
include "./include/sql_func.php";
include "./include/func.php";
    try{
        if ($_REQUEST['action'] == 'getPopByCond' || $_REQUEST['action'] == 'getListArmy' || $_REQUEST['action'] == 'getListElder' || $_REQUEST['action'] == 'getPopByHid'){
            if ($_REQUEST['action'] == 'getPopByCond'){
                $pid = $_REQUEST['txt_pid'];
                $fname = $_REQUEST['txt_fname'];
                $lname = $_REQUEST['txt_lname'];
                $sex = $_REQUEST['rdo_sex'];
                $dob_start = $_REQUEST['txt_dob_start'];
                $dob_end = $_REQUEST['txt_dob_end'];
                $age_start = $_REQUEST['txt_age_start'];
                $age_end = $_REQUEST['txt_age_end'];
                
                //$age_start = 10;
                //$age_end = 11;
                //$cc = '26';
                $aa = $_REQUEST['sel_aa'];
                $tt = $_REQUEST['sel_tt'];
                $mm = $_REQUEST['sel_mm'];
                $datemi_start = $_REQUEST['txt_datemi_start'];
                $datemi_end = $_REQUEST['txt_datemi_end'];

                $order_by = $_REQUEST['rdo_sort'];
                $direct = $_REQUEST['rdo_sort_direct'];
                
                //$fname = "กชกร";
                //$pid = "3659900464973";
                $fname = iconv('UTF-8','TIS-620',$fname);
                $lname = iconv('UTF-8','TIS-620',$lname);
                
                $result = getPopByCond($pid, $fname, $lname, $sex, $dob_start, $dob_end, $age_start, $age_end, $cc, $aa, $tt, $mm, $datemi_start, $datemi_end, $order_by, $direct);
            }else if ($_REQUEST['action'] == 'getListArmy'){
                //$cc = '26';
                $aa = $_REQUEST['sel_aa'];
                $tt = $_REQUEST['sel_tt'];
                $mm = $_REQUEST['sel_mm'];
                $order_by = $_REQUEST['rdo_sort'];
                $direct = $_REQUEST['rdo_sort_direct'];
                $result = getListArmy($cc,$aa,$tt,$mm, $order_by, $direct);
            
            }else if ($_REQUEST['action'] == 'getListElder') {
                $aa = $_REQUEST['sel_aa'];
                $tt = $_REQUEST['sel_tt'];
                $mm = $_REQUEST['sel_mm'];
                $order_by = $_REQUEST['rdo_sort'];
                $direct = $_REQUEST['rdo_sort_direct'];
                $result = getListElder($cc,$aa,$tt,$mm, $order_by, $direct);
            
            }else{
            
                $hid = $_REQUEST['hid'];
               // $hid = "10010213660";
                $result = getPopByHid($hid);
               // echo "result = ".$result;
            }
                
            $arr_data = explode("|", $result);
            $code = $arr_data[0];
            if ($code == "0"){
                $output = array(
                    "sEcho"=>1,
                    "iTotalRecords"=>0,
                    "iTotalDisplayRecords"=>"25",
                    "aaData" => array(),
                    "code"=>$code,
                    "message"=>"{$arr_data[1]}|{$arr_data[2]}"
                );
            }else if ($code == "1"){
                $output = array(
                    "sEcho"=>1,
                    "iTotalRecords"=>$arr_data[1],
                    "iTotalDisplayRecords"=>"25",
                    "aaData" => array(),
                    "code"=>$code,
                    "message"=>$result
                );
                $aColumns = array( 'order', 'pid', 'name', 'dob', 'age', 'sex', 'detail' );
                
                $num = $arr_data[1];
                $j=2;

                for ($i=0;$i<$num;$i++){
                    $pid = $arr_data[$j++];
                    $title = $arr_data[$j++];
                    $fname = $arr_data[$j++];
                    $lname = $arr_data[$j++];
                    
                    //$title_sex = $arr_data[$j++];
                    //$title_print = $arr_data[$j++];
                    $fullname = $arr_data[$j++];
                    
                    $dob = $arr_data[$j++];
                    $age = $arr_data[$j++];
                    $sex = $arr_data[$j++];
                    
                    $k = -1;
                    
                /*    if ($age > 14){
                        if ($title == 'ด.ญ.'){
                            $title = 'น.ส.';
                        }else if ($title == 'ด.ช.'){
                            $title = 'นาย';
                        }
                    }
                    $name = $title . $fname . ' ' . $lname;
                */    
                    $items = array();
                    $items[$aColumns[++$k]] = $i+1;
                    $items[$aColumns[++$k]] = formatPid($pid);
                    $items[$aColumns[++$k]] = $fullname;
                    $items[$aColumns[++$k]] = displayDate($dob);
                    $items[$aColumns[++$k]] = $age;
                    $items[$aColumns[++$k]] = strSex($sex);
                    $items[$aColumns[++$k]] = 'ดูรายละเอียด';
                    /*
                    $items[] = $i+1;
                    $items[] = formatPid($pid);
                    $items[] = $name;
                    $items[] = displayDate($dob);
                    $items[] = $age;
                    $items[] = strSex($sex);
                    $items[] = 'a';
                    */
                    $output['aaData'][] = $items;
                    
                }
                    //echo ("{ ".substr(json_encode($output), 1));
                    //echo json_encode( $output );
                    //echo '{"sEcho":1,"iTotalRecords":"1","iTotalDisplayRecords":"25","aaData":[[1,"3-6599-00464-97-3","test","test","a"]]}';
                    //echo $output;
                $output["message"] = $arr_data[$j++];
            }else if ($code == "9"){
                $output = array(
                    "aaData" => array(),
                    "code"=>$code,
                    "message"=>"Error : {$arr_data[1]}"
                );
           
                
            }
        
        
        }else if ($_REQUEST['action'] == 'getHouseByCond'){
        
            $hid = $_REQUEST['txt_hid'];
               
            //$age_start = 10;
            //$age_end = 11;
            //$cc = '26';
            $aa = $_REQUEST['sel_aa'];
            $tt = $_REQUEST['sel_tt'];
            $mm = $_REQUEST['sel_mm'];
            $htype = $_REQUEST['sel_htype'];
           
            
            //$fname = "กชกร";
            //$pid = "3659900464973";
            //  $fname = iconv('UTF-8','TIS-620',$fname);
            // $lname = iconv('UTF-8','TIS-620',$lname);
            
            $result = getHouseByCond($hid, $cc, $aa, $tt, $mm, $htype);
                
                //echo "data = $data";
            //echo "result = ".$result;
                
            $arr_data = explode("|", $result);
            $code = $arr_data[0];
            if ($code == "0"){
                $output = array(
                    "sEcho"=>1,
                    "iTotalRecords"=>0,
                    "iTotalDisplayRecords"=>"25",
                    "aaData" => array(),
                    "code"=>$code,
                    "message"=>"{$arr_data[1]}"
                );
            }else if ($code == "1"){
                $output = array(
                    "sEcho"=>1,
                    "iTotalRecords"=>$arr_data[1],
                    "iTotalDisplayRecords"=>"25",
                    "aaData" => array(),
                    "code"=>$code
                );
                $aColumns = array( 'order', 'hid', 'htype','address', 'map', 'list_pop' );
                
                $num = $arr_data[1];
                $j=2;

                for ($i=0;$i<$num;$i++){
                    $hid = $arr_data[$j++];
                    $htype = $arr_data[$j++];  
                    $hno = $arr_data[$j++];
                    $ccaattmm = $arr_data[$j++];
                    $thanon = $arr_data[$j++];
                    $trok = $arr_data[$j++];
                    $soi1 = $arr_data[$j++];
                    $soi2 = $arr_data[$j++];
                    $cc = $arr_data[$j++];
                    $aa = $arr_data[$j++];
                    $tt = $arr_data[$j++];
                    $mm = $arr_data[$j++];
                    
                    
                    
                    
                    /*  $cc = "จังหวัดนครนายก";
    $aa = "อำเภอบ้านนา";
    $tt = "ตำบลอาษา";
    */
                    
                    
                    
                    $address = strAddr($hno,$ccaattmm,$thanon,$trok,$soi1,$soi2,$cc,$aa,$tt,$mm);
                    
                    $k = -1;
                    
                    $items = array();
                    $items[$aColumns[++$k]] = $i+1;
                    $items[$aColumns[++$k]] = formatHid($hid);
                    $items[$aColumns[++$k]] = $htype;
                    $items[$aColumns[++$k]] = $address;
                    $items[$aColumns[++$k]] = 'แผนที่';
                    $items[$aColumns[++$k]] = 'รายการคนในบ้าน';
  
                    $output['aaData'][] = $items;
                    
                }
                    //echo ("{ ".substr(json_encode($output), 1));
                    //echo json_encode( $output );
                    //echo '{"sEcho":1,"iTotalRecords":"1","iTotalDisplayRecords":"25","aaData":[[1,"3-6599-00464-97-3","test","test","a"]]}';
                    //echo $output;
                // for dubug $output["message"] = $arr_data[$j++];
            }else if ($code == "9"){
                $output = array(
                    "aaData" => array(),
                    "code"=>$code,
                    "message"=>"Error : {$arr_data[1]}"
                );
                //echo "<meta http-equiv='refresh' content='0;URL=search_pop.php>";
                //echo "<script language='javascript'>alert('เกิดความผิดพลาด : {$arr_data[1]}')</script>";
                
            }
        
        }else{
            $output = array(
                    "aaData" => array(),
                    "code"=>9,
                    "message"=>"Error : ไม่พบ action การทำงาน"
                );
        }
        
            
    }catch (Exception $e){
        //$result = "9|Exception : {$e->getMessage()}";
        $output = array(
            "aaData" => array(),
            "code"=>9,
            "message"=>"Exception : {$e->getMessage()}"
        );
    }
    
    echo json_encode( $output );
   
?>
