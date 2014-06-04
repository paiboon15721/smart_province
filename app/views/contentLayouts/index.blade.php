@extends('contentLayouts.base')

@section('subContent')
<div class="span6">
    @yield('subSubContent')
</div>
@stop

@section('subCarouselSlide')
<div id="myCarousel" class="carousel slide">
    <!-- Carousel items -->
    <div class="carousel-inner">
        <?php
        $catmNameEn = Session::get('catmNameEn');
        ?>
        <div class="active item"><img src="{{asset('images/'.$catmNameEn.'/prettyPhoto/fullscreen/1.jpg')}}" style="height: 350px; width: 1200px;" /></div>
        @for ($i=2; $i<4; $i++)
        <div class="item"><img src="{{asset('images/'.$catmNameEn.'/prettyPhoto/fullscreen/'.$i.'.jpg')}}" style="height: 350px; width: 1200px;" /></div>
        @endfor
    </div>
    <!-- Carousel nav -->
    <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
</div>
@stop

@section('subRightWidget')
<aside class="span3">
    <div class="row">
        <div class="widget span3">
            <h3>โครงการพระราชดำริ</h3>
            <p><img src="{{asset('images/main/472875.gif')}}" title="widget image" alt="an image was here" width="100%" height="100%" /></p>
        </div><!-- end widget -->
        <div class="widget span3">
            <h3>ปฏิทินข่าวกิจกรรมของศูนย์</h3>
            <p><img src="{{asset('images/main/calendar.jpg')}}" title="widget image" alt="an image was here" width="100%" height="100%" /></p>
        </div><!-- end widget -->
        <div class="widget span3">
            <h3>ข่าวสารและข้อมูลต่างๆ</h3>
            <p><img src="{{asset('images/main/activity_icon.jpg')}}" title="widget image" alt="an image was here" width="100%" height="100%" /></p>
            <p><img src="{{asset('images/slider/1.jpg')}}" title="widget image" alt="an image was here" /></p>
        </div><!-- end widget -->
    </div><!-- end widget row -->
</aside> <!-- end sidebar -->
@stop