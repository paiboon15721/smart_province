$(document).ready(function() {
   // var $tabs = $('#tab').tabs();
   // var tab_selected = $tabs.tabs('option', 'active');
   
    
    $('#tabs').tabs();
    
    $("#btn_clear").click(function(e) {
        window.location.replace("search_pop.php");
    
    /*    $("#frm_search_pop")[0].reset();
        $("#frm_search_house")[0].reset();
        $("#frm_search_list")[0].reset();
        if ($("#catm").val().substr(6,2) == '00'){
            $("#sel_mm").html('<option value="">----- ทุกหมู่บ้าน ----</option>');
            $("#sel_mm2").html('<option value="">----- ทุกหมู่บ้าน ----</option>');
            $("#sel_mm3").html('<option value="">----- ทุกหมู่บ้าน ----</option>');
            $("#mm_desc").val('');
            $("#mm_desc2").val('');
            $("#mm_desc3").val('');
        }
        if ($("#catm").val().substr(4,2) == '00'){
            $("#sel_tt").html('<option value="">----- ทุกตำบล ----</option>');
            $("#sel_tt2").html('<option value="">----- ทุกตำบล ----</option>');
            $("#sel_tt3").html('<option value="">----- ทุกตำบล ----</option>');
            $("#tt_desc").val('');
            $("#tt_desc2").val('');
            $("#tt_desc3").val('');
        }
        if ($("#catm").val().substr(2,2) == '00'){
            $("#aa_desc").val('');
            $("#aa_desc2").val('');
            $("#aa_desc3").val('');
        }
        */
    });

    getListHType();
    getListAA($("#catm").val().substr(0,2));
    defaultCATM();
    disableSelCATM(true);
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
        
            getListTT($("#catm").val().substr(0,4),'all');
        }
        if ($("#catm").val().substr(4,2) != '00'){
            
            $("#sel_tt").val($("#catm").val().substr(0,6));
            $("#sel_tt2").val($("#catm").val().substr(0,6));
            $("#sel_tt3").val($("#catm").val().substr(0,6));
            $("#tt_desc").val('ตำบล'+$("#sel_tt").find('option:selected').text());
            $("#tt_desc2").val('ตำบล'+$("#sel_tt2").find('option:selected').text());
            $("#tt_desc3").val('ตำบล'+$("#sel_tt3").find('option:selected').text());
        
            getListMM($("#catm").val().substr(0,6),'all');
        }

        if ($("#catm").val().substr(6,2) != '00'){
            $("#sel_mm").val($("#catm").val());
            $("#sel_mm2").val($("#catm").val());
            $("#sel_mm3").val($("#catm").val());
            $("#mm_desc").val('หมู่บ้าน'+$("#sel_mm").find('option:selected').text());
            $("#mm_desc2").val('หมู่บ้าน'+$("#sel_mm2").find('option:selected').text());
            $("#mm_desc3").val('หมู่บ้าน'+$("#sel_mm3").find('option:selected').text());
       
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
               
                }else if (arr_data[0] == 0){
                    alert('ไม่พบข้อมูลประเภทบ้าน');
                }else if (arr_data[0] == 9){
                    alert('เกิดความผิดพลาด : ' + arr_data[1]);
                }
            }  
        });   
    }

    function getListAA(cc){
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
               
                }else if (arr_data[0] == 0){
                    alert('ไม่พบข้อมูลอำเภอ');
                }else if (arr_data[0] == 9){
                    alert('เกิดความผิดพลาด : ' + arr_data[1]);
                }
            }  
        });   
    }

    function getListTT(aa, attr_id){
       
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
                }
            }  
        });   
  
    }
    
    function getListMM(tt,attr_id){
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
                }
            }  
        });
    
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
    
    $("#btn_search").click(function(e){
        //e.preventDefault();
        //alert('aa');
        submitForm();
    });
    
   /* 
    $("#btn_search").click(function(e) {
        $.ajax({  
            url:"getData.php",
            dataType: 'text',
            cache:false, // กำหนดให้ cache ที่โหลดมาหรือไม่
            async:false,
            contentType: "application/x-www-form-urlencoded;charset=UTF-8",
            data : {action : 'getPopByCond', txt_pid:$("#txt_pid").val(), txt_fname:$("#txt_fname").val(), txt_lname:$("#txt_lname").val(), txt_age_start:$("#txt_age_start").val(), txt_age_end:$("#txt_age_end").val(), txt_datemi:$("#txt_datemi").val() } ,
            success:function(data){
                var items = new Array();
                var aDataSet = new Array();
                var arr_data = data.split('|');
                var i,j;
                var num;
                var mm;
                alert(data);
                if (arr_data[0] == 1){
                  //  $('#content').load('list_pop.html');
                    num = arr_data[1];
                    j=2;

                    for (i=1;i<=num;i++){
                        items = [];
                        items.push(i);
                       // items.push('<a href="pop_detail.html" class="fancy">'+arr_data[j++]+'</a>');
                        items.push(arr_data[j++]);
                        items.push(arr_data[j++]);
                        items.push(arr_data[j++]);
                        items.push(arr_data[j++]);
                        //alert(items.join(''));
                        aDataSet.push(items);
                    }
                    //alert(aDataSet[0][0]);
                    
                   // $("#content").load("list_pop.html", {data: aDataSet}, function(){
                        //$('#cond_desc').html('test');
                        oTable = $('#tab_pop').dataTable( {
                            "sPaginationType" : "full_numbers",
                            "bFilter": true,
                            "bLengthChange": true,
                            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "ทั้งหมด"]],
                            "iDisplayLength": 25,    
                            "bAutoWidth": false,
                            "sScrollY": "400px",
                            "bRetrieve":true,
                            "bStateSave": true,
                            "oTableTools": {
                                "sRowSelect": "single" // คลิกที่ record มีแถบสีขึ้น
                            },
                            "oLanguage": {
                                "sLengthMenu": "แสดง _MENU_ รายการ/หน้า",
                                "sEmptyTable": "No data available in table",
                                "sInfo": "แสดง _START_ - _END_ ทั้งหมด _TOTAL_ ",
                                "sInfoEmpty": "ไม่พบข้อมูล",
                                "oPaginate": {
                                    "sFirst": "หน้าแรก",
                                    "sLast": "หน้าสุดท้าย",
                                    "sNext": "ถัดไป",
                                    "sPrevious": "ก่อนหน้า"
                               }
                            },
                            "aaData": aDataSet,
                            "aoColumns": [
                                { "sTitle": "ลำดับที่" },
                                { "sTitle": "เลขประจำตัวประชาชน" },
                                { "sTitle": "วันเกิด" },
                                { "sTitle": "ชื่อตัว" },
                                { "sTitle": "ชื่อสกุล", "sClass": "center" }
                            ]
                        } );

                //    });                   
                   
                }else if (arr_data[0] == 0){
                    alert('ไม่พบข้อมูล');
                    //$("#msg").html('ไม่พบข้อมูล');
                }
                
            }  
        });
    });
    */

});

