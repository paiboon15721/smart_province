<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
	//--------------------------------------------------------//
 if (isset($_GET[action])){ 
	// Retrieve the GET parameters and executes the function
	  $funcName	 = $_GET[action];
	  $vars = $_GET[vars];
	  $funcName($vars); //use function;
	 } 
	 else if (isset($_POST[action])){
	  // Retrieve the POST parameters and executes the function
	  $funcName	 = $_POST[action];
	  $vars= $_POST[vars];
	  $funcName($vars); 
	}
	
	
	$devMode = 0 ; // 0 is off , 1 is in development mode;
	
	
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
		$pop_type=$varArray[5];
		$pop_subtype1=$varArray[6];
		$pop_subtype2=$varArray[7];
		$pop_subtype3=$varArray[8];
		
	
		if($devMode != 0){
			echo "yymm : [$yymm]<br>";
			echo "emp_job : [$emp_job]<br>";
			echo "emp_rcode : [$emp_rcode]<br>";
			echo "ccaattmm :[$ccaattmm]<br>";
			echo "pop_type : [$pop_type]<br>";
			echo "pop_subtype1 : [$pop_subtype1]<br>";
			echo "pop_subtype2 : [$pop_subtype2]<br>";
			echo "pop_subtype3 : [$pop_subtype3]<br>";
			echo "getPopHouseByCond : ".getPopHouseByCond($yymm, $emp_job, $emp_rcode, $ccaattmm,$pop_type, $pop_subtype1,$pop_subtype2,$pop_subtype3)."<br>";	
		}
		

		if (strlen($ccaattmm)<=8){
			for($i=strlen($ccaattmm);$i<8;$i++){
				//$ccaattmm.='0';
			}
		}
		
		if (substr($ccaattmm,0,4)>2690){
			$emp_rcode =substr($ccaattmm,0,4);
		}
		
	
		?>
		<div id="tabs3" style="margin:15px 0px 0px 0px; width:950px;">
				<ul>
					<li><a href="#tabs3-1">สถิติ</a></li>
				</ul>
				<div id="tabs3-1">
		<?php
	
        try{
            $hid = $_REQUEST['txt_hid'];
            //$cc = '26';
            $aa = $_REQUEST['sel_aa2'];
            $tt = $_REQUEST['sel_tt2'];
            $mm = $_REQUEST['sel_mm2'];
            $htype = $_REQUEST['sel_htype'];
            
            $htype = 4;
			
			
			
			
			
			//$result =getPopHouseByCond($yymm, $emp_job, $emp_rcode, $ccaattmm,$pop_type, $pop_subtype1,$pop_subtype2,$pop_subtype3);
			$result =getPopHouseByCond($yymm, $emp_job, $emp_rcode, $ccaattmm,$pop_type, $pop_subtype1,$pop_subtype2,$pop_subtype3);
            $arr_data = explode("|", $result);
            $code = $arr_data[0];
			$total=$arr_data[1];

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
			
                //$arr_length=count($arr_data);	
                
                $seq=1;
		
				//------------------
				$arr_rcode=array();
				$arr_name=array();
				$arr_male=array();
				$arr_female=array();
				$arr_summary=array();
				$arr_house=array();
				$sum_female;
				$sum_male;
				$sum_all;
				$sum_house;			
				
	?>		
				
				<a id="fancybox-manual-a" href="javascript:;"><img src="images/chart_pie.png" id="icon-pie" height="32" width="32"></a>
				<a id="fancybox-manual-b" href="javascript:;"><img src="images/chart_bar.png" id="icon-bar" height="32" width="32"></a>
				<div class = "header"> ผลการค้นหาสถิติรายคน </div>
				<div class = "header"> จังหวัดนครนายก <?php echo get_label($ccaattmm);?></div>
             <table class='result_table'>
					<tr>
						<th width='25px'>#</th>
						<th width='350px' colspan='2'>
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
						<th>ชาย</th>                        
						<th>หญิง</th>                        
						<th>รวม</th>
                </tr>
			<?php
					if($chk_page==0){
						$start_arr=($chk_page*$before_p)+2;
						}else{$start_arr=(5*$before_p)-3;}
						$start_arr=2;
						for($i=$before_p;$i<=($plus_p );$i++){
							
							if($arr_data[$start_arr]!=null){
							 echo "<tr><td>".$i."</td>";					
				 
		  
					//////////////// fetch Data /////////////////       
					$arr_rcode[$i]=$arr_data[$start_arr]; 
					$start_arr++; //rcode
				
					$arr_name[$i]= str_replace('ท้องถิ่น',' ',$arr_data[$start_arr]);
                    $start_arr++; //name
					
					$arr_male[$i]=$arr_data[$start_arr];
					$sum_male+=$arr_male[$i];
					$start_arr++; //male population
					
					$arr_female[$i]=$arr_data[$start_arr];	  
					$sum_female+=intval($arr_female[$i]);
					$start_arr++; //female population
					
				 	$arr_summary[$i] = intval($arr_data[$start_arr-1])+intval($arr_data[$start_arr-2]);
					$sum_all+=$arr_summary[$i]; //summary population
					/*
					$arr_house[$i]=$arr_data[$start_arr];	 
					$sum_house+=$arr_house[$i]; //house prop
					*/
				///////////  generate td ///////////////	
				if(strlen($arr_rcode[$i])<2){
					$arr_rcode[$i]='0'.$arr_rcode[$i];
				}
				
				
				//echo "<td>".($i+1)."</td>" ;
				echo "<td class='txt_center' style='width:60px; margin:0px auto;' align='center'>";
					if($emp_job==2){
						echo $arr_rcode[$i];
						}else if($emp_job==1){
							echo substr($ccaattmm,0,4).$arr_rcode[$i];
							}else if ($emp_job==9||8){
								echo substr($ccaattmm,0,6).$arr_rcode[$i];
									}
				echo "</td>";

				echo "<td class='text' width='260'>: ".$arr_name[$i]."</td>";
				echo "<td class='numberic'>".fillComma($arr_male[$i])."</td>";
				echo "<td class='numberic'>".fillComma($arr_female[$i])."</td>";
				echo "<td class='numberic'>".fillComma($arr_summary[$i])."</td>";
						//echo "<td class='numberic'>".fillComma($arr_house[$i])."</td>";
                    $seq++;
                    $start_arr++;
                    echo "</tr> ";
                } //end <tr> generate
			}
			

				//////// summary ///////
                echo "<tr><td colspan='6'><br></td></tr>";
				echo "<tr><td></td>";
				echo "<td align='left' colspan='2'><b>รวม</b></td>";
				echo "<td class='numberic'><b>".fillComma($sum_male)."</b></td>";
				echo "<td class='numberic'><b>".fillComma($sum_female)."</b></td>";
				echo "<td class='numberic'><b>".fillComma($sum_all)."</b></td>";
				echo "</tr></table>"; 
                //end table
		
			
				//////////////////  sent  chart parameter /////////////////	
				$size = sizeof($arr_name);
				$pie_val;
				$bar_val;
				$bar_cat;
					/// chart_ pie
					for($r=1;$r<= $size;$r++){
						$pie_val.="['".$arr_name[$r]."',".$arr_summary[$r]."],";
					}

					//// bar_categories
					for($r=1;$r<= $size;$r++){
						if($r==$size){
							$bar_cat.="'".$arr_name[$r]."'";
							}else{
							$bar_cat.="'".$arr_name[$r]."',";
							}
					}$bar_cat = "[".$bar_cat."]";
										
					//// bar_value
					for($r=1;$r<= $size;$r++){
						if($r==$size){
							$bar_val.=$arr_summary[$r]."";
							}else{
							$bar_val.=$arr_summary[$r].",";
							}
					}$bar_val = "[".$bar_val."]";				
?>
				
			<script type ="text/javascript">
					$(document).ready(function() {
						var pie_val = "<?php echo $pie_val; ?>";
						var bar_val = "<?php echo $bar_val; ?>";
						var bar_cat = "<?php echo $bar_cat; ?>";
						var ccaattmm="<?php echo $ccaattmm; ?>";
						
						$("#fancybox-manual-a").click(function() {
							$.fancybox.open({
								href : "include/chart_pie.php?value="+pie_val+"&page=ajax_data&sub_page=0&ccaattmm="+ccaattmm+"",
								type : 'iframe',
								padding : 5
								});
							});
			
						
						$("#fancybox-manual-b").click(function() {
							$.fancybox.open({
								href : "include/chart_bar.php?value="+bar_val+"&cat="+bar_cat+"&page=ajax_data&sub_page=0&ccaattmm="+ccaattmm+"",
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

?>


</body>

</html>