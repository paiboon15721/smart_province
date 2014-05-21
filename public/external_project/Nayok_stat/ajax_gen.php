<?php 	

	header("Content-type:text/html; charset=UTF-8");              
	header("Cache-Control: no-store, no-cache, must-revalidate");             
	header("Cache-Control: post-check=0, pre-check=0", false);   
	include "include/stat_func.php";
	
/// recieve parameter
 if (isset($_GET[action])){ 
	// Retrieve the GET parameters and executes the function
	  $funcName	 = $_GET[action];
	  $vars = $_GET[vars];
	  $self = $_GET[self];
	  $funcName($vars,$self); //use function;
			}  else if (isset($_POST[action])){
			// Retrieve the POST parameters and executes the function
			$funcName	 = $_POST[action];
			$vars= $_POST[vars];
			$self = $_POST[self];
			$funcName($vars,$self); 
			}
/// end recieve parameter

	///// Gen ampor /////////////////////////////////////////
	function gen_ampor($cc,$self){
		//cc = 2 digit 
		$arr_data = explode("|", getListAA($cc));	
		if ($arr_data[1]==0){
			echo "<option value= 0000>- ไม่พบอำเภอ -</option>";
			}
			else if($self==null){
				echo "<option value=0000>- เลือกอำเภอ -</option>";
				for ($i=1;$i<=$arr_data[1]*2;$i+=2){
					echo  "<option value='".$arr_data[$i+1]."'>".str_replace('ท้องถิ่น','',$arr_data[$i+2])."</option>";
				}//end for*
			}
			else{
				for ($i=1;$i<=$arr_data[1]*2;$i+=2){
				if (substr($arr_data[$i+1],2,2)==$self){
					echo  "<option value='".$arr_data[$i+1]."'>".str_replace('ท้องถิ่น','',$arr_data[$i+2])."</option>";
				}
			}//end for
		}
	}//end gen_ampor
	
	
	///// Gen Tambon /////////////////////////////////////////
	function gen_tumbon($aa,$self){
		//$aa 4 digit
		$arr_data = explode("|", getListTT($aa));
		
		if ($arr_data[1]==0){
			echo "<option value= 000000>- ไม่พบตำบล -</option>";
			}
			else if($self==null){
				echo "<option value=000000>- เลือกตำบล -</option>";
				for ($i=1;$i<=$arr_data[1]*2;$i+=2){
					echo  "<option value='".$arr_data[$i+1]."'>".$arr_data[$i+2]."</option>";
					}//end for*
			}
			else{
				for ($i=1;$i<=$arr_data[1]*2;$i+=2){
				if ($self==substr($arr_data[$i+1],4,2)){
				echo  "<option value='".$arr_data[$i+1]."'>".$arr_data[$i+2]."</option>";
				}
			}//end for
		}
	}//end gen_tumbon
	
	
	///// Gen Mooban /////////////////////////////////////////
	function gen_mooban($tt,$self){
		//$tt 6 digit
		$arr_data = explode("|", getListMM($tt));	
		if ($arr_data[1]==0){
			
			echo "<option value= 00000000>- ไม่พบหมู่บ้าน -</option>";
			}
			else if($self==null){
				echo "<option value=00000000>- เลือกหมู่บ้าน -</option>";
				for ($i=1;$i<=$arr_data[1]*2;$i+=2){
						echo  "<option value='".$arr_data[$i+1]."'>".$arr_data[$i+2]."</option>";
					}//end for*
			}
		else{
				for ($i=1;$i<=$arr_data[1]*2;$i+=2){
				if (substr($arr_data[$i+1],6,2)==$self){
				echo  "<option value='".$arr_data[$i+1]."'>".$arr_data[$i+2]."</option>";
				}
			}//end for
		}
	}

?>