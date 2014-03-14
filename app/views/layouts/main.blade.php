<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
?>
<!DOCTYPE HTML>
<html lang="en-GB">
    <head>
        <meta charset="UTF-8">
        <title>@yield('title')</title>
        <meta name="description" content="@yield('description')">
        <meta name="keywords" content="@yield('keywords')">
        @yield('script&css')
    </head>
    <body>
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