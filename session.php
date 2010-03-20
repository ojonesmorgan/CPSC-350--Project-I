<?php
session_start();
$logged_in = isset($_SESSION['email']);

if (empty($disable_auto_log_in) && !$logged_in && !empty($_COOKIE['blemail']) && !empty($_COOKIE['blpw']))
{
	include("autologin.php");
	$logged_in = isset($_SESSION['email']);
}

$is_admin = $logged_in && ($_SESSION['admin'] == 1);
?>