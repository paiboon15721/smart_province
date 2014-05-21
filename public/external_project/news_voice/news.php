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
		  
		    // alert("hello");
		  
			 $.fancybox({
                    autoScale   : true,
                    fitToView   : true,
                    autoSize    : false,
                    modal       : false,
                    minWidth    : 1020,
                    minHeight   : '100%',
                    type        : 'iframe',
                    href        : 'news_search.php'

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
	

<div id="contentpopup">
  <div id="welcome" class="post" style="border-bottom: 0px"> 
    <h1 class="title" style="border-bottom: 1px solid #3B3B3B; padding-bottom: 10px"><img src="images/pr1.gif" width="92" height="67" style="border: 0px">การประชาสัมพันธ์จากจังหวัดในการแจ้งประชาสัมพันธ์เสียงตามสาย</h1>
	 <center>
	 <div class="input_cond">
			<input type="button" id="search" name="search" value="ค้นหาข่าวเก่า" >
	 </div>
	 </center>
	<p>
	
    <table width="90%" border="1" align="center" cellspacing="0">
	<?php
	    if ($num_rows==0){   //  no  news
		    echo "<tr bgcolor='#A6FFFF'> ";
			echo "<td width='100%'><center><b>ไม่พบข่าวประชาสัมพันธ์</b></center></td>";
		    echo "</tr>";
		}else{
	?>
      <tr bgcolor="#A6FFFF"> 
        <td width="38%"><b>รายการข่าว</b></td>
        <td width="15%">วันที่/เวลาที่ส่งข่าว</td>
        <!-- td width="13%">กดปุ่มเมื่ออ่านข่าว</td>
        <td width="10%"><b>สถานะการอ่าน</b></td>
        <td width="11%"><b>จำนวนครั้งการอ่าน</b></td -->
        <td width="13%"><b>จำนวนครั้งการเปิด</b></td>
		 <td width="13%"><b>วันที่สุดท้ายของการประชาสัมพันธ์ข่าว</b></td>
      </tr>
	  
	  <?php
	     //$kk =1;
	     while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		     //unset($str[0])
		    $pic_show = $row['pic_no'];
			//unset($pic_show[0]);
		    $path_news = "./temp/".$pic_show;
			//$id_news = "saveopen".$kk;
			//echo $path_news;
	  ?>
      <tr> 
        <td>
		     <div id="<?php echo "tdicon".trim($row['news_id']);?>">
           <?php		          
				  if ( $row['open_count'] ==0 ){
				       echo "<img src='images/warning_icon.gif' width='35' height='35' style='border: 0px'>";
					   
				  }else{
							  echo "<img src='images/news-icon.gif' width='35' height='35' style='border: 0px'>";
				  }
				  ?>
		        </div>
		        <a href="<?php echo $path_news; ?>" class="opennews" id="<?php echo trim($row['news_id']);?>" target="_blank"><?php echo $row['news_desc']; ?></a>
		  </td>
        <td>
		        <?php
				         if(strlen($row['upd_time']) != 6){
						     $tmp_upd_time = "0".$row['upd_time'];
						 }else{
						      $tmp_upd_time = $row['upd_time'];
						 }
				  //  echo "tmp_upd_time".$tmp_upd_time;
				           $yyyy = substr($row['upd_date'],0,4);
						   $mm = substr($row['upd_date'],4,2);
						   $dd = substr($row['upd_date'],6,2);
						   $yyyy = $yyyy +543;
						   
						   $hh = substr($tmp_upd_time,0,2);
						   $mi = substr($tmp_upd_time,2,2);
						   $ss = substr($tmp_upd_time,4,2);
						   echo $dd."/".$mm."/".$yyyy." เวลา ".$hh.":".$mi.":".$ss." น."; 
				  ?>
		 </td>
        <!-- td><input type="submit" name="Submit2" value="อ่านข่าวแล้ว"></td>
        <td>
		         <?php 
				           if ( $row['read_status'] ==0 ){
									echo "ยังไม่ได้อ่าน";
						   }else{
									echo "อ่านแล้ว";
						   }
				    ?>
		  </td>
        <td>
		      <center>
            <a href="#" onClick="window.open('count_read.php?headnews=<?php echo $row['news_desc']; ?>','','width=750,height=500'); return false;"><?php echo $row['datetime_read']; ?></a>
			</center>
			</td -->
         <td>
	        <center>
            <div id="<?php echo "td".trim($row['news_id']);?>">
            <?php echo $row['open_count']; ?>
            </div>
            </center>
	   </td>
	     <td>
	        <center>
            <div id="<?php echo "td".trim($row['news_id']);?>">
            <?php 
				
				  $yyyy = substr($row['expire_news'],0,4);
				  $mm = substr($row['expire_news'],4,2);
				  $dd = substr($row['expire_news'],6,2);
			    	$yyyy = $yyyy +543;
				  echo $dd."/".$mm."/".$yyyy;
			?>
            </div>
            </center>
	   </td>
      </tr>
	  <?php
	       }  //  end while
	  ?>
	     <!--tr> 
        <td>
		     <img src="images/news-icon.gif" width="35" height="35" style="border: 0px">
		     <a href="images/12MAY2010.pdf" target="_blank">จัดตั้งศูนย์รับเรื่องร้องเรียนการทุจริตขององค์กรปกครองท้องถิ่น          </a>
		  </td>
        <td>01/05/2556 14.30 น.</td>
        <td><input type="submit" name="Submit2" value="อ่านข่าวแล้ว"></td>
        <td>อ่านแล้ว</td>
        <td><center>
            <a href="#" onClick="window.open('count_read.php?headnews=จัดตั้งศูนย์รับเรื่องร้องเรียนการทุจริตขององค์กรปกครองท้องถิ่น','','width=750,height=500'); return false;">3</a></center></td>
        <td><center>
            10</center></td>
      </tr>
      <tr> 
        <td><img src="images/warning_icon.gif" width="35" height="35" style="border: 0px"><a href="images/vote.pdf" target="_blank">เชิญชวนไปใช้สิทธิเลือกตั้งสมาชิกผู้แทนราษฎร</a></td>
        <td>05/05/2556 14.30 น.</td>
        <td> <input type="submit" name="Submit" value="อ่านข่าวแล้ว"></td>
        <td>ยังไม่ได้อ่าน</td>
        <td><center>
            0</center></td>
        <td><center>
            5</center></td>
      </tr>
      <tr> 
        <td><img src="images/news-icon.gif" width="35" height="35" style="border: 0px"><a href="images/news1.JPG" target="_blank">โครงการอำเภอยิ้มเคลื่อนที่</a></td>
        <td>06/05/2556 14.30 น.</td>
        <td><input type="submit" name="Submit3" value="อ่านข่าวแล้ว"></td>
        <td>อ่านแล้ว</td>
        <td><center>
            2</center></td>
        <td><center>
            6</center></td>
      </tr -->
	  <?php
	     }//esle  have  news
		 mysql_free_result($result);
	  ?>
    </table>
	
	
	  	</p>
</div>
</div>
