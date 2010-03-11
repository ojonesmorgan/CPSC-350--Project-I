<?php
include("session.php");
if ($logged_in) header("location:.");

include("db_connect.php");
$email = $_POST['email'];
$password = md5($_POST['password']);

$result = mysqli_query($db, "SELECT * FROM users WHERE email = '$email'");

$count = 0;

while ($row = mysqli_fetch_assoc($result))
{
	$correct_password = ($row['password'] == $password) && isset($password);
	
	if ($correct_password)
	{
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

else header("location:.");
?>