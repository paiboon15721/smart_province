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
<script language="javascript" src="inc/js/jquery.min.js"></script>
<script language="javascript" src="inc/js/jsFunc.js"></script>
<script src="inc/js/poll.js" type="text/javascript"></script>
<style type="text/css">
body {
	background-color: #000000;
}
</style>
</head>
<body>
<form name="pollForm" id="pollForm" method="post" action="inc/addVote.php">
<input name="userPID" type="hidden" id="userPID" value="<?php echo $_POST['userPID']; ?>" />
<input type="hidden" name="answerID" id="answerID" value="" />

<div id="template_body_wrapper">
	<div id="template_main_wrapper">

      <div id="template_header"> <img src="images/BG_Banner.png" alt="image" />
        <div class="cleaner"></div>
        </div> 
        <!-- end of template_header -->
        
        <div id="template_content_outer">
            <div id="template_content_status">
                <span id="font_status">
                    <div class="status_left"><span id="font_status">ชื่อ - สกุล ผู้ลงมติ&nbsp;:&nbsp;<?php echo $_POST['userName']; ?>&nbsp;(<?php echo $_POST['userPID']; ?>)</span></div>
                    <div class="status_right"><?php echo DateThai(); ?></div>
                </span>
			</div>
            <!-- end of template_content_status -->
            
            <div id="template_content_inner">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
					    <td height="30" align="right" valign="bottom" class="pollTotal"><?php echo getVoteTotal(); ?></td>
				      </tr>
			  		</table>
                    <?php 
					if(checkPollActive() == 0){
					?>
                    <script type="text/javascript">
						pollNotActive();
					</script>
                    <?php
					}
					?>
					<?php getPoll(1);?>
            </div>
             <!-- end of template_content_inner -->  
             
        </div>
         <!-- end of template_content_outer -->
         
        <div id="template_content_bottom">Copyright © 2013 <a href="#">CORE Solutions Ltd.</a><!-- | Designed by <a href="mailto:championkung@gmail.com">Norrapong Huarakkit (QCM)</a>-->
        </div>
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
</form>
</body>
<script language="javascript" type="text/javascript">
	function pollNotActive(){
		alert("ไม่พบหัวข้อการลงประชามติ \n กรุณาติดต่อเจ้าหน้าที่");
		javascript:window.location='clearSession.php';
	}
	
	function submitVote(){
		var data=$("#pollForm").serialize();  
		$.post("inc/addVote.php", data, function(dataVote){ //Submit Form ไปที่ไฟล์ inc/addVorte.php  และ รับค่า return ที่ตัวแปร dataVote
			//alert(dataVote);
			var dataSplit = dataVote.split("|");
			if(parseInt(dataSplit[0], 10) == 0){
				alert("ลงประชามติเรียบร้อยแล้ว");
				javascript:window.location='clearSession.php';
			}else{
				alert("เกิดข้อผิดพลาด ในการลงประชามติ");
			}
		});
	}
	

	$("#agree").click(function(){	 //เมื่อกดปุ่ม Vote
		$("#answerID").val(1);
		/*alert('agree');
		alert($("#answerID").val());*/
		submitVote();
	});
	
	$("#disagree").click(function(){	 //เมื่อกดปุ่ม Vote
		$("#answerID").val(2);
		/*alert('disagree');
		alert($("#answerID").val());*/
		submitVote();
	});
	

	/*$("#pollSubmit").click(function(){	 //เมื่อกดปุ่ม Vote
		var selValue = $('input[name=pollAnswerID]:checked').val(); 
		if(typeof(selValue) == 'undefined' || selValue == null){
			selValue = 0;
		}
		//$("#answerID").val(selValue);
		var data=$("#pollForm").serialize();  
		alert(selValue);
		$.post("inc/addVote.php", data, function(dataVote){ //Submit Form ไปที่ไฟล์ inc/addVorte.php  และ รับค่า return ที่ตัวแปร dataVote
			alert(data);
		});
	});*/

</script>
</html>