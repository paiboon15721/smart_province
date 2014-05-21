<?php
//css include
echo css_asset('accordion3/accordion3.css');
echo css_asset('prettyPhoto.css');
echo css_asset('tablecloth/tablecloth.css');
//js include
echo js_asset('jquery.prettyPhoto.js');
echo js_asset('tablecloth.js');
?>
<script type="text/javascript">

	$(document).ready(function() {
		$("#main_village_detail").fancybox();
		$("#show_ex_headman").fancybox();
		$("#show_ex_SAO").fancybox();
		$("#show_ex_village_committee").fancybox();
		$("#show_ex_fund_village_commitee").fancybox();
		$("#show_ex_project_village_commitee").fancybox();
		$("#show_ex_fund_woman_delegate").fancybox();
		$("#show_ex_project_poor_commitee").fancybox();
		$("#show_ex_fund_queen").fancybox();	
		$("#show_ex_savings_manufacturing_commitee").fancybox();
		$("#show_ex_2k").fancybox();		
		$("#show_orga_public_health_undertake").fancybox();
		$("#show_orga_security_undertake").fancybox();	
		$("#show_orga_dev_community_undertake").fancybox();
		$("#show_orga_livestock_undertake").fancybox();
		$("#show_orga_25_pineapple").fancybox();
		$("#show_orga_red_cross_undertake").fancybox();
		$("#show_orga_mediate_civil_delegate").fancybox();		
		$("#show_orga_farmer").fancybox();	
		$("#show_orga_soil_docter").fancybox();	
		//$("#show_older_older").fancybox();
		$("#show_older_disabled").fancybox();
		$("#show_older_miserable").fancybox();
		$("#show_dp_search_sml").fancybox();
		$("#show_dp_king_project").fancybox();
		$("#show_search_project_1").fancybox();
		$("#show_search_project_2").fancybox();
		$("#show_search_project_3").fancybox();
		$("#show_problem_economy").fancybox();
		$("#show_problem_social").fancybox();
		$("#show_problem_environment").fancybox();
		$("#show_problem_environment").fancybox();
		$("#show_problem_management").fancybox();
		$("#show_problem_stable").fancybox();
		$("#show_pbize_sound_line").fancybox();
		$("#show_service_utilities").fancybox();
		$("#show_service_fee").fancybox();
		$("#show_agri_pledge_rice_55").fancybox();
		$("#show_agri_pledge_rice_56").fancybox();
		$("#show_agri_organic").fancybox();
		$("#show_agri_product_transform").fancybox();
		$("#show_agri_register_farmer_plant,"+
			"#show_agri_register_farmer_livestock,"+
			"#show_agri_register_farmer_fishing,"+
			"#show_older_older"
		).fancybox({'width': '100%','height': '95%','autoScale': false,'type': 'iframe'});

		$("#show_temple_swangArrom").fancybox();


		$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({
			animation_speed : 'fast',
			slideshow : 3000,
			hideflash : true,
			autoplay_slideshow : false,
			social_tools : false
		});

		$('.acc_container').hide();

		$('.acc_trigger4').click(function() {
			if ($(this).next().is(':hidden')) {//If immediate next container is closed...
				$('.acc_trigger4').removeClass('active').next().slideUp();
				//Remove all .acc_trigger classes and slide up the immediate next container
				$(this).toggleClass('active').next().slideDown();
				//Add .acc_trigger class to clicked trigger and slide down the immediate next container
			} else {
				$('.acc_trigger4').removeClass('active').next().slideUp();
			}
			return false;
			//Prevent the browser jump to the link anchor
		});

		$('.acc_trigger3').click(function() {
			if ($(this).next().is(':hidden')) {//If immediate next container is closed...
				$('.acc_trigger3').removeClass('active').next().slideUp();
				//Remove all .acc_trigger classes and slide up the immediate next container
				$(this).toggleClass('active').next().slideDown();
				//Add .acc_trigger class to clicked trigger and slide down the immediate next container
			} else {
				$('.acc_trigger3').removeClass('active').next().slideUp();
			}
			return false;
			//Prevent the browser jump to the link anchor
		});

		$('.acc_trigger2').click(function() {
			var acc_trigger2 =  $(this);
			$.ajax({
				type: "post",
				url: "<?php echo $village; ?>" + "/check_login",
				success: function(data){
					if(data == "0") {
						alert("กรุณา \"เสียบบัตร\" เพื่อเข้าสู่การบันทึกข้อมูล");
						scrollToElement('#content', 500);
					} else {
						if (acc_trigger2.next().is(':hidden')) {//If immediate next container is closed...
							$('.acc_trigger2').removeClass('active').next().slideUp();
							//Remove all .acc_trigger classes and slide up the immediate next container
							acc_trigger2.toggleClass('active').next().slideDown();
							//Add .acc_trigger class to clicked trigger and slide down the immediate next container
						} else {
							$('.acc_trigger2').removeClass('active').next().slideUp();
						}
					}
				}   
			})
			return false;
				//Prevent the browser jump to the link anchor
		});

		$('.acc_trigger').click(function() {
			if ($(this).next().is(':hidden')) {//If immediate next container is closed...
				$('.acc_trigger').removeClass('active').next().slideUp();
				//Remove all .acc_trigger classes and slide up the immediate next container
				$(this).toggleClass('active').next().slideDown();
				//Add .acc_trigger class to clicked trigger and slide down the immediate next container
			} else {
				$('.acc_trigger').removeClass('active').next().slideUp();
			}
			return false;
			//Prevent the browser jump to the link anchor
		});
	});

</script>
	<div id="welcome" class="post">
		<?php echo image_asset($village."_images/head1.jpg", null); ?>
			<div id="image" >
				<ul class="gallery clearfix" style="padding: 0px;">
					<li><?php echo image_anchor($village."_images/fullscreen/mainpic.jpg", array('rel' => 'prettyPhoto[gallery1]'), image_asset($village."_images/fullscreen/mainpic.jpg", null, array('alt' => 'วัด', 'width' => 292, 'height' => 249, 'style' => 'float: left; margin: 0 5px 0 0;'))); ?></li>
					<li><?php echo image_anchor($village."_images/fullscreen/1.jpg", array('rel' => 'prettyPhoto[gallery1]'), image_asset($village."_images/thumbnails/1.jpg", null, array('alt' => 'ศาลากลางจังหวัดนครนายก', 'width' => 60, 'height' => 60))); ?></li>
					<li><?php echo image_anchor($village."_images/fullscreen/2.jpg", array('rel' => 'prettyPhoto[gallery1]'), image_asset($village."_images/thumbnails/2.jpg", null, array('alt' => 'อาคาร', 'width' => 60, 'height' => 60))); ?></li>
					<li><?php echo image_anchor($village."_images/fullscreen/3.jpg", array('rel' => 'prettyPhoto[gallery1]'), image_asset($village."_images/thumbnails/3.jpg", null, array('alt' => 'น้ำตกนางรอง', 'width' => 60, 'height' => 60))); ?></li>
					<li><?php echo image_anchor($village."_images/fullscreen/4.jpg", array('rel' => 'prettyPhoto[gallery1]'), image_asset($village."_images/thumbnails/4.jpg", null, array('alt' => 'น้ำตกนางรอง', 'width' => 60, 'height' => 60))); ?></li>
					<li><?php echo image_anchor($village."_images/fullscreen/5.jpg", array('rel' => 'prettyPhoto[gallery1]'), image_asset($village."_images/thumbnails/5.jpg", null, array('alt' => 'น้ำตกนางรอง', 'width' => 60, 'height' => 60))); ?></li>
					<li><?php echo image_anchor($village."_images/fullscreen/6.jpg", array('rel' => 'prettyPhoto[gallery1]'), image_asset($village."_images/thumbnails/6.jpg", null, array('alt' => 'เขื่อนขุนด่าน', 'width' => 60, 'height' => 60))); ?></li>
					<li><?php echo image_anchor($village."_images/fullscreen/7.jpg", array('rel' => 'prettyPhoto[gallery1]'), image_asset($village."_images/thumbnails/7.jpg", null, array('alt' => 'เขื่อนขุนด่าน', 'width' => 60, 'height' => 60))); ?></li>
					<li><?php echo image_anchor($village."_images/fullscreen/8.jpg", array('rel' => 'prettyPhoto[gallery1]'), image_asset($village."_images/thumbnails/8.jpg", null, array('alt' => 'เขื่อนขุนด่าน', 'width' => 60, 'height' => 60))); ?></li>
					<li><?php echo image_anchor($village."_images/fullscreen/9.jpg", array('rel' => 'prettyPhoto[gallery1]'), image_asset($village."_images/thumbnails/9.jpg", null, array('alt' => 'เขื่อนขุนด่าน', 'width' => 60, 'height' => 60))); ?></li>
					<li><?php echo image_anchor($village."_images/fullscreen/10.jpg", array('rel' => 'prettyPhoto[gallery1]'), image_asset($village."_images/thumbnails/10.jpg", null, array('alt' => 'เขื่อนขุนด่าน', 'width' => 60, 'height' => 60))); ?></li>
					<li><?php echo image_anchor($village."_images/fullscreen/11.jpg", array('rel' => 'prettyPhoto[gallery1]'), image_asset($village."_images/thumbnails/11.jpg", null, array('alt' => 'น้ำตกวังตะไคร้', 'width' => 60, 'height' => 60))); ?></li>
					<li><?php echo image_anchor($village."_images/fullscreen/12.jpg", array('rel' => 'prettyPhoto[gallery1]'), image_asset($village."_images/thumbnails/12.jpg", null, array('alt' => 'ที่พัก โรงแรม', 'width' => 60, 'height' => 60))); ?></li>
					<li><?php echo image_anchor($village."_images/fullscreen/13.jpg", array('rel' => 'prettyPhoto[gallery1]'), image_asset($village."_images/thumbnails/13.jpg", null, array('alt' => 'ที่พัก โรงแรม', 'width' => 60, 'height' => 60))); ?></li>
					<li><?php echo image_anchor($village."_images/fullscreen/14.jpg", array('rel' => 'prettyPhoto[gallery1]'), image_asset($village."_images/thumbnails/14.jpg", null, array('alt' => 'ที่พัก โรงแรม', 'width' => 60, 'height' => 60))); ?></li>
					<li><?php echo image_anchor($village."_images/fullscreen/15.jpg", array('rel' => 'prettyPhoto[gallery1]'), image_asset($village."_images/thumbnails/15.jpg", null, array('alt' => 'ที่พัก โรงแรม', 'width' => 60, 'height' => 60))); ?></li>
					<li><?php echo image_anchor($village."_images/fullscreen/16.jpg", array('rel' => 'prettyPhoto[gallery1]'), image_asset($village."_images/thumbnails/16.jpg", null, array('alt' => 'ที่พัก โรงแรม', 'width' => 60, 'height' => 60))); ?></li>
					<li><?php echo image_anchor($village."_images/fullscreen/17.jpg", array('rel' => 'prettyPhoto[gallery1]'), image_asset($village."_images/thumbnails/17.jpg", null, array('alt' => 'ที่พัก โรงแรม', 'width' => 60, 'height' => 60))); ?></li>
					<li><?php echo image_anchor($village."_images/fullscreen/18.jpg", array('rel' => 'prettyPhoto[gallery1]'), image_asset($village."_images/thumbnails/18.jpg", null, array('alt' => 'น้ำตก', 'width' => 60, 'height' => 60))); ?></li>
					<li><?php echo image_anchor($village."_images/fullscreen/19.jpg", array('rel' => 'prettyPhoto[gallery1]'), image_asset($village."_images/thumbnails/19.jpg", null, array('alt' => 'ก๋วยเตี๋ยวกะลามะพร้าว', 'width' => 60, 'height' => 60))); ?></li>
					<li><?php echo image_anchor($village."_images/fullscreen/20.jpg", array('rel' => 'prettyPhoto[gallery1]'), image_asset($village."_images/thumbnails/20.jpg", null, array('alt' => 'วัดเขาทุเรียน', 'width' => 60, 'height' => 60))); ?></li>
					<li><?php echo image_anchor($village."_images/fullscreen/21.jpg", array('rel' => 'prettyPhoto[gallery1]'), image_asset($village."_images/thumbnails/21.jpg", null, array('alt' => 'วัดเขาทุเรียน', 'width' => 60, 'height' => 60))); ?></li>
					<li><?php echo image_anchor($village."_images/fullscreen/22.jpg", array('rel' => 'prettyPhoto[gallery1]'), image_asset($village."_images/thumbnails/22.jpg", null, array('alt' => 'วัดเขาทุเรียน', 'width' => 60, 'height' => 60))); ?></li>
					<li><?php echo image_anchor($village."_images/fullscreen/23.jpg", array('rel' => 'prettyPhoto[gallery1]'), image_asset($village."_images/thumbnails/23.jpg", null, array('alt' => 'ที่พัก โรงแรม', 'width' => 60, 'height' => 60))); ?></li>
					<li><?php echo image_anchor($village."_images/fullscreen/24.jpg", array('rel' => 'prettyPhoto[gallery1]'), image_asset($village."_images/thumbnails/24.jpg", null, array('alt' => 'ที่พัก โรงแรม', 'width' => 60, 'height' => 60))); ?></li>
					<li><?php echo image_anchor($village."_images/fullscreen/25.jpg", array('rel' => 'prettyPhoto[gallery1]'), image_asset($village."_images/thumbnails/25.jpg", null, array('alt' => 'ที่พัก โรงแรม', 'width' => 60, 'height' => 60))); ?></li>
					<li><?php echo image_anchor($village."_images/fullscreen/26.jpg", array('rel' => 'prettyPhoto[gallery1]'), image_asset($village."_images/thumbnails/26.jpg", null, array('alt' => 'ที่พัก โรงแรม', 'width' => 60, 'height' => 60))); ?></li>
					<li><?php echo image_anchor($village."_images/fullscreen/27.jpg", array('rel' => 'prettyPhoto[gallery1]'), image_asset($village."_images/thumbnails/27.jpg", null, array('alt' => 'ที่พัก โรงแรม', 'width' => 60, 'height' => 60))); ?></li>
					<li><?php echo image_anchor($village."_images/fullscreen/28.jpg", array('rel' => 'prettyPhoto[gallery1]'), image_asset($village."_images/thumbnails/28.jpg", null, array('alt' => 'ที่พัก โรงแรม', 'width' => 60, 'height' => 60))); ?></li>
				</ul>
			</div>
			<?php echo image_asset($village."_images/head2.jpg", null); ?>
			<div class="content">
				<strong>ประวัติหมู่บ้าน</strong>
				<p style="text-indent:0.5in"> 
					<?php echo $historyOfTheVillage; ?>
				</p>
				<strong>สภาพทางภูมิศาสตร์</strong>
				<p style="text-indent:0.5in">
					<?php echo $geography; ?> <a id="main_village_detail" href="<?php echo $pathLoadPage; ?>/main_village_detail">อ่านต่อ...</a>
				</p>
			</div>
		</div>
		<div id="example" class="post" style="border-bottom: 0px;">


			<div class="content">

				<?php echo image_asset('head5.jpg', null, array('id' => 'menu1')); ?>
				<div class="container">	
					<h2 class="acc_trigger"><a href="#">ทำเนียบผู้บริหาร</a></h2>
					<div class="acc_container">
						<ol>
						  <li>
							 ด้านการเมือง/การปกครอง
							<ul>
							  <li><a id="show_ex_headman" href="<?php echo $pathLoadPage; ?>/show_ex_headman">ผู้ใหญ่บ้าน/ผู้ช่วยผู้ใหญ่บ้าน</a></li>
							  <li><a id="show_ex_SAO" href="<?php echo $pathLoadPage; ?>/show_ex_SAO">สมาชิกสภาท้องถิ่น (เทศบาล/อบต.) ประจำหมู่บ้าน</a></li>
							</ul>
						  </li>
						  <li><a id="show_ex_village_committee" href="<?php echo $pathLoadPage; ?>/show_ex_village_committee">คณะกรรมการหมู่บ้าน</a></li>
						  <li><a id="show_ex_fund_village_commitee" href="<?php echo $pathLoadPage; ?>/show_ex_fund_village_commitee">คณะกรรมการกองทุนหมู่บ้านและชุมชนเมือง (กบท.)</a></li>
						  <li><a id="show_ex_project_village_commitee" href="<?php echo $pathLoadPage; ?>/show_ex_project_village_commitee">คณะกรรมการโครงการหมู่บ้านและชุมชนเมือง (SML)</a></li>
						  <li><a id="show_ex_fund_woman_delegate" href="<?php echo $pathLoadPage; ?>/show_ex_fund_woman_delegate">ผู้แทนกองทุนพัฒนาบทบาทสตรีประจำหมู่บ้าน</a></li>
						  <li>คณะกรรมการพัฒนาสตรีหมู่บ้าน (กพสต.)</li>
						  <li><a id="show_ex_project_poor_commitee" href="<?php echo $pathLoadPage; ?>/show_ex_project_poor_commitee">คณะกรรมการโครงการแก้ไขปัญหาความยากจน (กข.คจ.)</a></li>
						  <li><a id="show_ex_fund_queen" href="<?php echo $pathLoadPage; ?>/show_ex_fund_queen">กองทุนแม่ของแผ่นดิน</a></li>
						  <li><a id="show_ex_savings_manufacturing_commitee" href="<?php echo $pathLoadPage; ?>/show_ex_savings_manufacturing_commitee">คณะกรรมการกลุ่มออมทรัพย์เพื่อการผลิต</a></li>
						  <li><a id="show_ex_2k" href="<?php echo $pathLoadPage; ?>/show_ex_2k">ข้อมูลจปฐ/กชช2ค.</a></li>
						</ol>
					</div>
					<h2 class="acc_trigger"><a href="#">กลุ่มองค์กรต่างๆ</a></h2>
					<div class="acc_container">
						<ol>
							<li><a id="show_orga_public_health_undertake" href="<?php echo $pathLoadPage; ?>/show_orga_public_health_undertake">อาสาสมัครสาธารณสุขประจำหมู่บ้าน (อสม.)</a></li>
							<li><a id="show_orga_security_undertake" href="<?php echo $pathLoadPage; ?>/show_orga_security_undertake">อาสาสมัครป้องกันภัยฝ่ายพลเรือน (อปพร.)</a></li>
							<li><a id="show_orga_dev_community_undertake" href="<?php echo $pathLoadPage; ?>/show_orga_dev_community_undertake">อาสาพัฒนาชุมชนประจำหมู่บ้าน (อช.)</a></li>
							<li><a id="show_orga_livestock_undertake" href="<?php echo $pathLoadPage; ?>/show_orga_livestock_undertake">อาสาปศุสัตว์ (อศ.)</a></li>
							<li><a id="show_orga_25_pineapple" href="<?php echo $pathLoadPage; ?>/show_orga_25_pineapple">25 ตาสับปะรด</a></li>
							<li><a id="show_orga_red_cross_undertake" href="<?php echo $pathLoadPage; ?>/show_orga_red_cross_undertake">อาสากาชาด</a></li>
							<li><a id="show_orga_mediate_civil_delegate" href="<?php echo $pathLoadPage; ?>/show_orga_mediate_civil_delegate">ผู้แทนผู้ไกล่เกลี่ยและประนอมข้อพิพาททางแพ่ง</a></li>
							<li><a id="show_orga_farmer" href="<?php echo $pathLoadPage; ?>/show_orga_farmer">อาสาสมัครเกษตร (อกม.)</a></li>
							<li><a id="show_orga_soil_docter" href="<?php echo $pathLoadPage; ?>/show_orga_soil_docter">หมอดินอาสา</a></li>
						</ol>
					</div>
					<h2 class="acc_trigger"><a href="#">กลุ่มผู้สูงอายุและผู้พิการ</a></h2>
					<div class="acc_container">
						<ol>
							<!--<li><a id="show_older_older" href="<?php echo $pathLoadPage; ?>/show_older_older">ผู้สูงอายุ</a></li>
							<li><a id="show_older_disabled" href="<?php echo $pathLoadPage; ?>/show_older_disabled">ผู้พิการ</a></li>
							<li><a id="show_older_miserable" href="<?php echo $pathLoadPage; ?>/show_older_miserable">ผู้ยากไร้</a></li>-->
							<li>ผู้สูงอายุ</li>
							<li>ผู้พิการ</li>
							<li>ผู้ยากไร้</li>
						</ol>
					</div>
					<h2 class="acc_trigger"><a href="#">กลุ่มอาชีพและกลุ่มวิสาหกิจชุมชน</a></h2>
					<div class="acc_container">
						<ol>
							<li>วิสาหกิจชุมชนศูนย์ส่งเสริมและผลิตพันธุ์ข้าวชุมชน หมู่ที่ 4 ตำบลองครักษ์
								<ul>
									<li>ที่อยู่ 20/3 หมู่ 4 ตำบลองครักษ์ อำเภอองครักษ์ จังหวัดนครนายก </li>
									<li>จำนวนสมาชิก 26</li>
									<li>ประเภทกิจกรรม ผลิตปัจจัยการผลิต</li>
									<li>ผลิตภัณฑ์ ข้าว</li>
								</ul>
							</li>
							<li>วิสาหกิจชุมชนกลุ่มผู้ผลิตตุ๊กตาเรซินองครักษ์
								<ul>
									<li>ที่อยู่ 55/5 หมู่ 7 ตำบลองครักษ์ อำเภอองครักษ์ จังหวัดนครนายก</li>
									<li>จำนวนสมาชิก 17 คน</li>
									<li>ประเภทการผลิต เครื่องปั้น</li>
									<li>ผลิตภัณฑ์ ตุ๊กตาเรซิน</li>
								</ul>
							</li>
						</ol>
					</div>
					<h2 class="acc_trigger"><a href="#">สภาพปัญหา/สาเหตุ/แนวทางการแก้ไขปัญหาต่างๆ ภายในหมู่บ้าน</a></h2>
					<div class="acc_container">
						<ol>
							<li><a id="show_problem_economy" href="<?php echo $pathLoadPage; ?>/show_problem_economy">ปัญหาด้านเศรษฐกิจ</a></li>
							<li><a id="show_problem_social" href="<?php echo $pathLoadPage; ?>/show_problem_social">ปัญหาด้านสังคม</a></li>
							<li><a id="show_problem_environment" href="<?php echo $pathLoadPage; ?>/show_problem_environment">ปัญหาด้านทรัพยากรธรรมชาติและสิ่งแวดล้อม</a></li>
							<li><a id="show_problem_management" href="<?php echo $pathLoadPage; ?>/show_problem_management">ปัญหาด้านการบริหารจัดการ</a></li>
							<li><a id="show_problem_stable" href="<?php echo $pathLoadPage; ?>/show_problem_stable">ปัญหาด้านความมั่นคง</a></li>
						</ol>
					</div>
					<h2 class="acc_trigger"><a href="#">แผนงานและโครงการต่างๆ</a></h2>
					<div class="acc_container">
						<ol>
							<li><a id="show_search_project_1" href="<?php echo $pathLoadPage; ?>/show_search_project/1">ลักษณะโครงการที่ ๑ หมู่บ้านดำเนินการเอง</a></li>
							<li><a id="show_search_project_2" href="<?php echo $pathLoadPage; ?>/show_search_project/2">ลักษณะโครงการที่ ๒ ขอรับการช่วยเหลือ จากส่วนราชการบางส่วน</a></li>
							<li><a id="show_search_project_3" href="<?php echo $pathLoadPage; ?>/show_search_project/3">ลักษณะโครงการที่ ๓ ขอรับการสนับสนุนงบประมาณทั้งหมด</a></li>
						</ol>
					</div>
					<h2 class="acc_trigger"><a href="#">โครงการพัฒนาที่ดำเนินการภายในหมู่บ้าน</a></h2>
					<div class="acc_container">
						<ol>
							<li><a id="show_dp_search_sml" href="<?php echo $pathLoadPage; ?>/show_dp_search_sml">SML</a></li>
							<li>กบท.</a></li>
							<li>พัฒนาบทบาทสตรี</li>
							<li>กองทุนแม่ของแผ่นดิน</li>
							<li><a id="show_dp_king_project" href="<?php echo $pathLoadPage; ?>/show_dp_king_project">โครงการพระราชดำริ</a></li>
						</ol>
					</div>
					<h2 class="acc_trigger"><a href="#">ข้อมูลเกษตรกร</a></h2>
					<div class="acc_container">
						<ol>
							<li>ทะเบียนเกษตรกร
								<ul>
									<li><a id="show_agri_register_farmer_plant" href="<?php echo $pathLoadPage; ?>/show_agri_register_farmer_plant">พืช</a></li>
									<li><a id="show_agri_register_farmer_fishing" href="<?php echo $pathLoadPage; ?>/show_agri_register_farmer_fishing">ประมง</a></li>
									<li><a id="show_agri_register_farmer_livestock" href="<?php echo $pathLoadPage; ?>/show_agri_register_farmer_livestock">ปศุสัตว์</a></li>
								</ul>
							</li>
							<li>ข้อมูลการรับจำนำข้าว
								<ul>
									<li><a id="show_agri_pledge_rice_55" href="<?php echo $pathLoadPage; ?>/show_agri_pledge_rice_55">โครงการรับจำนำข้าวเปลือก ปีการผลิต 55/2554</a></li>
									<li><a id="show_agri_pledge_rice_56" href="<?php echo $pathLoadPage; ?>/show_agri_pledge_rice_56">โครงการรับจำนำข้าวเปลือก ปีการผลิต 56/2555</a></li>
								</ul>							
							</li>
							<li><a id="show_agri_organic" href="<?php echo $pathLoadPage; ?>/show_agri_organic">ข้อมูลเกษตรอินทรีย์</a></li>
							<li>การบริหารจัดการด้านการตลาด</li>
							<li>การชดเชยค่าเสียหาย</li>
							<li>ข้อมูลอุปสงค์/อุปทาน</li>
							<li><a id="show_agri_product_transform" href="<?php echo $pathLoadPage; ?>/show_agri_product_transform">ข้อมูลสินค้าเกษตร/แปรรูป</a></li>
							<li>การจัด zoneing</li>
						</ol>
					</div>
					<h2 class="acc_trigger"><a href="#">ข้อมูล OTOP และการท่องเที่ยว</a></h2>
					<div class="acc_container">
						<ol>
							<li>ข้อมูล OTOP</li>
							<li>ข้อมูลการท่องเที่ยว</li>
						</ol>
					</div>
					<h2 class="acc_trigger"><a href="#">ข้อมูลการลงประชามติ</a></h2>
					<div class="acc_container">
						<ol>
							<li><a href="<?php echo $pathViewRootFolder; ?>poll" target="_blank">การลงประชามติ</a></li>
						</ol>
					</div>
					<h2 class="acc_trigger"><a href="#">การประชาสัมพันธ์จากจังหวัดในการแจ้งประชาสัมพันธ์เสียงตามสาย</a></h2>
					<div class="acc_container">
						<ol>
							<li><a id="show_pbize_sound_line" href="<?php echo $pathLoadPage; ?>/show_pbize_sound_line">การประชาสัมพันธ์จากจังหวัดในการแจ้งประชาสัมพันธ์เสียงตามสาย</a></li>
						</ol>	
					</div>
					<h2 class="acc_trigger"><a href="#">การรายงานเหตุการณ์ประจำวัน</a></h2>
					<div class="acc_container">
						<ol>
							<li><a href="<?php echo $pathViewRootFolder; ?>EReport/write_cookie.php?flg=4" target="_blank">รายงานเหตุการณ์ประจำวัน</a></li>
						</ol>				
					</div>
					<h2 class="acc_trigger"><a href="#">ข้อมูลวัด</a></h2>
					<div class="acc_container">
						<ol>
							<li><a id="show_temple_swangArrom" href="<?php echo $pathLoadPage; ?>/show_temple_swangArrom">วัดสว่างอารมณ์</a></li>
						</ol>	
					</div>
				</div>
			</div>
				<?php echo image_asset('head3.jpg', null, array('id' => 'menu2')); ?>
				<div class="container">
					<h2 class="acc_trigger3"><a href="#">ระบบการบริการทางด้านการทะเบียน</a></h2>
					<div class="acc_container">
						<ol>
							<li>
								<a href="http://iservices.dopa.go.th">การบริการงานด้านการทะเบียน</a>
								<ul>
									<li>
										ทะเบียนราษฎร
										<ul>
											<li>คัดและรับรองสำเนา</li>
											<li>แจ้งปลูกสร้างบ้านใหม่</li>
											<li>แจ้งย้าย</li>
											<li>แจ้งเกิด</li>
											<li>แจ้งตาย</li>
											<li>แจ้งจำหน่ายและเปลี่ยนแปลงรายการบ้าน</li>
										</ul>
									</li>
									<li>
										บัตรประชาชน
										<ul>
											<li>คัดและรับรองสำเนารายการ</li>
											<li>แจ้งบัตรหาย</li>
											<li>ปรับปรุงรายการในบัตร</li>
											<li>ขอ PINCODE</li>
										</ul>
									</li>
									<li>
										ทะเบียนเลือกตั้ง.
										<ul>
											<li>ตรวจสอบการใช้สิทธิ์เลือกตั้ง</li>
											<li>ลงทะเบียนใช้สิทธิ์นอกท้องที่</li>
											<li>ลงทะเบียนใช้สิทธิ์ล่วงหน้า</li>
										</ul>
									</li>
								</ul>
								<li>
									<a href="<?php echo $pathViewRootFolder; ?>Nayok_stat/chk_stat.php" target="_blank">การบริการข้อมูลสถิติทางการทะเบียน</a>
									<ul>
										<li>
											ข้อมูลสถิติเกี่ยวกับประชากรและบ้าน
										</li>
									</ul>
								</li>
							</li>
						</ol>
					</div>
					<h2 class="acc_trigger3"><a href="#">ระบบบริการชำระค่าสาธารณูปโภค</a></h2>
					<div class="acc_container">
						<ol>
								<li><a id="show_service_utilities" href="<?php echo $pathLoadPage; ?>/show_service_utilities">ระบบบริการชำระค่าสาธารณูปโภค</a></li>
						</ol>
					</div>
					<h2 class="acc_trigger3"><a href="#">ระบบบริการชำระค่าธรรมเนียมอื่นๆ</a></h2>
					<div class="acc_container">
						<ol>
								<li><a id="show_service_fee" href="<?php echo $pathLoadPage; ?>/show_service_fee">ระบบบริการชำระค่าธรรมเนียมอื่นๆ</a></li>
						</ol>
					</div>
				</div>

				<?php echo image_asset('head6.jpg', null, array('id' => 'menu3')); ?>
				<div class="container">
					<h2 class="acc_trigger4"><a href="#">ระบบการประชุมทางไกล</a></h2>
					<div class="acc_container">
						<ol>
								<li><a href="http://meeting.dopa.go.th" target="_blank" >ระบบการประชุมทางไกล</a></li>
						</ol>
					</div>
					<h2 class="acc_trigger4"><a href="#">ระบบการประชุมไร้เอกสาร</a></h2>
					<div class="acc_container">
						<ol>
								<li><a href="http://nymeeting.dopa.go.th/" target="_blank" >ระบบการประชุมไร้เอกสาร</a></li>
						</ol>
					</div>
					<h2 class="acc_trigger4"><a href="#">GIS</a></h2>
					<div class="acc_container">
						<ol>
								<li><a href="http://nakhonnayok.ecarteis.com/" target="_blank" >ระบบข้อมูลข่าวสารทางไกล (GIS)</a></li>
						</ol>
					</div>
					<h2 class="acc_trigger4"><a href="#">ระบบรายงานเหตุการณ์</a></h2>
					<div class="acc_container">
						<ol>
								<li><a href="<?php echo $pathViewRootFolder; ?>EReport/write_cookie.php?flg=4" target="_blank">รายงานเหตุการณ์ประจำวัน</a></li>
						</ol>
					</div>
				</div>

				<?php echo image_asset('head4.jpg', null, array('id' => 'menu4')); ?>
				<div class="container">
					<h2 class="acc_trigger2"><a href="#">ระบบข้อมูลทะเบียนรายการบุคคล</a></h2>
					<div class="acc_container">
						<ol>
							<li>
								<a href="<?php echo $pathViewRootFolder; ?>ors/search_pop.php" target="_blank" >ระบบข้อมูลทะเบียนรายการบุคคล</a>
							</li>
						</ol>
					</div>
					<h2 class="acc_trigger2"><a href="#">ระบบการบันทึกการขึ้นทะเบียนเกษตรกร</a></h2>
					<div class="acc_container">
						<ol>
							<li>
								<a href="http://www.thaismartfarmer.net" target="_blank" >การบันทึกข้อมูลเกษตรกร</a>
							</li>
						</ol>
					</div>
					<h2 class="acc_trigger2"><a href="#">ระบบการบันทึกข้อมูล ศูนย์ข้อมูลและบริการหมู่บ้าน (ศขบ.)</a></h2>
					<div class="acc_container">
						<ol>
						<strong>งานตามหน้าที่</strong>
							<li>
								<a href="<?php echo $pathViewRootFolder; ?>EReport/write_cookie.php?flg=1" target="_blank">ลงทะเบียนผู้ใช้งานระบบ</a>
							</li>
							<li>
								<a href="<?php echo $pathViewRootFolder; ?>EReport/write_cookie.php?flg=2" target="_blank">แก้ไขผู้ใช้งานระบบ</a>
							</li>
							<li>
								<a href="<?php echo $pathViewRootFolder; ?>EReport/write_cookie.php?flg=3" target="_blank">การบันทึกข้อมูลการปฏิบัติงานเข้า – ออกและบันทึกเหตุการณ์ประจำวัน</a>
							</li>
							<li>
								<a href="<?php echo $pathLoadPage; ?>/record_add_committee" target="_blank" >การบันทึกข้อมูลคณะกรรมการหมู่บ้าน</a>
							</li>
							<li>
								<a href="<?php echo $pathLoadPage; ?>/record_show_member_form" >การบันทึกข้อมูลสมาชิกองค์กรต่างๆ</a>
								<ul>
									<li>
										<a href="<?php echo $pathLoadPage; ?>/record_show_groups_form" >การบันทึกข้อมูลองค์กร</a>
									</li>
									<li>
										<a href="<?php echo $pathLoadPage; ?>/record_show_group_position_form" >การบันทึกข้อมูลตำแหน่ง</a>
									</li>
								</ul>
							</li>
							<li>
								<a href="<?php echo $pathLoadPage; ?>/record_add_project" target="_blank" >การบันทึกข้อมูลแผนงานและโครงการ</a>
							</li>
							<li>
								การบันทึกสภาพปัญหา/สาเหตุ/แนวทางการแก้ไขปัญหาต่างๆ ภายในหมู่บ้าน
							</li>
							<li>การบันทึกรายละเอียดข้อมูลโครงการที่ดำเนินการแล้วในพื้นที่
								<ul>
									<li>
										การบันทึกรายละเอียดข้อมูลกองทุนหมู่บ้านและชุมชนเมือง (กบท.)
									</li>
									<li>
										การบันทึกรายละเอียดข้อมูลกองทุนหมู่บ้านและชุมชนเมือง (SML)
									</li>
									<li>
										การบันทึกรายละเอียดข้อมูลกองทุนพัฒนาบทบาทสตรี
									</li>
									<li>
										การบันทึกรายละเอียดข้อมูลโครงการแม่ของแผ่นดิน
									</li>
									<li>
										การบันทึกรายละเอียดข้อมูลโครงการพระราชดำริ
									</li>
								</ul>
							</li>
							<li>
								การบันทึกข้อมูล OTOP และการท่องเที่ยว
							</li>
							<li>
								<a href="<?php echo $pathViewRootFolder; ?>poll/mainmenu.php" target="_blank">บันทึกข้อมูลเกี่ยวกับข้อมูลการลงประชามติ</a>
							</li>
						</ol>
						<ol>
							<strong>งานของส่วนราชการอื่นๆ</strong>
							<li>
								การบันทึกข้อมูลสมาชิก
								<ul>
									<li>
										ข้อมูลกองทุนพัฒนาบทบาทสตรี
									</li>
									<li>
										ข้อมูลสมาชิกกองทุนแม่ของแผ่นดิน
									</li>
								</ul>
							</li>
						</ol>
					</div>
				</div>

		</div>