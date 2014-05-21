<script type="text/javascript">tablecloth();</script>
<div id="contentpopup">
<div id="welcome" class="post" style="border-bottom: 0px">
<h1 class="title" style="border-bottom: 1px solid #3B3B3B; padding-bottom: 10px"><?php echo $title; ?></h1>
	<p>
		<table cellspacing="0" cellpadding="0"  id="datatable">
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
							if ($col == 3) {
								echo '<td>'.image_asset($village."_images/agri_product_transform/".$rowData[$col], null).'</td>';	
							} else {
								echo '<td>'.$rowData[$col].'</td>';
							}
						}
						echo '</tr>';
					}
				?>
				</tbody>
		</table>	
	</p>
</div>
</div>