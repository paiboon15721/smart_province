
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
	//include "./include/stat_func_tool.php";
	
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
		
		$varArray = explode(",", $v1);
		
		$chk_page=$varArray[0] ;
		$yymm=$varArray[1];
		$ccaattmm=$varArray[2];
		$emp_job=$varArray[3];
		$emp_rcode=$varArray[4];

		if (strlen($ccaattmm)<=8){
			for($i=strlen($ccaattmm);$i<8;$i++){
				$ccaattmm.='0';
			}
		}
		
?>
	<div id="tabs4" style="margin:15px 0px 0px 0px; width:950px;">
			<ul>
				<li><a href="#tabs4-1">สถิติ</a></li>
			</ul>
		<div id="tabs4-1">
<?php
		try{
				$hid = $_REQUEST['txt_hid'];
				//$cc = '26';
				$aa = $_REQUEST['sel_aa2'];
				$tt = $_REQUEST['sel_tt2'];
				$mm = $_REQUEST['sel_mm2'];
				$htype = $_REQUEST['sel_htype'];
				$htype = 4;
				
				$result = getHouseByCond($yymm, $emp_job, $emp_rcode, $ccaattmm);
				$arr_data = explode("|", $result);
				$code = $arr_data[0];
				
				/////////////////  Paging ////////////////{
				$e_page=15; // กำหนด จำนวนรายการที่แสดงในแต่ละหน้า   
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

					
				//////////////// end paging 1 //////////////}
		
				$rcode_arr=Array();
				$detail_arr=Array();
				$sub_arr=Array();
				$value_arr=Array();
				$group_arr=Array();
				$val_sub_Array=Array();
				
				$sum_house;
				$sum_office;
				$sum_factory;
				$sum_apartment;
				$sum_shop;
				$sum_oth;
				$sum_all;
				
				$buff_rcode=$arr_data[2]; // temporary store rcode  to compare
				$row="0";
				$group=0;
				
				
				for ($i=2;$i<(sizeof($arr_data)+1);$i+=4){
					
					if($buff_rcode!=$arr_data[$i]){ 
						$buff_rcode=$arr_data[$i];
						$group++;
						$row=0;
					}
						
					$rcode_arr[$group][$row]=str_replace('ท้องถิ่น','',$arr_data[$i]);
					$detail_arr[$group][$row]=$arr_data[$i+1];
					$sub_arr[$group][$row]=$arr_data[$i+2];
					$value_arr[$group][$row]=$arr_data[$i+3];
						
						if($sub_arr[$group][$row]!=1||13||14||19||23){
							$val_sub_Array[$group][0]+=$value_arr[$group][$row];
							}//รวมทั้งหมด
						
						if($sub_arr[$group][$row]==1){
							$val_sub_Array[$group][1]=$value_arr[$group][$row];
							}//บ้าน
						
						if($sub_arr[$group][$row]==13){
							$val_sub_Array[$group][2]=$value_arr[$group][$row];
							}//โรงงาน
						
						if($sub_arr[$group][$row]==14){
							$val_sub_Array[$group][3]=$value_arr[$group][$row];
							}//หอพัก
								
						if($sub_arr[$group][$row]==19){
							$val_sub_Array[$group][4]=$value_arr[$group][$row];
							}//สถานที่ราชการ
						
						if($sub_arr[$group][$row]==23){
							$val_sub_Array[$group][5]=$value_arr[$group][$row];
							}//ร้านค้า
					$row++;	
				}
?>
						
						<a id="fancybox-manual-a3" href="javascript:;"><img src="images/chart_pie.png" id="icon-pie" height="32" width="32"></a>
						<a id="fancybox-manual-b3" href="javascript:;"><img src="images/chart_bar.png" id="icon-bar" height="32" width="32"></a>
						<a id="fancybox-manual-c3" href="javascript:;"><img src="images/chart_bar_g.png" id="icon-bar" height="32" width="32"></a>
				
						<div class = "header"> ผลการค้นหาสถิติรายการบ้าน </div>
						<div class = "header"> จังหวัดนครนายก <?php echo get_label($ccaattmm);?></div>
							<table class="result_table " width="900">
								<tr>
									<th>#</th>
									<th  colspan='2' width="350">
										<?php 
										
											if(substr($ccaattmm,6,2)!=0){
												echo "หมู่บ้าน";
												}else if (substr($ccaattmm,4,2)!=0){
													echo "หมู่บ้าน"; 
													}else if (substr($ccaattmm,2,2)!=0){
														echo "ตำบล"; 
														}else if(substr($ccaattmm,0,2)!=0){
															echo "สำนักทะเบียน";
															}
											?>
						
									</th>
									<th width="60">บ้าน</th>
									<th >สถานที่ราชการ</th>											
									<th  width="60">โรงงาน</th>		
									<th width="60">หอพัก</th>		
									<th width="60">ร้านค้า</th>		
									<th width="60">อื่นๆ</th>
									<th width="60">รวม</th>
								</tr>
							<?php
								$each_house=Array();
								$each_office=Array();
								$each_factory=Array();
								$each_apartment=Array();
								$each_shop=Array();
								$each_oth=Array();
								$each_all=Array();
							
							
					//////////////// fetch Data /////////////////       
							for($i=0;$i<$group;$i++){
							
								$sum_house+=$val_sub_Array[$i][1];
								$sum_office+=$val_sub_Array[$i][5];
								$sum_factory+=$val_sub_Array[$i][2];
								$sum_apartment+=$val_sub_Array[$i][3];
								$sum_shop+=$val_sub_Array[$i][4];
								$sum_oth+=($val_sub_Array[$i][0]-$val_sub_Array[$i][1]-$val_sub_Array[$i][2]-$val_sub_Array[$i][3]-$val_sub_Array[$i][4]-$val_sub_Array[$i][5]);//อื่นๆ		;
								$sum_all+=$val_sub_Array[$i][0];
								
								$each_house[$i]=$val_sub_Array[$i][1];
								$each_office[$i]=$val_sub_Array[$i][5];
								$each_factory[$i]=$val_sub_Array[$i][2];
								$each_apartment[$i]=$val_sub_Array[$i][3];
								$each_shop[$i]=$val_sub_Array[$i][4];
								$each_oth[$i]=$val_sub_Array[$i][0]-$val_sub_Array[$i][1]-$val_sub_Array[$i][2]-$val_sub_Array[$i][3]-$val_sub_Array[$i][4]-$val_sub_Array[$i][5];
								$each_all[$i]=$val_sub_Array[$i][0];
								
								if(strlen($rcode_arr[$i][0])<2){
									$rcode_arr[$i][0] = "0".$rcode_arr[$i][0];
								}
							
								echo "<tr><td>".($i+1)."</td>" ;
								
								echo "<td class='txt_center' style='width:60px;'>";
									if($emp_job==2){
										echo $rcode_arr[$i][0];
										}else if($emp_job==1){
											echo substr($ccaattmm,0,4).$rcode_arr[$i][0];
											}else if ($emp_job==9||8){
												echo substr($ccaattmm,0,6).$rcode_arr[$i][0];
												}
								echo "</td>";
								
								echo "<td  width='260'>: ".$detail_arr[$i][0]."</td>";
								echo "<td class='numberic'>".fillComma($each_house[$i])."</td>";//บ้าน
								echo "<td class='numberic'>".fillComma($each_office[$i])."</td>";//สถานที่ราชการ
								echo "<td class='numberic'>".fillComma($each_factory[$i])."</td>";//โรงงาน
								echo "<td class='numberic'>".fillComma($each_apartment[$i])."</td>";//หอพัก
								echo "<td class='numberic'>".fillComma($each_shop[$i])."</td>";//ร้านค้า
								echo "<td class='numberic'>".fillComma($each_oth[$i])."</td>";//อื่นๆ		
								echo "<td class='numberic'>".fillComma($each_all[$i])."</td>";//รวมทั้งหมด
								echo "</tr>";			
							}

				//////// summary ///////
                echo "<tr><td colspan='10'><br></td></tr>";
				echo "<tr><td></td>";
				echo "<td align='left' colspan='2'><b>รวม</b></td>";
				echo "<td class='numberic'><b>".fillComma($sum_house)."</b></td>";
				echo "<td class='numberic'><b>".fillComma($sum_office)."</b></td>";
				echo "<td class='numberic'><b>".fillComma($sum_factory)."</b></td>";
				echo "<td class='numberic'><b>".fillComma($sum_apartment)."</b></td>";
				echo "<td class='numberic'><b>".fillComma($sum_shop)."</b></td>";
				echo "<td class='numberic'><b>".fillComma($sum_oth)."</b></td>";
				echo "<td class='numberic'><b>".fillComma($sum_all)."</b></td>";
				echo "</tr></table>"; 
                //end table


				////  sent parameter chart 	
				$size = (sizeof($detail_arr)-1);
				$pie_val;
				$bar_val;
				$bar_cat;
				$col_val;
				$col_cat;
				//$col_cat=Array();
				
				//////////////////////////////////////
				/// chart_ pie
				for($r=0;$r< $size;$r++){
					$pie_val.="['".str_replace('ท้องถิ่น','',$detail_arr[$r][0])."',".$val_sub_Array[$r][0]."],";
				}
				
				
				////////////////////////////////////
				/// bar chart cate
					for($r=0;$r< $size;$r++){
						if($r==$size){
							$bar_cat.= "'".str_replace('ท้องถิ่น','',$detail_arr[$r][0])."'";
							}else{
							$bar_cat.="'".str_replace('ท้องถิ่น','',$detail_arr[$r][0])."',";
							}
					}$bar_cat = "[".$bar_cat."]";
										
				/// char bar val
					for($r=0;$r< $size;$r++){
						if($r==($size-1)){
							$bar_val.=$val_sub_Array[$r][0]."";
							}else{
							$bar_val.=$val_sub_Array[$r][0].",";
							}
					}$bar_val = "[".$bar_val."]";
					
					
			////////////////////////////////////
			
			
			////// column chart categories
					for($r=0;$r< $size;$r++){
						if($r==($size-1)){
							$col_cat.= "'".str_replace('ท้องถิ่น','',$detail_arr[$r][0])."'";
							}else{
							$col_cat.="'".str_replace('ท้องถิ่น','',$detail_arr[$r][0])."',";
							}
					}
					
			
			//////  column value
					for($r=0;$r<6;$r++){
							//fecth categories
								switch ($r){
									case 0 : $col_val.="{name:'บ้าน',"; break;
									case 1 : $col_val.="{name:'สถานที่ราชการ',"; break;
									case 2 : $col_val.="{name:'โรงงาน',"; break;
									case 3 : $col_val.="{name:'หอพัก',"; break;
									case 4 : $col_val.="{name:'ร้านค้า',"; break;
									case 5 : $col_val.="{name:'อื่นๆ',"; break;
								}
								$col_val.="data:[";
								/// fetch data value
								for ($i=0;$i<$size;$i++){
									switch ($r){
										case 0 : $col_val.=nvl($each_house[$i]);  break;
										case 1 : $col_val.=nvl($each_office[$i]);  break;
										case 2 : $col_val.=nvl($each_factory[$i]); break;
										case 3 : $col_val.=nvl($each_apartment[$i]);  break;
										case 4 : $col_val.=nvl($each_shop[$i]);  break;
										case 5 : $col_val.=nvl($each_oth[$i]); break;
									//	case 6 : $col_val.=nvl($each_all[$i]);  break;
									}
									
									//if ((sizeof($each_house)>1)&&($r!=(sizeof($each_house)-1))){
									if(sizeof($each_house)>1){
										 if($i<($size-1)){
											$col_val.=",";
										}
									}
								}				
								

								$col_val.="]}";
								 if($r<5){
										$col_val.=",";
									}
							}
						
?>


				
			<script type ="text/javascript">
					$(document).ready(function() {
					
						var pie_val = "<?php echo $pie_val; ?>";
						var bar_val = "<?php echo $bar_val; ?>";
						var bar_cat = "<?php echo $bar_cat; ?>";
						var col_val ="<?php echo $col_val;?>";
						var col_cat ="<?php echo $col_cat;?>";
						var ccaattmm="<?php echo $ccaattmm; ?>";
						var ccaattmm="<?php echo $ccaattmm; ?>";
						 
						$("#fancybox-manual-a3").click(function() {
							$.fancybox.open({
								href : "include/chart_pie.php?value="+pie_val+"&page=ajax_house&sub_page=0&ccaattmm="+ccaattmm+"",
								type : 'iframe',
								padding : 5
								});
						});
			
						
						$("#fancybox-manual-b3").click(function() {
							$.fancybox.open({
								href : "include/chart_bar.php?value="+bar_val+"&cat="+bar_cat+"&page=ajax_house&sub_page=0&ccaattmm="+ccaattmm+"",
								type : 'iframe',
								padding : 5
							});
						});
						
						$('#fancybox-manual-c3').click(function(){
							$.fancybox.open({
								href : "include/chart/chart_col.php?value="+col_val+"&cat="+col_cat+"&page=ajax_house&sub_page=0&ccaattmm="+ccaattmm+"",
								type : 'iframe',
								padding : 5
							});
						});
						
					});//end jquery
			</script>
				
					
<?php
				
					////  navi bar /////////////////
					echo "<div class='browse_page' style='float:right;'>";
						page_navigator($before_p,$plus_p,$total,$total_p,$chk_page);    // เรียกใช้งานฟังก์ชั่น สำหรับแสดงการแบ่งหน้า   

            }else if ($code == "0"){
               // echo "<meta http-equiv='refresh' content='0;URL=search_pop.php>";
				echo "<span style='color=#2E90BD;'>ไม่พบข้อมูลตามเงื่อนไขที่ระบุ</span>";
                //exit();
            }else if ($code == "9"){
                //echo "<meta http-equiv='refresh' content='0;URL=search_pop.php>";

				 echo "<script language='javascript'>alert('เกิดความผิดพลาด : {$arr_data[1]}')</script>";
                //exit();
            }
			?>		
						
		</div><!-- end div tab1 -->
	</div>

	<?php	
			
        }catch (Exception $e){
            //$result = "9|{$e->getMessage()}";
            //echo "<meta http-equiv='refresh' content='0;URL=search_pop.php>";
			
            echo "<script language='javascript'>alert('เกิดความผิดพลาด : {$e->getMessage()}')</script>";
            exit();
        }

    }//end php function;
?>	


<?php   

// สร้างฟังก์ชั่น สำหรับแสดงการแบ่งหน้า  
//--------------- Paging  ----------------------
function page_navigator($before_p,$plus_p,$total,$total_p,$chk_page){   
    global $e_page;
	global $querystr;
	//$urlfile="ajax_simple.php"; // ส่วนของไฟล์เรียกใช้งาน ด้วย ajax (ajax_dat.php)
	//$display="#result"; //  id ของส่วนหน้าหลัก ที่ต้องการจะให้แสดง
	$per_page=5;
	$num_per_page=floor($chk_page/$per_page);
	$total_end_p=($num_per_page+1)*$per_page;
	$total_start_p=$total_end_p-$per_page;
	$pPrev=$chk_page-1;
	$pPrev=($pPrev>=0)?$pPrev:0;
	$pNext=$chk_page+1;
	$pNext=($pNext>=$total_p)?$total_p-1:$pNext;		
	$lt_page=$total_p-4;
	
	
	//use  Javascript from main Page
	if(($chk_page>1)){
		if($chk_page>0){  
			echo "<span class='naviPN' onclick='goTo(".$pPrev."); ' onmouseover='' style='cursor: pointer;'>Prev</span>";
		}
		for($i=$total_start_p;$i<$total_p;$i++){  
			//$nClass=($chk_page==$i)?"class='selectPage'":"";
				if($e_page*$i<=$total_p){
				echo "<span id='page".$i."' onclick='goTo(".$i.");' onmouseover='' style='cursor: pointer;'>".intval($i+1)."</span>";
				}
		}		
		if($chk_page<$total_p-1){
			echo "<span class='naviPN' onclick='goTo(".$pNext.");' onmouseover='' style='cursor: pointer;'>Next</span>";
		}
	}
}    //end Paging  

 function fillComma($number)  {
	$number = intVal($number);
    $number = number_format($number,0," ",",");
    return str_replace(" ", "&nbsp;", $number);
  }
  
  function nvl($number){
		if($number == null){
			$number =0;
		}
	return($number);
  }


  function clear(){ 
		echo '<script type="text/javascript">{$("#container").load("blank.php"); }';
	}			
	?>


</body>

</html>