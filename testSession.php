<?php

/*
  $sessionName = '4sgdmfql4h5j897n89u4ink7l6';
  if (isset($_SESSION[$sessionName])) {
  $userId = $_SESSION[$sessionName];
  echo $userId;
  } else {
  echo 'not login';
  }
 */


require __DIR__ . '/bootstrap/autoload.php';
$app = require_once __DIR__ . '/bootstrap/start.php';

echo Session::get('EMPID');
