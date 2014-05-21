<html>
<head>
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
	  
//----------------------------------------------------------------//		
	function phpFunction($v1){
		// makes an array from the passed variable 
		// (note: $vars = 1 string while it used to be a javascript Array)
		// with explode you can make an array from 1 string. The seperator is a , 
		$varArray = explode(",", $v1);
		
	
		$emp_job=2;
		$emp_rcode='2600';
		$sex=0;
		$nat=99;
		$age_start=1;
		$age_end=15;
		$order_type='111';
		$order_by='11';
		
		$chk_page=$varArray[0] ;
		$yymm=$varArray[1];
		$pop_subtype1=$varArray[2];
		$pop_subtype2=$varArray[3];
		$pop_subtype3=$varArray[4];
		$pop_type=$varArray[5];
    
	?>
	<div id="tabs2">		
	  <ul>
			<li id="tab1"><a href="#tabs2-1" >ตรวจสอบสถิติรายการคนและบ้าน</a></li>
			<li id="tab2" ><a href="#tabs2-2" >ตรวจสอบสถิติรายอายุ</a></li>
	   </ul>
	   
	<?php
        try{
            $hid = $_REQUEST['txt_hid'];
            //$cc = '26';
            $aa = $_REQUEST['sel_aa2'];
            $tt = $_REQUEST['sel_tt2'];
            $mm = $_REQUEST['sel_mm2'];
            $htype = $_REQUEST['sel_htype'];
            
            $htype = 4;
			$result =getPopHouseByCond($yymm, $emp_job, $emp_rcode, $ccaattmm,$pop_type, $pop_subtype1,$pop_subtype2,$pop_subtype3);
            
            //$result = getPopAgeByCond($yymm, $emp_job, $emp_rcode, $sex, $nat,$age_start,$age_end,$order_type, $order_by);
            $arr_data = explode("|", $result);
            $code = $arr_data[0];
			$total=$arr_data[1];

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

				
				//////////////// end paging 1 //////////////}
			
                $arr_length=count($arr_data);	
                
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
				
                 //start table		    
                 ?>	
				 <div id="tabs2-1">
					<table class='result_table'>
                        <tr>
                            <th width='25px'>#</th>
                            <th width='150px' colspan='2'>สำนักทะเบียน</th>
                            <th>ชาย</th>                        
                            <th>หญิง</th>                        
                            <th>รวม</th>
                            <th>จำนวนบ้าน</th>
                        </tr>
						
              <?php   
					if($chk_page==0){
						$start_arr=($chk_page*$before_p)+2;
						}else{$start_arr=(5*$before_p)-3;}
			
			
            for($i=$before_p;$i<=($plus_p );$i++){
				
				if($arr_data[$start_arr]!=null){
                 echo "<tr><td>".$i."</td>";					
				 
		  
				//////////////// fetch Data /////////////////       
				//rcode
					$arr_rcode[$i]=$arr_data[$start_arr];
					$start_arr++;
				
				//name	
					$arr_name[$i]= str_replace('ท้องถิ่น',' ',$arr_data[$start_arr]);
                    $start_arr++;
					
				//male	
					$arr_male[$i]=$arr_data[$start_arr];
					$sum_male+=$arr_male[$i];
					$start_arr++;
					
				//female
					$arr_female[$i]=$arr_data[$start_arr];	  
					$sum_female+=intval($arr_female[$i]);
					$start_arr++;
					
				 //summary
				 	$arr_summary[$i] = intval($arr_data[$start_arr-1])+intval($arr_data[$start_arr-2]);
					$sum_all+=$arr_summary[$i];
					
				//house
					$arr_house[$i]=$arr_data[$start_arr];	 
					$sum_house+=$arr_house[$i];
					
				///////////  generate td ///////////////	
					    echo "<td>".$arr_rcode[$i]."</td>";    
						echo "<td class='text'>".$arr_name[$i]."</td>";
						echo "<td class='numberic'>".numberfix($arr_male[$i])."</td>";
						echo "<td class='numberic'>".numberfix($arr_female[$i])."</td>";
						echo "<td class='numberic'>".numberfix($arr_summary[$i])."</td>";
						echo "<td class='numberic'>".numberfix($arr_house[$i])."</td>";
                    $seq++;
                    $start_arr++;
                    echo "</tr> ";
                } //end <tr> generate
			}
			

				//////// summary ///////
                echo "<tr><td colspan='100%'><br></td></tr>";
				echo "<tr><td colspan='2'></td>";
				echo "<td align='left'><b>รวม</b></td>";
				echo "<td class='numberic'><b>".numberfix($sum_male)."</b></td>";
				echo "<td class='numberic'><b>".numberfix($sum_female)."</b></td>";
				echo "<td class='numberic'><b>".numberfix($sum_all)."</b></td>";
				echo "<td class='numberic'><b>".numberfix($sum_house)."</b></td>";
				echo "</tr></table>"; 
                //end table
					
				$size = sizeof($arr_name);
				$all;
				for($r=1;$r<= $size;$r++){
					$all.="['".$arr_name[$r]."',".$arr_summary[$r]."],";
				}
				
				chart_pie($all);
				
				
				
				echo "<div class='browse_page' style='float:right;'>";
						page_navigator($before_p,$plus_p,$total,$total_p,$chk_page);    // เรียกใช้งานฟังก์ชั่น สำหรับแสดงการแบ่งหน้า   
				echo "</div>";
				
            }else if ($code == "0"){
               // echo "<meta http-equiv='refresh' content='0;URL=search_pop.php>";
                echo "<script language='javascript'>alert('ไม่พบข้อมูลตามเงื่อนไขที่ระบุ')</script>";
                exit();
            }else if ($code == "9"){
                //echo "<meta http-equiv='refresh' content='0;URL=search_pop.php>";
                echo "<script language='javascript'>alert('เกิดความผิดพลาด : {$arr_data[1]}')</script>";
                exit();
            }
        }catch (Exception $e){
            //$result = "9|{$e->getMessage()}";
            //echo "<meta http-equiv='refresh' content='0;URL=search_pop.php>";
            echo "<script language='javascript'>alert('เกิดความผิดพลาด : {$e->getMessage()}')</script>";
            exit();
        }
		
    }//end php function;

?>
	</div> <!-- end div tab1 -->
</div> <!-- end tab div-->



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

 function numberfix($number)  {
	$number = intVal($number);
    $number = number_format($number,0," ",",");
    return str_replace(" ", "&nbsp;", $number);
  }


function chart_pie($all){ ?><script type="text/javascript">
//-------------------------------------------- Pie chart ----------------------------------------------//		\

    $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'จำนวนประชากรจังหวัด นครนายก'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage:.2f} %</b>' ,
            	percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ Math.round(this.percentage*100)/100 +' %';
                        }
                    }
                }
            },
            series: [{ 
                type: 'pie',
                name: 'คิดเป็นเปอร์เซนต์',
				data: [
					
					<?php  echo $all; ?>
					
                ]
            }]
        });


</script>
	<?php }//end function?>


</body>






</html>