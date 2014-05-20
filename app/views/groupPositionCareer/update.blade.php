@extends('layouts.form')

@section('subContent')
<div id="welcome" class="post">
    <div class="formarea">
        <div class="requiredfld">
            <span class="required">*</span> จำเป็นต้องระบุ
        </div>
        {{Form::open(array('url'=>'groupPositionCareerTable/update/' . $groupPositionCareer->position_id, 'id' => 'profileForm', 'files'=>true))}}
        <h2>{{$actionType}}{{$menuName}}</h2>
        <div class="subfieldsset">
            <div class="notification">
                {{ $errors->first('positionName', '<div class="error">:message</div>') }}
                {{ $errors->first('positionMember', '<div class="error">:message</div>') }}
                {{ $errors->first('positionBudget', '<div class="error">:message</div>') }}
                @if (Session::has('updateSuccess'))
                <div class="information">{{$actionType}}{{$menuName}}เรียบร้อย</div>
                @endif
            </div>
            <div>
                {{HTML::decode(Form::label('positionName', "<span class='required'>* </span> ชื่อกลุ่ม"))}}
                {{Form::text('positionName', $groupPositionCareer->position_name, array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('positionMember', "จำนวนสมาชิก"))}}
                {{Form::text('positionMember', $groupPositionCareer->position_member, array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('positionBudget', "เงินทุนหมุนเวียนในกลุ่ม"))}}
                {{Form::text('positionBudget', $groupPositionCareer->position_budget, array('size' => '30'))}}
            </div>
        </div>
        <div class="buttonsarea">
            {{Form::submit('บันทึก')}}
            {{Form::button('กลับ', array('onclick' => "location.href=\"$backUrl\""))}}
        </div>
        {{Form::close()}}
    </div>
</div>
@stop