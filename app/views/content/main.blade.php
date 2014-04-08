@extends('contentLayouts.index')
@section('subTitle')
หน้าหลัก
@stop
@section('description')
หน้าหลัก
@stop
@section('keywords')
หน้าหลัก
@stop

@section('subContent')
<div id="welcome" class="post" style="border-bottom: 0px">
    <div class="head-image">
        <h1 class="title" style="border-bottom: 1px solid #3B3B3B; padding-bottom: 10px">หน้าหลักหมู่บ้าน{{Session::get('catmNameTh')}}</h1>
    </div>
</div>
@stop