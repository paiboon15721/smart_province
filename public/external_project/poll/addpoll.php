<?php
header ('Content-type: text/html; charset=utf-8');
session_start();
error_reporting( ~(E_NOTICE));
require_once("inc/MySQL/mySQLFunc.php");
require_once("inc/function.php");

if((isset($_GET['insertId'])) && ((int)($_GET['insertId'] > 0))){
	mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
	$query  = "UPDATE tab_polls SET pollStatus = 0";
	$result = mysql_query($query);
	$query  = "UPDATE tab_polls SET pollStatus = 1 WHERE pollID = ".$_GET['insertId'];
	$result = mysql_query($query);
}
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
<div id="template_body_wrapper">
	<div id="template_main_wrapper">
        <div id="template_header">          
        </div> 
        <!-- end of template_header -->
        
        <div id="template_content_outer">
            <div id="template_content_status">
                    <div class="status_left">ชื่อ - สกุล ผู้ปฏิบัติงาน &nbsp;:&nbsp;<?php echo $_SESSION['EMPNAME']; ?>&nbsp;(<?php echo $_SESSION['EMPID']; ?>)</div>
                    <div class="status_right"><?php echo DateThai(); ?></div>
			</div>
            <!-- end of template_content_status -->
            
            <div id="template_content_inner"> 
            	<div id="template_content">
                  <div class="cleaner_h60"></div>
                  <img src="images/titleManagement.png" width="794" height="57"  alt=""/>
                  <div class="cleaner_h20"></div>
<table width="95%" border="1" cellpadding="0" cellspacing="0" class="fontHeadTb">
                  <tr>
                    <td width="10%" height="30" align="center" bgcolor="#007EB7">ลบ</td>
                    <td width="10%" height="30" align="center" bgcolor="#007EB7">ใช้งาน</td>
                    <td width="70%" height="30" align="center" bgcolor="#007EB7">หัวข้อประชามติ</td>
              </tr>
                <?php
				mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
				$query  = "SELECT * FROM polls ORDER By pollID ASC";
				$result = mysql_query($query);
					while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
						$pollID = $row['pollID'];	
						$pollQuestion = $row['pollQuestion'];	
						$pollStatus = $row['pollStatus'];
				?>
                  <tr class="fontDetailTb">
                    <td width="10%" height="30" align="center"> <a href="javascript:delPoll(<?php echo $pollID; ?>);"><img src="images/list_remove.png" name="btnDel" width="25" height="25" border="0" id="btnDel" /></a></td>
                    <td width="10%" height="30" align="center"> <a href="addPoll.php?insertId=<?php echo $pollID; ?>"><?php if($pollStatus == 1){ ?>
                     <img src="images/onebit_34.png" width="25" height="25" border="0" />
                    <?php }else{ ?><img src="images/delete.png" width="25" height="25" border="0" /><?php } ?></a></td>
                    <td width="70%" height="30" align="left">&nbsp;<?php echo $pollQuestion; ?></td>
                  </tr>
                
				<?php
					}
				?>
                </table>
            	</div>
                <!-- end of template_content -->  
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
</form>
</body>
</html>