@extends('layouts.formWithDatepicker')

@section('subSubSubSubContent')
<script type='text/javascript'>

    function onGroupsChange(max) {
        $.ajax({
            type: 'GET',
            url: "../groupPositionNameList/" + $('#groupsName' + max).val(),
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
                url: "../positionForm/" + max + "/insert",
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
                //$(this).parents(".position").fadeOut(function() {
                $(this).parents(".position").remove();
                //});
                i--;
            }
            return false;
        });

    });
</script>
<div class="formarea">
    <div class="requiredfld">
        <span class="required">*</span> จำเป็นต้องระบุ
    </div>
    {{Form::open(array('url'=>'groupMemberTable/insert', 'id' => 'profileForm', 'files'=>true))}}
    <h2>{{$actionType}}{{$menuName}}</h2>
    <div class="subfieldsset">
        <div class="notification">
            {{ $errors->first('memberPid', '<div class="error">:message</div>') }}
            {{ $errors->first('memberName', '<div class="error">:message</div>') }}
            {{ $errors->first('memberSurname', '<div class="error">:message</div>') }}
            {{ $errors->first('gender', '<div class="error">:message</div>') }}
            {{ $errors->first('memberImage', '<div class="error">:message</div>') }}
            @if ($message = Session::get('error'))
            <div class="error">{{$message}}</div>
            @endif
            @if (Session::has('insertSuccess'))
            <div class="information">{{$actionType}}{{$menuName}}เรียบร้อย</div>
            @endif
        </div>
        <div>
            {{HTML::decode(Form::label('memberPid', "<span class='required'>* </span> เลขประจำตัวประชาชน"))}}
            {{Form::text('memberPid', '', array('size' => '30', 'maxlength' => '13'))}}
            {{Form::button('ค้นหา', array('onclick' => 'getPopMember();'))}}
        </div>
        <div>
            {{HTML::decode(Form::label('titleId', "คำนำหน้าชื่อ"))}}
            {{Form::select('titleId', $titlePrintList)}}
        </div>
        <div>
            {{HTML::decode(Form::label('memberName', "<span class='required'>* </span> ชื่อ"))}}
            {{Form::text('memberName', '', array('size' => '30'))}}
        </div>
        <div>
            {{HTML::decode(Form::label('memberMidname', "ชื่อกลาง"))}}
            {{Form::text('memberMidname', '', array('size' => '30'))}}
        </div>
        <div>
            {{HTML::decode(Form::label('memberSurname', "<span class='required'>* </span> นามสกุล"))}}
            {{Form::text('memberSurname', '', array('size' => '30'))}}
        </div>
        <div>
            {{HTML::decode(Form::label("<span class='required'>* </span> เพศ"))}}
            <label for="m" class="labelsmall">
                <input type="radio" name="gender" id="m" value="1"
                <?php
                if (Input::old('gender') == "1") {
                    echo 'checked="checked"';
                }
                ?>
                       />
                ชาย </label>
            <label for="f" class="labelsmall">
                <input type="radio" name="gender" id="f" value="2"
                <?php
                if (Input::old('gender') == "2") {
                    echo 'checked="checked"';
                }
                ?>
                       />
                หญิง </label>
        </div>
        <div>
            {{HTML::decode(Form::label('memberCareer', "อาชีพ"))}}
            {{Form::select('memberCareer', $memberCareerList)}}
        </div>
        <div>
            {{HTML::decode(Form::label('memberAddress', "ที่อยู่"))}}
            {{Form::text('memberAddress', '', array('size' => '30'))}}
        </div>
        <div>
            {{HTML::decode(Form::label('memberPhoneNumber1', "หมายเลขโทรศัพท์ (1)"))}}
            {{Form::text('memberPhoneNumber1', '', array('size' => '30'))}}
        </div>
        <div>
            {{HTML::decode(Form::label('memberPhoneNumber2', "หมายเลขโทรศัพท์ (2)"))}}
            {{Form::text('memberPhoneNumber2', '', array('size' => '30'))}}
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
    </div>
    <div class="buttonsarea">
        {{Form::submit('บันทึก')}}
        {{Form::button('กลับ', array('onclick' => "location.href=\"$backUrl\""))}}
        {{Form::hidden('positionAmount', '0', array('id' => 'positionAmount'))}}
    </div>
    {{Form::close()}}
</div>
@stop