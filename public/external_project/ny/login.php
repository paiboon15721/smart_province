<?php
	$pathPage = $_GET['data'];
?>

<script type="text/javascript">

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

	function login(path){
		var btnReadCard = $("#btnReadCard").val();
		if($("#textbox_pwd").val() != "12345") {
			alert("รหัสผ่านผิดพลาด!!");
			$("#textbox_pwd").val("");
			$("#textbox_pwd").focus();
			return false;
		}
		if (btnReadCard == "อ่านบัตร") {
			$("#btnReadCard").attr('value','ออกจากระบบ');
			/*$.post(path + "/superuser" ,function(msg){
				$("#superuser").html(msg);
				scrollToElement('#superuser', 500);
			});*/
			checkLogin = !checkLogin;
			$.fancybox.close();
		}
	}

</script>

<div id="contentpopup">
<div id="welcome" class="post" style="border-bottom: 0px">
<h1 class="title" style="border-bottom: 1px solid #3B3B3B; padding-bottom: 10px">กรุณาใส่รหัสผ่าน</h1>
	<p>
			<table cellspacing="0" cellpadding="0">
			<tr>
				<th class="center" width="200px"></th>
                <th class="center" width="250px"></th>
			</tr>
			<tr>
				<td>ชื่อเจ้าของบัตร</td>
                <td>นายฉัตรชัย บำรุงกิจ</td>
			</tr>
			<tr>
				<td>รหัสผ่าน:</td>
                <td><input type="password" name="textbox_pwd" id="textbox_pwd" size="20" autocomplete=off value="" maxlength="5" /></td>
			</tr>	
			<tr>
				<td class="center" colspan="2"><input class="btnLogin" id="btnLogin" name="btnLogin" type="button" value="ตกลง" style="width:100px; height: 30px;" onclick="login('<?php echo $pathPage; ?>')" />	</td>
			</tr>			
		</table>	
	</p>
</div>
</div>