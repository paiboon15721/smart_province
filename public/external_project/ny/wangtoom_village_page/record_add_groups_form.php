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
				<h2><?php echo $edit ? "แก้ไข" : "บันทึก" ?>ข้อมูลองค์กร</h2>
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
						<label for="group_name"><span class="required">*</span> ชื่อองค์กร</label>
						<input type="text" size="30" id="group_name" name="group_name" value="<?php echo ($edit and $groupsData) ? $groupsData->group_name : set_value('group_name'); ?>" maxlength="13" />
					</div>
					<div>
						<label for="group_working_capital">เงินทุนหมุนเวียน</label>
						<input type="text" size="30" id="group_working_capital" name="group_working_capital" value="<?php echo ($edit and $groupsData) ? $groupsData->group_working_capital : set_value('group_working_capital'); ?>" />
					</div>
					<br />
				</div>

				<div class="buttonsarea">
					<input type="submit" value="บันทึก" />
					<input type="button" value="กลับ" onclick="window.location='<?php echo $pathLoadPage; ?>/record_show_groups_form'" />
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