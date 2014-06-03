@extends('contentLayouts.content')

@section('subTitle')
{{$menuName}}
@stop
@section('subDescription')
{{$menuName}}
@stop
@section('subKeywords')
{{$menuName}}
@stop

@section('subScript&css')
{{HTML::style('css/dataTables/jquery-ui-1.8.14.custom.css')}}
{{HTML::style('css/dataTables/demo_table_jui.css')}}
{{HTML::style('css/dataTables/TableTools_JUI.css')}}
{{HTML::style('css/dataTables/dataTables.bootstrap.css')}}
{{HTML::script('js/dataTables/jquery.dataTables.min.js')}}
{{HTML::script('js/dataTables/TableTools.js')}}
{{HTML::script('js/dataTables/ZeroClipboard.js')}}
{{HTML::script('js/dataTables/jquery.jeditable.js')}}
{{HTML::script('js/dataTables/dataTables.bootstrap.js')}}
<script type="text/javascript">
    var oTable;
    $(document).ready(function() {
        TableTools.BUTTONS.add = {
            "sAction": "text",
            "sToolTip": "",
            "fnMouseover": null,
            "fnMouseout": null,
            "fnClick": function() {
                window.location = "{{$url}}/insert";
            },
            "fnSelect": null,
            "fnComplete": null,
            "fnInit": null
        };

        TableTools.BUTTONS.edit = {
            "sAction": "text",
            "sToolTip": "",
            "fnMouseover": null,
            "fnMouseout": null,
            "fnClick": function() {
                var oTT = TableTools.fnGetInstance('datatable');
                if (oTT.fnGetSelectedData() == "") {
                    alert("กรุณาเลือกรายการที่ต้องการแก้ไข");
                } else {
                    var aData = oTT.fnGetSelectedData()[0][0];
                    window.location = "{{$url}}/update/" + aData;
                }
            },
            "fnSelect": null,
            "fnComplete": null,
            "fnInit": null
        };

        TableTools.BUTTONS.remove = {
            "sAction": "text",
            "sToolTip": "",
            "fnMouseover": null,
            "fnMouseout": null,
            "fnClick": function() {
                var oTT = TableTools.fnGetInstance('datatable');
                if (oTT.fnGetSelectedData() == "") {
                    alert("กรุณาเลือกรายการที่ต้องการลบ");
                } else {
                    if (confirm('คุณแน่ใจที่จะลบข้อมูลนี้?')) {
                        var aData = oTT.fnGetSelectedData()[0][0];
                        window.location = "{{$url}}/delete/" + aData;
                    }
                }
            },
            "fnSelect": null,
            "fnComplete": null,
            "fnInit": null
        };

        oTable = $('#datatable').dataTable({
            "sDom": '<"H"Tfr>t<"F"ip>',
            "oLanguage": {
                "sLengthMenu": "แสดง _MENU_ รายการ ต่อหน้า",
                "sZeroRecords": "ไม่พบข้อมูลที่ค้นหา",
                "sInfo": "แสดง _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
                "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 รายการ",
                "sInfoFiltered": "",
                "sSearch": "ค้นหา :",
                "oPaginate": {
                    "sFirst": "หน้าแรก",
                    "sLast": "หน้าสุดท้าย",
                    "sNext": "ต่อไป",
                    "sPrevious": "ก่อนหน้านี้"
                }
            },
            "oTableTools": {
                "sRowSelect": "single",
                "aButtons": [
                    {
                        "sExtends": "add",
                        "sButtonText": "เพิ่ม"
                    },
                    {
                        "sExtends": "edit",
                        "sButtonText": "แก้ไข"
                    },
                    {
                        "sExtends": "remove",
                        "sButtonText": "ลบ"
                    }
                ]
            },
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "sScrollY": 540,
            "sScrollX": "100%",
            "sScrollXInner": "150%",
            "bScrollCollapse": true,
            "bProcessing": true,
            "bServerSide": false,
            "iDisplayLength": 20,
            "sAjaxSource": "{{$datasourceUrl}}"
        });
    });

</script>
@stop

@section('subContent')
@yield('subSubContent')
@stop
