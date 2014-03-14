@extends('layouts.tablecloth')
@section('data')
<?php $seq = 1; ?>
@foreach($listOfData as $data)
<tr>
    <td>{{($seq++)}}</td>
    <td>{{$data->travelType->travel_type_name}}</td>
    <td>{{$data->travel_name}}</td>
    <td>{{$data->travel_detail}}</td>
    <td>{{$data->travel_star}}</td>
    <td>{{$data->contract_name}}</td>
    <td>{{$data->contract_addr}}</td>
    <td>{{$data->contract_tel}}</td>
    <td>{{$data->latitude}}</td>
    <td>{{$data->longtitude}}</td>
    <td>{{$data->pic_no}}</td>
</tr>
@endforeach
@stop
