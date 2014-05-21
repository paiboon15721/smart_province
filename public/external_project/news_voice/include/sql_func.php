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
function connectORS($character_set = "AL32UTF8"){
    //connectDB($user,$pass,$con_str,$character_set = "TIS-620")
    //if ($_SERVER['SERVER_ADDR'] == "157.179.24.101"){
    if ($_SERVER['SERVER_ADDR'] == "172.16.1.222"){
        $con_str ="nrs:1521/orcl";
    }else{
        $con_str ="nrs:1521/xe";
    }
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
    //$sql = "select p.pid, (select title_print from tabdb.title where title_code=p.title), p.fname, p.lname, p.dob, sys.age(p.dob), (select nat_tdesc from tabdb.nat where nat_code = p.nat), p.own_st, p.pop_st, p.sex,  p.datemi, p.faname, (select nat_tdesc from tabdb.nat where nat_code =p.fnat), p.maname, (select nat_tdesc from tabdb.nat where nat_code =p.mnat), h.hid, h.hno, h.ccaattmm, nvl((select tnn_desc from tabdb.thanon where tnn_ukey= h.rcode || h.thanon),' '), nvl((select trok_desc from tabdb.trok where trok_ukey= h.rcode || h.trok),' '), nvl((select soi_desc1 || '|' || soi_desc2 from tabdb.soi where soi_ukey= h.rcode || h.soi),' | ') , (select catm_desc from tabdb.ccaattmm where catm_ukey=substr(h.ccaattmm,1,2) || '000000' and flag_area=1), (select catm_desc from tabdb.ccaattmm where catm_ukey=substr(h.ccaattmm,1,4) || '0000' and flag_area=2),(select catm_desc from tabdb.ccaattmm where catm_ukey=substr(h.ccaattmm,1,6) || '00' and flag_area=3),(select catm_desc from tabdb.ccaattmm where catm_ukey=h.ccaattmm and flag_area=4) from ors.pop p join ors.house h on p.hid=h.hid where p.pid={$pid}";
    $sql = "select p.pid, (select title_print from tabdb.title where title_code=p.title), p.fname, p.lname, p.dob, sys.age(p.dob), (select nat_tdesc from tabdb.nat where nat_code = p.nat), p.own_st, p.pop_st, p.sex,  p.datemi, p.faname, (select nat_tdesc from tabdb.nat where nat_code =p.fnat), p.maname, (select nat_tdesc from tabdb.nat where nat_code =p.mnat), h.hid, h.hno, h.ccaattmm, nvl((select tnn_desc from tabdb.thanon where tnn_ukey= h.rcode || h.thanon),' '), nvl((select trok_desc from tabdb.trok where trok_ukey= h.rcode || h.trok),' '), nvl((select soi_desc1 || '|' || soi_desc2 from tabdb.soi where soi_ukey= h.rcode || h.soi),' | ') , (select catm_desc from tabdb.ccaattmm where catm_ukey=substr(h.ccaattmm,1,2) || '000000' and flag_area=1), (select catm_desc from tabdb.ccaattmm where catm_ukey=substr(h.ccaattmm,1,4) || '0000' and flag_area=2),(select catm_desc from tabdb.ccaattmm where catm_ukey=substr(h.ccaattmm,1,6) || '00' and flag_area=3),(select catm_desc from tabdb.ccaattmm where catm_ukey=h.ccaattmm and flag_area=4),";
    $sql .= "case ";
    $sql .= "when t.title_sex = 4 and p.sex = 1 then t.title_print || p.fname || ' ' || p.lname || '  ร.น.' ";
    $sql .= "when t.title_sex = 4 and p.sex = 2 then t.title_print || 'หญิง' || p.fname || ' ' || p.lname || '  ร.น.' ";
    $sql .= "when t.title_sex = 0 and p.sex = 2 then t.title_print || 'หญิง' || p.fname || ' ' || p.lname ";
    $sql .= "when p.title = 999 or (t.title_sex=5 and p.sex = 1) then (select trim(tm.title_desc) from tabdb.title_monk tm where p.pid = tm.pid) || '(' || p.fname || ' ' || p.lname || ')' ";
    $sql .= "when t.title_sex = 6 and p.sex =1 then 'พระ' || '(' || p.fname || ' ' || p.lname || ')' ";
    $sql .= "else  t.title_print || p.fname || ' ' || p.lname ";
    $sql .= "end ";
    $sql .= "as fullname,";
    $sql .= "p.dob,sys.age(p.dob),p.sex, ";
    $sql .= "t.title_sex,t.title_print ";
    $sql .= "from ors.pop p join ors.house h on p.hid=h.hid ";
    $sql .= "join tabdb.title t on p.title = t.title_code ";
    $sql .= "where p.pid={$pid} ";
    
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
                    //$item = iconv('TIS-620','UTF-8',$item);
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
    //$sql = "select p.pid,(select title_print from tabdb.title where title_code=p.title),p.fname,p.lname,p.dob,sys.age(p.dob),p.sex from ors.pop p join ors.house h on p.hid=h.hid where h.hid={$hid} ";
    
    $sql = "select p.pid,p.title,p.fname,p.lname, ";
    $sql .= "case ";
    $sql .= "when t.title_sex = 4 and p.sex = 1 then t.title_print || p.fname || ' ' || p.lname || '  ร.น.' ";
    $sql .= "when t.title_sex = 4 and p.sex = 2 then t.title_print || 'หญิง' || p.fname || ' ' || p.lname || '  ร.น.' ";
    $sql .= "when t.title_sex = 0 and p.sex = 2 then t.title_print || 'หญิง' || p.fname || ' ' || p.lname ";
    $sql .= "when p.title = 999 or (t.title_sex=5 and p.sex = 1) then (select trim(tm.title_desc) from tabdb.title_monk tm where p.pid = tm.pid) || '(' || p.fname || ' ' || p.lname || ')' ";
    $sql .= "when t.title_sex = 6 and p.sex =1 then 'พระ' || '(' || p.fname || ' ' || p.lname || ')' ";
    $sql .= "else  t.title_print || p.fname || ' ' || p.lname ";
    $sql .= "end ";
    $sql .= "as fullname,";
    $sql .= "p.dob,sys.age(p.dob),p.sex, ";
    $sql .= "t.title_sex,t.title_print ";
    $sql .= "from ors.pop p join ors.house h on p.hid=h.hid ";
    $sql .= "join tabdb.title t on p.title = t.title_code ";
    $sql .= "where h.hid={$hid} ";
    
    $pop_st = " p.pop_st in (0,4,8,9,15)";
    $sql .= " and {$pop_st}";
    $sql .= "order by p.pid";
    
    //$sql2 = iconv('TIS-620','UTF-8',$sql);
    //echo "sql = ".$sql2."</br>";
    
    try{
        $conn_id = connectORS();
        $stmt = prepare($conn_id,$sql);
        execute($stmt);
        $result['num'] = 0;
        while ($row = fetch_array($stmt)) {
            $result['num']++;
            for ($col=0;$col<8;$col++){
                $item = trim($row[$col]);
                //$item = iconv('TIS-620','UTF-8',$item);
                $str .= "{$item}|";
            }
        
        }
        if ($result['num'] == 0 ){
            $str_result = "0|";
        }else{
            $str_result = "1|{$result['num']}|{$str}";
        }
        $str_result .= "sql = {$sql}"; 
        
        free_statement($stmt);
        close_conn($conn_id);
        //return $result;
        return $str_result;
    }catch (Exception $e){
        throw $e;
    }
}

function getPopByCond($pid, $fname, $lname, $sex, $dob_start, $dob_end, $age_start, $age_end, $cc, $aa, $tt, $mm, $datemi_start, $datemi_end, $order_by = "pid" , $direct = "", $emp_catm=""){
    
    $fname = iconv('TIS-620','UTF-8',$fname);
    $lname = iconv('TIS-620','UTF-8',$lname);
    /*$sql = "select p.pid,(select title_print from tabdb.title where title_code=p.title),p.fname,p.lname,p.dob,sys.age(p.dob),p.sex ";
    $sql .= "from ors.pop p join ors.house h on p.hid=h.hid ";*/
    
    $sql = "select p.pid,p.title,p.fname,p.lname,";
    $sql .= "case ";
    $sql .= "when t.title_sex = 4 and p.sex = 1 then t.title_print || p.fname || ' ' || p.lname || '  ร.น.' ";
    $sql .= "when t.title_sex = 4 and p.sex = 2 then t.title_print || 'หญิง' || p.fname || ' ' || p.lname || '  ร.น.' ";
    $sql .= "when t.title_sex = 0 and p.sex = 2 then t.title_print || 'หญิง' || p.fname || ' ' || p.lname ";
    $sql .= "when p.title = 999 or (t.title_sex=5 and p.sex = 1) then (select trim(tm.title_desc) from tabdb.title_monk tm where p.pid = tm.pid) || '(' || p.fname || ' ' || p.lname || ')' ";
    $sql .= "when t.title_sex = 6 and p.sex =1 then 'พระ' || '(' || p.fname || ' ' || p.lname || ')' ";
    $sql .= "else  t.title_print || p.fname || ' ' || p.lname ";
    $sql .= "end ";
    $sql .= "as fullname,";
    $sql .= "p.dob,sys.age(p.dob),p.sex, ";
    $sql .= "t.title_sex,t.title_print ";
    $sql .= "from ors.pop p join ors.house h on p.hid=h.hid ";
    $sql .= "join tabdb.title t on p.title = t.title_code ";
    
    $cond .= concatWhere("p.pid",$pid,1);
    $cond .= concatWhere("p.fname",$fname,2);
    $cond .= concatWhere("p.lname",$lname,2);   
    $cond .= concatWhere("p.sex",$sex,1);
    $cond .= concatBetween("p.dob",$dob_start,$dob_end);
    $cond .= concatBetween("p.datemi",$datemi_start,$datemi_end);
    $cond .= concatBetween("sys.age(p.dob)",$age_start,$age_end);
    $cond .= concatCATM("h.ccaattmm",$cc,$aa,$tt,$mm);
    $pop_st = " p.pop_st in (0,4,8,9,15)";
    if ($cond != ""){
        $cond = substr($cond,0,strlen($cond)-4);
        $sql .= "where ". $cond;
        $sql .= " and {$pop_st}";
        $sql .= $emp_catm;
        if ($order_by == 'fname' || $order_by == 'lname'){
            $sql .= " order by NLSSORT({$order_by},'NLS_SORT = THAI_DICTIONARY') {$direct}";
        }else{
            $sql .= " order by {$order_by} {$direct}";
        }
    }else{
        $str_result = "9|กรุณาระบุเงื่อนไขการค้นหา";
        return $str_result;
    }
    //return "9|".$sql;
    
   // $sql2 = iconv('TIS-620','UTF-8',$sql);
  //  echo "sql = ".$sql2."</br>";
    
    try{
        $conn_id = connectORS();
        $stmt = prepare($conn_id,$sql);
        execute($stmt);
        $result['num'] = 0;
        while ($row = fetch_array($stmt)) {
            $result['num']++;
            for ($col=0;$col<8;$col++){
                $item = trim($row[$col]);
                //$item = iconv('TIS-620','UTF-8',$item);
                $str .= "{$item}|";
            }
        
        }
        if ($result['num'] == 0 ){
            $str_result = "0|";
        }else{
            $str_result = "1|{$result['num']}|{$str}";
        }
        $str_result .= "sql = {$sql}"; 
        //$str_result = "1|".$sql;
        free_statement($stmt);
        close_conn($conn_id);
        return $str_result;
    }catch (Exception $e){
        throw $e;
    }
}

function getPopByCond_Old($pid, $fname, $lname, $sex, $dob_start, $dob_end, $age_start, $age_end, $cc, $aa, $tt, $mm, $datemi_start, $datemi_end, $order_by = "pid" , $direct = "", $emp_catm=""){
    
    $fname = iconv('TIS-620','UTF-8',$fname);
    $lname = iconv('TIS-620','UTF-8',$lname);
    
    
    $sql = "select p.pid,(select title_print from tabdb.title where title_code=p.title),p.fname,p.lname,p.dob,sys.age(p.dob),p.sex from ors.pop p join ors.house h on p.hid=h.hid ";
    $cond .= concatWhere("p.pid",$pid,1);
    $cond .= concatWhere("p.fname",$fname,2);
    $cond .= concatWhere("p.lname",$lname,2);   
    $cond .= concatWhere("p.sex",$sex,1);
    $cond .= concatBetween("p.dob",$dob_start,$dob_end);
    $cond .= concatBetween("p.datemi",$datemi_start,$datemi_end);
    $cond .= concatBetween("sys.age(p.dob)",$age_start,$age_end);
    $cond .= concatCATM("h.ccaattmm",$cc,$aa,$tt,$mm);
    $pop_st = " p.pop_st in (0,4,8,9,15)";
    if ($cond != ""){
        $cond = substr($cond,0,strlen($cond)-4);
        $sql .= "where ". $cond;
        $sql .= " and {$pop_st}";
        $sql .= $emp_catm;
        if ($order_by == 'fname' || $order_by == 'lname'){
            $sql .= " order by NLSSORT({$order_by},'NLS_SORT = THAI_DICTIONARY') {$direct}";
        }else{
            $sql .= " order by {$order_by} {$direct}";
        }
    }else{
        $str_result = "9|กรุณาระบุเงื่อนไขการค้นหา";
        return $str_result;
    }
    //return "9|".$fname;
    
   // $sql2 = iconv('TIS-620','UTF-8',$sql);
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
                    $item = trim($item);
                    //$item = iconv('TIS-620','UTF-8',$item);
                    $str_result .= "{$item}|";
                }
            }
        }
        $str_result .= "sql = {$sql}"; 
        //$str_result = "1|".$sql;
        free_statement($stmt);
        close_conn($conn_id);
        return $str_result;
    }catch (Exception $e){
        throw $e;
    }
}

function getHouseByCond($hid, $cc, $aa, $tt, $mm, $htype){
    $sql = "select h.hid,(select htype_desc from tabdb.htype where htype_code=h.htype), h.hid, h.hno, h.ccaattmm, nvl((select tnn_desc from tabdb.thanon where tnn_ukey= h.rcode || h.thanon),' '), nvl((select trok_desc from tabdb.trok where trok_ukey= h.rcode || h.trok),' '), nvl((select soi_desc1 || '|' || soi_desc2 from tabdb.soi where soi_ukey= h.rcode || h.soi),' | ') , (select catm_desc from tabdb.ccaattmm where catm_ukey=substr(h.ccaattmm,1,2) || '000000' and flag_area=1), (select catm_desc from tabdb.ccaattmm where catm_ukey=substr(h.ccaattmm,1,4) || '0000' and flag_area=2),(select catm_desc from tabdb.ccaattmm where catm_ukey=substr(h.ccaattmm,1,6) || '00' and flag_area=3),(select catm_desc from tabdb.ccaattmm where catm_ukey=h.ccaattmm and flag_area=4) from ors.house h ";
    
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
    
    //$sql2 = iconv('TIS-620','UTF-8',$sql);
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
                    //$item = iconv('TIS-620','UTF-8',$item);
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
/* type = 0 : string,   type = 1 : num,     type = 2 : string + like */    
    if ($type == 0){
        if (trim($value) != ""){
            return "{$field} = '{$value}' and ";
        }
    }else if ($type == 1){
        if ($value > 0){
            return "{$field} = {$value} and ";
        }
    }else if ($type == 2){
        if (trim($value) != ""){
            $value = str_replace("*","%",$value);
            return "{$field} like '{$value}' and ";
        }
    }
}

function concatBetween($field,$start,$end){
    if ($start == $end || $end == 0 || trim($end) == ''){
        if ($start >= 0 && trim($start) != ''){
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
    $sql = "select catm_ukey as tt_code, catm_desc from tabdb.ccaattmm where substr(catm_ukey,1,2) = {$cc} and flag_area=2 and catm_tdate=0";
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
                    //$item = iconv('TIS-620','UTF-8',$item);
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
    $sql = "select catm_ukey as tt_code, catm_desc from tabdb.ccaattmm where substr(catm_ukey,1,4) = substr({$aa},1,4) and flag_area=3 and catm_tdate=0";
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
                    //$item = iconv('TIS-620','UTF-8',$item);
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
    $sql = "select catm_ukey as mm_code, catm_desc from tabdb.ccaattmm where substr(catm_ukey,1,6) = substr({$tt},1,6) and flag_area=4 and catm_tdate=0 order by catm_ukey";
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
                    $item = trim($item);
                    //$item = iconv('TIS-620','UTF-8',$item);
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

function getListHType(){
    $sql = "select htype_code, htype_desc from tabdb.htype where htype_tdate=0 order by htype_code";
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
                    $item = trim($item);
                    //$item = iconv('TIS-620','UTF-8',$item);
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

function getCCDesc($cc){
    $sql = "select catm_desc from tabdb.ccaattmm where substr(catm_ukey,1,2) = {$cc} and flag_area=1 and catm_tdate=0;";
    try {
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
                    $item = trim($item);
                    //$item = iconv('TIS-620','UTF-8',$item);
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

function getListArmy($cc, $aa, $tt, $mm, $order_by = "pid", $direct = "", $emp_catm=""){
    $cur_year =  date("Y")+543-17;
   /* $sql = "select p.pid,(select title_print from tabdb.title where title_code=p.title),p.fname,p.lname,p.dob,sys.age(p.dob),p.sex from ors.pop p join ors.house h on p.hid=h.hid ";
    $sql .= "where ";
    $sql .= "p.dob between {$cur_year}0000 and {$cur_year}9999 and p.sex=1 and p.nat=99 ";
    $pop_st = " p.pop_st in (0,4,8,9,15)";
    $sql .= "and {$pop_st} ";
    */
    $sql = "select p.pid,p.title,p.fname,p.lname,";
    $sql .= "case ";
    $sql .= "when t.title_sex = 4 and p.sex = 1 then t.title_print || p.fname || ' ' || p.lname || '  ร.น.' ";
    $sql .= "when t.title_sex = 4 and p.sex = 2 then t.title_print || 'หญิง' || p.fname || ' ' || p.lname || '  ร.น.' ";
    $sql .= "when t.title_sex = 0 and p.sex = 2 then t.title_print || 'หญิง' || p.fname || ' ' || p.lname ";
    $sql .= "when p.title = 999 or (t.title_sex=5 and p.sex = 1) then (select trim(tm.title_desc) from tabdb.title_monk tm where p.pid = tm.pid) || '(' || p.fname || ' ' || p.lname || ')' ";
    $sql .= "when t.title_sex = 6 and p.sex =1 then 'พระ' || '(' || p.fname || ' ' || p.lname || ')' ";
    $sql .= "else  t.title_print || p.fname || ' ' || p.lname ";
    $sql .= "end ";
    $sql .= "as fullname,";
    $sql .= "p.dob,sys.age(p.dob),p.sex, ";
    $sql .= "t.title_sex,t.title_print ";
    $sql .= "from ors.pop p join ors.house h on p.hid=h.hid ";
    $sql .= "join tabdb.title t on p.title = t.title_code ";
    $sql .= "where ";
    $sql .= "p.dob between {$cur_year}0000 and {$cur_year}9999 and p.sex=1 and p.nat=99 ";
    $pop_st = " p.pop_st in (0,4,8,9,15)";
    $sql .= "and {$pop_st} ";
    
    
    $cond .= concatCATM("and h.ccaattmm",$cc,$aa,$tt,$mm);
    if ($cond != ""){
        $cond = substr($cond,0,strlen($cond)-4);
        $sql .=  $cond ;
    }
    
    //$sql .= "order by h.ccaattmm, NLSSORT(fname,'NLS_SORT = THAI_DICTIONARY')";
    //$sql .= "order by h.ccaattmm, p.dob)";
    
    if ($order_by == 'fname' || $order_by == 'lname'){
        $sql .= " order by NLSSORT({$order_by},'NLS_SORT = THAI_DICTIONARY') {$direct}";
    }else{
        $sql .= " order by {$order_by} {$direct}";
    }
          
    $sql2 = iconv('TIS-620','UTF-8',$sql);
  //  echo "sql = ".$sql2."</br>";
    
    try{
        $conn_id = connectORS();
        $stmt = prepare($conn_id,$sql);
        execute($stmt);
     
        $result['num'] = 0;
        while ($row = fetch_array($stmt)) {
            $result['num']++;
            for ($col=0;$col<8;$col++){
                $item = trim($row[$col]);
                //$item = iconv('TIS-620','UTF-8',$item);
                $str .= "{$item}|";
            }
        
        }
      
        if ($result['num'] == 0 ){
            $str_result = "0|";
        }else{
            $str_result = "1|{$result['num']}|{$str}";
        }
        $str_result .= "sql = {$sql}"; 
     
        /*$result['num'] = fetch_all($stmt,$result['row']);
        if ($result['num'] == 0 ){
            $str_result = "0|";
        }else{
            $str_result = "1|{$result['num']}|";
            foreach ($result['row'] as $row) {
                foreach ($row as $item) {
                    $item = trim($item);
                    //$item = iconv('TIS-620','UTF-8',$item);
                    $str_result .= "{$item}|";
                }
            }
        }*/
        $str_result .= "{$sql2}"; 
        //$str_result = "1|".$sql;
        free_statement($stmt);
        close_conn($conn_id);
        return $str_result;
    }catch (Exception $e){
        throw $e;
    }
}

function getListElder($cc, $aa, $tt, $mm, $order_by = "h.ccaattmm, p.dob", $direct = "", $emp_catm=""){
    
    //$sql = "select p.pid,(select title_print from tabdb.title where title_code=p.title),p.fname,p.lname,p.dob,sys.age(p.dob),p.sex from ors.pop p join ors.house h on p.hid=h.hid ";
    $sql = "select p.pid,p.title,p.fname,p.lname,";
    $sql .= "case ";
    $sql .= "when t.title_sex = 4 and p.sex = 1 then t.title_print || p.fname || ' ' || p.lname || '  ร.น.' ";
    $sql .= "when t.title_sex = 4 and p.sex = 2 then t.title_print || 'หญิง' || p.fname || ' ' || p.lname || '  ร.น.' ";
    $sql .= "when t.title_sex = 0 and p.sex = 2 then t.title_print || 'หญิง' || p.fname || ' ' || p.lname ";
    $sql .= "when p.title = 999 or (t.title_sex=5 and p.sex = 1) then (select trim(tm.title_desc) from tabdb.title_monk tm where p.pid = tm.pid) || '(' || p.fname || ' ' || p.lname || ')' ";
    $sql .= "when t.title_sex = 6 and p.sex =1 then 'พระ' || '(' || p.fname || ' ' || p.lname || ')' ";
    $sql .= "else  t.title_print || p.fname || ' ' || p.lname ";
    $sql .= "end ";
    $sql .= "as fullname,";
    $sql .= "p.dob,sys.age(p.dob),p.sex, ";
    $sql .= "t.title_sex,t.title_print ";
    $sql .= "from ors.pop p join ors.house h on p.hid=h.hid ";
    $sql .= "join tabdb.title t on p.title = t.title_code ";
    $sql .= "where ";
    $sql .= "sys.age(p.dob) >= 60 and p.nat=99 ";
    $pop_st = " p.pop_st in (0,4,8,9,15)";
    $sql .= "and {$pop_st} ";
    
    $cond .= concatCATM("and h.ccaattmm",$cc,$aa,$tt,$mm);
    
    if ($cond != ""){
        $cond = substr($cond,0,strlen($cond)-4);
        $sql .=  $cond ;
    }
    
    //$sql .= "order by h.ccaattmm, NLSSORT(fname,'NLS_SORT = THAI_DICTIONARY')";
    //$sql .= "order by h.ccaattmm, p.dob";
    if ($order_by == 'fname' || $order_by == 'lname'){
        $sql .= " order by NLSSORT({$order_by},'NLS_SORT = THAI_DICTIONARY') {$direct}";
    }else{
        $sql .= " order by {$order_by} {$direct}";
    }
     
    //$sql2 = iconv('TIS-620','UTF-8',$sql);
  //  echo "sql = ".$sql2."</br>";
    //return "9|{$sql}  , cc = {$cc}, aa = {$aa}, mm = {$mm}"; 
    try{
        $conn_id = connectORS();
        $stmt = prepare($conn_id,$sql);
        execute($stmt);
       
        $result['num'] = 0;
        while ($row = fetch_array($stmt)) {
            $result['num']++;
            for ($col=0;$col<8;$col++){
                $item = trim($row[$col]);
                //$item = iconv('TIS-620','UTF-8',$item);
                $str .= "{$item}|";
            }
        }
      
        if ($result['num'] == 0 ){
            $str_result = "0|";
        }else{
            $str_result = "1|{$result['num']}|{$str}";
        }
        $str_result .= "sql = {$sql}"; 

        /*
        
        
        $result['num'] = fetch_all($stmt,$result['row']);
        if ($result['num'] == 0 ){
            $str_result = "0|";
        }else{
            $str_result = "1|{$result['num']}|";
            foreach ($result['row'] as $row) {
                foreach ($row as $item) {
                    $item = trim($item);
                    //$item = iconv('TIS-620','UTF-8',$item);
                    $str_result .= "{$item}|";
                }
            }
        }
        $str_result .= "{$sql}"; 
        */
        //$str_result .= "{$sql2}"; 
        //$str_result = "1|".$sql;
        
        free_statement($stmt);
        close_conn($conn_id);
        return $str_result;
    }catch (Exception $e){
        throw $e;
    }
}


?>
