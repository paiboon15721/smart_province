<script type="text/javascript">
	$(document).ready(function() {
		$('#show_plan').click(function() {
			$.fancybox({
				'href'			: "<?php echo $pathLoadPage; ?>" + "/show_project/" + "<?php echo $plan; ?>" + '/' + $('#plan_year').val()
			});
		});
	});
</script>
<div id="contentpopup">
<div id="welcome" class="post" style="border-bottom: 0px">
<h1 class="title" style="border-bottom: 1px solid #3B3B3B; padding-bottom: 10px">กรุณาเลือกปี</h1>
	<p>
		<select id="plan_year" name="plan_year" style="width:100px; height: 30px;">
			<?php 
				$countYear = count($year);
				for($i = 0; $countYear > $i; $i++):	
			?>
			  <option value="<?php echo $year[$i]; ?>" <?php echo ($b_year == $year[$i]) ? 'selected' : '' ?>><?php echo $year[$i]; ?></option>
			<?php endfor;?>
		</select>
		<input type="button" value="ตกลง" id="show_plan" name="show_plan" style="width:100px; height: 30px;"  />
	</p>
</div>
</div>