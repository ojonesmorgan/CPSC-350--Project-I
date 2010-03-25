<?php
$disable_auto_log_in = true;
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

	<div id="main">
	<h1><u>Log In</u></h1>
	<?php
	$error = $_GET['err'];
	$email = $_GET['email'];
	$logged_out = $_GET['logout'] == 1;
	
	echo "<form name='loginform' align='left' method='post' action='loginhandler.php'>";
	
	if (isset($error))
	{
		echo "<fieldset style='border:2px solid white; background-color:black;'>";
		echo "<p style='color:white; font-weight:bold; text-align:center;'>";
		if ($error == "accessdenied") echo "You must be logged in to access that page.";
		if ($error == "noinput") echo "Please enter an email address and password.";
		if ($error == "noemail") echo "Please enter an email address.";
		if ($error == "nopass") echo "Please enter a password.";
		if ($error == "wrongemail") echo "The email address you entered has not been registered.";
		if ($error == "wrongpass") echo "The password you entered is incorrect.";
		if ($error == "invalid") echo "Some information is missing or incorrect. Please try again.";
		echo "</p></fieldset><br />";
	}
	
	else if ($logged_out)
	{
		echo "<fieldset style='border:2px solid white; background-color:black;'>";
		echo "<p style='color:white; font-weight:bold; text-align:center;'>";
		echo "You have been logged out.\n";
		echo "</p></fieldset><br />";
	}
	
	if (empty($email))
	{
		$email = $_COOKIE['blemail'];
		$password = $_COOKIE['blpw'];
	}
	
	echo "<input name='ref' type='hidden' value='".$_GET['ref']."' />";
	echo "<label for=\"email\">Email Address:</label><input name='email' type='text' value='$email' /><br/>";
	echo "<label for=\"password\">Password: </label><input name='password' type='password' value='$password' /><br/>";
	echo "<p style='text-align:center;'>";
	echo "<input onClick='if (!this.checked) {loginform.rememberpass.checked=0; loginform.rememberpass.disabled=1;}";
	echo " else loginform.rememberpass.disabled=false;' ";
	echo "name='rememberme' type='checkbox' ";
	if (!empty($_COOKIE['blemail']) && empty($_GET['email'])) echo "checked ";
	echo "value='1' /> Remember me.<br />";
	echo "<input name='rememberpass' type='checkbox' ";
	if (!empty($_COOKIE['blpw']) && !empty($_COOKIE['blemail']) && empty($_GET['email'])) echo "checked ";
	echo "value='1' /> Remember my password.</p>";
	echo "<p><input style='display:block; margin-left:auto; margin-right:auto;' type='submit' value='  Login  ' /></p>";
	echo "</form>\n";
	echo "<p style='text-align:center;'>Don't have an account? <a href='register.php'>Click here to register.</a></p><br />\n";
	?>
	
	</div><!--end main div -->
	
	<?php include("projectSideBar.php"); ?>
	<?php include("footer.html");?>


</body>
</div>
</html>