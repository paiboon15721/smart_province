<?php
header ('Content-type: text/html; charset=utf-8');
session_start();
?>
<?php 
require("inc/MySQL/mySQLFunc.php");
require("inc/function.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ข้อมูลการลงประชามติ</title>
<meta name="keywords" content="ข้อมูลการลงประชามติ" />
<meta name="description" content="ข้อมูลการลงประชามติ" />
<link href="css/template_style.css" rel="stylesheet" type="text/css" />
<link href="css/table-style.css"rel="stylesheet" type="text/css" />
<script language="javascript" src="inc/js/jquery.min.js"></script>
<script src="inc/js/poll.js" type="text/javascript"></script>
</head>
<body>
<div id="template_body_wrapper">
	<div id="template_main_wrapper">

      <div id="template_header"> <img src="images/BG_Banner.png" alt="image" />
        <div class="cleaner"></div>
        </div> 
        <!-- end of template_header -->
        
        <div id="template_content_outer">
            <div id="template_content_status">
                <span id="font_status">
                    <div class="status_left"><span id="font_status">ชื่อ - สกุล ผู้ปฏิบัติงาน &nbsp;:&nbsp;<?php echo $_SESSION['EMPNAME']; ?>&nbsp;(<?php echo $_SESSION['EMPID']; ?>)</span></div>
                    <div class="status_right"><?php echo DateThai(); ?></div>
                </span>
			</div>
            <!-- end of template_content_status -->
            
            <div id="template_content_inner" align="center">
           	  <div style="height:10px"></div>
           	  <form action="mainmenu.php" method="post" name="frmHis" class="fontHead" id="frmHis">
              <input type="hidden" name="pollId" id="pollId" />
              <input type="hidden" name="val1" id="val1" />
              <input type="hidden" name="val2" id="val2" />
              <input type="hidden" name="sum" id="sum" />
                <table width="95%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="center"><img src="images/titleHistory.png" width="709" height="57" /></td>
                  </tr>
                  <tr>
                    <td align="left" height="10px"></td>
                  </tr>
                </table>                 
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
                    <!--<tfoot>
                        <tr>
                            <td colspan="5">&nbsp;</td>
                        </tr>
                    </tfoot>-->
                    <tbody>
                <?php
				mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
				$query  = "SELECT * FROM polls ORDER By pollID ASC";
				$result = mysql_query($query);
					while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
						$pollID = $row['pollID'];	
						$pollQuestion = $row['pollQuestion'];	
						/*$pollStatus = $row['pollStatus'];
						$pollAnswerValue	= $row['pollAnswerValue'];
						$pollAnswerPoints    =$row['pollAnswerPoints'];*/
						$query2 = "SELECT pollAnswerID, pollAnswerPoints FROM pollanswers WHERE pollID =".$pollID." GROUP BY pollAnswerID, pollAnswerPoints ORDER BY pollAnswerID ASC, pollAnswerPoints";
						$result2 = mysql_query($query2);
						$idx=1;
						while($row2 = mysql_fetch_array($result2, MYSQL_ASSOC)){
							$pollAnswerID = $row2['pollAnswerID'];
							$ans[$idx] = $row2['pollAnswerPoints'];
							$idx++;
						}
						
				?>
                  <!--<a href="javascript:getDetail(<?php echo $pollID; ?>);">-->
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
                  <!--</a>-->
                
				<?php
					}
				?>
                </tbody>
                </table>
              </form>
              <br />
              <input type="button" name="btExit" id="btExit" value="ออก" onclick="javascript:window.close();"/>
            </div>
             <!-- end of template_content_inner -->  
             
        </div>
         <!-- end of template_content_outer -->
         
        <div id="template_content_bottom">Copyright © 2013 <a href="#">CORE Solutions Ltd.</a></div>
        <!-- end of template_content_bottom -->
        
       <!-- <div id="template_footer">
            Copyright © 2012 <a href="#">CORE Solution Ltd.</a> | Designed by <a href="mailto:championkung@gmail.com">Norrapong Huarakkit (QCM)</a>
        </div> 
        <!-- end of footer -->
        
	   	<div class="cleaner"></div>
    </div>
    <!-- end of template_main_wrapper -->
		<div class="cleaner"></div>
    
</div> <!-- end of template_body_wrapper -->
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
			document.frmHis.action = "hisPollDetail.php";
			document.frmHis.target = "_blank";
			document.frmHis.submit();
		}
	}
</script>
</body>
</html>