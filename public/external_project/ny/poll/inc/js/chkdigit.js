function PidDash(a) {

var b = a.value.length;

		switch(b) {

			case 1 : case 6 : case 12 : case 15 : 

			a.value = a.value + "-";

		}

}

 function chkDigitPid(spid){
 var total = 0;
 var Pidval;
 var chk;
 var Validchk;
 var tmpPid = spid.replace(/-/gi, "");
/* tmpPid = spid.substr(0,1);
 tmpPid += spid.substr(2,4);
 tmpPid += spid.substr(7,5);
 tmpPid += spid.substr(13,2); 
 tmpPid += spid.substr(16,1);*/
 
 Pidval = tmpPid;
 
 Validchk = Pidval.substr( 12,1);
 var j = 0;
 var pidcut;
for (var n = 0; n < 12; n++) {
 pidcut = parseInt(Pidval.substr(j,1));
total = (total + ((pidcut) * (13 - n)));
j++;
}

chk = 11 - (total % 11);

if (chk == 10){
chk = 0;
}else if(chk==11){
chk = 1;
}
if (chk == Validchk) {
//alert("ระบุหมายเลขประจำตัวประชาชนถูกต้อง");
return true;
}else{
alert("ระบุหมายเลขประจำตัวประชาชนไม่ถูกต้อง");
return false;
}

 }