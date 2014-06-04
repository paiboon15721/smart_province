@extends('layouts.formWithDatepicker')

@section('subSubSubSubContent')
<div id="welcome" class="post">
    <div class="formarea">
        <div class="requiredfld">
            <span class="required">*</span> จำเป็นต้องระบุ
        </div>
        {{Form::open(array('url'=>'planTable/insert', 'id' => 'profileForm', 'files'=>true))}}
        <h2>{{$actionType}}{{$menuName}}</h2>
        <div class="subfieldsset">
            <div class="notification">
                {{ $errors->first('planName', '<div class="error">:message</div>') }}
                {{ $errors->first('planDate', '<div class="error">:message</div>') }}
                {{ $errors->first('planBudget', '<div class="error">:message</div>') }}
                {{ $errors->first('planStartYear', '<div class="error">:message</div>') }}
                {{ $errors->first('planEndYear', '<div class="error">:message</div>') }}
                @if (Session::has('insertSuccess'))
                <div class="information">{{$actionType}}{{$menuName}}เรียบร้อย</div>
                @endif
            </div>
            <div>
                {{HTML::decode(Form::label('planName', "<span class='required'>* </span> ชื่อโครงการ/กิจกรรม"))}}
                {{Form::text('planName', '', array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('planType', "ประเภท"))}}
                {{Form::selectRange('planType', '1', 5, 1)}}
            </div>
            <div>
                {{HTML::decode(Form::label('planDate', "วันที่"))}}
                {{Form::text('planDate', '', array('size' => '10', 'class' => 'type_date_key'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('planSize', "ขนาดโครงการ/กิจกรรม"))}}
                {{Form::text('planSize', '', array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('planBudget', "งบประมาณ"))}}
                {{Form::text('planBudget', '', array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('planHead', "หัวหน้าโครงการ/กิจกรรม"))}}
                {{Form::text('planHead', '', array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('planBudgetResource', "แหล่งงบประมาณ"))}}
                {{Form::text('planBudgetResource', '', array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('planStartYear', "ปีที่เริ่ม"))}}
                {{Form::text('planStartYear', '', array('size' => '5', 'maxlength' => '4'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('planEndYear', "ปีที่สิ้นสุด"))}}
                {{Form::text('planEndYear', '', array('size' => '5', 'maxlength' => '4'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('planStatus', "สถานะโครงการ/กิจกรรม"))}}
                {{Form::selectRange('planStatus', '1', 5, 1)}}
            </div>
            <div>
                {{HTML::decode(Form::label('planImage', "รูปภาพ"))}}
                {{Form::file('planImage')}}
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