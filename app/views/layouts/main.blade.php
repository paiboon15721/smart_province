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
        {{HTML::style('css/layouts/bootstrap.min.css');}}
        <style type="text/css">
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }

            .post {
                padding: 15px 0px;
                border-bottom: 1px dotted #ccc;
            }

            img {
                -webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
                -moz-box-sizing: border-box;    /* Firefox, other Gecko */
                box-sizing: border-box;         /* Opera/IE 8+ */
            }

            .widget h3 { display: block; background: #212121; color: #f1f1f1; text-transform: capitalize; border-radius: 5px; margin-bottom: 10px; text-align: center; padding: 5px 0px;}

            .feat-img img { padding: 5px; border: 1px solid #ccc;}

            .post:first-of-type { padding-top: 0px;}
            .widget ul { margin-left: 0px;}
            .widget ul li { list-style: none; font-size: 14px;}
            .widget ul li a { display: block; padding: 5px 0px;border-top: 1px dotted #ccc;}
            .widget ul li a:hover { background: #fff; text-decoration: none; padding-left: 5px;}

            .active_sidebar_menu { background: #fff; text-decoration: none; font-weight: bold; color:#0000ff}
        </style>
        {{HTML::style('css/layouts/bootstrap-responsive.min.css');}}
        @yield('script&css1')
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
                            <li class="active"><a href="index.html">Home</a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="blog.html">Blog</a></li>
                            <li><a href="#portfolio">Portfolio</a></li>
                            <li><a href="#cotact">Contact</a></li>
                        </ul>
                        <ul class="nav pull-right">
                            <li>{{HTML::link('/', 'กลับไปหน้าเมนู')}}</li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="container">
            <div id="myCarousel" class="carousel slide">
                <!-- Carousel items -->
                <div class="carousel-inner">
                    <div class="active item"><img src="{{asset('images/slider/1.jpg')}}" /></div>
                    <div class="item"><img src="{{asset('images/slider/2.jpg')}}" /></div>
                    <div class="item"><img src="{{asset('images/slider/3.jpg')}}" /></div>
                </div>
                <!-- Carousel nav -->
                <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
            </div>

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
                            <p><img src="http://lorempixel.com/550/325/nature/5" title="widget image" alt="an image was here" /></p>
                        </div><!-- end widget -->
                    </div><!-- end widget row -->
                </aside> <!-- end sidebar -->

                <div class="span9">
                    @yield('content')
                </div>
            </div>

        </div>
        <div id="header" class="head-image" style="background: url({{asset('css/layouts/banner.png')}});">
            <div class="head-text" style="font-size:65px;right: 249px;top: 45px;width: 500px;text-align: right">หมู่บ้าน{{Session::get('catmNameTh')}}</div>
        </div>
        <div id="page">
            <div id="content" >
                @yield('content')
            </div>
            <div id="sidebar">
                <div id="menu">
                    @yield('menu')
                </div>
                <div id="login" class="boxed">
                    <h2 class="title"><font size="1" >ระบบการบันทึกข้อมูลเพื่อการบริหาร</font></h2>
                    <div class="content" style="text-align:center;" >
                        @yield('login')
                    </div>
                </div>
                <div id="updates" class="boxed">
                    <h2 class="title"><font size="2" >ข่าวสาร</font></h2>
                    <div class="content">
                        <ul>
                            @yield('message')
                        </ul>
                    </div>
                </div>
            </div>
            <div style="clear: both;">
                &nbsp;
            </div>
        </div>
        <div id="footer">
            <p id="legal">
                Copyright &copy; 2013 CDG Core Solution.
            </p>
            <p id="links">
                <a href="#">Privacy Policy</a> | <a href="#">Terms of Use</a>
            </p>
        </div>
        {{HTML::script('js/jquery-1.7.2.min.js')}}
        {{HTML::script('js/bootstrap.min.js')}}
        <script type="text/javascript">
            $('.carousel').carousel()
        </script>
    </body>
</html>