<?php
function val_option(){
	include "connect_db.php";
	
		if(!$condb)	{
		   echo "ไม่สามารถติดต่อฐานข้อมูลได้";
		}else{
			if(!mysql_select_db($dbname,$condb) ){
				echo "ไม่สามารถติดต่อ Database ได้";
					}else{
						//echo "ติดต่อ Database เรียบร้อย";
						$selSQL="select otop_type,otop_type_name from tab_otop_type";
						mysql_query("set character set utf8");
						if(mysql_query($selSQL)){
						
							$objQuery = mysql_query($selSQL);
							
							echo "<option value='0' >- เลือกประเภท -</option>";
							while($objResult = mysql_fetch_array($objQuery)){
								$objA = $objResult['otop_type'];
								$objB = $objResult['otop_type_name'];

								echo "<option value='$objA' >$objB</option>";
							}	
						}else{
							echo "cannot connect table.";
						}
				
			         	//	mysql_close($objConnect);
					} ///  end if "selected database"
			} ///end if " database connected"			
	}
?>