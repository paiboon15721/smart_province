<?php
require '../session_start.php';
header('Content-type: text/html; charset=utf-8');
require_once("inc/MySQL/mySQLFunc.php");
require_once("inc/function.php");
$_SESSION['EMPID'] = str_replace("-", "", $_SESSION['EMPID']);
$_SESSION['EMPID'] = formatPID(iconv("TIS-620", "UTF-8", $_SESSION['EMPID']));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>ข้อมูลการลงประชามติ</title>
            <meta name="keywords" content="ข้อมูลการลงประชามติ" />
            <meta name="description" content="ข้อมูลการลงประชามติ" />
            <link href="css/template_style.css" rel="stylesheet" type="text/css" />
            <link href="css/m-buttons.css" rel="stylesheet" type="text/css" />
            <script language="javascript" src="inc/js/jquery.min.js"></script>
            <script src="inc/js/poll.js" type="text/javascript"></script>
            <style type="text/css">
                body {
                    background-color: #000000;
                }
            </style>
    </head>
    <body>
        <form id="frmPoll" name="frmPoll" method="post" action="poll.php">
            <div id="template_body_wrapper">
                <div id="template_main_wrapper">
                    <div id="template_header">
                    </div>
                    <!-- end of template_header -->

                    <div id="template_content_outer">
                        <div id="template_content_status">
                            <div class="status_left">ชื่อ - สกุล ผู้ปฏิบัติงาน &nbsp;:&nbsp;<?php echo $_SESSION['EMPNAME']; ?>&nbsp;(<?php echo $_SESSION['EMPID']; ?>)</div>
                            <div class="status_right"><?php echo DateThai(); ?></div>
                        </div>
                        <!-- end of template_content_status -->

                        <div id="template_content_inner">
                            <div id="template_content">
                                <div class="cleaner_h60"></div>
                                <div class="cleaner_h50"></div>
                                <img src="images/menu.png"  alt="" width="516" height="130" usemap="#Map" border="0"/>
                                <map name="Map" id="Map">
                                    <area shape="rect" coords="5,3,139,128" href="managePoll.php" target="_blank" alt="บันทึกประชามติ" />
                                    <area shape="rect" coords="183,3,332,128" href="hisPoll.php" target="_blank" alt="ผลการลงประชามติ" />
                                    <area shape="rect" coords="387,3,505,126" href="javascript:window.close();" alt="ออกจากระบบ" />
                                </map>

                            </div>
                            <!-- end of template_content -->
                        </div>
                        <!-- end of template_content_inner -->

                    </div>
                    <!-- end of template_content_outer -->
                    <div id="template_footer">
                        Copyright © 2013 CORE Solutions Ltd.
                    </div>
                    <!-- end of footer -->
                </div>
                <!-- end of template_main_wrapper -->
                <div class="cleaner"></div>

            </div> <!-- end of template_body_wrapper -->
            <script language="javascript" src="inc/js/jsFunc.js"></script>
        </form>
    </body>
</html>