<?php include("session.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>BandLink | Register</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<div id="wrap">
    <?php include("header.php"); ?>
	<div id="main">
	<!--<center><div>-->

	<h1><u>Register</u></h1>
	
	<?php
	$error = $_GET['err'];
	$name = $_GET['name'];
	$email = $_GET['email'];

	echo "<form method='post' action='createaccount.php'>";
	
	if (isset($error))
	{
		echo "<p style='color:red;'>";
		if ($error == "missinginput") echo "Please fill in all required fields.";
		if ($error == "passwords") echo "The passwords you entered do not match.";
		if ($error == "shortpass") echo "Passwords must be at least 4 characters long.";
		if ($error == "invalidemail") echo "Please enter a valid email address.";
		echo "</p><br />";
	}
	
	echo "<label for =\"name\">Name:</label> <input name='name' type='text' value='$name' />";
	echo "<label for =\"email\">Email Address:</label> <input name='email' type='text' value='$email' />";
	echo "<label for =\"password\">Password:</label> <input name='password' type='password' />";
	echo "<label for =\"confirmpass\">Confirm Password:</label> <input name='confirmpass' type='password' />";
	echo "<input  type='submit' value='  Create Account  ' />";
	echo "</form>\n";
	echo "<p style='text-align:center;'>Already have an account? <a href='login.php'>Click here to log in.</a></p><br />\n";



	?>
	
	
	<!--</div></center>-->
	
	</div> <!-- end main div -->
	
	<?php include("projectSideBar.php"); ?>
	<?php include("footer.html");?>
</div>
</body>
</html>