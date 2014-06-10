<?php

session_start();

$sessionName = 'login_82e5d2c56bdd0811318f0cf078b78bfc';
if (isset($_SESSION[$sessionName])) {
    $userId = $_SESSION[$sessionName];
    echo $userId;
} else {
    echo 'not login';
}

