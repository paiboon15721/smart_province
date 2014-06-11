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

/*
  |--------------------------------------------------------------------------
  | Turn On The Lights
  |--------------------------------------------------------------------------
  |
  | We need to illuminate PHP development, so let's turn on the lights.
  | This bootstraps the framework and gets it ready for use, then it
  | will load up this application so that we can run it and send
  | the responses back to the browser and delight these users.
  |
 */

$app = require_once __DIR__ . '/bootstrap/start.php';

echo Session::get('EMPID');
