@extends('contentLayouts.content')

@section('subTitle')
{{$menuName}}
@stop
@section('subDescription')
{{$menuName}}
@stop
@section('subKeywords')
{{$menuName}}
@stop

@section('subScript&css')
{{HTML::style('css/tablecloth/tablecloth.css')}}
{{HTML::script('js/tablecloth.js')}}
@stop

@section('subSubContent')
<h1 class="title" style="color: #4F789F; border-bottom: 1px solid #3B3B3B; padding-bottom: 10px">{{$title}}</h1>
{{HTML::link('bypassLogin', 'BYPASS', array('class' => 'btn'))}}
<table cellspacing="0" cellpadding="0"  id="datatable">
    <thead>
        <tr>
            @foreach($headers as $header)
            <th class="{{$header['class']}}" width="{{$header['width']}}">{{$header['text']}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @yield('data')
    </tbody>
</table>
@stop
