/*การแจ้งเตือน*/
var myText = new Array();
myText ['TH'] = new Array();	//ไทย
myText ['TH']['wait'] = "กรุณารอสักครู่";
myText ['TH']['txt1'] = "กรุณากรอก";
myText ['TH']['txt2'] = "กรุณาเลือก";
myText ['TH']['txt3'] = "กรุณากรอกข้อมูลให้ครบ";
myText ['TH']['txt4'] = "กรุณาเลือกข้อมูลให้ครบ";
myText ['TH']['change'] = "กรุณายืนยันการปรับเปลี่ยนอีกครั้ง";
myText ['TH']['confirm'] = "กรุณายืนยันการบันทึกอีกครั้ง";
myText ['TH']['confirm_approve'] = "กรุณายืนยันการอนุมัติอีกครั้ง";
myText ['TH']['add_confirm'] = "กรุณายืนยันการเพิ่มอีกครั้ง";
myText ['TH']['del_confirm'] = "กรุณายืนยันการลบอีกครั้ง";
myText ['TH']['reg_confirm'] = "กรุณายืนยันการลงทะเบียนอีกครั้ง";
myText ['TH']['refresh'] = "กรุณายืนยันการส่งใหม่อีกครั้ง";
myText ['TH']['dup'] = "ซ้ำ กรุณาตรวจสอบ";
myText ['TH']['id_card_chk'] = "กรุณากรอกหมายเลขบัตรประจำตัวประชาชนให้ถูกต้อง";
myText ['TH']['chk_credit'] = "กรุณากรอกหน่วยกิตให้ครบถ้วน";
myText ['TH']['chk_number'] = "กรุณากรอกเป็นตัวเลขเท่านั้น";
myText ['TH']['add'] = "เพิ่มข้อมูล";
myText ['TH']['edit'] = "แก้ไขข้อมูล";
myText ['TH']['del'] = "ลบข้อมูล";
myText ['TH']['proc_add'] = "บันทึกข้อมูลเรียบร้อยแล้ว";
myText ['TH']['proc_edit'] = "แก้ไขข้อมูลเรียบร้อยแล้ว";
myText ['TH']['proc_del'] = "ลบข้อมูลเรียบร้อยแล้ว";
myText ['TH']['err_del'] = "ไม่สามารถลบรายการได้ เนื่องจากมีข้อมูลนำไปใช้แล้ว โปรดตรวจสอบ";
myText ['TH']['chk_spechar'] = "ห้ามกรอกอักขระพิเศษ";
myText ['EN'] = new Array(); //อังกฤษ
myText ['EN']['wait'] = "Please wait";
myText ['EN']['txt1'] = "Please enter your ";
myText ['EN']['txt2'] = "Please choose your ";
myText ['EN']['txt3'] = "Please enter all fields are mandatory.";
myText ['EN']['txt4'] = "Please choose all fields are mandatory.";
myText ['EN']['change'] = "Confirm Change Again Please";
myText ['EN']['confirm'] = "Confirm Save Again Please";
myText ['EN']['confirm_approve'] = "Confirm Approve Again Please";
myText ['EN']['del_confirm'] = "Confirm Delete Again Please";
myText ['EN']['add_confirm'] = "Confirm Add Again Please";
myText ['EN']['reg_confirm'] = "Confirm Register Again Please";
myText ['EN']['refresh'] = "Confirm Send new Again Please";
myText ['EN']['dup'] = "Duplicate Check Please";
myText ['EN']['id_card_chk'] = "Please enter a valid identity card number";
myText ['EN']['chk_credit'] = "Please complete the required credits";
myText ['EN']['chk_number'] = "Please enter only number";
myText ['EN']['add'] = "Add data";
myText ['EN']['edit'] = "Edit data";
myText ['EN']['del'] = "Delete data";
myText ['EN']['proc_add'] = "Add data Completed";
myText ['EN']['proc_edit'] = "Edit data Completed";
myText ['EN']['proc_del'] = "Delete data Completed";
myText ['EN']['err_del'] = "Can not delete items. Because I have to check";
myText ['EN']['chk_spechar'] = "Do not enter special characters";

var messageObj = new DHTML_modalMessage();

var fn_search_data = function(v, url, div) {
    if (v == 1) {
        LoadInputpage(1, 'ajax', url, 400, 200, 'proc=search', div);
        $('#a_search_enable').hide();
        $('#a_search_disble').show();
    } else {
        LoadInputpage(1, 'ajax', '', 400, 200, 'proc=search', div);
        $('#a_search_disble').hide();
        $('#a_search_enable').show();
    }
}

var input_ClassLoader = function(f) {
    $(f + ':text.type_num').numberonly({decimals: 1}).val();
    $(f + ':text.type_num_dot').numberonly({decimals: 0, textalign: 'left', useStepZero: false});
    $(f + ':text.type_num_grade').numberonly({decimals: 2}).val();
    $(f + ':text.type_num_per').numberonly({}).keydown(function(e) {
        if ($(this).val().split(",").join("") > 100) {
            $(this).val('100.00');
            return false;
        }
    }).blur(function(e) {
        if ($(this).val().split(",").join("") > 100) {
            $(this).val('100.00');
            return false;
        }
    });
    $(f + ':text.type_num_score').numberonly({decimals: 0}).keydown(function(e) {
        if ($(this).val().split(",").join("") > 100) {
            $(this).val('100');
            return false;
        }
    }).blur(function(e) {
        if ($(this).val().split(",").join("") > 100) {
            $(this).val('100');
            return false;
        }
    });
    $(f + ':text.type_none_dot').numberonly({decimals: 0}).val();
    $(f + ':text.type_num_readOnly').attr('readonly', true).removeClass("MainClass").addClass("bg_readOnly").css({'text-align': 'right'});
    $(f + ':text.type_num_readOnly[value=""]').val('0.00');
    $(f + ':text.type_date').attr('readonly', true).removeClass("MainClass").addClass("bg_readOnly").css({'text-align': 'right'})
            .focus(function() {
                $(this).select();
            })
            .datepick({showOn: 'button', buttonImageOnly: true});
    $(f + ':text.type_date_key').attr('readonly', false).addClass("MainClass").css({'text-align': 'right'})
            .focus(function() {
                $(this).select();
            })
            .datepick({showOn: 'button', buttonImage: '../../css/datepicker/calenda.png', buttonImageOnly: true});
    $(f + ':text.type_date_key1').attr('readonly', false).addClass("MainClass").css({'text-align': 'right'})
            .focus(function() {
                $(this).select();
            })
            .datepick({showOn: 'button', buttonImage: '../../../css/datepicker/calenda.png', buttonImageOnly: true});
    $(f + ':text.type_date_key2').attr('readonly', false).addClass("MainClass").css({'text-align': 'right'})
            .focus(function() {
                $(this).select();
            })
            .datepick({showOn: 'button', buttonImage: '../../../../css/datepicker/calenda.png', buttonImageOnly: true});
}

var new_win_def_prot2 = function(mypage, myname, w, h, scroll, fullscreen) { //Show center screen,focus page in use
    //alert(mypage);
    var winl = (screen.width - w) / 2;
    var wint = (screen.height - h) / 2;
    winprops = 'height=' + h + ',width=' + w + ',top=' + wint + ',left=' + winl + ',scrollbars=' + scroll + ',fullscreen=' + fullscreen + ',resizable,toolbar=no,location=no,status=no,menubar=no'
    wins = window.open(mypage, myname, winprops);
    if (parseInt(navigator.appVersion) >= 4) {
        wins.window.focus();
    }
}

var LoadInputpage = function(a, b, c, d, e, f, g) {
    //alert(a);alert(b);alert(c);alert(d);alert(e);alert(f);alert(g);
    if (a == undefined) {
        var a = 1;
    } // Type url
    if (b == undefined) {
        var b = msg;
    } // Type show
    if (c == undefined) {
        alert('Error!! Page not Found !!');
        return false;
    } // Url
    if (d == undefined) {
        var d = 500;
    } // Width
    if (e == undefined) {
        var h = 250;
    } // Height
    if (g == undefined) {
        var g = '';
    }

    var w = d;
    var h = e;
    var condit = '';
    //var conditB='';
    var url = '';
    switch (a) {
        case 1 :
            condit = Math.random();
            url = c + '?' + condit + f;
            break;
        case 2 :
            condit = Math.random();
            url = c + '?' + condit + f;
            break;
    }
    switch (b) {
        case 'msg' :
            //messageObj = new DHTML_modalMessage();
            messageObj.setSource(url);
            messageObj.setCssClassMessageBox(false);
            messageObj.setSize(w, h);
            messageObj.setShadowDivVisible(true);
            messageObj.display();
            //alert(messageObj.divs_content);
            break;
        case 'new'  :
            new_win_def_prot2(url, 'NewPage' + parseInt(Math.random()) + '', w, h, 1, 0);
            break;
        case 'newfull'  :
            new_win_def_prot2(url, 'NewPage' + parseInt(Math.random()) + '', w, h, 1, 1);
            break;
        case 'ajax' :
            var data = '';
            $(g).load(url, data, function() {
            });
            break;
        case 'self'  :
        default :
            self.location.href = url;
            break;
    }
}

var b_search_in_page_dislay = function() {
    var url = urlmain + '?' + getCondit() + conditB;
    self.location.href = url;
}
var targetpage2 = function(a, b) {
    var url = urlmain + '?' + getCondit() + conditB;
    url += '&' + a;
    self.location.href = url;
}
function path_page(url) { //alert(url);
    if (url == undefined) {
        alert('Error!! Page not Found !!');
        return false;
    }
    if (url == '') {
        alert('Error!! Page not Found !!');
        return false;
    }
    var form = $('form[id!=form_arr]').attr('id');
    //alert(form);
    //var $inputs = $('#'+form+' input:hidden');       // not sure if you wanted this, but I thought I'd add it.     // get an associative array of just the values.
    var $inputs = $('#' + form + ' :hidden.page');
    condit = Math.random() + '&menu_id=' + $('#menu_head_id').val();
    url = url + '?' + condit;
    $inputs.each(function() {
        url = url + '&' + $(this).attr("name") + '=' + $(this).val();
    });
    //alert(url);
    document.location.href = url;
}

function view_std(id) {
    //LoadInputpage(1,'new',"../../student/studentinfo/input_history_view.php",800,400,'&proc=view&mod=1&STUDENT_ID='+id);
    window.open('../../student/studentinfo/input_history_view.php?proc=view&mod=1&STUDENT_ID=' + id, '', 'scrollbars,resizable,toolbar=no,location=no,status=no,menubar=no');
}

function addRowAttch() {
    rowsnum = document.getElementById('rownums_doc').value;
    if (rowsnum == 0) {
        $('#tb_add tr[id=nonetr]').remove();
    }
    if (rowsnum > 0) {
        next_row = parseInt(rowsnum) + parseInt(1);
    } else {
        next_row = 1;
    }
    var trTemp = '<tr id="rowtr' + next_row + '" class="rowtr report_dashed_detail_s"><td align="center">' + next_row + ')</td><td align="center" nowrap><input id="FILE_NAME' + next_row + '" name="FILE_NAME[' + next_row + ']"  type="text" class="MainClass" size="35"> <span class="text_alert">*</span></td><td align="left"><input type="file" id="FILE_PATH' + next_row + '" name="FILE_PATH[' + next_row + ']" class="MainClass"></td><td align="center"><img src="../../images/del.gif" width="14" height="14" title="ลบข้อมูล" align="absmiddle" id="' + (next_row) + '" onclick="delDocAttch(\'' + (next_row) + '\')" class=\"img_class_input\"></td></tr>';
    $("#tb_add").append(trTemp);

    document.getElementById('rownums_doc').value = parseInt(rowsnum) + parseInt(1);
    document.getElementById('next_row_doc').value = next_row;
}

function delDocAttch(id) {
    rowsnum = $('#tb_add tr.rowtr').length;
    if (rowsnum == 1) {
        $('#tb_add tr[id=nonetr]').show();
    }
    //$('#new_regis_doc_id'+id).val('del');
    //$('#tb_add tr.rowtr[id=rowtr'+id+']').remove();
    //$('#tb_add tr.rowtr[id=rowtr'+id+']').remove();
    $('#rowtr' + id).remove();
    $('#rownums_doc').val($("#rownums_doc").val() - 1);
    //$('#next_row_doc').val($("#next_row_doc").val()-1);
}
function delDocAttchvalue(row_id, id, table) {
    if (!confirm('กรุณายืนยันการลบอีกครั้ง')) {
        return false;
    } else {
        //var ConDit = '&id='+id+'&table='+table+'&row_id='+row_id;
        var url = '../../include/del_doc_attach.php?&id=' + id + '&table=' + table + '&row_id=' + row_id;
        $.get(url, function(msg) {
            delDocAttch(msg);
        });
    }
}

function isNum(charCode) {
    if (charCode >= 48 && charCode <= 57)
        return true;
    else
        return false;
}

function chkFormatNam(str, input) {// Can Be {0-9,-.}
    strlen = str.length;
    var amount = '';
    var dot = 0;
    var minus = 0;
    for (i = 0; i < strlen; i++) {
        var charCode = str.charCodeAt(i);
        if (!isNum(charCode)) {
            if (charCode == '44') {
            } else if (charCode == '45' && minus != 1) {
                minus = 1;
                if (i != 0) {
                    amount = '';
                }
            } else if (charCode == '45' && minus == 1) {
                amount = '';
            } else if (charCode == '46' && dot != 1) {
                dot = 1;
                if (i == 1 && minus == 1) {
                    amount = '-0';
                } else if (i == 0) {
                    amount = 0;
                }
            } else if (charCode == '46' && dot == 1) {
                if (minus == 1) {
                    amount = '-0';
                } else if (minus != 1) {
                    amount = 0;
                }
            } else {
                alert('กรุณากรอกข้อมูลตัวเลขเท่านั้น');
                //alert(myText [$('#lang').val()]['chk_number']);

                $("input[name = '" + input + "']").val('');
                $("input[name = '" + input + "']").focus();
                return false;
            }
        }
        amount += str.charAt(i);
    }//for
    //document.getElementById(input).value=amount;
    $("input[name = " + input + "]").val(amount);
    return true;
}
function getMaj(curri_code, maj_id, maj_name, maj_select, maj_span, style_id, style_name, style_select, style_span, tool_id, tool_name, tool_select, tool_span, style) {
    url = "../../include/getc.php";
    $.post(url, {proc: 'getMaj', curri_code: curri_code, maj_id: maj_id, maj_name: maj_name, maj_select: maj_select, maj_span: maj_span, style_id: style_id, style_name: style_name, style_select: style_select, style_span: style_span, tool_id: tool_id, tool_name: tool_name, tool_select: tool_select, tool_span: tool_span, style: style}, function(data) {
        $("#" + maj_span).html(data);
    })
}

function getStyle(maj_id, style_id, style_name, style_select, style_span, tool_id, tool_name, tool_select, tool_span, style) {
    url = "../../include/getc.php";
    $.post(url, {proc: 'getStyle', maj_id: maj_id, style_id: style_id, style_name: style_name, style_select: style_select, style_span: style_span, tool_id: tool_id, tool_name: tool_name, tool_select: tool_select, tool_span: tool_span, style: style}, function(data) {
        $("#" + style_span).html(data);
    })
}

function getTool(style_id, tool_id, tool_name, tool_select, tool_span, style) {
    /*alert(style_id);
     alert(tool_id);
     alert(tool_name);
     alert(tool_span);*/
    url = "../../include/getc.php";
    $.post(url, {proc: 'getTool', style_id: style_id, tool_id: tool_id, tool_name: tool_name, tool_select: tool_select, tool_span: tool_span, style: style}, function(data) {
        $("#" + tool_span).html(data);
    })
}

//*** Chk Date Format (dd/mm/yyyy) ***//
function beginchk(ip, ek, id_txt) {//เริ่มต้นการรับพารามิเตอร์จากคีย์บอร์ด

    if ((ek.keyCode > 47 && ek.keyCode < 58) || ek.keyCode == 8 || ek.keyCode == 46 || ek.keyCode == 144 || ek.keyCode == 111 || (ek.keyCode > 95 && ek.keyCode < 106) || (ek.keyCode > 36 && ek.keyCode < 41)) {//อนุญาตให้พิมพ์ตัวเลข Delete Backspace Left Right Up Down

        if (ip.value.match("^([0-9]{2})/([0-9]{2})//$")) {
            ip.value = ip.value.substring(0, 6);
            return true;

        } else if (ip.value.match("^([0-9]{2})/([0-9]{2})$") && ek.keyCode != 8) {//ตรวจสอบพารามิเตอร์โดยเลือกใช้ Regular Expression
            ip.value = ip.value + "/";
            return true;

        } else if (ip.value.match("^([0-9]{2})//$") && ek.keyCode != 8) {
            ip.value = ip.value.substring(0, 3);
            return true;

        } else if (ip.value.match("^([0-9]{2})$") && ek.keyCode != 8) {//ตรวจสอบพารามิเตอร์โดยเลือกใช้ Regular Expression
            ip.value = ip.value + "/";
            return true;

        } else if (ip.value.match("^([0-9]{2})/([0-9]{2})/([0-9]{4})$")) {//ตรวจสอบพารามิเตอร์โดยเลือกใช้ Regular Expression
            isDate(ip.value, ip);//ส่งพารามิเตอร์ไปตรวจสอบที่ฟังก์ชั่น isDate ว่ากรอกวันเดือนปีถูกต้องหรือไม่
            return true;

        } else if (ip.value.length > 10) {//เงื่อนไขนี้ตรวจสอบว่าห้ามกรอกข้อมูลเกินสิบหลักถ้าเกินให้ตัดตัวสุดท้ายทิ้ง
            ip.value = ip.value.substring(0, 10);
            isDate(ip.value, ip);
            return true;
        }

    } else {//แจ้งเตือนถ้าคีย์ข้อความที่ไม่ใช่ตัวเลข
        alert('กรอกได้เฉพาะค่าตัวเลข');
        ip.value = '';
        return true;
    }
}

//เริ่มต้นเช็คค่าวันที่ที่กรอกลงมา
//Date Validation just copy and paste this cod

var dtCh = "/";

var minYear = 1900 + 543;
var maxYear = 2100 + 543;
var minYearA = 1900 + 543;//ค่าตัวแปรที่สองเอาไว้โชว์ค่าพุทธศักราชไทยอะครับ ^^
var maxYearA = 2100 + 543;//ค่าตัวแปรที่สองเอาไว้โชว์ค่าพุทธศักราชไทยอะครับ ^^

function isInteger(s)//ฟังก์ชั่นเช็คค่าตัวเลข
{
    var i;
    for (i = 0; i < s.length; i++)
    {
// Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9")))
            return false;
    }
// All characters are numbers.
    return true;
}

function stripCharsInBag(s, bag)//เช็ครูปแบบ
{
    var i;
    var returnString = "";
// Search through string's characters one by one.
// If character is not in bag, append to returnString.
    for (i = 0; i < s.length; i++)
    {
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1)
            returnString += c;
    }
    return returnString;
}

function daysInFebruary(year)//เช็คค่าวันที่ 29 กุมภาพันธ์ ในแต่ละปี
{
// February has 29 days in any year evenly divisible by four,
// EXCEPT for centurial years which are not also divisible by 400.
    return (((year % 4 == 0) && ((!(year % 100 == 0)) || (year % 400 == 0))) ? 29 : 28);
}
function DaysArray(n) //เช็ควันสุดท้ายของแต่ละเดือน
{
    for (var i = 1; i <= n; i++)
    {
        this[i] = 31
        if (i == 4 || i == 6 || i == 9 || i == 11) {
            this[i] = 30
        }
        if (i == 2) {
            this[i] = 29
        }
    }
    return this
}

function isDate(dtStr, ip)//ฟังก์ชั่นหลักในการเช็คค่าวันที่ ถ้ากรอกวันเดือนปีผิดจะแจ้งเตือนผู้ใช้งาน
{
    var daysInMonth = DaysArray(12)
    var pos1 = dtStr.indexOf(dtCh)
    var pos2 = dtStr.indexOf(dtCh, pos1 + 1)
    var strDay = dtStr.substring(0, pos1)
    var strMonth = dtStr.substring(pos1 + 1, pos2)
    var strYear = dtStr.substring(pos2 + 1)
    strYr = strYear

    if (strDay.charAt(0) == "0" && strDay.length > 1)
        strDay = strDay.substring(1)//ตัดเลข0

    if (strMonth.charAt(0) == "0" && strMonth.length > 1)
        strMonth = strMonth.substring(1)//ตัดเลข0

    for (var i = 1; i <= 3; i++) {

        if (strYr.charAt(0) == "0" && strYr.length > 1)
            strYr = strYr.substring(1)//ตัดเลข0
    }
    day = parseInt(strDay)
    month = parseInt(strMonth)
    year = parseInt(strYr)
    /*
     if ($("#lang").val() == 'TH') {
     year=year-543;
     }
     */

    if (pos1 == -1 || pos2 == -1)
    {
        alert("The date format should be : dd/mm/yyyy")
        ip.value = ''
        return false
    }

    if (strDay.length < 1 || day < 1 || day > 31 || (month == 2 && day > daysInFebruary(year)) || day > daysInMonth[month])
    {
        alert("Please enter a valid day")
        ip.value = ''
        return false
    }

    if (strMonth.length < 1 || month < 1 || month > 12)
    {
        alert("Please enter a valid month")
        ip.value = ''
        return false
    }

    if (strYear.length != 4 || year == 0 || year < minYear || year > maxYear)
    {
        alert("Please enter a valid 4 digit year between " + minYearA + " and " + maxYearA)
        ip.value = ''
        return false
    }

    if (dtStr.indexOf(dtCh, pos2 + 1) != -1 || isInteger(stripCharsInBag(dtStr, dtCh)) == false)
    {
        alert("Please enter a valid date")
        ip.value = ''
        return false
    }
    return true
}



function check_number(ch) {
    var len, digit;
    if (ch == " ") {
        return false;
        len = 0;
    } else {
        len = ch.length;
    }
    for (var i = 0; i < len; i++)
    {
        digit = ch.charAt(i)
        if (digit >= "0" && digit <= "9") {
            ;
        } else {
            return false;
        }
    }
    return true;
}

function checkvalue(lang, input_id)
{
    if (!check_number(document.getElementById(input_id).value)) // || document.getElementById(input_id).value == ""
    {
        alert(myText [lang]['chk_number']);
        document.getElementById(input_id).value = '';
        return false;
    } else {
        return true;
    }
}

function checkvaluePage(lang, input_id)
{
    if (!check_number(document.getElementById(input_id).value) || document.getElementById(input_id).value == 0) // || document.getElementById(input_id).value == ""
    {
//alert(myText [lang]['chk_number']);
        document.getElementById(input_id).value = '';
        return false;
    } else if (document.getElementById(input_id).value == ' ') {
        alert(myText[lang]['txt1']);
        document.getElementById(input_id).focus();
    } else {
        return true;
    }
}


function chk_specialchar(lang, data, obj) {

    var iChars = "!@#$%^&*()+=-[]\\\';,./{}|\":<>?~_";
    for (var i = 0; i < data.length; i++) {
        if (iChars.indexOf(data.charAt(i)) != -1) {
            alert(myText [lang]['chk_spechar']);
            obj.value = '';
            return false;
        }
    }
}

function NumberOnly(event) {
    if (navigator.appName == "Microsoft Internet Explorer") {
        if ((event.keyCode < 48 || event.keyCode > 57 || event.keyCode == 46)) {
            event.returnValue = false;
            return false;
        } else {
            return true;
        }
    } else if (navigator.appName == "Netscape") {
        if ((event.which < 48 || event.which > 57 || event.which == 46)) {
            event.returnValue = false;
            return false;
        } else {
            return true;
        }
    }
}

function NumberFormat(obj) {
    obj.value = Number(obj.value.split(",").join(""));
    if (isNaN(obj.value)) {
        obj.value = 0;
    } else {
        number_format(obj, 2);
    }
}

function number_format(number, decimals, dec_point, thousands_sep) {
    // Formats a number with grouped thousands
    //
    // version: 1109.2015
    // discuss at: http://phpjs.org/functions/number_format    // +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +     bugfix by: Michael White (http://getsprink.com)
    // +     bugfix by: Benjamin Lupton
    // +     bugfix by: Allan Jensen (http://www.winternet.no)    // +    revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // +     bugfix by: Howard Yeend
    // +    revised by: Luke Smith (http://lucassmith.name)
    // +     bugfix by: Diogo Resende
    // +     bugfix by: Rival    // +      input by: Kheang Hok Chin (http://www.distantia.ca/)
    // +   improved by: davook
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // +      input by: Jay Klehr
    // +   improved by: Brett Zamir (http://brett-zamir.me)    // +      input by: Amir Habibi (http://www.residence-mixte.com/)
    // +     bugfix by: Brett Zamir (http://brett-zamir.me)
    // +   improved by: Theriault
    // +      input by: Amirouche
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)    // *     example 1: number_format(1234.56);
    // *     returns 1: '1,235'
    // *     example 2: number_format(1234.56, 2, ',', ' ');
    // *     returns 2: '1 234,56'
    // *     example 3: number_format(1234.5678, 2, '.', '');    // *     returns 3: '1234.57'
    // *     example 4: number_format(67, 2, ',', '.');
    // *     returns 4: '67,00'
    // *     example 5: number_format(1000);
    // *     returns 5: '1,000'    // *     example 6: number_format(67.311, 2);
    // *     returns 6: '67.31'
    // *     example 7: number_format(1000.55, 1);
    // *     returns 7: '1,000.6'
    // *     example 8: number_format(67000, 5, ',', '.');    // *     returns 8: '67.000,00000'
    // *     example 9: number_format(0.9, 0);
    // *     returns 9: '1'
    // *    example 10: number_format('1.20', 2);
    // *    returns 10: '1.20'    // *    example 11: number_format('1.20', 4);
    // *    returns 11: '1.2000'
    // *    example 12: number_format('1.2000', 3);
    // *    returns 12: '1.200'
    // *    example 13: number_format('1 000,50', 2, '.', ' ');    // *    returns 13: '100 050.00'
    // Strip all characters but numerical ones.
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals), sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

//*** End Chk Date Format ***//

// ## Function For Calculate Fee ## //
function getAjaxPetitionFee() {
    var url = "ajax/ajax_fee_calculate.php";
    var form = $('form[id!=form_arr]').attr('id');
    condit = Math.random();
    url = url + '?' + condit;
    $("input:hidden").each(function() {
        url = url + '&' + $(this).attr("name") + '=' + $(this).val();
    });
    $("input:text").each(function() {
        url = url + '&' + $(this).attr("name") + '=' + $(this).val();
    });
    $("input:checkbox:checked").each(function() {
        url = url + '&' + $(this).attr("name") + '=' + $(this).val();
    });
    $("input:radio:checked").each(function() {
        url = url + '&' + $(this).attr("name") + '=' + $(this).val();
    });
    $.get(url, function(data) {
        $("#FeeZone").html(data);
    })
}

function getCountPost() {
    var count_post = 0;
    $("input:radio[name^='fdd_method_']:checked").each(function() {
        if ($(this).val() == 2) {
            count_post++;
        }
    });
    $("#count_post").val(count_post);
    getAjaxPetitionFee();
}

function checkedAllReg() {
    if ($("#chk_fin_all").attr('checked')) {
        $("input[id^=e_fee_use_id_]").attr("checked", "checked");
        $("input[id^=e_fee_subj_id_]").attr("checked", "checked");
    } else {
        $("input[id^=e_fee_use_id_]").attr("checked", "");
        $("input[id^=e_fee_subj_id_]").attr("checked", "");
    }
}

function checkedChildNode(row_id, obj_id) {
    var bool = $("#" + obj_id).attr("checked");
    $("input[id^='e_fee_subj_id_" + row_id + "_']").each(function() {
        if (bool) {
            $(this).attr("checked", "checked");
        } else {
            $(this).attr("checked", "");
        }
    });
    ajaxFeeRegis();
}

function checkParentNode(row_id) {
    var count = $("input[id^='e_fee_subj_id_" + row_id + "_']:checked").length;
    if (count == 0) {
        $("input[id='e_fee_use_id_" + row_id + "']").attr("checked", "");
    } else {
        $("input[id='e_fee_use_id_" + row_id + "']").attr("checked", "checked");
    }
    ajaxFeeRegis();
}

function ajaxFeeRegis() {
    var url = "ajax/ajax_fee_calculate.php";
    condit = Math.random();
    url = url + '?' + condit;
    /*
     $("input:hidden").each(function() {
     url = url+'&'+$(this).attr("name")+'='+$(this).val();
     });
     $("input:text").each(function() {
     url = url+'&'+$(this).attr("name")+'='+$(this).val();
     });
     $("input:checkbox:checked").each(function() {
     url = url+'&'+$(this).attr("name")+'='+$(this).val();
     });
     $("input:radio:checked").each(function() {
     url = url+'&'+$(this).attr("name")+'='+$(this).val();
     });
     */
    url = url + '&STD_ID=' + $('#STD_ID').val() + '&CURRI_CODE=' + $('#CURRI_CODE').val() + '&type=' + $('#type').val() + '&REGIS_ID=' + $('#REGIS_ID').val() + '&REGIS_TIME_ID=' + $("#REGIS_TIME_ID").val();
    $("input:hidden[name^='o_fee_use_id']").each(function() {
        url = url + '&' + $(this).attr("name") + '=' + $(this).val();
    });
    $("input:hidden[name^='o_fee_use_format']").each(function() {
        url = url + '&' + $(this).attr("name") + '=' + $(this).val();
    });
    $("input:hidden[name^='o_fee_subj_id_']").each(function() {
        url = url + '&' + $(this).attr("name") + '=' + $(this).val();
    });
    $("input:hidden[name^='o_csub_id_']").each(function() {
        url = url + '&' + $(this).attr("name") + '=' + $(this).val();
    });
    $("input:hidden[name^='a_subject_reg']").each(function() {
        url = url + '&' + $(this).attr("name") + '=' + $(this).val();
    });
    $("input:hidden[name^='a_subject_exempt']").each(function() {
        url = url + '&' + $(this).attr("name") + '=' + $(this).val();
    });
    $("input:hidden[name^='a_subject_audit']").each(function() {
        url = url + '&' + $(this).attr("name") + '=' + $(this).val();
    });
    $("input:hidden[name^='a_subject_drop']").each(function() {
        url = url + '&' + $(this).attr("name") + '=' + $(this).val();
    });
    $("input:checkbox[name^='e_fee_use_id']:checked").each(function() {
        url = url + '&' + $(this).attr("name") + '=' + $(this).val();
    });
    $("input:checkbox[name^='e_fee_subj_id_']:checked").each(function() {
        url = url + '&' + $(this).attr("name") + '=' + $(this).val();
    });
    $("input:hidden[name^='t_fee_subj_id_']").each(function() {
        url = url + '&' + $(this).attr("name") + '=' + $(this).val();
    });
    //alert(url);
    $.get(url, function(data) {
        $("#FeeZone").html(data);
    })
}

// ## ########################## ## //

function Number_DemicalOnly(fld, e)
{
    var strCheck = '0123456789.';
    var len = 0;
    var whichCode = (window.Event) ? e.which : e.keyCode;
    key = String.fromCharCode(whichCode);
    if (strCheck.indexOf(key) == -1) {
        return false;
    }
}

function chkDatePeriod(date_start, date_end) {
    var arr_start = date_start.split("/");
    var arr_end = date_end.split("/");
    var date_start_num = parseInt(arr_start[2] + arr_start[1] + arr_start[0]);
    var date_end_num = parseInt(arr_end[2] + arr_end[1] + arr_end[0]);
//	alert(date_end_num-date_start_num);
    if (date_end_num - date_start_num < 0)
        return false
    else
        return true;
}