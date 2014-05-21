@extends('layouts.map')
@section('title')
แผนที่จังหวัดนครนายก
@stop

@section('description')
แผนที่จังหวัดนครนายก
@stop

@section('keywords')
แผนที่จังหวัดนครนายก
@stop

@section('script&css')
<?php
echo HTML::style('css/layouts/layouts.map.css');
echo HTML::script('js/jquery-1.10.2.min.js');
echo HTML::script('js/map/when.js');
echo HTML::script('js/map/core.js');
echo HTML::script('js/map/graphics.js');
echo HTML::script('js/map/mapimage.js');
echo HTML::script('js/map/mapdata.js');
echo HTML::script('js/map/areadata.js');
echo HTML::script('js/map/areacorners.js');
echo HTML::script('js/map/scale.js');
echo HTML::script('js/map/tooltip.js');
echo HTML::script('js/map/mymap.js');
?>
@stop

@section('area')
@foreach ($catms as $catm)
<area href="#" state="writeSession/{{$catm->catm_id}}" full="หมู่บ้าน{{$catm->catm_name_th}}" shape="{{$catm->shape}}" coords="{{$catm->coords}}" />
@endforeach
@stop
