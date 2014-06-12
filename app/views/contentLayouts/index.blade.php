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
        <?php $isFirstTime = true; ?>
        @foreach($listOfData as $data)
        <?php
        if ($isFirstTime) {
            $class = "active item";
        } else {
            $class = "item";
        }
        ?>
        <div class="{{$class}}"><img src="{{asset('data/'. $data->image)}}" style="height: 350px; width: 1200px;" /></div>
        <?php $isFirstTime = false; ?>
        @endforeach
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
            <h3>วีดีโอประชาสัมพันธ์</h3>
            <p><img src="{{asset('images/main/472875.gif')}}" title="widget image" alt="an image was here" width="100%" height="100%" /></p>
        </div><!-- end widget -->
        <div class="widget span3">
            <h3>ข่าวสารและข้อมูลต่างๆ</h3>
            <p><img src="{{asset('images/main/activity_icon.jpg')}}" title="widget image" alt="an image was here" width="100%" height="100%" /></p>
            <p><img src="{{asset('images/slider/1.jpg')}}" title="widget image" alt="an image was here" /></p>
        </div><!-- end widget -->
        <div class="widget span3">
            <h3>ใช้สำหรับโฆษณาให้เช่า</h3>
            <p><img src="{{asset('images/main/web_advertising_icon.jpg')}}" title="widget image" alt="an image was here" width="100%" height="100%" /></p>
        </div><!-- end widget -->
    </div><!-- end widget row -->
</aside> <!-- end sidebar -->
@stop