<html>
<head>
<?php
include ("../FUNCTION/function.php");
$selPage = $_GET["selPage"];
?>
<title>บันทึกข้อมูลการเข้างาน และเหตุการณ์ที่เกิดขึ้น</title>
<script type="text/javascript">
    $(function() {
		//////////////////////////////////////////////////////// Datepicker
		var dateBefore=null;  
		var startDateTextBox = $('#date_start');
		var endDateTextBox = $('#date_end');
		var LastEndDate ;
		startDateTextBox.datetimepicker({ 
		dateFormat: 'dd-mm-yy',  
		dayNamesMin: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'],   
        monthNamesShort: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],  
        changeMonth: true,  
        changeYear: true ,  
		timeText: 'เวลา',
		hourText: 'ชั่วโมง',
		minuteText: 'นาที',
		currentText: 'ปัจจุบัน',
		closeText: 'ปิด',
	beforeShow:function(input,inst){  
			var calendar = inst.dpDiv;
			setTimeout(function() {calendar.position({my: 'right top',at: 'right bottom',collision: 'none',of: input});}, 1);
			 if($(this).val()!=""){  
				var d = startDateTextBox.datetimepicker('getDate');
				startDateTextBox.datepicker("setDate", new Date(set_datetime_picker(d,"-","mdy")) );
            }  	
            setTimeout(function(){  
                $.each($(".ui-datepicker-year option"),function(j,k){  
                    var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;  
                    $(".ui-datepicker-year option").eq(j).text(textYear);  
                });	
            },50);
        }, 
		onChangeMonthYear: function(){  
            setTimeout(function(){  
                $.each($(".ui-datepicker-year option"),function(j,k){  
                    var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;  
                    $(".ui-datepicker-year option").eq(j).text(textYear);  
                });               
            },50);        
        },  
			onClose: function(dateText, inst) {    
				if (endDateTextBox.val() != '') {
					var testStartDate = startDateTextBox.datetimepicker('getDate');
					var testEndDate = endDateTextBox.datetimepicker('getDate');
					if (testStartDate > testEndDate)
						endDateTextBox.datetimepicker('setDate', testStartDate);
				}
				else {
					endDateTextBox.val(dateText);
				}
				var d = startDateTextBox.datetimepicker('getDate');
				startDateTextBox.datepicker("setDate", new Date(set_datetime_picker(d,"+","mdy")) );
			},
			onSelect: function(dateText, inst){   
				var d = startDateTextBox.datetimepicker('getDate');
				startDateTextBox.val(set_datetime_picker(d,"+","dmy"));
				//endDateTextBox.datetimepicker('option', 'minDate', new Date(set_datetime_picker(d,"+","mdy"))  );
				//alert(set_datetime_picker(d,"+","mdy"));
			}
		});
		endDateTextBox.datetimepicker({ 
		dateFormat: 'dd-mm-yy',  
		dayNamesMin: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'],   
        monthNamesShort: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],  
        changeMonth: true,  
        changeYear: true ,  
		timeText: 'เวลา',
		hourText: 'ชั่วโมง',
		minuteText: 'นาที',
		currentText: 'ปัจจุบัน',
		closeText: 'ปิด',
		beforeShow: function(input, inst) {
					var calendar = inst.dpDiv;
					setTimeout(function() {calendar.position({my: 'right top',at: 'right bottom',collision: 'none',of: input});}, 1);
				   if($(this).val()!=""){  
				   var d = startDateTextBox.datetimepicker('getDate');
					endDateTextBox.datetimepicker('option', 'minDate', new Date(set_datetime_picker(d,"-","mdy"))  );
					var d = endDateTextBox.datetimepicker('getDate');
					endDateTextBox.datepicker("setDate", new Date(set_datetime_picker(d,"-","mdy")) );
					LastEndDate =  endDateTextBox.datetimepicker('getDate');
				}  	
				setTimeout(function(){  
					$.each($(".ui-datepicker-year option"),function(j,k){  
						var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;  
						$(".ui-datepicker-year option").eq(j).text(textYear);  
					});	
				},50);
			},
			onChangeMonthYear: function(){  
            setTimeout(function(){  
                $.each($(".ui-datepicker-year option"),function(j,k){  
                    var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;  
                    $(".ui-datepicker-year option").eq(j).text(textYear);  
                });               
            },50);        
        },  
			onClose: function(dateText, inst) {
				var d = endDateTextBox.datetimepicker('getDate');
				endDateTextBox.datepicker("setDate", new Date(set_datetime_picker(d,"+","mdy")) );
			},
			onSelect: function (selectedDateTime){
				var testStartDate = endDateTextBox.datepicker("option", "minDate");
				var testEndDate = endDateTextBox.datetimepicker('getDate');
				if (testStartDate > testEndDate){
					endDateTextBox.datetimepicker('setDate', LastEndDate);
				}
				var d = endDateTextBox.datetimepicker('getDate');
				endDateTextBox.val(set_datetime_picker(d,"+","dmy"));
			}
		});
    });
	$(function() {
		//////////////////////////////////////// TEXT LIMIT
		 $("#text").limit({
			limit: 255,
			id_result: "counter",
			alertClass: "alert"
		});
		/////////////////////////////////// REMARK LIMIT
		 $("#remark").limit({
			limit: 255,
			id_result: "counter1",
			alertClass: "alert"
		});
		//////////////////////////////////////// COMBO TYPE 99
		$("select[name='combo_type']").change(function(){
			if($($(this)).val() == 99){$("#other").html(" :: <input type='text' id='other_type'  />"); }
			else{$("#other").text("");}
		});
		///////////////////////////////////////  ADD START CLICK
		$("#add_start").click(function() {
			save_Time("add_start",$("#r_no").val(),$("#em_pid").val(),$("#em_catm").val(),<?php echo get_upd_date(); ?>,<?php echo get_upd_time(); ?>,0,0,'',0);
		});
		/////////////////////////////////////// ADD END CLICK
		$("#add_end").click(function() {
			save_Time("add_end",$("#r_no").val(),$("#em_pid").val(),$("#em_catm").val(),0,0,<?php echo get_upd_date(); ?>,<?php echo get_upd_time();?>,$("#text").val(),0);
		});
		///////////////////////////////////////  PREVIEW IMAGE CLICK
		$("a.preview").click(function() {
			$('div.myImage').dialog();
		});
		////////////////////////////////////// NEW CHRONICLE
		$("#new_chronicle").click(function() {
			var upload_num = 1;
			var d = new Date();
			$("#date_start").datepicker("setDate", new Date(set_datetime_picker(d,"+","mdy")) );
			$("#date_start").val(set_datetime_picker(d,"+","dmy"));
			$("#date_start").removeAttr("disabled");
			$('#date_end').datetimepicker('option', 'minDate', new Date(set_datetime_picker(d,"+","mdy"))  );
			$("#date_end").datepicker("setDate", new Date(set_datetime_picker(d,"+","mdy")) );
			$("#date_end").val(set_datetime_picker(d,"+","dmy"));
			$("#text").text("");
			$("#combo_type option[value='1']").attr("selected","selected");
			$("#other").html("");
			 var value = 0;
			$("input[name=status][value='0']").attr('checked', 'checked');
			$("#save_chronicle").attr('value', 'จัดเก็บข้อมูล');
			$("#pic_list").html('<table id="mytbl" width="500px" cellspacing="1" cellpadding="1"  border="0"><tbody></tbody></table >');
		});
		///////////////////////////////////////// SAVE CHRONICLE
		$("#save_chronicle").click(function() {
			ds = $( "#date_start" ).datepicker( 'getDate' );
			de = $( "#date_end" ).datepicker( 'getDate' );
			var date_s = get_date_picker(ds);
			var time_s = get_time_picker(ds);
			var date_e = get_date_picker(de);
			var time_e = get_time_picker(de);
			if($('#combo_type').val()==99){var other = $('#other_type').val();}
			else{var other = "";}
			var myStatus = $('input[name=status]');
			var checkedValue = myStatus.filter(':checked').val();
			if($( "#save_chronicle" ).attr('value')=="จัดเก็บข้อมูล"){var choice = "add_detail";}
			else{var choice = "upd_detail";}
			var txt = $('#text').val()
			var txt = replaceAll(txt,"\n","|");
			save_Chronicle(choice,$("#r_no").val(),$("#em_pid").val(),date_s,time_s,$('#combo_type').val(),other,txt,checkedValue,date_e,time_e);
		});
		///////////////////////////////////////////// UPLOAD 
		var upload_num = 1;
		var path = "./IMAGE_DETAIL/temp/";
		var filename;
		var ext_file;
		var btnUpload=$('#upload');
		var status=$('#status');
		var upload = new AjaxUpload(btnUpload, {
			action: 'Ajax_detail/upload-file.php',
			name: 'uploadfile',
			onSubmit: function(file, ext){
				ext_file = ext;
				// if (! (ext && /^(jpg|jpeg)$/.test(ext))){ alert(('ไฟล์รูปภาพไม่ถูกต้อง (ใช้ได้เฉพาะ jpg  หรือ jpeg เท่านั้น'));return false;}
				status.text('Uploading...');
				 filename = $("#em_pid").val()+pad(upload_num, 3);
				var upload_data = upload.setData({'filename':filename,'uploaddir':"."+path});
			},
			onComplete: function(file, response){
				status.text('');
				//alert(response);
				if(response==="success"){
					upload_num++;
					var file_path = "./IMAGE_DETAIL/temp/"+filename+"."+ext_file;
					var img = new Image();
					img.src = "."+file_path;
					//alert(img.fileSize);
					 if (! (ext_file && /^(jpg|png|jpeg|gif)$/.test(ext_file))){
						var imageshow = "<a  target='_blank' href='./IMAGE_DETAIL/temp/"+filename+"."+ext_file+"' ><img  id='im' src='./images/doc.jpg' alt='"+filename+"."+ext_file+"' width='70px' height='70px' border='0' ></img></a>"; 
					}
					 else{var imageshow = "<a  target='_blank' href='./IMAGE_DETAIL/temp/"+filename+"."+ext_file+"' ><img  id='im' src='"+path+filename+"."+ext_file+"' alt='"+filename+"."+ext_file+"'  width='100px' height='100px' border='0' ></img></a>";}
					  $('<tr></tr>').appendTo('#mytbl tbody').html( '<td align="middle" width="100px">'+imageshow+'</td><td align="left"><select id="pic_type" name="pic_type" ><option value="1">รูปเหตุการณ์</option><option value="2">เอกสาร</option></select><br><textarea id="pic_detail" maxlength="100" cols="35" rows="4" ></textarea></td><td align="middle"><img class="imgclick" src="./images/delete.gif" alt ="ลบข้อมูล" style="cursor:pointer;cursor:hand;" onClick="javascript:doRemoveItem(this);"/></td>').addClass('success');
				} else{
					status.text('กรุณาลองใหม่อีกครั้ง');
				}
			}
		});
		////////////////////////////////////// LOAD  ON START
		show_list();
		$('#new_chronicle').trigger('click');
		////////////////////////////////////////////
	});
	function save_Time(choice,r_no,pid,catm,datein,timein,dateout,timeout,remark,situation){ ///////////// SAVE TIME
		$.get("Ajax_detail/connect_info.php?ts=<?php echo time();?>", { choice:choice,r_no:r_no,pid:pid,catm: catm,datein:datein,timein:timein,dateout:dateout,timeout:timeout,remark:remark,situation:situation}, 
		function(data){
			var result = data.split("|");
			//alert(result);
			if(result[0]==0){alert(result[1]);}
			else{alert(result[1]);checkIEVersion();}
		}
	);}
	function save_Chronicle(choice,r_no,pid,date_s,time_s,r_type,r_another,r_detail,r_status,date_e,time_e){ //////////////// SAVE CHRONICLE
		$.get("Ajax_detail/connect_detail.php?ts=<?php echo time();?>", { choice:choice,r_no:r_no,pid:pid,date_s:date_s,time_s:time_s,date_e:date_e,time_e:time_e,r_type:r_type,r_another:r_another,r_detail:r_detail,r_status:r_status}, 
		function(data){
			//alert(data);
			var result = data.split("|");
			//alert(result);
			if(result[0]==0){alert(result[1]);}
			else{
				alert(result[1]);
				save_Pic(r_no,pid,date_s,time_s);
				show_list();
			}
		}
	);}
	function save_Pic(r_no,pid,date_s,time_s){ ///////////////// SAVE PIC
	    var pic_info = get_pic_detail();
		//alert(pic_info);
		$.get("Ajax_detail/connect_pic.php?ts=<?php echo time();?>", { choice:"save_pic",r_no:r_no,pid:pid,date_s:date_s,time_s:time_s,pic_info:pic_info}, 
		function(data){
			//alert(data);
			var result = data.split("|");
			//alert(result);
			if(result[0]==0){alert(result[1]);}
			else{$('#new_chronicle').trigger('click');}
		}
	);}
	function show_list(){ ////////////////////////// SHOW LIST CHRONICLE
			$.get("Ajax_detail/connect_detail.php?ts=<?php echo time();?>", { choice:"show_list",r_no:$("#r_no").val()}, 
			function(data){$("#chronicle_list").html(data);}
		);}
	function show_pic(){ /////////////////////////// SHOW LIST PIC  IN CHRONICLE
		ds = $( "#date_start" ).datepicker( 'getDate' );
		var date_s = get_date_picker(ds);
		var time_s = get_time_picker(ds);
		var sec = ds.getSeconds(); 
		var time_s = time_s + "" + (sec<10 ? '0' : '')+sec;
		$.get("Ajax_detail/connect_pic.php?ts=<?php echo time();?>", { choice:"show_pic",r_no:$("#r_no").val(),date_s:date_s,time_s:time_s}, 
		function(data){$("#pic_list").html(data);}
	);}
	function load_chronicle(r_no,date_s,time_s,r_type,r_another,r_detail,r_status,date_e,time_e){ ////////////// LOAD CHRONICLE
		//alert("Load Data");
		if($("#page_now").val()!='detail'){alert("ไม่สามารถแก้ไขข้อมูลได้ หากต้องการแก้ไขให้กลับไปที่หน้า บันทึก/แก้ไขข้อมูลเหตุการณ์");return;}
		var upload_num = 1;
		//if($("#page_now").val()!='detail'){changePage("Ajax_detail/chronicle_detail.php","detail");}
		$('html, body').animate({scrollTop: $(document).height()}, 1500);
		var date_start = set_datetime(date_s,time_s);
		$("#date_start").datepicker("setDate", new Date(date_start) );
		$("#date_start").attr("disabled","disabled");
		$('#date_end').datetimepicker('option', 'minDate', new Date(date_start) );
		var date_end = set_datetime(date_e,time_e);
		$("#date_end").datepicker("setDate", new Date(date_end) );
		$("#combo_type option[value='" + r_type + "']").attr("selected","selected");
		if(r_type==99){$("#other").html(" :: <input type='text' id='other_type'  />");$("#other_type").attr("value",r_another);}
		else{$("#other").html("");}
		var txt = replaceAll(r_detail,"|","\r");
		$("#text").text(txt);
		$("input[name=status][value=" + r_status + "]").attr('checked', 'checked');
		show_pic();
		$("#save_chronicle").attr('value', 'ปรับปรุงข้อมูล');
	}
	function del_chronicle(r_no,date_s,time_s){ ////////////////// DELETE CHRONICLE
		if(confirm('คุณต้องการลบเหตุการณ์นี้หรือไม่')) {
			$.get("Ajax_detail/connect_detail.php?ts=<?php echo time();?>", { choice:"del_detail",r_no:r_no,pid:$("#em_pid").val(),date_s:date_s,time_s:time_s}, 
			function(data){
				var result = data.split("|");
				if(result[0]==0){alert(result[1]);}
				else{show_list();}
			});
		}
	}
	function set_datetime_picker(d,opt,style){
			var month = d.getMonth()+1;
			var day = d.getDate();
			var year = d.getFullYear();
			var hour  = d.getHours();
			var mint = d.getMinutes();
			if(opt=="+"){year = year +543;}
			else if(opt=="-"){year = year -543;}
			else{year = year ;}
			var curTime = (hour<10 ? '0' : '') + hour+':'+(mint<10 ? '0' : '') + mint;
			if(style=="dmy"){var curDate =(day<10 ? '0' : '') + day+'-'+(month<10 ? '0' : '') + month+ '-' + year+' '+curTime;}
			else{var curDate =(month<10 ? '0' : '') + month+ '-' + (day<10 ? '0' : '') + day+'-'+ year+' '+curTime;}
			//alert(curDate);
			return curDate;
	}
	function set_datetime(d,t){ ///////////////////// SET DATE & TIME
		var day = d.substr(6,2);
		var month = d.substr(4,2);
		var year = d.substr(0,4);
		var hour = t.substr(0,2);
		var minute = t.substr(2,2);
		 return  month.toString()+"-"+day.toString()+"-"+year.toString()+" "+hour.toString()+":"+minute.toString();
	}
	function get_date_picker(d){ ///////////////////// SET DATEPICKER
		var month = d.getMonth()+1;
		var day = d.getDate();
		var year = d.getFullYear();
		var date_s =year + (month<10 ? '0' : '') + month+(day<10 ? '0' : '') + day;
		return date_s;
	}
	function get_time_picker(d){ //////////////////// SET TIMEPICKER
		var hour = d.getHours();
		var mint = d.getMinutes();
		var time_s = (hour<10 ? '0' : '') + hour+(mint<10 ? '0' : '') + mint;
		return time_s;
	}
	function get_pic_detail(){ //////////////////////// GET PIC DETAIL STRING
			var rowCount = $('#mytbl tbody tr').length;
			var colCount = 2;
			var StrUpload = rowCount +"|";
			for (var row = 0; row < rowCount; row++) {for (var col = 0; col < colCount; col++) {
					var cell = $('#mytbl tbody tr:eq('+row+') td:eq('+col+')');
					if(col==0){
						//alert(cell.find('img').attr("src"));
						var StrUpload = StrUpload + cell.find('img').attr("alt") + "|";
						var StrUpload = StrUpload + parseInt(row+1) + "|";
					}else{
						//alert(cell.find('select').val());
						var StrUpload = StrUpload + cell.find('select').val() + "|";
						//alert(cell.find('textarea').text());
						var StrUpload = StrUpload + cell.find('textarea').text() + "|";
					}
				}}
			return StrUpload;
	}
	function doRemoveItem(obj){ ////////////// REMOVE PIC
		if($('#mytbl tbody tr').size() > 0){
			if(confirm('คุณต้องการลบแถวนี้?')) $(obj).parent().parent().remove();
		}else{
			alert('ไม่อนุญาตให้ลบแถวที่เหลือนี้ได้');
		}
	}
	function pad(num, size) {
		var s = "000000000" + num;
		return s.substr(s.length-size);
	}
	function replaceAll(str, src, dst) {
			while (str.indexOf(src) !== -1) {
				str = str.replace(src, dst);
			}
			return str;
	}
	$(function(){
	
	});
    </script>
</head>
<body  >
<center>
	<table width="1000" align="center" >
	<?php if($selPage=="start"){ ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////?> 
		<tr bgcolor="#b1b1ed" valign="middle">
			<th colspan="2" align="left"  >บันทึกเวลาเข้าปฏิบัติงาน<span id="upload" style="visibility: hidden;"></span></th>
		</tr>
		<tr height="50px">
			<td colspan="2" align="center"  ><div id="date_stamp"><?php	echo thai_date(1); ?> </div></td>
		</tr>
		<tr>
			<td  colspan="2" align="center"  ><input type='button' value='ยืนยันเวลาเข้างาน' id='add_start'></td>
		</tr>
	<?php }elseif($selPage=="detail"){ ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////?>
	<tr valign="middle">
		<td colspan="2" align="center"   ><h1>เหตุการณ์ต่างๆ ที่เกิดขึ้นก่อนหน้านี้</h1></td>
	</tr>
	<tr height="100px">
		<td colspan="2" align="center" ><div id="chronicle_list"></div></td>
	</tr>
	<tr bgcolor="#b1b1ed" valign="middle">
		<th colspan="2" align="left"  >บันทึกข้อมูลเหตุการณ์ที่เกิดขึ้น</th>
	</tr>
	<tr>
		<td  align="right" width="250px">เริ่มเหตุการณ์:</td><td  align="left" ><input type="text" id="date_start"  readonly="readonly" />&nbsp;จนถึง&nbsp;<input type="text" id="date_end"  readonly="readonly" /></td>
	</tr>
	<!--<tr>
		<td  align="right" width="250px">วันที่เริ่มพบเหตุการณ์:</td><td  align="left" ><input type="text" id="datepicker"  readonly="readonly" /></td>
	</tr>
	<tr>
		<td  align="right"  >เวลาที่เริ่มพบเหตุการณ์:</td><td  align="left" ><input type="text" name="timer" id="timer" value="" readonly="readonly" /></td>
	</tr>-->
	<tr>
		<td  align="right"  >ประเภทของเหตุการณ์:</td><td>
			<select id="combo_type" name="combo_type" >
				<option value="1">ไฟไหม้</option>
				<option value="2">ชุมนุม</option>
				<option value="3">น้ำท่วม</option>
				<option value="4">ทะเลาะวิวาท</option>
				<option value="5">ขโมย</option>
				<option value="99">อื่นๆ</option>
			</select><span id="other"></span>
		</td>
	</tr>
	<tr>
		<td  align="right"  >รายละเอียดของเหตุการณ์:</td><td  align="left" ><textarea id="text" maxlength="100" cols="50" rows="5" ></textarea><div  id="counter"></div></td>
	</tr>
	<tr valign="top">
		<td  align="right"  >รูปภาพเหตุการณ์:</td>
		<td  align="left" >
			
			<div id="upload" ><span>เพิ่มรูปเหตุการณ์<span></div><span id="status" ></span>
			<div id="pic_list"></div>
			<!--<div id="image_list">
				<div  id="image_obj" valign="top">
					<img src="./images/test.jpg" width="120px" height="80px" />
					<select id="pic_type" name="pic_type" ><option value="1">รูปเหตุการณ์</option><option value="2">เอกสาร</option></select>
					<textarea id="pic_detail" maxlength="100" cols="40" rows="3" ></textarea>
					<button>ลบ</button>
				</div>
			</div>-->
		</td>
	</tr>
	<tr>
		<td  align="right"  >สถานะของเหตุการณ์:</td><td  align="left" ><input type='radio' name='status' value='0' checked>&nbsp;ยังดำเนินอยู่<input type='radio' name='status' value='99'>&nbsp;สิ้นสุดเหตุการณ์</td>
	</tr>
	<tr>
		<td  colspan="2" align="center"  ><input type='button' value='จัดเก็บข้อมูล' id='save_chronicle'><input type='button' value='รายการใหม่' id='new_chronicle'></td>
	</tr>
	<tr><td  colspan="2" align="center"  >
	</td></tr>
	<?php }elseif($selPage=="end"){ /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// ?>
	<tr valign="middle">
		<td colspan="2" align="center"   ><h1>เหตุการณ์ต่างๆ ที่เกิดขึ้นก่อนหน้านี้</h1></td>
	</tr>
	<tr height="100px">
		<td colspan="2" align="center" ><div id="chronicle_list"></div></td>
	</tr>
	<tr bgcolor="#b1b1ed" valign="middle">
				<th colspan="2" align="left"  >บันทึกเวลาสิ้นสุดปฏิบัติงาน<span id="upload" style="visibility: hidden;"></span></th>
			</tr>
			<tr>
				<td  align="right"  width="250px"  >หมายเหตุ:</td><td  align="left" ><textarea id="remark"  cols="50" rows="5" ></textarea><div  id="counter1"></div></td>
			</tr>
			<tr>
				<td  align="right"  >สถานการณ์ขณะปฏิบัติงาน:</td><td  align="left" ><input type='radio' name='status' value='0' checked>&nbsp;สถานการณ์ปกติ<input type='radio' name='status' value='1'>&nbsp;สถานการณ์ไม่ปกติ</td>
			</tr>
			<tr>
				<td  colspan="2" align="center"  ><input type='button' value='ยืนยันข้อมูลปฏิบัติงานประจำวัน' id='add_end'></td>
			</tr>
	<?php }?>
</table>
	<div id="divGetData" ></div>
 </center>
</body>
</html>