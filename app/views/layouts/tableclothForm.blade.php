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
@yield('subSubSubContent')
@stop
