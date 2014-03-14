@extends('layouts.tablecloth')
@section('data')
<?php $seq = 1; ?>
@foreach($listOfData as $data)
<?php
if (trim($data->problem_desc == '')) {
    $problem_desc = '-';
} else {
    $problem_desc = $data->problem_desc;
}
if (trim($data->cause == '')) {
    $cause = '-';
} else {
    $cause = $data->cause;
}
if (trim($data->howto == '')) {
    $howto = '-';
} else {
    $howto = $data->howto;
}
?>
<tr>
    <td>{{($seq++)}}</td>
    <td>{{$problem_desc}}</td>
    <td>{{$cause}}</td>
    <td>{{$howto}}</td>
</tr>
@endforeach
@stop