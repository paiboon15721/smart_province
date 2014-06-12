@extends('layouts.tableclothForm')

@section('data')
<?php $seq = 1; ?>
@foreach($listOfData as $data)
<tr>
    <td>{{($seq++)}}</td>
    <td style="text-align:center;"><img src="{{asset('data/'. $data->images)}}" style="height: 350px; width: 1200px;" /></td>
    <td style="text-align:center;">{{HTML::link('bypassLogin', 'แก้ไข', array('class' => 'btn'))}}{{HTML::link('bypassLogin', 'ลบ', array('class' => 'btn'))}}</td>
</tr>
@endforeach
@stop