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
<h1 class="title" style="color: #4F789F; border-bottom: 1px solid #3B3B3B; padding-bottom: 10px">ระบบจัดการภาพอัตลักษณ์</h1>
<br />
{{HTML::link($url . '/insert', 'เพิ่มรูปภาพ', array('class' => 'btn'))}}
<table cellspacing="0" cellpadding="0"  id="datatable">
    <thead>
        <tr>
            <th class="center" width="10px">ลำดับที่</th>
            <th class="center" width="240px">รูปภาพ</th>
            <th class="center" width="20px">แก้ไข/ลบ</th>
        </tr>
    </thead>
    <tbody>
        <?php $seq = 1; ?>
        @foreach($listOfData as $data)
        <tr>
            <td>{{($seq++)}}</td>
            <td style="text-align:center;"><img src="{{asset('data/'. $data->image)}}" height="350" width="1200" /></td>
            <td style="text-align:center;">{{HTML::link($url . '/update/' . $data->image_id, 'แก้ไข', array('class' => 'btn'))}}{{HTML::link($url . '/delete/' . $data->image_id, 'ลบ', array('class' => 'btn'))}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop
