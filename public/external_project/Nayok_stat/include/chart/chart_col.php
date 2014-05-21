
<?php
	header("Content-type:text/html; charset=UTF-8");              
	header("Cache-Control: no-store, no-cache, must-revalidate");             
	header("Cache-Control: post-check=0, pre-check=0", false);   
				
	include "../stat_func.php";			
				
	 if (isset($_GET[value])){ 
	// Retrieve the GET parameters and executes the function
	  $value	 = $_GET[value];
	  $categories = $_GET[cat];
	  $page =$_GET[page];
	  $sub_page = $_GET[sub_page];
	  $ccaattmm = $_GET[ccaattmm];
			}  else if (isset($_POST[value])){
			// Retrieve the POST parameters and executes the function
			$value	 = $_POST[value];
			$page=$_POST[page];
			$sub_page = $_POST[sub_page];
			$ccaattmm = $_POST[ccaattmm];
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
			
			switch($sub_page){
				case 0 : $head.="";						break;
				case 1 : $head.=" (สัญชาติไทย)";	break;
				case 2 : $head.=" (สัญชาติจีน)";		break;
				case 3 : $head.=" (สัญชาติอื่นๆ)";	break;
			}
		}
		if($page=="ajax_house"){
			$head = "กราฟสถิติรายการบ้าน";
			$detail ="จำนวนบ้าน";
			$unit = "(หลัง)";
		}
		$sub_head = "จังหวัดนครนายก ";
		$sub_head.= get_label($ccaattmm);
	?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script src="../../lib/js/jquery-1.9.0.min.js" type="text/javascript"></script>
</head>
<body>
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
                categories:  [<?php echo $categories?> ],
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
                    text: 'deatail'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px; ">{point.key}</span><table style="width:250px;">',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:f} '+'<?php echo $unit;?>' +'</b></td></tr>',
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
            series: [
			
				<?php echo $value;?>
			
			]
        });
    });
    

		</script>
	</head>
<body>
	<script src="../../plugin/Highcharts-3.0.1/js/highcharts.js"></script>
	<script src="../../plugin/Highcharts-3.0.1/js/modules/exporting.js"></script>
	<div style="height:600px;">
		<div id="container3" style="margin:0px auto; height:500px; position:relative;"></div>
		<div id="describe3" style="margin:0 auto; color:#888; position:absolute; left:50%; margin-left:-112px; bottom:6px; z-index:99;">คลิ๊กที่แต่ละประเภทเผื่อเลือกดู</div>
	</div>
</body>
</html>
