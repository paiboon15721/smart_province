@extends('contentLayouts.content')

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
{{HTML::style('css/layouts/layouts.form.css')}}
@yield('subSubScript&css')
@stop

@section('subContent')
@yield('subSubContent')
@stop

