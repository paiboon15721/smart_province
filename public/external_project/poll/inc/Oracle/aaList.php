<?php
require_once("oraFunc.php");
$CC = sprintf("%02d", $_POST['ccList']);
if($CC == 10){
	$aaDesc = "ทุกเขต";
}else{
	$aaDesc = "ทุกอำเภอ";
}
$sql = sprintf("select substr(catm_ukey, 3,2) AS AA, catm_desc from tabdb.ccaattmm where substr(catm_ukey, 1, 2) = '%s' and substr(catm_ukey, 5, 4) = '0000' and flag_area = 2 order by catm_ukey ASC", $CC);
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
	}catch (Exception $e){
		throw $e;
	}
?>