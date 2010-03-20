<?php
$disable_auto_log_in = true;
include("session.php");
if ($logged_in)
{
	header("location:.");
	exit;
}

include("db_connect.php");
$email = htmlspecialchars($_POST['email']);
$password = md5(htmlspecialchars($_POST['password']));
$remember_email = $_POST['rememberme'] == 1;
$remember_pass = $_POST['rememberpass'] == 1;
$ref = $_POST['ref'];
if (empty($ref)) $ref = ".";

$result = mysqli_query($db, "SELECT * FROM users WHERE email = '$email'");
$count = 0;

while ($row = mysqli_fetch_assoc($result))
{
	$correct_password = ($row['password'] == $password) && isset($password);
	
	if ($correct_password)
	{
		unset($_SESSION['loggedout']);
		session_destroy();
		session_start();
		$_SESSION['name'] = $row['name'];
		$_SESSION['email'] = $row['email'];
		$_SESSION['admin'] = $row['admin'];
	}
	
	++$count;
}

if (empty($_SESSION['email']))
{
	if (empty($email) && empty($password)) $error = "noinput";
	else if (empty($email)) $error = "noemail";
	else if (empty($password)) $error = "nopass&email=$email";
	else if ($count <= 0) $error = "wrongemail";
	else if (!$correct_password) $error = "wrongpass";
	else $error = "invalid";
	
	header("location:login.php?err=$error");
}

else
{
	if ($remember_email) setcookie("blemail", "$email", time() + 60 * 60 * 24 * 30);
	else if ($email == $_COOKIE['blemail']) setcookie("blemail");
	
	$password = htmlspecialchars($_POST['password']);
	if ($remember_pass) setcookie("blpw", "$password", time() + 60 * 60 * 24 * 30);
	else if ($email == $_COOKIE['blemail']) setcookie("blpw");
	
	header("location:$ref");
}
?>