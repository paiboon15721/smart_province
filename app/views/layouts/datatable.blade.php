@extends('contentLayouts.index')

@section('subTitle')
สภาพปัญหา
@stop
@section('subDescription')
สภาพปัญหา
@stop
@section('subKeywords')
สภาพปัญหา
@stop

@section('subScript&css')
{{HTML::style('css/dataTables/jquery-ui-1.8.14.custom.css')}}
{{HTML::style('css/dataTables/demo_table_jui.css')}}
{{HTML::style('css/dataTables/TableTools_JUI.css')}}
{{HTML::style('css/dataTables/style_information.css')}}
{{HTML::script('js/dataTables/jquery.dataTables.min.js')}}
{{HTML::script('js/dataTables/TableTools.js')}}
{{HTML::script('js/dataTables/ZeroClipboard.js')}}
{{HTML::script('js/dataTables/jquery.jeditable.js')}}
<script type="text/javascript">
    var oTable;
    $(document).ready(function() {
        TableTools.BUTTONS.add = {
            "sAction": "text",
            "sToolTip": "",
            "fnMouseover": null,
            "fnMouseout": null,
            "fnClick": function(nButton, oConfig) {
                window.location = "";
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
            "fnClick": function(nButton, oConfig) {
                var oTT = TableTools.fnGetInstance('datatable');
                if (oTT.fnGetSelectedData() == "") {
                    alert("กรุณาเลือกรายการที่ต้องการแก้ไข");
                } else {
                    var aData = oTT.fnGetSelectedData()[0][0];
                    window.location = "_form/" + aData;
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
            "fnClick": function(nButton, oConfig) {
                var oTT = TableTools.fnGetInstance('datatable');
                if (oTT.fnGetSelectedData() == "") {
                    alert("กรุณาเลือกรายการที่ต้องการลบ");
                } else {
                    if (confirm('คุณแน่ใจที่จะลบข้อมูลนี้?')) {
                        var aData = oTT.fnGetSelectedData()[0][0];
                        window.location = "_form/" + aData;
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
            "bServerSide": true,
            "iDisplayLength": 10,
            "sAjaxSource": "{{$datasourceUrl}}"
        });
    });

</script>
@stop

@section('subContent')
<div id="welcome" class="post">
    <table cellspacing="0" cellpadding="0" border="0"  id="datatable">
        <thead>
            <tr>
                <th width="30" field="problem_running_id">id</th>
                <th width="100" field="catm">รหัสหมู่บ้าน</th>
                <th width="30" field="problem_id">รหัสปัญหา</th>
                <th width="150" field="problem_name">ปัญหา</th>
                <th width="100" field="problem_desc">สภาพปัญหา</th>
                <th width="50" field="cause">สาเหตุ</th>
                <th width="100" field="howto">ทางแก้</th>
                <th width="40" field="begin_date">วันเกิด</th>
                <th width="40" field="end_date">วันแก้</th>
                <th width="40" field="status">สถานะ</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@stop
