$(document).ready(function() {
   // var $tabs = $('#tab').tabs();
   // var tab_selected = $tabs.tabs('option', 'active');
   
    function closeWin(){
        var Browser = {   
            Version: function() {
            var version = 999; // we assume a sane browser
            if (navigator.appVersion.indexOf("MSIE") != -1)
                            // bah, IE again, lets downgrade version number
                version = parseFloat(navigator.appVersion.split("MSIE")[1]);
                return version;
            }
        }
        if (Browser.Version() < 7) {
            window.opener = null;
            window.close();
        }else if (Browser.Version() >= 7){
            window.open('','_parent','');
            window.close();
        }
    }
    
    if ($('#emp_pid').val() == ''){
        alert('คุณไม่มีสิทธิเข้าใช้งานระบบ');
        closeWin();
        $('#content').find('input, textarea, button, select').attr('disabled','disabled');
    }
    
    $('#tabs').tabs();
    $("#tabs").css("visibility", "visible");
    
    $("#btn_clear").click(function(e) {
        window.location.replace("search_pop.php");
    });

    $(function($){
        $("#txt_pid").mask("9-9999-99999-99-9");
        
        $("#txt_age_start").mask("9?99");
        $("#txt_age_end").mask("9?99");
        $("#txt_dob_start").mask("99/99/9999");
        $("#txt_dob_end").mask("99/99/9999");
        $("#txt_datemi_start").mask("99/99/9999");
        $("#txt_datemi_end").mask("99/99/9999");
        
        $("#txt_hid").mask("9999-999999-9");
        
    });

    //alert($("#catm").val());
    if (getListHType() != false){
        if (getCCDesc($("#catm").val().substr(0,2)) == true){
            if (getListAA($("#catm").val().substr(0,2)) == true){
                defaultCATM();
                disableSelCATM(true);
            }else{
                $("#btn_search").attr("disabled", true);
            }
        }else{
            $("#btn_search").attr("disabled", true);
        }
    }else{
        $("#btn_search").attr("disabled", true);
    }
    

    function disableSelCATM(flag){
  
        if ($("#catm").val().substr(2,2) != '00'){
            $('#sel_aa').attr('disabled',flag);
            $('#sel_aa2').attr('disabled',flag);
            $('#sel_aa3').attr('disabled',flag);
        }
        if ($("#catm").val().substr(4,2) != '00'){
            $('#sel_tt').attr('disabled',flag);
            $('#sel_tt2').attr('disabled',flag);
            $('#sel_tt3').attr('disabled',flag);
        }
        if ($("#catm").val().substr(6,2) != '00'){
            $('#sel_mm').attr('disabled',flag);
            $('#sel_mm2').attr('disabled',flag);
            $('#sel_mm3').attr('disabled',flag);
        }
    }
    
    function defaultCATM(){
        if ($("#catm").val().substr(2,2) != '00'){
            $("#sel_aa").val($("#catm").val().substr(0,4));
            $("#sel_aa2").val($("#catm").val().substr(0,4));
            $("#sel_aa3").val($("#catm").val().substr(0,4));
            $("#aa_desc").val('อำเภอ'+$("#sel_aa").find('option:selected').text());
            $("#aa_desc2").val('อำเภอ'+$("#sel_aa2").find('option:selected').text());
            $("#aa_desc3").val('อำเภอ'+$("#sel_aa3").find('option:selected').text());
            if (getListTT($("#catm").val().substr(0,4),'all') == true){
                if ($("#catm").val().substr(4,2) != '00'){
                    $("#sel_tt").val($("#catm").val().substr(0,6));
                    $("#sel_tt2").val($("#catm").val().substr(0,6));
                    $("#sel_tt3").val($("#catm").val().substr(0,6));
                    $("#tt_desc").val('ตำบล'+$("#sel_tt").find('option:selected').text());
                    $("#tt_desc2").val('ตำบล'+$("#sel_tt2").find('option:selected').text());
                    $("#tt_desc3").val('ตำบล'+$("#sel_tt3").find('option:selected').text());
                
                    if (getListMM($("#catm").val().substr(0,6),'all') == true){
                        if ($("#catm").val().substr(6,2) != '00'){
                            $("#sel_mm").val($("#catm").val());
                            $("#sel_mm2").val($("#catm").val());
                            $("#sel_mm3").val($("#catm").val());
                            $("#mm_desc").val('หมู่บ้าน'+$("#sel_mm").find('option:selected').text());
                            $("#mm_desc2").val('หมู่บ้าน'+$("#sel_mm2").find('option:selected').text());
                            $("#mm_desc3").val('หมู่บ้าน'+$("#sel_mm3").find('option:selected').text());
                        }
                    }else{
                        $("#btn_search").attr("disabled", true);
                    }
                }
            }else{
                $("#btn_search").attr("disabled", true);
            }
        }
    }
    
    $("#sel_aa , #sel_aa2, #sel_aa3").change(function(e) {
        var attr_id = $(this).attr('id');
        //alert($(this).find('option:selected').text());
        if (attr_id == 'sel_aa'){
            $("#sel_mm").html('<option value="">----- ทุกหมู่บ้าน ----</option>');
            $("#sel_tt").html('<option value="">----- ทุกตำบล ----</option>');
            $("#aa_desc").val('อำเภอ'+$(this).find('option:selected').text());
        }else if (attr_id == 'sel_aa2'){
            $("#sel_mm2").html('<option value="">----- ทุกหมู่บ้าน ----</option>');
            $("#sel_tt2").html('<option value="">----- ทุกตำบล ----</option>');
            $("#aa_desc2").val('อำเภอ'+$(this).find('option:selected').text());
        }else if (attr_id == 'sel_aa3'){
            $("#sel_mm3").html('<option value="">----- ทุกหมู่บ้าน ----</option>');
            $("#sel_tt3").html('<option value="">----- ทุกตำบล ----</option>');
            $("#aa_desc3").val('อำเภอ'+$(this).find('option:selected').text());
        }else{
            $("#sel_mm").html('<option value="">----- ทุกหมู่บ้าน ----</option>');
            $("#sel_tt").html('<option value="">----- ทุกตำบล ----</option>');
            $("#aa_desc").val('อำเภอ'+$(this).find('option:selected').text());
            $("#sel_mm2").html('<option value="">----- ทุกหมู่บ้าน ----</option>');
            $("#sel_tt2").html('<option value="">----- ทุกตำบล ----</option>');
            $("#aa_desc2").val('อำเภอ'+$(this).find('option:selected').text());
            $("#sel_mm3").html('<option value="">----- ทุกหมู่บ้าน ----</option>');
            $("#sel_tt3").html('<option value="">----- ทุกตำบล ----</option>');
            $("#aa_desc3").val('อำเภอ'+$(this).find('option:selected').text());
        }
        getListTT($(this).val(),attr_id);
     
    });
        
    $("#sel_tt , #sel_tt2, #sel_tt3").change(function(e) {
       // alert($(this).val());
        var attr_id = $(this).attr('id');
        //alert($(this).find('option:selected').text());
        if (attr_id == 'sel_tt'){
            $("#sel_mm").html('<option value="">----- ทุกหมู่บ้าน ----</option>');
            $("#tt_desc").val('ตำบล'+$(this).find('option:selected').text());
        }else if (attr_id == 'sel_tt2'){
            $("#sel_mm2").html('<option value="">----- ทุกหมู่บ้าน ----</option>');
            $("#tt_desc2").val('ตำบล'+$(this).find('option:selected').text());
        }else if (attr_id == 'sel_tt2'){
            $("#sel_mm3").html('<option value="">----- ทุกหมู่บ้าน ----</option>');
            $("#tt_desc3").val('ตำบล'+$(this).find('option:selected').text());
        }else{
            $("#sel_mm").html('<option value="">----- ทุกหมู่บ้าน ----</option>');
            $("#tt_desc").val('ตำบล'+$(this).find('option:selected').text());
            $("#sel_mm2").html('<option value="">----- ทุกหมู่บ้าน ----</option>');
            $("#tt_desc2").val('ตำบล'+$(this).find('option:selected').text());
            $("#sel_mm3").html('<option value="">----- ทุกหมู่บ้าน ----</option>');
            $("#tt_desc3").val('ตำบล'+$(this).find('option:selected').text());
        }
        
        getListMM($(this).val(),attr_id);
        
        //if ($(this).val() == ""){
        //}else{
            
        //}
    });
    
    $("#sel_mm, #sel_mm2, #sel_mm3").change(function(e) {
        var attr_id = $(this).attr('id');
        if (attr_id == 'sel_mm'){
            $("#mm_desc").val('หมู่บ้าน'+$(this).find('option:selected').text());
        }else if (attr_id == 'sel_mm2'){
            $("#mm_desc2").val('หมู่บ้าน'+$(this).find('option:selected').text());
        }else{
            $("#mm_desc3").val('หมู่บ้าน'+$(this).find('option:selected').text());
        }
    });
    
    $("#sel_htype").change(function(e) {
        //alert($(this).find('option:selected').text());
        $("#htype_desc").val($(this).find('option:selected').text());
    });
        
    function getListHType(){
        var ret = false;
        $.ajax({
            type: "POST",
            url:"getData.php",
            dataType: 'text',
            cache:false, // กำหนดให้ cache ที่โหลดมาหรือไม่
            async:false,
            contentType: "application/x-www-form-urlencoded;charset=UTF-8",
            data : {action: 'getListHType'} ,
            success:function(data){
                //alert(data);
                var items = [];
                var arr_data = data.split('|');
                var i,j;
                var num;
                if (arr_data[0] == 1){
                    items.push('<option value="">----- ประเภทบ้าน ----</option>');
                    num = arr_data[1];
                    j=2;
                    for (i=0;i<num;i++){
                        items.push('<option value="' + arr_data[j++] + '">');
                        items.push(arr_data[j++]);
                        items.push('</option>');
                    }
                    $("#sel_htype").html(items.join(''));
                    ret = true;
                }else if (arr_data[0] == 0){
                    alert('ไม่พบข้อมูลประเภทบ้าน');
                    ret = true;
                }else if (arr_data[0] == 9){
                    alert('เกิดความผิดพลาด : ' + arr_data[1]);
                }else{
                    alert(data);
                }
            }  
        });   
        return ret;
    }

    function getListAA(cc){
        var ret = false;
        $.ajax({
            type: "POST",
            url:"getData.php",
            dataType: 'text',
            cache:false, // กำหนดให้ cache ที่โหลดมาหรือไม่
            async:false,
            contentType: "application/x-www-form-urlencoded;charset=UTF-8",
            data : {action: 'getListAA', sel_cc : cc} ,
            success:function(data){
                //alert(data);
                var items = [];
                var arr_data = data.split('|');
                var i,j;
                var num;
                if (arr_data[0] == 1){
                    items.push('<option value="">----- ทุกอำเภอ ----</option>');
                    num = arr_data[1];
                    j=2;
               
                    for (i=0;i<num;i++){
                        items.push('<option value="' + arr_data[j++] + '">');
                        items.push(arr_data[j++]);
                        items.push('</option>');
                    }
                    $("#sel_aa").html(items.join(''));
                    $("#sel_aa2").html(items.join(''));
                    $("#sel_aa3").html(items.join(''));
                    ret = true;
                }else if (arr_data[0] == 0){
                    alert('ไม่พบข้อมูลอำเภอ');
                    ret = true;
                }else if (arr_data[0] == 9){
                    alert('เกิดความผิดพลาด : ' + arr_data[1]);
                }else{
                    alert(data);
                }
            }  
        });
        return ret;
    }

    function getListTT(aa, attr_id){
        var ret = false;
        $.ajax({
            type: "POST",
            url:"getData.php",
            dataType: 'text',
            cache:false, // กำหนดให้ cache ที่โหลดมาหรือไม่
            async:false,
            contentType: "application/x-www-form-urlencoded;charset=UTF-8",
            data : {action: 'getListTT',sel_aa : aa} ,
            success:function(data){
                //alert(data);
                var items = [];
                var arr_data = data.split('|');
                var i,j;
                var num;
                if (arr_data[0] == 1){
                    num = arr_data[1];
                    j=2;
                    items.push('<option value="">----- ทุกตำบล -----</option>');
                    for (i=0;i<num;i++){
                        items.push('<option value="' + arr_data[j++] + '">');
                        items.push(arr_data[j++]);
                        items.push('</option>');
                    }
                    if (attr_id == 'sel_aa'){
                        $("#sel_tt").html(items.join(''));
                    }else if (attr_id == 'sel_aa2'){
                        $("#sel_tt2").html(items.join(''));
                    }else if (attr_id == 'sel_aa3'){
                        $("#sel_tt3").html(items.join(''));
                    }else{
                        $("#sel_tt").html(items.join(''));
                        $("#sel_tt2").html(items.join(''));
                        $("#sel_tt3").html(items.join(''));
                    }
                    ret = true;
                }else if (arr_data[0] == 0){
                    //alert(attr_id);
                    if (attr_id == 'sel_aa'){
                        alert('ไม่พบข้อมูลตำบลของอำเภอ'+$("#sel_aa option:selected").text());
                    }else if (attr_id == 'sel_aa2'){
                        alert('ไม่พบข้อมูลตำบลของอำเภอ'+$("#sel_aa2 option:selected").text());
                    }else if (attr_id == 'sel_aa3'){
                        alert('ไม่พบข้อมูลตำบลของอำเภอ'+$("#sel_aa3 option:selected").text());
                    }else{
                        alert('ไม่พบข้อมูลตำบล');
                    }
                    ret = true;
                }else if (arr_data[0] == 9){
                    alert('เกิดความผิดพลาด : ' + arr_data[1]);
                    
                }else{
                    alert(data);
                }
            }  
        });
        return ret;
    }
    
    function getListMM(tt,attr_id){
        var ret = true;
        $.ajax({
            type: "POST",
            url:"getData.php",
            dataType: 'text',
            cache:false, // กำหนดให้ cache ที่โหลดมาหรือไม่
            async:false,
            contentType: "application/x-www-form-urlencoded;charset=UTF-8",
            data : {action : 'getListMM', sel_tt : tt} ,
            success:function(data){
                var items = [];
                var arr_data = data.split('|');
                var i,j;
                var num;
                if (arr_data[0] == 1){
                    num = arr_data[1];
                    j=2;
                    items.push('<option value="">----- ทุกหมู่บ้าน ----</option>');
                    for (i=0;i<num;i++){
                        items.push('<option value="' + arr_data[j++] + '">');
                        items.push(arr_data[j++]);
                        items.push('</option>');
                    }
                    //alert(items.join(''));
                    if (attr_id == 'sel_tt'){
                        $("#sel_mm").html(items.join(''));
                    }else if (attr_id == 'sel_tt2'){
                        $("#sel_mm2").html(items.join(''));
                    }else if (attr_id == 'sel_tt3'){
                        $("#sel_mm3").html(items.join(''));
                    }else{
                        $("#sel_mm").html(items.join(''));
                        $("#sel_mm2").html(items.join(''));
                        $("#sel_mm3").html(items.join(''));
                    }
                    ret = true;
                }else if (arr_data[0] == 0){
                    if (attr_id == 'sel_tt'){
                        alert('ไม่พบข้อมูลหมู่บ้านของตำบล'+$("#sel_tt option:selected").text());
                    }else if (attr_id == 'sel_tt2'){
                        alert('ไม่พบข้อมูลหมู่บ้านของตำบล'+$("#sel_tt2 option:selected").text());
                    }else if (attr_id == 'sel_tt3'){
                        alert('ไม่พบข้อมูลหมู่บ้านของตำบล'+$("#sel_tt3 option:selected").text());
                    }else{
                        alert('ไม่พบข้อมูลหมู่บ้าน');
                    }
                    ret = true;
                }else if (arr_data[0] == 9){
                    alert('เกิดความผิดพลาด : ' + arr_data[1]);
                    ret = false;
                }else{
                    alert(data);
                }
            }  
        });
        return ret;
    }
   
    function submitForm(){
        var tab_selected =  $( "#tabs" ).tabs('option', 'active');
        if (tab_selected == 0){
            $('#sel_aa').attr('disabled',false);
            $('#sel_tt').attr('disabled',false);
            $('#sel_mm').attr('disabled',false);
            $("#frm_search_pop").submit();
            //disableSelCATM(true);
        }else if (tab_selected == 1){
            $('#sel_aa2').attr('disabled',false);
            $('#sel_tt2').attr('disabled',false);
            $('#sel_mm2').attr('disabled',false);
            $("#frm_search_house").submit();
            //disableSelCATM(true);
        }else{
            $('#sel_aa3').attr('disabled',false);
            $('#sel_tt3').attr('disabled',false);
            $('#sel_mm3').attr('disabled',false);
            $("#frm_search_list").submit();
            //disableSelCATM(true);
        }
        disableSelCATM(true);
    }
    
    function getCCDesc(cc){
        var ret = false;
        $.ajax({
            type: "POST",
            url:"getData.php",
            dataType: 'text',
            cache:false, // กำหนดให้ cache ที่โหลดมาหรือไม่
            async:false,
            contentType: "application/x-www-form-urlencoded;charset=UTF-8",
            data : {action: 'getCCDesc', cc : cc} ,
            success:function(data){
                //alert(data);
                var items = [];
                var arr_data = data.split('|');
                var cc_desc='';
                var num;
                if (arr_data[0] == 1){
                    items.push('<option value="">----- ทุกอำเภอ ----</option>');
                    num = arr_data[1];
                    cc_desc = arr_data[2];
                    if (cc_desc != 'กรุงเทพมหานคร'){
                        cc_desc = 'จังหวัด'+cc_desc;
                    }
                    $("#cc_desc").val(cc_desc);
                    ret = true;
                }else if (arr_data[0] == 0){
                    alert('ไม่พบชื่อจังหวัด');
                    ret = true;
                }else if (arr_data[0] == 9){
                    alert('เกิดความผิดพลาด : ' + arr_data[1]);
                }else{
                    alert(data);
                }
            }  
        });
        return ret;
    }
    
    
    $("#btn_search").click(function(e){
        submitForm();
    });
    
    
    $.validator.addMethod("valid_date", function(value, element, params){
        var rec_val = value.replace(/\//g,"");
        rec_val = rec_val.replace(/_/g,"");
        
        if (rec_val.length < 8) return true;
        var date_val=value.split("/");
        return isDate(date_val[0],date_val[1],date_val[2]);
        //return this.optional(element) || (parseFloat(value) > 0);
    });
    
    $.validator.addMethod("valid_between", function(value, element, data){
        var start='';
        var end='';
       
        if (data[0] == '0'){
            start = $("#txt_age_start").val();
            end = $("#txt_age_end").val();
        }else if (data[0] == '1'){
            start = $("#txt_dob_start").val();
            end = $("#txt_dob_end").val();
        }else if (data[0] == '2'){
            start = $("#txt_datemi_start").val();
            end = $("#txt_datemi_end").val();
        }

        if (data[0] != '0'){
            var start_arr = start.split("/");
            var end_arr = end.split("/");
            start = start_arr[2]+start_arr[1]+start_arr[0];
            end = end_arr[2]+end_arr[1]+end_arr[0];
            start = start.replace(/_/g,"");
            end = end.replace(/_/g,"");
        }

        if (start == ''){
            if (end == ''){
                return true;
            }else if (parseInt(start,10) <= parseInt(end,10)){
                return true;
            }else{
                return false;
            }
        }else{
            if (end == ''){
                return true;
            }else{
                if (parseInt(start,10) > parseInt(end,10)){
                    return false;
                }else{
                    return true;
                }
            }
        }
    });
    
    $("#frm_search_pop").validate({
        rules: {    
            txt_fname: {
                minlength: 2
            },
            txt_lname: {
                minlength: 2
            },
            txt_age_start: {
                valid_between : '0'
            },
            txt_dob_start: {
                valid_date : true,
                valid_between : '1'
            },
            txt_dob_end: {
                valid_date : true
            },
            txt_datemi_start: {
                valid_date : true,
                valid_between : '2'
            },
            txt_datemi_end: {
                valid_date : true
            }
        },
        messages: {
            txt_fname: {
                minlength: "ระบุชื่อตัวอย่างน้อย 2 ตัวอักษร"
            },
            txt_lname: {
                minlength: "ระบุชื่อสกุลอย่างน้อย 2 ตัวอักษร"
            },
            txt_age_start: {
                valid_between : "ระบุอายุตั้งแต่ให้น้อยกว่าหรือเท่ากับอายุสิ้นสุด"
            },

            txt_dob_start: {
                valid_date : "ระบุวันเกิดให้ถูกต้อง",
                valid_between : "ระบุวันเกิดตั้งแต่ให้น้อยกว่าหรือเท่ากับวันเกิดสิ้นสุด"
            },
            txt_dob_end: {
                valid_date : "ระบุวันเกิดให้ถูกต้อง"
            },
            txt_datemi_start: {
                valid_date : "ระบุวันที่ย้ายเข้าให้ถูกต้อง",
                valid_between : "ระบุวันที่ย้ายเข้าตั้งแต่ให้น้อยกว่าหรือเท่ากับวันที่ย้ายเข้าสิ้นสุด"
            },
            txt_datemi_end: {
                valid_date : "ระบุวันที่ย้ายเข้าให้ถูกต้อง"
            }
        },
        success: function(label) {
			//label.html("&nbsp;").addClass("checked");
		},
		highlight: function(element, errorClass) {
			$(element).parent().next().find("." + errorClass).removeClass("checked");
		},
        onkeyup :false 
    });

});

