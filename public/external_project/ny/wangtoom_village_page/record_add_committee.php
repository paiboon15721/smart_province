<html>
<head>
<title>บันทึกข้อมูล</title>
<META http-equiv=Content-Language content=th>
<META http-equiv=Content-Type content="text/html; charset=windows-874">
<link rel="stylesheet" type="text/css" href="style.css">
<script language="javascript" type="text/javascript" src="datetimepicker2.js"></script>
<script src="clienthint.js"></script> 
<script language="JavaScript" type="text/JavaScript">
function SelectCate(targ,selObj,restore){ //v3.0
  eval(targ+".location='ReportCenter.php?ins_aa="+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
var xmlHttp;
var number;
var vill_name;
var vill_name;
var tambon_id;
function createXMLHttpRequest() {
    if (window.ActiveXObject) {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    } 
    else if (window.XMLHttpRequest) {
        xmlHttp = new XMLHttpRequest();
    }
}
// Double Combo Box
function refreshList() {
   var tambon_id = document.getElementById("tambon_id").value;
    if(tambon_id == "" ) {
        clearList();
        return;
    }
    var url = "DoubListBoxes.php?tambon_id=" + tambon_id;
    createXMLHttpRequest();
    xmlHttp.onreadystatechange = handleStateChange;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}
    
function handleStateChange() {
    if(xmlHttp.readyState == 4) {
        if(xmlHttp.status == 200) {
            updateList();
        }
    }
}

function updateList() {
    clearList();
	var vill_name = document.getElementById("vill_name");
    var results = xmlHttp.responseText;
    var option = null;
    p=results.split(",");
    for (var i = 0; i < p.length; i++){
				if(vill_name[i]!="")
						vill_name.options[vill_name.options.length] = new Option(p[i], p[i]);
           /*option = document.createElement("option");
           option.appendChild(document.createTextNode(p[i]));
           pet_aa.appendChild(option);*/
    }
}

function clearList() {
    var vill_name = document.getElementById("vill_name");
    while(vill_name.childNodes.length > 0) {
              vill_name.removeChild(vill_name.childNodes[0]);
    }
}

function confirmSubmit()
{
var agree=confirm("คุณต้องการบันทึกข้อมูลใช่หรือไม่");
if (agree)
	return true ;
else
	return false ;
}
function check_number() {
e_k=event.keyCode
//if (((e_k < 48) || (e_k > 57)) && e_k != 46 ) {
if(forminsert.pid)
if (e_k != 13 && (e_k < 48) || (e_k > 57)) {
event.returnValue = false;
alert("ต้องเป็นตัวเลขเท่านั้น... \nกรุณาตรวจสอบข้อมูลของท่านอีกครั้ง...");
}
}

function CheckIDCard(s){
        var pin  = 0 , j = 13 , pin_num = 0;     
        if ( s == ""){
            return;
        }
        var ChkPinID =  true;
        if( ChkPinID == false ) { return false; 
		}
        if(  s.length == 13 ) {
            for(var i = 0; i < s.length; i++ ) {
               if( i != 12 ) {
                pin = s.charAt(i) * j + pin;
               }
                j --;
            }
            pin_num = ( 11 - ( pin %11 ))%10;
            if( s.charAt(12) != pin_num ) {
                  alert("เลขที่บัตรประจำตัวประชาชนไม่ถูกต้อง กรุณาป้อนเลขที่บัตรประจำตัวประชาชนอีกครั้ง");
				  forminsert.pid.focus();
                  return false;
				  
            }
        }else{
            alert("เลขที่บัตรประจำตัวประชาชนไม่ถูกต้อง กรุณาป้อนเลขที่บัตรประจำตัวประชาชนอีกครั้ง");
			forminsert.pid.focus();
            return false;
			
        }
        return true;
    }


function validForm()
{
formObj = document.forminsert;
if((formObj.tambon_id.value=="") ||
(formObj.vill_name.value=="") ||
(formObj.occu.value=="")||
(formObj.edu.value=="")||
(formObj.vill_pos.value=="")||
(formObj.council_pos.value=="")||
(formObj.start_date.value=="")||
(formObj.pass_date.value=="")||
(formObj.pid.value=="")||
(formObj.title_name.value=="")||
(formObj.mem_name.value=="")||
(formObj.mem_last.value=="")||
(formObj.birth_date.value=="")||
(formObj.age.value=="")||
(formObj.address_no.value=="")||
(formObj.mem_vill_name.value=="")||
(formObj.tambon.value=="")||
(formObj.distric.value=="")||
(formObj.province.value==""))
{
alert("กรุณากรอกข้อมูลให้ครบถ้วน");
return false;
}
else
return true;
}

function getpopdata()
{
 var pid = document.getElementById("pid").value;
 formObj = document.forminsert;
if(formObj.tambon_id.value=="" ||
formObj.mooNo.value=="" || formObj.pid.value=="" ||formObj.mooNo.value=="- เลือกหมู่ -")
{
alert("กรุณากรอกข้อมูลให้ครบถ้วน");
}
else{
var tambon_id = document.getElementById("tambon_id").value;
	var mooNo = document.getElementById("mooNo").value;
	var regtype = document.getElementById("regtype").value;
	if (CheckIDCard(document.getElementById('pid').value) &&  tambon_id !=""  ){
window.open('insertform.php?pid='+pid+'&tambon_id='+tambon_id+'&mooNo='+mooNo+'&regtype='+regtype, 'insert');
}
else{}
 
  
}

}

</script>

</head>
<body  leftmargin="0" topmargin="0" marginwidth="0" marginheight="0"  >
<div align="right"><img src="images/reportb.gif" border="0"></div>
<FORM name="forminsert" METHOD=POST ACTION="getpopdata.php" onSubmit="">
<table width="720" cellpadding="0" cellspacing="0"    style="border-color:#999999; border-style:dotted; border-width:1px; border-spacing:5px; background-color:#BAC9E0; margin:5 px; " align="center">
<tr height="25"bgcolor="#6699CC"  valign="top" ><td background="images/barbg.gif"></td><td class="style1" height="25" background="images/barbg.gif" >ข้อมูลพื้นที่</td><td background="images/barbg.gif"></td><td background="images/barbg.gif" ></td><td background="images/barbg.gif" ></td><td background="images/barbg.gif"></td></tr>
<tr height="20">
<td></td>
<td class="style1"  width="120" height="25" align="right">อำเภอ :</td>
		<td width="200" class="style4">เมืองนครนายก</td>
		<td class="style1"  width="80" height="25" align="right">จังหวัด :</td>
		<td width="250" class="style4">นครนายก</td>
		<td></td>
		</tr>
		<tr height="20">
		<td></td>
<td class="style1"  width="120" height="25" align="right">ตำบล : </td>
<td width="200">เขาพระ</td>
<td class="style1"  width="80" height="25" align="right">หมู่บ้าน : </td>
		<td width="250">วังตูม</td>
					<td></td>
</tr>
<tr height="20">
		<td></td>
<td class="style1"  width="120" height="25" align="right">เลขประจำตัวประชาชน :</td>
<td width="200"><input name="pid" type="text" size="20" maxlength="13"  value='3-1001-11111-11-1'>
		
					</td>
<td class="style1"  width="80" height="25" align="right">หมู่ : </td>
		<td width="250">1</td>
					<td></td>
</tr>
<tr><td></td><td ></td><td></td><td></td><td></td><td></td></tr>
</table>
<div class="style1" align="center">

</FORM>
<br>
<table width="720" cellpadding="0" cellspacing="0" border="0" height="320" align="center">
<tr align="center" valign="top">
<td align="center">
<table width="710" cellpadding="0" cellspacing="0" border="0" height="320" align="center">
<tr align="center" valign="top">
<td>
<table width="350" cellpadding="0" cellspacing="0" border="0" height="320" bgcolor="#B6D5F3"style="border-color:#999999; border-style:dotted; border-width:1px; border-spacing:5px; " align="center">
<tr bgcolor="#5292D1"><td height="25" background="images/barbg.gif" class="style1" align="left">ข้อมูล กม.</td><td class="style2" height="25" background="images/barbg.gif" ></td></tr>
<tr>
		<td width="120"height="25" align="right"  class="style2">เลขประจำตัวประชาชน:</td>
		<td><input name="pid" type="text" size="20" maxlength="13" value=""  onkeypress=check_number();></td>
		</tr>
			<tr>
		<td width="120" height="25" align="right"  class="style2">คำนำหน้านาม :</td>
		<td><input name="title_name" type="text" size="20" value="" onFocus="CheckIDCard(document.getElementById('pid').value)" ></td>
		</tr>
		
		<tr>
		<td width="120" height="25" align="right"  class="style2">ชื่อ :</td>
		<td><input name="mem_name" type="text" size="20" value=""></td>
		</tr>
		
			<tr>
		<td width="120" height="25" align="right"  class="style2">ชื่อสกุล :</td>
		<td><input name="mem_last" type="text" size="20"  value=""></td>
		</tr>
		<tr>
		<td width="120" height="25" align="right"  class="style2">อาชีพ :</td>
		<td><select style="BACKGROUND: #FFFFFF; WIDTH: 150px; margin-top:2px; "  size="1" name="occu">
                    
					<option value='401' selected>- เกษตรกรรม -</option><option value='402' selected>- อุตสาหกรรม -</option><option value='403' selected>- รับจ้างทั่วไป -</option><option value='404' selected>- รับราชการ พนักงานของรัฐ/รัฐวิสาหกิจ -</option><option value='405' selected>- พาณิชยกรรม(ค้าขาย) -</option><option value='406' selected>- บริการ -</option><option value='407' selected>- ปศุสัตว์ -</option><option value='408' selected>- ประมง -</option><option value='409' selected>- ข้าราชการบำนาญ -</option><option value='410' selected>- ว่างงาน -</option><option value='411' selected>- อื่นๆ -</option>					<option selected value="">- เลือกอาชีพ -</option>
					</select></td>
		</tr>
		
		<tr>
		<td width="120" height="25" align="right"  class="style2">การศึกษา :</td>
		<td><select style="BACKGROUND: #FFFFFF; WIDTH: 150px; margin-top:2px; "  size="1" name="edu">
                    
					<option value='501' selected>- ต่ำกว่าประถมศีกษา -</option><option value='502' selected>- ประถมศีกษา ป.6 หรือเทียบเท่า -</option><option value='503' selected>- มัธยมศึกษาตอนต้น ม.3 หรือเทียบเท่า -</option><option value='504' selected>- มัธยมศึกษาตอนปลาย ม.6 ปวช. หรือเทียบเท่า -</option><option value='505' selected>- ปวส. อนุปริญาตรี หรือเทียบเท่า -</option><option value='506' selected>- ปริญญาตรี -</option><option value='507' selected>- ปริญาโท -</option><option value='508' selected>- ปริญญาเอก -</option><option value='509' selected>- ประถมศึกษาตอนต้น(ป.1-ป.4) หรือเทียบเท่า -</option>					<option selected value="">- เลือกวุฒิการศึกษา -</option>
					</select></td>
		</tr>

		<tr>
		<td width="120" height="25" align="right"  class="style2">การเป็นกรรมการหมู่บ้าน :</td>
		<td class="style2" height="50">
		<input name="council_type"   type="radio" value="000"   onClick="disableCh();document.forminsert.start_date.value='06-04-2551';" >โดยตำแหน่ง  <input name="council_type"   type="radio" value="100"  onClick="disableUnCh();document.forminsert.start_date.value='' " > ผู้ทรงคุณวุฒิ
		<select style="BACKGROUND: #FFFFFF; WIDTH: 200px; margin-top:2px; " size="1" name="vill_pos" disabled="disabled">
                    
					<option value='101' selected>- ผู้ใหญ่บ้าน -</option><option value='102' selected>- ผู้ช่วยผู้ใหญ่บ้านฝ่ายปกครอง -</option><option value='103' selected>- ผู้ช่วยผู้ใหญ่บ้านฝ่ายรักษาความสงบ -</option><option value='106' selected>- สมาชิก อบต. -</option><option value='107' selected>- สมาชิกสภาเทศบาล -</option><option value='108' selected>- สมาชิกสภาองค์การบริหารส่วนจังหวัด -</option><option value='109' selected>- ผู้นำกลุ่มบ้านตามประกาศของอำเภอ -</option><option value='110' selected>- ผู้นำหรือผู้แทนกลุ่มกิจกรรมที่ มท.ประกาศ -</option><option value='111' selected>- กลุ่มอาชีพหรือกลุ่มเกษตรกรรมที่นายอำเภอป -</option><option value='112' selected>- กำนัน -</option>					<option selected value="">- เลือกตำแหน่ง -</option>
					</select>
					</td>
		</tr>
		
			<tr>
		<td width="120" height="25" align="right"  class="style2">วันดำรงตำแหน่ง:</td>
		<td class="style1"><input name="start_date" type="text" size="15" maxlength="10"  ><a href="javascript:NewCal('ddmmyyyy','start_date','pass_date')" ><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a>คลิกปุ่มปฏิทิน</td>
		</tr>
		<tr>
		<td width="120" height="25" align="right"  class="style2"></td>
		<td class="style1">*กรณีโดยตำแหน่ง <br>
		  <span class="style6">หากดำรงตำแหน่งก่อน กม. มีผลบังคับใช้<br>ให้ยึดตามวันที่ กม. <br>มีผลบังคับใช้ (06-04-2551)</span><br>
		  *ผู้นำกลุ่มบ้านตามประกาศของอำเภอ<br>*กลุ่มอาชีพที่นายอำเภอประกาศ <br>
		  <span class="style6">วันดำรงตำแหน่งให้ยึดตามวันที่อำเภอประกาศ</span><br>
		  *ผู้นำหรือผู้แทนกลุ่มกิจกรรมที่ มท.ประกาศ<br>
		  <span class="style6">วันดำรงตำแหน่งให้ยึดตาม<br>
		  วันที่ประกาศในราชกิจจานุเบกษา<br>
		  (15-09-2551)</span></td>
		</tr>
		<tr>
		<td width="120" height="25" align="right"  class="style2">วันครบวาระ :</td>
		<td class="style1"><input name="pass_date" type="text" size="15" maxlength="10" onKeyPress="validateDate(document.getElementById('start_date').value)"><a href="javascript:NewCal('ddmmyyyy','pass_date')" ><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a>คลิกปุ่มปฏิทิน</td>
		</tr>
		
		<tr>
		<td width="120" height="25" align="right"  class="style2">ตำแหน่งใน กม. :</td>
		<td><select style="BACKGROUND: #FFFFFF; WIDTH: 200px; margin-top:2px; " size="1" name="council_pos"  onFocus="validateDate(document.getElementById('pass_date').value)">
                    
					<option value='601' selected>- ประธาน -</option><option value='602' selected>- รองประธาน -</option><option value='603' selected>- เลขานุการ -</option><option value='604' selected>- เหรัญญิก -</option><option value='605' selected>- ผู้ช่วยเลขานุการ -</option><option value='606' selected>- ผู้ช่วยเหรัญญิก -</option><option value='607' selected>- หัวหน้าคณะทำงาน -</option><option value='608' selected>- กรรมการหมู่บ้าน -</option>					<option selected value="">- เลือกตำแหน่ง -</option>
					</select></td>
		</tr>
		
		
		
		<tr>
		<td width="120" height="25" align="right"  class="style2">คณะทำงานด้าน :</td>
		<td class="style2">
		<input name="director"   type="checkbox" value="91"   onClick="disable() "> ด้านอำนวยการ
		<select style="BACKGROUND: #FFFFFF; WIDTH: 150px; margin-top:2px; " size="1" id="director_pos" name="director_pos" disabled="disabled" >
                    
					<option value='801' selected>- หัวหน้าคณะทำงาน -</option><option value='802' selected>- รองหัวหน้าคณะทำงาน -</option><option value='803' selected>- เลขานุการคณะทำงาน -</option><option value='804' selected>- ผู้ช่วยเลขานุการ -</option><option value='805' selected>- คณะทำงาน -</option>					<option selected>- เลือกตำแหน่ง -</option>
			  </select></td>
		</tr>
		
		<tr>
		<td width="120" height="25" align="right"  class="style2"></td>
		<td class="style2">
		<input name="administrator" type="checkbox" value="92" onClick="disable() "> ด้านการปกครองและรักษาความสงบฯ
		<select style="BACKGROUND: #FFFFFF; WIDTH: 150px; margin-top:2px; " size="1" name="administrator_pos"  disabled="disabled" >
                    
					<option value='801' selected>- หัวหน้าคณะทำงาน -</option><option value='802' selected>- รองหัวหน้าคณะทำงาน -</option><option value='803' selected>- เลขานุการคณะทำงาน -</option><option value='804' selected>- ผู้ช่วยเลขานุการ -</option><option value='805' selected>- คณะทำงาน -</option>					<option selected>- เลือกตำแหน่ง -</option>
					</select></td>
		</tr>
		
		<tr>
		<td width="120" height="25" align="right"  class="style2"></td>
		<td class="style2">
		<input name="develop" type="checkbox" value="93" onClick="disable() "> ด้านแผนพัฒนาหมู่บ้าน
		<select style="BACKGROUND: #FFFFFF; WIDTH: 150px; margin-top:2px; " size="1" name="develop_pos" disabled="disabled" >
                    
					<option value='801' selected>- หัวหน้าคณะทำงาน -</option><option value='802' selected>- รองหัวหน้าคณะทำงาน -</option><option value='803' selected>- เลขานุการคณะทำงาน -</option><option value='804' selected>- ผู้ช่วยเลขานุการ -</option><option value='805' selected>- คณะทำงาน -</option>					<option selected>- เลือกตำแหน่ง -</option>
					</select></td>
		</tr>
		
		<tr>
		<td width="120" height="25" align="right"  class="style2"></td>
		<td class="style2">
		<input name="economic" type="checkbox" value="94" onClick="disable() "> ด้านส่งเสริมเศรษฐกิจ
		<select style="BACKGROUND: #FFFFFF; WIDTH: 150px; margin-top:2px; " size="1" name="economic_pos" disabled="disabled" >
                    
					<option value='801' selected>- หัวหน้าคณะทำงาน -</option><option value='802' selected>- รองหัวหน้าคณะทำงาน -</option><option value='803' selected>- เลขานุการคณะทำงาน -</option><option value='804' selected>- ผู้ช่วยเลขานุการ -</option><option value='805' selected>- คณะทำงาน -</option>					<option selected>- เลือกตำแหน่ง -</option>
					</select></td>
		</tr>
		
		<tr>
		<td width="120" height="25" align="right"  class="style2"></td>
		<td class="style2">
		<input name="health" type="checkbox" value="95" onClick="disable() "> ด้านสังคมสิ่งแวดล้อมและสาธารณสุข
		<select style="BACKGROUND: #FFFFFF; WIDTH: 150px; margin-top:2px; " size="1" name="health_pos" disabled="disabled" >
                    
					<option value='801' selected>- หัวหน้าคณะทำงาน -</option><option value='802' selected>- รองหัวหน้าคณะทำงาน -</option><option value='803' selected>- เลขานุการคณะทำงาน -</option><option value='804' selected>- ผู้ช่วยเลขานุการ -</option><option value='805' selected>- คณะทำงาน -</option>					<option selected>- เลือกตำแหน่ง -</option>
					</select></td>
		</tr>
		
		<tr>
		<td width="120" height="25" align="right"  class="style2"></td>
		<td class="style2">
		<input name="civilize" type="checkbox" value="96" onClick="disable() "> ด้านการศึกษา ศาสนาและวัฒนธรรม
		<select style="BACKGROUND: #FFFFFF; WIDTH: 150px; margin-top:2px; " size="1" name="civilize_pos" disabled="disabled" >
                    
					<option value='801' selected>- หัวหน้าคณะทำงาน -</option><option value='802' selected>- รองหัวหน้าคณะทำงาน -</option><option value='803' selected>- เลขานุการคณะทำงาน -</option><option value='804' selected>- ผู้ช่วยเลขานุการ -</option><option value='805' selected>- คณะทำงาน -</option>					<option selected>- เลือกตำแหน่ง -</option>
					</select></td>
		</tr>
		
		<tr>
		<td width="120" height="25" align="right"  class="style2"></td>
		<td class="style2">
		<input name="other" type="checkbox" value="97" onClick="disable() ">ด้านอื่นๆ ระบุ <input name="othertext" type="text" size="20" maxlength="20" style="BACKGROUND: #FFFFFF; WIDTH: 100px; margin-top:2px; "  disabled="disabled" >
		<select style="BACKGROUND: #FFFFFF; WIDTH: 150px; margin-top:2px; " size="1" name="other_pos" disabled="disabled">
                    
					<option value='801' selected>- หัวหน้าคณะทำงาน -</option><option value='802' selected>- รองหัวหน้าคณะทำงาน -</option><option value='803' selected>- เลขานุการคณะทำงาน -</option><option value='804' selected>- ผู้ช่วยเลขานุการ -</option><option value='805' selected>- คณะทำงาน -</option>					<option selected>- เลือกตำแหน่ง -</option>
					</select></td>
		</tr>
		
	
		<tr><td></td></tr>
</table>
</td>
<td></td>
<td>
<table width="350" cellpadding="0" cellspacing="0" border="0" height="320"  bgcolor="#B6D5F3" style="border-color:#999999; border-style:dotted; border-width:1px; border-spacing:5px; ">
<tr bgcolor="#5292D1"><td height="25" background="images/barbg.gif"  class="style1" align="left">ข้อมูลบุคคล</td><td height="25" background="images/barbg.gif" ></td></tr>
<tr>
		<td width="120" height="25" align="right"  class="style2">วัน/เดือน/ปีเกิด:</td>
		<td class="style1"><input name="birth_date" type="text" size="15" maxlength="20" value=""><a href="javascript:NewCal('ddmmyyyy','birth_date')" ><img src="images/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a>คลิกปุ่มปฏิทิน</td>
		</tr>
		
		<tr>
		<td width="120" height="25" align="right"  class="style2">อายุ :</td>
		<td><input name="age" type="text" size="20" value="" onkeypress=check_number();  onFocus="validateDate(document.getElementById('birth_date').value)"></td>
		</tr>
			<tr>
		<td width="120" height="25" align="right"  class="style2">เพศ :</td>
		<td class="style2">
				<input name="sex" type="radio" value="1" checked="checked">ชาย
				<input name="sex" type="radio" value="2">หญิง
				
		</td>
		</tr>
		
		
		<tr>
		<td width="120" height="25" align="right"  class="style2">ที่อยู่ บ้านเลขที่ :</td>
		<td><input name="address_no" type="text" size="20" value=""></td>
		</tr>
		
			<tr>
		<td width="120" height="25" align="right"  class="style2">หมู่ :</td>
		<td><input name="moo" type="text" size="20" maxlength="20" value="" onkeypress=check_number();></td>
		</tr>
		
		<tr>
		<td width="120" height="25" align="right"  class="style2">หมู่บ้าน :</td>
		<td><input name="mm_name" type="text" size="20" maxlength="20" value=""></td>
		</tr>
		
		<tr>
		<td width="120" height="25" align="right"  class="style2">ตำบล :</td>
		<td><input name="tambon" type="text" size="20" maxlength="20" value="" ></td>
		</tr>
		
		<tr>
		<td width="120" height="25" align="right"  class="style2">อำเภอ :</td>
		<td><input name="distric" type="text" size="20" maxlength="20" value="เมืองอุบลราชธานี"></td>
		</tr>
		
		<tr>
		<td width="120" height="25" align="right"  class="style2">จังหวัด :</td>
		<td><input name="province" type="text" size="20" maxlength="20" value="อุบลราชธานี">
		<input name="national" type="hidden" value="">
		<input name="CCAATTMM" type="hidden" size="20" maxlength="20" value="">
		<input name="HID" type="hidden" size="20" maxlength="20" value="">
		<input name="vill_id" type="hidden" size="20" maxlength="20" value="">
</td>
		</tr>
		
		<tr>
		<td width="120" height="25" align="right"  class="style2">รหัสไปรษณีย์ :</td>
		<td><input name="postcode" type="text" size="20" maxlength="20" value="" onkeypress=check_number();></td>
		</tr>
		
		<tr>
		<td width="120" height="25" align="right"  class="style2">เบอร์บ้าน :</td>
		<td><input name="h_phone" type="text" size="20" maxlength="20" value="" onkeypress=check_number(); ></td>
		</tr>
		<tr>
		<td width="120" height="25" align="right"  class="style2">มือถือ :</td>
		<td><input name="cell_phone" type="text" size="20" maxlength="20"  onkeypress=check_number();></td>
		</tr>
		<tr><td></td></tr>
</table>
<br>
<table width="350" cellpadding="0" cellspacing="0" border="0"   bgcolor="#B6D5F3" style="border-color:#999999; border-style:dotted; border-width:1px; border-spacing:5px; ">
<tr bgcolor="#5292D1"><td height="25" background="images/barbg.gif"  class="style1" align="left">ความสามารถพิเศษ</td><td height="25" background="images/barbg.gif" ></td></tr>
<tr>
		<td width="120" height="25" align="right"  class="style2"></td>
		<td class="style2"><input name="language" type="checkbox" value="1" onClick="disable() ">ภาษาต่างประเทศ <br>ระบุ <input name="languagetext" type="text" size="20" maxlength="20" style="BACKGROUND: #FFFFFF; WIDTH: 100px; margin-top:2px; " disabled="disabled"  ></td>
		</tr>
		<tr>
		<td width="120" height="25" align="right"  class="style2"></td>
		<td class="style2"><input name="moc" type="checkbox" value="1">พิธีกร</td>
		</tr>
		<tr>
		<td width="120" height="25" align="right"  class="style2"></td>
		<td class="style2"><input name="com" type="checkbox" value="1">คอมพิวเตอร์</td>
		</tr>
		<tr>
		<td width="120" height="25" align="right"  class="style2"></td>
		<td class="style2"><input name="entertain" type="checkbox" value="1">สันทนาการ</td>
		</tr>
		<tr>
		<td width="120" height="25" align="right"  class="style2"></td>
		<td class="style2"><input name="sport" type="checkbox" value="1">กีฬา</td>
		</tr>
		<tr>
		<td width="120" height="25" align="right"  class="style2"></td>
		<td class="style2"><input name="typing" type="checkbox" value="1">พิมพ์ดีด</td>
		</tr>
		<tr>
		<td width="120" height="25" align="right"  class="style2"></td>
		<td class="style2"><input name="expert" type="checkbox" value="1">วิทยากรกระบวนการ</td>
		</tr>
		<tr>
		<td width="120" height="25" align="right"  class="style2"></td>
		<td class="style2"><input name="artist" type="checkbox" value="1">ศิลปินพื้นบ้าน</td>
		</tr>
		</table>
</td>
</tr>
</table>

<div align="center" class="style4"></div>
<div align="center"><input name="recordbt" type="submit" value="บันทึก" ><input name="cancelbt" type="button" value="ยกเลิก" onclick="javascript:window.close();" ></div>
</td></tr>
</table>

</FORM>
</body>
</html>
