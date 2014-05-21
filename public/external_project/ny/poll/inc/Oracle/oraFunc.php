<?php
include "db_func.php";



function connectORS($character_set = "TH8TISASCII"){
    //$con_str ="nrs:1521/orcl";
	if ($_SERVER['SERVER_ADDR'] == "157.179.24.101"){
			$con_str ="nrs:1521/orcl";
		}else{
			$con_str ="61.19.44.34:1521/xe";
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


function getPidExist($pid){
	$sql = "SELECT distinct(ti.title_print),p.title,p.pid,p.fname,p.mname,p.lname,p.dob,sys.age(p.dob),p.datemi,p.sex,h.hid,h.hno,h.rcode,r.rcode_desc,";
	$sql .= "h.ccaattmm,h.trok,tr.trok_desc,h.soi,s.soi_desc1,	s.soi_desc2,h.thanon,th.tnn_desc,c1.catm_desc as TT ,c2.catm_desc as AA ,c3.catm_desc as CC,h.post_code ";
	$sql .= "FROM ors.pop p , ors.house h , tabdb.rcode r , tabdb.thanon th , tabdb.trok tr, tabdb.soi s , tabdb.title ti , tabdb.ccaattmm c1 , tabdb.ccaattmm c2 ,tabdb.ccaattmm c3 ";
	$sql .= "WHERE p.pid =".$pid." and p.hid = h.hid and h.rcode = r.rcode_code	and tr.trok_ukey(+) = h.rcode||h.trok and s.soi_ukey(+) = h.rcode||h.soi ";
	$sql .= "and th.tnn_ukey(+) = h.rcode||h.thanon and c1.catm_ukey(+) = rpad(SUBSTR(h.ccaattmm, 1, 6), 8, 0) and c2.catm_ukey(+) = rpad(SUBSTR(h.ccaattmm, 1, 4), 8, 0) ";
	$sql .= "and	c3.catm_ukey(+) = rpad(SUBSTR(h.ccaattmm, 1, 2), 8, 0) and ti.title_code = p.title";
	
    try{
        $conn_id = connectORS();
		$stmt = ociparse($conn_id,$sql);   // parse query
		oci_execute($stmt);
		while ($row = oci_fetch_array($stmt, OCI_ASSOC+OCI_RETURN_NULLS)) {
			foreach ($row as $item) {
				$retStr .= iconv('TIS-620','UTF-8',$item)."|";
			}
		}
		$rowNum =  ocirowcount($stmt);  // show the numbers of result 
        free_statement($stmt);
        close_conn($conn_id);
		
        return $rowNum."|".$retStr;
    }catch (Exception $e){
        throw $e;
    }
}

?>