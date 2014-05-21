

<?php
/*
	header("Content-type:text/html; charset=UTF-8");              
	header("Cache-Control: no-store, no-cache, must-revalidate");             
	header("Cache-Control: post-check=0, pre-check=0", false);   
*/
    //include "./include/stat_func.php";
	include "./include/func.php";


	//--------------------------------------------------------//
 if (isset($_GET[action])){ 
	// Retrieve the GET parameters and executes the function
	  $funcName	 = $_GET[action];
	  $vars = $_GET[vars];
	  echo $_GET[addr];
	  $funcName($vars); //use function;
	 } 
	 else if (isset($_POST[action])){
	  // Retrieve the POST parameters and executes the function
	  $funcName	 = $_POST[action];
	  $vars= $_POST[vars];
	  echo $_POST[addr];
	  $funcName($vars); 
	}
	  
//----------------------------------------------------------------//		
	function save($v1){
		// makes an array from the passed variable 
		// (note: $vars = 1 string while it used to be a javascript Array)
		// with explode you can make an array from 1 string. The seperator is a , 
		$varArray = explode(",", $v1);
		
		$ccaattmm=$varArray[0];
		$emp_id=$varArray[1];
		$otop_type=$varArray[2];
		$otop_name=$varArray[3];
		$otop_group=$varArray[4];
		$otop_detail=$varArray[5];
		$contract_name=$varArray[6];
		$contract_tel=$varArray[7];
		$contract_addr=$varArray[8];
		$star_rate=$varArray[9];
		$tmp_pic_name = $varArray[10];
		
			if ($star_rate==null||0){
						$star_rate="0";
					}	
	
		$sys_year = date("Y")+543;
		$sys_year .= lpad(date("m"),"0",2);
		$sys_year .= lpad(date("d"),"0",2);
		$sys_date = $sys_year;
		$sys_time = date("His");

		//echo $sys_time."|".$sys_date;
		//echo "||".$tmp_pic_name."||";
		
		include "./include/connect_db.php";
		
		
		if(!$condb)	{
			?>
				<script>
					document.getElementById('inner_info').className="";
					$('#inner_info').addClass("error");
				</script>
			<?php
		   echo "ไม่สามารถติดต่อฐานข้อมูลได้";
			}else{
					if(!mysql_select_db($dbname,$condb) ){
						?>
						<script>
							document.getElementById('inner_info').className="";
							$('#inner_info').addClass("error");
						</script>
						<?php
						echo "ไม่สามารถติดต่อ Database ได้";
						}else{
							//echo "ติดต่อ Database เรียบร้อย";
							$selSQL="select max(otop_id)  from tab_otop";
					        mysql_query("set character set tis620");
							if(mysql_query($selSQL)){
								$objQuery = mysql_query($selSQL);
								while($objResult = mysql_fetch_array($objQuery)){
									$auto_run = $objResult[0];
									//echo "[$auto_run]";
									$auto_run++;
									if(($tmp_pic_name=="0")){
										$pic_name ="";
									}else{
										list($txt, $ext) = explode(".", $tmp_pic_name);
										$pic_name = lpad(($auto_run),"0",2).$sys_date.$sys_time.".".$ext;
										copy("uploads/tmp/".$tmp_pic_name,"uploads/use/".$pic_name);
									}
									
									//echo "[$pic_name]";
								}	
							
								//////  add data
								$insSQL = "INSERT INTO tab_otop
													(CATM, 
													OTOP_ID,
													OTOP_TYPE,
													OTOP_NAME,
													OTOP_GROUP,
													OTOP_STAR,
													OTOP_DETAIL,
													CONTRACT_NAME,
													CONTRACT_TEL,
													CONTRACT_ADDR,
													PIC_NO,
													UPD_DATE,
													UPD_TIME,
													UPD_EMP)
											VALUES('"
													.$ccaattmm."',"
													.$auto_run.",'"
													.$otop_type."','"
													.$otop_name."','"
													.$otop_group."','"
													.$star_rate."','"
													.$otop_detail."','"
													.$contract_name."','"
													.$contract_tel."','"
													.$contract_addr."','"
													.$pic_name."','"
													.$sys_date."','"
													.$sys_time."','"
													.$emp_id
													."')";
									//echo "sql $insSQL <br>";
									//echo date("Y:m:d");
									if(mysql_query($insSQL) ){
										echo "Insert success";
							?>
										<script>
											document.getElementById('inner_info').className="";
											$('#inner_info').addClass("success");
										</script>
							<?php
										
									}else{
										echo "Cannot insert.";
							?>
										<script>
											document.getElementById('inner_info').className="";
											$('#inner_info').addClass("error");
										</script>
							<?php
									}////// end add data

							}else{
								?>
								<script>
									document.getElementById('inner_info').className="";
									$('#inner_info').addClass("error");
								</script>
								<?php
								echo "cannot connect table.";
							}

						} ///  end if "selected database"
				} ///end if " database connected"			
		}/// end save function
?>
