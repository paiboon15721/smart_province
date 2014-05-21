<div id="welcome" class="post">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Simple CSS Form - WittySparks Framework</title>

		<?php
		//css include
			echo css_asset('style_add.css');
		?>

	</head>
	<body>

		<div class="formarea">
			<div class="requiredfld">
				<span class="required">*</span> จำเป็นต้องระบุ
			</div>
			<?php
				$edit = isset($groupsData);
				if ($edit) {
					if ($groupsData == '') {
						$groupsData = false;
					}
				}
				$attributes = array('autocomplete' => 'off', 'id' => 'profileForm');
				echo form_open_multipart($pathForm, $attributes);
			?>
				<h2><?php echo $edit ? "แก้ไข" : "บันทึก" ?>ข้อมูลตำแหน่ง</h2>
				<div class="subfieldsset">
					<div class="notification">
					<!-- <div class="error">Please fill in all the required fields and try to submit the form</div>
							<div class="information">Fill in the form complately to avoid regular errors.</div>-->
						<?php 
							echo validation_errors('<div class="error">', '</div>'); 
							echo $this->session->flashdata('message');
						?>
					</div>
					<div>
						<label for="group_id">ชื่อสมาชิก/องค์กร</label>
						<select name="group_id" id="group_id">
							<?php foreach($groups as $items):?>
							  <option value="<?php echo $items->group_id; ?>" <?php echo $edit ? ($items->group_id == $groupMemberData[$i]->group_id) ? 'selected' : '' : set_select('group_id', $items->group_id); ?> ><?php echo $items->group_name; ?></option>
							<?php endforeach;?>
						</select>
					</div>
					<div>
						<label for="group_position_name"><span class="required">*</span> ชื่อตำแหน่ง</label>
						<input type="text" size="30" id="group_position_name" name="group_position_name" value="<?php echo ($edit and $groupsData) ? $groupsData->group_position_name : set_value('group_position_name'); ?>" />
					</div>
					<div>
						<label for="group_num_year">ระยะเวลาดำรงตำแหน่ง</label>
						<input type="text" size="30" id="group_num_year" name="group_num_year" value="<?php echo ($edit and $groupsData) ? $groupsData->group_num_year : set_value('group_num_year'); ?>" />
					</div>
					<br />
				</div>

				<div class="buttonsarea">
					<input type="submit" value="บันทึก" />
					<input type="button" value="กลับ" onclick="window.location='<?php echo $pathLoadPage; ?>/record_show_group_position_form'" />
					<?php if ($edit): ?>
						<input type="hidden" name="group_id" id="group_id" value="<?php echo $groupsData ? $groupsData->group_id : ''; ?>">
					<?php endif; ?>
				</div>
				<br />
				</form>
		</div> <!-- end of formarea -->
	</body>
</html>
</div>