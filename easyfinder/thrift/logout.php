<?php
session_start();
/*SECTION: INCLUDES*/
include_once "ini.php";
include_once "functions.php";

unset($_SESSION[APP_SESSION_NAME]);
session_destroy();
if (file_exists('index.php')) {
header("location: index.php");
}elseif (file_exists('login.php')) {
header("location: login.php");
}
exit();
?>