<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php include "../../../include/func.php";?>


<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<script type="text/javascript" language="javascript" src="DataTables/media/js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="DataTables/media/js/jquery.dataTables.js"></script>
		<script  type="text/javascript" language="javascript" src='js/jquery.jeditable.js'></script>
			<script  type="text/javascript" language="javascript" src='js/jquery.dataTables.min.js'></script>
			<script  type="text/javascript" language="javascript" src='js/TableTools.js'></script>
			<script  type="text/javascript" language="javascript" src='js/ZeroClipboard.js'></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {

				var oTable;
 

    /* Add a click handler to the rows - this could be used as a callback */
    $("#example tbody tr").click( function( e ) {
        if ( $(this).hasClass('row_selected') ) {
            $(this).removeClass('row_selected');
        }
        else {
            oTable.$('tr.row_selected').removeClass('row_selected');
            $(this).addClass('row_selected');
        }
    });
     
    /* Add a click handler for the delete row */
    $('#delete').click( function() {
        var anSelected = fnGetSelected( oTable );
        if ( anSelected.length !== 0 ) {
            oTable.fnDeleteRow( anSelected[0] );
        }
    } );
     
	 
    /* Init the table */
		oTable = $('#example').dataTable( {
				"iDisplayLength": 200,
				"sPaginationType": "full_numbers",
				"bLengthChange": false,
				"bStateSave": true,
				"sScrollY": "450px",
				"sScrollX": "100%",
					"oPaginate": {
					"sFirst": "หน้าแรก",
					"sLast": "หน้าสุดท้าย",
					"sNext": "ต่อไป",
					"sPrevious": "ก่อนหน้านี้"
				}
		} );
    

	/* Get the rows which are currently selected */
	function fnGetSelected( oTableLocal )	{
		return oTableLocal.$('tr.row_selected');
	}				
} ); //end ready 
		</script>
		<style>
			.bullet_val{
				display:none;
			}
			
			.bullet_star{
				background-image:url("images/star_red.png");
				width:26px;
				height:26px;
				color:#fff;
				line-height:26px;
			}
		</style>
		
	</head>
	<body id="dt_example">
	
		<div id="container">
			<div id="demo">
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				
					<thead>
						<tr>
							<th>id</th>
							<th>ชื่อสินค้า</th>
							<th>ประเภทสินค้า</th>
							<th>ดาว</th>
							<th>มีรูป</th>
							<th>วันที่</th>
							<th>เวลา</th>
							<th>คำอธิบาย</th>
							<th>กลุ่ม</th>
							<th>ชื่อ</th>
							<th>เบอร์โทร</th>
							<th>ที่อยู่</th>
						</tr>
					</thead>
					<tbody>

					<?php 
					
					function Chk_Pic($pic_name){
						if($pic_name!=null||0|""){
								echo "<div class='bullet_val'>1</div><img src='images/ok_2_red.png'>";
						}else{
									echo "<div class='bullet_val'>0</div><img src='images/cancel.png'>";
						}
					}
					
					function show_star($star){
							echo "<div class='bullet_star'>$star</div>";
					}
				
					
						$host = "localhost";
						$user = "mia";
						$pass = "mia";
						$dbname = "village_center";
				//		$dbname = "VILLAGE_CENTER";
						$condb= mysql_connect($host,$user,$pass);  //สร้างการเชื่อมต่อฐานข้อมูลเก็บไว้ในตัวแปร $condb
						mysql_select_db($dbname);
						
							
								$selSQL="select a.*, b.otop_type_name from tab_otop a left join tab_otop_type b on b.otop_type = a.otop_type order by  a.otop_id ";
										mysql_query("set character set utf8");
										if(mysql_query($selSQL)){
										
											$objQuery = mysql_query($selSQL);
											
											while($objResult = mysql_fetch_array($objQuery)){
												$otop_id = $objResult['otop_id'];
												$otop_name = $objResult['otop_name'];
												$otop_type = $objResult['otop_type_name'];
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


						<tr class="gradeX">
							<td style="text-align:right;"><?php echo $otop_id; ?></td>
							<td style="text-align:left;"><?php echo $otop_name;?></td>
							<td><?php echo $otop_type;?></td>
							<td class="center"><?php echo show_star($otop_star);?></td>
							<td class="center"><?php Chk_Pic($otop_pic_no);?></td>
							<td class="center" style="font-size:small;"><?php echo TxtDate(lpad($otop_upd_date,"0",8),"ymd"); ?></td>
							<td class="center" style="font-size:small;"><?php echo TxtTime(lpad($otop_upd_time,"0",6));?></td>
							<td><?php echo $otop_detail;?></td>
							<td><?php echo $otop_group;?></td>
							<td><?php echo $otop_contract_name;?></td>
							<td><?php echo $otop_contract_tel; ?></td>
							<td><?php echo $otop_contract_addr;?></td>
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
							<th style="padding:5px;"></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
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