

<?php
	/////////// delete record ////////////
	include "./include/func.php";
	include "./include/connect_db.php";
	
	$otop_id = $_GET['otop_id'];
	$pic_name = $_GET['pic_name'];
	echo "pic_name[$pic_name]";
		if(!$condb)	{
		   echo "�������ö�Դ��Ͱҹ��������";
			}else{
				if(!mysql_select_db($dbname,$condb) ){
					echo "�������ö�Դ��� Database ��";
					}else{
						//echo "�Դ��� Database ���º����";
						$delSQL="DELETE FROM tab_otop where otop_id = $otop_id";
						mysql_query("set character set tis620");
						$objQuery = mysql_query($delSQL);
							if(mysql_query($objQuery)){
								echo "remove unsuccess";
								}else	if($pic_name!=""){
										unlink("uploads/use/$pic_name");
									}else{
										echo "remove success";
									}
								}
								
					}
		
?>
