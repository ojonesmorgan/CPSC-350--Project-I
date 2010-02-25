<?php include("session.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Register</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<div id="wrap">
    <?php include("header.php"); ?>
	<center><div>
	
	<?php
	$error = $_GET['err'];
	$name = $_GET['name'];
	$email = $_GET['email'];
	
	echo "<br /><form method='post' action='createaccount.php'>";
	
	if (isset($error))
	{
		echo "<p style='color:red;'>";
		if ($error == "missinginput") echo "Please fill in all required fields.";
		if ($error == "passwords") echo "The passwords you entered do not match.";
		if ($error == "shortpass") echo "Passwords must be at least 4 characters long.";
		if ($error == "invalidemail") echo "Please enter a valid email address.";
		echo "</p><br />";
	}
	
	echo "<p><b>Name:</b> <input name='name' type='text' value='$name' /></p>";
	echo "<p><b>Email Address:</b> <input name='email' type='text' value='$email' /></p>";
	echo "<p><b>Password:</b> <input name='password' type='password' /></p>";
	echo "<p><b>Confirm Password:</b> <input name='confirmpass' type='password' /></p>";
	echo "<p><input type='submit' value='  Create Account  ' /></p>";
	echo "</form>\n";
	echo "<p>Already have an account? <a href='login.php'>Click here to log in.</a></p><br />\n";
	?>
	
	</div></center>
	<div id="footer"><p></p></div>
</div>
</body>
</html>