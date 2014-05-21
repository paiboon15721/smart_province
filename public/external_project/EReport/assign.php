<!DOCTYPE html>
<?php 
include ("./FUNCTION/function.php");
include("./chk_session.php");
?>
<html>
<head>
<link href='./fullcalendar/fullcalendar.css' rel='stylesheet' />
<link href='./fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='./fullcalendar/jquery-1.9.1.min.js'></script>
<script src='./fullcalendar/jquery-ui-1.10.2.custom.min.js'></script>
<script src='./fullcalendar/fullcalendar.min.js'></script>
<script>
	$(document).ready(function() {
		$('#external-events div.external-event').each(function() {
			var eventObject = {
				title: $.trim($(this).text()), 
				 pid: $(this).children('input[type=hidden]').val() //$.trim($(this).('input[type=hidden]').text())
			};
			$(this).data('eventObject', eventObject);
			$(this).draggable({
				zIndex: 999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});
		});
		var lastView;
		 var catm_menu = $('input#catm').val();
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: '' //'month,agendaWeek,agendaDay' 
			},
			titleFormat :{
				  month: 'MMMM yyyy1'   
			},
			columnFormat: {
                month: 'dddd',    // Monday, Wednesday, etc
                week: 'dddd, MMM dS', // Monday 9/7
                day: 'dddd, MMM dS'  // Monday 9/7
            },
			viewDisplay: function(view) {
												$('#calendar').fullCalendar('removeEvents');
												if (lastView == undefined) { lastView = 'firstRun';  }
												if (view.name != lastView )
												{
													if (view.name == 'month') { 
														$('.fc-header-right').append('<span class=" fc-corner-left fc-corner-right "><span id="guard_1" class="frame guard1"><input type="radio" name="guard1"   id="guard1" value="1" checked />[08.00 - 16.00 น]</span><span  class="frame guard2"><input type="radio" name="guard1" id="guard2" value="2" />[16.00 - 24.00 น]</span><span  class="frame guard3"><input type="radio" name="guard1" id="guard3" value="3" />[24.00 - 08.00 น]</span></span>'); 
														$('.fc-header-right').append('<span class="fc-button  fc-state-default fc-corner-left fc-corner-right "><span class="fc-button-inner"><span id="print" class="fc-button-content fc-button-effect">พิมพ์รายงาน</span></span></span></span></span>'); 
														$("#print").click(function() {  FC_Print();});
														//$('.fc-header-right').append('<span class="fc-button fc-button-today fc-state-default fc-corner-left fc-corner-right fc-state-active"><span class="fc-button-inner"><span id="print" class="fc-button-content">print</span><span class="fc-button-effect"><span></span></span></span></span>'); 
													  }
												  lastView = view.name;
												}
                                    },
			events:function(start, end, callback) {
				$.ajax({
					type:"POST",
					url: 'connect_assign.php?action=sel',
					data: {start:  format_date(start),end: format_date(end),catm:catm_menu },
					dataType: 'json',
					success: function(resp) {
						var events = [];
						 $.each(resp, function(i, task) {
								if(task.phase=="1"){task.backgroundColor =  $('.guard1').css('background-color');}
								else if(task.phase=="2"){task.backgroundColor =  $('.guard2').css('background-color');}
								else{task.backgroundColor = $('.guard3').css('background-color');}
								task.textColor  =  $('.frame').css('color');
                                events.push({
                                    id:task.id,title: task.title, pid: task.pid,start: task.start,end: task.end,phase: task.phase,backgroundColor:task.backgroundColor,textColor:task.textColor
                                });
                            });
                            callback(events);
					}
				});
			},
			loading: function(bool) {
				if (bool) $('#loading').show();
				else $('#loading').hide();
		},
		 eventMouseover: function(event, jsEvent, view) {
				var layer =	'<div id="events-layer" class="fc-transparent" style="position:absolute; width:100%; height:100%; top:-1px; text-align:right; z-index:100">'
							+ '<a><img src="./fullcalendar/images/delete.png" title="ลบรายการ" width="14" id="delbut'+event.id+'" border="0" style="padding-right:5px; padding-top:2px;" /></a>'
							+ '</div>';
				$(this).append(layer);
				$("#delbut"+event.id).hide();
				$("#delbut"+event.id).fadeIn(200);
				$("#delbut"+event.id).click(function() {
					if(event.id) {
						var pid = event.pid;
						var start_date =format_date(event.start);
						var phase = event.phase;
						//alert(pid + start_date + phase);
			            $.ajax({
				             type:"POST",
							 url: 'connect_assign.php?action=del',
							data: {
								pid: pid , start_date: start_date ,  phase:phase                        
							},
				            dateType: 'json',
							success: function (resp) {
								//alert(resp);
								$('#calendar').fullCalendar('removeEvents', event.id);
							}
				        });
					}
				});
			},
		eventMouseout: function(calEvent, domEvent) {
				$("#events-layer").remove();
			},
			droppable: true, // this allows things to be dropped onto the calendar !!!
			drop: function(date, allDay) { // this function is called when something is dropped
				var originalEventObject = $(this).data('eventObject');
				var copiedEventObject = $.extend({}, originalEventObject);
				 var pid = copiedEventObject.pid;
				copiedEventObject.start = date;
				copiedEventObject.allDay = allDay;
				copiedEventObject.id = 0;
			  var title = copiedEventObject.title;
			  var catm = $('input#catm').val();
			  var start_date =format_date(date);
			   var end_date = start_date;
			   if ($('#guard1').is(':checked')) {phase="1";}
			  else if ($('#guard2').is(':checked')) {phase="2";}	
			  else if ($('#guard3').is(':checked')) {phase="3";}	
			  var cdate = new Date();
			 var sysdate  = format_date(cdate);
			 var systime =  format_time(cdate);
			  var emp_pid = $('input#upd_emp').val();
			 $.ajax({
                        type: 'POST',
                        url: 'connect_assign.php?action=add',
                        data: {
							catm:catm , pid: pid , start_date: start_date , end_date: end_date , phase:phase , sysdate:sysdate,systime:systime,emp_pid:emp_pid                           
                        },
                        dateType: 'json',
                        success: function (resp) {
							//alert(resp);
							if(resp!='false'){
								//alert("save");
								copiedEventObject.id= resp;
								copiedEventObject.phase = phase;
								if(phase=="1"){copiedEventObject.backgroundColor = $('.guard1').css('background-color');}
								else if(phase=="2"){copiedEventObject.backgroundColor = $('.guard2').css('background-color');}
								else{copiedEventObject.backgroundColor = $('.guard3').css('background-color');}
								copiedEventObject.textColor  =  $('.frame').css('color');
								$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
							}
							else{
								alert("ไม่สามารถบันทึกได้ เนื่องจากได้มีการแต่งตั้งบุคคลอื่นในช่วงเวลานี้แล้ว \nหากต้องการเปลี่ยนแปลงให้ลบรายการเดิมออกก่อน");
							}
                        }
                    });
				if ($('#drop-remove').is(':checked')) {
					$(this).remove();
				}	
			}, 
			eventClick: function(calEvent, jsEvent, view) {
			//alert('Event: ' + calEvent.pid);
			//alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
			//alert('View: ' + view.name);
			// change the border color just for fun
			//$(this).css('border-color', 'red');
			}, 
			dayClick: function(date, allDay, jsEvent, view) {
			//if (allDay) {alert('Clicked on the entire day: ' + date);}
			//else{alert('Clicked on the slot: ' + date);}
			//alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
			//alert('Current view: ' + view.name);
			// change the day's background color just for fun
			//$(this).css('background-color', 'red');
			}
		});
		
	});
	function format_date(d){ ///////////////////// SET DATEPICKER
		var month = d.getMonth()+1;
		var day = d.getDate();
		if(d.getFullYear()<2500){var year = d.getFullYear()+543;}
		else{var year = d.getFullYear();}
		var date_s =year + (month<10 ? '0' : '') + month+(day<10 ? '0' : '') + day;
		return date_s;
	}
	function format_time(d){ //////////////////// SET TIMEPICKER
		var hour = d.getHours();
		var mint = d.getMinutes();
		var time_s = (hour<10 ? '0' : '') + hour+(mint<10 ? '0' : '') + mint;
		return time_s;
	}
	function FC_Print() {
			if (window.showModalDialog) {
				var start_date = $("#calendar").fullCalendar('getView').start;
				start_date = format_date(start_date);
				var end_date = $("#calendar").fullCalendar('getView').end;
				end_date = format_date(end_date);
				var catm_desc = $('input#catm_desc').val();
				var str = "print.php?start_date="+ start_date+"&end_date="+end_date+"&catm_desc="+catm_desc;
				str = urlEncode(str);
				//alert(str);
				var returnValue =  window.showModalDialog(str,"","dialogWidth:10px;dialogHeight:10px");
				//alert(returnValue);
			} 
	}
	function urlEncode(inputString, encodeAllCharacter){
       var outputString = '';
       if (inputString != null){
         for (var i = 0; i < inputString.length; i++ ){
            var charCode = inputString.charCodeAt(i);
            var tempText = "";
            if (charCode < 128) {
                if (encodeAllCharacter)
                {
                  var hexVal = charCode.toString(16);
                  outputString += '%' + ( hexVal.length < 2 ? '0' : '' ) + hexVal.toUpperCase(); 
                } else {
                  outputString += String.fromCharCode(charCode);
                }
                             
            } else if((charCode > 127) && (charCode < 2048)) {
                tempText += String.fromCharCode((charCode >> 6) | 192);
                tempText += String.fromCharCode((charCode & 63) | 128);
                outputString += escape(tempText);
            } else {
                tempText += String.fromCharCode((charCode >> 12) | 224);
                tempText += String.fromCharCode(((charCode >> 6) & 63) | 128);
                tempText += String.fromCharCode((charCode & 63) | 128);
                outputString += escape(tempText);
            }
         }
       }
       return outputString;
    }
</script>

<style>
	body {
		border:0; margin:0; padding:0;
		text-align: center;
		font-size: 14px;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		background-image:url('./fullcalendar/images/6.png');
		}
	#wrap {
		width: 1100px;
		margin: 10px auto;
		background: #ffffff;
		-webkit-border-radius: 20px;
		-moz-border-radius: 20px;
		border-radius: 20px;
		border: 1px solid #ccc;
		}
	#external-events {
		float: left;
		width: 150px;
		margin: 10px 10px;
		padding: 0 10px;
		border: 1px solid #ccc;
		background: #eee;
		text-align: left;
		-webkit-border-radius: 20px;
		-moz-border-radius: 20px;
		border-radius: 20px;
		}
	#external-events h4 {
		font-size: 16px;
		margin-top: 0;
		padding-top: 1em;
		}
	.external-event { /* try to mimick the look of a real event */
		margin: 10px 0;
		padding: 2px 4px;
		background: #3366CC;
		color: #fff;
		font-size: .85em;
		cursor: pointer;
		}
	#external-events p {
		margin: 1.5em 0;
		font-size: 11px;
		color: #666;
		}
	#external-events p input {
		margin: 0;
		vertical-align: middle;
		}
	#calendar {
		float: left;
		margin: 10px 10px;
		width: 880px;
		}
	#headerbar {
		width: 1100px;
		border:0; padding:0;
		margin: 20px auto;
		height:60px;
		color: #000000; 
	}
	#footerbar {
		display: block;
		text-align: center;
		height:80px;
		background-image:url('./fullcalendar/images/3.png');
	}
	.alignleft {
		float: left;
		background: #ffffff;
	}
	.alignright {
		float: right;
		background: #ffffff;
	}
	.frame{
	border: 1px solid #ccc;
	padding:10px;
	color: #000000;
	margin: 0 2px;
	font-size: 10px;
	}
	.guard1{
	 background-color: #FFEF82; 
	}
	.guard2{
	 background-color: #FFAB00;
	}
	.guard3{
	 background-color: #92C9FA;
	}
</style>
</head>
<body>
<?php 
$catm_menu = $_SESSION['catm_menu']; 
$EMPID = $_SESSION['EMPID'];
$EMPNAME = $_SESSION['EMPNAME'];
?>
<input type="hidden" id="catm" value="<?php echo $catm_menu?>"  />
<input type="hidden" id="catm_desc"  value="<?php echo get_name_ccaattmm($catm_menu);?>" />
<input type="hidden" id="upd_emp" value="<?php echo $EMPID;?>"  />
<input type="hidden" id="upd_name"  value="<?php echo  $EMPNAME;?>" />
<div id='headerbar' ><img src='./fullcalendar/images/title.png' />
	<span class="alignleft">หมู่บ้าน : <?php echo get_name_ccaattmm($catm_menu);?></span>
	<span class="alignright">ผู้บันทึก : <?php echo  $EMPNAME;?></span>
</div>
<div id='wrap'>
<div id='external-events'>
<h4>คณะกรรมการหมู่บ้าน</h4>
<?php 
	$sql="SELECT t1.member_pid,t1.fname,t1.mname,t1.lname FROM tab_group_member t1,tab_member_position  t2 WHERE t1.member_pid=t2.member_pid and  t1.catm = '$catm_menu' and (t2.group_id='21' or t2.group_id='3')  ";
	mysql_query("set names 'utf8'");  
	$qr=mysql_query($sql);
	while($rs=mysql_fetch_array($qr)){
		$pid = $rs['member_pid'];
		$name = $rs['fname']." ".$rs['mname']." ".$rs['lname'];
		echo "<div class='external-event' >$name<input type='hidden' value='$pid' /></div>";
	}
?>
</div>
<div id='calendar'></div>
<div style='clear:both'></div>
</div>
<div id='footerbar' ></div>
</body>
</html>
