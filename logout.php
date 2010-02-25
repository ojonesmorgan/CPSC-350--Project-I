<?php
include("session.php");
unset($_SESSION['uid']);
session_destroy();
header("location:login.php");
?>