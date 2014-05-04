@extends('layouts.formWithDatepicker')

@section('subSubSubContent')
<div id="welcome" class="post">
    <div class="formarea">
        <div class="requiredfld">
            <span class="required">*</span> จำเป็นต้องระบุ
        </div>
        {{Form::open(array('url'=>'problemTable/update/' . $problem->problem_running_id, 'id' => 'profileForm', 'files'=>true))}}
        <h2>{{$actionType}}{{$menuName}}</h2>
        <div class="subfieldsset">
            <div class="notification">
                {{ $errors->first('problemDesc', '<div class="error">:message</div>') }}
                {{ $errors->first('status', '<div class="error">:message</div>') }}
                @if (Session::has('updateSuccess'))
                <div class="information">{{$actionType}}{{$menuName}}เรียบร้อย</div>
                @endif
            </div>
            <div>
                {{HTML::decode(Form::label('problemId', "ด้านของปัญหา"))}}
                {{Form::select('problemId', $problemDicList, $problem->problem_id)}}
            </div>
            <div>
                {{HTML::decode(Form::label('problemDesc', "<span class='required'>* </span> สภาพปัญหา"))}}
                {{Form::text('problemDesc', $problem->problem_desc, array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('cause', "สาเหตุ"))}}
                {{Form::text('cause', $problem->cause, array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('howTo', "ทางแก้"))}}
                {{Form::text('howTo', $problem->howto, array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('beginDate', "วันที่พบปัญหา"))}}
                {{Form::text('beginDate', DateClass::dateFormatBeforeDisplay($problem->begin_date), array('size' => '10', 'class' => 'type_date_key1'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('endDate', "วันที่แก้ไขปัญหาเสร็จ"))}}
                {{Form::text('endDate', DateClass::dateFormatBeforeDisplay($problem->end_date), array('size' => '10', 'class' => 'type_date_key1'))}}
            </div>
            <div>
                {{HTML::decode(Form::label("<span class='required'>* </span> สถานะของปัญหา"))}}
                <label for="a" class="labelsmall">
                    <input type="radio" name="status" id="a" value="1"
                    <?php
                    if ($problem->status == "1") {
                        echo 'checked="checked"';
                    }
                    ?>
                           />
                    ยังแก้ไขไม่เสร็จ </label>
                <label for="b" class="labelsmall">
                    <input type="radio" name="status" id="b" value="2"
                    <?php
                    if ($problem->status == "2") {
                        echo 'checked="checked"';
                    }
                    ?>
                           />
                    รอองค์กรอื่นๆ มาช่วยแก้ไข </label>
                <label></label>
                <label for="c" class="labelsmall">
                    <input type="radio" name="status" id="c" value="3"
                    <?php
                    if ($problem->status == "3") {
                        echo 'checked="checked"';
                    }
                    ?>
                           />
                    แก้ไขเสร็จแล้ว </label>
            </div>
            <br />
        </div>
        <div class="buttonsarea">
            {{Form::submit('บันทึก')}}
            {{Form::button('กลับ', array('onclick' => "location.href=\"$backUrl\""))}}
        </div>
        {{Form::close()}}
    </div>
</div>
@stop