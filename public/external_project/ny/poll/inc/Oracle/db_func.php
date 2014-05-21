<?php
//header("Content-Type: text/html; charset=TIS-620");
//putenv("NLS_LANG=THAI_THAILAND.TH8TISASCII"); 
/*
NLS_CHARACTERSET TH8TISASCII 
NLS_NCHAR_CHARACTERSET AL16UTF16 
*/

function connect_db($user,$pass,$con_str,$character_set){
    $conn_id = oci_connect($user,$pass,$con_str,$character_set);
    if 	(!is_resource($conn_id)){
        $err = oci_error();
        throw new Exception($err['message']);
    }
    $conn_id = $conn_id;
    return $conn_id;
}

function prepare($conn_id,$sql){
    $stmt = oci_parse($conn_id,$sql);
    if (!is_resource($stmt)){
        $err = oci_error($conn_id);
        throw new Exception($err['message']);
    }
    $stmt = $stmt;
    return $stmt;
}

function execute($stmt,$mode = OCI_COMMIT_ON_SUCCESS){
/*OCI_COMMIT_ON_SUCCESS 	
OCI_DESCRIBE_ONLY 	
OCI_NO_AUTO_COMMIT*/
    $result =  @oci_execute($stmt,$mode);
    if ($result === FALSE){
        $err = @oci_error($stmt);
        throw new Exception($err['message'] . " => sql : " . $err['sqltext']);
    }
    return;
}

function fetch_array($stmt,$mode = OCI_BOTH){
    $row = oci_fetch_array($stmt, $mode);
    return $row;
}

function fetch_all ($stmt,&$arr_output, $skip = 0, $maxrows = -1){
    $num = oci_fetch_all($stmt,$arr_output,$skip,$maxrows,OCI_FETCHSTATEMENT_BY_ROW);
    if ($num === FALSE){
        $err = @oci_error($stmt);
        throw new Exception($err['message'] . " => sql : " . $err['sqltext']);
    }
    return $num;
}

function get_affect_row($stmt){ 
    $num = oci_num_rows($stmt);
    if ($num === FALSE){
        $err = @oci_error($stmt);
        throw new Exception($err['message'] . " => sql : " . $err['sqltext']);
    }
    return $num;
}

function free_statement($stmt){ 
    $result = @oci_free_statement($stmt);
    if ($result === FALSE){
        $err = @oci_error($stmt);
        throw new Exception($err['message'] . " => sql : " . $err['sqltext']);
    }
   return $result;
}

function commit($conn_id){
    $result = oci_commit($conn_id);
    if ($result === FALSE){
        $err = oci_error($conn_id);
        throw new Exception($err['message']);
    }   
    return $result;
}

function rollback($conn_id){
    $result = oci_rollback($conn_id);
    if ($result === FALSE){
        $err = oci_error($conn_id);
        throw new Exception($err['message']);
    }   
    return $result;
}

function close_conn($conn_id){ 
    $result = oci_close($conn_id);
    if ($result === FALSE){
        $err = oci_error($conn_id);
        throw new Exception($err['message']);
    }   
    return $result;
}

  

?>
