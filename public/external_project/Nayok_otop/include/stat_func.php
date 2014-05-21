<?php
//header("Content-Type: text/html; charset=UTF-8");
include "ndb_func.php";
//echo "2 txt_inhouse_code=".$_REQUEST['txt_inhouse_code'];
//if ($_POST['action']=='add_inhouse'){
    //echo "hello";
    //addInhouse();
//}
$character_set = "TH8TISASCII";
//"AL16UTF16"
function connectORS($character_set = "AL32UTF8"){
    //connectDB($user,$pass,$con_str,$character_set = "TIS-620")
    if ($_SERVER['SERVER_ADDR'] == "157.179.24.101"){
        $con_str ="nrs:1521/orcl";
    	$user = "mia"; 
    	$pass = "mia"; 
    }else{
        $con_str ="nrs:1521/xe";
    	$user = "mia"; 
    	$pass = "mia"; 
        //$con_str ="61.19.44.34:1521/xe";
    }
    try {
        $conn_id = connect_db($user,$pass,$con_str,$character_set);
    }catch (Exeption $e){
        throw $e;
    }
    return $conn_id;
}

function getHouseByCond($yymm, $emp_job, $emp_rcode, $ccaattmm) 
{
        $sysDate=(date("Y")+543).date("md");
	if ($emp_job=="5" and $emp_rcode=="1099") { //center
	} elseif ($emp_job=="2" ) { //province
		$cc = substr($ccaattmm,0,2);
		$cc .= '__';

		//if ($house_type==0) {
		$sql = "select a.rcode,(select rcode_desc from tabdb.rcode where rcode_code=a.rcode),a.stat_subtype,sum(a.total) from stat.stat_hse_misc a where a.yymm=$yymm and a.tr_level=6 and (a.rcode>2600 and a.rcode<2700) "; 
		$sql .=" and (a.stat_type=1) ";
		$sql .=" group by a.rcode,a.stat_subtype order by a.rcode,a.stat_subtype ";
		//} else {
		//	$sql = "select a.rcode,(select rcode_desc from tabdb.rcode where rcode_code=a.rcode),sum(a.total) from stat.stat_hse_misc a where a.yymm=$yymm and a.tr_level=6 and (a.rcode>2600 and a.rcode<2700) "; 
		//	$sql .=" and (a.stat_type=1 and a.stat_subtype in ($house_subtype1,$house_subtype2,$house_subtype3,$house_subtype4,$house_subtype5) ";
		//	$sql .=" group by a.rcode,a.stat_subtype order by a.rcode,a.stat_subtype ";
		//}
	} elseif ($emp_job=="1") { //rcode
		$rcode = $emp_rcode;
		$tt = substr($ccaattmm,4,2);

		//if ($house_type==0) {
		//$sql = "select a.tt,nvl((select catm_desc from tabdb.ccaattmm where substr(catm_ukey,1,4)=$rcode and substr(catm_ukey,5,2)=a.tt and flag_area=3),null),a.stat_subtype,sum(a.total) from stat.stat_hse_misc a where a.yymm=$yymm and a.tr_level=6 and a.tt=$tt "; 
		$sql = "select a.tt,nvl((select catm_desc from tabdb.ccaattmm where substr(catm_ukey,1,4)=$rcode and substr(catm_ukey,5,2)=a.tt and flag_area=3),null),a.stat_subtype,sum(a.total) from stat.stat_hse_misc a where a.yymm=$yymm and a.tr_level=6 and a.rcode=$rcode "; 
		$sql .=" and (a.stat_type=1) ";
		$sql .=" group by a.tt,a.stat_subtype order by a.tt,a.stat_subtype ";
	} elseif ($emp_job=="9") { //tt
		$rcode = substr($ccaattmm,0,4);
		$tt = substr($ccaattmm,4,2);

		//if ($house_type==0) {
		$sql = "select a.mm,nvl((select catm_desc from tabdb.ccaattmm where substr(catm_ukey,1,4)=$rcode and substr(catm_ukey,5,2)=$tt and substr(catm_ukey,7,2)=a.mm),null),a.stat_subtype,sum(a.total) from stat.stat_hse_misc a where a.yymm=$yymm and a.tr_level=6 and a.rcode=$rcode and a.tt=$tt "; 
		$sql .=" and (a.stat_type=1) ";
		$sql .=" group by a.mm,a.stat_subtype order by a.mm,a.stat_subtype ";
	} elseif ($emp_job=="8") { //tt
		$rcode = substr($ccaattmm,0,4);
		$tt = substr($ccaattmm,4,2);
		$mm = substr($ccaattmm,6,2);

		//if ($house_type==0) {
		$sql = "select a.mm,nvl((select catm_desc from tabdb.ccaattmm where substr(catm_ukey,1,4)=$rcode and substr(catm_ukey,5,2)=$tt and substr(catm_ukey,7,2)=$mm),null),a.stat_subtype,sum(a.total) from stat.stat_hse_misc a where a.yymm=$yymm and a.tr_level=6 and a.rcode=$rcode and a.tt=$tt and a.mm=$mm "; 
		$sql .=" and (a.stat_type=1) ";
		$sql .=" group by a.mm,a.stat_subtype order by a.mm,a.stat_subtype ";
	} 
    	try{
        	$conn_id = connectORS();
        	$stmt = prepare($conn_id,$sql);
        	execute($stmt);
        	$result['num'] = fetch_all($stmt,$result['row']);
        	if ($result['num'] == 0 ){
            		$str_result = "0|";
        	}else{
            		$str_result = "1|{$result['num']}|";
            		foreach ($result['row'] as $row) {
            		//echo "<tr>\n";
                	foreach ($row as $item) {
                    		//$item = iconv('TIS-620','UTF-8',$item);
				//if {$item} == '' 
				//	{$item}="0";
                    		$str_result .= "{$item}|";
                	}
            	}
        }
        $str_result .= "{$sql2}"; 
	//	echo $str_result;
        //$str_result = "1|".$sql;
        free_statement($stmt);
        close_conn($conn_id);
        return $str_result;
    }catch (Exception $e){
        throw $e;
    }
}

function getPopHouseByCond($yymm, $emp_job, $emp_rcode, $ccaattmm,$pop_type, $pop_subtype1,$pop_subtype2,$pop_subtype3){
        $sysDate=(date("Y")+543).date("md");
	if ($emp_job=="5" and $emp_rcode=="1099") { //center
		$sql = "select region,sum(tot_male),sum(tot_female),nvl((select sum(not_term_date) from stat.stat_house where yymm=$yymm and tr_level=6 and region=a.region),null) from stat.stat_pop_misc where yymm=$yymm and tr_level=6 group by region order by region";
	} elseif ($emp_job=="4" and substr($emp_rcode,1,3)=="000") { //region
		if (substr($emp_rcode,1,1)=='4' ) {
			$sql = "select substr(rcode,1,2),sum(tot_male),sum(tot_female) from stat.stat_pop_misc where yymm=$yymm and tr_level=6 and (substr($emp_rcode,1,1) between '38' and '49')  group by substr(rcode,1,2) order by substr(rcode,1,2)";
		} elseif (substr($emp_rcode,1,1)=='3') {
			$sql = "select substr(rcode,1,2),sum(tot_male),sum(tot_female) from stat.stat_pop_misc where yymm=$yymm and tr_level=6 and (substr($emp_rcode,1,1) between '30' and '37')  group by substr(rcode,1,2) order by substr(rcode,1,2)";
		} else {
			$sql = "select substr(rcode,1,2),sum(tot_male),sum(tot_female) from stat.stat_pop_misc where yymm=$yymm and tr_level=6 and region=substr($emp_rcode,1,1)  group by substr(rcode,1,2) order by substr(rcode,1,2)";
		}
	} elseif ($emp_job=="3" and substr($emp_rcode,2,2)=="00") { //province
		/*if (substr($emp_rcode,1,2)=='4' ) {
			$sql = "select substr(rcode,1,2),sum(tot_male),sum(tot_female) from stat.stat_pop_misc where yymm=$yymm and tr_level=6 and region=4  group by substr(rcode,1,2) order by substr(rcode,1,2)";
		} else {
			$sql = "select substr(rcode,1,2),sum(tot_male),sum(tot_female) from stat.stat_pop_misc where yymm=$yymm and tr_level=6 and region=substr($emp_rcode,1,1) group by substr(rcode,1,2) order by substr(rcode,1,2)";
		} */
		$cc = substr($emp_rcode,0,2);
		$cc .= '__';

		$sql = "select rcode,(select rcode_desc from tabdb.rcode where rcode_code=a.rcode),sum(tot_male),sum(tot_female),nvl((select sum(not_term_date) from stat.stat_house where yymm=$yymm and tr_level=6 and rcode=a.rcode),null) from stat.stat_pop_misc a where yymm=$yymm and tr_level=6 and rcode like '$cc' group by rcode order by rcode";
	} elseif ($emp_job=="2" ) { //province
		//(((stat_type=6) and (stat_subtype in (0))) or ((stat_type=7) and (stat_subtype in (0))) or ((stat_type=8) and (stat_subtype in (0)))) group by rcode order by rcode
		$cc = substr($ccaattmm,0,2);
		$cc .= '__';
		
		$sql = "select rcode,(select rcode_desc from tabdb.rcode where rcode_code=a.rcode),sum(tot_male),sum(tot_female),nvl((select sum(not_term_date) from stat.stat_house where yymm=$yymm and tr_level=6 and rcode=a.rcode),null) from stat.stat_pop_misc a where yymm=$yymm and tr_level=6 and (rcode>2600 and rcode<2700) "; 
		//echo "pop_type" .$pop_type;
		$flag_h=0;
		if (substr($pop_type,0,1)=="1") { 
			$sql .=" and (((stat_type=6) ";
			$flag_h1=0;
			if (substr($pop_subtype1,0,1)=="1") {
				$flag_h1=1;
				$sql .=" and (stat_subtype in (0,4,8,9";
			}
			if (substr($pop_subtype1,1,1)=="1") {
				if ($flag_h1==0) {
					$sql .=" and (stat_subtype in (1,11,13";
				} else {
					$sql .=",1,11,13";
				}
				$flag_h1=1;
			}
			if (substr($pop_subtype1,2,1)=="1") {
				if ($flag_h1==0) {
					$sql .=" and (stat_subtype in (15";
				} else {
					$sql .=",15";
				}
				$flag_h1=1;
			}
			if (substr($pop_subtype1,3,1)=="1") {
				if ($flag_h1==0) {
					$sql .=" and (stat_subtype in (2,3,5,6,7,12,14";
				} else {
					$sql .=",2,3,5,6,7,12,14";
				}
				$flag_h1=1;
			}
			if ($flag_h1==1) {
				$sql .=")))";
			} else {
				$sql .=")";
			}
			$flag_h=1;
		}  
		if (substr($pop_type,1,1)=="1") { 
			$flag_h2=0;
			if ($flag_h==0) {
				$flag_h=1;
				$sql .=" and (((stat_type=7) ";
			} else {
				$sql .=" or ((stat_type=7) ";
			}
			if (substr($pop_subtype2,0,1)=="1") {
				$flag_h2=1;
				$sql .=" and (stat_subtype in (0,4,8,9";
			}
			if (substr($pop_subtype2,1,1)=="1") {
				if ($flag_h2==0) {
					$sql .=" and (stat_subtype in (1,11,13";
				} else {
					$sql .=",1,11,13";
				}
				$flag_h2=1;
			}
			if (substr($pop_subtype2,2,1)=="1") {
				if ($flag_h2==0) {
					$sql .=" and (stat_subtype in (15";
				} else {
					$sql .=",15";
				}
				$flag_h2=1;
			}
			if (substr($pop_subtype2,3,1)=="1") {
				if ($flag_h2==0) {
					$sql .=" and (stat_subtype in (2,3,5,6,7,12,14";
				} else {
					$sql .=",2,3,5,6,7,12,14";
				}
				$flag_h2=1;
			}
			if ($flag_h2==1) {
				$sql .=")))";
			} else {
				$sql .=")";
			}
//25/6/56
			$flag_h=1;
		} 
		if (substr($pop_type,2,1)=="1") { 
			$flag_h3=0;
			if ($flag_h==0) {
				$sql .=" and (((stat_type=8) ";
			} else {
				$sql .=" or ((stat_type=8) ";
			}
			if (substr($pop_subtype3,0,1)=="1") {
				$flag_h3=1;
				$sql .=" and (stat_subtype in (0,4,8,9";
			}
			if (substr($pop_subtype3,1,1)=="1") {
				if ($flag_h3==0) {
					$sql .=" and (stat_subtype in (1,11,13";
				} else {
					$sql .=",1,11,13";
				}
				$flag_h3=1;
			}
			if (substr($pop_subtype3,2,1)=="1") {
				if ($flag_h3==0) {
					$sql .=" and (stat_subtype in (15";
				} else {
					$sql .=",15";
				}
				$flag_h3=1;
			}
			if (substr($pop_subtype3,3,1)=="1") {
				if ($flag_h3==0) {
					$sql .=" and (stat_subtype in (2,3,5,6,7,12,14";
				} else {
					$sql .=",2,3,5,6,7,12,14";
				}
				$flag_h3=1;
			}
			if ($flag_h3==1) {
				$sql .=")))";
			} else {
				$sql .=")";
			}
//25/6/56
			$flag_h=1;
		} 
		$sql .=")";
		$sql .=" group by rcode order by rcode";
		//echo $sql;
	} elseif ($emp_job=="1") { //rcode
		//show tt
		$rcode = $emp_rcode;
		if ($rcode>2690) {
			$sql = "select rcode,nvl((select rcode_desc from tabdb.rcode where rcode_code='$rcode'),null),sum(tot_male),sum(tot_female),nvl((select sum(not_term_date) from stat.stat_house where yymm=$yymm and tr_level=6 and rcode='$rcode'),null) from stat.stat_pop_misc a where yymm=$yymm and tr_level=6 and rcode='$rcode' ";
		} else {
			$sql = "select tt,nvl((select catm_desc from tabdb.ccaattmm where substr(catm_ukey,1,4)=$rcode and substr(catm_ukey,5,2)=a.tt and flag_area=3),null),sum(tot_male),sum(tot_female),nvl((select sum(not_term_date) from stat.stat_house where yymm=$yymm and tr_level=6 and rcode='$rcode' and tt=a.tt),null) from stat.stat_pop_misc a where yymm=$yymm and tr_level=6 and rcode='$rcode' ";
		}
		$flag_h = 0;
		//echo "pop_type" .$pop_type;
		if (substr($pop_type,0,1)=="1") { 
			$flag_h1=0;
			$sql .=" and (((stat_type=6) ";
			if (substr($pop_subtype1,0,1)=="1") {
				$flag_h1=1;
				$sql .=" and (stat_subtype in (0,4,8,9";
			}
			if (substr($pop_subtype1,1,1)=="1") {
				if ($flag_h1==0) {
					$sql .=" and (stat_subtype in (1,11,13";
				} else {
					$sql .=",1,11,13";
				}
				$flag_h1=1;
			}
			if (substr($pop_subtype1,2,1)=="1") {
				if ($flag_h1==0) {
					$sql .=" and (stat_subtype in (15";
				} else {
					$sql .=",15";
				}
				$flag_h1=1;
			}
			if (substr($pop_subtype1,3,1)=="1") {
				if ($flag_h1==0) {
					$sql .=" and (stat_subtype in (2,3,5,6,7,12,14";
				} else {
					$sql .=",2,3,5,6,7,12,14";
				}
				$flag_h1=1;
			}
			if ($flag_h1==1) {
				$sql .=")))";
			} else {
				$sql .=")";
			}
			$flag_h = 1;
		}
		if (substr($pop_type,1,1)=="1") { 
			$flag_h2=0;
			if ($flag_h==0) {
				$sql .=" and (((stat_type=7) ";
			} else {
				$sql .=" or ((stat_type=7) ";
			}
			if (substr($pop_subtype2,0,1)=="1") {
				$flag_h2=1;
				$sql .=" and (stat_subtype in (0,4,8,9";
			}
			if (substr($pop_subtype2,1,1)=="1") {
				if ($flag_h2==0) {
					$sql .=" and (stat_subtype in (1,11,13";
				} else {
					$sql .=",1,11,13";
				}
				$flag_h2=1;
			}
			if (substr($pop_subtype2,2,1)=="1") {
				if ($flag_h2==0) {
					$sql .=" and (stat_subtype in (15";
				} else {
					$sql .=",15";
				}
				$flag_h2=1;
			}
			if (substr($pop_subtype2,3,1)=="1") {
				if ($flag_h2==0) {
					$sql .=" and (stat_subtype in (2,3,5,6,7,12,14";
				} else {
					$sql .=",2,3,5,6,7,12,14";
				}
				$flag_h2=1;
			}
			if ($flag_h2==1) {
				$sql .=")))";
			} else {
				$sql .=")";
			}
			$flag_h = 1;
		} 
		if (substr($pop_type,2,1)=="1") { 
			$flag_h3=0;
			if ($flag_h==0) {
				$sql .=" and (((stat_type=8) ";
			} else {
				$sql .=" or ((stat_type=8) ";
			}
			if (substr($pop_subtype3,0,1)=="1") {
				$flag_h3=1;
				$sql .=" and (stat_subtype in (0,4,8,9";
			}
			if (substr($pop_subtype3,1,1)=="1") {
				if ($flag_h3==0) {
					$sql .=" and (stat_subtype in (1,11,13";
				} else {
					$sql .=",1,11,13";
				}
				$flag_h3=1;
			}
			if (substr($pop_subtype3,2,1)=="1") {
				if ($flag_h3==0) {
					$sql .=" and (stat_subtype in (15";
				} else {
					$sql .=",15";
				}
				$flag_h3=1;
			}
			if (substr($pop_subtype3,3,1)=="1") {
				if ($flag_h3==0) {
					$sql .=" and (stat_subtype in (2,3,5,6,7,12,14";
				} else {
					$sql .=",2,3,5,6,7,12,14";
				}
				$flag_h3=1;
			}
			if ($flag_h3==1) {
				$sql .=")))";
			} else {
				$sql .=")";
			}
		} 
		$sql .=")";
		if ($rcode>2690) {
			$sql .=" group by rcode order by rcode";
		} else {
			$sql .=" group by tt order by tt";
		}
		//echo $sql;
	} elseif ($emp_job=="9") { //tt
		//show mm
		$rcode=substr($ccaattmm,0,4);
		$tt=substr($ccaattmm,4,2);
		
		$sql = "select mm,nvl((select catm_desc from tabdb.ccaattmm where substr(catm_ukey,1,4)=$rcode and substr(catm_ukey,5,2)=$tt and substr(catm_ukey,7,2)=a.mm),null),sum(tot_male),sum(tot_female),nvl((select sum(not_term_date) from stat.stat_house where yymm=$yymm and tr_level=6 and rcode='$rcode' and tt=$tt and mm=a.mm),null) from stat.stat_pop_misc a where yymm=$yymm and tr_level=6 and rcode='$rcode' and tt=$tt and mm>0 ";
		$flag_h = 0;
		//echo "pop_type" .$pop_type;
		if (substr($pop_type,0,1)=="1") { 
			$sql .=" and (((stat_type=6) ";
			$flag_h1=0;
			if (substr($pop_subtype1,0,1)=="1") {
				$flag_h1=1;
				$sql .=" and (stat_subtype in (0,4,8,9";
			}
			if (substr($pop_subtype1,1,1)=="1") {
				if ($flag_h1==0) {
					$sql .=" and (stat_subtype in (1,11,13";
				} else {
					$sql .=",1,11,13";
				}
				$flag_h1=1;
			}
			if (substr($pop_subtype1,2,1)=="1") {
				if ($flag_h1==0) {
					$sql .=" and (stat_subtype in (15";
				} else {
					$sql .=",15";
				}
				$flag_h1=1;
			}
			if (substr($pop_subtype1,3,1)=="1") {
				if ($flag_h1==0) {
					$sql .=" and (stat_subtype in (2,3,5,6,7,12,14";
				} else {
					$sql .=",2,3,5,6,7,12,14";
				}
				$flag_h1=1;
			}
			if ($flag_h1==1) {
				$sql .=")))";
			} else {
				$sql .=")";
			}
			$flag_h=1;
		}  
		if (substr($pop_type,1,1)=="1") { 
			$flag_h2=0;
			if ($flag_h==0) {
				$sql .=" and (((stat_type=7) ";
			} else {
				$sql .=" or ((stat_type=7) ";
			}
			if (substr($pop_subtype2,0,1)=="1") {
				$flag_h2=1;
				$sql .=" and (stat_subtype in (0,4,8,9";
			}
			if (substr($pop_subtype2,1,1)=="1") {
				if ($flag_h2==0) {
					$sql .=" and (stat_subtype in (1,11,13";
				} else {
					$sql .=",1,11,13";
				}
				$flag_h2=1;
			}
			if (substr($pop_subtype2,2,1)=="1") {
				if ($flag_h2==0) {
					$sql .=" and (stat_subtype in (15";
				} else {
					$sql .=",15";
				}
				$flag_h2=1;
			}
			if (substr($pop_subtype2,3,1)=="1") {
				if ($flag_h2==0) {
					$sql .=" and (stat_subtype in (2,3,5,6,7,12,14";
				} else {
					$sql .=",2,3,5,6,7,12,14";
				}
				$flag_h2=1;
			}
			if ($flag_h2==1) {
				$sql .=")))";
			} else {
				$sql .=")";
			}
			$flag_h = 1;
		} 
		if (substr($pop_type,2,1)=="1") { 
			$flag_h3=0;
			if ($flag_h==0) {
				$sql .=" and (((stat_type=8) ";
			} else {
				$sql .=" or ((stat_type=8) ";
			}
			if (substr($pop_subtype3,0,1)=="1") {
				$flag_h3=1;
				$sql .=" and (stat_subtype in (0,4,8,9";
			}
			if (substr($pop_subtype3,1,1)=="1") {
				if ($flag_h3==0) {
					$sql .=" and (stat_subtype in (1,11,13";
				} else {
					$sql .=",1,11,13";
				}
				$flag_h3=1;
			}
			if (substr($pop_subtype3,2,1)=="1") {
				if ($flag_h3==0) {
					$sql .=" and (stat_subtype in (15";
				} else {
					$sql .=",15";
				}
				$flag_h3=1;
			}
			if (substr($pop_subtype3,3,1)=="1") {
				if ($flag_h3==0) {
					$sql .=" and (stat_subtype in (2,3,5,6,7,12,14";
				} else {
					$sql .=",2,3,5,6,7,12,14";
				}
				$flag_h3=1;
			}
			if ($flag_h3==1) {
				$sql .=")))";
			} else {
				$sql .=")";
			}
		} 
		$sql .=")";
		$sql .=" group by mm order by mm";
		//echo $sql;
	} elseif ($emp_job=="8") { //tt
		//show mm
		$rcode=substr($ccaattmm,0,4);
		$tt=substr($ccaattmm,4,2);
		$mm=substr($ccaattmm,6,2);
		
		$sql = "select mm,nvl((select catm_desc from tabdb.ccaattmm where substr(catm_ukey,1,4)=$rcode and substr(catm_ukey,5,2)=$tt and substr(catm_ukey,7,2)=$mm),null),sum(tot_male),sum(tot_female),nvl((select sum(not_term_date) from stat.stat_house where yymm=$yymm and tr_level=6 and rcode='$rcode' and tt=$tt and mm=$mm),null) from stat.stat_pop_misc a where yymm=$yymm and tr_level=6 and rcode='$rcode' and tt=$tt and mm=$mm";
		$flag_h = 0;
		//echo "pop_type" .$pop_type;
		if (substr($pop_type,0,1)=="1") { 
			$sql .=" and (((stat_type=6) ";
			$flag_h1=0;
			if (substr($pop_subtype1,0,1)=="1") {
				$flag_h1=1;
				$sql .=" and (stat_subtype in (0,4,8,9";
			}
			if (substr($pop_subtype1,1,1)=="1") {
				if ($flag_h1==0) {
					$sql .=" and (stat_subtype in (1,11,13";
				} else {
					$sql .=",1,11,13";
				}
				$flag_h1=1;
			}
			if (substr($pop_subtype1,2,1)=="1") {
				if ($flag_h1==0) {
					$sql .=" and (stat_subtype in (15";
				} else {
					$sql .=",15";
				}
				$flag_h1=1;
			}
			if (substr($pop_subtype1,3,1)=="1") {
				if ($flag_h1==0) {
					$sql .=" and (stat_subtype in (2,3,5,6,7,12,14";
				} else {
					$sql .=",2,3,5,6,7,12,14";
				}
				$flag_h1=1;
			}
			if ($flag_h1==1) {
				$sql .=")))";
			} else {
				$sql .=")";
			}
			$flag_h=1;
		}  
		if (substr($pop_type,1,1)=="1") { 
			$flag_h2=0;
			if ($flag_h==0) {
				$sql .=" and (((stat_type=7) ";
			} else {
				$sql .=" or ((stat_type=7) ";
			}
			if (substr($pop_subtype2,0,1)=="1") {
				$flag_h2=1;
				$sql .=" and (stat_subtype in (0,4,8,9";
			}
			if (substr($pop_subtype2,1,1)=="1") {
				if ($flag_h2==0) {
					$sql .=" and (stat_subtype in (1,11,13";
				} else {
					$sql .=",1,11,13";
				}
				$flag_h2=1;
			}
			if (substr($pop_subtype2,2,1)=="1") {
				if ($flag_h2==0) {
					$sql .=" and (stat_subtype in (15";
				} else {
					$sql .=",15";
				}
				$flag_h2=1;
			}
			if (substr($pop_subtype2,3,1)=="1") {
				if ($flag_h2==0) {
					$sql .=" and (stat_subtype in (2,3,5,6,7,12,14";
				} else {
					$sql .=",2,3,5,6,7,12,14";
				}
				$flag_h2=1;
			}
			if ($flag_h2==1) {
				$sql .=")))";
			} else {
				$sql .=")";
			}
			$flag_h = 1;
		} 
		if (substr($pop_type,2,1)=="1") { 
			$flag_h3=0;
			if ($flag_h==0) {
				$sql .=" and (((stat_type=8) ";
			} else {
				$sql .=" or ((stat_type=8) ";
			}
			if (substr($pop_subtype3,0,1)=="1") {
				$flag_h3=1;
				$sql .=" and (stat_subtype in (0,4,8,9";
			}
			if (substr($pop_subtype3,1,1)=="1") {
				if ($flag_h3==0) {
					$sql .=" and (stat_subtype in (1,11,13";
				} else {
					$sql .=",1,11,13";
				}
				$flag_h3=1;
			}
			if (substr($pop_subtype3,2,1)=="1") {
				if ($flag_h3==0) {
					$sql .=" and (stat_subtype in (15";
				} else {
					$sql .=",15";
				}
				$flag_h3=1;
			}
			if (substr($pop_subtype3,3,1)=="1") {
				if ($flag_h3==0) {
					$sql .=" and (stat_subtype in (2,3,5,6,7,12,14";
				} else {
					$sql .=",2,3,5,6,7,12,14";
				}
				$flag_h3=1;
			}
			if ($flag_h3==1) {
				$sql .=")))";
			} else {
				$sql .=")";
			}
		} 

		$sql .=")";
		$sql .=" group by mm order by mm";
	}

    	//$sql2 = iconv('TIS-620','UTF-8',$sql);
  	//echo "sql = ".$sql2."</br>";
    
    	try{
        	$conn_id = connectORS();
        	$stmt = prepare($conn_id,$sql);
        	execute($stmt);
        	$result['num'] = fetch_all($stmt,$result['row']);
        	if ($result['num'] == 0 ){
            		$str_result = "0|";
        	}else{
            		$str_result = "1|{$result['num']}|";
            		foreach ($result['row'] as $row) {
            		//echo "<tr>\n";
                	foreach ($row as $item) {
                    		//$item = iconv('TIS-620','UTF-8',$item);
				//if {$item} == '' 
				//	{$item}="0";
                    		$str_result .= "{$item}|";
                	}
            	}
        }
        $str_result .= "{$sql2}"; 
	//echo $str_result;
        //$str_result = "1|".$sql;
        free_statement($stmt);
        close_conn($conn_id);
        return $str_result;
    }catch (Exception $e){
        throw $e;
    }
} //getPopHouseByCond

function getPopAgeByCond($yymm, $emp_job, $emp_rcode, $ccaattmm, $nat_type){
	//field ¡Ò order
	if ($emp_job=="5" and $emp_rcode=="1099") {
		$sql = "select sum(age$age_start)";	
		if ($age_end>$age_start) {
			for ($i=$age_start+1;$i<=$age_end;$i++) {
				$sql .= (",sum(age$i)");	
			}
		}
		$sql .= (" from stat.stat_pop_age where yymm=$yymm and tr_level=6 and pop_st in (0,4,14,15) ");
		$sql .= (" group by nat,sex");
		$sql .= (" order by nat,sex"); 
		//echo $sql;
		$sql .= (" from stat.stat_pop_age where yymm=$yymm and tr_level=6 and region=$region and substr(rcode,1,2)=$cc and pop_st in (0,4,14,15) ");
	} elseif ($emp_job=="2") { //cc
		$age_start=0;
		$age_end=101;
		$cc=substr($ccaattmm,0,2);

		$sql = "select sex,sum(age$age_start)";	
		if ($age_end>$age_start) {
			for ($i=$age_start+1;$i<=$age_end;$i++) {
				$sql .= (",sum(age$i)");	
			}
		}
		$sql .= (" from stat.stat_pop_age where yymm=$yymm and tr_level=6 and substr(rcode,1,2)='$cc' and pop_st in (0,4,8,9,14,15) ");
		if ($nat_type==0) {
			$sql .= (" ");
		} elseif ($nat_type==1) {
			$sql .= (" and nat=099 ");
		} elseif ($nat_type==2) {
			$sql .= (" and nat=044");
		} elseif ($nat_type==3) {
			$sql .= (" and nat=998");
		}
		$sql .= (" group by sex");
		$sql .= (" order by sex "); 
	} elseif ($emp_job=="1") { //rcode
		$age_start=0;
		$age_end=101;
		$rcode=$emp_rcode;

		$sql = "select sex,sum(age$age_start)";	
		if ($age_end>$age_start) {
			for ($i=$age_start+1;$i<=$age_end;$i++) {
				$sql .= (",sum(age$i)");	
			}
		}
		$sql .= (" from stat.stat_pop_age where yymm=$yymm and tr_level=6 and rcode='$rcode' and pop_st in (0,4,8,9,14,15) ");
		if ($nat_type==0) {
			$sql .= (" ");
		} elseif ($nat_type==1) {
			$sql .= (" and nat=099 ");
		} elseif ($nat_type==2) {
			$sql .= (" and nat=044");
		} elseif ($nat_type==3) {
			$sql .= (" and nat=998");
		}
		$sql .= (" group by sex");
		$sql .= (" order by sex "); 
	} elseif ($emp_job=="9") { //tt
		$age_start=0;
		$age_end=101;
		$rcode=substr($ccaattmm,0,4);
		$tt=substr($ccaattmm,4,2);

		$sql = "select sex,sum(age$age_start)";	
		if ($age_end>$age_start) {
			for ($i=$age_start+1;$i<=$age_end;$i++) {
				$sql .= (",sum(age$i)");	
			}
		}
		$sql .= (" from stat.stat_pop_age where yymm=$yymm and tr_level=6 and rcode='$rcode' and tt=$tt and pop_st in (0,4,8,9,14,15) ");
		if ($nat_type==0) {
			$sql .= (" ");
		} elseif ($nat_type==1) {
			$sql .= (" and nat=099 ");
		} elseif ($nat_type==2) {
			$sql .= (" and nat=044");
		} elseif ($nat_type==3) {
			$sql .= (" and nat=998");
		}
		$sql .= (" group by sex");
	} elseif ($emp_job=="8") { //mm
		$age_start=0;
		$age_end=101;
		$rcode=substr($ccaattmm,0,4);
		$tt=substr($ccaattmm,4,2);
		$mm=substr($ccaattmm,6,2);

		$sql = "select sex,sum(age$age_start)";	
		if ($age_end>$age_start) {
			for ($i=$age_start+1;$i<=$age_end;$i++) {
				$sql .= (",sum(age$i)");	
			}
		}
		$sql .= (" from stat.stat_pop_age where yymm=$yymm and tr_level=6 and rcode='$rcode' and tt=$tt and mm=$mm and pop_st in (0,4,8,9,14,15) ");
		if ($nat_type==0) {
			$sql .= (" ");
		} elseif ($nat_type==1) {
			$sql .= (" and nat=099 ");
		} elseif ($nat_type==2) {
			$sql .= (" and nat=044");
		} elseif ($nat_type==3) {
			$sql .= (" and nat=998");
		}
		$sql .= (" group by sex");
		$sql .= (" order by sex "); 
	}
    	//$cond .= "("h.ccaattmm",$cc,$aa,$tt,$mm);
    	//if ($cond != ""){
        //	$cond = substr($cond,0,strlen($cond)-4);
        //	$sql .= "where ". $cond;
        //	$sql .= " order by {$order_by} {$direct}";
    	//}else{
        //	$str_result = "9|กรุณาระบุเงื่อนไขการค้นหา";
        //	return $str_result;
    	//}
    	//return "9|".$sql;
    
    	//$sql2 = iconv('TIS-620','UTF-8',$sql);
  	//echo "sql = ".$sql2."</br>";
    
    	try{
        	$conn_id = connectORS();
        	$stmt = prepare($conn_id,$sql);
        	execute($stmt);
        	$result['num'] = fetch_all($stmt,$result['row']);
        	if ($result['num'] == 0 ){
            		$str_result = "0|";
        	}else{
            		$str_result = "1|{$result['num']}|";
            		foreach ($result['row'] as $row) {
            		//echo "<tr>\n";
                	foreach ($row as $item) {
                    		//$item = iconv('TIS-620','UTF-8',$item);
                    		$str_result .= "{$item}|";
                	}
            	}
        }
        $str_result .= "{$sql2}"; 
	//echo $str_result;
        //$str_result = "1|".$sql;
        free_statement($stmt);
        close_conn($conn_id);
        return $str_result;
    }catch (Exception $e){
        throw $e;
    }
}
function concatWhere($field,$value,$type){
/* type = 0 : string,   type = 1 : num */    
    if ($type == 0){
        if (trim($value) != ""){
            return "{$field} = '{$value}' and ";
        }
    }else{
        if ($value > 0){
            return "{$field} = {$value} and ";
        }
    }
}

function concatBetween($field,$start,$end){
    if ($start == $end || $end == 0 || trim($end) == ''){
        if ($start > 0 && trim($start) != ''){
            return "{$field} = '{$start}' and ";
        }
    }else{
        if ($start == 0 || trim($start) == ''){
            return "{$field} between 0 and {$end} and ";
        }else{
            return "{$field} between {$start} and {$end} and ";
        }
    }
}

function concatCATM($field,$cc,$aa,$tt,$mm){
    if (trim($mm) != '' && $mm != 0){
        return "{$field} = '{$mm}' and ";
    }else if (trim($tt) != '' && $tt != 0){ 
        return "{$field} between {$tt}00 and {$tt}99 and ";
    }else if (trim($aa) != '' && $aa != 0){
        return "{$field} between {$aa}0000 and {$aa}9999 and ";
    }else if (trim($cc) != '' && $cc != 0){
        return "{$field} between {$cc}000000 and {$cc}999999 and ";
    }
}

function getListAA($cc){
    //$sql = "select catm_ukey/10000 as tt_code, catm_desc from tabdb.ccaattmm where substr(catm_ukey,1,2) = {$cc} and flag_area=2 and catm_tdate=0";
    $sql = "select rcode_code,rcode_desc from tabdb.rcode where (substr(rcode_code,1,2) = {$cc} and substr(rcode_code,3,2)>'00') order by rcode_code";
    try{
        $conn_id = connectORS();
        $stmt = prepare($conn_id,$sql);
        execute($stmt);
        $result['num'] = fetch_all($stmt,$result['row']);
        if ($result['num'] == 0 ){
            $str_result = "0|";
        }else{
            $str_result = "1|{$result['num']}|";
            foreach ($result['row'] as $row) {
            //echo "<tr>\n";
                foreach ($row as $item) {
                    //$item = iconv('TIS-620','UTF-8',$item);
		    $item = trim($item);
                    $str_result .= "{$item}|";
                }
            }    
        } 
        free_statement($stmt);
        close_conn($conn_id);
        //return $result;
	//echo $str_result;
        return $str_result;
    }catch (Exception $e){
        throw $e;
    }
}

function getListTT($aa){
    $sql = "select catm_ukey/100 as tt_code, catm_desc from tabdb.ccaattmm where substr(catm_ukey,1,4) = {$aa} and flag_area in (3,6) and catm_tdate=0";
    try{
        $conn_id = connectORS();
        $stmt = prepare($conn_id,$sql);
        execute($stmt);
        $result['num'] = fetch_all($stmt,$result['row']);
        if ($result['num'] == 0 ){
            $str_result = "0|";
        }else{
            $str_result = "1|{$result['num']}|";
            foreach ($result['row'] as $row) {
            //echo "<tr>\n";
                foreach ($row as $item) {
                    //$item = iconv('TIS-620','UTF-8',$item);
                    $str_result .= "{$item}|";
                }
            }    
        } 
        free_statement($stmt);
        close_conn($conn_id);
        //return $result;
	//echo $str_result;
        return $str_result;
    }catch (Exception $e){
        throw $e;
    }
}

function getListMM($tt){
    $sql = "select catm_ukey as mm_code, catm_desc from tabdb.ccaattmm where substr(catm_ukey,1,6) = {$tt} and flag_area=4 and catm_tdate=0";
    try{
        $conn_id = connectORS();
        $stmt = prepare($conn_id,$sql);
        execute($stmt);
        $result['num'] = fetch_all($stmt,$result['row']);
        if ($result['num'] == 0 ){
            $str_result = "0|";
        }else{
            $str_result = "1|{$result['num']}|";
            foreach ($result['row'] as $row) {
                foreach ($row as $item) {
                    //$item = iconv('TIS-620','UTF-8',$item);
                    $str_result .= "{$item}|";
                }
            }    
        } 
        free_statement($stmt);
        close_conn($conn_id);
        return $str_result;
    }catch (Exception $e){
        throw $e;
    }
}

?>
