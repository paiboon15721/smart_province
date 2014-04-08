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
        @yield('area')
        <div id="map" style="width:1000px;">
            <div style="width:800px; border:0; overflow: hidden; float:left;">
                <img src="<?php echo asset('images/main/map.png'); ?>" id="map_image" usemap="#map" />
            </div>
            <div style="padding-top: 14px;">
                <div  id="statelist" style="float:left; padding-left: 10px; width:180px; height: 628px; overflow-y: scroll;  background-color:#b0c4de;"></div>
            </div>
        </div>
        <div align="center">
            <a href="#" target="_blank" ><font color="white">เพิ่มหมู่บ้าน</font></a>
        </div>
        <br />
        <div id="someid"></div>
        <map id="image_map" name="map">
            @yield('area')
        </map>
    </body>
</html>