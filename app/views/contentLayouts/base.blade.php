@extends('layouts.main')
@section('title')
@yield('subTitle')
- หมู่บ้าน{{$_SESSION['catm_description']}}
@stop
@section('description')
@yield('subDescription')
- หมู่บ้าน{{$_SESSION['catm_description']}}
@stop
@section('keywords')
@yield('subKeywords')
- หมู่บ้าน{{$_SESSION['catm_description']}}
@stop

@section('headerName')
หมู่บ้าน{{$_SESSION['catm_description']}}
@stop

@section('script&css')
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
@yield('subContent')
@stop

@section('carouselSlide')
@yield('subCarouselSlide')
@stop

@section('rightWidget')
@yield('subRightWidget')
@stop

@section('leftWidget')
<?php $thisPage = Session::get('thisPage'); ?>
<aside class="span3">
    <div class="row">
        <div class="widget span3">
            <h3>เมนู</h3>
            <ul>
                <li <?php echo ($thisPage == 'villageInformationSystem') ? 'class="active_sidebar_menu"' : '' ?>>
                    {{HTML::link('villageInformationSystem', 'ระบบข้อมูลหมู่บ้าน')}}
                </li>
                <li <?php echo ($thisPage == 'servicesSystem') ? 'class="active_sidebar_menu"' : '' ?>>
                    {{HTML::link('servicesSystem', 'ระบบงานบริการด้านต่างๆ')}}
                </li>
                <li <?php echo ($thisPage == 'generalSystem') ? 'class="active_sidebar_menu"' : '' ?>>
                    {{HTML::link('generalSystem', 'ระบบงานทั่วไป')}}
                </li>
                @if (isset($_SESSION['EMPID']))
                <li <?php echo ($thisPage == 'recordingSystem') ? 'class="active_sidebar_menu"' : '' ?>>
                    {{HTML::link('recordingSystem', 'ระบบการบันทึกเพื่อการบริหาร')}}
                </li>
                @endif
            </ul>
        </div><!-- end widget -->
        <div class="widget span3">
            @if (isset($_SESSION['EMPID']))
            <h3>เข้าสู่ระบบสำเร็จ</h3>
            <p style="text-align:center;" >
                <font color='blue'>ยินดีต้อนรับ<br />{{$_SESSION['EMPNAME']}}</font>
            </p>
            <p style="text-align:center;" >
                {{HTML::link('logout', 'Logout', array('class' => 'btn', 'onclick' => "return confirm('ยืนยันการออกจากระบบ?')"))}}
            </p>
            @else
            <h3>อ่านบัตร</h3>
            <p style="text-align:center;" >
                <img src="{{asset('images/main/card_unselected.png')}}"
                     style="cursor:pointer;" width="100%" height="100%" onclick="openLoginPage();"
                     onmouseover="this.src ='{{asset('images/main/card_selected.png')}}';"
                     onmouseout="this.src ='{{asset('images/main/card_unselected.png')}}';"/>
            </p>
            <p style="text-align:center;" >
                {{HTML::link('bypassLogin', 'BYPASS', array('class' => 'btn'))}}
            </p>
            @endif
        </div><!-- end widget -->
        <div class="widget span3">
            <h3>ปฏิทินข่าวกิจกรรมของหมู่บ้าน</h3>
            <iframe src="https://www.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;height=600&amp;wkst=1&amp;hl=th&amp;bgcolor=%23FFFFFF&amp;ctz=Asia%2FBangkok" style=" border-width:0 " width="100%" height="100%" frameborder="0" scrolling="no"></iframe>
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

@section('topRightMenu')
<li>{{HTML::link('/', 'กลับไปหน้าศูนย์ข้อมูลบริการหมู่บ้าน')}}</li>
@stop

@section('topLeftMenu')
<li <?php echo ($thisPage == 'main') ? 'class="active"' : '' ?>>{{HTML::link('main', 'หน้าหลัก')}}</li>
<li <?php echo ($thisPage == 'villageDirectors') ? 'class="active"' : '' ?>>{{HTML::link('villageDirectors', 'ทำเนียบผู้บริหารหมู่บ้าน')}}</li>
<li <?php echo ($thisPage == 'villageGeneralInformation') ? 'class="active"' : '' ?>>{{HTML::link('villageGeneralInformation', 'ข้อมูลทั่วไปของหมู่บ้าน')}}</li>
<li <?php echo ($thisPage == 'contactUs') ? 'class="active"' : '' ?>>{{HTML::link('contactUs', 'ติดต่อเรา')}}</li>
<li <?php echo ($thisPage == 'map') ? 'class="active"' : '' ?>>{{HTML::link('map', 'แผนที่')}}</li>
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