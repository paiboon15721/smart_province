@extends('layouts.datatable')

@section('subSubSubContent')
<table cellspacing="0" cellpadding="0" border="0"  id="datatable" class="display">
    <thead>
        <tr>
            <th width="50" field="otop_id">id</th>
            <th width="150" field="catm">รหัสหมู่บ้าน</th>
            <th width="20" field="otop_star">ดาว</th>
            <th width="250" field="otop_name">ชื่อสินค้า</th>
            <th width="180" field="otop_type_name">ประเภทสินค้า</th>
            <th width="250" field="otop_detail">คำอธิบาย</th>
            <th width="200" field="otop_group">กลุ่ม</th>
            <th width="100" field="contract_name">ชื่อ</th>
            <th width="200" field="contract_tel">เบอร์โทร</th>
            <th width="300" field="contract_addr">ที่อยู่</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
@stop