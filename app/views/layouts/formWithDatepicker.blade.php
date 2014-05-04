@extends('layouts.form')

@section('subSubScript&css')
{{HTML::style('css/datepicker/datepick.css')}}
{{HTML::script('js/datepicker/jquery.inputform.js')}}
{{HTML::script('js/datepicker/jquery-message.js')}}
{{HTML::script('js/datepicker/jquery.datepick.js')}}
{{HTML::script('js/datepicker/func.js')}}
@stop

@section('subSubContent')
@yield('subSubSubContent')
<script language="javascript">
    input_ClassLoader("#profileForm ");
</script>
@stop

