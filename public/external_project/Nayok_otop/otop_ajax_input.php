<?php include "include/otop_func.php";
	session_start();

	$ccaattmm=$_SESSION['catm_login'];
//	$ccaattmm=26020100;
	$emp_id=$_SESSION['EMPID'];
	$emp_name = $_SESSION['EMPNAME'];
	$emp_village = $_SESSION['catm_description'];
	echo "EMPID[$emp_id]"; 
	
	
 
 ?>
 <script> //alert("state_type ="+state_type);</script>
 <div id ="ajax_input">
						<div id="information" class="info_info" >
						  <div id="inner_info"></div>
						</div>

						<div class="inner">
							<div class ="first">
								เลือกประเภทสินค้า :
							</div>
							<div class="second">
								<select id="otop_type" style="padding-left:3px; text-align:center;">
									<?php val_option();?>
								</select>
							</div>
						</div>
					
						
						<div class="inner">
							<div  class="first">
								ชื่อสินค้า :
							</div>
							<div class="second">
								<input id="otop_name" type="text">				
							</div>
						</div>
						
						<div class="inner">
							<div  class="first">
								ชื่อกลุ่มผู้ผลิต / ชื่อบริษัทผู้ผลิต :
							</div>
							<div class="second">
								<input  id="otop_group" type="text">				
							</div>
						</div>
						
						<div class="inner">
							<div  class="first">
								จำนวนดาวของสินค้า :
							</div>
							<div class="second">
								<div class="rating" data-rating="0"  >
									<div id="remove" style='float:left; width:16px; margin:0px 1px 0px 1px; background-image:url("images/rate_delete.gif"); display:inline-block;'></div>
									<div id="star1" style='	float:left; width:16px; margin:0px 1px 0px 1px;' ></div>
									<div id="star2" style='	float:left; width:16px; margin:0px 1px 0px 1px;' ></div>
									<div id="star3" style='	float:left; width:16px; margin:0px 1px 0px 1px;' ></div>
									<div id="star4" style='	float:left; width:16px; margin:0px 1px 0px 1px;' ></div>
									<div id="star5" style='	float:left; width:16px; margin:0px 1px 0px 1px;' ></div>
								</div>
								<div id="info" style='display:none;' ></div>
							</div>
							
							
						</div>
						
						<div class="inner">
							<div  class="first">
								คำอธิบายสินค้า :
							</div>
							<div class="second">
								<textarea rows="3" cols="35" id="otop_detail"></textarea>
							</div>
						</div>

						<div class="inner">
							<div class="bar"></div>
						</div>
						
						<div class="inner">
							<div  class="first">
								ชื่อผู้ขายสินค้าหรือตัวแทนกลุ่มผู้ผลิต :
							</div>
							<div class="second">
								<input id="contract_name" type="text">
							</div>
						</div>

						<div class="inner"> 
							<div  class="first">
								เบอร์โทรศัพท์ผู้ขายสินค้า :
							</div>
							<div class="second">
								<input id="contract_tel" type="text" maxlength="10">
							</div>
						</div>
						
						<div class="inner" style="">
							<div  class="first">
								ที่อยู่ผู้ขายสินค้า :
							</div>
							<div class="second" style="vertical-align:text-top; ">
								<textarea rows="3" cols="35" id="contract_addr"></textarea>
							</div>
						</div>
						
						<div class="inner">
							<div  class="first">
								รูปสินค้า :
							</div>
							<div class="second">
								<form id="imageform" enctype="multipart/form-data" >
									<input type="file" name="photoimg" id="photoimg" >
									<input type="hidden" id="ccaattmm" name="ccaattmm" value="<?php echo $ccaattmm; ?>">
									<input type="hidden" id="emp_id" name="emp_id" value="<?php echo $emp_id; ?>">
								</form>
							</div>
						</div>
						
						<div class="inner">
							<div>
								<div id='preview'>
									<!--<img id='showImg' src='images/logo_otop.png' height="50" width="50"  class='preview'>-->
								</div>
							</div>
						</div>
						
						<div class="water_mark"></div>
						
						<div class="free_space">
						</div>
						<div>
							<span><input type="button" id="submit_btn" value="บันทึก" ></span>
						</div>
	</div> <!-- end ajax input -->						
<script src="lib/js/jquery-1.9.0.min.js" type="text/javascript"></script>
<script src="ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="js/otop_main.js" type="text/javascript"></script>
<script src="js/send_data.js" type="text/javascript"></script>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/jquery.form.js" type="text/javascript"></script>
<script type="text/javascript" src="plugin/fancy-box/jquery.fancybox.js?v=2.1.5"></script>
<script>
		var star_rate;
		function ShowRating($element, rating){

			$stars = $element.find('div');
			$stars.removeClass('selected highlighted');
			rating = parseInt(rating);
			
			if(rating < 1 || rating > $stars.length) return false;
			$stars.eq(rating-1).addClass('selected')
				.prevAll().addClass('highlighted');
				$('#remove').addClass('unrate');
				$('#remove').removeClass('highlighted');
				$('#remove').removeClass('rating');
				$('#remove').removeClass('selected');
			return true;
		}

			$('.rating').each(function(){
				if($(this).index()!=0){
					var $this = $(this);
					ShowRating($this, $this.data('rating'));
				}	
			}).bind({
				mouseleave: function(){
					var $this = $(this);
					ShowRating($this, $this.data('rating'));
				}
			}).find('div').bind({
				mouseenter: function(){
					var $this = $(this);
					ShowRating($this.parent(), $this.index() + 1);
				},
				click: function(){
					var $this = $(this);
					var $parent = $this.parent();
					var idx = $this.index() + 1;
					if($parent.data('rating') == idx){
						// Remove rating
						ShowRating($parent, 0);
						$parent.data('rating', 1);
					} else {
						// Set rating
						ShowRating($parent, idx);
						$parent.data('rating', idx);
					}

					$('#star_rate').val($parent.data('rating')-1);
			
				}
		});
		

	
</script>

		
</script>