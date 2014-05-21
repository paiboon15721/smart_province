<div id="welcome" class="post">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Simple CSS Form - WittySparks Framework</title>

		<?php
		//css include
			echo css_asset('jquery-ui-1.8.14.custom.css');
			echo css_asset('demo_table_jui.css');
			echo css_asset('TableTools_JUI.css');
			echo css_asset('style_information.css');
			echo js_asset('jquery.dataTables.min.js');
			echo js_asset('TableTools.js');
			echo js_asset('ZeroClipboard.js');
			echo js_asset('jquery.jeditable.js');
		?>
<script type="text/javascript" charset="utf-8">
var oTable;
var table = "groups";
	$(document).ready(function() {			
		TableTools.BUTTONS.add = {
			"sAction": "text",
			"sToolTip": "",
			"fnMouseover": null,
			"fnMouseout": null,
			"fnClick": function( nButton, oConfig ) {
				window.location = "<?php echo $pathLoadPage; ?>" + "/record_add_" + table + "_form";
			},
			"fnSelect": null,
			"fnComplete": null,
			"fnInit": null
		};

		TableTools.BUTTONS.edit = {
			"sAction": "text",
			"sToolTip": "",
			"fnMouseover": null,
			"fnMouseout": null,
			"fnClick": function( nButton, oConfig ) {
				var oTT = TableTools.fnGetInstance( 'datatable' );
				if (oTT.fnGetSelectedData() == "") {
					alert("กรุณาเลือกรายการที่ต้องการแก้ไข");
				} else {
					var aData = oTT.fnGetSelectedData()[0][0];
					window.location = "<?php echo $pathLoadPage; ?>" + "/record_edit_" + table + "_form/" + aData;
				}
			},
			"fnSelect": null,
			"fnComplete": null,
			"fnInit": null
		};

		TableTools.BUTTONS.delete = {
			"sAction": "text",
			"sToolTip": "",
			"fnMouseover": null,
			"fnMouseout": null,
			"fnClick": function( nButton, oConfig ) {
				var oTT = TableTools.fnGetInstance( 'datatable' );
				if (oTT.fnGetSelectedData() == "") {
					alert("กรุณาเลือกรายการที่ต้องการลบ");
				} else {
					if(confirm('คุณแน่ใจที่จะลบข้อมูลนี้?')){
						var aData = oTT.fnGetSelectedData()[0][0];
						window.location = "<?php echo $pathLoadPage; ?>" + "/record_delete_" + table + "_form/" + aData;
					}
				}
			},
			"fnSelect": null,
			"fnComplete": null,
			"fnInit": null
		};

		oTable = $('#datatable').dataTable({
			"sDom": '<"H"Tfr>t<"F"ip>',
			"oTableTools": {
				"sRowSelect": "single",
				"aButtons": [
					{
						"sExtends":    "add",
						"sButtonText": "เพิ่ม",
					},
					{
						"sExtends":    "edit",
						"sButtonText": "แก้ไข",
					},
					{
						"sExtends":    "delete",
						"sButtonText": "ลบ",
					}
				]
			},
			"bJQueryUI": true,
			"aoColumns": [ 
						{"bVisible": false},
						null,
						null
					],
			"sPaginationType": "full_numbers",
			"sScrollY": 540,
			"sScrollX": "100%",
			"sScrollXInner": "100%",
			"bScrollCollapse": true,
			"bProcessing": true,
			"bServerSide": true,
			"iDisplayLength": 10,
			"sAjaxSource": "<?php echo $pathLoadPage; ?>" + "/datatable_show_" + table
		});
	});
</script>

	</head>
	<body>
		<?php 
			echo $this->session->flashdata('message');
		?>
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="datatable">
			<thead>
				<tr>
					<th field="group_id">รหัสองค์กร</th>
					<th field="group_name">ชื่อองค์กร</th>
					<th field="group_working_capital">เงินทุนหมุนเวียน</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</body>
</html>
</div>