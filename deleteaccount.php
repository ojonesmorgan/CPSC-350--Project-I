<?php
include("session.php");

if (!$logged_in)
{
	header("location:login.php?err=accessdenied");
	exit;
}

$confirmed = $_GET['confirm'] == 1;

if ($confirmed)
{
	include("db_connect.php");
	mysqli_query($db, "DELETE FROM users WHERE email = '".$_SESSION['email']."'");
	unset($_SESSION['email']);
	session_destroy();
	header("location:.");
	exit;
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
	<br /><p style="text-align:center;">Are you sure you want to delete your BandLink account?
	<br />This cannot be undone.</p>
	<p style="text-align:center;"><a href="deleteaccount.php?confirm=1">Yes, permanently delete my account.</a></p>
	<p style="text-align:center;"><a href="account.php">No, go back to my account settings.</a></p>
	<!--</div></center>-->
	
	</div> <!-- end main div -->
	
	<?php include("projectSideBar.php"); ?>
	<?php include("footer.html");?>
</div>
</body>
</html>