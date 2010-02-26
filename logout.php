<?php
include("session.php");
unset($_SESSION['email']);
session_destroy();
header("location:login.php?logout=1");
?>