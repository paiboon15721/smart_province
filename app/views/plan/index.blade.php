@extends('layouts.datatable')

@section('subSubSubContent')
<table cellspacing="0" cellpadding="0" border="0"  id="datatable" class="display">
    <thead>
        <tr>
            <th width="50" field="plan_id">plan_id</th>
            <th width="50" field="catm">catm</th>
            <th width="150" field="plan_name">plan_name</th>
            <th width="20" field="type">type</th>
            <th width="250" field="plan_date">plan_date</th>
            <th width="180" field="size">size</th>
            <th width="250" field="budget">budget</th>
            <th width="200" field="head">head</th>
            <th width="100" field="budget_resource">budget_resource</th>
            <th width="200" field="start_year">start_year</th>
            <th width="300" field="end_year">end_year</th>
            <th width="300" field="status">status</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
@stop