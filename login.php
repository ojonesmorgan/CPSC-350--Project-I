<?php
include("session.php");
if ($logged_in) header("location:.");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>BandLink | Log In</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<div id="wrap">
    <?php include("header.php"); ?>
	<center><div>
	
	<?php
	$error = $_GET['err'];
	$email = $_GET['email'];
	$logged_out = $_GET['logout'] == 1;
	
	echo "<br /><form method='post' action='loginhandler.php'>";
	
	if (isset($error))
	{
		echo "<p style='color:red;'>";
		if ($error == "accessdenied") echo "You must be logged in to access that page.";
		if ($error == "noinput") echo "Please enter an email address and password.";
		if ($error == "noemail") echo "Please enter an email address.";
		if ($error == "nopass") echo "Please enter a password.";
		if ($error == "wrongemail") echo "The email address you entered has not been registered.";
		if ($error == "wrongpass") echo "The password you entered is incorrect.";
		if ($error == "invalid") echo "Some information is missing or incorrect. Please try again.";
		echo "</p><br />\n";
	}
	
	else if ($logged_out) echo "<p>You have been logged out.</p><br />\n";
	
	echo "<p><b>Email Address:</b> <input name='email' type='text' value='$email' /></p>";
	echo "<p><b>Password:</b> <input name='password' type='password' /></p>";
	echo "<p><input type='submit' value='  Login  ' /></p>";
	echo "</form>\n";
	echo "<p>Don't have an account? <a href='register.php'>Click here to register.</a></p><br />\n";
	?>
	
	</div></center>
	<div id="footer"><p></p></div>
</div>
</body>
</html>