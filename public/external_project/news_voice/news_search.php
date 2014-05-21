<head>


<script src="./js/jquery-1.9.1.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="../ors/plugin/css/jquery.fancybox.css" type="text/css" media="screen" charset="utf-8"/>
<script src="../ors/plugin/js/jquery.fancybox.pack.js" type="text/javascript" charset="utf-8"></script>
<script  type="text/javascript">


$(document).ready(function(){
         $(".opennews").click(function(e) {
		    //  alert("saveopen");
			  var me = $(this);
			  //var news_id = $(#)
			   var id = $(me).attr("id");
                           var tdid ="td"+id;
						    var tdicon = "tdicon"+id;
			   //alert("id=" + id);
				
					   $.ajax({
                       global: false,
                       async: true,
                       type: "POST",
                       url: "saveopen.php",
					   data: {"news_id": id},
                       success: function(data) {
					           //  alert(data);
                                                 //     alert(tdid);
								  
							
								$("#" + tdid).text(data);
								   //<img src='images/news-icon.gif' width='35' height='35' style='border: 0px'>
								   if(data == 1){
								    $("#" + tdicon).html('<img src="images/news-icon.gif" width="35" height="35" style="border: 0px">');
									}
								
					          /* var arr_data = data.split('|');
						
							if (arr_data[0] == 99){
						  
								    alert("ไม่สามารถส่งข่าวประชาสัมพันธ์ได้");
								}else{
									 alert("ส่งข่าวประชาสัมพันธ์เรียบร้อย");
									   $('#mytbl tbody').html('');
								}*/
					
						   
                       },
                       error: function(XMLHttpRequest, textStatus, errorThrown) {
                           alert(textStatus + " : " + XMLHttpRequest.status);
                       }
					   
                   });
				
		 });
		 
		  $("#search").click(function(e) {
		  
		     //alert("hello");
			 // var me = $(this);
			  //  var year = $("#year").value;
			//	var month = $("#month").value;
				// var year = $(me).value("year");
				// var month = $(me).value("month");
			//	alert(year);
			//	alert(month);
						   $.ajax({
                       global: false,
                       async: true,
                       type: "POST",
                       url: "news_old.php",
					   data: {year: $('#year').val(),month: $('#month').val()},
                       success: function(data) {
					           //  alert(data);
                                                 //     alert(tdid);
								  
							
								$("#result").html(data);
								   //<img src='images/news-icon.gif' width='35' height='35' style='border: 0px'>
								   //if(data == 1){
								  //  $("#" + tdicon).html('<img src="images/news-icon.gif" width="35" height="35" style="border: 0px">');
								//	}
			
					
						   
                       },
                       error: function(XMLHttpRequest, textStatus, errorThrown) {
                           alert(textStatus + " : " + XMLHttpRequest.status);
                       }
					   
                   });
		
		  });
});
</script>
</head>
<?php
 session_start();
 
   if (isset($_SESSION['catm_login'])){
        $catm = $_SESSION['catm_login'];
    }else{
        $catm = "26000000";
    }
//	echo $_SESSION['catm_menu'];
	  if (isset($_SESSION['catm_menu'])){
        $catm_sel = $_SESSION['catm_menu'];
		// $catm_sel = "26030401";
    }else{
        $catm_sel = "26011201";
    }
//DB CONNECTION START
 if ($_SERVER['SERVER_ADDR'] == "172.16.1.222"){
	$dbhost							= "localhost";
}else{
	$dbhost							= "nrs";
}

/*$dbuser							= "root";
$dbpass							= "usbw";*/
$dbuser							= "mia";
$dbpass							= "mia";
$dbname							= "village_center";

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ("Error connecting to mysql");
mysql_select_db($dbname);

$tmp_cc= substr($catm_sel,0,2);
$tmp_ccaa= substr($catm_sel,0,4);
$tmp_ccaatt= substr($catm_sel,0,6);
//echo "tmp_atm=".$tmp_atm."<br>";

$cc_sel = $tmp_cc."000000";
$ccaa_sel = $tmp_ccaa."0000";
$ccaatt_sel = $tmp_ccaatt."00";

$todaydate = date("Ymd");

//echo "TODAY =".$todaydate."<br>";
  //$catm_sel = "26000000";
  mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
  
   $strSQL= "select * from tab_news_voice  where expire_news >".$todaydate." and ((catm = ".$catm_sel.") or (catm =".$cc_sel.") or (catm =".$ccaa_sel.") or (catm=".$ccaatt_sel.")) ";
	
	//	 echo "strSQL = ".$strSQL."<br>";
		$result = mysql_query($strSQL);
		$num_rows = mysql_num_rows($result);
		// echo "num_rows = ".$num_rows."<br>";
		//$row = mysql_fetch_array($result, MYSQL_ASSOC);
		//$num_news=count($row);
		// echo "num_news = ".$num_news."<br>";
		
	/*	if ($num_rows!=0){
			while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
						//$catm = $row['catm'];	
						echo "catm=".$row['catm']."<br>";
						echo "news_id=".$row['news_id']."<br>";
						echo "news_desc=".$row['news_desc']."<br>";
						echo "upd_date=".$row['upd_date']."<br>";
						echo "upd_time=".$row['upd_time']."<br>";
					    echo "read_status=".$row['read_status']."<br>";
						 echo "datetime_read=".$row['datetime_read']."<br>";
						echo "open_count=".$row['open_count']."<br>";
						echo "-----------------------------------------<br>";
			}
		}*/
			
			
?>
	

<div id="contentpopup1">
<center>
 <select name="year" id="year">
	<option value="2013">----- 2556 ----</option>
	<option value="2014">----- 2557 ----</option>
	<option value="2015">----- 2558 ----</option>
    <option value="2016">----- 2559 ----</option>
    <option value="2017">----- 2560 ----</option>
	 <option value="2018">----- 2561 ----</option>
  </select>
  
  <select name="month"  id="month">
	<option value="01">----- มกราคม ----</option>
	<option value="02">----- กุมภาพันธ์ ----</option>
	<option value="03">----- มีนาคม ----</option>
	<option value="04">----- เมษายน ----</option>
	<option value="05">----- พฤษภาคม ----</option>
	<option value="06">----- มิถุนายน ----</option>
	<option value="07">----- กรกฎาคม ----</option>
	<option value="08">----- สิงหาคม ----</option>
	<option value="09">----- กันยายน ----</option>
	<option value="10">----- ตุลาคม ----</option>
	<option value="11">----- พฤศจิกายน ----</option>
	<option value="12">----- ธันวาคม ----</option>

  </select>
  
  <input type="button" id="search" name="search" value="ค้นหาข่าวเก่า" >
  </center>
</div>
<div id="result">
</div>
