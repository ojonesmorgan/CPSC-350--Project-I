<?php
include("session.php");

if (!$logged_in)
{
	header("location:login.php?err=accessdenied");
	exit;
}

$saved = $_GET['saved'] == 1;
$name = $_GET['name'];
$genre = $_GET['genre'];
$city = $_GET['city'];
$state = $_GET['state'];

//if (empty($name))
//{
//	header("location:musicsearch.php");
//	exit;
//}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>BandLink | Band Profile</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<div id="wrap">
    <?php include("header.php"); ?>
	<div id="main">
	<!--<center><div>-->

	<h1><u><?php echo $_GET['name']; ?>'s Profile</u></h1>
	
	<?php
	if ($saved)
	{
		echo "<fieldset style='border:2px solid white; background-color:black;'>";
		echo "<p style='color:white; font-weight:bold; text-align:center;'>";
		echo "Your changes have been saved.";
		echo "</p></fieldset>";
	}
	
	echo "<form method='post' action='updateband.php?id=$name'><p>";
	echo "<label for='name'>Band Name:</label> <input name='name' type='text' value='$name' />";
	echo "<label for='genre'>Genre(s):</label> <input name='genre' type='text' value='$genre' />";
	echo "<label for='city'>City:</label> <input name='city' type='text' value='$city' />";
	echo "<label for='state'>State:</label> <input name='state' type='text' value='$state' /><p>";
	echo "<input style='display:block; margin-left:auto; margin-right:auto;' type='submit' value=' Save Changes ' />";
	echo "</p></p></form>";
	?>
	
	<!--</div></center>-->
	
	</div> <!-- end main div -->
	
	<?php include("projectSideBar.php"); ?>
	<?php include("footer.html");?>
</body>
</div>
</html>