<script type="text/javascript">
	$(document).ready(function() {
		$("#b_show_search_project").fancybox();
	});
	tablecloth();
</script>
<div id="contentpopup">
<div id="welcome" class="post" style="border-bottom: 0px">
<h1 class="title" style="border-bottom: 1px solid #3B3B3B; padding-bottom: 10px"><?php echo $title; ?><span style="float: right;"><a id="b_show_search_project" href="<?php echo $pathLoadPage; ?>/show_search_project/<?php echo $plan; ?>/<?php echo $year;?>">กลับ</a></span></h1>
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
							echo '<td>'.$rowData[$col].'</td>';
						}
						echo '</tr>';
					}
				?>
				</tbody>
		</table>	
	</p>
</div>
</div>