<?php
header ('Content-type: text/html; charset=utf-8');
session_start();
?>
<?php 
require("inc/MySQL/mySQLFunc.php");
require("inc/function.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ข้อมูลการลงประชามติ</title>
<meta name="keywords" content="ข้อมูลการลงประชามติ" />
<meta name="description" content="ข้อมูลการลงประชามติ" />
<link href="css/template_style.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="inc/js/jquery.min.js"></script>
<script src="inc/js/poll.js" type="text/javascript"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
</head>
<body>
<div id="template_body_wrapper">
	<div id="template_main_wrapper">

      <div id="template_header"> <img src="images/BG_Banner.png" alt="image" />
        <div class="cleaner"></div>
        </div> 
        <!-- end of template_header -->
        
        <div id="template_content_outer">
            <div id="template_content_status">
                <span id="font_status">
                    <div class="status_left"><span id="font_status">ชื่อ - สกุล ผู้ปฏิบัติงาน &nbsp;:&nbsp;<?php echo $_SESSION['EMPNAME']; ?>&nbsp;(<?php echo $_SESSION['EMPID']; ?>)</span></div>
                    <div class="status_right"><?php echo DateThai(); ?></div>
                </span>
			</div>
            <!-- end of template_content_status -->
            
            <div id="template_content_inner" align="center">
           	  <form action="mainmenu.php" method="post" name="form1" class="fontHead" id="form1">
           	    <img src="images/titleResult.png" width="794" height="57" /><br />
           	    <div class="pollQuest">
           	      <table width="99%" border="0" cellpadding="0" cellspacing="0">
           	        <tr>
           	          <td height="30" align="center" class="pollTitle">หัวข้อ  <?php echo getVoteName($_POST['pollId']); ?><!--ไม่ให้โรงงานสกัดปาล์มน้ำมันชื่อดังเข้ามาดำเนินกิจการ หวั่นกระทบสิ่งแวดล้อม และการท่องเที่ยวในพื้นที่--></td>
       	            </tr>
           	        <tr>
           	          <td height="30" align="right" class="pollTotal2">จำนวนผู้ลงประชามติทั้งหมด <?php echo $_POST['sum']; ?> คน&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
       	            </tr>
       	          </table>
                </div>
                <div id="container" style="min-width: 210px; height: 210px; margin: 0 auto"></div>  
                
              </form>
              <table width="100%" border="0">
                <tr>
                  <td height="21" align="center"><input type="button" name="btExit" id="btExit" value="ออก" onclick="javascript:window.close();"/></td>
                </tr>
              </table>
              <p><br />
              </p>
              <p><br />
              </p>
            </div>
             <!-- end of template_content_inner -->  
             
        </div>
         <!-- end of template_content_outer -->
         
        <div id="template_content_bottom">Copyright © 2013 <a href="#">CORE Solutions Ltd.</a></div>
        <!-- end of template_content_bottom -->
        
       <!-- <div id="template_footer">
            Copyright © 2012 <a href="#">CORE Solution Ltd.</a> | Designed by <a href="mailto:championkung@gmail.com">Norrapong Huarakkit (QCM)</a>
        </div> 
        <!-- end of footer -->
        
	   	<div class="cleaner"></div>
    </div>
    <!-- end of template_main_wrapper -->
		<div class="cleaner"></div>
    
</div> <!-- end of template_body_wrapper -->
<script>
$(function () {
	
/*		Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function(color) {
		    return {
		        radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
		        stops: [
		            [0, color],
		            [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
		        ]
		    };
		});
*/

<?php
$strColor = array('#058DC7', '#50B432', '#ED1BC8', '#A824E5', '#FF9655', '#6AF9C4');
shuffle($strColor);
$colorCode =implode("','", $strColor);
?>
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
</body>
</html>
