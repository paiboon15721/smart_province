<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
?>
<!DOCTYPE HTML>
<html lang="en-GB">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta name="description" content="@yield('description')">
        <meta name="keywords" content="@yield('keywords')">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        {{HTML::style('css/layouts/bootstrap.css');}}
        {{HTML::style('css/layouts/my-css.css');}}
        {{HTML::style('css/layouts/bootstrap-responsive.css');}}
        {{HTML::script('js/jquery-1.7.2.min.js')}}
        @yield('script&css')
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#">หมู่บ้าน{{Session::get('catmNameTh')}}</a>
                    <div class="nav-collapse">
                        <ul class="nav">
                            @yield('topMenu')
                        </ul>
                        <ul class="nav pull-right">
                            <li>{{HTML::link('/', 'กลับไปหน้าเมนู')}}</li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="container">
            @yield('carouselSlide')
            <div class="row">
                <aside class="span3">
                    <div class="row">
                        <div class="widget span3">
                            <h3>เมนู</h3>
                            <ul>@yield('menu')</ul>
                        </div><!-- end widget -->
                        <div class="widget span3">
                            <h3>อ่านบัตร</h3>
                            <p style="text-align:center;" >
                                @yield('login')
                            </p>
                        </div><!-- end widget -->
                        <div class="widget span3">
                            <h3>ปฏิทินข่าวกิจกรรมของศูนย์</h3>
                            <p style="text-align:center;"><img src="{{asset('images/main/calendar.jpg')}}" title="widget image" alt="an image was here" width="100%" height="100%" /></p>
                        </div><!-- end widget -->
                        <div class="widget span3">
                            <h3>ข่าวพยากรณ์อากาศ</h3>
                            <iframe src="http://www.tmd.go.th/daily_forecast_forweb.php?strProvinceID=8-37-2-38-14-18-60" width="100%" height="240" scrolling="no" frameborder="0"></iframe>
                        </div><!-- end widget -->
                        <div class="widget span3">
                            <h3>สถิติการใช้งาน</h3>
                            <p style="width: 120px;"><a href="http://www.u-analyzer.com" target="_blank"><img src="http://www.u-analyzer.com/co_tag.php?sid=1127414_1" border="0" alt="ฟรีบริการเก็บสถิติเว็บไซด์ "></a><a href="http://aim.co.th" target="_blank" title="รับพัฒนา ปรึกษา Smartphone APP">บริษัท AIM Bangkok จำกัด</a></p><script language="javascript" src="http://www.u-analyzer.com/getstats.js.php?sid=1127414"></script>
                        </div><!-- end widget -->
                        <div class="widget span3">
                            <h3>ข่าวสาร</h3>
                            <ul>@yield('message')</ul>
                        </div><!-- end widget -->
                    </div><!-- end widget row -->
                </aside> <!-- end sidebar -->
                @yield('content')
                @yield('rightWidget')
            </div>
        </div>
        {{HTML::script('js/bootstrap.min.js')}}
        <script type="text/javascript">
$('.carousel').carousel();
        </script>
    </body>
</html>