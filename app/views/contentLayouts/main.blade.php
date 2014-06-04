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
    <div class="post">
        <div class="row">
            <div class="feat-img span2">
                <img src="http://lorempixel.com/350/325/sports/1" title="featured image" alt="an image was here" />
            </div><!-- end featured image -->

            <div class="details span4">
                <h2>ข่าวประชาสัมพันธ์ของศูนย์</h2>
                <p>
                    Lorem ipsum pariatur velit pariatur dolore aliqua voluptate sed Duis dolor ea cillum qui anim consequat quis sunt ex eu culpa veniam nisi nulla non dolor esse sit aliquip irure in amet reprehenderit quis voluptate occaecat in enim Duis.Aliqua voluptate sed Duis dolor ea cillum qui anim consequat quis sunt ex eu culpa veniam nisi nulla non dolor esse sit aliquip irure in amet reprehenderit quis voluptate occaecat in enim Duis.
                </p>
            </div> <!-- end details -->
            <a class="btn pull-right" href="#">อ่านต่อ..</a>
        </div><!-- end post row -->
    </div><!-- end post -->

    <div class="post">
        <div class="row">
            <div class="feat-img span2">
                <img src="http://lorempixel.com/350/325/sports/3" title="featured image" alt="an image was here" />
            </div><!-- end featured image -->

            <div class="details span4">
                <h2>ภาพกิจกรรมต่างๆ ของศูนย์</h2>
                <p>
                    Lorem ipsum pariatur velit pariatur dolore aliqua voluptate sed Duis dolor ea cillum qui anim consequat quis sunt ex eu culpa veniam nisi nulla non dolor esse sit aliquip irure in amet reprehenderit quis voluptate occaecat in enim Duis.Aliqua voluptate sed Duis dolor ea cillum qui anim consequat quis sunt ex eu culpa veniam nisi nulla non dolor esse sit aliquip irure in amet reprehenderit quis voluptate occaecat in enim Duis.
                </p>
            </div> <!-- end details -->
            <a class="btn pull-right" href="#">อ่านต่อ..</a>
        </div><!-- end post row -->
    </div><!-- end post -->
</div>
@stop

@section('carouselSlide')
<div id="myCarousel" class="carousel slide">
    <!-- Carousel items -->
    <div class="carousel-inner">
        @for ($i=1; $i<4; $i++)
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