<?php
include("session.php");
unset($_SESSION['email']);
session_destroy();
session_start();
$_SESSION['loggedout'] = true;
header("location:login.php?logout=1");
?>