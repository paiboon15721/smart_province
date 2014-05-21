<?php
header ('Content-type: text/html; charset=utf-8');
session_start();
?>
<?php 
require("inc/MySQL/mySQLFunc.php");
require("inc/function.php");
$_SESSION['EMPID'] = str_replace("-", "", $_SESSION['EMPID']);
$_SESSION['EMPID'] = formatPID(iconv("TIS-620", "UTF-8",$_SESSION['EMPID']));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ข้อมูลการลงประชามติ</title>
<meta name="keywords" content="ข้อมูลการลงประชามติ" />
<meta name="description" content="ข้อมูลการลงประชามติ" />
<link href="css/template_style.css" rel="stylesheet" type="text/css" />
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
           	  <div style="height:20px"></div>
              <form id="form1" name="form1" method="post" action="">
              
              <table width="525" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="301" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="fontUP">
                    <tr>
                      <td width="100%" height="320" align="center" valign="middle"><img src="images/menu.png" width="516" height="130" border="0" align="absmiddle" usemap="#Map" /></td>
                    </tr>
                  </table></td>
                </tr>
              </table>
              </form>
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


<map name="Map" id="Map"><area shape="rect" coords="384,1,507,129" href="javascript:window.close();" /><area shape="rect" coords="180,1,336,129" href="hisPoll.php" target="_blank" />
  <area shape="rect" coords="1,1,138,129" href="addPoll.php" target="_blank" />
</map>
</body>
</html>