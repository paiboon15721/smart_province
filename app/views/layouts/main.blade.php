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
            .widget ul li a { display: block; padding: 5px 0px; color: #888; border-top: 1px dotted #ccc;}
            .widget ul li a:hover { background: #fff; text-decoration: none; padding-left: 5px;}
        </style>
        {{HTML::style('css/layouts/bootstrap-responsive.min.css');}}
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
                    <a class="brand" href="index.html">Untame Bootstrap</a>
                    <div class="nav-collapse">
                        <ul class="nav">
                            <li class="active"><a href="index.html">Home</a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="blog.html">Blog</a></li>
                            <li><a href="#portfolio">Portfolio</a></li>
                            <li><a href="#cotact">Contact</a></li>
                        </ul>
                        <ul class="nav pull-right">
                            <li><a href="http://wp.me/p2m9ik-j6">Back To Untame</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
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
    </body>
</html>