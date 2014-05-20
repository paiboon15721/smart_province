@extends('layouts.form')

@section('subContent')
<div id="welcome" class="post">
    <div class="formarea">
        <div class="requiredfld">
            <span class="required">*</span> จำเป็นต้องระบุ
        </div>
        {{Form::open(array('url'=>'otopTable/insert', 'id' => 'profileForm', 'files'=>true))}}
        <h2>{{$actionType}}{{$menuName}}</h2>
        <div class="subfieldsset">
            <div class="notification">
                {{ $errors->first('otopTypeId', '<div class="error">:message</div>') }}
                {{ $errors->first('otopName', '<div class="error">:message</div>') }}
                {{ $errors->first('contractName', '<div class="error">:message</div>') }}
                {{ $errors->first('contractTel', '<div class="error">:message</div>') }}
                @if (Session::has('insertSuccess'))
                <div class="information">{{$actionType}}{{$menuName}}เรียบร้อย</div>
                @endif
            </div>
            <div>
                {{HTML::decode(Form::label('otopTypeId', "<span class='required'>* </span> ประเภทสินค้า"))}}
                {{Form::select('otopTypeId', $otopTypeList)}}
            </div>
            <div>
                {{HTML::decode(Form::label('otopName', "<span class='required'>* </span> ชื่อสินค้า"))}}
                {{Form::text('otopName', '', array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('otopGroup', "กลุ่มผู้ผลิต/บริษัทผู้ผลิต"))}}
                {{Form::text('otopGroup', '', array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('otopStar', "จำนวนดาวของสินค้า"))}}
                {{Form::selectRange('otopStar', '1', 5, 1)}}
            </div>
            <div>
                {{HTML::decode(Form::label('otopDetail', "คำอธิบายสินค้า"))}}
                {{Form::text('otopDetail', '', array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('contractName', "<span class='required'>* </span> ผู้ขายสินค้า/ตัวแทนผู้ผลิต"))}}
                {{Form::text('contractName', '', array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('contractTel', "<span class='required'>* </span> เบอร์โทรศัพท์ผู้ขายสินค้า"))}}
                {{Form::text('contractTel', '', array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('contractAddr', "ที่อยู่ผู้ขายสินค้า"))}}
                {{Form::text('contractAddr', '', array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('otopImage', "รูปภาพ"))}}
                {{Form::file('otopImage')}}
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