<html>
<head>
<script src="./js/jquery-1.9.1.min.js" type="text/javascript"></script>

<script>
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
                                if($('#mytbl tbody tr').size() > 0){
                                                if(confirm('คุณต้องการลบแถวนี้?')) $(obj).parent().parent().remove();
												    $.ajax({
																type: "POST",
																url:"del-img.php",
																dataType: 'text',
																cache:false, // กำหนดให้ cache ที่โหลดมาหรือไม่
																async:false,
																contentType: "application/x-www-form-urlencoded;charset=UTF-8",
																data : {} ,
																success:function(data){
																          alert('delete success');
																  }  
													});   
                                }else{
                                                alert('ไม่อนุญาตให้ลบแถวที่เหลือนี้ได้');
                                }
     }

$(document).ready(function(){
function getListAA(cc){
  //  alert("AAAAAAAAA");
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
			//alert("save");
			 var me = $(this);
			 var  aa = $('#sel_aa').val();
			 var  tt = $('#sel_tt').val();
			 var  mm = $('#sel_mm').val();
			  var  mm_desc = $('#mm_desc').val();
			
			 var catm_send;
			 var aa_tmp;
			//  alert ("aa=" + aa);
			//  alert ("tt=" + tt);
		//  alert ("mm=" + mm);
			 // alert ("mm_name=" + mm_name);
			  
	
				
		if(mm!=0){
		                       catm_send = mm;
							//alert ("catm_send=" + catm_send);
							alert ("ยินดีต้อนรับ-" + mm_desc+"(demo)");
				/*   ใช้จริง  ให้เอาออก
				$.ajax({
                       global: false,
                       async: true,
                       type: "POST",
                       url: "make-mm.php",
					   data: {"catm_save":catm_send,"mm_desc":mm_desc},
                       success: function(data) {
						        alert(data);
								alert("yes");
					
						   
                       },
                       error: function(XMLHttpRequest, textStatus, errorThrown) {
                           alert(textStatus + " : " + XMLHttpRequest.status);
                       }
					   
                   });*/
				   
            }else{
				alert("กรุณาเลือกหมู่บ้าน");
			}
				   
			
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
															
																alert ("filename=" + filename);
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
                                                                                                var imageshow = "<a  target='_blank' href='./temp/"+filename+"."+ext_file+"' ><img  class='img' id='im' src='./images/doc.jpg' alt='"+filename+"."+ext_file+"' width='70px' height='70px' border='0' ></img></a>"; 
                                                                                }
                                                                                else{
																				
																				    var imageshow = "<a  target='_blank' href='./temp/"+filename+"."+ext_file+"' ><img class='img' id='im' src='"+file_path+"' alt='"+filename+"."+ext_file+"'  width='100px' height='100px' border='0' ></img></a>";
																				}
                                                                                  $('<tr></tr>').appendTo('#mytbl tbody').html( '<td align="middle" width="100px">'+imageshow+'</td><td align="middle"><img class="imgclick" src="./images/Delete_Icon1.png" alt ="ลบข้อมูล" style="cursor:pointer;cursor:hand;" onClick="javascript:doRemoveItem(this);"/></td>').addClass('success');
																				alert("imgshow"+imageshow);
																} else{
                                                                                status.text('กรุณาลองใหม่อีกครั้ง');
                                                                }
                                                }
                                });
								
				//END UPLOAD
	
	
	
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
        <label for="sel_aa" class="label_title disabled_field">กรุณาเลือกหมู่บ้านที่ต้องการเพิ่มเข้าสู่ระบบศูนย์ข้อมูลและบริการหมู่บ้าน</label>      
        </div>
		<br>
   <form name="frmLS" method="post">
		<div class="input_cond">
        <label for="sel_aa" class="label_title disabled_field">อำเภอ</label>
        <select id="sel_aa" name="sel_aa" style="width:170px;height:23px;">
        </select>
        </div>
		<br>
		
        <div class="input_cond">
        <label for="sel_tt" class="label_title disabled_field">ตำบล</label>
        <select id="sel_tt" name="sel_tt" style="width:170px;height:23px;">
            <option value="0">----- เลือกตำบล -----</option>
        </select>
        </div>
		<br>
		
        <div class="input_cond">
        <label for="sel_mm" class="label_title disabled_field">หมู่บ้าน</label>
        <select id="sel_mm" name="sel_mm" style="width:170px;height:23px;">
            <option value="0">---- เลือกหมู่บ้าน ----</option>
        </select>
        </div>
		  <br>
		  
		   <!-- label for="mm_name" class="label_title disabled_field">ชื่อหมู่บ้าน(ภาษาอังกฤษ)</label>
		  <input type="text" id ="mm_name" name="mm_name"  size="50" maxlength="30">
		  <label for="mm_name" class="label_title disabled_field">ไม่เกิน 30 ตัวอักษร </label -->
		  <br>
		  
		  <!--br>
		 <div id="upload" ><span>เพิ่มรูป header<span></div><span id="status" ></span>
		 <br>
		 <table id="mytbl" width="500px" cellspacing="1" cellpadding="1"  border="0"><tbody></tbody></table >
		<br -->
		
	
	
		<br>
		 <div class="input_cond">
			<input type="button" id="save" name="save" value="เพิ่มหมู่บ้าน" >
		 </div>
		<input type="hidden" id="mm_desc" name="mm_desc" value="" >
	</form>
	 <div class="input_cond">
     <img class='img' src="./images/footer.png"  border='0' ></img>
        </div>
	</center>
	</body>
</html>
