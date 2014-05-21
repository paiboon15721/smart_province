<?php
header ('Content-type: text/html; charset=utf-8');
session_start();
require("inc/MySQL/mySQLFunc.php");
require("inc/function.php");
$voteDate = getVoteDate($_POST['pollID']);
//$curTime = curTime();
$curDate = curDate();

$arrVoteDate = explode("|", $voteDate);
$startDate = formatDateThai($arrVoteDate[0]);
$endDate = formatDateThai($arrVoteDate[1]);
$strTime = "เวลา ".$arrVoteDate[2];
if((int)$arrVoteDate[0] == (int)$arrVoteDate[1]){
	$formatVoteDate = "วัน-เวลา ที่ลงมติ&nbsp;:&nbsp;".$startDate." ".$strTime." น.&nbsp;";
}else{
	$formatVoteDate = "วัน-เวลา ที่ลงมติ&nbsp;:&nbsp;".$startDate." - ".$endDate." ".$strTime." น.&nbsp;";
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
<?php
	$txtPid = str_replace("-", "", $_SESSION['votePID']);
	$query  = sprintf("SELECT count(*) AS totalRow FROM tab_poll_trans WHERE pollID = %d and pid = %s", $_POST['pollID'], $txtPid);
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$totalRow = $row['totalRow'];	
	}
	
	//echo "sdssdsd ==> ".$query;
	
	if($totalRow > 0){
?>
		<script language="javascript" type="text/javascript">
            alert("ท่านได้ทำการลงมติในหัวข้อนี้เรียบร้อยเเล้ว");
            javascript:window.location='clearSession.php';
        </script>
<?php	
	}
	
?>
<form id="frmPoll" name="frmPoll" method="post" action="poll.php">
<input name="userName" type="hidden" id="userName" value="<?php echo $_SESSION['voteFLNAME']; ?>" />
<input name="userPID" type="hidden" id="userPID" value="<?php echo $_SESSION['votePID']; ?>" />
<input name="catm_menu" type="hidden" id="catm_menu" value="<?php echo $_SESSION['catm_menu']; ?>" />
<input name="catm_description" type="hidden" id="catm_description" value="<?php echo $_SESSION['catm_description']; ?>" />
<input type="hidden" name="poCATM" id="poCATM" value="<?php echo $_POST['poCATM']; ?>" />
<input type="hidden" name="poSex" id="poSex" value="<?php echo $_POST['poSex']; ?>" />
<input type="hidden" name="poAge" id="poAge" value="<?php echo $_POST['poAge']; ?>" />
<input type="hidden" name="answerID" id="answerID" value="" />
<input type="hidden" name="curDate" id="curDate" value="<?php echo $curDate; ?>" />

<div id="template_body_wrapper">
	<div id="template_main_wrapper">
        <div id="template_header">          
        </div> 
        <!-- end of template_header -->
        
        <div id="template_content_outer">
            <div id="template_content_status">
                    <div class="status_left">ชื่อ - สกุล ผู้ลงมติ&nbsp;:&nbsp;<?php echo $_POST['userName']; ?>&nbsp;(<?php echo $_POST['userPID']; ?>)</div>
                    <div class="status_right"><?php echo DateThai(); ?></div>
			</div>
            <!-- end of template_content_status -->
            
            <div id="template_content_inner"> 
            	<div id="template_content">
                  <div class="cleaner_h10"></div>
                  <div class="pollDate">&nbsp;<?php echo $formatVoteDate; ?>&nbsp;&nbsp;</div>
                  <div class="cleaner_h10"></div>
                  <div class="pollTotal"><?php echo getVoteTotal(); ?></div>
                  
            	</div>
                <!-- end of template_content -->  
                <?php getPoll($_POST['pollID']);?>
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
	function pollNotActive(){
		alert("ไม่พบหัวข้อการลงประชามติ \n กรุณาติดต่อเจ้าหน้าที่");
		javascript:window.location='clearSession.php';
	}
	
	function submitVote(){
		var data=$("#frmPoll").serialize();  
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
	
$("#btExit").click(function(){
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