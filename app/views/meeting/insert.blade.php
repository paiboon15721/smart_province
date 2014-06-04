@extends('layouts.formWithDatepicker')

@section('subSubSubSubContent')
<div id="welcome" class="post">
    <div class="formarea">
        <div class="requiredfld">
            <span class="required">*</span> จำเป็นต้องระบุ
        </div>
        {{Form::open(array('url'=>'meetingTable/insert', 'id' => 'profileForm', 'files'=>true))}}
        <h2>{{$actionType}}{{$menuName}}</h2>
        <div class="subfieldsset">
            <div class="notification">
                {{ $errors->first('meetingName', '<div class="error">:message</div>') }}
                @if (Session::has('insertSuccess'))
                <div class="information">{{$actionType}}{{$menuName}}เรียบร้อย</div>
                @endif
            </div>
            <div>
                {{HTML::decode(Form::label('meetingName', "<span class='required'>* </span> หัวข้อการประชุม"))}}
                {{Form::text('meetingName', '', array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('meetingDate', "วันที่ประชุม"))}}
                {{Form::text('meetingDate', '', array('size' => '10', 'class' => 'type_date_key'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('meetingImage', "รูปภาพ"))}}
                {{Form::file('meetingImage')}}
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