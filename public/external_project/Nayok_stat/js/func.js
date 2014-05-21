String.prototype.trim=function(){return this.replace(/^\s+|\s+$/g, '');};

String.prototype.ltrim=function(){return this.replace(/^\s+/,'');};

String.prototype.rtrim=function(){return this.replace(/\s+$/,'');};

String.prototype.fulltrim=function(){return this.replace(/(?:(?:^|\n)\s+|\s+(?:$|\n))/g,'').replace(/\s+/g,' ');};

function formatPid(pid){
    var str = pid;
    if (str.length == 12){
        str = '0'+str;
    }
    return str.substring(0,1)+'-'+str.substring(1,5)+'-'+str.substring(5,10)+'-'+str.substring(10,12)+'-'+str.substring(12,13);
}

function formatHid(hid){
    var str = hid;
    return str.substring(0,4)+'-'+str.substring(4,10)+'-'+str.substring(10,11);
}
/*แสดงวันที่แบบสั้น*/
function displayDate(ymd){
  	var d = ymd.substring(6,8);
	var m = ymd.substring(4,6);
	var y = ymd.substring(0,4);
    var mthDesc;
    var dmy;
    if (parseInt(ymd,10) == 0){
        return "-";
    }
    if (ymd.length < 4){
        return ymd;
    }
    d = parseInt(d,10);
	switch(m){
		case "01" : mthDesc = "ม.ค."; break;
		case "02" : mthDesc = "ก.พ."; break;
		case "03" : mthDesc = "มี.ค."; break;
		case "04" : mthDesc = "เม.ย."; break;
		case "05" : mthDesc = "พ.ค."; break;
		case "06" : mthDesc = "มิ.ย."; break;
		case "07" : mthDesc = "ก.ค."; break;
		case "08" : mthDesc = "ส.ค."; break;
		case "09" : mthDesc = "ก.ย."; break;
		case "10" : mthDesc = "ต.ค."; break;
		case "11" : mthDesc = "พ.ย."; break;
		case "12" : mthDesc = "ธ.ค."; break;
        case "00" : mthDesc = ""; break;
	}
	//dmy = sprintf("%d %s %s",d,mthDesc,y);
    if (d == '00'){
        d = '';
    }
    if (y == '0000'){
        y = '';
    }
    dmy = d + ' ' + mthDesc + ' ' + y;
	return dmy;
}

function strAddr(hno,ccaattmm,thanon,trok,soi1,soi2,cc,aa,tt,mm){
var str=' ';
var moo=' ';    
    if (hno.trim() != ""){
        str = hno.trim();
    }
    if (thanon.trim() != ""){
        str = str +  " ถนน"+thanon;
    }
    if (trok.trim() != ""){
        str = str + " ตรอก"+trok;
    }
    if (soi1.trim() != ""){
        str = str + " ซอย"+soi1;
    }else if (soi2.trim() != ""){
        str = str + " ซอย"+soi2;
    }
    
    moo = ccaattmm.substring(6,8);
    if (moo != "00"){
        str = str + " หมูที่ "+parseInt(moo,10);
    }
    if (tt.trim() != ""){
        if (cc != 'กรุงเทพมหานคร'){
            str = str +" ตำบล"+tt;
        }else{
            str = str +" แขวง"+tt;
        }
    }
    if (aa.trim() != ""){
        if (cc != 'กรุงเทพมหานคร'){
            str = str + " อำเภอ"+aa;
        }else{
            str = str + " "+aa;
        }
    }
    if (cc.trim() != ""){
        if (cc != 'กรุงเทพมหานคร'){
            str = str + " จังหวัด"+cc;
        }else{
            str = str + " "+cc;
        }
    }
    //alert("str ="+ str);
    return str.trim();
}

