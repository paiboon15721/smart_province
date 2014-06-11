<?php
header ('Content-type: text/html; charset=utf-8');
require("file:///D|/WORK_CDG/NY/laravel/smart_province/public/external_project/session_start.php");
error_reporting( ~(E_NOTICE));
require("../inc/MySQL/mySQLFunc.php");
require("../inc/function.php");

if((isset($_GET['insertId'])) && ((int)($_GET['insertId'] > 0))){
	mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
	$query  = "UPDATE tab_polls SET pollStatus = 0";
	$result = mysql_query($query);
	$query  = "UPDATE tab_polls SET pollStatus = 1 WHERE pollID = ".$_GET['insertId'];
	$result = mysql_query($query);
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
<link href="../css/template_style.css" rel="stylesheet" type="text/css" />
<link href="../css/m-buttons.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="../inc/js/jquery.min.js"></script>
<script src="../inc/js/poll.js" type="text/javascript"></script>
<script language="javascript" src="../inc/js/jquery.maxlength.js"></script>
<script type="text/javascript" src="../inc/js/datepickrThai.js"></script>
<style type="text/css">
	#startDate, #endDate{
		width: 75px;
	}
	
	.calendar {
		font-family: 'Tahoma', Tahoma, Verdana, Arial, sans-serif;
		font-size: 0.9em;
		background-color: #EEE;
		color: #333;
		border: 1px solid #DDD;
		-moz-border-radius: 4px;
		-webkit-border-radius: 4px;
		border-radius: 4px;
		padding: 0.2em;
		width: 14em;
	}
	
	.calendar a {
		outline: none;
	}
	
	.calendar .months {
		background-color: #F6AF3A;
		border: 1px solid #E78F08;
		-moz-border-radius: 4px;
		-webkit-border-radius: 4px;
		border-radius: 4px;
		color: #FFF;
		padding: 0.2em;
		text-align: center;
	}
	
	.calendar .prev-month,
	.calendar .next-month {
		padding: 0;
	}
	
	.calendar .prev-month {
		float: left;
	}
	
	.calendar .next-month {
		float: right;
	}
	
	.calendar .current-month {
		margin: 0 auto;
	}
	
	.calendar .months a {
		color: #FFF;
		text-decoration: none;
		padding: 0 0.4em;
		-moz-border-radius: 4px;
		-webkit-border-radius: 4px;
		border-radius: 4px;
	}
	
	.calendar .months a:hover {
		background-color: #FDF5CE;
		color: #C77405;
	}
	
	.calendar table {
		border-collapse: collapse;
		padding: 0;
		font-size: 0.8em;
		width: 100%;
	}
	
	.calendar th {
		text-align: center;
	}
	
	.calendar td {
		text-align: right;
		padding: 1px;
		width: 14.3%;
	}
	
	.calendar td a {
		display: block;
		color: #1C94C4;
		background-color: #F6F6F6;
		border: 1px solid #CCC;
		text-decoration: none;
		padding: 0.2em;
	}
	
	.calendar td a:hover {
		color: #C77405;
		background-color: #FDF5CE;
		border: 1px solid #FBCB09;
	}
	
	.calendar td.today a {
		background-color: #FFF0A5;
		border: 1px solid #FED22F;
		color: #363636;
	}
	
</style>
</head>
<body>
<form id="frmInsert" name="frmInsert" method="post" action="../poll.php">
<input type="hidden" name="curDate" id="curDate" />
<input type="hidden" name="empId" id="empId" value="<?php echo $_SESSION['EMPID']; ?>" />
<div id="template_body_wrapper">
	<div id="template_main_wrapper">
        <div id="template_header">          
        </div> 
        <!-- end of template_header -->
        
        <div id="template_content_outer">
            <div id="template_content_status">
                    <div class="status_left">ชื่อ - สกุล ผู้ปฏิบัติงาน &nbsp;:&nbsp;<?php echo $_SESSION['EMPNAME']; ?>&nbsp;(<?php echo $_SESSION['EMPID']; ?>)</div>
                    <div class="status_right"><?php echo DateThai(); ?></div>
			</div>
            <!-- end of template_content_status -->
            
            <div id="template_content_inner_insert"> 
            	<div id="template_content">
                  <div class="cleaner_h10"></div>
                  <img src="../images/titleInsert.png" width="794" height="57"  alt=""/>
                  <div class="cleaner_h10"></div>
                  <table width="90%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="40%" height="30" align="right" valign="top" class="titleLabel">หัวข้อประชามติ :&nbsp; </td>
                      <td width="60%" height="30" align="left"><label for="txtReferendum"></label>
                        <textarea name="txtReferendum" id="txtReferendum" cols="50" rows="6"></textarea></td>
                    </tr>
                    <tr>
                      <td width="40%" height="25" align="right" valign="middle" class="titleLabel">&nbsp;</td>
                      <td width="60%" height="25" align="right" class="warning">พิมพ์ข้อความได้อีก&nbsp;
                        <div id="cntxt">250</div>
                        &nbsp;อักษร&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    </tr>
                    <tr>
                      <td width="40%" height="40" align="right" valign="middle" class="titleLabel">วันที่เริ่มต้น&nbsp;-&nbsp;วันที่สิ้นสุด การลงประชามติ&nbsp;:&nbsp;</td>
                      <td width="60%" height="40" align="left"><label for="startDate"></label>
                        <input name="startDate" class="date-pick" id="startDate" />
                        &nbsp;-&nbsp;
                        <input name="endDate" class="date-pick" id="endDate" /></td>
                    </tr>
                    <tr>
                      <td width="40%" height="40" align="right" valign="middle" class="titleLabel">เวลาเริ่มต้น&nbsp;-&nbsp;เวลาสิ้นสุด การลงประชามติ&nbsp;:&nbsp;</td>
                      <td width="60%" height="40" align="left"><select name="startTime" id="startTime">
                        <?php 
					   $k = 8;
					   for($i=0;$i<8;$i++){
					   ?>
                        <option value="<?php echo $k+$i;?>"><?php echo $k+$i; ?>:00</option>
                        <?php
					   }
					   ?>
                      </select>
                        &nbsp;-&nbsp;
                        <select name="endTime" id="endTime">
                          <?php 
					   $k = 8;
					   for($i=0;$i<8;$i++){
					   ?>
                          <option value="<?php echo $k+$i;?>"><?php echo $k+$i; ?>:00</option>
                          <?php
					   }
					   ?>
                        </select></td>
                    </tr>
                    <tr>
                      <td height="40" align="right" valign="middle" class="titleLabel">จังหวัด :&nbsp; </td>
                      <td height="40" align="left" id="selCC">
                      <select name="ccList" id="ccList">
                      <option value="0">==== เลือกจังหวัด ====</option>
                      </select>
                      </td>
                    </tr>
                    <tr id="aaTab">
                      <td height="40" align="right" valign="middle" class="titleLabel" id="titleAA">อำเภอ :&nbsp; </td>
                      <td height="40" align="left" id="selAA">
                      <select name="aaList" id="aaList">
                      </select>
                      </td>
                    </tr>
                   <tr id="ttTab">
                      <td height="40" align="right" valign="middle" class="titleLabel" id="titleTT">ตำบล :&nbsp; </td>
                      <td height="40" align="left" id="selTT">
                      <select name="ttList" id="ttList">
                      </select>
                      </td>
                    </tr>
                    <tr id="mmTab">
                      <td height="40" align="right" valign="middle" class="titleLabel" id="titleMM">หมู่บ้าน :&nbsp; </td>
                      <td height="40" align="left" id="selMM">
                      <select name="mmList" id="mmList">
                      </select>
                      </td>
                    </tr>
                    <tr>
                      <td height="10" colspan="2" align="right" valign="top"></td>
                    </tr>
                    <tr>
                      <td width="40%" height="30" align="right" valign="top">&nbsp;</td>
                      <td width="60%" height="50" align="center" class="warning">
                        <a href="#" class="m-btn red rnd sm" id="btnInsert" name="btnInsert">เพิ่มหัวข้อ</a>
                        &nbsp;&nbsp;
                        <a href="#" class="m-btn red rnd sm" id="btnCancel" name="btnCancel">ยกเลิก</a>
                        &nbsp;&nbsp;
                        <a href="javascript:window.location = 'managePoll.php';" class="m-btn red rnd sm" id="btExit" name="btExit">กลับ</a>
                     </td>
                    </tr>
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
<script language="javascript" src="../inc/js/jsFunc.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
             //Set maxlength of all the textarea (call plugin)
             $().maxlength();
			 var data = "";
			 $.post("inc/Oracle/ccList.php", data, function(dataResponse){ 
			 	//alert(dataResponse);
				var ccSplit = dataResponse.split("|");
				var total = ccSplit[0];
				var y = 2;
				var k = 1;
				for(var i=0; i<total; i++){
					$('#ccList').append('<option value="'+ ccSplit[k] + '">' + ccSplit[y] +'</option>');
					y=y+2;
					k=k+2;
				}
			 });
			 
			 /*$('#selCC').load("inc/Oracle/ccList.php");*/
			 $('#aaTab').hide();
			 $('#ttTab').hide();
			 $('#mmTab').hide();
    })
</script>

<script type="text/javascript">
var n = $("div").length;

$('#ccList').change(function(){
	//alert($('#ccList').val());
	if(parseInt($('#ccList').val(), 10) == 0){
		 $('#aaTab').hide();
		 $('#ttTab').hide();
		 $('#mmTab').hide();
	}else{
		var data=$('#frmInsert').serialize();  
		 $('#aaTab').show();
		 $.post("inc/Oracle/aaList.php", data, function(dataResponse){ 
			//alert(dataResponse);
			var aaSplit = dataResponse.split("|");
			var total = aaSplit[0];
			var y = 2;
			var k = 1;
			$("#aaList").empty();
			if(parseInt($('#ccList').val()) == 10){
				$('#titleAA').html('เขต :&nbsp; ');
				$('#aaList').append('<option value="0">==== ทุกเขต ====</option>');
			}else{
				$('#titleAA').html('อำเภอ :&nbsp; ');
				$('#aaList').append('<option value="0">==== ทุกอำเภอ ====</option>');
			}
			
			for(var i=0; i<total; i++){
				$('#aaList').append('<option value="'+ aaSplit[k] + '">' + aaSplit[y] +'</option>');
				y=y+2;
				k=k+2;
			}
		 });
		 $('#ttTab').hide();
		 $('#mmTab').hide();
	}
});

$('#aaList').change(function(){
	if(parseInt($('#aaList').val(), 10) == 0){
		 $('#ttTab').hide();
		 $('#mmTab').hide();
	}else{
		var data=$('#frmInsert').serialize();  
		 $('#ttTab').show();
		 $.post("inc/Oracle/ttList.php", data, function(dataResponse){ 
			//alert(dataResponse);
			var ttSplit = dataResponse.split("|");
			var total = ttSplit[0];
			var y = 2;
			var k = 1;
			$("#ttList").empty();
			if(parseInt($('#ccList').val()) == 10){
				$('#titleTT').html('แขวง :&nbsp; ');
				$('#ttList').append('<option value="0">==== ทุกแขวง ====</option>');
			}else{
				$('#titleTT').html('ตำบล :&nbsp; ');
				$('#ttList').append('<option value="0">==== ทุกตำบล ====</option>');
			}
		
			for(var i=0; i<total; i++){
				$('#ttList').append('<option value="'+ ttSplit[k] + '">' + ttSplit[y] +'</option>');
				y=y+2;
				k=k+2;
			}
		 });
		 $('#mmTab').hide();
	}
});

$('#ttList').change(function(){
	if(parseInt($('#ttList').val(), 10) == 0){
		 $('#mmTab').hide();
	}else{
		var data=$('#frmInsert').serialize();  
		 $('#mmTab').show();
		 $.post("inc/Oracle/mmList.php", data, function(dataResponse){ 
			//alert(dataResponse);
			var mmSplit = dataResponse.split("|");
			var total = mmSplit[0];
			var y = 2;
			var k = 1;
			$("#mmList").empty();
			$('#mmList').append('<option value="0">==== ทุกหมู่บ้าน ====</option>');
		
			for(var i=0; i<total; i++){
				$('#mmList').append('<option value="'+ mmSplit[k] + '">' + mmSplit[y] +'</option>');
				y=y+2;
				k=k+2;
			}
		 });
	}
});

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
	
	var txtRefer = $("#txtReferendum").val();
	var startTime = $("#startTime").val();
	var endTime = $("#endTime").val();
	var startDate = $("#startDate").val();
	var endDate = $("#endDate").val();
	var arrStartDate = startDate.split("-");
	var arrEndDate = endDate.split("-");
	arrStartDate[2] = parseInt(arrStartDate[2], 10) - 543;
	var tmpStartDate = arrStartDate[2] + arrStartDate[1] + arrStartDate[0];
	arrEndDate[2] = parseInt(arrEndDate[2], 10) - 543;
	var tmpEndDate = arrEndDate[2] + arrEndDate[1] + arrEndDate[0];
	
	var today = new Date();
	var dd = ("0" + (today.getDate())).slice(-2);
	var mm = ("0" + (today.getMonth() + 1)).slice(-2);
	var yyyy = today.getFullYear();
	var yyyyThai = today.getFullYear() + 543;
	var tmpCurDate = yyyy + '' + mm + '' + dd;
	var UpdDate = yyyyThai + '' + mm + '' + dd;
	
	//alert(tmpCurDate);
	//alert(tmpStartDate);
	//alert(tmpEndDate);
	
	if(jQuery.trim(txtRefer).length <= 0)
	{
		alert("กรุณาระบุหัวข้อประชามติ");
		$("#txtReferendum").focus();
		return;
	}
	
	if(startDate == ''){
		alert("กรูณาระบุวันที่เริ่มต้น");
		$("#startDate").focus();
		return;
	}
	
	if(endDate == ''){
		alert("กรูณาระบุวันที่สิ้นสุด");
		$("#endDate").focus();
		return;
	}
	
	if((parseInt(tmpCurDate, 10) > parseInt(tmpStartDate, 10)) || (parseInt(tmpCurDate, 10) > parseInt(tmpEndDate, 10))){
		alert("คุณระบุวันที่ไม่ถูกต้อง วันที่เริ่มต้น และ วันที่สิ้นสุด ต้องมากกว่าวันที่ปัจจุบัน");
		return;
	}
	if(parseInt(tmpStartDate, 10) > parseInt(tmpEndDate, 10)){
		alert("คุณระบุวันที่ไม่ถูกต้อง วันที่เริ่มต้น ต้องน้อยกว่าวันที่สิ้นสุด");
		return;
	}

	
	if(parseInt(startTime, 10) > parseInt(endTime, 10)){
		alert("คุณระบุเวลาเริ่มต้น น้อยกว่า วันที่สิ้นสุด");
		$("#startTime").focus();
		return;
	}
	
	if(parseInt($('#ccList').val(), 10) == 0){
		alert("กรุณาระบุจังหวัด");
		$("#ccList").focus();
		return;
	}
	
	$('#startDate').val(tmpStartDate);
	$('#endDate').val(tmpEndDate);
	$('#curDate').val(UpdDate);
	var data=$('#frmInsert').serialize();  
	$.post("insertData.php", data, function(dataResponse){ 
		//alert(dataResponse);
		var dataSplit = dataResponse.split("|");
		if(parseInt(dataSplit[0], 10) > 0){
			alert(dataSplit[1]);
		}else{
			alert("ทำการเพิ่มหัวข้อประชามติเรียบร้อยแล้ว");
			window.location = "managePoll.php";
		}
	});
});

		new datepickr('startDate', { dateFormat: 'd-m-Y' });
		new datepickr('endDate', { dateFormat: 'd-m-Y' });
        
</script>
</form>
</body>
</html>