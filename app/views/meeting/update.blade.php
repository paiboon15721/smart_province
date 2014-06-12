@extends('layouts.formWithDatepicker')

@section('subSubSubSubContent')
<div class="formarea">
    <div class="requiredfld">
        <span class="required">*</span> จำเป็นต้องระบุ
    </div>
    {{Form::open(array('url'=>'meetingTable/update/' . $meeting->meeting_id, 'id' => 'profileForm', 'files'=>true))}}
    <h2>{{$actionType}}{{$menuName}}</h2>
    <div class="subfieldsset">
        <div class="notification">
            {{ $errors->first('meetingName', '<div class="error">:message</div>') }}
            {{ $errors->first('meetingImage', '<div class="error">:message</div>') }}
            @if (Session::has('updateSuccess'))
            <div class="information">{{$actionType}}{{$menuName}} เรียบร้อย</div>
            @endif
        </div>
        <div><label></label>
            <?php
            if ($meeting->pic_no == '') {
                $imagePath = asset('images/main/no_photo_available.png');
            } else {
                $imagePath = asset('data') . '/' . $meeting->pic_no;
            }
            ?>
            <img src="{{$imagePath}}" height="220" width="180" />
        </div>
        <div>
            {{HTML::decode(Form::label('meetingName', "<span class='required'>* </span> หัวข้อการประชุม"))}}
            {{Form::text('meetingName', $meeting->meeting_name, array('size' => '30'))}}
        </div>
        <div>
            {{HTML::decode(Form::label('meetingDate', "วันที่ประชุม"))}}
            {{Form::text('meetingDate', DateClass::dateFormatBeforeDisplay($meeting->meeting_date), array('size' => '10', 'class' => 'type_date_key1'))}}
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
@stop