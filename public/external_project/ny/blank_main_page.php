<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=9" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>ศูนย์ข้อมูลบริการหมู่บ้าน (ศขบ.)</title>
<?php 
//css include
echo css_asset('main_smart_province.css'); 
echo css_asset('fancybox/jquery.fancybox-1.3.4.css');
echo css_asset('ui.totop.css');
//js include
echo js_asset('jquery-1.7.2.min.js');
echo js_asset('jquery.fancybox-1.3.4.pack.js');

echo js_asset('jquery.ui.totop.min.js');
echo js_asset('easing.js');
?>

<script type="text/javascript">

	$(document).ready(function() {	
		$().UItoTop({ easingType: 'easeOutQuart' });
	});

	var checkLogin = true;
	function openLoginPage() {
		/*สำหรับ demo
		if (!checkLogin) {
			$.fancybox({
				'href' : path + "/login?data=" + path
			});
		} else {
			if(confirm('ยืนยันการออกจากระบบ') == true) {
				$("#btnReadCard").attr('value', 'อ่านบัตร');
				$("#superuser").html("");
				checkLogin = !checkLogin;
				$('.acc_container').hide();
			}
		}
	*/
		window.location = "<?php echo $pathViewRootFolder; ?>" + "signin/signin.application?ACT_FLAG='"+ "<?php echo $pathLoadPage; ?>" + "/write_session'&ACT_FLAG_CANCEL=";
		window.open('','_self');
		setTimeout(function(){window.close();}, 2000);
	}

	function logout() {
		if(confirm('ยืนยันการออกจากระบบ') == true) {
			$.ajax({
				type: "post",
				url: "<?php echo $pathLoadPage; ?>" + "/logout",
				success: function(){
					window.location = "<?php echo $village; ?>";
				}    
			})
		}
	}

	function scrollToElement(selector, time, verticalOffset) {
		time = typeof(time) != 'undefined' ? time : 500;
		verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
		element = $(selector);
		offset = element.offset();
		offsetTop = offset.top + verticalOffset;
		$('html, body').animate({
			scrollTop: offsetTop
		}, time);
	}

</script>
</head>
<body>
<div id="header" style="background: url(<?php echo $pathBanner; ?>);">
</div>
<div id="page">
	<div id="content" >
		<?php echo $content; ?>
	</div>
	<div id="sidebar">

		<div id="menu">
			<?php echo $menu; ?>
		</div>
		<div id="login" class="boxed">
			<h2 class="title"><font size="1" >ระบบการบันทึกข้อมูลเพื่อการบริหาร</font></h2>
			<div class="content" style="text-align:center;" >
			<?php if (@$_SESSION['EMPID'] == '' || ! isset($_SESSION['EMPID'])): ?>
				<?php echo image_asset('card.gif',null,array('width'=>168,'height'=>150)); ?>
				<input id="btnReadCard" name="btnReadCard" type="button" value="อ่านบัตร" style="width:100px; height: 30px; float: none;" onclick="openLoginPage();" />	
			<?php else: ?>
				<font color='blue'><?php echo 'ยินดีต้อนรับ<br />'.$_SESSION['EMPNAME']; ?></font>
				<br />
				<br />
				<input id="btnLogout" name="btnLogout" type="button" value="ออกจากระบบ" style="width:100px; height: 30px;" onclick="logout();" />
			<?php endif; ?>
			</div>
		</div>
		<div id="updates" class="boxed">
			<h2 class="title"><font size="2" >ข่าวสาร</font></h2>
			<div class="content">
				<ul>
					<?php echo $message; ?>
				</ul>
			</div>
		</div>

	</div>
	<div style="clear: both;">&nbsp;</div>
</div>
<div id="footer">
	<p id="legal">Copyright &copy; 2013 CDG Core Solution.</p>
	<p id="links"><a href="#">Privacy Policy</a> | <a href="#">Terms of Use</a></p>
</div>
</body>
</html>