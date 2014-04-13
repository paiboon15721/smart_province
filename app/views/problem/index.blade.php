@extends('layouts.datatable')

@section('subSubContent')
<div id="welcome" class="post">
    <table cellspacing="0" cellpadding="0" border="0"  id="datatable" class="display">
        <thead>
            <tr>
                <th width="30" field="problem_running_id">id</th>
                <th width="100" field="catm">รหัสหมู่บ้าน</th>
                <th width="30" field="problem_id">รหัสปัญหา</th>
                <th width="250" field="problem_name">ปัญหา</th>
                <th width="100" field="problem_desc">สภาพปัญหา</th>
                <th width="150" field="cause">สาเหตุ</th>
                <th width="100" field="howto">ทางแก้</th>
                <th width="40" field="begin_date">วันเกิด</th>
                <th width="40" field="end_date">วันแก้</th>
                <th width="40" field="status">สถานะ</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@stop