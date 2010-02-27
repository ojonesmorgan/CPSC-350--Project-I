<?php
include("session.php");
if (!$logged_in) header("location:login.php?err=accessdenied");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>BandLink | Account</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<div id="wrap">
    <?php include("header.php"); ?>
	<div id="main">
	<!--<center><div>-->

	<h1><u><?php echo $_SESSION['name']; ?>'s Account</u></h1>
	
	<?php
	$error = $_GET['err'];
	$name = $_GET['name'];
	$email = $_GET['email'];
	$saved = $_GET['saved'] == 1;
	
	if (empty($name)) $name = $_SESSION['name'];
	if (empty($email)) $email = $_SESSION['email'];

	echo "<form method='post' action='updateaccount.php'>";
	
	if (isset($error))
	{
		echo "<fieldset style='border:2px solid white; background-color:black;'>";
		echo "<p style='color:white; font-weight:bold; text-align:center;'>";
		if ($error == "missingpass") echo "Please enter your current password to change your account settings.";
		if ($error == "wrongpass") echo "Your current password is incorrect.";
		if ($error == "passwords") echo "The passwords you entered do not match.";
		if ($error == "shortpass") echo "Passwords must be at least 4 characters long.";
		if ($error == "invalidemail") echo "Please enter a valid email address.";
		if ($error == "emailtaken") echo "This email address has already been registered.";
		echo "</p></fieldset><br />";
	}
	
	if ($saved)
	{
		echo "<fieldset style='border:2px solid white; background-color:black;'>";
		echo "<p style='color:white; font-weight:bold; text-align:center;'>";
		echo "Your changes have been saved.";
		echo "</p></fieldset><br />";
	}
	
	echo "<label for='name'>Name:</label> <input name='name' type='text' value='$name' />";
	echo "<label for='email'>Email Address:</label> <input name='email' type='text' value='$email' />";
	echo "<label for='currentpass'>Current Password:</label> <input name='currentpass' type='password' />";
	echo "<label for='password'>New Password:</label> <input name='password' type='password' />";
	echo "<label for='confirmpass'>Confirm Password:</label> <input name='confirmpass' type='password' />";
	echo "<p style='text-align:center;'><input name='delete' type='checkbox' value='1' /> Delete my account.</p>";
	echo "<p><input style='display:block; margin-left:auto; margin-right:auto;' type='submit' value='  Save Changes  ' /></p>";
	echo "</form>\n";
?>
	
	
	<!--</div></center>-->
	
	</div> <!-- end main div -->
	
	<?php include("projectSideBar.php"); ?>
	<?php include("footer.html");?>
</div>
</body>
</html>