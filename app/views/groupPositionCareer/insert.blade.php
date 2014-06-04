@extends('layouts.form')

@section('subSubContent')
<div id="welcome" class="post">
    <div class="formarea">
        <div class="requiredfld">
            <span class="required">*</span> จำเป็นต้องระบุ
        </div>
        {{Form::open(array('url'=>'groupPositionCareerTable/insert', 'id' => 'profileForm', 'files'=>true))}}
        <h2>{{$actionType}}{{$menuName}}</h2>
        <div class="subfieldsset">
            <div class="notification">
                {{ $errors->first('positionName', '<div class="error">:message</div>') }}
                {{ $errors->first('positionMember', '<div class="error">:message</div>') }}
                {{ $errors->first('positionBudget', '<div class="error">:message</div>') }}
                @if (Session::has('insertSuccess'))
                <div class="information">{{$actionType}}{{$menuName}}เรียบร้อย</div>
                @endif
            </div>
            <div>
                {{HTML::decode(Form::label('positionName', "<span class='required'>* </span> ชื่อกลุ่ม"))}}
                {{Form::text('positionName', '', array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('positionMember', "จำนวนสมาชิก"))}}
                {{Form::text('positionMember', '', array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('positionBudget', "เงินทุนหมุนเวียนในกลุ่ม"))}}
                {{Form::text('positionBudget', '', array('size' => '30'))}}
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