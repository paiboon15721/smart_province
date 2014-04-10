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
{{HTML::style('css/layouts/layouts.main.css')}}
{{HTML::style('css/uiToTop/ui.totop.css')}}
{{HTML::script('js/jquery-1.7.2.min.js')}}
{{HTML::script('js/uiToTop/jquery.ui.totop.min.js')}}
@yield('subScript&css')
@stop

@section('content')
@yield('subContent')
@stop

@section('menu')
<?php $thisPage = Session::get('thisPage'); ?>
<li>{{HTML::link('/', 'กลับไปหน้าเมนู')}}</li>
<li <?php echo ($thisPage == 'main') ? 'class="active"' : '' ?>>{{HTML::link('main', 'หน้าหลัก')}}</li>
<li <?php echo ($thisPage == 'villageDirectors') ? 'class="active"' : '' ?>>{{HTML::link('villageDirectors', 'ทำเนียบผู้บริหารหมู่บ้าน')}}</li>
<li <?php echo ($thisPage == 'villageGeneralInformation') ? 'class="active"' : '' ?>>{{HTML::link('villageGeneralInformation', 'ข้อมูลทั่วไปของหมู่บ้าน')}}</li>
<li <?php echo ($thisPage == 'villageInformationSystem') ? 'class="active"' : '' ?>>{{HTML::link('villageInformationSystem', 'ระบบข้อมูลหมู่บ้าน')}}</li>
<li <?php echo ($thisPage == 'servicesSystem') ? 'class="active"' : '' ?>>{{HTML::link('servicesSystem', 'ระบบงานบริการด้านต่างๆ')}}</li>
<li <?php echo ($thisPage == 'generalSystem') ? 'class="active"' : '' ?>>{{HTML::link('generalSystem', 'ระบบงานทั่วไป')}}</li>
<li <?php echo ($thisPage == 'recordingSystem') ? 'class="active"' : '' ?>>{{HTML::link('recordingSystem', 'ระบบการบันทึกเพื่อการบริหาร')}}</li>
<li <?php echo ($thisPage == 'contactUs') ? 'class="active"' : '' ?>>{{HTML::link('contactUs', 'ติดต่อเรา')}}</li>
<li <?php echo ($thisPage == 'map') ? 'class="active"' : '' ?>>{{HTML::link('map', 'แผนที่')}}</li>
@stop

@section('login')
<img src="{{asset('images/main/card.gif')}}" style="width: 168px;height:150px;"/>
<input id="btnReadCard" name="btnReadCard" type="button" value="อ่านบัตร" style="width:100px; height: 30px; float: none;" onclick="openLoginPage();" />
<br />
@stop

@section('message')
<li>
    <h3>7 มกราคม 2556</h3>
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
    <h3>15 มกราคม 2556</h3>
    <p>1.แจ้งให้ทราบว่า วันนี้เวลา 14.00น. ทางปศุสัตว์อำเภอ  ปศุศัตว์จังหวัดนครนายกของคณะ จะเข้ามาเยี่ยมชมกลุ่มผู้เลี้ยงกระบือ และบ่อแก๊ซธรรมชาติจากมูลสัตว์ นายวิสุทธ์ นิรัตน์ติวงศกรณ์ ผู้ตรวจการสำนักนายกรัฐมนตรีและคณะมาตรวจเยี่ยมโครงการธนาคาร กลุ่มขัดกระเบื้อง พร้อมทั้งแนะนำ และสอบถามปัญหาต่างๆ จึงแจ้งให้ทราบและเข้ามาต้อนรับโดยพร้อมกันในเวลา 14.00 น&#8230;</p>
</li>
@stop