<?php
header ('Content-type: text/html; charset=utf-8');
session_start();
require_once("inc/MySQL/mySQLFunc.php");
require_once("inc/function.php");
$curTime = curTime();
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
<link href="css/table-style.css" rel="stylesheet" type="text/css" />
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
<input type="hidden" name="pollID" id="pollID" />
<input name="userName" type="hidden" id="userName" value="<?php echo $_SESSION['voteFLNAME']; ?>" />
<input name="userPID" type="hidden" id="userPID" value="<?php echo $_SESSION['votePID']; ?>" />
<input name="catm_menu" type="hidden" id="catm_menu" value="<?php echo $_SESSION['catm_menu']; ?>" />
<input name="catm_description" type="hidden" id="catm_description" value="<?php echo $_SESSION['catm_description']; ?>" />
<input type="hidden" name="poCATM" id="poCATM" value="<?php echo $_POST['poCATM']; ?>" />
<input type="hidden" name="poSex" id="poSex" value="<?php echo $_POST['poSex']; ?>" />
<input type="hidden" name="poAge" id="poAge" value="<?php echo $_POST['poAge']; ?>" />
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
                  <div class="cleaner_h20"></div>
                  <img src="images/titleList.png" width="794" height="57"  alt=""/>
                  <div class="cleaner_h10"></div>
				 <table width="80%" align="center" id="newspaper-b" summary="hisPoll">
                    <thead>
                        <tr>
                        <th scope="col">ลำดับที่</th>
                        <th scope="col">หัวข้อประชามติ</th>
                        <th scope="col">ลงมติ</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
				$curTime = curTime();
				$curDate = curDate();
				mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
				//$query  = sprintf("SELECT pollID, pollQuestion FROM tab_polls WHERE catm = %s and datevote_begin <= %s and datevote_end >= %s and timevote_end >= %s ORDER By pollID ASC", $_POST['poCATM'], $curDate, $curDate, $curTime);
				$query  = sprintf("SELECT pollID, pollQuestion, timevote_end FROM tab_polls WHERE catm = %s and datevote_begin <= %s and datevote_end >= %s ORDER By pollID ASC", $_POST['poCATM'], $curDate, $curDate);
				//echo $query;
				$result = mysql_query($query);
				$num_rows = mysql_num_rows($result);
					if((int)$num_rows <= 0){
					?>
                        <script language="javascript" type="text/javascript">
							alert("ไม่พบหัวข้อประชามติ กรุณาติดต่อเจ้าหน้าที่");
							javascript:window.location='clearSession.php';
						</script>
                    <?php
					}
					while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
						$pollID = $row['pollID'];	
						$pollQuestion = $row['pollQuestion'];	
						$timevote_end = $row['timevote_end'];	
						$timevote_end = 99;
						if($timevote_end <= $curTime){
						?>
                        <script language="javascript" type="text/javascript">
							alert("ขณะนี้หมดเวลาลงประชามติ กรุณาลงใหม่ในวันถัดไป");
							javascript:window.location='clearSession.php';
						</script>
						<?php	
							break;
						}
						
						//echo "POLL ==> ".$pollID;
						/*$pollStatus = $row['pollStatus'];
						$pollAnswerValue	= $row['pollAnswerValue'];
						$pollAnswerPoints    =$row['pollAnswerPoints'];*/
						$query2 = "SELECT pollAnswerID, pollAnswerPoints FROM tab_poll_answer WHERE pollID =".$pollID." GROUP BY pollAnswerID, pollAnswerPoints ORDER BY pollAnswerID ASC, pollAnswerPoints";
						//echo "<br>".$query2;
						$result2 = mysql_query($query2);
						$idx=1;
						while($row2 = mysql_fetch_array($result2, MYSQL_ASSOC)){
							$pollAnswerID = $row2['pollAnswerID'];
							$ans[$idx] = $row2['pollAnswerPoints'];
							$idx++;
						}
						
				?>
                  <tr>
                    <td width="10%" align="center"><?php echo $pollID; ?></td>
                    <td width="60%" align="left"><?php echo $pollQuestion; ?></td>
                    <td width="10%" align="center">
                        <a href="javascript:getVote(<?php echo $pollID; ?>);">
                        <img src="images/vote.png" width="57" height="36" border="0" />
                        </a>
                    </td>
                  </tr>
                
				<?php
					}
				?>
                </tbody>
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
<script>
function getVote(pollId){
	$('#pollID').val(pollId);
	var data=$('#frmPoll').serialize();
	
	$("#frmPoll").attr("action", "poll.php");
	$("#frmPoll").attr("target", "_parent");
	$("#frmPoll").submit();
}
</script>
</form>
</body>
</html>