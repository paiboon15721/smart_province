<?php
require_once("oraFunc.php");
/*$CC = sprintf("%02d", $_POST['ccList']);
$AA = sprintf("%02d", $_POST['aaList']);*/
$CCAATT = sprintf("%02d%02d%02d", $_POST['ccList'], $_POST['aaList'], $_POST['ttList']);
$sql = sprintf("select substr(catm_ukey, 7,2) AS MM, catm_desc from tabdb.ccaattmm where substr(catm_ukey, 1, 6) = '%s' and flag_area = 4 order by catm_ukey ASC", $CCAATT);
    try{
        $conn_id = connectORS();
		$stmt = ociparse($conn_id,$sql);   // parse query
		oci_execute($stmt);
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
		//echo $sql;
	}catch (Exception $e){
		throw $e;
	}
?>