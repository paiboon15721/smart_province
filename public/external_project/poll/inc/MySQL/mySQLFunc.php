<?php
require("mySQLdb.php");
error_reporting( ~(E_NOTICE));
//GETTING VARIABLES START
if (isset($_POST['action'])) {
	$action 		= mysql_real_escape_string($_POST['action']);
}
if (isset($_POST['pollAnswerID'])) {
	$pollAnswerID	= mysql_real_escape_string($_POST['pollAnswerID']); 
}
//GETTING VARIABLES END

function getPidExistVote($pid, $pollId){
	mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
	/*	$query  = sprintf("SELECT pollID FROM tab_poll_answer WHERE tab_polls.pollId = %s", $pollId);
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$pollID = $row['pollID'];	
	}*/
	
	$query  = sprintf("SELECT count(*) AS totalRow FROM tab_poll_trans WHERE pollID = %d and pid = %s", $pollId, $pid);
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$totalRow = $row['totalRow'];	
	}
	
	echo $totalRow;	
}

function addVote($pid, $answerID, $pollID, $sex, $age, $curDate){
	mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
	$query  = "UPDATE tab_poll_answer SET pollAnswerPoints = pollAnswerPoints + 1 WHERE pollAnswerID = ".$answerID." and pollID = ".$pollID."";
	mysql_query($query);
	
	if(mysql_affected_rows()){ //-- database has been changed 
		$sql = sprintf("INSERT INTO `tab_poll_trans` (`pid`, `pollID`, `pollanswerid`, `sex`, `age`, `upd_date`, `upd_emp`) VALUES (%s,%d,%d, %s,%s, %s,0)", $pid, $pollID, $answerID, $sex , $age, $curDate);
		mysql_query($sql);
		if(mysql_affected_rows()){ //-- database has been changed 
			echo "0|Vote Success|$sql|".mysql_affected_rows()."|";
		}else{
			echo "99|Error, Insert pollTrans failed|";
		}
		//echo $sql;
	}else{
		echo "99|Error, Update pollanswers failed|";
	}
}

function getVoteName($id){
	mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
	$query  = "SELECT pollQuestion FROM tab_polls WHERE pollID=".$id;
	$result = mysql_query($query);
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	$voteName = $row['pollQuestion'];
	return $voteName;
}

function getVoteTotal(){
	mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
	$query  = "select sum(pollAnswerPoints) AS sumScore from tab_poll_answer where pollId = (select pollId from tab_polls where pollStatus = 1)";
	//echo $query;
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$sumTotal = $row['sumScore'];	
	}
	$displayTxt =  "จำนวนคนที่มาลงประชามติ ณ. ขณะนี้&nbsp;".$sumTotal."&nbsp;คน&nbsp;&nbsp;";
	return $displayTxt; //iconv('TIS-620','UTF-8',$displayTxr);
}

function getVoteDate($pollId){
	mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
	$query  = sprintf("select datevote_begin, datevote_end, timevote_begin, timevote_end from tab_polls where pollId = %s", $pollId);
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$dateStart = $row['datevote_begin'];	
		$dateEnd = $row['datevote_end'];	
		$timeStart = $row['timevote_begin'];	
		$timeEnd = $row['timevote_end'];	
	}
	$formatTime = $timeStart .":00 - ".$timeEnd.":00"; 
	$sendData =  $dateStart ."|".$dateEnd ."|".$formatTime ."|";
	return $sendData; //iconv('TIS-620','UTF-8',$displayTxr);
	//return $query;
}

function getPoll($pollID){
	mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
	//$query  = "SELECT * FROM polls LEFT JOIN pollanswers ON polls.pollID = pollanswers.pollID WHERE polls.pollStatus = 1 ORDER By pollAnswerListing ASC";
	$query = sprintf("SELECT pollQuestion, pollAnswerID, pollAnswerValue,  tab_polls.pollID FROM tab_polls LEFT JOIN tab_poll_answer ON tab_polls.pollID = tab_poll_answer.pollID WHERE tab_polls.pollID = %s", $pollID);
	$result = mysql_query($query);
	//echo $query;
	
	$pollStartHtml = '';
	$pollAnswersHtml = '';
?>
<script type="text/javascript">
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>
<body onLoad="MM_preloadImages('../../images/disagreeOver.png','../../images/agreeOver.png')">
	<br>
    <!--<form name="pollForm" method="post" action="inc/mySQLFunc.php?action=vote">-->
 

<?php	
	$fetchNum = 0;
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		
		$pollQuestion 		= $row['pollQuestion'];	
		$pollAnswerID 		= $row['pollAnswerID'];	
		$pollAnswerValue	= $row['pollAnswerValue'];
		$pollID	= $row['pollID'];
		
		if($fetchNum == 0){
?>
			<input type="hidden" name="pollID" id="pollID" value="<?php echo $pollID; ?>" />
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td height="80px" align="center" id="pollQuest"><?php echo $pollQuestion; ?></td>
            </tr>
            <tr>
              <td>
                  <table width="450" border="0" align="center" cellpadding="0" cellspacing="0">
<?php
		}
		$fetchNum++;
	}
?>

                    <tr class="pollAns">
                      <td width="50%" height="40" align="center" valign="middle"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('agree','','images/agreeOver.png',1)"><img src="images/agree.png" alt="เห็นด้วย" name="agree" width="198" height="198" border="0" id="agree" /></a></td>
                      <td width="50%" height="40" align="center" valign="middle"><a href="#" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('disagree','','images/disagreeOver.png',1)"><img src="images/disagree.png" alt="ไม่เห็นด้วย" name="disagree" width="198" height="198" border="0" id="disagree" /></a>&nbsp;&nbsp;</td>
                    </tr>
                    
              </table>
          </td>
        </tr>
            <tr>
              <td height="20" align="center" valign="middle">&nbsp;</td>
            </tr>
            <tr>
              <td align="center" valign="middle">
                  <!--<div align="center">
                  <a href="#"><img src="images/vote.png" name="pollSubmit" width="156" height="49" border="0" id="pollSubmit" /></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#"><img src="images/exit.png" name="pollExit" width="156" height="49" border="0" id="pollExit" onClick="javascript:window.location='clearSession.php'" /></a>
                  </div>-->
              </td>
            </tr>
      </table>
<?php
}

function getPollID($pollAnswerID){
	$query  = "SELECT pollID FROM tab_poll_answer WHERE pollAnswerID = ".$pollAnswerID." LIMIT 1";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	
	return $row['pollID'];	
}

function getPollResults($pollID){
	$colorArray = array(1 => "#ffcc00", "#00ff00", "#cc0000", "#0066cc", "#ff0099", "#ffcc00", "#00ff00", "#cc0000", "#0066cc", "#ff0099");
	$colorCounter = 1;
	$query  = "SELECT pollAnswerID, pollAnswerPoints FROM tab_poll_answer WHERE pollID = ".$pollID."";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result))
	{
		if ($pollResults == "") {
			$pollResults = $row['pollAnswerID'] . "|" . $row['pollAnswerPoints'] . "|" . $colorArray[$colorCounter];
		} else {
			$pollResults = $pollResults . "-" . $row['pollAnswerID'] . "|" . $row['pollAnswerPoints'] . "|" . $colorArray[$colorCounter];
		}
		$colorCounter = $colorCounter + 1;
	}
	$query  = "SELECT SUM(pollAnswerPoints) FROM tab_poll_answer WHERE pollID = ".$pollID."";
	$result = mysql_query($query);
	$row = mysql_fetch_array( $result );
	$pollResults = $pollResults . "-" . $row['SUM(pollAnswerPoints)'];
	echo $pollResults;	
}


//VOTE START
if ($_GET['action'] == "vote"){
	
	if (isset($_COOKIE["poll" . getPollID($pollAnswerID)])) {
		echo "voted";
	} else {
		$query  = "UPDATE tab_poll_answer SET pollAnswerPoints = pollAnswerPoints + 1 WHERE pollAnswerID = ".$pollAnswerID."";
		mysql_query($query) or die('Error, insert query failed');
		
		/*$query  = "INSERT INTO pollTrans VALUE(".$ddd.",".$ddd.",".$fff.")";
		mysql_query($query) or die('Error, insert query failed');*/
		
		//setcookie("poll" . getPollID($pollAnswerID), 1, time()+259200, "/", ".webresourcesdepot.com");
		setcookie("poll" . getPollID($pollAnswerID), 1, time()+259200, "/", "http://157.179.24.101/MA3/CodeIgniter/");
		getPollResults(1);
	}
}
//VOTE END

if (mysql_real_escape_string($_GET['cleanCookie']) == 1){
	//setcookie("poll1", "", time()-3600, "/", ".webresourcesdepot.com");
	setcookie("poll1", "", time()-3600, "/", "http://157.179.24.101/MA3/CodeIgniter/");
	//header('Location: http://webresourcesdepot.com/wp-content/uploads/file/ajax-poll-script/');
}

?>

<?php
	function checkPollActive(){
		$strSQLSelect = "SELECT count(*) AS cntPoll FROM tab_polls WHERE pollStatus = 1";
		$objQuery = mysql_query($strSQLSelect);
		$row = mysql_fetch_array($objQuery);
		$total = $row['cntPoll'];
		return $total;
	}
?>

<?php
	function rollBack($pollID){
		mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
		$strSQL = "DELETE FROM tab_polls WHERE `pollID` =".$pollID;
		$objQuery = mysql_query($strSQL);
		$strSQL = "DELETE FROM tab_poll_answer  WHERE `pollID` =".$pollID;
		$objQuery = mysql_query($strSQL);
	}
	
	function insertPoll($txtPollTitle, $catm, $startDate, $endDate, $startTime, $endTime, $curDate, $empId){
		
		mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
		/* UPDATE pollStatus IN poll To Disable */
		$txtPollTitle = mysql_real_escape_string($txtPollTitle);
		$strSQL = "UPDATE tab_polls SET pollStatus = 0";
		$objQuery = mysql_query($strSQL);
		
		/* SELECT LAST ROW IN poll */
		$strSQLSelect = "SELECT `pollID` FROM tab_polls ORDER BY `pollID` DESC LIMIT 1";
		$objQuery = mysql_query($strSQLSelect);
		$row = mysql_fetch_array($objQuery);
		$pollID = $row['pollID'] + 1;

		
		/* INSERT NEW ROW IN poll */
		$strSQLInsert = "INSERT INTO tab_polls ";
		$strSQLInsert .="(pollID, pollQuestion, pollStatus, catm, datevote_begin, datevote_end, timevote_begin, timevote_end, upd_date, upd_emp) ";
		$strSQLInsert .="VALUES ";
		$strSQLInsert .="(".$pollID.",'".$txtPollTitle."','1',".$catm.", ".$startDate.", ".$endDate.", ".$startTime.",".$endTime.",".$curDate.",".$empId.")";
		$objQuery = mysql_query($strSQLInsert);
		
		if(mysql_affected_rows() <= 0){ //-- Insert ERROR
			rollBack($pollID);
			echo "99|Error, Insert poll failed|";
			return;
		}
		
		/* INSERT NEW  2 ROW IN pollanswers */
		$strSQLInsert = "INSERT INTO tab_poll_answer ";
		$strSQLInsert .="(pollAnswerID,pollID, pollAnswerValue, pollAnswerPoints, pollAnswerListing, upd_date, upd_emp) ";
		$strSQLInsert .="VALUES ";
		$strSQLInsert .="(1,".$pollID.",'เห็นด้วย', 0, 1,".$curDate.",".$empId.")";
		$objQuery = mysql_query($strSQLInsert);
		
		if(mysql_affected_rows() <= 0){ //-- Insert ERROR
			rollBack($pollID);
			echo "99|Error, Insert pollanswers Agree failed|".$strSQLInsert."|";
			exit;
		}
		
		$strSQLInsert = "INSERT INTO tab_poll_answer ";
		$strSQLInsert .="(pollAnswerID,pollID, pollAnswerValue, pollAnswerPoints, pollAnswerListing, upd_date, upd_emp) ";
		$strSQLInsert .="VALUES ";
		$strSQLInsert .="(2,".$pollID.",'ไม่เห็นด้วย', 0, 2,".$curDate.",".$empId.")";
		$objQuery = mysql_query($strSQLInsert);
		
		if(mysql_affected_rows() <= 0){ //-- Insert ERROR
			rollBack($pollID);
			echo "99|Error, Insert pollanswers Not Agree failed|";
			exit;
		}
		
		echo "0|SUCCESS";
		
	}
	

	function delPoll($pollID){
		mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
		$strSQL = "DELETE FROM tab_polls WHERE `pollID` =".$pollID;
		$objQuery = mysql_query($strSQL);
		$strSQL = "DELETE FROM tab_poll_answer WHERE `pollID` =".$pollID;
		$objQuery = mysql_query($strSQL);
		echo "0|SUCCESS";
	}
?>
