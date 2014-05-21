
<?php
	header("Content-type:text/html; charset=UTF-8");              
	header("Cache-Control: no-store, no-cache, must-revalidate");             
	header("Cache-Control: post-check=0, pre-check=0", false);   
				
	include "stat_func.php";			
	$devMode = 0 ; // 0 : off , 1 on develop
				
				
				
				
	 if (isset($_GET[value])){ 
	// Retrieve the GET parameters and executes the function
		$value  = $_GET[value];
		$categories =$_GET[cat];
		$page =$_GET[page];
		$sub_page = $_GET[sub_page];
		$ccaattmm = $_GET[ccaattmm];
	} else if (isset($_POST[value])){
		// Retrieve the POST parameters and executes the function
		$value = $_POST[value];
		$categories = $_POST[cat];
		$page=$_POST[page];
		$sub_page = $_POST[sub_page];
		$ccaattmm = $_POST[ccaattmm];
	}
	
	IF ($devMode == 1){
		echo "value : ".$value."<br>";
		echo "categories : ".$categories."<br>";
		echo "page : ".$page."<br>";
		echo "sub_page : ".$sub_page."<br>";		
	}
			
			
			
					
					
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

										/////////////////	label ////////////////////
								
	     if($page=="ajax_data"){
			$head = "กราฟสถิติรายคน";
			$detail ="จำนวนประชากร";
			$unit = "(คน)";
		}
		
		if($page=="ajax_age"){
			$head = "กราฟสถิติรายอายุ";
			$detail ="จำนวนประชากร";
			$unit = "(คน)";
			
			switch ($sub_page){
				case 0 : $head.=""; 						break;
				case 1 : $head.=" (สัญชาติไทย)"; 	break;
				case 2 : $head.=" (สัญชาติจีน)";	break;
				case 3 : $head.=" (สัญชาติอื่นๆ)"; break;
			}
			
		}
		if($page=="ajax_house"){
			$head = "กราฟสถิติรายการบ้าน";
			$detail ="จำนวนบ้าน";
			$unit = "(หลัง)";
		}
		$sub_head = "จังหวัดนครนายก ";
		$sub_head.= get_label($ccaattmm);

		//echo $value;
	?>
<html>
<head>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="../lib/js/jquery-1.9.0.min.js" type="text/javascript"></script>
</head>
<body>


	<script type="text/javascript">
	
		
$(function () {
        $('#container2').highcharts({
            chart: {
				marginTop:80,
				paddingTop:30,
                type: 'column',
				backgroundColor:'rgba(255, 255, 255, 0.1)',
                margin: [ 50, 50, 100, 80]
            },
            title: {
                text: '<?php echo $head; ?>'
            },
			subtitle: {
                text: '<?php echo $sub_head; ?>'
            },
            xAxis: {
                categories: <?php echo $categories; ?>,
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
                    text: '<?php echo $detail." ".$unit; ?>'
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.x +'</b><br/>'+
                        '<?php echo $detail;?>: '+ Highcharts.numberFormat(this.y, 0) +
                        ' <?php echo $unit; ?>';
                }
            },
            series: [{
                name: '<?php echo $detail;?>',
                data: <?php echo $value; ?>,
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#4897F1',
                    align: 'left',
                    x: 6,
                    y: -5,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
					
                }
            }]
        });
    


    });
    

</script>
	</head>
	<body>
<script src="../plugin/Highcharts-3.0.1/js/highcharts.js"></script>
<script src="../plugin/Highcharts-3.0.1/js/modules/exporting.js"></script>
<div id="container2" style="margin:0px auto; height:500px;"></div>
	

</script>
</body>
</html>