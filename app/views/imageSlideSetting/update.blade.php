@extends('layouts.form')

@section('subSubContent')
<div class="formarea">
    <div class="requiredfld">
        <span class="required">*</span> จำเป็นต้องระบุ
    </div>
    {{Form::open(array('url'=>'imageSlideSettingTable/update/' . $imageSlideSetting->image_id, 'id' => 'profileForm', 'files'=>true))}}
    <h2>{{$actionType}}{{$menuName}}</h2>
    <div class="subfieldsset">
        <div class="notification">
            {{ $errors->first('imageSlideImage', '<div class="error">:message</div>') }}
            @if (Session::has('updateSuccess'))
            <div class="information">{{$actionType}}{{$menuName}} เรียบร้อย</div>
            @endif
        </div>
        <div><label></label>
            <?php
            if ($imageSlideSetting->image == '') {
                $imagePath = asset('images/main/no_photo_available.png');
            } else {
                $imagePath = asset('data') . '/' . $imageSlideSetting->image;
            }
            ?>
            <img src="{{$imagePath}}" height="350" width="1200" />
        </div>
        <div>
            {{HTML::decode(Form::label('imageSlideImage', "รูปภาพ"))}}
            {{Form::file('imageSlideImage')}}
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