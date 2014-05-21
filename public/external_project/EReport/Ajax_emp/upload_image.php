<input type='file' name='uploadfile' id="uploadfile" style="width: 400px; padding: 2px">
<?php
$fileupload = $_FILES['uploadfile']['tmp_name'];
$fileupload_name = $_FILES['uploadfile']['name'];
$fileupload_size = $_FILES['uploadfile']['size'];
$fileupload_type = $_FILES['uploadfile']['type'];
$name_photo = $fileupload_name.$fileupload_type;
copy($fileupload,"./IMAGE_EMP/tmp/".$name_photo);
?>