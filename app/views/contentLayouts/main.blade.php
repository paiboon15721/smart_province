@extends('layouts.main')
@section('title')
@yield('subTitle')
- ศูนย์ข้อมูลบริการหมู่บ้าน
@stop
@section('description')
@yield('subDescription')
- ศูนย์ข้อมูลบริการหมู่บ้าน
@stop
@section('keywords')
@yield('subKeywords')
- ศูนย์ข้อมูลบริการหมู่บ้าน
@stop

@section('headerName')
ศูนย์ข้อมูลบริการหมู่บ้าน
@stop

@section('script&css')
@yield('subScript&css')
@stop

@section('content')
<div class="span6">
    @yield('subContent')
</div>
@stop

@section('carouselSlide')
<div id="myCarousel" class="carousel slide">
    <!-- Carousel items -->
    <div class="carousel-inner">
        <div class="active item"><img src="{{asset('images/slider/1.jpg')}}" style="height: 350px; width: 1200px;" /></div>
        @for ($i=2; $i<4; $i++)
        <div class="item"><img src="{{asset('images/slider/'.$i.'.jpg')}}" style="height: 350px; width: 1200px;" /></div>
        @endfor
    </div>
    <!-- Carousel nav -->
    <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
</div>
@stop

@section('rightWidget')
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
            <h3>ลิงค์เว็บไซต์กระทรวงต่างๆ</h3>
            <ul>
                <li>{{HTML::link('#', 'สำนักนายกรัฐมนตรี')}}</li>
                <li>{{HTML::link('#', 'กระทรวงเทคโนโลยีสารสนเทศ')}}</li>
                <li>{{HTML::link('#', 'กระทรวงมหาดไทย')}}</li>
                <li>{{HTML::link('#', 'กระทรวงเกษตรกร')}}</li>
                <li>{{HTML::link('#', 'กระทรวงสหกรณ์')}}</li>
                <li>{{HTML::link('#', 'กระทรวงพานิช')}}</li>
                <li>{{HTML::link('#', 'กระทรวงการคลัง')}}</li>
                <li>{{HTML::link('#', 'กระทรวงวัฒนธรรม')}}</li>
                <li>{{HTML::link('#', 'กระทรวงกลาโหม')}}</li>
                <li>{{HTML::link('#', 'กระทรวงวิทยาศาสตร์')}}</li>
                <li>{{HTML::link('#', 'กระทรวงพลังงาน')}}</li>
                <li>{{HTML::link('#', 'กระทรวงอุตสาหกรรม')}}</li>
                <li>{{HTML::link('#', 'กระทรวงคมนาคม')}}</li>
            </ul>
        </div><!-- end widget -->
    </div><!-- end widget row -->
</aside> <!-- end sidebar -->
@stop

@section('topRightMenu')
@foreach ($catms as $catm)
<li>{{HTML::link('writeSession/' . $catm->catm_id, 'หมู่บ้าน' . $catm->catm_name_th)}}</li>
@endforeach
@stop

@section('topMenu')
<li>{{HTML::link('#', 'หน้าหลัก')}}</li>
<li>{{HTML::link('#', 'ความเป็นมาของศูนย์')}}</li>
<li>{{HTML::link('#', 'ติดต่อเรา')}}</li>
<li>{{HTML::link('#', 'แผนที่')}}</li>
@stop

@section('menu')
<li>{{HTML::link('#', 'ทำเนียบผู้บริหารศูนย์')}}</li>
<li>{{HTML::link('#', 'รายชื่อหมู่บ้านของศูนย์')}}</li>
<li>{{HTML::link('#', 'ระบบงานของ ศขบ.')}}</li>
<li>{{HTML::link('#', 'ข่าวประชาสัมพันธ์')}}</li>
@stop