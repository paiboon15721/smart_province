<table cellpadding="0" cellspacing="0" border="0" class="display" id="datatable">
	<thead>
		<tr>
			@foreach($columns as $i => $c)
				<th>{{ $c }}</th>
			@endforeach
		</tr>
	</thead>
	<tbody>
		@foreach($data as $d)
			<tr>
				@foreach($d as $dd)
					<td>{{ $dd }}</td>
				@endforeach
			</tr>
		@endforeach
	</tbody>
</table>
<script type="text/javascript">
var oTable;
	$(document).ready(function(){
		TableTools.BUTTONS.add = {
			"sAction": "text",
			"sToolTip": "",
			"fnMouseover": null,
			"fnMouseout": null,
			"fnClick": function( nButton, oConfig ) {
				window.location = "";
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
					window.location = "";
				}
			},
			"fnSelect": null,
			"fnComplete": null,
			"fnInit": null
		};

		TableTools.BUTTONS.remove = {
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
						window.location = "";
					}
				}
			},
			"fnSelect": null,
			"fnComplete": null,
			"fnInit": null
		};
		oTable = $('#datatable').dataTable({
			"sDom": '<"H"Tfr>t<"F"ip>',
			"sPaginationType": "full_numbers",
			"bProcessing": false,
			"oTableTools": {
				"sRowSelect": "single",
				"aButtons": [
					{
						"sExtends":    "add",
						"sButtonText": "เพิ่ม"
					},
					{
						"sExtends":    "edit",
						"sButtonText": "แก้ไข"
					},
					{
						"sExtends":    "remove",
						"sButtonText": "ลบ"
					}
				]
			},
			@foreach ($options as $k => $o)
				{{ json_encode($k) }}: {{ json_encode($o) }},
			@endforeach
			@foreach ($callbacks as $k => $o)
				{{ json_encode($k) }}: {{ $o }},
			@endforeach
			//"fnDrawCallback": function(oSettings) {
			//    jQuery.uniform.update();
			//}
		});
	});
</script>