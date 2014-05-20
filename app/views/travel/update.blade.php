@extends('layouts.form')

@section('subContent')
<div id="welcome" class="post">
    <div class="formarea">
        <div class="requiredfld">
            <span class="required">*</span> จำเป็นต้องระบุ
        </div>
        {{Form::open(array('url'=>'travelTable/update/' . $travel->travel_id, 'id' => 'profileForm', 'files'=>true))}}
        <h2>{{$actionType}}{{$menuName}}</h2>
        <div class="subfieldsset">
            <div class="notification">
                {{ $errors->first('travelTypeId', '<div class="error">:message</div>') }}
                {{ $errors->first('travelName', '<div class="error">:message</div>') }}
                @if (Session::has('updateSuccess'))
                <div class="information">{{$actionType}}{{$menuName}} เรียบร้อย</div>
                @endif
            </div>
            <div><label></label>
                <?php
                if ($travel->pic_no == '') {
                    $imagePath = asset('images/main/no_photo_available.png');
                } else {
                    $imagePath = asset('data') . '/' . $travel->pic_no;
                }
                ?>
                <img src="{{$imagePath}}" height="220" width="180" />
            </div>
            <div>
                {{HTML::decode(Form::label('travelTypeId', "<span class='required'>* </span> ประเภทสถานที่ท่องเที่ยว"))}}
                {{Form::select('travelTypeId', $travelTypeList, $travel->travel_type)}}
            </div>
            <div>
                {{HTML::decode(Form::label('travelName', "<span class='required'>* </span> ชื่อสถานที่ท่องเที่ยว"))}}
                {{Form::text('travelName', $travel->travel_name, array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('travelStar', "จำนวนดาวของสถานที่ท่องเที่ยว"))}}
                {{Form::selectRange('travelStar', $travel->travel_star, 5, 1)}}
            </div>
            <div>
                {{HTML::decode(Form::label('travelDetail', "คำอธิบายสถานที่ท่องเที่ยว"))}}
                {{Form::text('travelDetail', $travel->travel_detail, array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('contractName', "ผู้ดูแล"))}}
                {{Form::text('contractName', $travel->contract_name, array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('contractTel', "เบอร์โทรศัพท์ผู้ดูแล"))}}
                {{Form::text('contractTel', $travel->contract_tel, array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('contractAddr', "ที่อยู่ผู้ดูแล"))}}
                {{Form::text('contractAddr', $travel->contract_addr, array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('latitude', "latitude"))}}
                {{Form::text('latitude', $travel->latitude, array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('longtitude', "longtitude"))}}
                {{Form::text('longtitude', $travel->longtitude, array('size' => '30'))}}
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
</div>
@stop