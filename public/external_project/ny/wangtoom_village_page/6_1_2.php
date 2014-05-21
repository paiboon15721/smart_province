<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>ศูนย์ข้อมูลบริการหมู่บ้าน (ศขบ.)</title>
<link href="../css/default.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<script type="text/javascript" src="../js/jquery-1.6.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="../plugin/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<link href="../plugin/tablecloth/tablecloth.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" href="../css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
<script src="../js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="../plugin/tablecloth/tablecloth.js"></script>
<script type="text/javascript" src="../plugin/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="../plugin/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="../js/modernizr.custom.29473.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#a_History,#a1_2,#a1_3,#a3_1,#a3_2,#a3_3,#a7_1,#a7_2,#a7_3,#a7_4,#a7_5").fancybox();
//	$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',theme:'light_square',slideshow:3000, autoplay_slideshow: true});
//	$(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:3000, hideflash: true, autoplay_slideshow: true});

	$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:3000, hideflash: true, autoplay_slideshow: false});
});
</script>
<style>
.center{
  text-align: center;
}

#image ul li { display: inline;}
</style>
</head>
<body>
<div id="header">
</div>
<div id="page">
	<div id="content">

		
                        <table style='width:100%'>
                        <tr>
							<td colspan=1  style='width:20%'>ชื่อแผนงาน :</td>
							<td colspan=3 align="left">
							
							<select name= "lstProjectMain" id= "lstProjectMain" size="1" class="font_standard" >
							  <option value='0'>--- ชื่อแผนงาน ---</option>
<option value='1'>โครงการป้องการ AIDS สู่ชุมชน ครั้งที่ 1</option>
<option value='2' selected>พัฒนาอาชีพ</option>
<option value='3'>ส่งเสริมการศึกษา</option>
						    </select>
													
						  </td>
                        </tr>	
						<tr> 
							 <td colspan=1  valign='top'>ชื่อโครงการ :</td>
                            <td colspan=3 align="left">
							<input name="txtProject_Name" type="text" class="font_standard" id="txtProject_Name" value="โครงการระบบสนับสนุนการปฏิบัติการ ศปร. (JOC)" maxlength="255"  style='width:100%' /></td>
						                        </tr>					
						<tr> 
							 <td  colspan=1  valign='top'>กิจกรรม :</td>
                            <td colspan=3 align="left">
							<textarea name="txtOperateOth" cols="80%" rows="6" class="font_standard" id="txtOperateOth" maxlength="255" >การอำนวยการความเป็นธรรมและความมั่นคงปลอดภัยในชีวิติและทรัพย์สิน</textarea>
							</td>
						                        </tr>											
						 <tr> 
							<td  colspan=1  valign='top'>หลักการและเหตุผล :</td>
                            <td colspan=3 align="left">
		
							<textarea name="txtMission" cols="80%" rows="10" class="font_standard" id="txtMission" maxlength="255" >ข้อมูลภูมิศาสตร์เชิงพื้นที่ มีความสำคัญมากในการศึกษาและวิเคราะห์การเกิดเหตุการณ์และผลกระทบต่างๆ  ไม่ว่าจะเป็นด้านจัดสรรที่ดิน (land use) ด้านการท่องเที่ยว ด้านการจัดการภัยพิบัติ ไปจนถึงด้านการจัดการกับอาชญากรรมและการก่อการร้าย เป็นต้น สำหรับประเทศไทย ซึ่งขณะนี้ประสบปัญหาภัยธรรมชาติอยู่บ่อยครั้ง  เช่น ดินถล่ม พายุ น้ำท่วม  ปัญหาการก่อความรุนแรงในพื้นที่ชายแดนภาคใต้ ปัญหาความขัดแย้งเรื่องเขตแดนเป็นต้น  หน่วยงานที่ดูแลปัญหาส่วนมากยังขาดการมีระบบสนับสนุนการตัดสินใจที่สามารถนำเสนอผลการวิเคราะห์ประกอบกับรูปแบบแผนที่ และฐานข้อมูล ที่จะช่วยเพิ่มประสิทธิภาพและเป็นประโยชน์ในการบริหารจัดการได้ดีขึ้น
สำหรับโครงการระบบสนับสนุนการปฏิบัติการ ศปร. (JOC)  ในโครงการนี้ จะประยุกต์ใช้งานฐานข้อมูลโดยใช้ WebEOC 7 (WEB-Emergency Operation Center) ซึ่งเป็นเครื่องมือที่สร้างขึ้นเพื่อปฏิบัติการในเหตุการณ์ฉุกเฉินร่วมกันของหน่วยงาน แบบไร้พรมแดน และช่วยในการตัดสินใจดำเนินการได้อย่างรวดเร็ว และเป็นซอฟแวร์ในรูปแบบเว็บที่ใช้จัดการข้อมูลวิกฤติในรูปแบบเรียลไทม์เพื่อรองรับการแจ้งและจัดการเหตุฉุกเฉิน ซึ่งเหตุการณ์ก่อความรุนแรงในพื้นที่สามจังหวัดชายแดนภาคใต้ ส่งผลกระทบทางลบต่อวิถีชีวิตของคน ทรัพย์สิน และสังคม การพัฒนาระบบสนับสนุนการตัดสินใจบนฐานข้อมูลเชิงพื้นที่นี้ จะอาศัยข้อมูลที่ได้มีการเก็บรวบรวมไว้ของการเกิดเหตุการณ์ก่อความรุนแรง ณ สถานที่ และ เวลาต่างๆ จากข้อมูลของหน่วยราชการ และหน่วยงานของทหารหลายส่วน โดยจะนำเอาเทคโนโลยีทางด้านระบบภูมิสารสนเทศศาสตร์ (GIS) ร่วมกับเทคโนโลยีการทำเหมืองข้อมูล (Data mining) และเทคโนโลยีการนำเสนอข้อมูลโดยใช้เทคโนโลยีการแสดงผลเสมือนจริง (Visualization) มาช่วยในการวิเคราะห์ในรูปแบบ (pattern) ตามช่วงเวลาในการเกิดเหตุการณ์ในอดีต ทำการประเมิน และแสดงผล ที่สะท้อนถึง ค่าความเสี่ยง ความเสียหาย และผลกระทบต่างๆ ที่อาจจะเกิดขึ้นในพื้นที่นั้นๆ กับการเกิดเหตุการณ์ก่อความรุนแรงในแต่ละครั้ง และเป็นเครื่องมือหนึ่งที่ให้ผู้ใช้งานสามารถเข้าใจการเกิดเหตุการณ์ก่อความรุนแรงตามจุดต่างๆ รวมทั้งตระหนักถึงแนวโน้มที่อาจจะเกิดขึ้นในอนาคต รวมไปถึงการคาดการณ์สถานการณ์ที่เสี่ยงต่อการเกิดเหตุรุนแรงในพื้นที่ 3 จังหวัดชายแดนภาคใต้ เพื่อที่จะใช้ประกอบการวางแผนและดำเนินการป้องกันและเตรียมความพร้อมในการรับมือ และช่วยลดความเสียหายที่จะเกิดขึ้นในอนาคต</textarea>
						
											
							</td>
                         </tr>			
						 <tr> 
							<td  colspan=1  valign='top'>วัตถุประสงค์ :</td>
                            <td colspan=3 align="left">
								
							<textarea name="txtPolicy" cols="80%" rows="10" class="font_standard" id="txtPolicy" maxlength="255" >1.	เพื่อเป็นฐานข้อมูลสำหรับระบบสนับสนุนการปฏิบัติการของ ศปร. (JOC) 
2.	เป็นฐานข้อมูลทางภูมิศาสตร์เชิงพื้นที่ (spatial data) ในบริเวณพื้นที่ 3 จชต. 
3.	เป็นระบบแสดงผลบนแผนที่แบบ Dynamic เชื่อมโยงกับฐานข้อมูลสำคัญ สำหรับระบบ
สนับสนุนการปฏิบัติการของ ศปร. (JOC)
4. เป็นระบบสำหรับการวิเคราะห์ข้อมูล ในการทำนายสถานการณ์ที่เสี่ยงต่อการเกิดเหตุร้ายในพื้นที่  3 จชต.จากเทคโนโลยีเหมืองข้อมูล
	5. เป็นระบบรายงานเหตุการณ์ และเข้าถึงข้อมูลแบบเรียลไทม์ สามารถจัดการเหตุการณ์ที่เกิดขึ้นพร้อมๆ กันอย่างอิสระ
	6. เป็นเครื่องมือที่สร้างขึ้นเพื่อปฏิบัติการในเหตุการณ์ฉุกเฉินร่วมของหน่วยงานแบบไร้พรมแดนและช่วยในการตัดสินใจดำเนินการได้อย่างรวดเร็ว
</textarea>
											
							</td>
                         </tr>								 
						 <tr> 
							<td  colspan=1  valign='top'>เป้าหมาย :</td>
                            <td colspan=3 align="left">
								
							<textarea name="txtTarget" cols="80%" rows="10" class="font_standard" id="txtTarget" maxlength="255" >  4.1 บุคลากรสามารถนำระบบไปสนับสนุนการปฏิบัติงานใน ศปร.
   	4.2 พัฒนาระบบสนับสนุนการปฏิบัติงาน ศปร.ให้มีขีดความสามรถ และ ประสิทธิภาพยิ่งขึ้น
  4.3 เป็นเครื่องมือที่สร้างขึ้นเพื่อสนับสนุนปฏิบัติการในเหตุการณ์ฉุกเฉินร่วม สำหรับ ศปร. 
</textarea>
											
							</td>
                         </tr>				
                          <tr> 
                            <td colspan=1  valign='top'>วิธีการดำเนินงาน :</td>
                            <td colspan=3 align="left">
									
							<textarea name="txtProcedure" cols="80%" rows="10" class="font_standard" id="txtProcedure" maxlength="255" >ประกอบด้วยกิจกรรมย่อย 4  กิจกรรม
	  5.1  การจัดหาโปรแกรมจัดการฐานข้อมูล (SQL Server Standard, 2 Procecessors), โปรแกรมบริหารจัดการสำหรับปฏิบัติการด้านเหตุการณ์ และโปรแกรมข้อมูลแผนที่ (GIS)
	  5.2 จัดหาอุปกรณ์ประเภท Hardware เช่น เครื่อง Server , เครื่องคอมพิวเตอร์ และระบบเครือข่าย
	  5.3 ติดตั้งระบบ WebEOC 7 และปรับรูปแบบระบบให้สามารถใช้งานภาษาไทย
	  5.4 ฝึกอบรมการจัดการฐานข้อมูล และการใช้งานระบบ WebEOC 7
</textarea>
							
							</td>
                          </tr>		
						<tr> 
							<td   align='right'>วันที่เริ่มต้น :</td>
                            <td align="left" >
							<div id="startDateTime" style="display:block">

<input  type="text" class="font_standard" id="DateStart" value="01/10/2553" readonly="readonly"/>
							</div>
</td>
                            <td  align='right'>วันที่สิ้นสุด :</td>
                            <td align="left" >
							
							<div id="endDateTime">
<input  type="text" class="font_standard" id="DateEnd" readonly="readonly" value="01/09/2554" />
							</div></td>							
                        </tr>			
						<tr> 
							<td colspan=1  valign='top'>งบประมาณ :</td>
							<td colspan=3 align="left">
											
							<input name="txtBudget" type="text" id="txtBudget" maxlength="10" value="1643000000" />
									
							</td>
						</tr>								
						<tr> 
							<td  colspan=1  valign='top'>ผู้รับผิดชอบโครงการ :</td>
							<td colspan=3 align="left">
											
							<input name="txtSourceTypeOth" type="text" id="txtSourceTypeOth" maxlength="200" value="ศสท.กอ.รมน.ภาค 4 สน.    " />
									
							</td>
						</tr>							
						<tr>
		                    <td colspan=1  valign='top'>หน่วยให้การสนับสนุน : </td>
		                    <td colspan=3 align="left">
		                            <div style="float:left">
												                                <select name= "lstSourceTypeMain"  id= "lstSourceTypeMain" size="1" class="font_standard" >
		                                    <option value='0'>--- หน่วยงานทางทหาร ---</option>
<option value='3'>ฉก.นราธิวาส</option>
<option value='2'>ฉก.ปัตตานี</option>
<option value='1'>ฉก.ยะลา</option>
		                              </select>
		                          </div>
		                                                                   
								  		                    </td>
	                      </tr>				
						 <tr> 
							<td  colspan=1  valign='top'>รายละเอียดโครงการ :</td>
                            <td colspan=3 align="left">
		
							<textarea name="txtDetail" cols="80%" rows="6" class="font_standard" id="txtDetail" maxlength="255" >รายละเอียดของโครงการ</textarea>
											
							</td>
                         </tr>							 						 
				 
                          <tr> 
                            <td  colspan=1  valign='top'>รายละเอียดการประเมิน :</td>
                            <td colspan=3 align="left">
										
							<textarea name="txtResultDetail" cols="80%" rows="10" class="font_standard" id="txtResultDetail" maxlength="255" >	10.1 ระบบสนับสนุนปฏิบัติการ ศปร. ตอบสนองการปฏิบัติตามภารกิจของหน่วยได้
	10.2 ข้อมูลและการรายงานเหตุการณ์ฉุกเฉินมีความถูกต้อง เชื่อถือได้
	10.3 ระบบ WebEOC 7 สามารถปรับปรุงและสร้างฐานข้อมูลเพิ่มเติมให้ตรงกับความต้องการของหน่วยงานได้
	10.4 ระบบ WebEOC 7  มีความถูกต้อง และปลอดภัยจากผู้บุกรุก และ ไวรัสต่างๆ
	10.5 มีระบบบันทึกและควบคุมผู้ใช้งานในระดับต่างๆ
</textarea>
									
							</td>
                          </tr>											  
                          <tr> 
                            <td  colspan=1  valign='top'>วันที่บันทึกผล :</td>
                            <td colspan=3 align="left">
											 
							 <div id="ResultDateTime" style="display:block">

<input  type="text" class="font_standard" id="ResultDate" value="//0" readonly="readonly"/>

							</div></td>		
                          </tr>								  
						  <tr> 
                            <td  valign='top'>ผลการดำเนินการโครงการ :</td>
                            <td align="left">
														
                               <select name= "qResultFlag" id= "qResultFlag" size="1" class="font_standard">
								<option value='0'>-----ผลการดำเนินโครงการ----</option>
<option value='1' selected>อยู่ระหว่างดำเนินการ</option>
<option value='2'>ดำเนินการแล้วเสร็จ</option>
<option value='3'>หยุดดำเนินการ</option>
<option value='9'>อื่น ๆ </option>
								</select>
										
                            </td>
							 <td  align='right'> กรณีอื่น ๆ (ระบุ):</td>
							 <td align="left">
									
							<input name="txtResultOth" type="text" id="txtResultOth" maxlength="100" value=" " />
			
							</td>								
                          </tr>	
                          <tr> 
                            <td colspan=1  valign='top'>ผลที่คาดว่าจะได้รับ :</td>
                            <td colspan=3 align="left">
										
							<textarea name="txtExpectResult" cols="80%" rows="10" class="font_standard" id="txtExpectResult" maxlength="255" >  11.1 ทำให้การปฏิบัติงานของ ศปร. มีเครื่องมือในการรายงานเหตุการณ์แบบเรียลไทม์
       	  11.2 เป็นระบบควบคุมและบังคับบัญชา ของ กอ.รมน.ภาค 4 สน.และหน่วยขึ้นตรง ที่มีฐานข้อมูลที่เชื่อถือได้ และทันสมัย
                  11.3 การรายงานเหตุการณ์ และติดตามเหตุการณ์ มีความรวดเร็ว และทำงานพร้อมๆ กันได้หลายๆ หน้าจอแสดงผล
	 11.4 ผู้ใช้งานสามารถติดต่อสื่อสารกันได้โดยใช้ห้องสนทนาภายใน WebEOC
	 	 11.5 มีระบบส่งสัญญาณแจ้งเหตุฉุกเฉินแบบเรียลไทม์
		 11.6  ผู้ใช้สามารถอับโหลดและแบ่งปันเอกสารและไฟล์งานต่างๆ กับผู้ใช้งานในระบบได้สะดวกรวดเร็วผ่านทาง WebEOC
	 11.7  สามารถสร้างปฏิทินการปฏิบัติงาน และตารางการดำเนินการ ตารางการฝึกอบรม การ
ประชุมต่างๆ ได้
	 11.8 สามารถสืบค้นสถานที่ หรือ ข้อมูลต่างๆ ภายใน WebEOC ได้อย่างรวดเร็ว โดยใช้เส้นทาง 
ดาวเทียม และที่อยู่ของสถานที่ที่สำคัญในการไปยังสถานที่นั้นๆ
	 11.9 ข้อมูลต่างๆ สามารถแสดงผลบนแผนที่แบบไดนามิค (Dynamic) บนหน้าจอ WebEOC
	 11.10 เป็นเครื่องมือสนับสนุนการตัดสินใจ, วิเคราะห์ และป้องกัน สำหรับ ผบช. และ ฝอ.ในการ
แก้ปัญหาการก่อความรุนแรงใน จชต.
</textarea>
									
							</td>
                          </tr>								  

                      </table>
					  
		<div align="center"><input name="recordbt" type="submit" value="บันทึก" ><input name="cancelbt" type="button" value="ยกเลิก" ></div>
	</div>
	<div id="sidebar">
		<div id="menu">
			<ul>
				<li class="active"><a href="#" title="">หน้าหลัก</a></li>
				<li><a href="#" title="">ติดต่อเรา</a></li>
				<li><a href="images/nakhonnayok.jpg" target="_blank" >แผนที่</a></li>
			</ul>
		</div>
		<div id="updates" class="boxed">
			<h2 class="title"><font size="2" >ข่าวสาร</font></h2>
			<div class="content">
				<ul>
					<li>
						<h3>17 มีนาคม 2556</h3>
						<p><a href="#">หมู่บ้านวังตูม หมู่ที่ ๑ ตำบลเขาพระ อำเภอเมืองนครนายก แต่ดั้งเดิมนั้นเมื่อประมาณ ๑๐๐ กว่าปีที่ผ่านมา คนเฒ่าคนแก่ได้เล่าขานสืบต่อกันมาเมื่อก่อนนั้นพื้นที่บริเวณนี้เป็นลักษณะ&#8230;</a></p>
					</li>
					<li>
						<h3>25 เมษายน 2556</h3>
						<p><a href="#">สภาพทางภูมิศาสตร์ของหมู่บ้านอยู่ทางทิศใต้ของตำบลเขาพระ มีสภาพเป็นที่ราบลุ่มสภาพบ้าน&#8230;</a></p>
					</li>
				</ul>
			</div>
		</div>
		
	</div>
	
	<div style="clear: both;">&nbsp;</div>
</div>
<div id="footer">
	<p id="legal">Copyright &copy; 20013 CDG Core Solution.</p>
	<p id="links"><a href="#">Privacy Policy</a> | <a href="#">Terms of Use</a></p>
</div>
</body>
</html>