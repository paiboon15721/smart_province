$(document).ready(function(){
    $("#btn_new").click(function(){
        // similar behavior as an HTTP redirect
        window.location.replace("search_pop.php");

        // similar behavior as clicking on a link
        //window.location.href = "http://stackoverflow.com";
    });
    
    $("#btn_print").click(function(){
        window.print();
    });
    $("#btn_close").click(function(){
        parent.$.fancybox.close();
    });
    $("#btn_load").click(function(){
        //alert('aaa');
        /* var csv = $('#tab_pop').table2CSV({ delivery: 'value' }); 
        window.location.href = 'data:text/csv;charset=UTF-8,' + encodeURIComponent(csv); */
        var csv = jQuery('#tab_pop').TableCSVExport({
           header:['ลำดับที่','เลขประจำตัวประชาชน','ชื่อ-สกุล','วันเกิด','อายุ (ปี)','เพศ','detail'],
           columns:['ลำดับที่','เลขประจำตัวประชาชน','ชื่อ-สกุล','วันเกิด','อายุ (ปี)','เพศ'],
           extraHeader: 'Id',
           showHiddenRows: true,
           separator : '|',
          /* extraData:['zwick','markatto','bcsquire','ksingri'],*/
         /*  insertBefore: "Name",*/
           delivery: 'popup'
        });
        //window.location.href = 'data:text/csv;charset=UTF-8,' + encodeURIComponent(csv);
    });

    $("#details").hide();
    $("#loading").show();

   // alert($('#txt_fname').val());
    if ($('#action').val() == "pop"){
        var data_send = {'action': 'getPopByCond','txt_pid' : $('#txt_pid').val(), 'txt_fname' : $('#txt_fname').val(), 'txt_lname' : $('#txt_lname').val(), 'rdo_sex' : $('#rdo_sex').val(), 'txt_dob_start' : $('#txt_dob_start').val(), 'txt_dob_end' : $('#txt_dob_end').val(), 'txt_age_start' : $('#txt_age_start').val(), 'txt_age_end' : $('#txt_age_end').val(), 'sel_aa' : $('#sel_aa').val(), 'sel_tt' : $('#sel_tt').val(), 'sel_mm' : $('#sel_mm').val(), 'txt_datemi_start' : $('#txt_datemi_start').val(),'txt_datemi_end' : $('#txt_datemi_end').val(),'rdo_sort' : $('#rdo_sort').val(), 'rdo_sort_direct' : $('#rdo_sort_direct').val()};
    }else if ($('#action').val() == "list"){
    //    alert('rdo_list = '+$('#rdo_list').val());
        if ($('#rdo_list').val() == "1"){
            var data_send = {'action': 'getListArmy', 'sel_aa' : $('#sel_aa3').val(), 'sel_tt' : $('#sel_tt3').val(), 'sel_mm' : $('#sel_mm3').val(),'rdo_sort' : $('#rdo_sort').val(), 'rdo_sort_direct' : $('#rdo_sort_direct').val()};
        }else{
            var data_send = {'action': 'getListElder', 'sel_aa' : $('#sel_aa3').val(), 'sel_tt' : $('#sel_tt3').val(), 'sel_mm' : $('#sel_mm3').val(),'rdo_sort' : $('#rdo_sort').val(), 'rdo_sort_direct' : $('#rdo_sort_direct').val()};
        }
    }else{
        var data_send = {'action': 'getPopByHid', 'hid' : $('#hid').val()};
    }
    
    $.ajax( {
        dataType: 'text',
        type: "POST",
        url: "getJSON.php",
        cache:false, // กำหนดให้ cache ที่โหลดมาหรือไม่
        async:false,
        contentType: "application/x-www-form-urlencoded;charset=UTF-8",
        data : data_send,
        //data : {action: 'getPopByCond',txt_pid : $('#txt_pid').val(), txt_fname : $('#txt_fname').val(), txt_lname : $('#txt_lname').val(), rdo_sex : $('#rdo_sex').val(), txt_dob_start : $('#txt_dob_start').val(),txt_dob_end : $('#txt_dob_end').val(), txt_age_start : $('#txt_age_start').val(),txt_age_end : $('#txt_age_end').val(), sel_aa : $('#sel_aa').val(), sel_tt : $('#sel_tt').val(), sel_mm : $('#sel_mm').val(), txt_datemi_start : $('#txt_datemi_start').val(),txt_datemi_end : $('#txt_datemi_end').val(),rdo_sort : $('#rdo_sort').val(),rdo_sort_direct : $('#rdo_sort_direct').val()},
        //data : {action: 'getPopByCond'},
        success: function (dataStr) {
            var data = eval( '('+dataStr+')' );
            //alert(data.message);
            if (data.code == '9') alert (data.message);
            var filename_export = "pop_house_report";
            oTable = $('#tab_pop').dataTable( {
                "sPaginationType" : "full_numbers",
                "bFilter": false,
                "bLengthChange": true,
                //"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "ทั้งหมด"]],
                "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "ทั้งหมด"]],
                "iDisplayLength": 25,
                "bAutoWidth": false,
                //"bRetrieve": true,
                "bStateSave": false,
                "bDeferRender": true,
                "bProcessing": true,
                "bSort": false,
                "bSortClasses": false,
                "bJQueryUI": true,
                
                //"sAjaxSource": 'getData.php?action="getPopByCond"&txt_pid='+$('#txt_pid').val()+'&txt_fname='+$('#txt_fname').val()+'&txt_lname='+$('#txt_lname').val()+'&txt_age_start='+$('#txt_age_start').val()+'&txt_age_end='+$('#txt_age_end').val()+'&sel_aa='+$('#sel_aa').val()+'&sel_tt='+$('#sel_tt').val()+'&sel_mm='+$('#sel_mm').val()+'&txt_datemi_start='+$('#txt_datemi_start').val()+'&txt_datemi_end='+$('#txt_datemi_end').val(),
                //"sAjaxSource": "getJSON.php",
                //"sDom": 'T<"clear"><"H"lfr>t<"F"ip>',
                "sDom": '<"clear">T<"H"lfr>t<"F"ip>',
                "oTableTools": {
                        "aButtons": [
                            {
                                "sExtends": "copy",
                                "sButtonText": "คัดลอก",
                                "bSelectedOnly": true,
                                "sCharSet": "utf8",
                                "mColumns": [0, 1, 2, 3, 4, 5]
                            },
                            {
                                "sExtends": "csv",
                                "sButtonText": "บันทึกลงไฟล์",
                                "bSelectedOnly": true,
                                "sCharSet": "utf8",
                                "sFieldSeperator": "|",
                                "sFileName": filename_export + ".txt",
                                "mColumns": [0, 1, 2, 3, 4, 5]
                            }
                        ],
                        "sSwfPath": "plugin/swf/copy_csv_xls.swf"
                },
                "oLanguage": {
                    "sProcessing": "กำลังดำเนินการ...",
                    "sLengthMenu": "แสดง _MENU_ รายการ/หน้า",
                    "sEmptyTable": "ไม่พบข้อมูลตามเงื่อนไขที่ระบุ",
                    "sInfo": "แสดง _START_ - _END_ ทั้งหมด _TOTAL_ ",
                    "sInfoEmpty" : "ไม่พบข้อมูล",
                    "sZeroRecords": "ไม่พบข้อมูล",
                    "oPaginate": {
                        "sFirst": "หน้าแรก",
                        "sLast": "หน้าสุดท้าย",
                        "sNext": "ถัดไป",
                        "sPrevious": "ก่อนหน้า"
                    },
                    "sSearch": "ค้นหา"
                },
                /*"aaData": aDataSet,*/
                "aaData": data.aaData,
                "aoColumns": [
                    { "mDataProp": "order", "sTitle": "ลำดับที่", "sClass": "center", "sType": 'numeric'  },
                    { "mDataProp": "pid", "sTitle": "เลขประจำตัวประชาชน", "sClass": "center" },
                    { "mDataProp": "name", "sTitle": "ชื่อ-สกุล" },
                    { "mDataProp": "dob", "sTitle": "วันเกิด", "sClass": "center" },
                    { "mDataProp": "age", "sTitle": "อายุ (ปี)", "sClass": "center" },
                    { "mDataProp": "sex", "sTitle": "เพศ", "sClass": "center" },
                    { "mDataProp": "detail" ,"sTitle": "ดูรายละเอียด", "sClass": "center hover no_print"}
                ],
                /*"aoColumns": [
                        { "sTitle": "ลำดับที่", "sClass": "center" },
                        { "sTitle": "เลขประจำตัวประชาชน", "sClass": "center" },
                        { "sTitle": "ชื่อ-สกุล" },
                        { "sTitle": "วันเกิด", "sClass": "center" },
                        { "sTitle": "อายุ (ปี)", "sClass": "center" },
                        { "sTitle": "เพศ", "sClass": "center" },
                        { "sTitle": "ดูรายละเอียด", "sClass": "center" }
                    ],
                */
                "aoColumnDefs": [
                    { "bSortable": false, "aTargets": [ 0,5 ] }
                ]
                ,
                "fnDrawCallback": function ( oSettings, json ) {
                    /*if ( oSettings.bSorted || oSettings.bFiltered ) {
                        for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ ) {
                            this.fnUpdate( i+1, oSettings.aiDisplay[i], 0, false, false );
                        }
                    }*/
                    getPopDetail(); // ห้ามลบนะจ๊ะ
                },
                "fnPreDrawCallback":function(){
                   
                    //alert("Pre Draw");
                },
                "fnInitComplete":function(oSettings){
                    $("#details").show();
                    $("#loading").hide();
                    $("#total").text("ข้อมูลทั้งหมด "+addCommas(data.iTotalRecords)+" รายการ");
                   // var iCurrentPage = Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength);
                   
                    /*var csvButton = $(".DTTT_button_csv").detach();
                    var copyButton = $(".DTTT_button_copy").detach();
                    $("#button_box").append( copyButton );
                    $("#button_box").append( csvButton );*/
                }
              /* , "fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
                    oSettings.jqXHR = $.ajax( {
                        "dataType": 'json',
                        "type": "POST",
                        "url": sSource,
                        "data": aoData,
                        "success": fnCallback 
                       
                    } );
                }
                */    
            } );
        }
    } ); //ajax   


    //    }
    //oTable = $('#tab_pop').dataTable();
    //oTable.$('td').click( function (e) {
    function getPopDetail(){
        $('#tab_pop tbody td').on("click", function (e) {
            // Get the position of the current data from the node
            var row_pos = oTable.fnGetPosition( this );

            var col_data = oTable.fnGetData( this )
            // Get the data array for this row
            var row_data = oTable.fnGetData(row_pos[0]);
            var pid_data = row_data['pid'];
           // alert('p_data =' + pid_data);
        
            e.preventDefault();
           /*get column name 
            var ColIndex = $(this).parent().children().index($(this));
            var ColName = $("th").children(':eq(' + ColIndex + ')').text();
            */
            
            //alert('colData = '+col_data);
            //alert('pid_data = '+pid_data);
            //alert('ColName = '+ColName);
            //if (col_data != '<a href="">ดูรายละเอียด</a>') return;
            if (col_data == 'ดูรายละเอียด'){ 
            
                pid_data = pid_data.replace(/-/gi, "");
            //alert('data =' + pid_data);
               
                $.ajax({  
                    url:"getData.php",
                    dataType: 'text',
                    cache:false,
                    async:false,
                    contentType: "application/x-www-form-urlencoded;charset=UTF-8",
                    data : {action : 'getDataByPid', pid:pid_data } ,
                    success:function(data){
                        var items = new Array();
                        var aDataSet = new Array();
                        var arr_data = data.split('|');
                        var i,j;
                        var num;
                        var mm;
                        //alert(data);
                        if (arr_data[0] == 1){
                      //  $('#content').load('list_pop.html');
                            $.fancybox({
                                autoScale   : false,
                                fitToView   : true,
                                autoSize    : false,
                                modal       : true,
                                type        : 'iframe',
                                href        : 'pop_detail.php?data='+data,
                                data        : data
                           
                            });
                        }else if (arr_data[0] == 0){
                            alert('ไม่พบข้อมูล');
                        }
                    }  
                });
            }
        });
    }
     
        /*oTable.$('td').click( function () {
            var sData = oTable.fnGetData( this );
            alert( 'The cell clicked on had the value of '+sData );
        } );
        */
        
    //oTable2 = $('#tab_pop').dataTable();
    //oTable2.$('tr').click(function(){
      //  var data = oTable.fnGetData( this );
    // ... do something with the array / object of data for the row
    //});

    //oTable.$('td').click( function () {
        // Individual cell data
      //  var sData = oTable.fnGetData( this );
      //  alert('The cell clicked on had the value of '+sData );
   // });
    /*$.ajax({  
            url:"getData.php",
            dataType: 'text',
            cache:false, 
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
                                "sRowSelect": "single" 
                            },
                            "sProcessing": "กำลังดำเนินการ...",
                        "sLengthMenu": "แสดง _MENU_ รายการ/หน้า",
                        "sEmptyTable": "ไม่พบข้อมูลในตาราง",
                        "sInfo": "แสดง _START_ - _END_ ทั้งหมด _TOTAL_ ",
                        "sInfoEmpty" : "ไม่พบข้อมูล",
                        "sZeroRecords":  "ไม่พบข้อมูล",
                        "oPaginate": {
                            "sFirst": "หน้าแรก",
                            "sLast": "หน้าสุดท้าย",
                            "sNext": "ถัดไป",
                            "sPrevious": "ก่อนหน้า"
                        },
                        "sSearch": "ค้นหา"
                            },
                            "aaData": aDataSet,
                                                "aoColumns": [
                        { "sTitle": "ลำดับที่", "sClass": "center" },
                        { "sTitle": "เลขประจำตัวประชาชน", "sClass": "center" },
                        { "sTitle": "ชื่อ-สกุล" },
                        { "sTitle": "วันเกิด", "sClass": "center" },
                        { "sTitle": "อายุ (ปี)", "sClass": "center" },
                        { "sTitle": "ดูรายละเอียด", "sClass": "center" }
                    ]
                        } );

                //    });                   
                   
                }else if (arr_data[0] == 0){
                    alert('ไม่พบข้อมูล');
                    
                }
                
            }  
        });
   
   */
    /*$(".fancy").fancybox({
        maxWidth    : 800,
        maxHeight   : 600,
        fitToView   : false,
        width       : '70%',
        height      : '70%',
        autoSize    : false,
        closeClick  : false,
        openEffect  : 'none',
        closeEffect : 'none',
        ajax : {
            type    : "POST",
            data    : 'mydata=test'
        }
    });*/

});