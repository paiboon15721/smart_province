<?php

session_start();
$session_id = Session::getId();
echo $session_id;

