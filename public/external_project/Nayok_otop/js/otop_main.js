var tmp_pic_name="0";


///----------------------- function -----------------------///
function clear_alert(){
	$('#inner_info').removeClass('success');
	$('#inner_info').removeClass('warning');
	$('#inner_info').removeClass('error');
	$('#inner_info').html("");
}		

function add_alert(type, text){
	document.getElementById('inner_info').className="";
	$('#inner_info').addClass(type);
	$('#inner_info').html(text);
}
//--------------------------------------------------------//

function ChkNumber(num_val) {
	if (/(0-9)*/.test(num_val))
		{  return (true)  }
    return (false)
}


function ValidateEmail(mail_val) {
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail_val.value))
		{ return (true)  } else { return (false)	}
}
//--------------------------------------------------------//


$('#photoimg').on('change', function(){ 
	clear_alert();
	    $("#preview").html('<img src="images/loader.gif" alt="Uploading...."/>');
		$('#preview').html("");
		$("#showImg").attr('src', '');
		$("#imageform").ajaxForm({
				target: '#preview',
				type: 'post',
				url:'ajaximage.php'
			}).submit();
		});
		
$('#otop_type,#otop_name,#contract_name,#contract_tel,#contract_addr').on('change',function(){
	clear_alert();  
});
	
$('#submit_btn').on('click',function(){
	rate = $('#star_rate').val();
	if(rate==5||4||3||2||1){
	}else if(rate == null||""){
		alert('dsaf');
		$('#star_rate').val(0);
	}else{
		$('#star_rate').val(0);
	}

if($('#otop_type').val()==0){
	add_alert('warning','กรุณาเลือกประเภทสินค้า');
	exit;
}else if ($('#otop_name').val()==""){
	add_alert('warning','กรุณาใส่ชื่อสินค้า');
	exit;
}else if(($('#contract_name').val())==""){
	add_alert('warning','กรุณาชื่อกลุ่มผู้ผลิต / ชื่อบริษัทผู้ผลิต ');
	exit;
}else if(($('#contract_tel').val())==""){
	add_alert('warning','กรุณากรอกเบอร์โทร');
	exit;	
}else if (!(ChkNumber($('#contract_tel').val()))){
	add_alert('warning','กรุณากรอกเบอร์โทรศัพท์เป็นตัวเลข');
	exit;
}else if($('#contract_addr').val()==""){
	add_alert('warning','กรุณากรอกที่อยู่ผู้ขายสินค้า');
	exit;
}
/*else if(($('#tmp_pic').val())==0){
	add_alert('warning','กรุณาเลือกรูปภาพสินค้า');
	exit;
}else if($('#tmp_pic').val()==tmp_pic_name){
	add_alert('warning','กรุณาเลือกรูปภาพสินค้าอื่น');
	exit;
}
*/
else{
		var func = "save";
		var phpFile = "otop_ajax_data.php";
		var varArray = new Array();
		varArray[0] = $('#ccaattmm').val();
		varArray[1] = $('#emp_id').val();
		varArray[2] = $("#otop_type").val();
		varArray[3] = $('#otop_name').val().toString();
		varArray[4] = $('#otop_group').val();
		varArray[5] = $('#otop_detail').val();
		varArray[6] = $('#contract_name').val();
		varArray[7] = $('#contract_tel').val();
		varArray[8] = $('#contract_addr').val();
		varArray[9] = $('#star_rate').val();
		varArray[10] = $('#tmp_pic').val();
						
		tmp_pic_name = $('#tmp_pic').val();
		url=phpFile+"?action="+func+"&vars="+varArray;
		$("#inner_info").load(url);
						
		}	
});



		
