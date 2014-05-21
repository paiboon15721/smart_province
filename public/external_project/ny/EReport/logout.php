<?php
session_start();
//session_destroy();
unset($_SESSION[EMPID]);
unset($_SESSION[EMPNAME]);
unset($_SESSION[EMPADD]);
unset($_SESSION[CATM_MOO]);
echo "<META HTTP-EQUIV=Refresh CONTENT=0;URL=\"write_cookie.php\">";
?>