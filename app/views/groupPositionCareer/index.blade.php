@extends('layouts.datatable')

@section('subSubContent')
<div id="welcome" class="post">
    <table cellspacing="0" cellpadding="0" border="0"  id="datatable" class="display">
        <thead>
            <tr>
                <th width="30" field="position_id">id</th>
                <th width="30" field="catm">รหัสหมู่บ้าน</th>
                <th width="100" field="position_name">ชื่อกลุ่ม</th>
                <th width="50" field="position_member">จำนวนสมาชิก</th>
                <th width="100" field="position_budget">เงินทุนหมุนเวียนในกลุ่ม</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@stop