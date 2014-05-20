@extends('layouts.datatable')

@section('subSubContent')
<div id="welcome" class="post">
    <table cellspacing="0" cellpadding="0" border="0"  id="datatable" class="display">
        <thead>
            <tr>
                <th width="20" field="meeting_id">meeting_id</th>
                <th width="50" field="catm">catm</th>
                <th width="50" field="meeting_name">meeting_name</th>
                <th width="50" field="meeting_date">meeting_date</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@stop