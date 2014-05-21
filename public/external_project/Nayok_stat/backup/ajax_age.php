<head>
	<link rel="stylesheet" type="text/css" href="plugin/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />
	<script src="js/custom_search.js" type="text/javascript"></script>
	<script src="lib/js/jquery-1.9.0.min.js" type="text/javascript"></script>
	<script src="ui/jquery-ui.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="plugin/fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
	<script type="text/javascript" src="plugin/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
</head>
<body>


<?php
	header("Content-type:text/html; charset=UTF-8");              
	header("Cache-Control: no-store, no-cache, must-revalidate");             
	header("Cache-Control: post-check=0, pre-check=0", false);   
	
    include "./include/stat_func.php";
	include "./include/stat_func_extend.php";
	
	
														//////////////// get label of province tumbon mooban ///////////////////
	function get_label($ccaattmm){
			$lst_ampor = getListAA(substr($ccaattmm,0,2));
			$lst_tumbon = getListTT(substr($ccaattmm,0,4));
			$lst_mooban = getListMM(substr($ccaattmm,0,6));
			$arr_aa = explode("|", $lst_ampor);
			$arr_tt = explode("|", $lst_tumbon);
			$arr_mm = explode("|", $lst_mooban);

			/// sel ampor
			for($i=0; $i<(count($arr_aa)-3) ;$i+=2){
				if(substr($arr_aa[$i+2],2,2)==substr($ccaattmm,2,2)){
					echo str_replace('ท้องถิ่น','',$arr_aa[$i+3])." ";
				}
			}
			
			/// sel tumbon
			for($i=0; $i<(count($arr_tt)-3) ;$i+=2){
				if(substr($arr_tt[$i+2],4,2)==substr($ccaattmm,4,2)){
					echo " ตำบล".$arr_tt[$i+3]." ";
				}
			}
			
			/// sel mooban
			for($i=0; $i<(count($arr_mm)-3) ;$i+=2){
				if(substr($arr_mm[$i+2],6,2)==substr($ccaattmm,6,2)){
					echo " หมู่".$arr_mm[$i+3];
					}
			}
		}//end get_label
		
	
	
	//--------------------------------------------------------//
 if (isset($_GET[action])){ 
	// Retrieve the GET parameters and executes the function
	  $funcName	 = $_GET[action];
	  $vars = $_GET[vars];
	  $head = $_GET[head];
	  $sub_head = $_GET[head];
	  $funcName($vars); //use function;
	 } 
	 else if (isset($_POST[action])){
	  // Retrieve the POST parameters and executes the function
	  $funcName	 = $_POST[action];
	  $vars= $_POST[vars];
  	  $head = $_POST[head];
	  $sub_head = $_POST[head];
	  $funcName($vars); 
	}
//----------------------------------------------------------------//		
	function phpFunction($v1){
		// makes an array from the passed variable 
		// (note: $vars = 1 string while it used to be a javascript Array)
		// with explode you can make an array from 1 string. The seperator is a , 

		?>
		
</script>
	<?php
		
		$varArray = explode(",", $v1);
		
		$emp_job=2;
		$sex=0;
		$nat=99;
		$age_start=1;
		$age_end=15;
		$order_type='111';
		$order_by='11';

		$chk_page=$varArray[0] ;
		//$sub_page=$varArray[2];
			
		$chk_page=$varArray[0] ;
		$yymm=$varArray[1];
		$ccaattmm=$varArray[2];
		$emp_job=$varArray[3];
		$emp_rcode=$varArray[4];
		
		if (strlen($ccaattmm)<=8){
			for($i=strlen($ccaattmm);$i<8;$i++){
				$ccaattmm.='0';
			}
		}//end if
		
	?>

		<div id="tabs2" style="margin:15px 0px 0px 0px; width:950px;">
				<ul>
					<li><a href="#tabs2-1">ทุกสัญชาติ</a></li>
					<li><a href="#tabs2-2">สัญชาติไทย</a></li>
					<li><a href="#tabs2-3">สัญชาติจีน</a></li>
					<li><a href="#tabs2-4">สัญชาติอื่นๆ</a></li>
				</ul>
				<div id="tabs2-1">
					<?php 	tab_age($yymm, $emp_job, $emp_rcode, $ccaattmm, 0);  ?>
				</div> 
				<div id="tabs2-2">
					<?php 	tab_age($yymm, $emp_job, $emp_rcode, $ccaattmm, 1);  ?>
				</div>
				<div id="tabs2-3">
					<?php	tab_age($yymm, $emp_job, $emp_rcode, $ccaattmm, 2);  ?>
				</div>
				<div id="tabs2-4">
					<?php  tab_age($yymm, $emp_job, $emp_rcode, $ccaattmm, 3);  ?>
				</div>
		
		</div>		
	<?php
	
}	

	
/////////////////////////////// gen table tab //////////////////////////////////////////	
function tab_age($yymm, $emp_job, $emp_rcode, $ccaattmm, $nat_type){
	try{
			$result =getPopAgeByCond($yymm, $emp_job, $emp_rcode, $ccaattmm, $nat_type);
			$arr_data = explode("|", $result);
            $code = $arr_data[0];
			$total=$arr_data[1];
			
			if($nat_type == 0){
			   $txt_label = "";
				}else if($nat_type == 1 ){
					$txt_label = "(สัญชาติไทย)";
					}else if ($nat_type ==2){
						$txt_label = "(สัญชาติจีน)";
						}else if ($nat_type ==3){
							$txt_label = "(อื่นๆ)";
							}	
			
			
		/////////////////  Paging ////////////////{
			$e_page=10; // กำหนด จำนวนรายการที่แสดงในแต่ละหน้า   
			//$chk_page =0;
		
			 if ($code == "1"){		
				if(!isset($_GET['s_page'])){   
						$_GET['s_page']=0;   
						}else{   
							$chk_page=$_GET['s_page'];     
							$_GET['s_page']=$_GET['s_page']*$e_page;   
							}   
					
				if($total>=1){   				
					$plus_p=($chk_page*$e_page)+$e_page;   
					}else{   
						$plus_p=($chk_page*$e_page);       
						}   
					
				$total_p=ceil($total/$e_page);   
				$before_p=($chk_page*$e_page)+1;  
       
                $seq=1;
				//------------------
	
				$arr_male=array();
				$arr_female=array();
				$arr_summary=array();

				$sum_female;
				$sum_male;
				$sum_summary;
		
				$start=0;
				
				
			//list to male's array	
			for($i=0;$i<=101;$i++){ //data age 101 list
				$arr_male[$i]=$arr_data[$i+3]; //sum male start at $arr_data array 3
			}
			
			//list to female's array
			for($i=0;$i<=101;$i++){ //
				$arr_female[$i]=$arr_data[$i+106]; //sum male start at $arr_data array 104
			}
			
			for($i=0;$i<=101;$i++){ 
				$arr_summary[$i]=$arr_female[$i]+$arr_male[$i];
			}
	

			for($j=0;$j<21;$j++){
				$sum_male[0]+=$arr_male[$start] ;
				$sum_male[1]+=$arr_male[$start+1] ;
				$sum_male[2]+=$arr_male[$start+2] ;
				$sum_male[3]+=$arr_male[$start+3] ;
				$sum_male[4]+=$arr_male[$start+4] ;
					
				$sum_female[0]+=$arr_female[$start] ;
				$sum_female[1]+=$arr_female[$start+1] ;
				$sum_female[2]+=$arr_female[$start+2] ;
				$sum_female[3]+=$arr_female[$start+3] ;
				$sum_female[4]+=$arr_female[$start+4] ;
				
				$sum_summary[0]+=$arr_summary[$start] ;
				$sum_summary[1]+=$arr_summary[$start+1] ;
				$sum_summary[2]+=$arr_summary[$start+2] ;
				$sum_summary[3]+=$arr_summary[$start+3] ;
				$sum_summary[4]+=$arr_summary[$start+4] ;
					
				$start+=5;
					
			}

?>
	  
		<a id="<?php echo "pie".$nat_type; ?>" class="chart_pie"  href="javascript:;"><img src="images/chart_pie.png" id="icon-pie" height="32" width="32"></a>
		<a id="<?php echo "bar".$nat_type; ?>" class="chart_bar" href="javascript:;"><img src="images/chart_bar.png" id="icon-bar" height="32" width="32"></a>
	  <div class = "header"> ผลการค้นหาสถิติรายอายุ <?php echo $txt_label;?> </div>
	  <div class = "header"> จังหวัดนครนายก <?php echo get_label($ccaattmm);?></div>
     <table class='result_table2'>
			<tr>
					<th>ช่วงอายุ</th>
					<th>ชาย</th><th>หญิง</th><th>รวม</th>
					<th>ชาย</th><th>หญิง</th><th>รวม</th>
					<th>ชาย</th><th>หญิง</th><th>รวม</th>
					<th>ชาย</th><th>หญิง</th><th>รวม</th>
					<th>ชาย</th><th>หญิง</th><th>รวม</th>
         </tr>
		   <tr>
				<td><b><1<b></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
<?php
			$pre_age=0;
			$post_age=5;
			$start_arr=1;
			
			echo "<td class='numberic'>".fillComma($arr_male[0])."</td>";
			echo "<td class='numberic'>".fillComma($arr_female[0])."</td>";
			echo "<td class='numberic'><b>".fillComma($arr_summary[0])."</b></td></tr>";
																
			for($i=0;$i<21;$i++){			
				if($arr_male[$i]!=null){
			
						if($i==20){
							echo "<tr><td><b>>".($pre_age)."<b></td>";
								echo "<td class='numberic'>".fillComma($arr_male[101])."</td>";
								echo "<td class='numberic'>".fillComma($arr_female[101])."</td>";
								echo "<td class='numberic'><b>".fillComma($arr_summary[101])."</b></td>";
							}else{
								echo "<tr><td><b>".($pre_age+1)."-".$post_age."<b></td>"; 
								for($j=0;$j<5;$j++){
										echo "<td class='numberic'>".fillComma($arr_male[$start_arr])."</td>";
										echo "<td class='numberic'>".fillComma($arr_female[$start_arr])."</td>";
										echo "<td class='numberic'><b>".fillComma($arr_summary[$start_arr])."</b></td>";
										$start_arr++;
									}
							}
							
							///////////////  generate td ///////////////	
									
				}
							echo "</tr> ";
							$pre_age+=5;
							$post_age+=5;
				
        } //end <tr> generate

?>
				
		</table>
	<?php					
				//////// summary ///////

				$arr_name = array('ชาย','หญิง');
				$arr_value = array(sum_array($sum_male),sum_array($sum_female));
				$size = count($arr_name);
				$all;
						
			
				//////////////////  sent  chart parameter /////////////////	
				$size = sizeof($arr_name);
				$pie_val;
				$pie_buff;
				$pie_interval=5;
				$bar_val;
				$bar_cat;
				
				
					/// chart_ pie					
					$pie_val="['<1',".$arr_summary[0]."],";
					for($r=0;$r<=100;$r+=$pie_interval){
					
						for($j=1;$j<=$pie_interval;$j++){
							$pie_buff+=$arr_summary[$r];
							}
					
						$pie_val.="['อายุ ".($r+1)."-".($r+$pie_interval)."',".$pie_buff."],";
						$pie_buff=0;
						
					}$pie_val.= "['อายุ >100',".$arr_summary[101]."]";

					
					//------- bar_categories
					for($r=0;$r<$size;$r++){
						if($r==$size-1){
							$bar_cat.="'".$arr_name[$r]."'";
							}else{
							$bar_cat.="'".$arr_name[$r]."',";
							}
					}$bar_cat = "[".$bar_cat."]";
					$bar_cat="['อายุ <1','อายุ 1-5','อายุ 6-10','อายุ 11-15','อายุ 16-20','อายุ 21-25','อายุ 26-30','อายุ 31-35','อายุ 36-40','อายุ 41-45','อายุ 46-50','อายุ 51-55','อายุ 56-60','อายุ 61-65','อายุ 66-70','อายุ 71-75','อายุ 76-80','อายุ 81-85','อายุ 86-90','อายุ 90-95','อายุ 96-100','อายุ >100']";
					
					//bar_value
					$val_buff=$arr_summary[0];
					for($r=0;$r<=105;$r+=5){
							if($r==(sizeof($arr_summary))){
								$bar_val.=$val_buff."";
								}else{
									$bar_val.=$val_buff.",";
								}
							$val_buff=0;	
							for($j=1;$j<=5;$j++){
								$val_buff+=$arr_summary[$r+$j];
							}	
					}
					$bar_val = "[".$bar_val."]";
					//echo $bar_val;
					/*
					for($r=0;$r< sizeof($arr_summary);$r++){
						if($r==(sizeof($arr_summary)-1)){
							$bar_val.=$arr_summary[$r]."";
							}else{
							$bar_val.=$arr_summary[$r].",";
							}
					}$bar_val = "[".$bar_val."]";
					*/
?>
				<script type ="text/javascript">
					$(document).ready(function() {

							var pie_val = "<?php echo $pie_val; ?>";
							var bar_val = "<?php echo $bar_val; ?>";
							var bar_cat = "<?php echo $bar_cat; ?>";
							var ccaattmm="<?php echo $ccaattmm; ?>";
							var sub_page="<?php echo $nat_type; ?>";
	
							
								$(".chart_pie").each(function(){
									$("#"+this.id.toString()).click(function() {
										$.fancybox.open({
										href : "include/chart_pie.php?value="+pie_val+"&page=ajax_age&sub_page="+(this.id.toString()).substring(3,4)+"&ccaattmm="+ccaattmm+"",
										type : 'iframe',
										padding : 5
										});
									});
								});
			
							$(".chart_bar").each(function(){
									$("#"+this.id.toString()).click(function() {
										$.fancybox.open({
										href : "include/chart_bar.php?value="+bar_val+"&cat="+bar_cat+"&page=ajax_age&sub_page="+(this.id.toString()).substring(3,4)+"&ccaattmm="+ccaattmm+"",
										type : 'iframe',
										padding : 5
										});
									});
								});
		
						});//end jquery
		</script>

<?php
					
		}else if ($code == "0"){
			 // echo "<meta http-equiv='refresh' content='0;URL=search_pop.php>";
			echo "<span style='color=#2E90BD;'>ไม่พบข้อมูลตามเงื่อนไขที่ระบุ</span>";
	   }else if ($code == "9"){
			 //echo "<meta http-equiv='refresh' content='0;URL=search_pop.php>";
			echo "<script language='javascript'>alert('เกิดความผิดพลาด : {$arr_data[1]}')</script>";
        }else{ 
			echo "<span style='color=#2E90BD;'>ไม่พบข้อมูลตามเงื่อนไขที่ระบุ</span>";
		}
			
     }catch (Exception $e){
            //$result = "9|{$e->getMessage()}";
            //echo "<meta http-equiv='refresh' content='0;URL=search_pop.php>";
			echo "<span style='color=#2E90BD;'>เกิดความผิดพลาด</span>";
            echo "<script language='javascript'>alert('เกิดความผิดพลาด : {$e->getMessage()}')</script>";
            //exit();
        }
	}
   
?>


</body>
</html>