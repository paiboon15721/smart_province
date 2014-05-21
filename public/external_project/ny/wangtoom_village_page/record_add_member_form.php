<div id="welcome" class="post">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Simple CSS Form - WittySparks Framework</title>

		<?php
		//css include
			echo css_asset('datepick.css');
			echo css_asset('style_add.css');
			echo js_asset('jquery.inputform.js');
			echo js_asset('jquery-message.js');
			echo js_asset('jquery.datepick.js');
			echo js_asset('func.js');
		?>
<script type="text/javascript">
function onGroupsChange(max) {
	$.ajax({
		 type : 'POST',
		 url : "<?php echo $pathLoadPage; ?>" + "/record_member_onGroupsChange/" + $('#groups_drop_down'+max).val(),
		 success : function(data){
			 $('#group_position_drop_down'+max).html(data);
		 }
	});
}

/*var ajaxSubmit = function(formEl) {
	var url = $(formEl).attr('action');
	var data = $(formEl).serialize();
	$.ajax({
		type: "post",
		url: url,
		data: data,
		datatype: 'json',
		success: function(data) {
			data = eval('(' + data + ')');
			if (data.status == 1) {
				if(confirm(data.msg)){
					$('#profileForm')[0].reset();
				} else {
					window.location = "<?php echo $pathLoadPage; ?>" + "/record_show_member_form";
				}
			} else {
				alert(data.msg);
			}
		}
	});
	return false;
}*/

	$(function() {
        var scntDiv = $('#p_scents');
        var i = $('#p_scents .position').size() + 1;
        
        $('#addPosition').live('click', function() {
				var max = $('#num').val();
				var edit = $('#edit').val();
				max = parseInt(max) + 1;
			  $.ajax({
				 type : 'POST',
				 url : "<?php echo $pathLoadPage; ?>" + "/record_member_onAddPositionClick/" + max + '/' + edit,
				 success : function(data){
							 $(data).fadeIn('slow').appendTo(scntDiv);
							 $('#num').val(max);
				 }
			 });
			i++;
			return false;
        });
/*
	$('#groups_drop_down').live('change', function() { 
		  $.ajax({
			 type : 'POST',
			 data : 'groups_id='+ $('#groups_drop_down').val(),
			 url : "<?php echo site_url('wangtoom_village/onGroupsChange'); ?>",
			 success : function(data){
				 $('#group_position_drop_down').html(data);
			 }
		 });
	});
*/
        
        $('#remScnt').live('click', function() { 
                if( i > 1 ) {
                        $(this).parents(".position").remove();
                        i--;
                }
                return false;
        });
	});
</script>

	</head>
	<body>

		<div class="formarea">
			<div class="requiredfld">
				<span class="required">*</span> จำเป็นต้องระบุ
			</div>
			<?php
				$edit = isset($memberData);
				$attributes = array('autocomplete' => 'off', 'id' => 'profileForm');
				echo form_open_multipart($pathForm, $attributes);
			?>
				<h2><?php echo $edit ? "แก้ไข" : "บันทึก" ?>ข้อมูลสมาชิก</h2>
				<div class="subfieldsset">
					<div class="notification">
					<!-- <div class="error">Please fill in all the required fields and try to submit the form</div>
							<div class="information">Fill in the form complately to avoid regular errors.</div>-->
						<?php 
							echo $uploadError;
							echo validation_errors('<div class="error">', '</div>'); 
							echo $this->session->flashdata('message');
						?>
					</div>
						<?php
							if ($edit) {
								echo '<div><label></label>';
								echo ($memberData->member_picture == '') ? image_asset('no_photo_available.png',null,array('width'=>180,'height'=>220)) : image_asset($pathMemberImage.$memberData->member_picture,null,array('width'=>180,'height'=>220));
								echo '</div>';
							}
						?>
					<div>
						<label for="member_pid"><span class="required">*</span> เลขประจำตัวประชาชน</label>
						<input type="text" size="30" id="member_pid" name="member_pid" value="<?php echo $edit ? $memberData->member_pid : set_value('member_pid'); ?>" maxlength="13" <?php echo $edit ? 'disabled' : '' ?>/>
					</div>
					<div>
						<label for="title_id">คำนำหน้าชื่อ</label>
						<select id="title_id" name="title_id">
							<?php foreach($title as $items):?>
							  <option value="<?php echo $items->title_id; ?>" <?php echo $edit ? ($items->title_id == $memberData->title_id) ? 'selected' : '' : set_select('title_id', $items->title_id); ?> ><?php echo $items->title_name; ?></option>
							<?php endforeach;?>
						</select>
					</div>

					<div>
						<label for="member_name"><span class="required">*</span> ชื่อ</label>
						<input type="text" size="30" id="member_name" name="member_name" value="<?php echo $edit ? $memberData->member_name : set_value('member_name'); ?>" />
					</div>
					<div>
						<label for="member_surname"><span class="required">*</span> นามสกุล</label>
						<input type="text" size="30" id="member_surname" name="member_surname" value="<?php echo $edit ? $memberData->member_surname : set_value('member_surname'); ?>" />
					</div>

					<div>
						<label>เพศ</label>
						<label for="m" class="labelsmall">
							<input type="radio" name="sex_id" id="m" value="0" <?php echo $edit ? ($memberData->sex_id == "0") ? 'checked' : '' : set_radio('sex_id', '0', true); ?> />
							ชาย </label>
						<label for="f" class="labelsmall">
							<input type="radio" name="sex_id" id="f" value="1" <?php echo $edit ? ($memberData->sex_id == "1") ? 'checked' : '' : set_radio('sex_id', '1'); ?> />
							หญิง </label>
					</div>

					<div>
						<label for="member_birth_date"><span class="required">*</span> วัน/เดือน/ปี เกิด</label>
						<input type="text" size="10" id="member_birth_date" name="member_birth_date" value="<?php echo $edit ? $memberData->member_birth_date : set_value('member_birth_date'); ?>" class="type_date_key<?php echo $edit ? '1' : ''; ?>" />
					</div>

					<div>
						<label for="member_career">อาชีพ</label>
						<input type="text" size="30" id="member_career" name="member_career" value="<?php echo $edit ? $memberData->member_career : set_value('member_career'); ?>"/>
					</div>

					<div>
						<label for="member_address">ที่อยู่</label>
						<input type="text" size="30" id="member_address" name="member_address" value="<?php echo $edit ? $memberData->member_address : set_value('member_address'); ?>" />
					</div>

					<div>
						<label for="member_phone_number_1">หมายเลขโทรศัพท์ (1)</label>
						<input type="text" size="30" id="member_phone_number_1" name="member_phone_number_1" value="<?php echo $edit ? $memberData->member_phone_number_1 : set_value('member_phone_number_1'); ?>" />
					</div>

					<div>
						<label for="member_phone_number_2">หมายเลขโทรศัพท์ (2)</label>
						<input type="text" size="30" id="member_phone_number_2" name="member_phone_number_2" value="<?php echo $edit ? $memberData->member_phone_number_2 : set_value('member_phone_number_2'); ?>" />
					</div>
					<div>
						<label for="member_image">รูปภาพ</label>
						<input type="file" size="30" name="userfile" />
					</div>

					<div>
						<label></label>
						<input type="button" id="addPosition" name="addPosition" value="เพิ่มตำแหน่ง"/>
					</div>
					<br />
				</div>
				 <!--
				<br />

				<h2>ตำแหน่ง</h2>
				-->
				<div id="p_scents">
				<?php if ($edit): ?>
					<?php
						$countGroupMemberData = count($groupMemberData);
						for($i = 0; $i < $countGroupMemberData; $i++):			
					?>		
					<div class="position">
						<br />
						<div class="subfieldsset">
							<div>
								<label for="groups_drop_down<?php echo $i; ?>">ประเภทสมาชิก/องค์กร</label>
								<select name="groups_drop_down<?php echo $i; ?>" id="groups_drop_down<?php echo $i; ?>" onchange="onGroupsChange(<?php echo $i; ?>);">
									<?php foreach($groups as $items):?>
									  <option value="<?php echo $items->group_id; ?>" <?php echo $edit ? ($items->group_id == $groupMemberData[$i]->group_id) ? 'selected' : '' : ''; ?> ><?php echo $items->group_name; ?></option>
									<?php endforeach;?>
								</select>
							</div>
							<div>
								<label for="group_position_drop_down<?php echo $i; ?>">ชื่อตำแหน่ง</label>
								<select name="group_position_drop_down<?php echo $i; ?>" id="group_position_drop_down<?php echo $i; ?>">
									<?php foreach($group_position[$i] as $items):?>
									  <option value="<?php echo $items->group_position_id; ?>" <?php echo $edit ? ($items->group_position_id == $groupMemberData[$i]->group_position_id) ? 'selected' : '' : ''; ?> ><?php echo $items->group_position_name; ?></option>
									<?php endforeach;?>
								</select>
							</div>
							<div>
								<label></label>
								<label for="a<?php echo $i; ?>" class="labelsmall">
									<input type="radio" name="group_position_by<?php echo $i; ?>" id="a<?php echo $i; ?>" value="0" <?php echo $edit ? ($groupMemberData[$i]->group_position_by == "0") ? 'checked' : '' : 'checked'; ?> />โดยตำแหน่ง
								</label>
								<label for="b<?php echo $i; ?>" class="labelsmall">
									<input type="radio" name="group_position_by<?php echo $i; ?>" id="b<?php echo $i; ?>" value="1" <?php echo $edit ? ($groupMemberData[$i]->group_position_by == "1") ? 'checked' : '' : ''; ?> />ทรงคุณวุฒิ
								</label>
							</div>
							<div>
								<label for="group_position_start_date<?php echo $i; ?>">วันดำรงตำแหน่ง</label>
								<input type="text" size="10" id="group_position_start_date<?php echo $i; ?>" name="group_position_start_date<?php echo $i; ?>" value="<?php echo $groupMemberData[$i]->group_position_start_date; ?>" class="type_date_key1" />
							</div>
							<div>
								<label></label>
									<input type="button" id="remScnt" name="remScnt" value="ลบตำแหน่ง"/>
							</div>
							<br />
						</div>
					</div>
					<?php endfor;?>
				<?php endif; ?>
				</div>

 <!-- end of position -->
				<div class="buttonsarea">
					<input type="submit" value="บันทึก" />
					<input type="button" value="กลับ" onclick="window.location='<?php echo $pathLoadPage; ?>/record_show_member_form'" />
					<input type="hidden" name="num" id="num" value="<?php echo $edit ? $i + 1 : '0'; ?>">
					<input type="hidden" name="edit" id="edit" value="<?php echo $edit; ?>">
				</div>
				<br />
				</form>
		</div> <!-- end of formarea -->
	</body>
</html>
<script language="javascript">
	input_ClassLoader("#profileForm "); 
</script>
</div>