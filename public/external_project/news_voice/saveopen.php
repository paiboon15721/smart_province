<?php

//echo "111111111111111111111<br>";
//DB CONNECTION START


 if ($_SERVER['SERVER_ADDR'] == "172.16.1.222"){
	$dbhost							= "localhost";
}else{
	$dbhost							= "nrs";
}

$dbuser							= "mia";
$dbpass							= "mia";
$dbname							= "village_center";


$news_id=$_POST["news_id"];
//echo "news_id = ".$news_id;

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ("Error connecting to mysql");
mysql_select_db($dbname);
 mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
//echo "connect base success";

        $strSQL= "select open_count from tab_news_voice  where news_id = '".$news_id."'";
        $result = mysql_query($strSQL);
	//	echo "strSQL= ".$strSQL;
		$num_rows = mysql_num_rows($result);
		//echo "num_rows= ".$num_rows;
        if ($num_rows!=0){
			while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			    // 	echo "open_count=".$row['open_count'];
					$open_count=$row['open_count'];
             }
         }			 
		  mysql_free_result($result);
		  $open_count= $open_count+1;
		  
		  
	    $strSQLUpd = "update  tab_news_voice  set  open_count=".$open_count." where news_id = '".$news_id."'";
	//	 echo "strSQLUpd = ".$strSQLUpd;
		 
		$objQuery = mysql_query($strSQLUpd);
		
		 if (!$objQuery) {
				die('Invalid query: ' . mysql_error());
         }else{
					echo $open_count;
		 }
		
	/**	if(mysql_affected_rows() <= 0){ //-- Insert ERROR
			//rollBack($conn);
			echo "99|Error, Insert poll failed|";
			return;
		}**/
	
	
	
	
?>
