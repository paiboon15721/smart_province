<div id="welcome" class="post">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Simple CSS Form - WittySparks Framework</title>

		<?php
		//css include
			echo js_asset('jquery-1.7.2.min.js');
			echo css_asset('jquery-ui-1.8.14.custom.css');
			echo css_asset('demo_table_jui.css');
			//echo css_asset('TableTools_JUI.css');
			echo css_asset('style_information.css');
			echo js_asset('jquery.dataTables.min.js');
			echo js_asset('TableTools.js');
			echo js_asset('ZeroClipboard.js');
			echo js_asset('jquery.jeditable.js');
		?>

<style type="text/css">
  body {
		font: normal 13px "Trebuchet MS", Arial, Helvetica, sans-serif;
	}

	table {
			font: normal 13px "Trebuchet MS", Arial, Helvetica, sans-serif;
	 }
  </style>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {		
		/*TableTools.BUTTONS.add = {
			"sAction": "text",
			"sToolTip": "",
			"fnMouseover": null,
			"fnMouseout": null,
			"fnClick": function( nButton, oConfig ) {
				
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

			},
			"fnSelect": null,
			"fnComplete": null,
			"fnInit": null
		};*/

		$('#datatable').dataTable({
			//"sDom": '<"H"Tfr>t<"F"ip>',
			"oTableTools": {
				"sRowSelect": "single"
				/*"aButtons": [
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
				]*/
			},
			"bJQueryUI": true,
			"sPaginationType": "full_numbers",
			"sScrollY": 540,
			"sScrollX": "100%",
			"sScrollXInner": "100%",
			"bScrollCollapse": true,
			"iDisplayLength": 10
		});
	});
</script>

	</head>
	<body>
	<h1 class="title" style="color: #4F789F;border-bottom: 1px solid #3B3B3B; padding-bottom: 10px"><?php echo $title; ?></h1>
		<?php 
			echo $this->session->flashdata('message');
		?>
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="datatable" style>
			<thead>
				<tr>
					<?php foreach($header as $items): ?>
						<th class="center"><?php echo $items; ?></th>
					<?php endforeach;?>
				</tr>
			</thead>
			<tbody>
				<?php
					$countRowData = count($data);
					$countColData = count(explode("|", substr(trim($data[0]), 0, -1)));
					for ($row = 0;$row < $countRowData;$row++) {
						echo '<tr>';
						echo '<td>'.($row+1).'</td>';
						$rowData = explode("|", substr(trim($data[$row]), 0, -1));
						for ($col = 0;$col < $countColData;$col++) {
							echo '<td>'.$rowData[$col].'</td>';
						}
						echo '</tr>';
					}
				?>
				</tbody>
		</table>	
	</body>
</html>
</div>