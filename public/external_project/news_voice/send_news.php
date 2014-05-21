<?php
    session_start();
	
	//echo "catm_login=".$_SESSION['catm_login'];
	//echo "empid=".$_SESSION['EMPID'];
?>
<html>
<head>
<script>
function closeWin(){
        var Browser = {   
            Version: function() {
            var version = 999; // we assume a sane browser
            if (navigator.appVersion.indexOf("MSIE") != -1)
                            // bah, IE again, lets downgrade version number
                version = parseFloat(navigator.appVersion.split("MSIE")[1]);
                return version;
            }
        }
        if (Browser.Version() < 7) {
            window.opener = null;
            window.close();
        }else if (Browser.Version() >= 7){
            window.open('','_parent','');
            window.close();
        }
    }
	</script>
<?php
      if ($_SERVER['SERVER_ADDR'] == "157.179.24.101"){
    //$cc_desc = "จังหวัดนครปฐม";
   // $catm = "73000000";
   
    if (isset($_SESSION['catm_login'])){
        $catm = $_SESSION['catm_login'];
    }else{
        $catm = "26000000";
		$_SESSION['catm_login'] = "26000000";
    }
   
       if (isset($_SESSION['EMPNAME'])){
        $emp_name = $_SESSION['EMPNAME'];
    }else{
        $emp_name = "นางสาวทดสอบ  ระบบงาน";
    }
   // echo "catm == ".$catm."<br/>";
  }else{
     
	       if (isset($_SESSION['catm_login'])){
					$catm = $_SESSION['catm_login'];
			}else{
				$catm = "26000000";
			}
			
			  if (isset($_SESSION['EMPNAME'])){
						$emp_name = $_SESSION['EMPNAME'];
				}else{
							$emp_name = "นางสาวทดสอบ  ระบบงาน";
				}
       
  }
   if (!isset($catm)){
   ?>
   <script>
        alert('คุณไม่มีสิทธิเข้าใช้งานระบบ');
        closeWin();
        //$('#content').find('input, textarea, button, select').attr('disabled','disabled');
   </script>
  <?php  
   }else{  // รองรับ  browser  อื่นๆ  ที่ไม่ยอม  close windows
	
	
?>
<script src="./js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="js/ajaxupload.3.5.js" type="text/javascript" ></script>
<script>
function checkDate(dateInput) {  //ddmmyyyy  พ.ศ.
 
var dateStr = dateInput;
var myDayStr = dateStr.substr(0,2);
var myMonthStr = parseInt(dateStr.substr(2,2),10) - 1;
var myYearStr = parseInt(dateStr.substr(4,4),10) - 543;

/* Using form values, create a new date object
using the setFullYear function */
var myDate = new Date();
myDate.setFullYear( myYearStr, myMonthStr, myDayStr );


	if ( myDate.getMonth() != myMonthStr ) {
	  return 1;
	} else {
	  return 0;
	}
}
function zeroPad(num, numZeros) {
	var n = Math.abs(num);
	var zeros = Math.max(0, numZeros - Math.floor(n).toString().length );
	var zeroString = Math.pow(10,zeros).toString().substr(1);
	if( num < 0 ) {
		zeroString = '-' + zeroString;
	}

	return zeroString+n;
}

function doRemoveItem(obj){ ////////////// REMOVE PIC
	              // alert("delete");
				   //alert("delete"+obj.attr('alt'));
				  var me = $(obj);
				  //var  img_del = $('#mytbl tbody tr td:eq(0) img').attr('alt');
				 // me.parent()
				 
				 var  img_del = me.parent().parent().children(':first').find('a').children('img').attr('alt');
				  // alert("img name="+me.parent().parent().children(':first').find('a').children('img').attr('alt'));
				
							//	alert($('#mytbl tbody tr td:eq(0) img').attr('alt'));		
						//alert("img_del"+img_del);	
						
                               if($('#mytbl tbody tr').size() > 0){
														
                                                if(confirm('คุณต้องการลบแถวนี้?')){
												        	$.ajax({
																	global: false,
																	async: true,
																	type: "POST",
																    url: "deletenews.php",
																	data: {"img_del": img_del},
																		success: function(data) {
																	//	alert(data);
																		alert("ลบข่าวนี้สำเร็จ");
                                                                       $(obj).parent().parent().remove();
																},
																	error: function(XMLHttpRequest, textStatus, errorThrown) {
																	alert(textStatus + " : " + XMLHttpRequest.status);
																}
					   
															});
														
														}
                                }else{
                                                alert('ไม่อนุญาตให้ลบแถวที่เหลือนี้ได้');
                                }
     }

$(document).ready(function(){
function getListAA(cc){
  // alert("AAAAAAAAA");
	
        $.ajax({
            type: "POST",
            url:"getData.php",
            dataType: 'text',
            cache:false, // กำหนดให้ cache ที่โหลดมาหรือไม่
            async:false,
            contentType: "application/x-www-form-urlencoded;charset=UTF-8",
            data : {action: 'getListAA', sel_cc : cc} ,
            success:function(data){
             //   alert(data);
                var items = [];
                var arr_data = data.split('|');
                var i,j;
                var num;
                if (arr_data[0] == 1){
                    items.push('<option value="26000000">----- เลือกอำเภอ ----</option>');
                    num = arr_data[1];
                    j=2;
               
                    for (i=0;i<num;i++){
                        items.push('<option value="' + arr_data[j++] + '">');
                        items.push(arr_data[j++]);
                        items.push('</option>');
                    }
                    $("#sel_aa").html(items.join(''));
                    return true;
                }else if (arr_data[0] == 0){
                    alert('ไม่พบข้อมูลอำเภอ');
                    return true;
                }else if (arr_data[0] == 9){
                    alert('เกิดความผิดพลาด : ' + arr_data[1]);
                    return false;
                }
            }  
        });   
    }

    function getListTT(aa, attr_id){
        $.ajax({
            type: "POST",
            url:"getData.php",
            dataType: 'text',
            cache:false, // กำหนดให้ cache ที่โหลดมาหรือไม่
            async:false,
            contentType: "application/x-www-form-urlencoded;charset=UTF-8",
            data : {action: 'getListTT',sel_aa : aa} ,
            success:function(data){
                //alert(data);
                var items = [];
                var arr_data = data.split('|');
                var i,j;
                var num;
                if (arr_data[0] == 1){
                    num = arr_data[1];
                    j=2;
                    items.push('<option value="0">----- เลือกตำบล -----</option>');
                    for (i=0;i<num;i++){
                        items.push('<option value="' + arr_data[j++] + '">');
                        items.push(arr_data[j++]);
                        items.push('</option>');
                    }
                        $("#sel_tt").html(items.join(''));
                }else if (arr_data[0] == 0){
                        alert('ไม่พบข้อมูลตำบลของอำเภอ'+$("#sel_aa option:selected").text());
                    return true;
                }else if (arr_data[0] == 9){
                    alert('เกิดความผิดพลาด : ' + arr_data[1]);
                    return false;
                }
            }  
        });   
    }
    
    function getListMM(tt,attr_id){
        $.ajax({
            type: "POST",
            url:"getData.php",
            dataType: 'text',
            cache:false, // กำหนดให้ cache ที่โหลดมาหรือไม่
            async:false,
            contentType: "application/x-www-form-urlencoded;charset=UTF-8",
            data : {action : 'getListMM', sel_tt : tt} ,
            success:function(data){
                var items = [];
                var arr_data = data.split('|');
                var i,j;
                var num;
                if (arr_data[0] == 1){
                    num = arr_data[1];
                    j=2;
                    items.push('<option value="0">----- เลือกหมู่บ้าน ----</option>');
                    for (i=0;i<num;i++){
                        items.push('<option value="' + arr_data[j++] + '">');
                        items.push(arr_data[j++]);
                        items.push('</option>');
                    }
                    $("#sel_mm").html(items.join(''));
                    return true;
                }else if (arr_data[0] == 0){
                        alert('ไม่พบข้อมูลหมู่บ้านของตำบล'+$("#sel_tt option:selected").text());
                    return true;
                }else if (arr_data[0] == 9){
                    alert('เกิดความผิดพลาด : ' + arr_data[1]);
                    return false;
                }
            }  
        });
    
    }
	


	
	getListAA(26);
	
	$("#sel_aa").change(function(e) {
      $("#sel_mm").html('<option value="0">----- เลือกหมู่บ้าน ----</option>');
      $("#sel_tt").html('<option value="0">----- เลือกตำบล ----</option>');
	  var  aa = $('#sel_aa').val();
	 // alert ("aa=" + aa);
		if(aa!=26000000){
			getListTT($(this).val(),"sel_aa");
		}
     
    });
        
    $("#sel_tt").change(function(e) {

        $("#sel_mm").html('<option value="0">----- เลือกหมู่บ้าน ----</option>');
        $("#tt_desc").val('ตำบล'+$(this).find('option:selected').text());
		
		var  tt = $('#sel_tt').val();
	    // alert ("tt=" + tt);
			if(tt!=0){
				getListMM($(this).val(),"sel_tt");
			}
        
    });
    
    $("#sel_mm").change(function(e) {
            $("#mm_desc").val('หมู่บ้าน'+$(this).find('option:selected').text());
    });
	

	
	  $("#save").click(function(e) {
		//	alert("save");
		   if($('#mytbl tbody tr').size() == 0){
		       alert("กรุณาเพิ่มข่าวก่อนกดปุ่มบันทึก");
		   }else{
			 var me = $(this);
			 var  aa = $('#sel_aa').val();
			 var  tt = $('#sel_tt').val();
			 var  mm = $('#sel_mm').val();
			 var  img=$('#im').attr('alt');
			 var  head_news=$('#pic_detail').val();
			 var catm_send;
			 var aa_tmp;
			  var tmp_head;
			  var flag;	  
			  var flag_expirenews;
			  var flag_date=0;
			 // alert ("aa=" + aa);
			//  alert ("tt=" + tt);
			 // alert ("mm=" + mm);
			  
			  var news_all = Array();
			  var headnews_array = Array();
			   var expirenews_array = Array();
			  	aa_tmp  =  aa.substring(2,7);
			  if(aa_tmp == 0){
					  catm_send = aa;
				}
				else if(tt==0 && mm ==0){
					    catm_send = aa;
				}else if(tt!=0 && mm ==0){
						catm_send = tt;
			    }else{
					     catm_send = mm;
				}
						

			$('.img_news').each(function() {
				  news_all.push($(this).attr('alt'));
			 //  alert ("img_name=" +$(this).attr('alt'));
				 
				  
			});
			  //  alert(news_all.toSource());
			  //     alert ("news_all=" + news_all);
				   
			$('.head_news').each(function() {
				  headnews_array.push($(this).val());
				    //  alert ("headnews=" +$(this).val());
				   tmp_head = $(this).val();
				    //  alert ("head_news=" +tmp_head);
					  if (tmp_head.length== 0){
						 flag=1;
					  }
			  });
			  
			 
			 	   
			$('.expire_news').each(function() {
				  expirenews_array.push($(this).val());
				    //  alert ("headnews=" +$(this).val());
				   tmp_head = $(this).val();
				   //  alert ("expire_news=" +tmp_head);
					  if (tmp_head.length== 0){
						 flag_expirenews=1;
					  }else if (tmp_head.length!=8){
						 flag_expirenews=2;
					  }else{
					 // alert("checkdate");
							if(checkDate(tmp_head)==1) {
									flag_date=1;
							}
					  }
					 // alert ("flag_expirenews=" +flag_expirenews);
					 // alert ("flag_date=" +flag_date);
			  });
            
			if(flag ==1){
			    alert('กรุณาบันทึกหัวข้อข่าว');
			}else if(flag_expirenews ==1){
				alert('กรุณาบันทึกวันสุดท้ายของการประชาสัมพันธ์ข่าว');
			}else if(flag_expirenews ==2){
				alert('กรุณาบันทึกวันสุดท้ายของการประชาสัมพันธ์ข่าว ให้ครบ 8 หลัก');
			}else if(flag_date ==1){
				alert('กรุณาบันทึกวันสุดท้ายของการประชาสัมพันธ์ข่าวให้ถูกต้อง');
			}else{
			
			  //alert ("catm_send=" + catm_send);
			   $.ajax({
                       global: false,
                       async: true,
                       type: "POST",
                       url: "savenews.php",
					   data: {"news": news_all, "headnews": headnews_array,"catm_save":catm_send,"expirenews":expirenews_array},
                       success: function(data) {
					              //alert(data);
					           var arr_data = data.split('|');
						
							if (arr_data[0] == 99){
						  
								    alert("ไม่สามารถส่งข่าวประชาสัมพันธ์ได้");
								}else{
									 alert("ส่งข่าวประชาสัมพันธ์เรียบร้อย");
									   $('#mytbl tbody').html('');
								}
					
						   
                       },
                       error: function(XMLHttpRequest, textStatus, errorThrown) {
                           alert(textStatus + " : " + XMLHttpRequest.status);
                       }
					   
                   });
			}
			
		}
			 // alert ("img=" + img);
			  // alert ("head_news=" + head_news);
    });
	


	//UPLOAD IMAGES
	                           var upload_num = 1;
                                var path = "/temp/";
                                var filename;
                                var ext_file;
                                var btnUpload=$('#upload');
                                var status=$('#status');
								
								
								
                                var upload = new AjaxUpload(btnUpload, {
                                                action: 'upload-file.php',
                                                name: 'uploadfile',
                                                onSubmit: function(file, ext){
																 var me = $(this);
																var  aa = $('#sel_aa').val();
																var  tt = $('#sel_tt').val();
																var  mm = $('#sel_mm').val();
								
																//var now = new Date();
																var thistime = new Date();
																var myyear = thistime.getFullYear();
															
																var mymonth = thistime.getMonth();
																var mydate = thistime.getDate();
																var myhour = thistime.getHours();
																var myminute = thistime.getMinutes();
																var mysecond = thistime.getSeconds();
																var month;
																var date;
																var hour;
																var minute;
																var second;
															    var aa_tmp;   
																//now.format("dd/M/yy h:mm tt"); 
																//alert ("aa=" + aa);
																//alert ("tt=" + tt);
																//alert ("mm=" + mm);
																//alert ("myyear="+myyear+"mymonth="+mymonth+"mydate="+mydate+"myhour="+myhour+"myminute="+myminute+"mysecond="+mysecond);
																//alert(myyear.substring(1,2));
														
																//alert ("now="+now);
															  //   alert ("myyear_sub="+myyear_sub+"mymonth="+mymonth+"mydate="+mydate+"myhour="+myhour+"myminute="+myminute+"mysecond="+mysecond);
																mymonth = mymonth+1;
																month=zeroPad(mymonth,2);
																date = zeroPad(mydate,2);
																hour = zeroPad(myhour,2);
																minute = zeroPad(myminute,2);
																second = zeroPad(mysecond,2);
															//	alert ("mymonth=" + month);
																aa_tmp  =  aa.substring(2,7);
																//alert ("aa_tmp=" + aa_tmp);
																if(aa_tmp == 0){
																     filename = aa+myyear+month+date+hour+minute+second;
																  }
																else if(tt==0 && mm ==0){
																	filename = aa+myyear+month+date+hour+minute+second;
																}else if(tt!=0 && mm ==0){
																   filename = tt+myyear+month+date+hour+minute+second;
																}else{
																   filename = mm+myyear+month+date+hour+minute+second;
																}
																//alert ("filename=" + filename);
																ext_file = ext;
                                                                // if (! (ext && /^(jpg|jpeg)$/.test(ext))){ alert(('ไฟล์รูปภาพไม่ถูกต้อง (ใช้ได้เฉพาะ jpg  หรือ jpeg เท่านั้น'));return false;}
                                                                status.text('Uploading...');
                                                                //filename = $("#em_pid").val()+pad(upload_num, 3);
																//filename="test";
                                                                var upload_data = upload.setData({'filename':filename,'uploaddir':"."+path});
                                                },
                                                onComplete: function(file, response){
                                                                status.text('');
                                                             //   alert(file);
                                                            //    alert(response);
                                                                if(response==="success"){
                                                                                upload_num++;
                                                                                var file_path = "./temp/"+filename+"."+ext_file;
                                                                                var img = new Image();
                                                                                img.src = "."+file_path;
                                                                                //alert(img.fileSize);
                                                                                if (! (ext_file && /^(jpg|png|jpeg|gif)$/.test(ext_file))){
                                                                                                var imageshow = "<a  target='_blank' href='./temp/"+filename+"."+ext_file+"' ><img  class='img_news' id='im' src='./images/doc.jpg' alt='"+filename+"."+ext_file+"' width='70px' height='70px' border='0' ></img></a>"; 
                                                                                }
                                                                                else{
																				
																				    var imageshow = "<a  target='_blank' href='./temp/"+filename+"."+ext_file+"' ><img class='img_news' id='im' src='"+file_path+"' alt='"+filename+"."+ext_file+"'  width='100px' height='100px' border='0' ></img></a>";
																				}
                                                                                  $('<tr></tr>').appendTo('#mytbl tbody').html('<td align="middle" width="100px"><br>'+imageshow+file+'</td><td align="left"><br>หัวข้อข่าว(100 ตัวอักษร)<textarea class="head_news" id="pic_detail" maxlength="100" cols="35" rows="4" ></textarea></td><td align="left">วันเดือนปีพ.ศ. สุดท้ายของการประชาสัมพันธ์ข่าว(8 ตัวอักษร)<input class="expire_news" id="expire_news" maxlength="8"></td><td align="middle"><img class="imgclick" src="./images/Delete_Icon1.png" alt ="ลบข้อมูล" style="cursor:pointer;cursor:hand;"  onClick="javascript:doRemoveItem(this);"/></td>').addClass('success');
																			//	alert("imgshow"+imageshow);
																} else{
                                                                                status.text('กรุณาลองใหม่อีกครั้ง');
                                                                }
                                                }
                                });
	
 });
 
                              


</script>
<style type="text/css">  
#upload{
           font-weight:normal; font-size:1.0em;
    font-family:Georgia,Arial, Helvetica, sans-serif;
    text-align:center;
    background:#bb2211;
    color:#ffffff;
    border:2px solid #DADADA;
    width:150px;
    cursor:pointer !important;
    -moz-border-radius:5px; -webkit-border-radius:5px;
}

</style>
</head>
<body>
	
<center>
   <div class="input_cond">
     <img class='img' src="./images/header.png"  border='0' ></img>
        </div>
	<div class="input_cond">
        <label for="emp_name" class="label_title disabled_field"><?php echo "ชื่อผู้ปฎิบัติงาน : ".$emp_name;?></label>      
    </div>
	<br>
	<div class="input_cond">
        <label for="sel_aa" class="label_title disabled_field">กรุณาเลือกสถานที่ปลายทางที่ต้องการส่งข่าว</label>      
        </div>
		<br>
   <form id="frmmain" name="frmLS" method="post">
		<div class="input_cond">
        <label for="sel_aa" class="label_title disabled_field">อำเภอ</label>
        <select id="sel_aa" name="sel_aa" style="width:170px;height:23px;">
        </select>
        </div>
		<br>
		
        <div class="input_cond">
        <label for="sel_tt" class="label_title disabled_field">ตำบล</label>
        <select id="sel_tt" name="sel_tt" style="width:170px;height:23px;">
            <option value="0">----เลือกตำบล -----</option>
        </select>
        </div>
		<br>

        <div class="input_cond">
        <label for="sel_mm" class="label_title disabled_field">หมู่บ้าน</label>
        <select id="sel_mm" name="sel_mm" style="width:170px;height:23px;">
            <option value="0">-----เลือกหมู่บ้าน ----</option>
        </select>
        </div>
		  <br>
		 <div id="upload" ><span>เพิ่มข่าว<span></div><span id="status" ></span>
		 <br>
		 <table id="mytbl" width="850px" cellspacing="1" cellpadding="1"  border="0"><tbody></tbody></table >
		<br>
		 <div class="input_cond">
			<input type="button" id="save" name="save" value="บันทึก" >
		 </div>
		
	</form>
	
</center>	
<?php
    }
?>
	</body>
</html>
