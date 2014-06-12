@extends('layouts.form')

@section('subSubContent')
<div class="formarea">
    <div class="requiredfld">
        <span class="required">*</span> จำเป็นต้องระบุ
    </div>
    {{Form::open(array('url'=>'travelTable/insert', 'id' => 'profileForm', 'files'=>true))}}
    <h2>{{$actionType}}{{$menuName}}</h2>
    <div class="subfieldsset">
        <div class="notification">
            {{ $errors->first('travelTypeId', '<div class="error">:message</div>') }}
            {{ $errors->first('travelName', '<div class="error">:message</div>') }}
            @if (Session::has('insertSuccess'))
            <div class="information">{{$actionType}}{{$menuName}}เรียบร้อย</div>
            @endif
        </div>
        <div>
            {{HTML::decode(Form::label('travelTypeId', "<span class='required'>* </span> ประเภทสถานที่ท่องเที่ยว"))}}
            {{Form::select('travelTypeId', $travelTypeList)}}
        </div>
        <div>
            {{HTML::decode(Form::label('travelName', "<span class='required'>* </span> ชื่อสถานที่ท่องเที่ยว"))}}
            {{Form::text('travelName', '', array('size' => '30'))}}
        </div>
        <div>
            {{HTML::decode(Form::label('travelStar', "จำนวนดาวของสถานที่ท่องเที่ยว"))}}
            {{Form::selectRange('travelStar', '1', 5, 1)}}
        </div>
        <div>
            {{HTML::decode(Form::label('travelDetail', "คำอธิบายสถานที่ท่องเที่ยว"))}}
            {{Form::text('travelDetail', '', array('size' => '30'))}}
        </div>
        <div>
            {{HTML::decode(Form::label('contractName', "ผู้ดูแล"))}}
            {{Form::text('contractName', '', array('size' => '30'))}}
        </div>
        <div>
            {{HTML::decode(Form::label('contractTel', "เบอร์โทรศัพท์ผู้ดูแล"))}}
            {{Form::text('contractTel', '', array('size' => '30'))}}
        </div>
        <div>
            {{HTML::decode(Form::label('contractAddr', "ที่อยู่ผู้ดูแล"))}}
            {{Form::text('contractAddr', '', array('size' => '30'))}}
        </div>
        <div>
            {{HTML::decode(Form::label('latitude', "latitude"))}}
            {{Form::text('latitude', '', array('size' => '30'))}}
        </div>
        <div>
            {{HTML::decode(Form::label('longtitude', "longtitude"))}}
            {{Form::text('longtitude', '', array('size' => '30'))}}
        </div>
        <div>
            {{HTML::decode(Form::label('travelImage', "รูปภาพ"))}}
            {{Form::file('travelImage')}}
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