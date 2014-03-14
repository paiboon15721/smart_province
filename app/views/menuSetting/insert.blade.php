@extends('contentLayouts.index')

@section('subTitle')
เพิ่มเมนู
@stop
@section('subDescription')
เพิ่มเมนู
@stop
@section('subKeywords')
เพิ่มเมนู
@stop

@section('subScript&css')
{{HTML::style('css/layouts/layouts.form.css')}}
@stop

@section('subContent')
<div id="welcome" class="post">
    <div class="formarea">
        <div class="requiredfld">
            <span class="required">*</span> จำเป็นต้องระบุ
        </div>
        {{Form::open(array('url'=>'menuSetting/'.$parentMenuIdForBack.'/insert', 'files'=>true))}}
        <h2>บันทึกเมนู{{$parentName}}</h2>
        <div class="subfieldsset">
            <div class="notification">
                {{ $errors->first('name', '<div class="error">:message</div>') }}
                {{ $errors->first('sortId', '<div class="error">:message</div>') }}
                @if (Session::has('insertSuccess'))
                <div class="information">บันทึกเมนูเรียบร้อย</div>
                @endif
            </div>
            <div>
                {{HTML::decode(Form::label('name', "<span class='required'>* </span> ชื่อเมนู"))}}
                {{Form::text('name', '', array('size' => '30', 'autofocus' => 'autofocus'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('url', " url"))}}
                {{Form::text('url', '', array('size' => '30'))}}
            </div>
            <div>
                {{Form::label('sortId', 'ลำดับ')}}
                {{Form::selectRange('sortId', '1', $countParent + 1, $countParent + 1)}}
            </div>
            <div>
                {{Form::label('target', 'รูปแบบในการแสดงผล')}}
                {{Form::select('target', array('0' => 'เปิดแท๊บใหม่', '1' => 'แสดงในรูปแบบป๊อบอัพ'))}}
            </div>
        </div>
        <div class="buttonsarea">
            {{Form::submit('บันทึก')}}
            {{Form::button('กลับ', array('onclick' => "location.href=\"../../" . $parentMenuIdForBack."\""))}}
            {{Form::hidden('parent', $parent)}}
        </div>
        {{Form::close()}}
    </div>
</div>
@stop