
<?php
	header("Content-type:text/html; charset=UTF-8");              
	header("Cache-Control: no-store, no-cache, must-revalidate");             
	header("Cache-Control: post-check=0, pre-check=0", false);   
				
	include "stat_func.php";			
				
	$devMode = 1 ; //0 is off , 1 is on develop mode			
	
	
	
	 if (isset($_GET[value])){ 
	// Retrieve the GET parameters and executes the function
		$value = $_GET[value];
		$categories = $_GET[cat];
		$group = $_GET[group];
		$page = $_GET[page];
		$sub_page = $_GET[sub_page];
		$ccaattmm = $_GET[ccaattmm];
	} 

	
	$obj = $_GET[obj];
	$new_obj = json_decode($obj);
	$json_male = $new_obj->{'json_male'}; 
	$json_female = $new_obj->{'json_female'} ;
	$json_cat = $new_obj ->{'json_cat'};
	$json_group = json_encode($new_obj ->{'json_group'});
	
	
	// $json_cat[0] = "male";
	
	$type1 = Array("name" => $json_cat[0] , "data" => $json_male);
	$type2 = Array("name" => $json_cat[1] , "data" => $json_female);
	$series = json_encode(Array($type1 ,$type2));
		
	$totol_group = count($group);	
	$sub_head = "จังหวัดนครนายก ";
	$sub_head.= get_label($ccaattmm);
					
////////// convert format to plugin
		// for ($a = 0 ; $a <= $totol_group - 1 ; $a++){
			// $content = "{ name : ".$group[$a].", data : [";
			
			// for ($b = 0 ; $b <= count($data[$a])-1 ; $b++){
				// $content .= $data[$a][$b];
				// $content .= ($a != count($data[$a])-1? "]" : "," ) ;
			// }
			// $content .= ($a != $totol_group - 1 ? "}," : "}" ) ;
		// }						
		// echo $content;

///////////////// label ////////////////////
								
	     if($page=="ajax_data"){
			$head = "กราฟสถิติรายคน";
			$detail ="จำนวนประชากร";
			$unit = "(คน)";
		}
		if($page=="ajax_house"){
			$head = "กราฟสถิติรายการบ้าน";
			$detail ="จำนวนบ้าน";
			$unit = "(หลัง)";
		}
		if($page=="ajax_age"){
			$head = "กราฟสถิติรายอายุ";
			$detail ="จำนวนประชากร";
			$unit = "(คน)";
			
			switch($sub_page){
				case 0 : $head.="";							break;
				case 1 : $head.=" (สัญชาติไทย)";		break;
				case 2 : $head.=" (สัญชาติจีน)";			break;
				case 3 : $head.=" (สัญชาติอื่นๆ)";		break;
			}
		}
		
		
		if($devMode >0){
			echo "total_group : ".$totol_group."<br>";
			echo "sub_head : ".$sub_head."<br>";
			echo "sub_page : ".$sub_page."<br>";
			echo "head : " .$head."<br>";
			echo "send type : " ;
				if(isset($_GET[value])){	echo "GET ";	}
				if(isset($_GET[value])){	echo "POST ";	}
			echo "<br>";
		}
			
	?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	

	<script src="../lib/js/jquery-1.9.0.min.js" type="text/javascript"></script>
	<script type="text/javascript">	
				$(function () {
					  $('#container3').highcharts({
							chart: {
							backgroundColor:'rgba(255, 255, 255, 0.1)',
							paddingBottom: 100 ,
							paddingTop: 100,
							marginBottom: 130 ,
							type: 'column'
						},
						title: {
							text: '<?php echo $head;?>'
						},
						subtitle: {
							text: '<?php echo $sub_head;?>'
						},
						xAxis: {
							categories: <?php echo $json_group; ?>,
							// categories:  [<?php echo $categories;?>],
							 labels: {
								rotation: -45,
								align: 'right',
								style: {
									fontSize: '11px',
									fontFamily: 'Verdana, sans-serif'
								}
							}
						},
						yAxis: {
							min: 0,
							title: {
								text: '<?php echo $detail." ".$unit;?>'
							}
						},
						tooltip: {
							headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
							pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
								'<td style="padding:0"><b>{point.y} '+'<?php echo $unit; ?>' +'</b></td></tr>',
							footerFormat: '</table>',
							shared: true,
							useHTML: true
						},
						plotOptions: {
							column: {
								pointPadding: 0,
								borderWidth: 0
							}
						},
						series: <?php echo $series ; ?>
					});
				});

				

		</script>
</head>
<body>
	<script src="../plugin/Highcharts-3.0.1/js/highcharts.js"></script>
	<script src="../plugin/Highcharts-3.0.1/js/modules/exporting.js"></script>
	<div id="container3" style="margin:0px auto; height:500px"></div>
</body>
</html>

<?php 
//////////////// get label of province tumbon mooban ///////////////////
	function get_label($ccaattmm){
			$lst_ampor = getListAA(substr($ccaattmm,0,2));
			$lst_tumbon = getListTT(substr($ccaattmm,0,4));
			$lst_mooban = getListMM(substr($ccaattmm,0,6));
			$arr_aa = explode("|", $lst_ampor);
			$arr_tt = explode("|", $lst_tumbon);
			$arr_mm = explode("|", $lst_mooban);
			$label;

			/// sel ampor
			for($i=0; $i<(count($arr_aa)-3) ;$i+=2){
				if(substr($arr_aa[$i+2],2,2)==substr($ccaattmm,2,2)){
					$label = str_replace('ท้องถิ่น','',$arr_aa[$i+3])." ";
				}
			}
			
			/// sel tumbon
			for($i=0; $i<(count($arr_tt)-3) ;$i+=2){
				if(substr($arr_tt[$i+2],4,2)==substr($ccaattmm,4,2)){
					$label .= " ตำบล".$arr_tt[$i+3]." ";
				}
			}
			
			/// sel mooban
			for($i=0; $i<(count($arr_mm)-3) ;$i+=2){
				if(substr($arr_mm[$i+2],6,2)==substr($ccaattmm,6,2)){
					$label .= " หมู่".$arr_mm[$i+3];
					}
			}
			
			return $label;
		}//end get_label

?>






