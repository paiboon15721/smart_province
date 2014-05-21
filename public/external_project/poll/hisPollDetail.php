<?php
header ('Content-type: text/html; charset=utf-8');
session_start();
error_reporting( ~(E_NOTICE));
require_once("inc/MySQL/mySQLFunc.php");
require_once("inc/function.php");
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
<script src="inc/js/highcharts.js"></script>
<script src="inc/js/exporting.js"></script>
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
                    <div class="status_right"><?php //echo DateThai(); ?></div>
			</div>
            <!-- end of template_content_status -->
            
            <div id="template_content_inner"> 
            	<div id="template_content">
                  <div class="cleaner_h10"></div>
                  <img src="images/titleResult.png" width="794" height="57"  alt=""/>
                  <div class="cleaner_h10"></div>
                  <div class="pollTitle">หัวข้อ  <?php echo getVoteName($_POST['pollId']); ?></div>
                  <div class="pollTotal2">จำนวนผู้ลงประชามติทั้งหมด <?php echo $_POST['sum']; ?> คน&nbsp;</div>
                  <div class="cleaner_h10"></div>
                  <div id="container"></div> 

                  <div><a href="javascript:window.close();" class="m-btn red rnd sm">ออก</a></div>
                  <div class="cleaner_h10"></div>
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
	
<?php
$strColor = array('#00a300', '#ff0097', '#2d89ef', '#ffc40d', '#9f00a7', '#603cba');
shuffle($strColor);
$colorCode =implode(",", $strColor);
$colorCode = str_replace(",#","','#", $colorCode);
?>

<script>
$(function () {
         Highcharts.setOptions({
    colors: ['<?php echo $colorCode; ?>']
});
Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function(color) {
                    return {
                        radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
                        stops: [
                            [0, color],
                            [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
                        ]
                    };
                });

        $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: ''
            },
            tooltip: {
        	   pointFormat: '{point.y}' + ' คน',
            	percentageDecimals: 0
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.y +' คน';
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'การลงมติ',
                data: [
                    ['เห็นด้วย',    <?php echo $_POST['val1']; ?>],
                    ['ไม่เห็นด้วย',   <?php echo $_POST['val2']; ?>]
                ]
            }]
        });
    });
    

</script>
</form>
</body>
</html>