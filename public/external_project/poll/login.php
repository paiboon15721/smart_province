<?php
header ('Content-type: text/html; charset=utf-8');
session_start();
error_reporting( ~(E_NOTICE));
require_once("inc/function.php");
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
<input type="hidden" name="chkLogin" id="chkLogin" value="<?php echo $chkSession; ?>" />
<input type="hidden" name="strURL" id="strURL" value="<?php echo curPageURL();?>" />
<input name="userName" type="hidden" id="userName" value="<?php echo $_SESSION['voteFLNAME']; ?>" />
<input name="userPID" type="hidden" id="userPID" value="<?php echo $_SESSION['votePID']; ?>" />
<input name="successURL" type="hidden" id="successURL" />
<input name="errorURL" type="hidden" id="errorURL"  />

<div id="template_body_wrapper">
	<div id="template_main_wrapper">
        <div id="template_header">          
        </div> 
        <!-- end of template_header -->
        
        <div id="template_content_outer">
            <div id="template_content_status">
                    <div class="status_left"><!--ชื่อ - นามสกุล&nbsp;:&nbsp;นายทดสอบ&nbsp;&nbsp;ระบบงาน--> </div>
                    <div class="status_right"><?php echo DateThai(); ?></div>
			</div>
            <!-- end of template_content_status -->
            
            <div id="template_content_inner"> 
            	<div id="template_content">
                  <div class="cleaner_h60"></div>
                  <div id="login">
                     <div class="cleaner_h90"></div>
                     <div><a href="#" class="m-btn red rnd sm smartcard" id="btSMC" name="btSMC">อ่านบัตรสมาร์ทการ์ด</a></div>
                    <!--<div class="cleaner_h30"></div>-->
                    <br />
                    <br />
                    <br />
                    <div><a href="#" class="m-btn red rnd sm smartcard" id="btExitPrg" name="btExitPrg">ออกจากระบบ</a></div>
                     
                     <div class="cleaner_h10"></div>
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
$("#btSMC").click(function() {
		<?php
		$successURL = curPageURL()."setVoteUser.php";
		$errorURL = curPageURL()."clearSession.php";
		$qstr = sprintf("../signin/signin.application?ACT_FLAG='%s'&ACT_FLAG_CANCEL='%s'", $successURL, $errorURL);
		$url = "signin.php?successURL=".$successURL."&errorURL=".$errorURL;
		//header("Location: " . $qstr);
		?>
/*		window.location = "<?php echo $qstr; ?>";
		setTimeout(function(){closeWin();},100);*/
		$('#successURL').val('<?php echo $successURL; ?>');
		$('#errorURL').val('<?php echo $errorURL; ?>');
		$("#frmPoll").attr("action", "signin.php");
		$("#frmPoll").attr("target", "_parent");
		$("#frmPoll").submit();
		setTimeout(function(){closeWin();},100);
});

$("#btExitPrg").click(function(){
	//closeWin();
		$("#strURL").val('');
		$("#frmPoll").attr("action", "exit.php");
		$("#frmPoll").attr("target", "_parent");
		$("#frmPoll").submit();
});
</script>
</form>
</body>
</html>