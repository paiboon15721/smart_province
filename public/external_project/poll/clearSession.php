<?php
session_start();
session_unregister("votePID");
session_unregister("voteFLNAME");
session_unregister("voteADDR");
header("Location: ../poll/");
?>