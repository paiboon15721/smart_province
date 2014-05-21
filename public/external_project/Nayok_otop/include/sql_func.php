<?php
//header("Content-Type: text/html; charset=UTF-8");
include "db_func.php";
//echo "2 txt_inhouse_code=".$_REQUEST['txt_inhouse_code'];
//if ($_POST['action']=='add_inhouse'){
    //echo "hello";
    //addInhouse();
//}
$character_set = "TH8TISASCII";
//"AL16UTF16"
function connectORS($character_set = "TH8TISASCII"){
    //connectDB($user,$pass,$con_str,$character_set = "TIS-620")
    $con_str ="nrs:1521/orcl";
    $user = "mia"; 
    $pass = "mia"; 
    try {
        $conn_id = connect_db($user,$pass,$con_str,$character_set);
    }catch (Exeption $e){
        throw $e;
    }
    return $conn_id;
}

function getDataByPid($pid){
    $sql = "select p.pid, (select title_print from tabdb.title where title_code=p.title), p.fname, p.lname, p.dob, sys.age(p.dob), (select nat_tdesc from tabdb.nat where nat_code = p.nat), p.own_st, p.pop_st, p.sex,  p.datemi, p.faname, (select nat_tdesc from tabdb.nat where nat_code =p.fnat), p.maname, (select nat_tdesc from tabdb.nat where nat_code =p.mnat), h.hid, h.hno, h.ccaattmm, nvl((select tnn_desc from tabdb.thanon where tnn_ukey= h.rcode || h.thanon),' '), nvl((select trok_desc from tabdb.trok where trok_ukey= h.rcode || h.trok),' '), nvl((select soi_desc1 || '|' || soi_desc2 from tabdb.soi where soi_ukey= h.rcode || h.soi),' | ') , (select catm_desc from tabdb.ccaattmm where catm_ukey=substr(h.ccaattmm,1,2) || '000000'), (select catm_desc from tabdb.ccaattmm where catm_ukey=substr(h.ccaattmm,1,4) || '0000'),(select catm_desc from tabdb.ccaattmm where catm_ukey=substr(h.ccaattmm,1,6) || '00'),(select catm_desc from tabdb.ccaattmm where catm_ukey=h.ccaattmm) from ors.pop p join ors.house h on p.hid=h.hid where p.pid={$pid}";
    try{
        $conn_id = connectORS();
        $stmt = prepare($conn_id,$sql);
        execute($stmt);
        $result['num'] = fetch_all($stmt,$result['row']);
        if ($result['num'] == 0 ){
            $str_result = "0|";
        }else{
            $str_result = "1|{$result['num']}|";
            foreach ($result['row'] as $row) {
            //echo "<tr>\n";
                foreach ($row as $item) {
                    $item = trim($item);
                    $item = iconv('TIS-620','UTF-8',$item);
                    $str_result .= "{$item}|";
                }
            }    
        } 
        free_statement($stmt);
        close_conn($conn_id);
        //return $result;
        return $str_result;
    }catch (Exception $e){
        throw $e;
    }
}

function getHouseByHid($hid){
    $sql = "select * from ors.pop p join ors.house h on p.hid=h.hid and p.own_st=1 where h.hid={$hid} order by h.hid";
    try{
        $conn_id = connectORS();
        $stmt = prepare($conn_id,$sql);
        execute($stmt);
        $result['num'] = fetch_all($stmt,$result['row']);
        if ($result['num'] == 0 ){
            $str_result = "0|";
        }else{
            $str_result = "1|{$result['num']}|";
            foreach ($result['row'] as $row) {
            //echo "<tr>\n";
                foreach ($row as $item) {
                    $item = iconv('TIS-620','UTF-8',$item);
                    $str_result .= "{$item}|";
                }
            }    
        } 
        free_statement($stmt);
        close_conn($conn_id);
        //return $result;
        return $str_result;
    }catch (Exception $e){
        throw $e;
    }
}

function getPopByHid($hid){
    $sql = "select p.pid,(select title_print from tabdb.title where title_code=p.title),p.fname,p.lname,p.dob,sys.age(p.dob) from ors.pop p join ors.house h on p.hid=h.hid where h.hid={$hid} order by p.pid";
    try{
        $conn_id = connectORS();
        $stmt = prepare($conn_id,$sql);
        execute($stmt);
        $result['num'] = fetch_all($stmt,$result['row']);
        if ($result['num'] == 0 ){
            $str_result = "0|";
        }else{
            $str_result = "1|{$result['num']}|";
            foreach ($result['row'] as $row) {
            //echo "<tr>\n";
                foreach ($row as $item) {
                    $item = trim($item);
                    $item = iconv('TIS-620','UTF-8',$item);
                    $str_result .= "{$item}|";
                }
            }    
        } 
        free_statement($stmt);
        close_conn($conn_id);
        //return $result;
        return $str_result;
    }catch (Exception $e){
        throw $e;
    }
}

function getPopByCond($pid, $fname, $lname, $sex, $dob_start, $dob_end, $age_start, $age_end, $cc, $aa, $tt, $mm, $datemi_start, $datemi_end, $order_by = "pid" , $direct = ""){
    $sql = "select p.pid,(select title_print from tabdb.title where title_code=p.title),p.fname,p.lname,p.dob,sys.age(p.dob),p.sex from ors.pop p join ors.house h on p.hid=h.hid ";
    $cond .= concatWhere("p.pid",$pid,1);
    $cond .= concatWhere("p.fname",$fname,0);
    $cond .= concatWhere("p.lname",$lname,0);   
    $cond .= concatWhere("p.sex",$sex,1);
    $cond .= concatBetween("p.dob",$dob_start,$dob_end);
    $cond .= concatBetween("p.datemi",$datemi_start,$datemi_end);
    $cond .= concatBetween("sys.age(p.dob)",$age_start,$age_end);
    $cond .= concatCATM("h.ccaattmm",$cc,$aa,$tt,$mm);
    if ($cond != ""){
        $cond = substr($cond,0,strlen($cond)-4);
        $sql .= "where ". $cond;
        $sql .= " order by {$order_by} {$direct}";
    }else{
        $str_result = "9|กรุณาระบุเงื่อนไขการค้นหา";
        return $str_result;
    }
    //return "9|".$sql;
    
    
    $sql2 = iconv('TIS-620','UTF-8',$sql);
  //  echo "sql = ".$sql2."</br>";
    
    try{
        $conn_id = connectORS();
        $stmt = prepare($conn_id,$sql);
        execute($stmt);
        $result['num'] = fetch_all($stmt,$result['row']);
        if ($result['num'] == 0 ){
            $str_result = "0|";
        }else{
            $str_result = "1|{$result['num']}|";
            foreach ($result['row'] as $row) {
            //echo "<tr>\n";
                foreach ($row as $item) {
                    $item = iconv('TIS-620','UTF-8',$item);
                    $str_result .= "{$item}|";
                }
            }
        }
        $str_result .= "{$sql2}"; 
        //$str_result = "1|".$sql;
        free_statement($stmt);
        close_conn($conn_id);
        return $str_result;
    }catch (Exception $e){
        throw $e;
    }
}

function getHouseByCond($hid, $cc, $aa, $tt, $mm, $htype){
    $sql = "select h.hid,(select htype_desc from tabdb.htype where htype_code=h.htype), h.hid, h.hno, h.ccaattmm, nvl((select tnn_desc from tabdb.thanon where tnn_ukey= h.rcode || h.thanon),' '), nvl((select trok_desc from tabdb.trok where trok_ukey= h.rcode || h.trok),' '), nvl((select soi_desc1 || '|' || soi_desc2 from tabdb.soi where soi_ukey= h.rcode || h.soi),' | ') , (select catm_desc from tabdb.ccaattmm where catm_ukey=substr(h.ccaattmm,1,2) || '000000'), (select catm_desc from tabdb.ccaattmm where catm_ukey=substr(h.ccaattmm,1,4) || '0000'),(select catm_desc from tabdb.ccaattmm where catm_ukey=substr(h.ccaattmm,1,6) || '00'),(select catm_desc from tabdb.ccaattmm where catm_ukey=h.ccaattmm) from ors.house h ";
    
    $cond .= concatWhere("h.hid",$hid,1);
    $cond .= concatCATM("h.ccaattmm",$cc,$aa,$tt,$mm);
    $cond .= concatWhere("h.htype",$htype,1);
    if ($cond != ""){
        $cond = substr($cond,0,strlen($cond)-4);
        $sql .= "where ". $cond ." order by h.hid";;
    }else{
        $str_result = "9|กรุณาระบุเงื่อนไขการค้นหา";
        return $str_result;
    }
    
    $sql2 = iconv('TIS-620','UTF-8',$sql);
   // echo "sql = ".$sql2."</br>";
    
    try{
        $conn_id = connectORS();
        $stmt = prepare($conn_id,$sql);
        execute($stmt);
        $result['num'] = fetch_all($stmt,$result['row']);
        if ($result['num'] == 0 ){
            $str_result = "0|";
        }else{
            $str_result = "1|{$result['num']}|";
            foreach ($result['row'] as $row) {
            //echo "<tr>\n";
                foreach ($row as $item) {
                    $item = trim($item);
                    $item = iconv('TIS-620','UTF-8',$item);
                    $str_result .= "{$item}|";
                }
            }    
        }
        //$str_result = "1|".$sql;
        free_statement($stmt);
        close_conn($conn_id);
        return $str_result;
    }catch (Exception $e){
        throw $e;
    }
}

function concatWhere($field,$value,$type){
/* type = 0 : string,   type = 1 : num */    
    if ($type == 0){
        if (trim($value) != ""){
            return "{$field} = '{$value}' and ";
        }
    }else{
        if ($value > 0){
            return "{$field} = {$value} and ";
        }
    }
}

function concatBetween($field,$start,$end){
    if ($start == $end || $end == 0 || trim($end) == ''){
        if ($start > 0 && trim($start) != ''){
            return "{$field} = '{$start}' and ";
        }
    }else{
        if ($start == 0 || trim($start) == ''){
            return "{$field} between 0 and {$end} and ";
        }else{
            return "{$field} between {$start} and {$end} and ";
        }
    }
}

function concatCATM($field,$cc,$aa,$tt,$mm){
    if (trim($mm) != '' && $mm != 0){
        return "{$field} = '{$mm}' and ";
    }else if (trim($tt) != '' && $tt != 0){ 
        return "{$field} between {$tt}00 and {$tt}99 and ";
    }else if (trim($aa) != '' && $aa != 0){
        return "{$field} between {$aa}0000 and {$aa}9999 and ";
    }else if (trim($cc) != '' && $cc != 0){
        return "{$field} between {$cc}000000 and {$cc}999999 and ";
    }
}

function getListAA($cc){
    $sql = "select catm_ukey/10000 as tt_code, catm_desc from tabdb.ccaattmm where substr(catm_ukey,1,2) = {$cc} and flag_area=2 and catm_tdate=0";
    try{
        $conn_id = connectORS();
        $stmt = prepare($conn_id,$sql);
        execute($stmt);
        $result['num'] = fetch_all($stmt,$result['row']);
        if ($result['num'] == 0 ){
            $str_result = "0|";
        }else{
            $str_result = "1|{$result['num']}|";
            foreach ($result['row'] as $row) {
            //echo "<tr>\n";
                foreach ($row as $item) {
                    $item = iconv('TIS-620','UTF-8',$item);
                    $str_result .= "{$item}|";
                }
            }    
        } 
        free_statement($stmt);
        close_conn($conn_id);
        //return $result;
        return $str_result;
    }catch (Exception $e){
        throw $e;
    }
}

function getListTT($aa){
    $sql = "select catm_ukey/100 as tt_code, catm_desc from tabdb.ccaattmm where substr(catm_ukey,1,4) = {$aa} and flag_area=3 and catm_tdate=0";
    try{
        $conn_id = connectORS();
        $stmt = prepare($conn_id,$sql);
        execute($stmt);
        $result['num'] = fetch_all($stmt,$result['row']);
        if ($result['num'] == 0 ){
            $str_result = "0|";
        }else{
            $str_result = "1|{$result['num']}|";
            foreach ($result['row'] as $row) {
            //echo "<tr>\n";
                foreach ($row as $item) {
                    $item = iconv('TIS-620','UTF-8',$item);
                    $str_result .= "{$item}|";
                }
            }    
        } 
        free_statement($stmt);
        close_conn($conn_id);
        //return $result;
        return $str_result;
    }catch (Exception $e){
        throw $e;
    }
}

function getListMM($tt){
    $sql = "select catm_ukey as mm_code, catm_desc from tabdb.ccaattmm where substr(catm_ukey,1,6) = {$tt} and flag_area=4 and catm_tdate=0";
    try{
        $conn_id = connectORS();
        $stmt = prepare($conn_id,$sql);
        execute($stmt);
        $result['num'] = fetch_all($stmt,$result['row']);
        if ($result['num'] == 0 ){
            $str_result = "0|";
        }else{
            $str_result = "1|{$result['num']}|";
            foreach ($result['row'] as $row) {
                foreach ($row as $item) {
                    $item = iconv('TIS-620','UTF-8',$item);
                    $str_result .= "{$item}|";
                }
            }    
        } 
        free_statement($stmt);
        close_conn($conn_id);
        return $str_result;
    }catch (Exception $e){
        throw $e;
    }
}

?>
