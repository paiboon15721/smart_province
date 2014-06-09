<?php
//include("./chk_session.php");
ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);
//$EMPID = "1113332225647";
//$EMPNAME = "นายยาม รักษาการณ์";
//$CATM_MOO = "หมู่บ้าน เรากันเอง";
?>
<html>
    <head>
        <?php
        include_once("header_top.php");
//include ("FUNCTION/function.php");
        ?>
        <title>บันทึกข้อมูลการเข้างาน และเหตุการณ์ที่เกิดขึ้น</title>
        <link href="css/ui-lightness/jquery-ui-1.9.2.custom.css" rel="stylesheet">
        <script src="js/jquery-1.8.3.js"></script>
        <script src="js/jquery-ui-1.9.2.custom.js"></script>
        <script src="js/jquery-ui-timepicker.js"></script>
        <script src="js/jquery.limit.js"></script>
        <script type="text/javascript" src="js/ajaxupload.3.5.js" ></script>
        <link rel="stylesheet" type="text/css" href="css/chronicle.css" />
        <script type="text/javascript">
            $(function() {
                /////////////////////////////////////
                $("#add_chronicle").click(function() {
                    changePage("Ajax_detail/chronicle_detail.php", "detail");
                });
                $("#start_work").click(function() {
                    //alert(new Date());
                    changePage("Ajax_detail/chronicle_detail.php", "start");
                });
                $("#end_work").click(function() {
                    //alert(new Date());
                    changePage("Ajax_detail/chronicle_detail.php", "end");
                });
                /////////////////////////////////////
            });
            $(function() {
                ////////LOAD/////////////
                check_info();
                var d = new Date();
                var month = d.getMonth() + 1;
                var day = d.getDate();
                var year = d.getFullYear() + 543;
                var curTime = d.getHours() + ':' + d.getMinutes();
                var curDate = (month < 10 ? '0' : '') + month + "-" + (day < 10 ? '0' : '') + day + '-' + year + ' ' + curTime;
                $("#date_start").datepicker("setDate", new Date(curDate));
            });
            function changePage(page, selPage) {
                $.get(page + "?ts=<?php echo time(); ?>", {selPage: selPage},
                function(data) {
                    $("#divGetData").html(data);
                    $("#page_now").val(selPage);
                    $('html, body').animate({scrollTop: $(document).height()}, 1500);
                }
                );
            }
            function check_info() {
                $.get("Ajax_detail/connect_info.php?ts=<?php echo time(); ?>", {choice: "check_info", pid: $("#em_pid").val()},
                function(data) {
                    var result = data.split("|");
                    //alert(result[0]);
                    if (result[0] == 0) {
                        $("#r_no").val(result[1]);
                        $("#start_work").removeAttr("disabled");
                        $("#add_chronicle").attr("disabled", "disabled");
                        $("#end_work").attr("disabled", "disabled");
                        $("#divGetData").html("");
                    } else if (result[0] == 1) {
                        $("#r_no").val(result[1]);
                        $("#start_work").attr("disabled", "disabled");
                        $("#add_chronicle").removeAttr("disabled");
                        $("#end_work").removeAttr("disabled");
                        $("#page_now").val('detail');
                        $("#add_chronicle").click();
                        $("#divGetData").html("");
                        if ($('#guard_work').val() == 'false') {
                            $("#add_chronicle").attr("disabled", "disabled");
                            $("#divGetData").html("");
                            $('#end_work').trigger('click');
                        }
                    } else {
                        $("#start_work").attr("disabled", "disabled");
                        $("#add_chronicle").attr("disabled", "disabled");
                        $("#end_work").attr("disabled", "disabled");
                        $("#divGetData").html("");
                    }
                }
                );
            }

        </script>
    </head>
    <body  >
        <?php include ("header_body.php"); ?>
        <div  id="container">
            <?php
            $EMPID = $_SESSION['EMPID'];
            $EMPNAME = $_SESSION['EMPNAME'];
            $CATM_MOO = $_SESSION['catm_menu'];
            ?>
            <?php if (check_use($EMPID)) { ?>
                <form id="form1" name="form1" method="post" action="">
                    <input type="hidden" id="page_now" value="" />
                    <input type="hidden" id="em_pid" value="<?php echo $EMPID; ?>" />
                    <input type="hidden" id="em_name" value="<?php echo $EMPNAME; ?>" />
                    <input type="hidden" id="em_catm" value="<?php echo $CATM_MOO; ?>" />
                    <input type="hidden" id="guard_work" value="<?php check_guard($EMPID); ?>" />
                    <input type="hidden" id="r_no" value="" />
                    <table width="1000" align="center" border=0 >
                        <tr  valign="middle">
                            <th colspan="2" align="center"   >บันทึกข้อมูลการเข้างาน และเหตุการณ์ที่เกิดขึ้น</th>
                        </tr>
                        <tr height="50px">
                            <td  colspan="2" align="center"  ><input type='button' value='บันทึกเวลาเริ่มปฏิบัติงาน' id='start_work'><input type='button' value='บันทึก/แก้ไขข้อมูลเหตุการณ์' id='add_chronicle'><input type='button' value='บันทึกเวลาสิ้นสุดปฏิบัติงาน' id='end_work'></td>
                        </tr>
                    </table>
                    <div id="divGetData" ></div>
                </form>
            <?php } else { ?>
                <table width="1000" align="center" border=0 >
                    <tr  valign="middle">
                        <th colspan="2" align="center"   >บันทึกข้อมูลการเข้างาน และเหตุการณ์ที่เกิดขึ้น</th>
                    </tr>
                    <tr height="50px">
                        <td  colspan="2" align="center"  >ท่านไม่มีสิทธิใช้งานในระบบนี้ </td>
                    </tr>
                </table>
            <?php } ?>
        </div >
    </body>
</html>
<?php

function check_guard($id) {
    $sysdate = get_upd_date();
    $systime = get_upd_time();
    $systime = intval($systime);
    if ($systime >= 800 && $systime < 1600) {
        $phase = 1;
    } elseif ($systime >= 1600 && $systime < 2400) {
        $phase = 2;
    } else {
        $phase = 3;
    }
    $sql = "select count(*) as sum from tab_guard where pid='$id' and start_date	='$sysdate' and phase='$phase' ";
    $query = mysql_query($sql);
    $result = mysql_fetch_array($query);
    $sum = $result['sum'];
    if ($sum == 0) {
        echo "false";
    } else {
        echo "true";
    }
}
?>