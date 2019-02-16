<?php
session_start();
//unset session variable
$_SESSION = array();
//destroy session
session_destroy();
header("Location: ../login.php");

?>