<?php
header ('Content-type: text/html; charset=utf-8');
session_start(); 
require("inc/MySQL/mySQLFunc.php");
require("inc/function.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ข้อมูลการลงประชามติ</title>
<meta name="keywords" content="ข้อมูลการลงประชามติ" />
<meta name="description" content="ข้อมูลการลงประชามติ" />
<link href="css/template_style.css" rel="stylesheet" type="text/css" />
<link href="css/m-buttons.css" rel="stylesheet" type="text/css" />
<link href="css/table-style.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="inc/js/jquery.min.js"></script>
<script src="inc/js/poll.js" type="text/javascript"></script>
<style type="text/css">
body {
	background-color: #000000;
}
</style>
</head>
<body>
<form id="frmPoll" name="frmPoll" method="post" action="poll.php">
<input type="hidden" name="pollId" id="pollId" />
<input type="hidden" name="val1" id="val1" />
<input type="hidden" name="val2" id="val2" />
<input type="hidden" name="sum" id="sum" />
<div id="template_body_wrapper">
	<div id="template_main_wrapper">
        <div id="template_header">          
        </div> 
        <!-- end of template_header -->
        
        <div id="template_content_outer">
            <div id="template_content_status">
                    <div class="status_left">ชื่อ - นามสกุล&nbsp;:&nbsp;นายทดสอบ&nbsp;&nbsp;ระบบงาน</div>
                    <div class="status_right">วันที่ปัจจุบัน</div>
			</div>
            <!-- end of template_content_status -->
            
            <div id="template_content_inner"> 
            	<div id="template_content">
                  <div class="cleaner_h30"></div>
                  <img src="images/titleHistory.png" width="709" height="57"  alt=""/>
                  <div class="cleaner_h20"></div>
				 <table width="95%" id="newspaper-b" summary="hisPoll">
                    <thead>
                        <tr>
                        <th scope="col">ลำดับที่</th>
                        <th scope="col">หัวข้อประชามติ</th>
                        <th scope="col">เห็นด้วย</th>
                        <th scope="col">ไม่เห็นด้วย</th>
                        <th scope="col">กราฟ</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
				mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
				$query  = "SELECT pollID, pollQuestion FROM tab_polls ORDER By pollID ASC";
				$result = mysql_query($query);
					while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
						$pollID = $row['pollID'];	
						$pollQuestion = $row['pollQuestion'];	
						/*$pollStatus = $row['pollStatus'];
						$pollAnswerValue	= $row['pollAnswerValue'];
						$pollAnswerPoints    =$row['pollAnswerPoints'];*/
						$query2 = "SELECT pollAnswerID, pollAnswerPoints FROM tab_poll_answer WHERE pollID =".$pollID." GROUP BY pollAnswerID, pollAnswerPoints ORDER BY pollAnswerID ASC, pollAnswerPoints";
						$result2 = mysql_query($query2);
						$idx=1;
						while($row2 = mysql_fetch_array($result2, MYSQL_ASSOC)){
							$pollAnswerID = $row2['pollAnswerID'];
							$ans[$idx] = $row2['pollAnswerPoints'];
							$idx++;
						}
						
				?>
                  <tr>
                    <td width="10%" align="center"><?php echo $pollID; ?></td>
                    <td width="60%" align="left"><?php echo $pollQuestion; ?></td>
                    <td width="10%" align="center"><?php echo $ans[1]; ?></td>
                    <td width="10%" align="center"><?php echo $ans[2]; ?></td>
                    <td width="10%" align="center">
                        <a href="javascript:getDetail(<?php echo $pollID; ?>, <?php echo $ans[1]; ?>, <?php echo $ans[2]; ?>);">
                        <img src="images/pie_chart.png" width="32" height="32" border="0" />
                        </a>
                    </td>
                  </tr>
                
				<?php
					}
				?>
                </tbody>
                </table>
                  
           	  </div>
                <!-- end of template_content -->  
                <div align="center"><a href="javascript:window.close();" class="m-btn red rnd sm">ออก</a></div>
            </div>
             <!-- end of template_content_inner -->  
             
        </div>
         <!-- end of template_content_outer -->       
       <div id="template_footer">
            Copyright © 2013 CORE Solutions Ltd.
        </div> 
        <!-- end of footer -->
        </div>
    <!-- end of template_main_wrapper -->
		<div class="cleaner"></div>
    
</div> <!-- end of template_body_wrapper -->
<script language="javascript" src="inc/js/jsFunc.js"></script>
<script language="javascript" type="text/javascript">
	function getDetail(id, val1, val2){
		var sum = parseInt(val1, 10) + parseInt(val2, 10)
		if(parseInt(sum, 10) <= 0){
			alert("ยังไม่มีผู้ลงมติในหัวข้อนี้");
		}else{		
			$("#pollId").val(id);
			$("#val1").val(val1);
			$("#val2").val(val2);
			$("#sum").val(sum);
			document.frmPoll.action = "hisPollDetail.php";
			document.frmPoll.target = "_blank";
			document.frmPoll.submit();
		}
	}
</script>
</form>
</body>
</html>