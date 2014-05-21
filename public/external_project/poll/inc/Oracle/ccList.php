<?php
include "oraFunc.php";
$sql = "select substr(catm_ukey, 1,2) AS CC, catm_desc AS CCDEsc from tabdb.ccaattmm where mod(catm_ukey, 1000000) = 0 order by catm_desc ASC";
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
		
        echo $rowNum."|".$retStr;
	}catch (Exception $e){
		throw $e;
	}
?>