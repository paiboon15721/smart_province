<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="shortcut icon" type="image/ico" href="http://www.datatables.net/media/images/favicon.ico" />
		
		<title>DataTables example</title>
		<style type="text/css" title="currentStyle">
			@import "../../media/css/demo_page.css";
			@import "../../media/css/demo_table.css";
		</style>
		<script type="text/javascript" language="javascript" src="../../media/js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="../../media/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#example').dataTable( {
					"aaSorting": [[ 4, "desc" ]]
				} );
			} );
		</script>
	</head>
	<body id="dt_example">
	

	
		<div id="container">
			<div class="full_width big">
				DataTables table sorting example
			</div>
			
			<h1>Live example</h1>
			<div id="demo">

			
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		<tr>
			<th>ชื่อสินค้า</th>
			<th>ประเภทสินค้า</th>
			<th>ผู้ผลิต </th>
			<th>ดาว</th>
			<th>ชื่อผู้ติดต่อ</th>
			<th>ชื่อรูปภาพ</th>
			<th>วันที่</th>
			
		</tr>
	</thead>
	<tbody>
	"test""
	<?php 
 function otop_type($num){
	if($num==1){
		return "สมุนไพร"; 
	}
		$host = "localhost";
		$user = "mia";
		$pass = "mia";
		$dbname = "village_center";
//		$dbname = "VILLAGE_CENTER";
		$prefix = "";
		$type_arr = Array();
		$condb= mysql_connect($host,$user,$pass);  //สร้างการเชื่อมต่อฐานข้อมูลเก็บไว้ในตัวแปร $condb
		mysql_select_db($dbname);
		
				
				$selSQL="select * from tab_otop_type";
				mysql_query("set character set utf8");
				if(mysql_query($selSQL)){
					$i=0;	
					$objQuery = mysql_query($selSQL);
					while($objResult = mysql_fetch_array($objQuery)){
						$type_arr[$i] =$objQuery['otop_id'] ;
						echo "data is : $type_arr[$i]";
						$i++;
					}
				}else{
					echo "cannot connect DB tab_otop_type";
				}
		
				$selSQL="select * from tab_otop";
						mysql_query("set character set utf8");
						if(mysql_query($selSQL)){
						
							$objQuery = mysql_query($selSQL);
							
							while($objResult = mysql_fetch_array($objQuery)){
								$otop_name = $objResult['otop_id'];
								$otop_name = $objResult['otop_name'];
								$otop_type = $objResult['otop_type'];
								$otop_group = $objResult['otop_group'];
								$otop_star = $objResult['otop_star'];
								$otop_detail = $objResult['otop_detail'];
								$otop_contract_name = $objResult['contract_name'];
								$otop_contract_tel = $objResult['contract_tel'];
								$otop_contract_addr = $objResult['contract_addr'];
								$otop_pic_no = $objResult['pic_no'];
								$otop_upd_date = $objResult['upd_date'];
								$otop_upd_time = $objResult['upd_time'];
?>


		<tr class="gradeX" onclick="alert('<?php echo $otop_id?>')">
			<td><?php echo $otop_name;?></td>
			<td><?php echo otop_type($otop_type);?></td>
			<td><?php echo $otop_group;?></td>
			<td class="center"><?php echo $otop_star;?></td>
			<td class="center"><?php echo $otop_contract_name;?></td>
			<td class="center"><?php echo $otop_pic_no;?></td>
			<td class="center"><?php echo $otop_upd_date;?></td>
			
		</tr>

	<?php		
							}	
						}else{
							echo "cannot connect table.";
						}
	?>
	
	
	</tbody>
	<tfoot>
		<tr>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
	</tfoot>
</table>
			</div>
			
			<div id="footer" class="clear" style="text-align:center;">
				
			</div>
		</div>
	</body>
</html>