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
	<div id="main">
	<!--<center><div>-->

	<h2><u>Register</u></h2>
	
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
	
	echo "<p><label for =\"name\">Name:</label> <input name='name' type='text' value='$name' /></p>";
	echo "<p><label for =\"email\">Email Address:</label> <input name='email' type='text' value='$email' /></p>";
	echo "<p><label for =\"password\">Password:</label> <input name='password' type='password' /></p>";
	echo "<p><label for =\"confirmpass\">Confirm Password:</label> <input name='confirmpass' type='password' /></p>";
	echo "<p><input type='submit' value='  Create Account  ' /></p>";
	echo "</form>\n";
	echo "<p>Already have an account? <a href='login.php'>Click here to log in.</a></p><br />\n";



	?>
	<!-- same code as above only in a form 

<form method="post" action="addBandResults.php">
    <label for="name">Band name:</label>
    <input type="text" id="name" name="name" /><br />
    <label for="genre">Genre:</label>
    <input type="text" id="genre" name="genre" /><br />
    <label for="tity">City:</label>
    <input type="text" id="city" name="city" /><br />
    <label for="state">State:</label>
    <input type="text" id="state" name="state" /><br />
    <label for="description">Description:</label>
    <input type="text" id="description" name="description"  /><br />
    <label for="photo">Photo:</label>
    <input type="text" id="photo" name="photo"/><br />
  
    <label for="other">Anything else you want to add?</label>
    <textarea id="other" name="other"></textarea><br />
    <input type="submit" value="Submit Band" name="submit" />
  </form>





	 end new same code -->
	
	<!--</div></center>-->
	
	</div> <!-- end main div -->
	
	<?php include("projectSideBar.php"); ?>
	<?php include("footer.html");?>
</div>
</body>
</html>