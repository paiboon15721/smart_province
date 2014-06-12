@extends('layouts.datatable')

@section('subSubSubContent')
<table cellspacing="0" cellpadding="0" border="0"  id="datatable" class="display">
    <thead>
        <tr>
            <th width="100" field="member_pid">รหัสประจำตัวประชาชน</th>
            <th width="20" field="fname">ชื่อ</th>
            <th width="50" field="lname">นามสกุล</th>
            <th width="50" field="member_career">อาชีพ</th>
            <th width="100" field="member_address">ที่อยู่</th>
            <th width="40" field="member_phone1">โทรศัพท์ (1)</th>
            <th width="40" field="member_phone2">โทรศัพท์ (2)</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
@stop