@extends('layouts.form')

@section('subSubContent')
<div class="formarea">
    <div class="requiredfld">
        <span class="required">*</span> จำเป็นต้องระบุ
    </div>
    {{Form::open(array('url'=>'otopTable/update/' . $otop->otop_id, 'id' => 'profileForm', 'files'=>true))}}
    <h2>{{$actionType}}{{$menuName}}</h2>
    <div class="subfieldsset">
        <div class="notification">
            {{ $errors->first('otopTypeId', '<div class="error">:message</div>') }}
            {{ $errors->first('otopName', '<div class="error">:message</div>') }}
            {{ $errors->first('contractName', '<div class="error">:message</div>') }}
            {{ $errors->first('contractTel', '<div class="error">:message</div>') }}
            {{ $errors->first('otopImage', '<div class="error">:message</div>') }}
            @if (Session::has('updateSuccess'))
            <div class="information">{{$actionType}}{{$menuName}} เรียบร้อย</div>
            @endif
        </div>
        <div><label></label>
            <?php
            if ($otop->images == '') {
                $imagePath = asset('images/main/no_photo_available.png');
            } else {
                $imagePath = asset('data') . '/' . $otop->images;
            }
            ?>
            <img src="{{$imagePath}}" height="220" width="180" />
        </div>
        <div>
            {{HTML::decode(Form::label('otopTypeId', "<span class='required'>* </span> ประเภทสินค้า"))}}
            {{Form::select('otopTypeId', $otopTypeList, $otop->otop_type)}}
        </div>
        <div>
            {{HTML::decode(Form::label('otopName', "<span class='required'>* </span> ชื่อสินค้า"))}}
            {{Form::text('otopName', $otop->otop_name, array('size' => '30'))}}
        </div>
        <div>
            {{HTML::decode(Form::label('otopGroup', "กลุ่มผู้ผลิต/บริษัทผู้ผลิต"))}}
            {{Form::text('otopGroup', $otop->otop_group, array('size' => '30'))}}
        </div>
        <div>
            {{HTML::decode(Form::label('otopStar', "จำนวนดาวของสินค้า"))}}
            {{Form::selectRange('otopStar', $otop->otop_star, 5, 1)}}
        </div>
        <div>
            {{HTML::decode(Form::label('otopDetail', "คำอธิบายสินค้า"))}}
            {{Form::text('otopDetail', $otop->otop_detail, array('size' => '30'))}}
        </div>
        <div>
            {{HTML::decode(Form::label('contractName', "<span class='required'>* </span> ผู้ขายสินค้า/ตัวแทนผู้ผลิต"))}}
            {{Form::text('contractName', $otop->contract_name, array('size' => '30'))}}
        </div>
        <div>
            {{HTML::decode(Form::label('contractTel', "<span class='required'>* </span> เบอร์โทรศัพท์ผู้ขายสินค้า"))}}
            {{Form::text('contractTel', $otop->contract_tel, array('size' => '30'))}}
        </div>
        <div>
            {{HTML::decode(Form::label('contractAddr', "ที่อยู่ผู้ขายสินค้า"))}}
            {{Form::text('contractAddr', $otop->contract_addr, array('size' => '30'))}}
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
@stop