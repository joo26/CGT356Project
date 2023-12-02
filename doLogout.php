<?php
session_start();
include("includes/openDbConn.php");

$_SESSION = array();

session_destroy();

header("Location: index.php");
exit();
?>