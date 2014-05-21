<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="lib/js/jquery-1.9.0.min.js" type="text/javascript"></script>
<script src="js/custom_search.js" type="text/javascript"></script>
<script src="ui/jquery-ui.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="ui/themes/jquery-ui.min.css" type="text/css" />
<link rel="stylesheet" href="css/search_stat.css" type="text/css" >

<!--chart-->
<script src="plugin/Highcharts-3.0.1/js/highcharts.js"></script>
<script src="plugin/Highcharts-3.0.1/js/modules/exporting.js"></script>

<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="plugin/fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="plugin/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />
<style>
	
</style>
<title>ตรวจสอบรายการคนและบ้าน</title>
</head>

<body >


<?php  
	include "include/stat_func_extend.php";
	include "include/stat_func.php";
	
	$emp_job = $_POST['emp_job'];
	$emp_rcode = $_POST['emp_rcode'];
	$emp_ccaattmm = $_POST['emp_ccaattmm'];
	
	$emp_ccaattmm = 26010101;

	$cc=substr($emp_ccaattmm,0,2);
	$aa=substr($emp_ccaattmm,2,2);
	$tt=substr($emp_ccaattmm,4,2);
	$mm=substr($emp_ccaattmm,6,2);
	
	$emp_rcode=2601;
	$emp_job=2;
	
?>

<div class="layout"  style="background:#E0E7EF; padding 10px; width:953px; margin: 0px auto;">	
	<div id="header" class="main_heading" >โปรแกรมตรวจสอบรายการสถิติ</div>
	<form id="frm_search" name="frm_search" >

	<div id="tabs">
	  <ul>
			<li id="tab1" onclick='tab_table1();'><a href="#tabs-1" >ตรวจสอบสถิติรายการคน</a></li>
			<li id="tab2" onclick='tab_table2();'><a href="#tabs-2" >ตรวจสอบสถิติรายอายุ</a></li>
			<li id="tab3" onclick='tab_table3();'><a href="#tabs-3" >ตรวจสอบสถิติรายการบ้าน</a></li>
	   </ul>
	<!------------------------------------- Tab 1 ---------------------------------------------------->
		<div id="tabs-1" style="margin-bottom:15px;">
			<div class="input_cond"style="padding-top:20px;">
				<label class="label_title" >ปี พ.ศ. : </label>
				<select id="sel_year1"  style="width:175px" >
						<?php echo genDate();?>
				</select>               
				<span class="label_title_back">เดือน : </span>
				<select id="sel_month1" style="width:175px" >
						<?php echo genMonth(); ?> 
			  </select>
			</div>   
		   <div class="input_cond">

				<div class='select_option' style="padding-left:93px;">
					
					<label  class="label_title_back">จังหวัด : </label>
					<select id="sel_province1"  style="width:175px"  onchange="dataOption('sel_ampor1','gen_ampor',this.value,'');" >
						<option value=26> นครนายก </option>
						<?php //gen_province();?>
					</select>			
					<label  class="label_title_back">อำเภอ : </label>
					<select id="sel_ampor1" style="width:175px"  onchange=" dataOption('sel_tumbon1','gen_tumbon',this.value,''); ">
						<option value='000000'>- เลือกอำเภอ -</option>
					</select>
					<label  class="label_title_back">ตำบล : </label>
					<select id="sel_tumbon1" style="width:175px"  onchange="dataOption('sel_mooban1','gen_mooban',this.value,'');" >
						<option value='000000'>- เลือกตำบล -</option>
					</select>
					<label  class="label_title_back">หมู่บ้าน : </label>
					<select id="sel_mooban1" style="width:175px" >
						<option value='00000000'>- เลือกหมู่บ้าน -</option>
					</select>
				</div>
			</div>
		   
	 
		   <div class="input_cond"> 			
				 <label class="label_title" >เงื่อนไข : </label>
				<label  class="chk_box_title3">สถานภาพบุคคลที่มีสัญชาติไทย</label>
				<span  class=""><input type="checkbox" id="chk_thai_all" name="chk_thai_all" value="chk"/><label for="chk_thai_all">ทั้งหมด</label></span>
				<span  class=""><input type="checkbox" id="chk_thai_nor" name="chk_thai_nor" value="chk" /><label for="chk_thai_nor"> "ปกติ"</label></span>
				<span  class=""><input type="checkbox" id="chk_thai_dead" name="chk_thai_dead" value="chk" /><label for="chk_thai_dead"> "ตาย"</label></span>
				<span  class=""><input type="checkbox" id="chk_thai_alert" name="chk_thai_alert" value="chk" /><label for="chk_thai_alert"> "เฝ้าระวัง"</label></span>
				<span  class=""><input type="checkbox" id="chk_thai_sold" name="chk_thai_sold" value="chk" /><label for="chk_thai_sold"> "จำหน่าย"</label></span>
		   </div> 
		   <div class="input_cond">
				<label class="label_title" for="chk_chi_all"></label>
				<label  class="chk_box_title3">สถานภาพบุคคลที่มีสัญชาติจีน</label>
				<span  class=""><input type="checkbox" id="chk_chi_all" name="chk_chi_all" value="chk" /><label for="chk_chi_all">ทั้งหมด</label></span>
				<span  class=""><input type="checkbox" id="chk_chi_nor" name="chk_chi_nor" value="chk" /><label for="chk_chi_nor"> "ปกติ"</label></span>
				<span  class=""><input type="checkbox" id="chk_chi_dead" name="chk_chi_dead" value="chk" /><label for="chk_chi_dead"> "ตาย"</label></span>
				  <span  class=""><input type="checkbox" id="chk_chi_alert" name="chk_chi_alert" value="chk" /><label for="chk_chi_alert"> "เฝ้าระวัง"</label></span>
				<span  class=""><input type="checkbox" id="chk_chi_sold" name="chk_chi_sold" value="chk" /><label for="chk_chi_sold"> "จำหน่าย"</label></span>
		   </div>
		   <div class="input_cond">
				<label class="label_title" for="chk_oth_all"></label>
				<label  class="chk_box_title3">สถานภาพบุคคลที่มีสัญชาติอื่น</label>
				<span  class=""><input type="checkbox" id="chk_oth_all" name="chk_oth_all" value="chk" /><label for="chk_oth_all">ทั้งหมด</label></span>
				<span  class=""><input type="checkbox" id="chk_oth_nor" name="chk_oth_nor" value="chk" /><label for="chk_oth_nor"> "ปกติ"</label></span>
				<span  class=""><input type="checkbox" id="chk_oth_dead" name="chk_oth_dead" value="chk" /><label for="chk_oth_dead"> "ตาย"</label></span>
				  <span  class=""><input type="checkbox" id="chk_oth_alert" name="chk_oth_alert" value="chk" /><label for="chk_oth_alert"> "เฝ้าระวัง"</label></span>
				<span  class=""><input type="checkbox" id="chk_oth_sold" name="chk_oth_sold" value="chk" /><label for="chk_oth_sold"> "จำหน่าย"</label></span>
		   </div>

		  <div class="center_box" >
					<input type="button" id="btn_submit_tab1" value="ตรวจสอบ" class="button" onclick="page_data(); active_btn(1);"/>
					<input type="button" id="btn_clear_tab1" value="ลบหน้าจอ" class="button" >
		  </div>
		</div><!--//end Tab1-->
		
		<!----------------------------------------- Tab 2 -------------------------------------------- -->

		<div id="tabs-2"> <!--ตรวจสอบสถิติรายอายุ-->
		
			<div class="input_cond">
				<label for="sel_year2" class="label_title"style="padding-top:20px;">ปี พ.ศ. :</label>
				<select id="sel_year2" style="width:175px" >
						<?php echo genDate();?>
				</select>               
				<label for="sel_month2" class="label_title_back">เดือน :</label>
				<select id="sel_month2" style="width:175px" >
						<?php echo genMonth(); ?> 
			  </select>
			</div>
			<div class="input_cond" >
				<div class='select_option' style="padding-left:93px;">
					<label  class="label_title_back">จังหวัด :</label>
					<select id="sel_province2" style="width:175px"  onchange="dataOption('sel_ampor2','gen_ampor',this.value,'');" >
						<option value=26>นครนายก</option>
						<?php //gen_province();?>
					</select>			
					<label  class="label_title_back">อำเภอ :</label>
					<select id="sel_ampor2" style="width:175px"  onchange="  dataOption('sel_tumbon2','gen_tumbon',this.value,'');">
						<option value='000000'>- เลือกอำเภอ -</option>
					</select>
					<label  class="label_title_back">ตำบล :</label>
					<select id="sel_tumbon2" style="width:175px"  onchange="dataOption('sel_mooban2','gen_mooban',this.value,'');" >
						<option value='000000'>- เลือกตำบล -</option>
				
					</select>
					<label  class="label_title_back">หมู่บ้าน :</label>
					<select id="sel_mooban2" style="width:175px" >
						<option value='00000000'>- เลือกหมู่บ้าน -</option>
					</select>
				</div>
				<div class="center_box" >
					<input type="button" id="btn_submit_tab2" value="ตรวจสอบ" class="button" onclick="page_age(); active_btn(1);"/>
					<input type="button" id="btn_clear_tab2" value="ลบหน้าจอ" class="button"/>
			   </div>
			</div>
		</div> <!--/end tab2-->

	<!------------------------------------- Tab 3 ---------------------------------------------------->
	<div id="tabs-3" style="margin-bottom:15px;">
			<div class="input_cond"style="padding-top:20px;">
				<label class="label_title" >ปี พ.ศ. : </label>
				<select id="sel_year3"  style="width:175px" >
						<?php echo genDate();?>
				</select>               
				<span class="label_title_back">เดือน : </span>
				<select id="sel_month3"  style="width:175px" >
						<?php echo genMonth(); ?> 
			  </select>
			</div>
		   <div class="input_cond" >
				<div class='select_option' style="padding-left:93px;">			
					<label  class="label_title_back">จังหวัด : </label>
					<select id="sel_province3"  style="width:175px" onchange="dataOption('sel_ampor3','gen_ampor',this.value,'');" >
						<option value=26>นครนายก</option>
						<?php //gen_province();?>
					</select>			
					<label  class="label_title_back">อำเภอ : </label>
					<select id="sel_ampor3" style="width:175px"  onchange=" dataOption('sel_tumbon3','gen_tumbon',this.value,'');">
						<?php gen_ampor(26);?>
					</select>
					<label  class="label_title_back">ตำบล : </label>
					<select id="sel_tumbon3"  style="width:175px"  onchange="dataOption('sel_mooban3','gen_mooban',this.value,'');" >
						<option value='000000'>- เลือกตำบล -</option>
			
					</select>
					<label  class="label_title_back">หมู่บ้าน : </label>
					<select id="sel_mooban3" style="width:175px" >
						<option value='00000000'>- เลือกหมู่บ้าน -</option>
					</select>
				</div>
			</div>
		   <div class="center_box" >
				<input type="button" id="btn_submit_tab3" value="ตรวจสอบ" class="button" onclick="page_house(); active_btn(1);">
				<input type="button" id="btn_clear_tab3" value="ลบหน้าจอ" class="button">
		   </div>
		 
		</div><!--//end Tab1-->
	</div> <!--//end div content-->
			<div id="result"></div><!--end div result-->
			<div id="result2"></div><!--end div result-->
			<div id="result3"></div><!--end div result-->
	</div>
</div>

<div id="footer" >
    <div id="msg"></div>
</div>
 
<br><br>
<div id = "preload" style="display:none;"></div>
</body>


<script type ="text/javascript">	
										///////////////////////////////////// Main Ajax Function ////////////////////////////////////////  
													
															//////////////// Ajax Option function ///////////////////
	function  dataOption(load_id,func,value,self){
		var phpFile="ajax_gen.php";
		url=phpFile+"?action="+func+"&vars="+value+"&self="+self;
		$("#"+load_id).load(url);	
	}
	
	function preloadOpen(){
		$.fancybox.open({
			scrolling : 'hidden',
			href : "include/preload.php",
			type : 'iframe',
			autoSize:false,
			closeBtn: false,
			height : 150,
			width  : 150,          
			padding : 0
		});
	}
	
	function preloadClose(){
		parent.$.fancybox.close();
	}
	
	
																/////////////// Ajax Page data ////////////////////////
	function page_data(val){ // chk _condition
		var ccaattmm;
		var emp_job_sel;
		var ampor = document.getElementById('sel_ampor1').value; 
		var mooban = document.getElementById('sel_mooban1').value; 
		var tumbon = document.getElementById('sel_tumbon1').value; 
		
		if (mooban!=00000000){
			ccaattmm = mooban;
			emp_job_sel = 8;
			}else if (tumbon!=000000){
				ccaattmm = tumbon;
				emp_job_sel = 9;
				}else if (ampor!=0000){
					ccaattmm = ampor;
					emp_job_sel = 1;
					}else{
						ccaattmm = 26000000;
						emp_job_sel = 2;
						}
			
			if(chk_poptype()=="000"){
				alert("กรุณาเลือกเงื่อนไขอย่างน้อยหนึ่งรายการ");
				exits();
				}
			if(document.getElementById('sel_year1').value=="00"){
				alert ("กรุณาเลือกปี");
				exits();
				}else if (document.getElementById('sel_month1').value=="00"){
					alert("กรุณาเลือกเดือน");
					exits();
					}	
					
			var phpFile="ajax_data"+".php";
			var func="phpFunction";
			var thai_option=chk_return('chk_thai_nor')+chk_return('chk_thai_dead')+chk_return('chk_thai_alert')+chk_return('chk_thai_sold');
			var chi_option =chk_return('chk_chi_nor')+chk_return('chk_chi_dead')+chk_return('chk_chi_alert')+chk_return('chk_chi_sold');
			var oth_option =chk_return('chk_oth_nor')+chk_return('chk_oth_dead')+chk_return('chk_oth_alert')+chk_return('chk_oth_sold'); 
			var varArray = new Array();
			
			varArray[0] =val;
			varArray[1] = (document.getElementById('sel_year1').value).toString()+document.getElementById('sel_month1').value;
			varArray[2] = thai_option;
			varArray[3] = chi_option;
			varArray[4] = oth_option;
			varArray[5] = chk_poptype(); ///pop type
			varArray[6] = ccaattmm;
			varArray[7] = emp_job_sel;
			varArray[8] = <?php echo $emp_rcode;?>; 
			
			/*
			province = $("#sel_province1 option:selected").html();
			ampor = $("#sel_ampor1 option:selected").html();
			tumbon = $("#sel_tumbon1 option:selected").html();
			mooban = $("#sel_mooban1 option:selected").html();
			*/
			varArray[9]="ไทย";
		
			
			url=phpFile+"?action="+func+"&vars="+varArray;
			$("#result").load('blank.php');
			$("#result").load(url);
			
			
	}// end page_data ----------
	  
	  
																		 ////////////////// Ajax Page Age ////////////////////////
	function page_age(val,sub_page){ // chk _condition
		preloadOpen();
			var ccaattmm;
			var emp_job_sel;
			var ampor = document.getElementById('sel_ampor2').value; 
			var mooban = document.getElementById('sel_mooban2').value; 
			var tumbon = document.getElementById('sel_tumbon2').value; 
			
			if (mooban!=00000000){
				ccaattmm = mooban;
				emp_job_sel = 8;
				}else if (tumbon!=000000){
					ccaattmm = tumbon;
					emp_job_sel = 9;
					}else if (ampor!=0000){
						ccaattmm = ampor;
						emp_job_sel = 1;
						}else{
							ccaattmm = 26000000;
							emp_job_sel = 2;
							}
			
			if(document.getElementById('sel_year2').value=="00"){
				alert ("กรุณาเลือกปี");
				exits();
				}else if (document.getElementById('sel_month2').value=="00"){
					alert("กรุณาเลือกเดือน");
					exits();
					}	
			var phpFile="ajax_age"+".php";
			var func="phpFunction";
			var varArray = new Array();
			varArray[0] =val;
			varArray[1] = (document.getElementById('sel_year2').value).toString()+document.getElementById('sel_month2').value;
			varArray[2] = ccaattmm;
			varArray[3] = emp_job_sel;
			varArray[4] = <?php echo $emp_rcode; ?>;
			url=phpFile+"?action="+func+"&vars="+varArray;

			$("#result2")
				.load('blank.php')
				.load(url,function(){
					
					// parent.$.fancybox.close();
				});
			
    }//end page_age-------------------------
	
	$(".fancybox-overlay").css( "width", "800" );
	

																		///////////////////// Ajax Page House ////////////////////////
	function page_house(){ // chk _condition
			var ccaattmm;
			var emp_job_sel;
			var ampor = document.getElementById('sel_ampor3').value; 
			var mooban = document.getElementById('sel_mooban3').value; 
			var tumbon = document.getElementById('sel_tumbon3').value; 
			if (mooban!=00000000){
				ccaattmm = mooban;
				emp_job_sel = 8;
				}else if (tumbon!=000000){
					ccaattmm = tumbon;
					emp_job_sel = 9;
					}else if (ampor!=0000){
						ccaattmm = ampor;
						emp_job_sel = 1;
						}else{
							ccaattmm = 26000000;
							emp_job_sel = 2;
							}
		
				if(document.getElementById('sel_year3').value=="00"){
					alert ("กรุณาเลือกปี");
					exits();
					}else if (document.getElementById('sel_month3').value=="00"){
						alert("กรุณาเลือกเดือน");
						exits();
						}	
				var phpFile="ajax_house"+".php";
				var func="phpFunction";
				var varArray = new Array();
				varArray[0] ="";
				varArray[1] = (document.getElementById('sel_year3').value).toString()+document.getElementById('sel_month3').value;
				varArray[2] = ccaattmm;
				varArray[3] = emp_job_sel;
				varArray[4] = <?php echo $emp_rcode;?>; 
				url=phpFile+"?action="+func+"&vars="+varArray;
				//alert(url);
				$("#result3").load('blank.php');
				$("#result3").load(url);
				
		}
											///////////////////////////////////////////////////// End Main Ajax Function ////////////////////////////////////////

																		//////////////////////// Tool Function section ///////////////////////////////
////////// return .check value  to "1" or "0"
		function chk_return(id1){
			var ans;
			if(document.getElementById(id1).checked){
				ans="1";}
				else {ans="0";}
			return (ans);
		} //end chk_return
		
		
////////// convert "1" to "true" or "0" to "false"
		function to_bool(val){
		// if val = id	   || require chk_return then convert
			if(val==1||val==true||val==0||val==false){
				}else{
				val=chk_return(val);
			}				
			if(val==1 ||val==true){
				val=true;
				}else if (val==0||val==false){
					val=false;}
			return val;
		}//end to_bool
		
		
///////// set check box to : "1" or "true"	to true, "0" or "false" to false
		function set_chk(id1,boolean){
		//set	check box to "true" or "false"	
			boolean=to_bool(boolean);
			document.getElementById(id1).checked=boolean;
		}//end set_chk
		
		
///////// Display pack section /////////
		function switch_display(name,stat){
			if((stat==0)||(stat==false)){
				document.getElementById(name).style.display="none";
				}else{
					document.getElementById(name).style.display="block";}
		}//enc function switch_display
		
		function tab_table1(){	switch_display('result',1); switch_display('result2',0); switch_display('result3',0);	}		
		function tab_table2(){	switch_display('result',0); switch_display('result2',1); switch_display('result3',0);	}		
		function tab_table3(){	switch_display('result',0); switch_display('result2',0); switch_display('result3',1);	}		
	
		
////////// chk_pop type return "0" or "1":: require chk_return()
		function chk_poptype(){
			var thai ="";
			var chi =""; 
			var oth ="";
			if((to_bool('chk_thai_nor')||to_bool('chk_thai_dead'))||to_bool('chk_thai_alert')||to_bool('chk_thai_sold')){
				thai =1;	}else{	thai =0;}
			if((to_bool('chk_chi_nor')||to_bool('chk_chi_dead'))||to_bool('chk_chi_alert')||to_bool('chk_chi_sold')){
				chi =1;	}else{	chi =0;}
			if((to_bool('chk_oth_nor')||to_bool('chk_oth_dead'))||to_bool('chk_oth_alert')||to_bool('chk_oth_sold')){
				oth =1;	}else{ oth =0;}
			return(thai.toString()+chi.toString()+oth.toString());
		}

		

										           ///////////////////////   Plugin  enable Disable ////////////////////
////////////  .disable .enable																		
			(function($)  {
				$.fn.disable = function() {return this.attr('disabled', true).addClass('disabled');}
				$.fn.enable = function() {return this.removeClass('disabled').attr('disabled', false);}
			})(jQuery);

													//////////////////////////// Jquery .ready  //////////////////////////////

$(function() {	
		start_tab1();
		start_tab2();
		start_tab3();
													///////////  Button Interaction section	//////////////
///////////  clear  button /////
		$('#btn_clear_tab1').on('click',function(){
			$('#result').load('blank.php');
			start_tab1();
		});
		
		$('#btn_clear_tab2').on('click',function(){
			$('#result2').load('blank.php');
			start_tab2();
		}); //end button tab 2
		
		$('#btn_clear_tab3').on('click',function(){
			$('#result3').load('blank.php');
			start_tab3();
		}); //end button tab 3

		
																	//////////////////// select interaction /////////////////////
function start_tab1(){
		if(<?php echo $emp_job;?>==2){
			dataOption('sel_ampor1','gen_ampor',<?php echo $cc;?>,'');
			$('#sel_ampor1').attr('disabled',false);
			$('#sel_tumbon1').attr('disabled','disabled');
			$('#sel_tumbon1').html('<option value="000000">- เลือกตำบล -</option>');
			$('#sel_mooban1').attr('disabled','disabled');
			$('#sel_mooban1').html('<option value="00000000">- เลือกหมู่บ้าน -</option>');
		}else if (<?php echo $emp_job;?>==1){
			dataOption('sel_ampor1','gen_ampor',<?php echo $cc;?>,<?php echo $aa;?>);
			dataOption('sel_tumbon1','gen_tumbon',<?php echo $cc.$aa;?>,'');
			$('#sel_mooban1').attr('disabled','disabled');
			$('#sel_mooban1').html('<option value="00000000">- เลือกหมู่บ้าน -</option>');
		}else if (<?php echo $emp_job;?>==9){
			dataOption('sel_ampor1','gen_ampor',<?php echo $cc;?>,<?php echo $aa;?>);
			dataOption('sel_tumbon1','gen_tumbon',<?php echo $cc.$aa;?>,<?php echo $tt;?>);
			dataOption('sel_mooban1','gen_mooban',<?php echo $cc.$aa.$tt;?>,'');
		}else if(<?php echo $emp_job;?> == 8){
			dataOption('sel_ampor1','gen_ampor',<?php echo $cc;?>,<?php echo $aa;?>);
			dataOption('sel_tumbon1','gen_tumbon',<?php echo $cc.$aa;?>,<?php echo $tt;?>);
			dataOption('sel_mooban1','gen_mooban',<?php echo $cc.$aa.$tt;?>,<?php echo $mm;?>);
		}
}// end start select1

function start_tab2(){
		if(<?php echo $emp_job;?>==2){
			dataOption('sel_ampor2','gen_ampor',<?php echo $cc;?>,'');
			$('#sel_tumbon2').attr('disabled','disabled');
			$('#sel_tumbon2').html('<option value="000000">- เลือกตำบล -</option>');
			$('#sel_mooban2').attr('disabled','disabled');
			$('#sel_mooban2').html('<option value="00000000">- เลือกหมู่บ้าน -</option>');
		}else if (<?php echo $emp_job;?>==1){
			dataOption('sel_ampor2','gen_ampor',<?php echo $cc;?>,<?php echo $aa;?>);
			dataOption('sel_tumbon2','gen_tumbon',<?php echo $cc.$aa;?>,'');
			$('#sel_mooban2').attr('disabled','disabled');
			$('#sel_mooban2').html('<option value="00000000">- เลือกหมู่บ้าน -</option>');
		}else if (<?php echo $emp_job;?>==9){
			dataOption('sel_ampor2','gen_ampor',<?php echo $cc;?>,<?php echo $aa;?>);
			dataOption('sel_tumbon2','gen_tumbon',<?php echo $cc.$aa;?>,<?php echo $tt;?>);
			dataOption('sel_mooban2','gen_mooban',<?php echo $cc.$aa.$tt;?>,'');
		}else if(<?php echo $emp_job;?> == 8){
			dataOption('sel_ampor2','gen_ampor',<?php echo $cc;?>,<?php echo $aa;?>);
			dataOption('sel_tumbon2','gen_tumbon',<?php echo $cc.$aa;?>,<?php echo $tt;?>);
			dataOption('sel_mooban2','gen_mooban',<?php echo $cc.$aa.$tt;?>,<?php echo $mm;?>);
		}
	}//end start_select 2
		
	function start_tab3(){
		if(<?php echo $emp_job;?>==2){
			dataOption('sel_ampor3','gen_ampor',<?php echo $cc;?>,'');
			$('#sel_tumbon3').attr('disabled','disabled');
			$('#sel_tumbon3').html('<option value="000000">- เลือกตำบล -</option>');
			$('#sel_mooban3').attr('disabled','disabled');
			$('#sel_mooban3').html('<option value="00000000">- เลือกหมู่บ้าน -</option>');
		}else if (<?php echo $emp_job;?>==1){
			dataOption('sel_ampor3','gen_ampor',<?php echo $cc;?>,<?php echo $aa;?>);
			dataOption('sel_tumbon3','gen_tumbon',<?php echo $cc.$aa;?>,'');
			$('#sel_mooban3').attr('disabled','disabled');
			$('#sel_mooban3').html('<option value="00000000">- เลือกหมู่บ้าน -</option>');
		}else if (<?php echo $emp_job;?>==9){
			dataOption('sel_ampor3','gen_ampor',<?php echo $cc;?>,<?php echo $aa;?>);
			dataOption('sel_tumbon3','gen_tumbon',<?php echo $cc.$aa;?>,<?php echo $tt;?>);
			dataOption('sel_mooban3','gen_mooban',<?php echo $cc.$aa.$tt;?>,'');
		}else if(<?php echo $emp_job;?> == 8){
			dataOption('sel_ampor3','gen_ampor',<?php echo $cc;?>,<?php echo $aa;?>);
			dataOption('sel_tumbon3','gen_tumbon',<?php echo $cc.$aa;?>,<?php echo $tt;?>);
			dataOption('sel_mooban3','gen_mooban',<?php echo $cc.$aa.$tt;?>,<?php echo $mm;?>);
		}
	}//end start_select 3
		
	
		
		// select option //
		sel_pack('#sel_province1','#sel_ampor1','#sel_tumbon1','#sel_mooban1');
		sel_pack('#sel_province2','#sel_ampor2','#sel_tumbon2','#sel_mooban2');
		sel_pack('#sel_province3','#sel_ampor3','#sel_tumbon3','#sel_mooban3');

		
							/////////// sel_pack ////////////
		function sel_pack(province,ampor,tumbon,mooban){
			$(province).on('change', function(){
					if($(tumbon).val()!=000000){	
						$(tumbon).attr('disabled','disabled');
						document.getElementById(tumbon.substr(1)).innerHTML='<option value="000000">- เลือกตำบล -</option>';
					}
					if($(mooban).val()!=00000000){	
						$(mooban).attr('disabled','disabled');
						$(mooban).html('<option value="00000000">- เลือกหมู่บ้าน -</option>');
					}
					$(ampor).enable();
			});//end province
						
			$(ampor).on('change', function(){
					
					if($(ampor).val()<1){
						$(tumbon).attr('disabled','disabled');
						$(tumbon).html('<option value="000000">- เลือกตำบล -</option>');
						$(mooban).attr('disabled','disabled');
						$(mooban).html('<option value="00000000">- เลือกหมู่บ้าน -</option>');
						}else{
							$(tumbon).attr('disabled',false);
							$(mooban).attr('disabled','disabled');
							$(mooban).html('<option value="00000000">- เลือกหมู่บ้าน -</option>');
							
						}
			});//end ampor
		
			$(tumbon).on('change', function(){
				
					if($(tumbon).val()==0000000){
						$(mooban).attr('disabled','disabled');
						}else{
							$(mooban).attr('disabled',false);
						}
			});//end tumbon
		}//end function sel_pack
		
		
		
							///////////////////// check box interaction ///////////////////////

		chk_pack('chk_thai_all','chk_thai_nor','chk_thai_dead','chk_thai_alert','chk_thai_sold');
		chk_pack('chk_chi_all','chk_chi_nor','chk_chi_dead','chk_chi_alert','chk_chi_sold');
		chk_pack('chk_oth_all','chk_oth_nor','chk_oth_dead','chk_oth_alert','chk_oth_sold');
		
///////// check all paramiter fixed ///////////////////
		function chk_all(val,id1,id2,id3,id4){
			val=to_bool(val); //require to_bool function
			set_chk(id1,val); set_chk(id2,val); set_chk(id3,val); set_chk(id4,val); 
		}

///////// check all pack //////////////////////////////////
		function chk_pack(id_main,id1,id2,id3,id4){			
			$('#'+id_main).click(function(){
					chk_all(to_bool(id_main),id1,id2,id3,id4);
				});
		
				$('#'+id1).click(function(){
					if(to_bool(id1)){
						}else{set_chk(id_main,0);	}
				}); //end 
				
				$('#'+id2).click(function(){
					if(to_bool(id2)){
						}else{set_chk(id_main,0);	}
				}); //end 
				
				$('#'+id3).click(function(){
					if(to_bool(id3)){
						}else{set_chk(id_main,0);	}
				}); //end 

				$('#'+id4).click(function(){
					if(to_bool(id4)){
						}else{set_chk(id_main,0);	}
				}); //end 
		}//end check pack
																		/////////////////// end check box interaction //////////////////
		
		
}); //end jquery script 

</script>
</html>