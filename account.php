<?php
include("session.php");
if (!$logged_in) include("notloggedin.php");
if ($is_admin) $user = $_GET['u'];
if (empty($user)) $user = $_SESSION['email'];
$is_owner = $user == $_SESSION['email'];

include ("db_connect.php");
$result = mysqli_query($db, "SELECT * FROM users WHERE email = '$user'");
	
while ($row = mysqli_fetch_assoc($result))
{
	if (empty($_GET['name'])) $_GET['name'] = $row['name'];
	
	if (($row['admin'] == 1) && !$is_owner)
	{
		header("location:account.php?saved=1");
		exit;
	}
}
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

	<h1><u><?php echo $_GET['name']; ?>'s Account</u></h1>
	
	<?php	
	$error = $_GET['err'];
	$name = $_GET['name'];
	$email = $_GET['email'];
	$saved = $_GET['saved'] == 1;
	
	if (empty($name) && $is_owner) $name = $_SESSION['name'];
	if (empty($email)) $email = $user;

	echo "<form method='post' action='updateaccount.php?u=$user'>";
	
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
	echo "<label for='email'>Email Address:</label> ";
	//echo "<input name='email' type='text' value='$email' />";
	echo "<a href='mailto:$email'>$email</a>";
	if ($is_owner) echo "<label for='currentpass'>Current Password:</label> <input name='currentpass' type='password' />";
	echo "<label for='password'>New Password:</label> <input name='password' type='password' />";
	echo "<label for='confirmpass'>Confirm Password:</label> <input name='confirmpass' type='password' />";
	
	if ($is_admin && !$is_owner)
	{
		echo "<label for='admin'>Administrator:</label> <input name='admin' type='radio' value='1' /> ";
		echo "<span style='color:red; background-color:transparent;	";
		echo "font-family: 'Lucida Sans Unicode', 'Lucida Grande', 'Sans-Serif'";
		echo "font-size: 0.8em;'>yes&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<input style='margin-top:7px;' name='admin' type='radio' value='0' checked /> no</span>";
	}
	
	echo "<p style='text-align:center;'><input name='delete' type='checkbox' value='1' /> Delete ";
	if ($is_owner) echo "my";
	else echo $name."'s";
	echo " account.</p>";
	echo "<p><input style='display:block; margin-left:auto; margin-right:auto;' ";
	echo "type='submit' value='  Save Changes  ' /></p>";
	echo "</form>\n";
	
	if ($is_admin)
	{
		$user_accounts = "<br /><h1><u>User Accounts</u></h1><form type='get' action='account.php'>";
		$user_accounts .= "<p><select style='width:350px;' name='u'>\n";
		
		$result = mysqli_query($db, "SELECT * FROM users WHERE admin = '0'");
		$count = 0;
		
		while ($row = mysqli_fetch_assoc($result))
		{
			$user_email = $row['email'];
			$description = $row['name']." ($user_email)";
		
			$user_accounts .= "<option value='$user_email'>$description</option>\n";
			
			++$count;
		}
		
		$user_accounts .= "\n</select>&nbsp;&nbsp;<input style='width:75px;' type='submit' value=' Go ' />";
		$user_accounts .= "</p></form><br />\n";
		
		if ($count > 0) echo $user_accounts;
	}
	?>
	
	<!--</div></center>-->
	
	</div> <!-- end main div -->
	
	<?php include("projectSideBar.php"); ?>
	<?php include("footer.html");?>
</div>
</body>
</html>