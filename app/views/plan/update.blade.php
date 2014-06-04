@extends('layouts.formWithDatepicker')

@section('subSubSubSubContent')
<div id="welcome" class="post">
    <div class="formarea">
        <div class="requiredfld">
            <span class="required">*</span> จำเป็นต้องระบุ
        </div>
        {{Form::open(array('url'=>'planTable/update/' . $plan->plan_id, 'id' => 'profileForm', 'files'=>true))}}
        <h2>{{$actionType}}{{$menuName}}</h2>
        <div class="subfieldsset">
            <div class="notification">
                {{ $errors->first('planName', '<div class="error">:message</div>') }}
                {{ $errors->first('planDate', '<div class="error">:message</div>') }}
                {{ $errors->first('planBudget', '<div class="error">:message</div>') }}
                {{ $errors->first('planStartYear', '<div class="error">:message</div>') }}
                {{ $errors->first('planEndYear', '<div class="error">:message</div>') }}
                @if (Session::has('updateSuccess'))
                <div class="information">{{$actionType}}{{$menuName}} เรียบร้อย</div>
                @endif
            </div>
            <div><label></label>
                <?php
                if ($plan->pic_no == '') {
                    $imagePath = asset('images/main/no_photo_available.png');
                } else {
                    $imagePath = asset('data') . '/' . $plan->pic_no;
                }
                ?>
                <img src="{{$imagePath}}" height="220" width="180" />
            </div>
            <div>
                {{HTML::decode(Form::label('planName', "<span class='required'>* </span> ชื่อโครงการ/กิจกรรม"))}}
                {{Form::text('planName', $plan->plan_name, array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('planType', "ประเภท"))}}
                {{Form::selectRange('planType', $plan->type, 5, 1)}}
            </div>
            <div>
                {{HTML::decode(Form::label('planDate', "วันที่"))}}
                {{Form::text('planDate', DateClass::dateFormatBeforeDisplay($plan->plan_date), array('size' => '10', 'class' => 'type_date_key1'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('planSize', "ขนาดโครงการ/กิจกรรม"))}}
                {{Form::text('planSize', $plan->size, array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('planBudget', "งบประมาณ"))}}
                {{Form::text('planBudget', $plan->budget, array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('planHead', "หัวหน้าโครงการ/กิจกรรม"))}}
                {{Form::text('planHead', $plan->head, array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('planBudgetResource', "แหล่งงบประมาณ"))}}
                {{Form::text('planBudgetResource', $plan->budget_resource, array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('planStartYear', "ปีที่เริ่ม"))}}
                {{Form::text('planStartYear', $plan->start_year, array('size' => '5', 'maxlength' => '4'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('planEndYear', "ปีที่สิ้นสุด"))}}
                {{Form::text('planEndYear', $plan->end_year, array('size' => '5', 'maxlength' => '4'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('planStatus', "สถานะโครงการ/กิจกรรม"))}}
                {{Form::selectRange('planStatus', $plan->status, 5, 1)}}
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