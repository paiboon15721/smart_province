@extends('layouts.formWithDatepicker')

@section('subSubSubSubContent')
<script type='text/javascript'>

    function onGroupsChange(max) {
        $.ajax({
            type: 'GET',
            url: "../../groupPositionNameList/" + $('#groupsName' + max).val(),
            success: function(data) {
                $('#groupPositionName' + max).html(data);
            }
        });
    }

    $(function() {
        var scntDiv = $('#p_scents');
        var i = $('#p_scents .position').size() + 1;

        $('#addPosition').on('click', function() {
            var max = $('#positionAmount').val();
            max = parseInt(max) + 1;
            $.ajax({
                type: 'GET',
                url: "../../positionForm/" + max + "/update",
                success: function(data) {
                    $(data).fadeIn('slow').appendTo(scntDiv);
                    $('#positionAmount').val(max);
                }
            });
            i++;
            return false;
        });

        $('body').on('click', '#remScnt', function() {
            if (i > 1) {
                $(this).parents(".position").remove();
                i--;
            }
            return false;
        });

    });
</script>
<div id="welcome" class="post">
    <div class="formarea">
        <div class="requiredfld">
            <span class="required">*</span> จำเป็นต้องระบุ
        </div>
        {{Form::open(array('url'=>'groupMemberTable/update/' . $groupMember->member_pid, 'id' => 'profileForm', 'files'=>true))}}
        <h2>{{$actionType}}{{$menuName}}</h2>
        <div class="subfieldsset">
            <div class="notification">
                {{ $errors->first('memberName', '<div class="error">:message</div>') }}
                {{ $errors->first('memberSurname', '<div class="error">:message</div>') }}
                {{ $errors->first('gender', '<div class="error">:message</div>') }}
                @if ($message = Session::get('error'))
                <div class="error">{{$message}}</div>
                @endif
                @if (Session::has('updateSuccess'))
                <div class="information">{{$actionType}}{{$menuName}}เรียบร้อย</div>
                @endif
            </div>
            <div><label></label>
                <?php
                if ($groupMember->images == '') {
                    $imagePath = asset('images/main/no_photo_available.png');
                } else {
                    $imagePath = asset('data') . '/' . $groupMember->images;
                }
                ?>
                <img src="{{$imagePath}}" height="220" width="180" />
            </div>
            <div>
                {{HTML::decode(Form::label('memberPid', "<span class='required'>* </span> เลขประจำตัวประชาชน"))}}
                {{Form::text('memberPid', $groupMember->member_pid, array('size' => '30', 'readonly' => 'readonly'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('titleId', "คำนำหน้าชื่อ"))}}
                {{Form::select('titleId', $titlePrintList, $groupMember->title_code)}}
            </div>
            <div>
                {{HTML::decode(Form::label('memberName', "<span class='required'>* </span> ชื่อ"))}}
                {{Form::text('memberName', $groupMember->fname, array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('memberMidname', "ชื่อกลาง"))}}
                {{Form::text('memberMidname', $groupMember->mname, array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('memberSurname', "<span class='required'>* </span> นามสกุล"))}}
                {{Form::text('memberSurname', $groupMember->lname, array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label("<span class='required'>* </span> เพศ"))}}
                <label for="m" class="labelsmall">
                    <input type="radio" name="gender" id="m" value="1"
                    <?php
                    if ($groupMember->sex == "1") {
                        echo 'checked="checked"';
                    }
                    ?>
                           />
                    ชาย </label>
                <label for="f" class="labelsmall">
                    <input type="radio" name="gender" id="f" value="2"
                    <?php
                    if ($groupMember->sex == "2") {
                        echo 'checked="checked"';
                    }
                    ?>
                           />
                    หญิง </label>
            </div>
            <div>
                {{HTML::decode(Form::label('memberCareer', "อาชีพ"))}}
                {{Form::select('memberCareer', $memberCareerList, $groupMember->member_career)}}
            </div>
            <div>
                {{HTML::decode(Form::label('memberAddress', "ที่อยู่"))}}
                {{Form::text('memberAddress', $groupMember->member_address, array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('memberPhoneNumber1', "หมายเลขโทรศัพท์ (1)"))}}
                {{Form::text('memberPhoneNumber1', $groupMember->member_phone1, array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('memberPhoneNumber2', "หมายเลขโทรศัพท์ (2)"))}}
                {{Form::text('memberPhoneNumber2', $groupMember->member_phone2, array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('memberImage', "รูปภาพ"))}}
                {{Form::file('memberImage')}}
            </div>
            <div>
                <label></label>
                {{Form::button('เพิ่มตำแหน่ง', array('id' => 'addPosition'))}}
            </div>
            <br />
        </div>
        <div id='p_scents'>
            <?php
            $countGroupMemberPosition = count($groupMemberPosition);
            for ($max = 0; $max < $countGroupMemberPosition; $max++):
                ?>
                <div class="position">
                    <br />
                    <div class="subfieldsset">
                        <div>
                            {{HTML::decode(Form::label('groupsName' . $max, "ประเภทสมาชิก/องค์กร"))}}
                            <select id="groupsName<?php echo $max; ?>" name="groupsName<?php echo $max; ?>" onchange="onGroupsChange(<?php echo $max; ?>);">
                                <?php
                                foreach ($groupsNameList as $key => $value) {
                                    $selected = '';
                                    if ($key == $groupMemberPosition[$max]->group_id) {
                                        $selected = 'selected';
                                    }
                                    echo "<option value='$key' $selected >$value</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            {{HTML::decode(Form::label('groupPositionName' . $max, "ชื่อตำแหน่ง"))}}
                            {{Form::select('groupPositionName' . $max, $groupPositionNameList[$max], $groupMemberPosition[$max]->position_id)}}
                        </div>
                        <div>
                            {{HTML::decode(Form::label('groupProblem' . $max, "สภาพปัญหา"))}}
                            {{Form::text('groupProblem' . $max, $groupMemberPosition[$max]->problem, array('size' => '30'))}}
                        </div>
                        <div>
                            {{HTML::decode(Form::label('groupPositionStartDate' . $max, "วันเริ่มดำรงตำแหน่ง"))}}
                            {{Form::text('groupPositionStartDate' . $max, DateClass::dateFormatBeforeDisplay($groupMemberPosition[$max]->start_date), array('size' => '10', 'class' => 'type_date_key1'))}}
                        </div>
                        <div>
                            {{HTML::decode(Form::label('groupPositionEndDate' . $max, "วันหมดวาระดำรงตำแหน่ง"))}}
                            {{Form::text('groupPositionEndDate' . $max, DateClass::dateFormatBeforeDisplay($groupMemberPosition[$max]->end_date), array('size' => '10', 'class' => 'type_date_key1'))}}
                        </div>
                        <div>
                            <label></label>
                            <input type="button" id="remScnt" name="remScnt" value="ลบตำแหน่ง"/>
                        </div>
                        <br />
                    </div>
                </div>
            <?php endfor; ?>
        </div>
        <div class="buttonsarea">
            {{Form::submit('บันทึก')}}
            {{Form::button('กลับ', array('onclick' => "location.href=\"$backUrl\""))}}
            {{Form::hidden('positionAmount', $max, array('id' => 'positionAmount'))}}
        </div>
        {{Form::close()}}
    </div>
</div>
<script language="javascript">
    input_ClassLoader("#profileForm ");
</script>
@stop