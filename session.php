<?php
session_start();
$logged_in = isset($_SESSION['email']);
$is_admin = $logged_in && ($_SESSION['admin'] == 1);
?>