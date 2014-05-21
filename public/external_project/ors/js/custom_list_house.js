$(document).ready(function(){
    $("#btn_new").click(function(){
        // similar behavior as an HTTP redirect
        window.location.replace("search_pop.php#tabs-2");
 
        // similar behavior as clicking on a link
        //window.location.href = "http://stackoverflow.com";
    });
    $("#btn_print").click(function(){
        //window.print();
        var mybrowser=navigator.userAgent;  
        if(mybrowser.indexOf('MSIE')>0){  
            document.execCommand('print', false, null);
        }else{  
            window.print();
        }
    });
    
     $('#btn_close').click(function(){
        //window.close();
        parent.$.fancybox.close();
    });

    if ($('#emp_pid').val() != ""){
        $("#details").hide();
        $("#loading").show();
        getHouseData();
    }else{
        $("#loading").hide();
        alert('คุณไม่มีสิทธิเข้าใช้งานระบบ');
        $('#content').find('input, textarea, button, select').attr('disabled','disabled');
    }
    
    //getHouseData();
    function getHouseData(){
        //alert($('#hid_result').val());
        $("#details").hide();
        $("#loading").show();
       // if ($('#hid_result').val() != ""){
           /* var data = $('#hid_result').val();
            var items = new Array();
            var aDataSet = new Array();
            var arr_data = data.split('|');
            var i,j;
            var num;
            var mm;
            //alert(data);
            if (arr_data[0] == 1){
          //  $('#content').load('list_pop.html');
                num = arr_data[1];
                j=2;
alert(data);
                for (i=1;i<=num;i++){
                    var hid = arr_data[j++];    
                    var htype = arr_data[j++];  
                    var hno = arr_data[j++];
                    var ccaattmm = arr_data[j++];
                    var thanon = arr_data[j++];
                    var trok = arr_data[j++];
                    var soi1 = arr_data[j++];
                    var soi2 = arr_data[j++];
                    var cc = arr_data[j++];
                    var aa = arr_data[j++];
                    var tt = arr_data[j++];
                    var mm = arr_data[j++];
                    var address;
                    
                    address = strAddr(hno,ccaattmm,thanon,trok,soi1,soi2,cc,aa,tt,mm);
                 //   alert('addr = '+alert(address));
                    items = [];

                    items.push(i);
                    items.push(formatHid(hid));
                    items.push(htype);
                    items.push(address);
                    items.push('<a href="">แผนที่</a>');
                    items.push('<a href="">รายการคนในบ้าน</a>');
                    //alert(items.join(''));
                    aDataSet.push(items);
                }
                
                */
                //alert(aDataSet[0][0]);
    
        $.ajax( {
            dataType: 'text',
            type: "POST",
            url: "getJSON.php",
            cache:false, // กำหนดให้ cache ที่โหลดมาหรือไม่
            async:false,
            contentType: "application/x-www-form-urlencoded;charset=UTF-8",
            data : {action: 'getHouseByCond',txt_hid : $('#txt_hid').val(),  sel_aa : $('#sel_aa').val(), sel_tt : $('#sel_tt').val(), sel_mm : $('#sel_mm').val(), sel_htype : $('#sel_htype').val()},
            success: function (dataStr) {
                try {
                    var data = eval( '('+dataStr+')' );
                    if (data.code == '9'){
                        $("#loading").hide();
                        alert(data.message);
                    }else{
                        //alert('in else');
                        var filename_export = "pop_house_report";
                        oTable = $('#tab_pop').dataTable( {
                            "sPaginationType" : "full_numbers",
                            "bFilter": false,
                            "bLengthChange": true,
                            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "ทั้งหมด"]],
                            "iDisplayLength": 25,    
                            "bAutoWidth": false,
                            "bRetrieve": true,
                            "bStateSave": false,
                            "bDeferRender": true,
                            "bSort": false,
                            "bJQueryUI": true,
                            //"sDom": 'T<"clear"><"H"lfr>t<"F"ip>',
                            "sDom": '<"clear">T<"H"lfr>t<"F"ip>',
                            "oTableTools": {
                                "aButtons": [
                                    {
                                        "sExtends": "copy",
                                        "sButtonText": "คัดลอก",
                                        "bSelectedOnly": true,
                                        "sCharSet": "utf8",
                                        "mColumns": [0, 1, 2, 3]
                                    },
                                    {
                                        "sExtends": "csv",
                                        "sButtonText": "บันทึกลงไฟล์",
                                        "bSelectedOnly": true,
                                        "sCharSet": "utf8",
                                        "sFieldSeperator": "|",
                                        "sFileName": filename_export + ".txt",
                                        "mColumns": [0, 1, 2, 3]
                                    }
                                ],
                                "sSwfPath": "plugin/swf/copy_csv_xls.swf"
                                //"sSwfPath": "http://datatables.net/release-datatables/extras/TableTools/media/swf/copy_cvs_xls_pdf.swf"
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
                            "aaData": data.aaData,
                            "aoColumns": [
                                { "mDataProp": "order","sTitle": "ลำดับที่", "sClass": "center" },
                                { "mDataProp": "hid","sTitle": "เลขรหัสประจำบ้าน", "sClass": "center" },
                                { "mDataProp": "htype","sTitle": "ประเภทบ้าน", "sClass": "center" },
                                { "mDataProp": "address","sTitle": "ที่อยู่" },
                                { "mDataProp": "map","sTitle": "แผนที่", "sClass": "center hover no_print" },
                                { "mDataProp": "list_pop","sTitle": "คนในบ้าน", "sClass": "center hover no_print" },
                                { "mDataProp": "ccaattmm","sTitle": "ccaattmm", "sClass": "center hover no_print" , "bVisible":false}
                            ],
                            "aoColumnDefs": [
                                { "bSortable": false, "aTargets": [0,4,5] }
                            ]
                            ,
                            "fnDrawCallback": function ( oSettings, json ) {
                               /* if ( oSettings.bSorted || oSettings.bFiltered ) {
                                    for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ ) {
                                        this.fnUpdate( i+1, oSettings.aiDisplay[i], 0, false, false );
                                    }
                                }*/
                                getDetail(); // ห้ามลบนะจ๊ะ
                            },
                            "fnPreDrawCallback":function(){
                               
                                //alert("Pre Draw");
                            },
                            "fnInitComplete":function(oSettings){
                                $("#details").show();
                                $("#loading").hide();
                                $("#total").text("ข้อมูลทั้งหมด "+addCommas(data.iTotalRecords)+" รายการ");
                                var iCurrentPage = Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength);
                            }
                        } ); // datatables
                    }
                }catch(err){
                    var txt;
                    txt+="Error description: " + err.message + "\n\n";
                    txt+=dataStr;
                    alert(txt);
                    $("#loading").hide();
                }
            }
        });// ajax
    }
    
    function getDetail(){
        /*oTable.$('tr').click( function () {
            var row_data = oTable.fnGetData( this );
            var hid_data = row_data['hid'];
            var htype_data = row_data[2];
            var addr_data = row_data[3];*/
            //pid_data = pid_data.replace(/-/gi, "");
            //alert('data =' + hid_data);
        $('#tab_pop tbody td').on("click", function (e) {
            var row_pos = oTable.fnGetPosition( this );

            var col_data = oTable.fnGetData( this )
            // Get the data array for this row
            var row_data = oTable.fnGetData(row_pos[0]);
            var hid_data = row_data['hid'];
            var htype = row_data['htype'];
            var address = row_data['address'];
            var ccaattmm = row_data['ccaattmm'];
            var data = '';
            //hid_data = hid_data.replace(/-/gi, "");
            
            $("#house_data").val("");
            if (col_data == 'แผนที่'){ 
                //alert ('col_data = '+col_data);
            
               /* $.ajax({  
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
                        alert(data);
                        if (arr_data[0] == 1){
                      //  $('#content').load('list_pop.html');
                            $.fancybox({
                                autoScale   : true,
                                fitToView   : true,
                                autoSize    : false,
                                type        : 'iframe',
                                href        : 'house_detail.php?data='+data,
                                data        : data
                            });
                        }else if (arr_data[0] == 0){
                            alert('ไม่พบข้อมูล');
                            
                        }
                    }  
                });
            */  
                data = hid_data+"|"+htype+"|"+address+"|"+ccaattmm;
                $("#house_data").val(data);
            //alert ('col_data = '+col_data);
                $.fancybox({
                    autoScale   : true,
                    fitToView   : true,
                    autoSize    : false,
                    modal       : true,
                    minWidth    : 1020,
                    minHeight   : '100%',
                    type        : 'iframe',
                    //href        : 'house_detail.php?hid='+hid_data+'&htype='+htype+'&address='+address,
                    href        : 'house_detail.php'

                });
             
            }else if (col_data == 'คนในบ้าน'){
               
                $.fancybox({
                    autoScale   : true,
                    fitToView   : true,
                    autoSize    : false,
                    modal       : true,
                    minWidth    : 1050,
                    type        : 'iframe',
                    href        : 'list_pop.php?action=pop_in_house&hid='+hid_data

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



});