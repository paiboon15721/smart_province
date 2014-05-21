<?php
header ('Content-type: text/html; charset=utf-8');
session_start();
error_reporting( ~(E_NOTICE));
?>
<?php 
require("inc/MySQL/mySQLFunc.php");
require("inc/function.php");

function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 $pageURL = str_replace("index.php","",$pageURL);
 return $pageURL;
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
<!--<link href="poll/template/styles.css" rel="stylesheet" type="text/css" />-->
<script language="javascript" src="inc/js/jquery.min.js"></script>
<script src="inc/js/poll.js" type="text/javascript"></script>
<style type="text/css">
body {
	background-color: #000000;
}
</style>
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
                    <div class="status_left"><!--<span id="font_status">ชื่อ - นามสกุล&nbsp;:&nbsp;นายทดสอบ&nbsp;&nbsp;ระบบงาน</span>--></div>
                    <div class="status_right"><?php echo DateThai(); ?></div>
                </span>
			</div>
            <!-- end of template_content_status -->
            
            <div id="template_content_inner" align="center">
           	  <div style="height:70px"></div>
              <form id="frmPoll" name="frmPoll" method="post" action="poll.php">
              
              <table width="400" border="0" cellspacing="0" cellpadding="0" background="images/loginNormal.png">
                <tr>
                  <td height="247" valign="top">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="fontUP">
                    <tr>
                      <td height="70">
                      	<?php 
							$chkSession = 0;
							if((!isset($_SESSION['votePID'])) && (!isset($_SESSION['voteFLNAME'])) && (!isset($_SESSION['voteADDR']))){
									$chkSession = 0;
							}else{
									$chkSession = 1;
							}
						?>
                      	<input type="hidden" name="chkLogin" id="chkLogin" value="<?php echo $chkSession; ?>" />
                        <input type="hidden" name="strURL" id="strURL" value="<?php echo curPageURL();?>" />
						<input name="userName" type="hidden" id="userName" value="<?php echo $_SESSION['voteFLNAME']; ?>" />
						<input name="userPID" type="hidden" id="userPID" value="<?php echo $_SESSION['votePID']; ?>" />
                      </td>
                    </tr>
                    <tr>
                      <td align="center" height="35" id="loginUser">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="fontUP">
                            <tr>
                              <td height="30" align="center"><?php //echo curPageURL();?></td>
                            </tr>
                            <!--<tr>
                              <td height="30" align="center"><input name="txtUser" type="text" class="fontHead" id="txtUser" value="" size="21" maxlength="17" /></td>
                            </tr>-->
                            <tr>
                              <td width="100%" height="30" align="center"><input type="button" name="btSMC" id="btSMC" value="อ่านบัตรสมาร์ทการ์ด" />
                              <!--<label for="txtPID"></label>
                              <input name="txtPID" type="text" id="txtPID" size="20" maxlength="17" />--></td>
                            </tr>
                            <tr>
                              <td height="10" align="center"></td>
                            </tr>
                            <tr>
                              <td height="30" align="center"><input type="button" name="btExitPrg" id="btExitPrg" value="ออกจากโปรแกรม" /></td>
                            </tr>
                          </table>
                      </td>
                    </tr>
                    <tr>
                      <td align="center" height="35" id="displayUser">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="fontUP">
                            <tr>
                              <td height="20" colspan="2" align="center"></td>
                            </tr>
                            <tr>
                              <td width="45%" height="40" align="right" class="fontUserTitle">เลขประจำตัวประชาชน&nbsp;:&nbsp;</td>
                              <td width="55%" height="40" align="left" class="fontUser"><?php echo $_SESSION['votePID']; ?></td>
                            </tr>
                            <tr>
                              <td width="45%" height="40" align="right" class="fontUserTitle">ชื่อ - สกุล&nbsp;:&nbsp;</td>
                              <td width="55%" height="40" align="left" class="fontUser"><?php echo $_SESSION['voteFLNAME']; ?>
							  </td>
                            </tr>
                          </table>
                      </td>
                    </tr>
                    <tr>
                      <td align="right" height="20"></td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="fontUP" id="btControl">
                    <tr>
                        <td height="30" align="center"><input type="submit" name="btLogin" id="btLogin" value="เข้าสู่ระบบ" />
                          &nbsp;
                         <input name="btReset" type="button" id="btReset" value="ยกเลิก"/>
                          &nbsp;
                          <input type="button" name="btExit" id="btExit" value="ออก" />
                          </td>
                    </tr>
                  </table></td>
                </tr>
              </table>
              <p>&nbsp;</p>
              </form>
            </div>
             <!-- end of template_content_inner -->  
             
        </div>
         <!-- end of template_content_outer -->
         
        <div id="template_content_bottom">
        <!--Copyright © 2012 <a href="#">CORE Solution Ltd.</a> | Designed by <a href="mailto:championkung@gmail.com">Norrapong Huarakkit (QCM)</a>-->
        Copyright © 2013 <a href="#">CORE Solutions Ltd.</a></div>
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
<script language="javascript" src="inc/js/jsFunc.js"></script>
<script>

$(document).ready(function() {   
		if($("#chkLogin").val() == 0){
			$("#txtUser").val('');
			$("#loginUser").show();
			$("#displayUser").hide();
			$("#btControl").hide();
		
		}else{
			
			var data=$('#frmPoll').serialize();  
			//var validCATM = 73010100;
			var validCATM = 26011201;
			
			$("#txtUser").val('');
			$("#loginUser").show();
			$("#displayUser").hide();
			$("#btControl").hide();
		
				$.post("getPopData.php", data, function(response){ //Submit Form ไปที่ไฟล์ getPopData.php  และ รับค่า return ที่ตัวแปร response
					//alert(response);
					var dataSplit = response.split("|");
					dataSplit[15] = validCATM; //Fix ค่าให้ใช้งานได้ทุกคน
					if((parseInt(dataSplit[0], 10) == 1)&&(parseInt(dataSplit[15], 10) == validCATM)){
						$.post("getExistVote.php", data, function(dataVote){ //Submit Form ไปที่ไฟล์ getExistVote.php  และ รับค่า return ที่ตัวแปร dataVote
							//alert(dataVote);
							if(parseInt(dataVote, 10) > 0){
								alert("บุคคลนี้ได้ทำการลงมติในหัวข้อนี้เรียบร้อยเเล้ว");
								$("#chkLogin").val(0);
							}else{
								$("#txtUser").val('');
								$("#loginUser").hide();
								$("#displayUser").show();
								$("#btControl").show();
							}
						});
					}else if(parseInt(dataSplit[15], 10) != validCATM){
						alert("บุคคลนี้ไม่มีสิทธิในการใช้งานระบบประชามติ");
						$("#chkLogin").val(0);
					}else{
						alert("ไม่พบบุคคลนี้ในฐานข้อมูลทะเบียนราษฎร");
						$("#chkLogin").val(0);
					}
			 });
		}

});

$("#btSMC").click(function() {
		//$("#txtUser").val('3-1002-00326-30-2');
		/*$("#loginUser").hide();
		$("#displayUser").show();
		$("#btControl").show();*/
		//$("#frmPoll").attr("action", "signIn/Signin.application");
		$("#frmPoll").attr("action", "signIn/signin.application");
		$("#frmPoll").attr("method", "GET");
		$("#frmPoll").attr("target", "_parent");
		//$("#frmPoll").submit();
		window.location = "../signin/signin.application?ACT_FLAG='<?php echo curPageURL()."setVoteUser.php";?>'&ACT_FLAG_CANCEL='<?php echo curPageURL()."clearSession.php";?>'";
		//window.location = "signIn/Signin.application?strURL='".<?php echo curPageURL();?>."'&sdsdsd='sdsd'";
		setTimeout(function(){closeWin();},100);
	});

$("#btReset").click(function(){
		/*$("#txtUser").val('');
		$("#loginUser").show();
		$("#displayUser").hide();
		$("#btControl").hide();*/
		$("#strURL").val('');
		$("#frmPoll").attr("action", "clearSession.php");
		$("#frmPoll").attr("target", "_blank");
		$("#frmPoll").submit();
		setTimeout(function(){closeWin();},100);
		//window.location = "clearSession.php";
});

$("#btExit").click(function(){
	//closeWin();
		$("#strURL").val('');
		$("#frmPoll").attr("action", "exit.php");
		$("#frmPoll").attr("target", "_parent");
		$("#frmPoll").submit();
});

$("#btExitPrg").click(function(){
	//closeWin();
		$("#strURL").val('');
		$("#frmPoll").attr("action", "exit.php");
		$("#frmPoll").attr("target", "_parent");
		$("#frmPoll").submit();
});

$("#txtPID").bind('keypress',function(e){ 	 //เติม - ให้รหัสประจำตัวประชาชน
 var key = e.which;
	  PidDash(document.frmPoll.txtPID);
	  return CheckNumKey(key);
  //alert(e.type + ': ' +  e.which );
});

</script>


</body>
</html>