<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>แหล่งเพาะปลูก จำแนกตามกิจกรรมการเกษตร</title>
<?php
echo js_asset('jquery-1.6.1.min.js');
echo js_asset('highcharts.js');
?>
</head>

<body>
<center><div id="container" style="width: 80%; height: 400px"></div></center>
<script>
var chart1; // globally available
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
$(document).ready(function() {
      chart1 = new Highcharts.Chart({
         chart: {
            renderTo: 'container',
            type: 'column'
         },
         title: {
            text: 'แหล่งเพาะปลูก จำแนกตามกิจกรรมการเกษตรและจำนวนครัวเรือน'
         },
         xAxis: {
            categories: ['ประเภท ข้าว พืชไร่ พืชผัก ', 'ประเภท ไม้ผลไม้ยืนต้น', 'ประเภท ปศุสัตว์','ประเภท การเพาะเลี้ยงสัตว์น้ำ'],
			    labels: {
                style: {
					fontFamily: 'tahoma',
					fontSize: '16px'
                }
            }
		},
         yAxis: {
            title: {
               text: 'จำนวนครัวเรือน (หลักพัน)',
			      style: {
				    fontFamily: 'tahoma',
					fontSize: '16px'
                }
            },
			labels: {
                formatter: function() {
                    //return this.value +' km';
					return numberWithCommas(this.value);
                }
            }
         },
         series: [{
            name: 'อำเภอเมืองนครนายก',
            data: [6829, 5572, 2260,2260]
         }, {
            name: 'อำเภอองครักษ์',
            data: [2383, 2727, 1405,2047]
         }, {
            name: 'อำเภอบ้านนา',
            data: [5355, 1508, 904,1163]
         }, {
            name: 'อำเภอปากพลี',
            data: [6271, 902, 564,440]
         }]
      });
   });
</script>
</body>
</html>
