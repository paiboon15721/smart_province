@extends('layouts.tablecloth')
@section('data')
<?php $seq = 1; ?>
@foreach($listOfData as $data)
<?php
if (trim($data->mname == '')) {
    $name = $data->title->title_print . $data->fname . ' ' . $data->lname;
} else {
    $name = $data->title->title_print . $data->fname . ' ' . $data->mname . ' ' . $data->lname;
}
?>
<tr>
    <td>{{($seq++)}}</td>
    <td>{{$data->member_pid}}</td>
    <td>{{$name}}</td>
</tr>
@endforeach
@stop
