<div class="position">
	<br />
	<div class="subfieldsset">
		<div>
			<label for="groups_drop_down<?php echo $max; ?>">ประเภทสมาชิก/องค์กร</label>
			<select name="groups_drop_down<?php echo $max; ?>" id="groups_drop_down<?php echo $max; ?>" onchange="onGroupsChange(<?php echo $max; ?>);">
				<?php foreach($groups as $items):?>
				  <option value="<?php echo $items->group_id; ?>"><?php echo $items->group_name; ?></option>
				<?php endforeach;?>
			</select>
		</div>
		<div>
			<label for="group_position_drop_down<?php echo $max; ?>">ชื่อตำแหน่ง</label>
			<select name="group_position_drop_down<?php echo $max; ?>" id="group_position_drop_down<?php echo $max; ?>">
				<?php foreach($group_position as $items):?>
				  <option value="<?php echo $items->group_position_id; ?>"><?php echo $items->group_position_name; ?></option>
				<?php endforeach;?>
			</select>
		</div>
		<div>
			<label></label>
			<label for="a<?php echo $max; ?>" class="labelsmall">
				<input type="radio" name="group_position_by<?php echo $max; ?>" id="a<?php echo $max; ?>" value="0" checked />โดยตำแหน่ง
			</label>
			<label for="b<?php echo $max; ?>" class="labelsmall">
				<input type="radio" name="group_position_by<?php echo $max; ?>" id="b<?php echo $max; ?>" value="1" />ทรงคุณวุฒิ
			</label>
		</div>
		<div>
			<label for="group_position_start_date<?php echo $max; ?>">วันดำรงตำแหน่ง</label>
			<input type="text" size="10" id="group_position_start_date<?php echo $max; ?>" name="group_position_start_date<?php echo $max; ?>" class="type_date_key<?php echo $edit ? '1' : ''; ?>" />
		</div>
		<div>
			<label></label>
				<input type="button" id="remScnt" name="remScnt" value="ลบตำแหน่ง"/>
		</div>
		<br />
	</div>
</div>
<script language="javascript">
	input_ClassLoader("#profileForm "); 
</script>