<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
?>
<!DOCTYPE HTML>
<html lang="en-GB">
    <head>
        {{HTML::style('css/dataTables/jquery-ui-1.8.14.custom.css')}}
        {{HTML::style('css/dataTables/demo_table_jui.css')}}
        {{HTML::style('css/dataTables/TableTools_JUI.css')}}
        {{HTML::style('css/dataTables/style_information.css')}}
        {{HTML::script('js/dataTables/jquery.dataTables.min.js')}}
        {{HTML::script('js/dataTables/TableTools.js')}}
        {{HTML::script('js/dataTables/ZeroClipboard.js')}}
        {{HTML::script('js/dataTables/jquery.jeditable.js')}}
    </head>
    <body>
        <h1 class="title" style="color: #4F789F; border-bottom: 1px solid #3B3B3B; padding-bottom: 10px">{{$title}}</h1>
        <table cellspacing="0" cellpadding="0"  id="datatable">
            <thead>
                <tr>
                    @foreach($headers as $header)
                    <th class="{{$header['class']}}" width="{{$header['width']}}">{{$header['text']}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @yield('data')
            </tbody>
        </table>
        <br />
    </body>
</html>
