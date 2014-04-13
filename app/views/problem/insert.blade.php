@extends('contentLayouts.index')

@section('subTitle')
{{$actionType}}{{$menuName}}
@stop
@section('subDescription')
{{$actionType}}{{$menuName}}
@stop
@section('subKeywords')
{{$actionType}}{{$menuName}}
@stop

@section('subScript&css')
{{HTML::style('css/datepicker/datepick.css')}}
{{HTML::style('css/layouts/layouts.form.css')}}
{{HTML::script('js/datepicker/jquery.inputform.js')}}
{{HTML::script('js/datepicker/jquery-message.js')}}
{{HTML::script('js/datepicker/jquery.datepick.js')}}
{{HTML::script('js/datepicker/func.js')}}
@stop

@section('subContent')
<div id="welcome" class="post">
    <div class="formarea">
        <div class="requiredfld">
            <span class="required">*</span> จำเป็นต้องระบุ
        </div>
        {{Form::open(array('url'=>'menuSetting/insert', 'id' => 'profileForm', 'files'=>true))}}
        <h2>{{$actionType}}{{$menuName}}</h2>
        <div class="subfieldsset">
            <div class="notification">
                {{ $errors->first('name', '<div class="error">:message</div>') }}
                {{ $errors->first('sortId', '<div class="error">:message</div>') }}
                @if (Session::has('insertSuccess'))
                <div class="information">{{$actionType}}{{$menuName}}เรียบร้อย</div>
                @endif
            </div>
            <div>
                {{HTML::decode(Form::label('problem_dic_id', "ด้านของปัญหา"))}}
                {{Form::select('problem_dic_id', $problemDic)}}
            </div>
            <div>
                {{HTML::decode(Form::label('problem_desc', "<span class='required'>* </span> สภาพปัญหา"))}}
                {{Form::text('problem_desc', '', array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('cause', "สาเหตุ"))}}
                {{Form::text('cause', '', array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('howto', "ทางแก้"))}}
                {{Form::text('howto', '', array('size' => '30'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('begin_date', "วันที่พบปัญหา"))}}
                {{Form::text('begin_date', '', array('size' => '10', 'class' => 'type_date_key'))}}
            </div>
            <div>
                {{HTML::decode(Form::label('end_date', "วันที่แก้ไขปัญหาเสร็จ"))}}
                {{Form::text('end_date', '', array('size' => '10', 'class' => 'type_date_key'))}}
            </div>
            <div>
                {{HTML::decode(Form::label("สถานะของปัญหา"))}}
                <label for="a" class="labelsmall">
                    <input type="radio" name="status" id="a" value="1" checked />
                    ยังแก้ไขไม่เสร็จ </label>
                <label for="b" class="labelsmall">
                    <input type="radio" name="status" id="b" value="2" />
                    รอองค์กรอื่นๆ มาช่วยแก้ไข </label>
                <label></label>
                <label for="c" class="labelsmall">
                    <input type="radio" name="status" id="c" value="3" />
                    แก้ไขเสร็จแล้ว </label>
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
<script language="javascript">
    input_ClassLoader("#profileForm ");
</script>
@stop