<?php
$img_del=$_POST["img_del"];
 //  echo("delect img=".$img_del);
  $del_tmp= "/var/www/html/ci/application/smart_province/external_project/news_voice/temp/".$img_del;
   //echo("del_tmp=".$del_tmp);
   unlink($del_tmp);
?>