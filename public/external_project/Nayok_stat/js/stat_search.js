$(document).ready(function() {
   // var $tabs = $('#tab').tabs();
   // var tab_selected = $tabs.tabs('option', 'active');
   
    

    
    $('#tabs').tabs();
	$('#tabs2').tabs();
	$('#tabs3').tabs();
	$('#tabs4').tabs();
	
    $("#txt_dob_start, #txt_dob_end, #txt_movein_start, #txt_movein_end" ).datepicker();
    getListHType();




//$('input:radio[name=rdo_sex]:checked').val();
    
    $("#sel_aa , #sel_aa2").change(function(e) {
       // alert($(this).val());
        //alert($(this).attr('id'));
        var attr_id = $(this).attr('id');
        if (attr_id == 'sel_aa'){
            $("#sel_mm").html('<option value="">----- �����ҹ ----</option>');
            $("#sel_tt").html('<option value="">----- �Ӻ� ----</option>');
        }else{
            $("#sel_mm2").html('<option value="">----- �����ҹ ----</option>');
            $("#sel_tt2").html('<option value="">----- �Ӻ� ----</option>');
        
        }

        $.ajax({  
            url:"test.php",
            dataType: 'text',
            cache:false, // ��˹���� cache �����Ŵ���������
            async:false,
            contentType: "application/x-www-form-urlencoded;charset=UTF-8",
            data : {action: 'getListTT',sel_aa : $(this).val()} ,
            success:function(data){
                //alert(data);
                var items = [];
                var arr_data = data.split('|');
                var i,j;
                var num;
                if (arr_data[0] == 1){
                    num = arr_data[1];
                    j=2;
                    items.push('<option value="">----- �Ӻ� -----</option>');
                    for (i=0;i<num;i++){
                        items.push('<option value="' + arr_data[j++] + '">');
                        items.push(arr_data[j++]);
                        items.push('</option>');
                    }
                    if (attr_id == 'sel_aa'){
                        $("#sel_tt").html(items.join(''));
                    }else{
                        $("#sel_tt2").html(items.join(''));
                    }
                }else if (arr_data[0] == 0){
                    //alert(attr_id);
                    if (attr_id == 'sel_aa'){
                        alert('��辺�����ŵӺŢͧ�����'+$("#sel_aa option:selected").text());
                    }else{
                        alert('��辺�����ŵӺŢͧ�����'+$("#sel_aa2 option:selected").text());
                    }
                }
            }  
        });   
    });
        
    $("#sel_tt , #sel_tt2").change(function(e) {
       // alert($(this).val());
        var attr_id = $(this).attr('id');
        if (attr_id == 'sel_tt'){
            $("#sel_mm").html('<option value="">----- �����ҹ ----</option>');
        }else{
            $("#sel_mm2").html('<option value="">----- �����ҹ ----</option>');
        }
        //if ($(this).val() == ""){
        //}else{
            $.ajax({  
                url:"test.php",
                dataType: 'text',
                cache:false, // ��˹���� cache �����Ŵ���������
                async:false,
                contentType: "application/x-www-form-urlencoded;charset=UTF-8",
                data : {action : 'getListMM', sel_tt : $(this).val()} ,
                success:function(data){
                    var items = [];
                    var arr_data = data.split('|');
                    var i,j;
                    var num;
                    if (arr_data[0] == 1){
                        num = arr_data[1];
                        j=2;
                        items.push('<option value="">----- �����ҹ ----</option>');
                        for (i=0;i<num;i++){
                            items.push('<option value="' + arr_data[j++] + '">');
                            items.push(arr_data[j++]);
                            items.push('</option>');
                        }
                        //alert(items.join(''));
                        if (attr_id == 'sel_tt'){
                            $("#sel_mm").html(items.join(''));
                        }else{
                            $("#sel_mm2").html(items.join(''));
                        }
                    }else if (arr_data[0] == 0){
                        if (attr_id == 'sel_tt'){
                            alert('��辺�����������ҹ�ͧ�Ӻ�'+$("#sel_tt option:selected").text());
                        }else{
                            alert('��辺�����������ҹ�ͧ�Ӻ�'+$("#sel_tt2 option:selected").text());
                        }
                    }
                }  
            });
        //}
    });
        
/*    function getListHType(){
        $.ajax({  
            url:"test.php",
            dataType: 'text',
            cache:false, // ��˹���� cache �����Ŵ���������
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
                    num = arr_data[1];
                    j=2;
               
                    for (i=0;i<num;i++){
                        items.push('<option value="' + arr_data[j++] + '">');
                        items.push(arr_data[j++]);
                        items.push('</option>');
                    }
                    $("#sel_htype").html(items.join(''));
               
                }else if (arr_data[0] == 0){
                    alert('��辺�����ŵӺŢͧ�����'+$("#sel_aa option:selected").text());
                }
            }  
        });   
    }
*/    
    function submitForm(){
        var tab_selected =  $( "#tabs" ).tabs('option', 'active');
       // alert('tab_selected = '+tab_selected);
        if (tab_selected == 0){
            $("#frm_search_pop").submit();
        }else if (tab_selected == 1){
            $("#frm_search_house").submit();
        }else{
            $("#frm_search_list").submit();
        }
    }
    
    $("#btn_search").click(function(e){
        //e.preventDefault();
        alert('aa');
        submitForm();
    });
    
   /* 
    $("#btn_search").click(function(e) {
        $.ajax({  
            url:"test.php",
            dataType: 'text',
            cache:false, // ��˹���� cache �����Ŵ���������
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
                            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "������"]],
                            "iDisplayLength": 25,    
                            "bAutoWidth": false,
                            "sScrollY": "400px",
                            "bRetrieve":true,
                            "bStateSave": true,
                            "oTableTools": {
                                "sRowSelect": "single" // ��ԡ��� record ��ᶺ�բ��
                            },
                            "oLanguage": {
                                "sLengthMenu": "�ʴ� _MENU_ ��¡��/˹��",
                                "sEmptyTable": "No data available in table",
                                "sInfo": "�ʴ� _START_ - _END_ ������ _TOTAL_ ",
                                "sInfoEmpty": "��辺������",
                                "oPaginate": {
                                    "sFirst": "˹���á",
                                    "sLast": "˹���ش����",
                                    "sNext": "�Ѵ�",
                                    "sPrevious": "��͹˹��"
                               }
                            },
                            "aaData": aDataSet,
                            "aoColumns": [
                                { "sTitle": "�ӴѺ���" },
                                { "sTitle": "�Ţ��Шӵ�ǻ�ЪҪ�" },
                                { "sTitle": "�ѹ�Դ" },
                                { "sTitle": "���͵��" },
                                { "sTitle": "����ʡ��", "sClass": "center" }
                            ]
                        } );

                //    });                   
                   
                }else if (arr_data[0] == 0){
                    alert('��辺������');
                    //$("#msg").html('��辺������');
                }
                
            }  
        });
    });
    */

});

