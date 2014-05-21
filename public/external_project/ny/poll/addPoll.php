<?php
header ('Content-type: text/html; charset=utf-8');
session_start();
error_reporting( ~(E_NOTICE));
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
<link href="poll/template/styles.css" rel="stylesheet" type="text/css" />
<script src="inc/js/jquery.min.js"></script>
<script src="inc/js/poll.js" type="text/javascript"></script>
</head>
<body>

<?php
if((isset($_GET['insertId'])) && ((int)($_GET['insertId'] > 0))){
	mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
	$query  = "UPDATE polls SET pollStatus = 0";
	$result = mysql_query($query);
	$query  = "UPDATE polls SET pollStatus = 1 WHERE pollID = ".$_GET['insertId'];
	$result = mysql_query($query);
}
?>
<div id="template_body_wrapper">
	<div id="template_main_wrapper">

      <div id="template_header">
		<a href="http://www.template.com" target="_parent"><img src="images/BG_Banner.png" alt="image" /></a>
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
           	  <div style="height:50px"></div>
           	  <form action="mainmenu.php" method="post" name="frmPoll" class="fontHead" id="frmPoll">
              <input name="pollID" id="pollID" type="hidden" value="0" />
                <table width="95%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="center"><img src="images/titleManagement.png" width="794" height="57" /></td>
                  </tr>
                  <tr>
                    <td align="left" height="10px"></td>
                  </tr>
                </table>
                <table width="95%" border="1" cellpadding="0" cellspacing="0" class="fontHeadTb">
                  <tr>
                    <!--<td width="10%" height="30" align="center" bgcolor="#007EB7">แก้ไข</td>-->
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
                    <!--<td width="10%" height="30" align="center"><img src="images/pencil.png" width="25" height="25" /></td>-->
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
              </form>
              <br />
              <input type="button" name="btAdd" id="btAdd" value="เพิ่มหัวข้อประชามติ" onclick="javascript:window.location = 'addNewPoll.php';"/>
              &nbsp;&nbsp;&nbsp;
              <input name="btExit" type="button" id="btExit" onclick="javascript:window.close();" value="ออก"/>
            </div>
             <!-- end of template_content_inner -->  
             
        </div>
         <!-- end of template_content_outer -->
         
        <div id="template_content_bottom">
        Copyright © 2012 <a href="#">CORE Solution Ltd.</a></div>
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
<script type="text/javascript">
function delPoll(pollID){
	$("#pollID").val(pollID);
	var data=$('#frmPoll').serialize();  
	$.post("delData.php", data, function(dataResponse){ 
		var dataSplit = dataResponse.split("|");
		alert("ทำการลบหัวข้อประชามติ เรียบร้อยแล้ว");
		window.location = "addPoll.php";
	});
}
</script>

</body>
</html>