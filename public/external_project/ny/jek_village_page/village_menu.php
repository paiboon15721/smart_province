			<ul>
				<!--class active-->
				<li><a href="<?php echo $baseUrl; ?>" title="">กลับไปหน้าเมนู</a></li>
				<li><a href="<?php echo $pathLoadPage; ?>" title="">หน้าหลัก</a></li>
				<?php if (isset($main)): ?>
					<li><a href="javascript:scrollToElement('#menu1', 500);" title="">ระบบข้อมูลหมู่บ้าน</a></li>
					<li><a href="javascript:scrollToElement('#menu2', 600);" title="">ระบบการบริการด้านต่างๆ</a></li>
					<li><a href="javascript:scrollToElement('#menu3', 700);" title="">ระบบงานทั่วไป</a></li>
					<li><a href="javascript:scrollToElement('#menu4', 1000);" title="">ระบบการบันทึกข้อมูล</a></li>
				<?php endif; ?>
				<li><a href="<?php echo $pathLoadPage; ?>/show_contact_us" >ติดต่อเรา</a></li>
				<li><a href="<?php echo $pathLoadPage; ?>/show_map" >แผนที่</a></li>
			</ul>