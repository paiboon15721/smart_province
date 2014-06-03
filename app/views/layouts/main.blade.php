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
                        <span class="icon-bar">555</span>
                        <span class="icon-bar">55</span>
                        <span class="icon-bar">5</span>
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
                            <div class="content" style="text-align:center;" >
                                @yield('login')
                            </div>
                        </div><!-- end widget -->
                        <div class="widget span3">
                            <h3>ข่าวสาร</h3>
                            <ul>@yield('message')</ul>
                        </div><!-- end widget -->
                        <div class="widget span3">
                            <h3>รูปภาพ</h3>
                            <p><img src="{{asset('images/slider/1.jpg')}}" title="widget image" alt="an image was here" /></p>
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