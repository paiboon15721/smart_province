@extends('contentLayouts.index')

@section('subTitle')
ตั้งค่าเมนู
@stop
@section('subDescription')
ตั้งค่าเมนู
@stop
@section('subKeywords')
ตั้งค่าเมนู
@stop

@section('subScript&css')
{{HTML::style('css/layouts/layouts.form.css')}}
@stop

@section('subContent')
<div id="welcome" class="post">
    <div class="formarea">
        <h2>การตั้งค่าเมนู</h2>
        <div class="subfieldsset">
            <div class="notification">
                @if (Session::has('deleteSuccess'))
                <div class="information">ลบเมนูเรียบร้อย</div>
                @endif
                @if (Session::has('deleteFailed'))
                <div class="error">ไม่สามารถลบเมนูนี้ได้ เนื่องจากยังมีเมนูอื่นๆ ภายใต้เมนูนี้</div>
                @endif
            </div>
            {{$renderMenuSetting}}
        </div>
    </div>
</div>
@stop