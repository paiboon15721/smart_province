<?php 	

	header("Content-type:text/html; charset=UTF-8");              
	header("Cache-Control: no-store, no-cache, must-revalidate");             
	header("Cache-Control: post-check=0, pre-check=0", false);   


	
function fillComma($number)  {
	$number = intVal($number);
    $number = number_format($number,0," ",",");
    return str_replace(" ", "&nbsp;", $number);
  }

	
function sum_array($array){
    $total = 0;
		for($i=0;$i<count($array);$i++){
			$total+=$array[$i];
		}	
	return $total;
}


function sum_array2($array,$from,$to){
		$total = 0;
		for($i=$from;$i<=$to;$i++){
			$total+=$array[$i];
		}	
	return $total;
}


////////////////////////////////// gen Date Year/////////////////////////////////	
	//-------------------- Generate Year ---------------------
	function genDate(){
		echo "<option value=00>- เลือกปี -</option>";
		$year = 2542; 
		$current_year = date("Y",strtotime("now"))+543;
		$count_year = $current_year;
              	for ($count_year;$count_year>=$year;$count_year--){
					if($count_year == $current_year){
						echo '<option value="'.substr($count_year,2,2).'" selected>  '.$count_year.'</option>';
					}else{
						echo '<option value="'.substr($count_year,2,2).'">  '.$count_year.'</option>';
					}
			   }
		}


	//------------------ Generate Month ----------------------		
	function genMonth(){
		$arr_mon=array(1=>"มกราคม" , 2=>"กุมภาพันธ์", 3=>"มีนาคม", 4=>"เมษายน", 5=>"พฤษภาคม", 6=>"มิถุนายน", 7=>"กรกฎาคม", 8=>"สิงหาคม", 9=>"กันยายน", 10=>"ตุลาคม", 11=>"พฤศจิกายน", 12=>"ธันวาคม", );
		$data = date("m");
		echo "<option value=00>- เลือกเดือน -</option>";
		while(list($value, $desc)=each($arr_mon)) {
			if($value<10){$value="0".$value;}
			if($value==$data) {
				echo"<option value='".$value."' selected>".$desc."</option>";
			} else {
					echo"<option value='".$value."' >".$desc."</option>";
			}			
		}//end while
	}//end gen month
	
	
	///// Gen Province /////////////////////////////////////////
	function gen_province(){
		$arr_province=array("กรุงเทพมหานคร","กระบี่","กาญจนบุรี","กาฬสินธุ์","กำแพงเพชร","ขอนแก่น","จันทบุรี","ฉะเชิงเทรา","ชลบุรี","ชัยนาท","ชัยภูมิ","ชุมพร","เชียงราย","เชียงใหม่","ตรัง","ตราด","ตาก","นครนายก","นครปฐม","นครพนม","นครราชสีมา","นครศรีธรรมราช","นครสวรรค์","นนทบุรี","นราธิวาส","น่าน","บึงกาฬ","บุรีรัมย์","ปทุมธานี","ประจวบคีรีขันธ์","ปราจีนบุรี","ปัตตานี","พระนครศรีอยุธยา","พะเยา","พังงา","พัทลุง","พิจิตร","พิษณุโลก","เพชรบุรี","เพชรบูรณ์","แพร่","ภูเก็ต","มหาสารคาม","มุกดาหาร","แม่ฮ่องสอน","ยโสธร","ยะลา","ร้อยเอ็ด","ระนอง","ระยอง","ราชบุรี","ลพบุรี","ลำปาง","ลำพูน","เลย","ศรีสะเกษ","สกลนคร","สงขลา","สตูล","สมุทรปราการ","สมุทรสงคราม","สมุทรสาคร","สระแก้ว","สระบุรี","สิงห์บุรี","สุโขทัย","สุพรรณบุรี","สุราษฎร์ธานี","สุราษฎร์ธานี","สุรินทร์","หนองคาย","หนองบัวลำภู","อ่างทอง","อำนาจเจริญ","อุดรธานี","อุตรดิตถ์","อุทัยธานี","อุบลราชธานี");
		while(list($value, $desc)=each($arr_province)) {
			if($value==$data) {
				echo"<option value=' ".$value." '> ".$value." ".$desc."</option>";
				} else {
					echo"<option value=' ".$value." '> ".$desc."</option>";
					}			
		}//end while
	}//end gen_province
	
	
	
	///// Gen ampor /////////////////////////////////////////
	function gen_ampor($cc){
	//cc = 2 digit 
		echo "<option value=0000>- เลือกอำเภอ -</option>";
		$arr_data = explode("|", getListAA($cc));	
		for ($i=1;$i<=$arr_data[1]*2;$i+=2){
			echo  "<option value='".$arr_data[$i+1]."'>".str_replace('ท้องถิ่น','',$arr_data[$i+2])."</option>";
			}//end for*/
	}//end gen_ampor
	
	function gen_tumbon($aa){
		$arr_data = explode("|", getListTT($aa));	
		
		echo "<option value=000000>- เลือกตำบล -</option>";
		for ($i=1;$i<=$arr_data[1]*2;$i+=2){
			echo  "<option value='".$arr_data[$i+1]."'>".$arr_data[$i+2]."</option>";
			}//end for*/
	}//end gen_tumbon
	
	
	///// Gen Mooban /////////////////////////////////////////
	function gen_mooban($tt){
		$arr_data = explode("|", getListMM($tt));	
		echo "<option value=00000000>- เลือกหมู่บ้าน -</option>";
		for ($i=1;$i<=$arr_data[1]*2;$i+=2){
			echo  "<option value='".$arr_data[$i+1]."'>".$arr_data[$i+2]."</option>";
			}//end for*/
	}
	
?>