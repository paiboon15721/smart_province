<?php
if ($action == 'insert') {
    $calendarClass = 'type_date_key';
} else {
    $calendarClass = 'type_date_key1';
}
?>
<div class="position">
    <br />
    <div class="subfieldsset">
        <div>
            {{HTML::decode(Form::label('groupsName' . $max, "ประเภทสมาชิก/องค์กร"))}}
            <select id="groupsName<?php echo $max; ?>" name="groupsName<?php echo $max; ?>" onchange="onGroupsChange(<?php echo $max; ?>);">
                <?php
                foreach ($groupsNameList as $key => $value) {
                    echo "<option value='$key'>$value</option>";
                }
                ?>
            </select>
        </div>
        <div>
            {{HTML::decode(Form::label('groupPositionName' . $max, "ชื่อตำแหน่ง"))}}
            {{Form::select('groupPositionName' . $max, $groupPositionNameList)}}
        </div>
        <div>
            {{HTML::decode(Form::label('groupProblem' . $max, "สภาพปัญหา"))}}
            {{Form::text('groupProblem' . $max, '', array('size' => '30'))}}
        </div>
        <div>
            {{HTML::decode(Form::label('groupPositionStartDate' . $max, "วันเริ่มดำรงตำแหน่ง"))}}
            {{Form::text('groupPositionStartDate' . $max, '', array('size' => '10', 'class' => $calendarClass))}}
        </div>
        <div>
            {{HTML::decode(Form::label('groupPositionEndDate' . $max, "วันหมดวาระดำรงตำแหน่ง"))}}
            {{Form::text('groupPositionEndDate' . $max, '', array('size' => '10', 'class' => $calendarClass))}}
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