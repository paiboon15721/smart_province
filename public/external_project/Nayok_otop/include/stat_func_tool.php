<?php 	

	header("Content-type:text/html; charset=UTF-8");              
	header("Cache-Control: no-store, no-cache, must-revalidate");             
	header("Cache-Control: post-check=0, pre-check=0", false);   
	include "stat_func.php";

	function get_label($ccaattmm){
		if($ccaattmm!=""){
			$lst_ampor = getListAA(substr($ccaattmm,0,2));
			$lst_tumbon = getListTT(substr($ccaattmm,0,4));
			$lst_mooban = getListMM(substr($ccaattmm,0,6));
			$arr_aa = explode("|", $lst_ampor);
			$arr_tt = explode("|", $lst_tumbon);
			$arr_mm = explode("|", $lst_mooban);

			/// sel ampor
			for($i=0; $i<(count($arr_aa)-3) ;$i+=2){
				if(substr($arr_aa[$i+2],2,2)==substr($ccaattmm,2,2)){
					echo str_replace('ท้องถิ่น','',$arr_aa[$i+3])." ";
				}
			}
			
			/// sel tumbon
			for($i=0; $i<(count($arr_tt)-3) ;$i+=2){
				if(substr($arr_tt[$i+2],4,2)==substr($ccaattmm,4,2)){
					echo " ตำบล".$arr_tt[$i+3]." ";
				}
			}
			
			/// sel mooban
			for($i=0; $i<(count($arr_mm)-3) ;$i+=2){
				if(substr($arr_mm[$i+2],6,2)==substr($ccaattmm,6,2)){
					echo " หมู่".$arr_mm[$i+3];
					}
			}
		}else{
			echo "please login!!";
		}
	}//end get_label
?>