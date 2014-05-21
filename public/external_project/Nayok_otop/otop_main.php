<?php

	session_start();

	$ccaattmm=$_SESSION['catm_login'];
//	$ccaattmm=26020100;
	$emp_id=$_SESSION['EMPID'];
	$emp_name = $_SESSION['EMPNAME'];
	$emp_village = $_SESSION['catm_description'];
	
	header("Cache-Control: no-cache");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/otop_main.css">
<link rel="stylesheet" type="text/css" href="css/rate.css">
<link rel="stylesheet" type="text/css" href="plugin/freeow/style/freeow/freeow.css" >
<style type="text/css" title="currentStyle">
	@import "DataTables/media/css/demo_page.css";
	@import "DataTables/media/css/demo_table.css";

	@import "DataTables/media/css/demo_page.css";
	@import "DataTables/media/css/demo_table_jui.css";
	@import "DataTables/examples_support/themes/smoothness/jquery-ui-1.8.4.custom.css";
</style>
		
<!-- Add fancyBox main files -->
	<link rel="stylesheet" type="text/css" href="plugin/fancy-box/jquery.fancybox.css?v=2.1.5" media="screen" >
	<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.8.14.custom.css" >
	<link rel="stylesheet" type="text/css" href="css/demo_table_jui.css" >
	<link rel="stylesheet" type="text/css" href="css/TableTools_JUI.css" >
	<link rel="stylesheet" type="text/css" href="css/style_information.css" >
	<script  type="text/javascript" language="javascript" src='js/jquery.jeditable.js'></script>
			<script  type="text/javascript" language="javascript" src='js/jquery.dataTables.min.js'></script>
			<script  type="text/javascript" language="javascript" src='js/TableTools.js'></script>
			<script  type="text/javascript" language="javascript" src='js/ZeroClipboard.js'></script>
	<script type="text/javascript" language="javascript" src="DataTables/media/js/jquery.js"></script>
	<script type="text/javascript" language="javascript" src="DataTables/media/js/jquery.dataTables.js"></script>


<title>ระบบบันทึกข้อมูล OTOP</title>
<style>
	.fancybox-custom .fancybox-skin {
		box-shadow: 0 0 50px #222;
	}
		
	a:link {color:#000;}      /* unvisited link */
	a:visited {color:#000;}  /* visited link */
	a:hover {color:#ccc;}  /* mouse over link */
	a:active {color:#0000FF;}  /* selected link */
	a,img{ border:none;}

	.button{
		width:26px;
		height:26px;
		margin-left:3px;
		float:right;
	}
	
	.bt_lst							{	background-image:url("images/list_red_hover.png");		}
	.bt_lst:hover			{	background-image:url("images/list_red.png"); }
	.bt_lst-disable 		{	background-image:url("images/list_disable.png"); }
	
	.bt_edit						{	background-image:url("images/edit_red_hover.png");	}
	.bt_edit:hover		{	background-image:url("images/edit_red.png"); 	}
	.bt_edit-disable 	{	background-image:url("images/edit_disable.png"); }
	
	.bt_ins							{	background-image:url("images/plus_hover_red.png");		}
	.bt_ins:hover			{	background-image:url("images/plus_red.png"); 		}
	.bt_ins-disable		{	background-image:url("images/plus_disable.png"); 		}
	
	.bt_del						{	background-image:url("images/minus_hover_red.png");	}
	.bt_del:hover			{	background-image:url("images/minus_red.png"); 	}
	.bt_del-disable		{	background-image:url("images/minus_disable.png"); 	}
	
</style>

</head>

<?php
	include "include/stat_func_tool.php";
	
?>


<body>

<input type="hidden" id="star_rate" value="0">
<input type="hidden" id="tmp_pic" value="0">


<div class="main" >
	<div class="head" >
		<h2>ระบบบันทึกข้อมูล OTOP</h2>
		<a class="fancybox fancybox.ajax" href="ajax.txt">Ajax</a>
		<!--<img src="images/otop_logo.png" alt="otop" height="100" width="100" align="right">-->
	</div>
	<div class="body relative" >
			<div class="col1" >
				<img src="images/otop_top.jpg" alt="otop" height="55" width="63" align="left">
			</div>
			<div class="col2">
					<div id="show_emp" style="text-align:center; width:100%; margin-top:10px; margin-bottom:8px; background-color:#5a1e28; color:#fff;">
						<?php
							echo "ยินดีต้อนรับ   ".$emp_name." ";
							echo get_label($ccaattmm);
						?>
					</div>
					<div style="text-align:right; padding-right:10px;  padding-bottom:10px;">
						<div id="bt_edit" class="button"></div> 
						<div id="bt_del" class="button"></div>
						<div id="bt_ins" class="button"></div> 
						<div id="bt_lst" class="button"></div>
					</div>
					<div id="content" style="padding:10px;">
						<!-- // for show content-->
					</div>
				</div><!-- end body div -->
			</div>
   <div class="footer" >
		POWEREDl By CDG.CO.TH
		<div id="result"></div>
	</div>
</div>
<script src="lib/js/jquery-1.9.0.min.js" type="text/javascript"></script>
<script src="ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="js/otop_main.js" type="text/javascript"></script>
<script src="js/send_data.js" type="text/javascript"></script>
<script src="js/jquery.form.js" type="text/javascript"></script>
<script>
		var otop_id_buff;
		
		
		bt_enable("bt_lst");
		bt_disable("bt_ins");
		bt_disable("bt_del");
		bt_disable("bt_edit");
		$('#content').load('otop_ajax_input.php');	
		
	
		// interact state
		$('#bt_lst').click(function(){
			$('#content').load('DataTables/examples/basic_init/otop_table.php');
			bt_enable("bt_lst");
			bt_enable("bt_ins");
			bt_disable("bt_del");
			bt_disable("bt_edit");
		});
		
		$('#bt_ins').click(function(){
			$('#content').load('otop_ajax_input.php');
			bt_enable("bt_lst");
			bt_disable("bt_ins");
			bt_disable("bt_del");
			bt_disable("bt_edit");
			//state_type ="insert";
		});
		
	


	
	function  bt_enable(id_name){
		$("#"+id_name).removeClass(id_name+"-disable");
		$("#"+id_name).addClass(id_name);
		$('#'+id_name).attr("disabled",false);
	}
	
	function  bt_disable(id_name){
		$("#"+id_name).removeClass(id_name);
		$("#"+id_name).addClass(id_name+"-disable");
		$('#'+id_name).attr("disabled",true);
	}
	
</script>


</body>
</html>