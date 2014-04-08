@extends('contentLayouts.index')

@section('subTitle')
ข้อมูลทั่วไป
@stop
@section('subDescription')
ข้อมูลทั่วไป
@stop
@section('subKeywords')
ข้อมูลทั่วไป
@stop

@section('subScript&css')
{{HTML::style('css/prettyPhoto/prettyPhoto.css')}}
{{HTML::script('js/jquery.prettyPhoto.js')}}
{{HTML::script('js/myPrettyPhoto.js')}}
@stop

@section('subContent')
<div id="welcome" class="post" style="border-bottom: 0px">
    <div class="head-image">
        <h1 class="title" style="border-bottom: 1px solid #3B3B3B; padding-bottom: 10px">หมู่บ้าน{{Session::get('catmNameTh')}}</h1>
    </div>
    <div id="image" >
        <ul class="gallery clearfix" style="padding: 0px;">
            <li>
                <a href="{{asset('images/'.$catmNameEn.'/prettyPhoto/fullscreen/mainpic.jpg')}}" rel="prettyPhoto[gallery1]" >
                    <img src="{{asset('images/'.$catmNameEn.'/prettyPhoto/fullscreen/mainpic.jpg')}}" alt='รูปอัตลักษณ์' width='292' height='249' style='float: left; margin: 0 5px 0 0;' />
                </a>
            </li>
            @for ($i=1; $i<29; $i++)
            <li>
                <a href="{{asset('images/'.$catmNameEn.'/prettyPhoto/fullscreen/'.$i.'.jpg')}}" rel="prettyPhoto[gallery1]" >
                    <img src="{{asset('images/'.$catmNameEn.'/prettyPhoto/thumbnails/'.$i.'.jpg')}}" alt='สถานที่ท่องเที่ยว' width='60' height='60' style='float: left; margin: 0 3px 3px 0;' />
                </a>
            </li>
            @endfor
        </ul>
    </div>
</div>
@yield('subSubContent')
@stop