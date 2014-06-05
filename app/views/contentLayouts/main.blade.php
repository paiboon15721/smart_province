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

@section('leftWidget')
<aside class="span3">
    <div class="row">
        <div class="widget span3">
            <h3>เมนู</h3>
            <ul>
                <li>{{HTML::link('#', 'ทำเนียบผู้บริหารศูนย์')}}</li>
                <li>{{HTML::link('#', 'รายชื่อหมู่บ้านของศูนย์')}}</li>
                <li>{{HTML::link('#', 'ระบบงานของ ศขบ.')}}</li>
                <li>{{HTML::link('#', 'ข่าวประชาสัมพันธ์')}}</li>
            </ul>
        </div><!-- end widget -->
        <div class="widget span3">
            <h3>อ่านบัตร</h3>
            <p style="text-align:center;" >
                <img src="{{asset('images/main/card_unselected.png')}}" width="100%" height="100%" id='card' />
            </p>
        </div><!-- end widget -->
        <div class="widget span3">
            <h3>Knowledge Center</h3>
            <p style="text-align:center;" >
                <img src="{{asset('images/main/knowledge-center.jpg')}}" width="100%" height="100%" />
            </p>
        </div><!-- end widget -->
        <div class="widget span3">
            <h3>ข่าวพยากรณ์อากาศ</h3>
            <iframe src="http://www.tmd.go.th/daily_forecast_forweb.php?strProvinceID=8-37-2-38-14-18-60" width="100%" height="240" scrolling="no" frameborder="0"></iframe>
        </div><!-- end widget -->
        <div class="widget span3">
            <h3>สถิติการใช้งาน</h3>
            <p><img src="{{asset('images/main/images.jpg')}}" title="widget image" alt="an image was here" width="100%" height="100%" /></p>
        </div><!-- end widget -->
    </div><!-- end widget row -->
</aside> <!-- end sidebar -->
@stop

@section('rightWidget')
<aside class="span3">
    <div class="row">
        <div class="widget span3">
            <h3>ปฏิทินข่าวกิจกรรมของศูนย์</h3>
            <iframe src="https://www.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;height=600&amp;wkst=1&amp;hl=th&amp;bgcolor=%23FFFFFF&amp;ctz=Asia%2FBangkok" style=" border-width:0 " width="100%" height="100%" frameborder="0" scrolling="no"></iframe>
        </div><!-- end widget -->
        <div class="widget span3">
            <h3>ข่าวสารต่างๆ</h3>
            <p><img src="{{asset('images/main/banner(1).jpg')}}" title="widget image" alt="an image was here" width="100%" height="100%" /></p>
            <p><img src="{{asset('images/main/banner(2).jpg')}}" title="widget image" alt="an image was here" width="100%" height="100%" /></p>
            <p><img src="{{asset('images/main/banner(3).jpg')}}" title="widget image" alt="an image was here" width="100%" height="100%" /></p>
            <p><img src="{{asset('images/main/banner(4).jpg')}}" title="widget image" alt="an image was here" width="100%" height="100%" /></p>
        </div><!-- end widget -->
        <div class="widget span3">
            <h3>ใช้สำหรับโฆษณาให้เช่า</h3>
            <p><img src="{{asset('images/main/web_advertising_icon.jpg')}}" title="widget image" alt="an image was here" width="100%" height="100%" /></p>
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

@section('topLeftMenu')
<li>{{HTML::link('#', 'หน้าหลัก')}}</li>
<li>{{HTML::link('#', 'ความเป็นมาของศูนย์')}}</li>
<li>{{HTML::link('#', 'ติดต่อเรา')}}</li>
<li>{{HTML::link('#', 'แผนที่')}}</li>
@stop