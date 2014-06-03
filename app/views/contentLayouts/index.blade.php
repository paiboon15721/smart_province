@extends('layouts.main')
@section('title')
@yield('subTitle')
- หมู่บ้าน{{Session::get('catmNameTh')}}
@stop
@section('description')
@yield('subDescription')
- หมู่บ้าน{{Session::get('catmNameTh')}}
@stop
@section('keywords')
@yield('subKeywords')
- หมู่บ้าน{{Session::get('catmNameTh')}}
@stop

@section('script&css')
{{HTML::style('css/uiToTop/ui.totop.css')}}
{{HTML::script('js/uiToTop/jquery.ui.totop.min.js')}}

<script type="text/javascript">
    function openLoginPage() {
        window.location = "login";
        window.open('', '_self');
        setTimeout(function() {
            window.close();
        }, 2000);
    }
</script>
@yield('subScript&css')
@stop

@section('content')
<div class="span6">
    <div class="row">
        <div class="details span6">
            @yield('subContent')
        </div>
    </div>
</div>
@stop

@section('carouselSlide')
<div id="myCarousel" class="carousel slide">
    <!-- Carousel items -->
    <div class="carousel-inner">
        <?php
        $catmNameEn = Session::get('catmNameEn');
        ?>
        <div class="active item"><img src="{{asset('images/'.$catmNameEn.'/prettyPhoto/fullscreen/1.jpg')}}" style="height: 350px; width: 1200px;" /></div>
        @for ($i=2; $i<29; $i++)
        <div class="item"><img src="{{asset('images/'.$catmNameEn.'/prettyPhoto/fullscreen/'.$i.'.jpg')}}" style="height: 350px; width: 1200px;" /></div>
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
            <h3>ลิงค์ต่างๆ</h3>
            <p><img src="{{asset('images/slider/1.jpg')}}" title="widget image" alt="an image was here" /></p>
        </div><!-- end widget -->
        <div class="widget span3">
            <h3>ปฏิทิน</h3>
            <p><img src="{{asset('images/slider/1.jpg')}}" title="widget image" alt="an image was here" /></p>
        </div><!-- end widget -->
        <div class="widget span3">
            <h3>อื่นๆ</h3>
            <p><img src="{{asset('images/slider/1.jpg')}}" title="widget image" alt="an image was here" /></p>
        </div><!-- end widget -->
        <div class="widget span3">
            <h3>รูปภาพ</h3>
            <p><img src="{{asset('images/slider/1.jpg')}}" title="widget image" alt="an image was here" /></p>
        </div><!-- end widget -->
    </div><!-- end widget row -->
</aside> <!-- end sidebar -->
@stop

@section('topMenu')
<?php $thisPage = Session::get('thisPage'); ?>
<li <?php echo ($thisPage == 'main') ? 'class="active"' : '' ?>>{{HTML::link('main', 'หน้าหลัก')}}</li>
<li <?php echo ($thisPage == 'villageDirectors') ? 'class="active"' : '' ?>>{{HTML::link('villageDirectors', 'ทำเนียบผู้บริหารหมู่บ้าน')}}</li>
<li <?php echo ($thisPage == 'villageGeneralInformation') ? 'class="active"' : '' ?>>{{HTML::link('villageGeneralInformation', 'ข้อมูลทั่วไปของหมู่บ้าน')}}</li>
<li <?php echo ($thisPage == 'contactUs') ? 'class="active"' : '' ?>>{{HTML::link('contactUs', 'ติดต่อเรา')}}</li>
<li <?php echo ($thisPage == 'map') ? 'class="active"' : '' ?>>{{HTML::link('map', 'แผนที่')}}</li>
@stop

@section('menu')
<li <?php echo ($thisPage == 'villageInformationSystem') ? 'class="active_sidebar_menu"' : '' ?>>{{HTML::link('villageInformationSystem', 'ระบบข้อมูลหมู่บ้าน')}}</li>
<li <?php echo ($thisPage == 'servicesSystem') ? 'class="active_sidebar_menu"' : '' ?>>{{HTML::link('servicesSystem', 'ระบบงานบริการด้านต่างๆ')}}</li>
<li <?php echo ($thisPage == 'generalSystem') ? 'class="active_sidebar_menu"' : '' ?>>{{HTML::link('generalSystem', 'ระบบงานทั่วไป')}}</li>
<li <?php echo ($thisPage == 'recordingSystem') ? 'class="active_sidebar_menu"' : '' ?>>{{HTML::link('recordingSystem', 'ระบบการบันทึกเพื่อการบริหาร')}}</li>
@stop

@section('login')
<img src="{{asset('images/main/card.png')}}" />
<input id="btnReadCard" name="btnReadCard" type="button" value="อ่านบัตร" style="width:100px; height: 30px; float: none;" onclick="openLoginPage();" />
@stop

@section('message')
<li>
    <h4>7 มกราคม 2556</h4>
    <p>1.แจ้งให้ทราบว่า วันที่ 8 มกราคม 2555 เวลา 14.30น. จะมีคณะพัฒนาการจังหวัดนครนายก จะมาเยี่ยมและพูดคุยและรับทราบข้อมูลข่าวสาร ในเรื่องกิจกรรมของหมู่บ้านจึงแจ้งให้ราษฏรในหมู่บ้านมาให้การต้อนรับ
        <br />
        2.แจ้งให้ทราบเรื่องการนำผู้ป่วย ในค่ายบำบัดที่วัดวังไกร โดยมีราษฏรในหมู่บ้านเรามีเข้าค่ายบำบัด  1 นาย โดยทางอำเภอเมืองได้ แจ้งรายชื่อให้ทราบแล้ว
        <br />
        3. แจ้งให้ทราบว่าวันที่ 9 มกราคม 25556 คณะเจ้าหน้าที่ของสำนักงานคลังจังหวัดนครนายก จะมาเยี่ยมชมเพื่อสอบถาม รายรับ รายจ่ายของครัวเรือน บ้านต้นแบบ เพื่อขอทราบข้อมูลของหมู่บ้านนี้
        <br />
        แจ้งเรื่องการประชุมประชาคมหมู่บ้านในวันที่ 21 มกราคม 2556 เวลา 17.00น. ที่ทำการข้อมูลข่าวสารประจำหมู่บ้าน โดยให้เข้าร่วมประชุมทั้งหมู่บ้านเพื่อจัดทำแผนพัฒนาหมู่บ้าน
    </p>
</li>
<li>
    <h4>15 มกราคม 2556</h4>
    <p>1.แจ้งให้ทราบว่า วันนี้เวลา 14.00น. ทางปศุสัตว์อำเภอ  ปศุศัตว์จังหวัดนครนายกของคณะ จะเข้ามาเยี่ยมชมกลุ่มผู้เลี้ยงกระบือ และบ่อแก๊ซธรรมชาติจากมูลสัตว์ นายวิสุทธ์ นิรัตน์ติวงศกรณ์ ผู้ตรวจการสำนักนายกรัฐมนตรีและคณะมาตรวจเยี่ยมโครงการธนาคาร กลุ่มขัดกระเบื้อง พร้อมทั้งแนะนำ และสอบถามปัญหาต่างๆ จึงแจ้งให้ทราบและเข้ามาต้อนรับโดยพร้อมกันในเวลา 14.00 น&#8230;</p>
</li>
@stop