@extends('layouts.tablecloth')
@section('data')
<?php $seq = 1; ?>
@foreach($listOfData as $data)
<tr>
    <td>{{($seq++)}}</td>
    <td>{{$data->otopType->otop_type_name}}</td>
    <td>{{$data->otop_name}}</td>
    <td>{{$data->otop_group}}</td>
    <td>{{$data->contract_name}}</td>
    <td>{{$data->contract_addr}}</td>
    <td>{{$data->contract_tel}}</td>
    <td>{{$data->otop_star}}</td>
    <td>{{$data->images}}<img src="{{asset('data/'. $data->images)}}" style="height: 350px; width: 1200px;" /></td>
</tr>
@endforeach
@stop
