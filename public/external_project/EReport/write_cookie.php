<?php
echo $_SESSION['EMPID'];
session_start();
if (isset($_GET['flg'])) {
    $flg = $_GET['flg'];
} else {
    $flg = "0";
}
$_SESSION[fact] = $flg;
if ($flg == '1') {
    echo "<META HTTP-EQUIV=Refresh CONTENT=0;URL=\"register_emp.php\">";
} elseif ($flg == '3') {
    echo "<META HTTP-EQUIV=Refresh CONTENT=0;URL=\"chronicle.php\">";
} elseif ($flg == '2') {
    echo "<META HTTP-EQUIV=Refresh CONTENT=0;URL=\"edit_emp.php\">";
} elseif ($flg == '4') {
    echo "<META HTTP-EQUIV=Refresh CONTENT=0;URL=\"Rpt_EReport.php\">";
} else {
    echo "<META HTTP-EQUIV=Refresh CONTENT=0;URL=\"menu.php\">";
}
//echo "sql = $sql_find";
?>