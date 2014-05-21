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
<script language="javascript" src="inc/js/jquery.maxlength.js"></script>
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
           	  <div style="height:10px"></div>
           	  <form method="post" name="frmInsert" class="fontHead" id="frmInsert">
                <table width="95%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="center"><img src="images/titleInsert.png" width="794" height="57" /></td>
                  </tr>
                  <tr>
                    <td align="left" height="20"></td>
                  </tr>
                </table>
                <table width="70%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="30%" height="30" align="right" valign="top" class="titleLabel">หัวข้อประชามติ :&nbsp; </td>
                    <td width="70%" height="30" align="left"><label for="txtReferendum"></label>
                    <textarea name="txtReferendum" id="txtReferendum" cols="50" rows="6"></textarea></td>
                  </tr>
                  <tr>
                    <td height="30" align="right" valign="top">&nbsp;</td>
                    <td height="30" align="right" class="warning">พิมพ์ข้อความได้อีก&nbsp;<div id="cntxt">250</div>&nbsp;อักษร&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

                  </tr>
                  <tr>
                    <td height="30" align="right" valign="top">&nbsp;</td>
                    <td height="50" align="center" class="warning">
                        <input type="button" name="btnInsert" id="btnInsert" value="   เพิ่มหัวข้อ   " />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="button" name="btnCancel" id="btnCancel" value="   ยกเลิก   " />
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="button" name="btExit" id="btExit" value="     กลับ     " onclick="javascript:window.location = 'addPoll.php';"/>
                    </td>
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
                
				<?php
					}
				?>
                </table>
              </form>
              <br />
            <!--<input type="button" name="btAdd" id="btAdd" value="เพิ่มหัวข้อประชามติ" onclick="javascript:window.close();"/>
              &nbsp;&nbsp;&nbsp;--></div>
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
    jQuery(document).ready(function($) {
             //Set maxlength of all the textarea (call plugin)
             $().maxlength();
    })
</script>

<script type="text/javascript">
var n = $("div").length;

$('#txtReferendum').keyup(function () {
  var max = 250;
  var len = $(this).val().length;
  if (len >= max) {
    //$('#cntxt').text(' you have reached the limit');
	$('#cntxt').html(char);
  } else {
    var char = max - len;
	$('#cntxt').html(char);
    //$('#cntxt').text(char + ' characters left');
  }
});

$("#btnCancel").click(function() {
	$('#cntxt').html('250');
	$('#txtReferendum').val('');
});

$("#btnInsert").click(function() {
	//alert("btnInsert");
	var data=$('#frmInsert').serialize();  
	$.post("insertData.php", data, function(dataResponse){ 
		//alert(dataResponse);
		var dataSplit = dataResponse.split("|");
		if(parseInt(dataSplit[0], 10) > 0){
			alert(dataSplit[1]);
		}else{
			alert("ทำการเพิ่มหัวข้อประชามติเรียบร้อยแล้ว");
			window.location = "addPoll.php";
		}
	});
});

</script>

</body>
</html>