<?php
include("session.php");
$name = $_POST['name'];
$email = $_POST['email'];
$current_password = $_POST['currentpass'];
$password = $_POST['password'];
$confirm_password = $_POST['confirmpass'];
$delete = $_POST['delete'] == 1;

$email_at = strpos($email, "@");
$email_dot = strpos($email, ".");

include("db_connect.php");
$result = mysqli_query($db, "SELECT * FROM users WHERE email='".$_SESSION['email']."'");

while ($row = mysqli_fetch_assoc($result))
{
	if (md5($current_password) != $row['password']) $error = "wrongpass";
}

if ((strlen($password) > 0) && (strlen($password) < 4)) $error = "shortpass";
if ($password != $confirm_password) $error = "passwords";
//if (($email_at < 1) || ($email_dot < 1) || ($email_at > $email_dot)) $error = "invalidemail";

$result = mysqli_query($db, "SELECT * FROM users WHERE email='$email'");

if ($email != $_SESSION['email'])
{
	while ($row = mysqli_fetch_assoc($result))
	{
		$error = "emailtaken";
	}
}

if (empty($current_password)) $error = "missingpass";

if ($delete && ($error != "missingpass") && ($error != "wrongpass"))
{
	header("location:deleteaccount.php");
	exit;
}

if (isset($error)) header("location:account.php?err=$error"."&name=$name"."&email=$email");

else
{	
	$name = mysql_escape_string(stripslashes(trim($name)));
	$email = mysql_escape_string(stripslashes(trim($email)));
	if (!empty($password)) $password = mysql_escape_string(stripslashes(trim(md5($password))));
	
	$account = "WHERE email='".$_SESSION['email']."'";
	
	if (!empty($name)) mysqli_query($db, "UPDATE users SET name='$name' $account");
	if (!empty($email)) mysqli_query($db, "UPDATE users SET email='$email' $account");
	if (!empty($password)) mysqli_query($db, "UPDATE users SET password='$password' $account");
	
	$result = mysqli_query($db, "SELECT * FROM users WHERE email='$email'");
	
	while ($row = mysqli_fetch_assoc($result))
	{
		$_SESSION['name'] = $row['name'];
		$_SESSION['email'] = $row['email'];
	}
	
	header("location:account.php?saved=1");
}
?>