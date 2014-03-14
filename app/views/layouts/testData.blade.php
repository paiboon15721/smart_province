<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
print_r(DB::getQueryLog());
?>
<br />
<br />
{{$listOfData}}

