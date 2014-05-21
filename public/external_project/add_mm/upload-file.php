<?php
$uploaddir = $_POST["uploaddir"];
$filename = $_POST["filename"];
$extension = end(explode(".", $_FILES['uploadfile']['name']));
$filename = $filename.".".$extension;
//echo "NAME:$name uploaddir:$uploaddir";
//echo $_FILES['uploadfile']['name'];
$file = $uploaddir . basename($filename); 
 
if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) { 
  echo "success"; 
} else {
                echo "error";
}
?>
