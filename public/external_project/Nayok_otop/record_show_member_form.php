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
var table = "member";
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
            "oLanguage": {
	            "sLengthMenu": "แสดง _MENU_ บรรทัด ต่อหน้า",
	            "sZeroRecords": "ไม่เจอข้อมูลที่ค้นหา",
	            "sInfo": "แสดง _START_ ถึง _END_ จากทั้งหมด _TOTAL_ บรรทัด",
	            "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
	            "sInfoFiltered": "",
	            "sSearch": "ค้นหา :",
	            "oPaginate": {
	                "sFirst": "หน้าแรก",
	                "sLast": "หน้าสุดท้าย",
	                "sNext": "ต่อไป",
	                "sPrevious": "ก่อนหน้านี้"
              	}
	        },			
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
			"sPaginationType": "full_numbers",
			"sScrollY": 540,
			"sScrollX": "100%",
			"sScrollXInner": "150%",
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
					<th width="100" field="member_pid">รหัสประจำตัวประชาชน</th>
					<th width="20" field="fname">ชื่อ</th>
					<th width="50" field="lname">นามสกุล</th>
					<th width="50" field="member_career">อาชีพ</th>
					<th width="100" field="member_address">ที่อยู่</th>
					<th width="40" field="member_phone1">โทรศัพท์ (1)</th>
					<th width="40" field="member_phone2">โทรศัพท์ (2)</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</body>
</html>
</div>