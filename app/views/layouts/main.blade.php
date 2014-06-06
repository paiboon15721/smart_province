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
        {{HTML::style('css/uiToTop/ui.totop.css')}}
        {{HTML::script('js/jquery-1.7.2.min.js')}}
        {{HTML::script('js/uiToTop/jquery.ui.totop.min.js')}}
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
                    <a class="brand" href="#">@yield('headerName')</a>
                    <div class="nav-collapse">
                        <ul class="nav">
                            @yield('topLeftMenu')
                        </ul>
                        <ul class="nav pull-right">
                            @yield('topRightMenu')
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="container">
            @yield('carouselSlide')
            <div class="row">
                @yield('leftWidget')
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