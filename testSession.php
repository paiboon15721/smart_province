<?php

session_save_path('/var/www/html/Nayok_laravel/cgi-bin/tmp');
session_start();
//$_SESSION['EMPID'] = 'test';
echo $_SESSION['EMPID'];
echo $_SERVER['SCRIPT_FILENAME'];

