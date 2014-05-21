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


$news_all=$_POST["news"];
$head_all=$_POST["headnews"];
$catm_save=$_POST["catm_save"];
$expirenews_all=$_POST["expirenews"];
$upd_emp ="9999999999999";

$num_news = count($news_all);
$todaydate = date("Ymd");
$todaytime = date("His"); 
   //echo "num_news = ".$num_news;
/*for($i=0;$i<$num_news ;$i++)  {
   echo "news_all = ".$news_all[$i];
   $news_id = explode(".",$news_all[$i]);
   echo "head_all = ".$head_all[$i];
   echo "expirenews_all = ".$expirenews_all[$i];
  }
  
  echo "catm_save".$catm_save;
  */

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ("Error connecting to mysql");
mysql_select_db($dbname);
 mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
//echo "connect base success";
for($i=0;$i<$num_news ;$i++)  {

  //     echo "news_all = ".$news_all[$i];
   $news_id = explode(".",$news_all[$i]);
 //  echo "news_id = ".$news_id[0];
  // echo "head_all = ".$head_all[$i];
    
	   $dd = substr( $expirenews_all[$i],0,2);
	   $mm = substr( $expirenews_all[$i],2,2);
	   $yyyy = substr( $expirenews_all[$i],4,4);
       $yyyy = $yyyy -543;
	    $tmp_expirenews = $yyyy.$mm.$dd;
		
	 // echo "tmp_expirenews = ".$tmp_expirenews;
 
	    $strSQLInsert = "INSERT INTO tab_news_voice ";
		$strSQLInsert .="(catm, news_id, news_desc, pic_no, open_count, read_status, datetime_read, emp_read, upd_date, upd_time, upd_emp,expire_news) ";
		$strSQLInsert .="VALUES ";
		$strSQLInsert .="(".$catm_save.",'".trim($news_id[0])."','".$head_all[$i]."', '".$news_all[0]."', 0,0,0,0,".$todaydate.",".$todaytime.",".$upd_emp.",".$tmp_expirenews.")";
		//$strSQLInsert .="(".$catm_save.",' ".$news_id[0]." ',' ".$head_all[$i-1]." ',".$news_id[0].".".$news_id[1].", 0,0,0,0,".$todaydate.",".$todaytime.",".$upd_emp.")";
 //echo "strSQLInsert = ".$strSQLInsert;
		$objQuery = mysql_query($strSQLInsert);
		
		if(mysql_affected_rows() <= 0){ //-- Insert ERROR
			//rollBack($conn);
			echo "99|Error, Insert tab_news_voice failed|";
			return;
		}
	}
	
?>
