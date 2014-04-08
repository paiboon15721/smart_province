@extends('contentLayouts.index')
@section('subTitle')
{{$title}}
@stop
@section('description')
{{$title}}
@stop
@section('keywords')
{{$title}}
@stop

@section('subScript&css')
{{HTML::style('css/accordion3/accordion3.css')}}
{{HTML::script('js/myAccordion3.js')}}

{{HTML::script('js/fancybox/source/jquery.fancybox.pack.js?v=2.1.5')}}
{{HTML::style('js/fancybox/source/jquery.fancybox.css?v=2.1.5')}}
<script type="text/javascript">
    $(document).ready(function() {
        $('.fancybox').fancybox({
            'width':'80%'
        });
    });
</script>
@stop

@section('subContent')
<div id="example" class="post" style="border-bottom: 0px;">
    <div class="content">
        {{$menu}}
    </div>
</div>
@stop