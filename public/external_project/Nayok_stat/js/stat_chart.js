

/* function list_array(arry_data){
		 var ansArr='';
		 for (var i=0;i<arry_data.length;i++){
			 if (i==0){
				ansArr+=arry_data[i];				
				}else{
					ansArr+=","+arry_data[i];}
				}
		 	return (ansArr);
		 }*/




//------------------------- Bar chart ------------------------------	
function chart_bar(arr_cate,sum_female){	
	
	var p_head = "รายละเอียด";
	var p_sub_head = "หัวข้อย่อย";
	var p_postfix = "จำนวนคน";
	var p_postfix_det ="คน";
	
		// arry_cate : categories

        $('#container').highcharts({
            chart: {
                type: 'column'
            },
            title: {//-------------- หัวข้อ ---------------
                text: p_head
            },
            subtitle: {//-------------- หัวข้อย่อย ---------------
                text: p_sub_head
            },
            xAxis: {//------------------ กลุ่ม ---------------
                categories: ['a1','122']    //listArray ()   list to  a,b,c,d
            },
            yAxis: {
                min: 0,
                title: {//-------------- label แกน x ---------------
                    text: p_postfix
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} '+ p_postfix_det +'</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'ชาย',
                data: [20,30,50]
    
              
            }, {
                name: 'หญิง',
                data: [sum_female, 80, 110]
    
            }]
        });
		
	}//end function
		
		
