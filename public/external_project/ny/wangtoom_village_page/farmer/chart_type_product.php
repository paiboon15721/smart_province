<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>แหล่งเพาะปลูกและผลผลิต ประเภทข้าว พืชไร่ พืชผัก จำแนกตามอำเภอ</title>
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
            text: 'แหล่งเพาะปลูกและผลผลิต ประเภทข้าว พืชไร่ พืชผัก จำแนกตามอำเภอ'
         },
         xAxis: {
            categories: ['เนื้อที่เพาะปลูก(ไร่) ', 'เนื้อที่เก็บเกี่ยว(ไร่)', 'ผลผลิตรวม(ตัน)'],
			    labels: {
                style: {
					fontSize: '16px'
                }
            }
		},
         yAxis: {
            title: {
               text: 'จำนวน(หลักแสน)',
			      style: {
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
            data: [96004, 188876,83769]
         }, {
            name: 'อำเภอองครักษ์',
            data: [400963, 450825,320197]
         }, {
            name: 'อำเภอบ้านนา',
            data: [190523, 188966,119752]
         }, {
            name: 'อำเภอปากพลี',
            data: [78121, 77264,32890]
         }]
      });
   });
</script>
</body>
</html>
