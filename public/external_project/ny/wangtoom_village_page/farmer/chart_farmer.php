<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ผลการขึ้นทะเบียนเกษตรกร</title>
<?php
echo js_asset('jquery-1.6.1.min.js');
echo js_asset('highcharts.js');
?>
</head>

<body>
<br>
<center><div id="container" style="width: 80%; height: 400px"></div></center>
<script>
var chart1; // globally available
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
$(document).ready(function() {
      chart1 = new Highcharts.Chart({
		  colors: ['green','red','blue','black','yellow','#FFCC11'],
         chart: {
            renderTo: 'container',
            type: 'column'
         },
         title: {
            text: 'ผลการขึ้นทะเบียนเกษตรกร',
			     style: {
                    color: 'red',
					fontSize: '16px'
                }
         },
         xAxis: {
            categories: ['ภาคกลาง', 'ภาคตะวันตก', 'ภาคตะวันออก', 'ภาคตะวันออกเฉียงเหนือ', 'ภาคใต้', 'ภาคเหนือ'],
			    labels: {
                style: {
                    color: 'red',
					fontSize: '16px'
                }
            }
	   },
         yAxis: {
            title: {
               text: 'จำนวนครัวเรือน(หลักล้าน)',
			     style: {
                    color: 'red',
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
            name: 'ครัวเรือน',		
			
            data: [{
							y: 302081,
							color: '#BF0B23'
						}, {
							y: 377893,
							color: 'blue'
						}, {
							y: 366209,
							color: '#FFBBCC'
						},{
							y: 3454718,
							color: '#BB11AA'
						},1088582,{
							y: 1688162,
							color: '#DDAAEE'
						}]
         }]
      });
   });
</script>
</body>
</html>
