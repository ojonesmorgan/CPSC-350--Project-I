<?php
include("session.php");
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirmpass'];

$email_at = strpos($email, "@");
$email_dot = strpos($email, ".");

if ((strlen($password) > 0) && (strlen($password) < 4)) $error = "shortpass";
if ($password != $confirm_password) $error = "passwords";
//if (($email_at < 1) || ($email_dot < 1) || ($email_at > $email_dot)) $error = "invalidemail";

include("db_connect.php");

$result = mysqli_query($db, "SELECT * FROM users WHERE email='$email'");

while ($row = mysqli_fetch_assoc($result))
{
	$error = "emailtaken";
}

if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) $error = "missinginput";

if (isset($error)) header("location:register.php?err=$error"."&name=$name"."&email=$email");

else
{	
	$name = mysql_escape_string(stripslashes(trim($name)));
	$email = mysql_escape_string(stripslashes(trim($email)));
	$password = mysql_escape_string(stripslashes(trim(md5($password))));
	
	mysqli_query($db, "INSERT INTO users VALUES ('$name', '$email', '$password', false)");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Account Created</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<div id="wrap">
<?php include("header.php"); ?>
<center><div>

<?php
echo "<br /><h1>Welcome, ".$name."!</h1>";
echo "<p>Your account has been created.</p>";
echo "<p><a href='login.php?email=$email>Click here to log in.</a></p><br />\n";
?>

</div></center></div>
</body>
</html>