@extends('layouts.tableclothForm')

@section('data')
<?php $seq = 1; ?>
@foreach($listOfData as $data)
<tr>
    <td>{{($seq++)}}</td>
    <td style="text-align:center;"><img src="{{asset('data/'. $data->images)}}" style="height: 120px; width: 120px;" /></td>
</tr>
@endforeach
@stop