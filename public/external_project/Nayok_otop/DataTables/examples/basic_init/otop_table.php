<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php include "../../../include/func.php";?>


<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
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
			
			.hide{
				display:none;
			}
		</style>
		
	</head>
	
	<body id="dt_example">
	<div id="progress"> &nbsp </div>
		<div id="container">
			<div id="demo">
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				
					<thead>
						<tr>
							<th style="width:50px;">id</th>
							<th>ดาว</th>
							<th>ชื่อสินค้า</th>
							<th style="width:150px;">ประเภทสินค้า</th>
							<th>มีรูป</th>
							<th>วันที่</th>
							<th>เวลา</th>
							<th>คำอธิบาย</th>
							<th>กลุ่ม</th>
							<th>ชื่อ</th>
							<th>เบอร์โทร</th>
							<th>ที่อยู่</th>
							<th class="hide"></th>
							<th class="hide"></th>
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
							<td class="center"><?php echo show_star($otop_star);?></td>
							<td style="text-align:left;"><?php echo $otop_name;?></td>
							<td ><?php echo $otop_type;?></td>
							<td class="center"><?php Chk_Pic($otop_pic_no);?></td>
							<td class="center" style="font-size:small;"><?php echo TxtDate(lpad($otop_upd_date,"0",8),"ymd"); ?></td>
							<td class="center" style="font-size:small;"><?php echo TxtTime(lpad($otop_upd_time,"0",6));?></td>
							<td><?php echo $otop_detail;?></td>
							<td><?php echo $otop_group;?></td>
							<td><?php echo $otop_contract_name;?></td>
							<td><?php echo $otop_contract_tel; ?></td>
							<td><?php echo $otop_contract_addr;?></td>
							<td class="hide"><?php echo $otop_pic_no; ?></td>
							<td class="hide"><?php echo $otop_star; ?></td>
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
							<th class="hide"></th>
							<th class="hide"></th>
						</tr>
					</tfoot>
				</table>
			</div>
			
			<div id="footer" class="clear" style="text-align:center;">
			</div>
			
			<div id="big" class="big">adfadfasdfasdfasdfasdf</div>
		</div>
	</body>
	
<script type="text/javascript" language="javascript" src="DataTables/media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="DataTables/media/js/jquery.dataTables.js"></script>
<script  type="text/javascript" language="javascript" src='js/jquery.jeditable.js'></script>
<script  type="text/javascript" language="javascript" src='js/jquery.dataTables.min.js'></script>
<script  type="text/javascript" language="javascript" src='js/TableTools.js'></script>
<script  type="text/javascript" language="javascript" src='js/ZeroClipboard.js'></script>
<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			var oTable;
			var buff_id;
			var buff_pic;
			var data_arr = new Array();
			/* Init the table */
			oTable = $('#example').dataTable( {
					"iDisplayLength": 200,
					"bLengthChange": false,
					"bStateSave": true,
					"sScrollXInner": "1300px",
					"sScrollY": "480px",
					"sScrollX": "100%",
					"bPaginate": false,
					"bDestroy": true
			} );
			

			/* Add a click handler to the rows - this could be used as a callback */
			$("#example tbody tr").click( function( e ) {
				if ( $(this).hasClass('row_selected') ) {
					$(this).removeClass('row_selected');
					bt_disable("bt_edit");
					bt_disable("bt_del");
					data_arr = "";
				}
				else {
					oTable.$('tr.row_selected').removeClass('row_selected');
					var sData = oTable.fnGetData( this );
					data_arr = sData;
					$(this).addClass('row_selected');
					bt_enable("bt_edit");
					bt_enable("bt_del");
				}
			});
			 
			 var test=1;
			var buftest;
			/* Add a click handler for the delete row */
			$('#bt_del').click( function() {
			
			alert("'"+buftest+"|\n"+test);
			buftest=test;
			test++;
				var anSelected = fnGetSelected( oTable );
				if ( anSelected.length !== 0 ) {
					if(confirm("r u sure?")){
						oTable.fnDeleteRow( anSelected[0] );
						$('#progress').load('otop_ajax_delete.php?otop_id='+data_arr[0]+'&pic_name='+data_arr[12]);
						if(anSelected.length==1){
							bt_disable("bt_edit");
							bt_disable("bt_del");
						}
					}
				}
			});
			
			$('#bt_del').click( function() {
			
			alert("'"+buftest+"|\n"+test);
			buftest=test;
			test++;
				var anSelected = fnGetSelected( oTable );
				if ( anSelected.length !== 0 ) {
					if(confirm("r u sure?")){
						oTable.fnDeleteRow( anSelected[0] );
						$('#progress').load('otop_ajax_delete.php?otop_id='+data_arr[0]+'&pic_name='+data_arr[12]);
						if(anSelected.length==1){
							bt_disable("bt_edit");
							bt_disable("bt_del");
						}
					}
				}
			});			
			
		
			  /* Add a click handler for the edit row */
			$('.bt_edit').click( function() {
				bt_disable("bt_edit");
				bt_disable("bt_del");
				bt_enable("bt_lst");
				
	/*

				var anSelected = fnGetSelected( oTable );
				if ( anSelected.length !== 0 ) {
					$('#content').load('otop_ajax_input.php',function(){
						$('#otop_name').val(data_arr[2]);
						$('#otop_group').val(data_arr[7]);
						$('#otop_detail').val(data_arr[7]);
						$('#contract_name').val(data_arr[9]);
						$('#contract_tel').val(data_arr[10]);
						$('#contract_addr').val(data_arr[11]);
						
						if(data_arr[12]!=""){
							$('#preview').html("<img id='showImg' src='uploads/use/"+data_arr[12]+"'  class='preview'>");
						}
						for(var i =0 ;i <= data_arr[13];i++){
							$('#star'+i).removeClass("unrate");
							$('#star'+i).addClass("highlighted");
						}
					});	
				}*/
			} );

	/* Get the rows which are currently selected */
	function fnGetSelected( oTableLocal )	{
		return oTableLocal.$('tr.row_selected');
	}				
} ); //end ready 

</script>
</html>