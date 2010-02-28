<?php
include("session.php");

if (!$logged_in)
{
	header("location:login.php?err=accessdenied");
	exit;
}

$confirmed = $_GET['confirm'] == 1;
$user = $_GET['u'];
$name = $_GET['n'];
if (empty($user)) $user = $_SESSION['email'];
$is_owner = $user == $_SESSION['email'];

if ($confirmed)
{
	include("db_connect.php");
	mysqli_query($db, "DELETE FROM users WHERE email = '$user'");
	
	if ($is_owner)
	{
		unset($_SESSION['email']);
		session_destroy();
		header("location:.");
	}
	
	else header("location:account.php");
	
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
	<br /><p style="text-align:center;">
	
	<?php
	echo "Are you sure you want to delete ";
	if ($is_owner) echo "your";
	else echo $name."'s";
	echo " BandLink account?";
	?>
	
	<br />This cannot be undone.</p>
	<p style="text-align:center;">
	<?php if ($is_owner) { ?>
	<a href="deleteaccount.php?confirm=1" onClick="alert('Your account has been deleted.')">
	Yes, permanently delete my account.</a>
	<?php } else { echo "<a href='deleteaccount.php?u=$user&n=$name&confirm=1' "; ?>
	onClick="alert('The account has been deleted.')">
	Yes, permanently delete this account.</a>
	<?php } ?>
	</p>
	<p style="text-align:center;">
	<?php if ($is_owner) { ?>
	<a href="account.php">No, go back to my account settings.</a>
	<?php } else { echo "<a href='account.php?u=$user&n=$name'>"; ?>
	No, go back to account settings.</a>
	<?php } ?>
	</p>
	<!--</div></center>-->
	
	</div> <!-- end main div -->
	
	<?php include("projectSideBar.php"); ?>
	<?php include("footer.html");?>
</div>
</body>
</html>