<?php
$successURL= $_POST['successURL'];
$errorURL = $_POST['errorURL'];
$app = "../signin/signin.application";
$param = sprintf("ACT_FLAG='%s'&ACT_FLAG_CANCEL='%s'", $successURL, $errorURL);
header("Location: " . $app . "?" . $param);
?>