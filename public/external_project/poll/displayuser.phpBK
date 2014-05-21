<?php
session_start();
require_once("inc/function.php");
if((!isset($_SESSION['votePID'])) && (!isset($_SESSION['voteFLNAME'])) && (!isset($_SESSION['voteADDR']))){
?>
	<script>
	alert('กรุณา Login ก่อนเข้าใช้งานในส่วนนี้');
	window.location = "index.php";
	</script>
<?php
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
                    <div class="status_left"><!--ชื่อ - นามสกุล&nbsp;:&nbsp;นายทดสอบ&nbsp;&nbsp;ระบบงาน-->
                        <input name="userName" type="hidden" id="userName" value="<?php echo $_SESSION['voteFLNAME']; ?>" />
                        <input name="userPID" type="hidden" id="userPID" value="<?php echo $_SESSION['votePID']; ?>" />
                        <input name="catm_menu" type="hidden" id="catm_menu" value="<?php echo $_SESSION['catm_menu']; ?>" />
                        <input name="catm_description" type="hidden" id="catm_description" value="<?php echo $_SESSION['catm_description']; ?>" />
                        <input type="hidden" name="poCATM" id="poCATM" />
                        <input type="hidden" name="poSex" id="poSex" />
                        <input type="hidden" name="poAge" id="poAge" />
                    </div>
                    <div class="status_right"><?php echo DateThai(); ?></div>
			</div>
            <!-- end of template_content_status -->
            
            <div id="template_content_inner"> 
            	<div id="template_content">
                  <div class="cleaner_h60"></div>
                  <div id="login">
                     <div class="cleaner_h90"></div>
                     <div class="displayname">
                       <div class="namelabel">ชื่อ - นามสกุล&nbsp;:</div>
                       <div class="nameprt"><?php echo $_SESSION['voteFLNAME']; ?></div>
                     </div>
                    <div class="cleaner_h40"></div>
                    <div class="displayname">
                       <div class="namelabel">เลขประจำตัวประชาชน&nbsp;:</div>
                       <div class="nameprt"><?php echo $_SESSION['votePID']; ?></div>
                    </div>
                     <div class="cleaner_h50"></div>
                      <div><a href="#" class="m-btn red rnd sm" id="btSubmit" name="btSubmit">เข้าสู่ระบบ</a>&nbsp;<a href="#" class="m-btn red rnd sm" id="btExit">ออกจากระบบ</a></div>
                    </div>
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
<script>
$(document).ready(function() {   
	var validCATM = $('#catm_menu').val(); //26011201; 
	var validCATMDesc = $('#catm_description').val(); //ชื่อหมู่บ้าน รับจาก Menu
	var data=$('#frmPoll').serialize();
	$.post("getPopData.php", data, function(response){
		var dataSplit = response.split("|");
		dataSplit[15] = validCATM;
		if((parseInt(dataSplit[0], 10) == 1) && (parseInt(dataSplit[15], 10) == parseInt(validCATM, 10))){
			$('#poAge').val(dataSplit[8]);
			$('#poSex').val(dataSplit[10]);
			$('#poCATM').val(dataSplit[15]);
			//alert(dataSplit[15]);
			//alert(validCATM);
		}else if(parseInt(dataSplit[15], 10) != parseInt(validCATM, 10)){
			alert("บุคคลนี้ไม่มีสิทธิในการใช้งานระบบประชามติ ของ " + validCATMDesc);
			$("#frmPoll").attr("action", "clearSession.php");
			$("#frmPoll").attr("target", "_parent");
			$("#frmPoll").submit();
		}else{
			alert("ไม่พบบุคคลนี้ในฐานข้อมูลทะเบียนราษฎร");
			$("#frmPoll").attr("action", "clearSession.php");
			$("#frmPoll").attr("target", "_parent");
			$("#frmPoll").submit();
		}
	});
});

$("#btExit").click(function(){
	//closeWin();
		$("#strURL").val('');
		$("#frmPoll").attr("action", "exit.php");
		$("#frmPoll").attr("target", "_parent");
		$("#frmPoll").submit();
});

$("#btSubmit").click(function(){
		$("#frmPoll").attr("action", "listPoll.php");
		$("#frmPoll").attr("target", "_parent");
		$("#frmPoll").submit();
});
</script>
</form>
</body>
</html>