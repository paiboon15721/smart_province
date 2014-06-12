@extends('layouts.form')

@section('subSubContent')
<div class="formarea">
    <div class="requiredfld">
        <span class="required">*</span> จำเป็นต้องระบุ
    </div>
    {{Form::open(array('url'=>'menuSetting/' .$parentMenuIdForBack. '/update/'.$menuSetting->menu_id, 'files'=>true))}}
    <h2>แก้ไขเมนู</h2>
    <div class="subfieldsset">
        <div class="notification">
            {{ $errors->first('name', '<div class="error">:message</div>') }}
            {{ $errors->first('sortId', '<div class="error">:message</div>') }}
            @if (Session::has('updateSuccess'))
            <div class="information">แก้ไขเมนูเรียบร้อย</div>
            @endif
        </div>
        <div>
            {{HTML::decode(Form::label('name', "<span class='required'>* </span> ชื่อเมนู"))}}
            {{Form::text('name', $menuSetting->menu_name_th, array('size' => '30'))}}
        </div>
        <div>
            {{HTML::decode(Form::label('url', "url"))}}
            {{Form::text('url', $menuSetting->menu_url, array('size' => '30'))}}
        </div>
        <div>
            {{Form::label('sortId', 'ลำดับ')}}
            {{Form::selectRange('sortId', '1', $countParent, $menuSetting->menu_sort_id)}}
        </div>
        <div>
            {{Form::label('target', 'รูปแบบในการแสดงผล')}}
            {{Form::select('target', array('0' => 'เปิดแท๊บใหม่', '1' => 'แสดงในรูปแบบป๊อบอัพ'), $menuSetting->menu_target)}}
        </div>
    </div>
    <div class="buttonsarea">
        {{Form::submit('บันทึก')}}
        {{Form::button('กลับ', array('onclick' => "location.href=\"../../" . $parentMenuIdForBack."\""))}}
    </div>
    {{Form::close()}}
</div>
@stop