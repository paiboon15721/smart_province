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

function addCommas(nStr){
    nStr += '';
    var x = nStr.split('.');
    var x1 = x[0];
    var x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

function isDate(day,month,year){
	month = month-1; // month in js[0-11]
	year = year-543;
	source_date = new Date(year,month,day);
    if ((day != source_date.getDate()) || (month != source_date.getMonth()) || (year != source_date.getFullYear())){
        return false;
    }
	return true;
}

function strPopSt(pop_st){
    switch (parseInt(pop_st,10)){
        case 0: return "บุคคลนี้มีภูมิลำเนาอยู่ในบ้านนี้";
        case 1: return "บุคคลนี้ถูกจำหน่ายชื่อจากทะเบียนบ้านเนื่องจากตาย"; 
        case 2: return "บุคคลนี้ถูกจำหน่ายชื่อจากทะเบียนบ้านด้วย ท.ร.97";
        case 3: return "รายการนี้ถูกจำหน่ายเนื่องจากเปลี่ยนสถานภาพด้วย ท.ร.98";
        case 4: return "บุคคลนี้ย้ายไปต่างประเทศ";
        case 5: return "รายการนี้ถูกจำหน่ายเนื่องจากมีชื่อซ้ำซ้อน";
        case 6: return "บุคคลนี้ถูกจำหน่ายตามระเบียบข้อ 110";
        case 7: return "รายการนี้ถูกจำหน่ายชื่อจากทะเบียนบ้านแล้ว ";
        case 8: return "บุคคลนี้อยู่ในทะเบียนบ้านกลางห้ามนำเอกสารไปอ้างอิงหรือใช้สิทธิ์ในกรณีต่างๆ";
        case 9: return "บุคคลนี้แจ้งย้ายออกจากทะเบียนบ้านหลังนี้แล้ว";
        case 10: return "รายการนี้ถูกจำหน่ายแล้วและได้เพิ่มชื่อโดยเลขประจำตัวประชาชนใหม่";
        case 11: return "บุคคลนี้แจ้งตายแล้ว แต่ยังไม่ได้จำหน่ายออกจากทะเบียนบ้าน";
        case 12: return "รายการนี้ถูกจำหน่ายกรณีสละสัญชาติไทย"; 
        case 13: return "บุคคลนี้สละสัญชาติไทยแล้วและแจ้งตาย";
        case 14: return "จำหน่ายบุคคลห้ามเคลื่อนไหวทางการทะเบียน";
        case 15: return "Caution Sign";
        default : return "-" + "("+pop_st+")";
    }
}

function strOwnSt(own_st){
    switch (parseInt(own_st,10)){
        case 0 : return "ผู้อาศัย";
        case 1 : return "เจ้าบ้าน"; 
        default : return "หัวหน้าครอบครัวที่ " + own_st; 
    }
}
function strSex(sex){
    switch (parseInt(sex,10)){
        case 1 : return "ชาย"; 
        case 2 : return "หญิง"; 
        default : return "-";
    }
}
